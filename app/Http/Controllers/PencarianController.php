<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Produk;
use App\Penjual;

class PencarianController extends Controller
{
    public function cari(Request $request)
    {
        $cari = $request->cari == 'penjual'  ? 'penjual' : 'produk';
        $hasil = [];
        switch($cari){
            case 'produk':
                $hasil = Produk::where('nama_produk','like','%'.$request->q.'%')->with(['penjual','display'])->paginate('16');
                break;
            case 'penjual':
                $hasil = Penjual::where('nama_toko','like','%'.$request->q.'%')->paginate('16');
                break;
        }
        return view('pencarian',compact('hasil'));
    }
}
