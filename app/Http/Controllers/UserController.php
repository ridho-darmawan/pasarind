<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $pesan = 'Gagal Register';
        $code=404;
        
        $validator = Validator::make($request->all(),[
            'username'=>'required|unique:user|max:255',
            'role'=>'required',
            'password' => 'required|min:6'
        ]);
    

        if ($validator->fails()) {
            $response = [
                'message'=>$validator->errors()->first(),
                'result'=>null,
                'code'=>422
            ];
            return response()->json($response, $response['code']);
        }

        $register = User::create([
            'nama'=>$request->nama,
            'role'=>$request->role,
            'username'=>$request->username,
            'password'=> Hash::make($request->password),
        ]);

        if($register){
            $pesan = 'Berhasil Register';
            $code =201;
        }

        $response = [
            'message'=>$pesan,
            'code'=>$code
        ];

        return response()->json($response, $response['code']);
    }


    public function login(Request $request)
    {
        $pesan = 'login vailed';
        $code = 404;

         $validator = Validator::make($request->all(),[
            'username'=>'required',
            'password'=>'required'
        ]);
        if ($validator->fails()) {
            $response = [
                'message'=>$validator->errors()->first(),
                'result'=>null,
                'code'=>422
            ];
            return response()->json($response, $response['code']);
        }
        $user = User::where("username",$request->username)->first();

        if (!$user) {
            $out = [
                "message" => "username Belum Terdaftar",
                "code"    => 401,
                "result"  => [
                    "token" => null,
                ]
            ];
            return response()->json($out, $out['code']);
        }
        if (Hash::check($request->password,$user->password)) {
            $pesan = 'Login Berhasil';
            $code = 200;

            $payload = [
                'iss'=>'bearee',
                'sub'=>$user,
                'iat' => time(), // Time when JWT was issued. 
                'exp' => time() + 60*60 // Expiration time
            ];

            $token = JWT::encode($payload, env('JWT_SECRET'));
            
            $response = [
                'message'=>$pesan,
                'code'=>$code,
                'level'=>$user->role,
                'token'=>$token
            ]; 
        }else{
            $pesan="Password tidak sama.";
            $response = [
                'message'=>$pesan,
                'code'=>$code,
                'result'=>[
                    'token'=>null
                ]
            ];
        }
        return response()->json($response, $response['code']);
    }
}