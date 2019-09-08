<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Keranjang;

class TransaksiController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('pembeli');
        $keranjang = Keranjang::query()
            ->where('pembeli_id',$user->pembeli->id)
            ->where('transaksi_selesai',1)
            ->with(['penjual','belanjaan.produk'])
            ->orderBy('tanggal_checkout','DESC')
            ->paginate(5);
            
        return view('users.pembeli.transaksi-saya',compact(['user','keranjang']));

    }
}
