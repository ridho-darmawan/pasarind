<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUuid;

class User extends Model
{
    use UsesUuid;
    protected $table="user";
    protected $guarded="uuid";
    protected $primaryKey="uuid";
    protected $fillable = ['nama','password','email','no_hp','alamat','role','foto','foto_ktp','tanggal_lahir'];
    protected $hidden = ['password'];
}