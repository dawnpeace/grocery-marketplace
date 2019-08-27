<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'tb_belanjaan';
    protected $fillable = ['jumlah','harga','keranjang_id','produk_id'];


    public function keranjang()
    {
        return $this->belongsTo('App\Keranjang');
    }

    public function produk()
    {
        return $this->belongsTo('App\Produk');
    }

    public function review()
    {
        return $this->hasOne('App\Review');
    }
}
