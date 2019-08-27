<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Keranjang extends Model
{
    protected $table = "tb_keranjang_belanja";
    protected $fillable = ["penjual_id","telah_diselesaikan","telah_diambil_driver","transaksi_selesai","tanggal_checkout","tanggal_dijemput","tanggal_diproses","biaya_antar","metode_pembayaran","nomor_identifikasi", "metode_pengiriman"];

    public function belanjaan()
    {
        return $this->hasMany("App\Item");
    }

    public function checkout($metodePembayaran, $nomorIdentifikasi, $metodePengiriman)
    {
        $this->update([
            'telah_diselesaikan' => 1,
            'tanggal_checkout' => now(),
            'metode_pembayaran' => $metodePembayaran,
            'nomor_identifikasi' => $nomorIdentifikasi,
            'metode_pengiriman' => $metodePengiriman
        ]);
    }

    public function penjual()
    {
        return $this->belongsTo('App\Penjual');
    }

    public function pembeli()
    {
        return $this->belongsTo('App\Pembeli');
    }
    
    public function antar()
    {
        $this->status()->update([
            "sedang_diantarkan" => 1
        ]);
    }

    public function tanggalPemesanan()
    {
        $date = Carbon::parse($this->created_at);
        return $date->isoFormat('D MMM YYYY');
    }


    public function proses()
    {
        $this->telah_diproses = 1;
        $this->tanggal_diproses = now();
        $this->save();
    }

    public function ambilPesanan()
    {
        $this->telah_diambil_driver = 1;
        $this->tanggal_dijemput = now();
        $this->save();
        return $this;
    }

    public function status()
    {
        return $this->hasOne('App\Delivery');
    }

    public function telahDibayarkan()
    {
        $this->status()->update([
            'telah_dibayarkan' => 1
        ]);
    }

    public function getPengantaran()
    {
        switch($this->metode_pengiriman)
        {
            case 'gojek':
                return "Jasa GOJEK";
            case 'grab':
                return "Jasa GRAB";
            case 'jemput':
                return "Pelanggan melakukan Penjemputan Sendiri";
            case 'bujangkurir';
                return "Jasa Bujang Kurir";
        }
    }

}
