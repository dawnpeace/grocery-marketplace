<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    protected $table = 'tb_pembeli';
    protected $fillable = ["kota", "alamat", "no_telp","foto_profil"];
    protected $hidden = ['telah_diverifikasi'];

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function keranjang()
    {
        return $this->hasMany('App\Keranjang');
    }

    public function urlFoto()
    {
        return empty($this->foto_profil) ? asset('img/default.jpg') : asset('storage/foto_profil/'.$this->foto_profil);
    }
}
