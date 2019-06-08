<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Keranjang;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function keranjangSaya()
    {
        $user = Auth::user()->load(['pembeli'=>function($query){
            $query->with(['keranjang'=>function($query){
                $query->where('telah_diselesaikan',0)->with(['belanjaan','penjual'=>function($query){
                    $query->with(['user']);
                }]);
            }]);
        }]);
        $daftarBelanja = collect([]);
        
        foreach($user->pembeli->keranjang as $key => $keranjang)
        {
            $subtotal = 0;
            $jumlahProduk = 0;
            $penjual = $keranjang->penjual->nama_toko;
            foreach($keranjang->belanjaan as $belanjaan)
            {
                $jumlahProduk++;
                $subtotal+=$belanjaan->harga*$belanjaan->jumlah;
            }
            $subKeranjang = collect(
                [
                    'keranjang_id' => $keranjang->id,
                    'nama_toko' => $penjual,
                    'subtotal' => $subtotal,
                    'jumlah_produk' => $jumlahProduk,
                    
                ]
            );
            $daftarBelanja->put($key,$subKeranjang);
        }
        
        return view('users.pembeli.keranjang-saya',compact('daftarBelanja'));
    }

    public function detailKeranjang(Keranjang $keranjang)
    {
        $keranjang->load(['belanjaan'=>function($query){
            $query->with(['produk']);
        }]);
        
        return view('users.pembeli.keranjang',compact('keranjang'));
    }

    public function hapusKeranjang(Keranjang $keranjang)
    {
        $keranjang->belanjaan()->delete();
        $keranjang->delete();
        return redirect()->back()->with('success','Keranjang berhasil dihapus');
    }

    public function checkoutKeranjang(Keranjang $keranjang)
    {
        $keranjang->checkout();
        return redirect()->back()->with('success','Transaksi anda telah diselesaikan, menunggu konfirmasi Penjual.');
    }

    public function lihatTransaksiBerjalan()
    {
        $user = Auth::user()->load(['pembeli']);
        $keranjang = Keranjang::where('pembeli_id',$user->pembeli->id)
            ->where('telah_diselesaikan',1)
            ->where('transaksi_selesai',0)
            ->with([
                'belanjaan'=>function($query){
                    $query->with(['produk']);
                },
                'penjual'=>function($query){
                    $query->with(['user']);
                },
                'status'
            ])
            ->get();
        return view('users.pembeli.keranjang-diproses',compact('keranjang'));
    }

}
