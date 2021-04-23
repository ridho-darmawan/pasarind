<?php
namespace App;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Makanan extends Model
{
    protected $table="makanan";
    protected $primaryKey="id";
    protected $fillable = ['nama','harga','status'];
}