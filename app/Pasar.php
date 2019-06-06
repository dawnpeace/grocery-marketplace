<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasar extends Model
{
    protected $table = 'tb_pasar';
    protected $fillable = ['nama_pasar','alamat','foto_pasar'];

    public function penjual()
    {
        return $this->hasMany('App\Penjual');
    }

    public function pedagang()
    {
        return $this->hasOne('App\Penjual');
    }

    public function displayUrl()
    {
        return empty($this->foto_pasar) ? asset('img/product.jpg') : asset('storage/foto_pasar/'.$this->foto_pasar);
    }
}
