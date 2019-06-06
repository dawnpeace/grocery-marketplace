<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Pasar;
use App\Penjual;

class MainMenuController extends Controller
{
    public function index()
    {
        $daftarPasar = Pasar::all();
        return view('dashboard',compact('daftarPasar'));
    }

    public function daftarProduk(Pasar $pasar)
    {
        $penjual = Penjual::where('pasar_id',$pasar->id)->get();
        $produk = Produk::whereIn('penjual_id',$penjual->pluck('id'))->orderBy('nama_produk','asc')->with(['penjual','display'])->paginate('16');
        return view('produk',['produk'=>$produk, 'pasar'=>$pasar]);
    }

    public function lihatProduk(Produk $produk)
    {
        $produk->load(['penjual','gallery']);
        $penjual = $produk->penjual->load(['produk'=>function($query) use ($produk){
            $query->where('id','<>',$produk->id)->inRandomOrder()->limit(12)->with(['display']);
        },'user','pasar']);
        return view('detail-produk',['produk'=>$produk, 'penjual'=>$penjual]);
    }
}
