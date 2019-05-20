<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Keranjang;
use App\Item;
use App\Http\Requests\BelanjaRequest;
use App\Produk;


class ItemController extends Controller
{
    public function tambahKeranjang(BelanjaRequest $request, Produk $produk)
    {
        $this->authorize('ItemStore',$produk);
        $user = Auth::user()->load(['pembeli']);
        $keranjang = Keranjang::where('pembeli_id',$user->pembeli->id)
            ->where('telah_diselesaikan',0)
            ->where('penjual_id',$produk->penjual_id)
            ->with(['belanjaan'])
            ->get();

        if($keranjang->isEmpty()){
            $keranjang = $user->pembeli->keranjang()->save(new Keranjang(['penjual_id'=>$produk->penjual_id]));
        } else {
            $keranjang = $keranjang->first();
        }
        Item::updateOrCreate(
            [
                'produk_id' => $produk->id,
                'keranjang_id' => $keranjang->id
            ],
            [
                'jumlah' => $request->jumlah,
                'harga' => $produk->harga
            ]
        );
        return redirect()->back()->with('success','Item berhasil ditambah !');
    }

    public function hapusItem(Keranjang $keranjang, Item $item)
    {
        $item->delete();
        if(!$keranjang->belanjaan()->count()){
            $keranjang->delete();
            return redirect()->route('keranjang')->with('success','Item berhasil dihapus');
        }
        return redirect()->back()->with('success','Item keranjang berhasil dihapus');
    }

    public function lihatProduk(Produk $produk)
    {
        $produk->load(['penjual'=>function($query){
            $query->with(['user']);
        }]);
        
        $user = Auth::user()->load(['pembeli']);
        $keranjang = Keranjang::where('pembeli_id',$user->pembeli->id)
            ->where('telah_diselesaikan',0)
            ->where('penjual_id',$produk->penjual_id)
            ->first();
        
        $punyaProduk = ["punya_produk"=>false,"jumlah"=>0];

        if(!is_null($keranjang))
        {
            $belanjaan = Item::select('tb_produk.id as produk_id','tb_belanjaan.harga as harga','jumlah',DB::raw('tb_belanjaan.harga * tb_belanjaan.jumlah as sub_total'),'tb_produk.nama_produk','tb_belanjaan.id as item_id','tb_produk.satuan_unit')->join('tb_produk','tb_produk.id','tb_belanjaan.produk_id')->where('keranjang_id',$keranjang->id)->get();
            $filter = $belanjaan->where('produk_id',$produk->id);
            if(!$filter->isEmpty())
            {
                $punyaProduk["punya_produk"] = true;
                $punyaProduk["jumlah"] = $filter->first()->jumlah;
            }
        }
        return view('users.pembeli.tambah-keranjang',['belanjaan'=> $belanjaan ?? [],'produk'=>$produk, 'punyaProduk'=>$punyaProduk]);
    }

}
