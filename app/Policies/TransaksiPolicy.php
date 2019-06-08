<?php

namespace App\Policies;

use App\User;
use App\Keranjang;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransaksiPolicy
{
    use HandlesAuthorization;

    public function transaksiSelesai(User $user,Keranjang $keranjang)
    {
        if(!is_null($keranjang->status) || $keranjang->transaksi_selesai){
            return $user->pembeli->id == $keranjang->pembeli_id &&
            $keranjang->telah_diselesaikan && 
            $keranjang->telah_diproses && 
            $keranjang->telah_diambil_driver && 
            $keranjang->status->telah_dijemput && 
            $keranjang->status->telah_sampai;
        } else {
            return false;
        }
    }
}
