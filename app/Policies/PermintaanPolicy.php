<?php

namespace App\Policies;

use App\User;
use App\Keranjang;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermintaanPolicy
{
    use HandlesAuthorization;

    public function prosesPermintaan(User $user, Keranjang $keranjang)
    {
        return $user->penjual->id == $keranjang->penjual_id && !$keranjang->telah_diproses;
    }

    public function lihatPermintaan(User $user, Keranjang $keranjang)
    {
        return $user->penjual->id == $keranjang->penjual_id && !$keranjang->transaksi_selesai;
    }
}
