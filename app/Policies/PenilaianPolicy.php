<?php

namespace App\Policies;

use App\Enums\UserLevel;
use App\User;
use App\Item;
use Illuminate\Auth\Access\HandlesAuthorization;

class PenilaianPolicy
{
    use HandlesAuthorization;

    public function berikanPenilaian(User $user, Item $item)
    {
        if($user->jenis === UserLevel::PEMBELI)
        {
            if($user->pembeli->id === $item->keranjang->pembeli_id)
            {
                return is_null($item->review);
            }
        }
        return false;
    }
}
