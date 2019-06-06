<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BekerjaPolicy
{
    use HandlesAuthorization;

    // Policy untuk status bekerja driver
    public function index(User $user)
    {
        return !$user->driver->sedang_bekerja;
    }
}
