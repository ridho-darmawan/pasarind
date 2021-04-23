<?php
namespace App;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class statusPesanan extends Model
{
    protected $table="status_pesanan";
    protected $primaryKey="id";
    protected $fillable = ['id_pesanan','status'];

    // public function Pesanan()
    // {
    //     return $this->belongsTo('App\Pesanan','id_pesanan','id');
    // }

  }