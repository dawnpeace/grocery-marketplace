<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Produk;
use App\Item;

class ProdukPolicy
{
    use HandlesAuthorization;

    public function edit(User $user,Produk $produk)
    {
        return $user->penjual->id == $produk->penjual_id;
    }

    public function update(User $user,Produk $produk)
    {
        return $user->penjual->id == $produk->penjual_id;
    }

    public function delete(User $user,Produk $produk)
    {
        $item = Item::where('produk_id',$produk->id)->count();
        if($item){
            return false;
        } else {
            return $user->penjual->id == $produk->penjual_id;
        }
    }
}
