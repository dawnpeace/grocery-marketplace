<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjual;
use App\Driver;


class ProfilController extends Controller
{
    public function penjual(Penjual $penjual)
    {
        $penjual->load([
            'user',
            'pasar',
            'produk' => function($query){
                $query->where('tersedia',1)->orderBy('nama_produk','asc')->with(['display']);
            }
        ]);
        return view('profile-penjual',compact('penjual'));
    }

    public function driver(Driver $driver)
    {
        $driver->load(['user']);
        return view('profile-driver',compact('driver'));
    }

}
