<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'tb_driver';
    protected $fillable = ["plat_nomor_kendaraan","kota","alamat","no_telp","foto_profil","foto_sim","nomor_sim","sedang_bekerja","keranjang_id"];
    // protected $hidden = ['telah_diverifikasi'];


    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function urlFoto()
    {
        return empty($this->foto_profil) ? asset('img/default.jpg') : asset('storage/foto_profil/'.$this->foto_profil);
    }

    public function urlSIM()
    {
        return asset('storage/foto_sim/'.$this->foto_sim) ?? '';
    }

    public function gantiStatusBekerja()
    {
        $status = $this->sedang_bekerja ? 0 : 1;
        $this->sedang_bekerja = $status;
        $this->save();
        return $this;
    }

    public function keranjang()
    {
        return $this->belongsTo('App\Keranjang');
    }

    public function selesaiBekerja()
    {
        $this->keranjang_id = null;
        $this->save();
    }

}
