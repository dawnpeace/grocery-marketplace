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
        return $user->penjual->id == $keranjang->penjual_id && !$keranjang->telah_diproses && !is_null($keranjang->biaya_antar);
    }

    public function lihatPermintaan(User $user, Keranjang $keranjang)
    {
        return $user->penjual->id == $keranjang->penjual_id && !$keranjang->transaksi_selesai;
    }

    public function gantiBiayaAntar(User $user, Keranjang $keranjang)
    {
        if(!is_null($keranjang->status)){
            return !$keranjang->status->telah_dibayarkan;
        }
        return true;
    }

    public function telahDibayar(User $user, Keranjang $keranjang)
    {
        if(!is_null($keranjang->status)){
            return $keranjang->status->telah_dibayarkan;
        }
        return false;
    }

    public function belumDibayar(User $user, Keranjang $keranjang)
    {
        return $user->penjual->id == $keranjang->penjual_id && $keranjang->telah_diproses && !$this->telahDibayar($user,$keranjang);
    }

    public function sedangDiantar(User $user, Keranjang $keranjang)
    {
        if(!is_null($keranjang->status)){
            return $keranjang->status->sedang_diantarkan;
        }
    }

    public function siapDiantar(User $user, Keranjang $keranjang)
    {
        return $this->telahDibayar($user,$keranjang) && !$this->sedangDiantar($user,$keranjang);
    }
}
