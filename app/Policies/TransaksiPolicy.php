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
        if(!is_null($keranjang->status) && !$keranjang->transaksi_selesai){
            return $keranjang->status->telah_dibayarkan && $keranjang->status->sedang_diantarkan;
        } else {
            return false;
        }
    }
}
