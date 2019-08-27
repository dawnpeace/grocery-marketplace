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
        $produkMurah = Produk::orderBy('harga','asc')->limit(4)->with(['display','penjual'])->get();
        return view('dashboard',compact(['daftarPasar','produkMurah']));
    }

    public function daftarProduk(Pasar $pasar)
    {
        $penjual = Penjual::where('pasar_id',$pasar->id)->get();
        $produk = Produk::whereIn('penjual_id',$penjual->pluck('id'))->orderBy('nama_produk','asc')->with(['penjual','display'])->paginate('16');
        return view('produk',['produk'=>$produk, 'pasar'=>$pasar]);
    }

    public function lihatProduk(Produk $produk)
    {
        $produk->load([
            'penjual',
            'gallery',
            'penilaian' => function($query){
                $query->with('item.keranjang.pembeli.user')->inRandomOrder()->limit(3);
            }
        ]);
        $ratingProduk = $produk->penilaian()->selectRaw('AVG(rating) as average_rate ')->get();
        $penjual = $produk->penjual->load(['produk'=>function($query) use ($produk){
            $query->where('id','<>',$produk->id)->inRandomOrder()->limit(12)->with(['display']);
        },'user','pasar']);
        return view('detail-produk',['produk'=>$produk, 'penjual'=>$penjual, 'nilaiProduk' => $ratingProduk[0]->average_rate]);
    }
}
