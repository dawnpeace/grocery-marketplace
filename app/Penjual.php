<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjual extends Model
{
    protected $table = 'tb_penjual';
    protected $fillable = ['kota','alamat','no_telp','foto_profil','pasar_id','nama_toko'];
    protected $hidden = ['telah_diverifikasi'];

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function produk(){
        return $this->hasMany('App\Produk');
    }

    public function urlFoto()
    {
        return empty($this->foto_profil) ? asset('img/default.jpg') : asset('storage/foto_profil/'.$this->foto_profil);
    }

    public function permintaan()
    {
        return $this->hasMany('App\Keranjang');
    }

    public function pasar()
    {
        return $this->belongsTo('App\Pasar');
    }

}
