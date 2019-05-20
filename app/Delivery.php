<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = 'tb_status_pengantaran';

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
        if(!$this->telah_dijemput && is_null($this->driver_id)){
            return "Belum menemukan driver.";
        } else if(!$this->telah_dijemput && $this->driver_id){
            return "Menunggu jemputan driver.";
        } else if($this->telah_dijemput && !$this->driver_id){
            return "Item dalam pengantaran";
        } else if($this->telah_sampai){
            return "Item telah sampai ditujuan";
        }
    }
}