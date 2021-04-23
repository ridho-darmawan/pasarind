<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Makanan;
use Illuminate\Support\Facades\Validator;

class MakananController extends Controller
{

    function __construct()
    {
        $this->middleware('jwt.auth'); //selected method
       
    }
    
    public function index(Request $request)
    {
        $pesan = 'Data Tidak ada';
        $code = 404;

        $sortByField = 'created_at';
        $sortType='desc';
       
        $makanan =  Makanan::orderBy($sortByField,$sortType);

        if ($request->isMethod('post') && $request->has('q')) {
            $makanan->where("nama","like","%{$request->q}%");
        }

        $data = $makanan->paginate(10);

        if($data){
            
            $pesan = "Berhasil menampilkan data";
            $code = 200;
        }

        $out = [
            "message"=>$pesan,
            "result"=>$data,
            "code"=>$code
        ];

        return response()->json($out, $out['code']);
    }

    public function store(Request $request)
    {
        $pesan = 'Invalid Input Data';
        $code = 404;

        $validator = Validator::make($request->all(), [
            'nama'=>'required',
            'harga'=>'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'message'=>$validator->errors()->first(),
                'result'=>null,
                'code'=>$code
            ];
            return response()->json($response, $response['code']);
        }

        $makanan = Makanan::create($request->all());

        if($makanan){
            $pesan = 'sukses';
            $code =200; 
        }

        $out = [
            "message"=>$pesan,
            "result"=>null,
            "code"=>$code
        ];

        return response()->json($out, $out['code']);

    }

    public function update(Request $request, $id)
    {
        $pesan = 'Data Tidak Terupdate';
        $code = 404;

        $validator = Validator::make($request->all(),[
            'nama'=>'required',
            'harga'=>'required',
            'status'=>'required'

        ]);

        if ($validator->fails()) {
            $response = [
                'message'=>$validator->errors()->first(),
                'result'=>null,
                'code'=>$code
            ];
            return response()->json($response, $response['code']);
        }
        
        $makanan = Makanan::find($id);

        $data = $makanan->update($request->all());

        if($data){
            $pesan = 'Berhasil Update Data';
            $code =200; 
        }

        $out = [
            "message"=>$pesan,
            "result"=>null,
            "code"=>$code
        ];

        return response()->json($out, $out['code']);
    }

    public function destroy($id)
    {
        $pesan = 'Data Tidak Ditemukan';
        $code = 404;

        $makanan = Makanan::find($id);

        if ($makanan) {
           $makanan->delete();
           $pesan = 'Data Berhasil Terhapus';
           $code = 200;
        }      

        $out = [
            'message'=>$pesan,
            'result'=>null,
            'code'=>$code
        ];

        return response()->json($out, $out['code']);

    }

    public function show($id)
    {
        $pesan = 'Data Tidak ada';
        $code = 404;

        $makanan =  Makanan::find($uuid);
        if($makanan){
            $pesan = 'Data Berhasil ditampilkan';
            $code = 200;
        }

        $out = [
            "message"=>$pesan,
            "result"=>$makanan,
            "code"=>$code
        ];

        return response()->json($out, $out['code']);


    }

    public function menuMakananReady()
    {
        $pesan = 'Data Tidak ada';
        $code = 404;

        $sortByField = 'created_at';
        $sortType='desc';
       
        $makanan =  Makanan::where('status','ready')->orderBy($sortByField,$sortType);

      

        $data = $makanan->paginate(10);

        if($data){
            
            $pesan = "Berhasil menampilkan data";
            $code = 200;
        }

        $out = [
            "message"=>$pesan,
            "result"=>$data,
            "code"=>$code
        ];

        return response()->json($out, $out['code']);
    }

    
}