<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

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
                    'penjual_id' => $keranjang->penjual->id
                ]
            );
            $daftarBelanja->put($key,$subKeranjang);
        }
        
        return view('users.pembeli.keranjang-saya',compact('daftarBelanja'));
    }

    public function detailKeranjang(Keranjang $keranjang)
    {
        if(!Gate::allows('BelumCheckout',$keranjang)){
            return redirect()->route('keranjang');
        }

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

    public function checkoutKeranjang(Request $request, Keranjang $keranjang)
    {
        $this->authorize('BelumCheckout',$keranjang);
        $request->validate([
            "metode_pembayaran" => ["required", Rule::in(["ovo","bca","mandiri","gopay"])],
            "metode_pengiriman" => ["required", Rule::in(["gojek","grab","bujangkurir","jemput"])],
            "nomor_identifikasi" => "required|string"
        ]);
        $keranjang->checkout($request->metode_pembayaran,$request->nomor_identifikasi,$request->metode_pengiriman);
        return redirect()->route('keranjang')->with('success','Transaksi anda telah diselesaikan, menunggu konfirmasi Penjual.');
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
