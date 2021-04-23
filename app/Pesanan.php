<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table="pesanan";
    protected $primaryKey="id";
    protected $fillable = ['no_pesanan','no_meja','id_makanan','total_bayar','jumlah'];


    public function Pesanan()
    {
        return $this->belongsTo('App\statusPesanan','id','id_pesanan');
    }

}