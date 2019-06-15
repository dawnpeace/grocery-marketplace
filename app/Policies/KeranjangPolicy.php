<?php

namespace App\Policies;

use App\User;
use App\Keranjang;
use Illuminate\Auth\Access\HandlesAuthorization;

class KeranjangPolicy
{
    use HandlesAuthorization;

    public function diambilDriver(User $user, Keranjang $keranjang)
    {
        if($user->penjual->id == $keranjang->penjual_id){
            if($keranjang->telah_diambil_driver && !$keranjang->status->telah_dijemput){
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function belumCheckout(User $user, Keranjang $keranjang)
    {
        return $user->pembeli->id == $keranjang->pembeli_id && !$keranjang->telah_diselesaikan;
    }
}
