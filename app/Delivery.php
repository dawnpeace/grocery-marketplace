<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = 'tb_status_pengantaran';
    protected $fillable = ['keranjang_id','driver_id','telah_dijemput','telah_sampai','telah_dibayarkan','sedang_diantarkan'];

    public function keranjang()
    {
        return $this->belongsTo('App\Keranjang');
    }

    public function driver()
    {
        return $this->belongsTo('App\Driver');
    }

    public function tampilStatus()
    {
        if(!$this->telah_dibayarkan){
            return "Item Belum dibayar.";
        } else if(!$this->sedang_diantarkan){
            if($this->keranjang->metode_pengiriman == 'jemput'){
                return "Item siap diambil.";
            } else {
                return "Item siap diantarkan.";
            }
        } else if($this->sedang_diantarkan && !$this->telah_sampai){
            return "Item dalam pengantaran";
        } else if($this->telah_sampai){
            return "Item telah sampai ditujuan";
        }
    }
    
}
