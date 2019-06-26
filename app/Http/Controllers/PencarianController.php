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
                if(isset($request->harga)){
                    $harga = $request->harga == 'murah' ? 'asc' : 'desc' ;
                    $hasil = Produk::where('nama_produk','like','%'.$request->q.'%')->with(['penjual','display'])->orderBy('harga',$harga)->paginate('15');
                } else {
                    $hasil = Produk::where('nama_produk','like','%'.$request->q.'%')->with(['penjual','display'])->orderBy('nama_produk')->paginate('15');                    
                }
                break;
            case 'penjual':
                if(isset($request->q)){
                    $hasil = Penjual::where('nama_toko','like','%'.$request->q.'%')->orderBy('nama_toko','asc')->paginate('15');
                } else{
                    $hasil = Penjual::inRandomOrder()->paginate('15');
                }
                break;
        }
        return view('pencarian',compact('hasil'));
    }
}
