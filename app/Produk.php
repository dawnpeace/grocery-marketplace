<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Produk extends Model
{
    protected $table = 'tb_produk';
    protected $fillable = ['nama_produk','jumlah_tersedia','harga','satuan_unit','deskripsi'];

    public function penjual()
    {
        return $this->belongsTo('App\Penjual');
    }

    public function harga()
    {
        return 'Rp. '.number_format($this->harga,0,',','.');
    }

    public function jumlah()
    {
        return $this->jumlah_tersedia." ".ucfirst(strtolower($this->satuan_unit));
    }

    public function gallery()
    {
        return $this->hasMany('App\FotoProduk');
    }

    public function display()
    {
        return $this->hasOne('App\FotoProduk');
    }

    public function items()
    {
        return $this->hasMany('App\Item','produk_id');
    }

    public function item()
    {
        return $this->hasOne('App\Item');
    }

    public function deskripsi()
    {
        return nl2br($this->deskripsi);
    }

    public function lessDeskripsi()
    {
        return substr($this->deskripsi,0,25)."..";
    }

    public function gantiKetersediaan()
    {
        $this->tersedia = $this->tersedia ? 0 : 1;
        $this->save();
        return $this;
    }

    public function deleteGallery()
    {
        foreach($this->gallery as $foto)
        {
            Storage::disk('public')->delete('foto_produk/'.$foto->foto_produk);
        }
        $this->gallery()->delete();
        return $this;
    }

    public function penilaian()
    {
        return $this->hasMany('App\Review');
    }
}
