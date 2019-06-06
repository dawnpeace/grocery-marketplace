<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Pasar;
use App\Enums\UserLevel;

class PasarPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Pasar $pasar)
    {
        $pasar->load(['pedagang']);
        if($user->jenis == UserLevel::SUPERADMIN){
            if(empty($pasar->pedagang)){
                return true;
            }
        }
        return false;
    }

}
