<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FotoProduk extends Model
{
    protected $table ='tb_foto_produk';
    protected $fillable = ['foto_produk'];
    
    public function url()
    {
        return asset('storage/foto_produk/'.$this->foto_produk);
    }

    public function updateFoto($filename)
    {
        Storage::disk('public')->delete("foto_produk/".$this->foto_produk);
        $this->foto_produk = $filename;
        $this->save();
    }

    public function produk()
    {
        return $this->belongsTo('App\Produk');
    }
}
