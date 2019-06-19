<?php

namespace App\Policies;

use App\User;
use App\Keranjang;
use Illuminate\Auth\Access\HandlesAuthorization;

class BekerjaPolicy
{
    use HandlesAuthorization;

    // Policy untuk status bekerja driver
    public function bekerja(User $user)
    {
        return $user->driver->sedang_bekerja || $user->driver->keranjang_id;
    }

    public function tidakBekerja(User $user)
    {
        return !$user->driver->sedang_bekerja && is_null($user->driver->keranjang_id);
    }

    public function pekerjaanSelesai(User $user,Keranjang $keranjang)
    {
        return $keranjang->status->telah_dijemput && !$keranjang->status->telah_sampai;
    }
}
