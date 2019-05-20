<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Keranjang extends Model
{
    protected $table = "tb_keranjang_belanja";
    protected $fillable = ["penjual_id","telah_diselesaikan"];

    public function belanjaan()
    {
        return $this->hasMany("App\Item");
    }

    public function checkout()
    {
        $this->update(['telah_diselesaikan'=>1]);
    }

    public function penjual()
    {
        return $this->belongsTo('App\Penjual');
    }

    public function pembeli()
    {
        return $this->belongsTo('App\Pembeli');
    }

    public function tanggalPemesanan()
    {
        $date = Carbon::parse($this->created_at);
        return $date->isoFormat('D MMM YYYY');
    }

    public function proses()
    {
        $this->telah_diproses = 1;
        $this->save();
    }

    public function status()
    {
        return $this->hasOne('App\Delivery');
    }

}
