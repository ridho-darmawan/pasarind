<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pesanan;
use App\statusPesanan;
use App\Makanan;

use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Support\Facades\Validator;

class PesananController extends Controller
{
    function __construct()
    {
        $this->middleware('jwt.auth'); //selected method
    }

    public function index(Request $request)
    {
        $pesan = 'Data Tidak ada';
        $code = 404;

        $data = Pesanan::orderBy('created_at','desc');

        if ($request->isMethod('post')&& $request->has('q')) {
            $data->where("no_pesanan","like","%{$request->q}%");
        }

        if ($request->has('status')) {
            $data->whereHas('statusTransaksi', function($q) use($request){
                $q->where("status","=",$request->status);
            });
        }

        $data = $data->paginate(10);

        $pesan = "Berhasil menampilkan data";
        $code = 200;
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
           
           'no_meja'=>'required',
           'id_makanan'=>'required'

        ]);

        if ($validator->fails()) {
            $response = [
                'message'=>$validator->errors()->first(),
                'result'=>null,
                'code'=>422
            ];
            return response()->json($response, $response['code']);
        }

        $listPesanan = Pesanan::max('no_pesanan');
        $val = substr($listPesanan, -3);
        $nomor = str_pad(intval($val) + 1, strlen($val), '0', STR_PAD_LEFT);
        $noPesanan = 'ABC'.date('dmY').'-'.$nomor;

        $makanan = Makanan::find($request->id_makanan)->first();


        $pesanan = Pesanan::create([
            'no_pesanan' => $noPesanan,
            'no_meja'=>$request->no_meja,
            'id_makanan'=>$request->id_makanan,
            'jumlah'=>$request->jumlah,
            'total_bayar'=> $makanan->harga * $request->jumlah
        ]);

       
        statusPesanan::create([
            'id_pesanan' => $pesanan->id,
            // 'total_bayar'=> 
        ]);
       

        $pesan = 'sukses';
        $code =200; 

        $out = [
            "message"=>$pesan,
            "result"=>null,
            "code"=>$code
        ];

        return response()->json($out, $out['code']);

    }

    public function listPesananAktif(Request $request)
    {
        $pesan = 'Data Tidak ada';
        $code = 404;

        $sortByField = 'created_at';
        $sortType='desc';
        

        $pesanan =  Pesanan::whereHas('Pesanan', function($q) use($request){
            $q->where("status","=",'aktif');
        });

       
        $data = $pesanan->paginate(10);

        if($data){
            
            $pesan = "sukses";
            $code = 200;
        }

        $out = [
            "message"=>$pesan,
            "result"=>$data,
            "code"=>$code
        ];

        return response()->json($out, $out['code']);
    }

    public function updatePesanan(Request $request, $id)
    { 
        $pesan = 'gagal';
        $code = 404;

         $validator = Validator::make($request->all(), [
            
            'id_makanan'=>'required',
            'jumlah'=>'required',
            
        ]);

        if ($validator->fails()) {
            $response = [
                'message'=>$validator->errors()->first(),
                'result'=>null,
                'code'=>422
            ];
            return response()->json($response, $response['code']);
        }

        $getPesanan = Pesanan::find($id);
        
        $makanan = Makanan::find($request->id_makanan);

        if($getPesanan){

            $getPesanan->update([
                'id_makanan'=>$request->id_makanan,
                'jumlah'=>$request->jumlah,
                'total_bayar'=> $request->jumlah * $makanan->harga,
               
            ]);

     
            $pesan = 'Sukses';
            $code =200; 
        }

        $out = [
            "message"=>$pesan,
            "result"=>null,
            "code"=>$code
        ];

        return response()->json($out, $out['code']);
    }

    public function updateStatusPesanan(Request $request, $id_pesanan)
    {
        $pesan = 'gagal';
        $code = 404;

         $validator = Validator::make($request->all(), [
            
            'status'=>'required',
            
        ]);

        if ($validator->fails()) {
            $response = [
                'message'=>$validator->errors()->first(),
                'result'=>null,
                'code'=>422
            ];
            return response()->json($response, $response['code']);
        }

        $statusPesanan = statusPesanan::where('id_pesanan',$id_pesanan)->first();
        
        // $makanan = Makanan::find($request->id_makanan);

        if($statusPesanan){

            $statusPesanan->update([
                'status'=>$request->status
               
            ]);

     
            $pesan = 'Sukses';
            $code =200; 
        }

        $out = [
            "message"=>$pesan,
            "result"=>null,
            "code"=>$code
        ];

        return response()->json($out, $out['code']);
    }

    public function reportPesanan()
    {
        $pesan = 'Data Tidak ada';
        $code = 404;

        $data =  Pesanan::whereHas('Pesanan', function($q) {
            $q->where("status","=","non aktif");
        })->get();

      
        $cetakPdf = PDF::loadview('reportPesanan', compact(['data']));
        return $cetakPdf->stream();

    }
}