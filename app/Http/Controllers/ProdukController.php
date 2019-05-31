<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Produk;
use App\Http\Requests\ProdukRequest;

class ProdukController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load(['penjual']);
         $daftarProduk = Produk::where('penjual_id', $user->penjual->id)
        ->orderBy('nama_produk')
        ->with(['item'])
        ->paginate(5);

        return view('users.penjual.dashboard', ['daftarProduk' => $daftarProduk]);
    }

    public function create()
    {
        return view('users.penjual.tambah-produk');
    }

    public function store(ProdukRequest $request)
    {
        $user = Auth::user()->load(['penjual']);
        $produk = $user->penjual->produk()->create($request->all());
        if($request->has('foto_produk')){
            $fileName = uniqid("foto-").".".$request->file('foto_produk')->extension();
            $request->file('foto_produk')->storeAs('foto_produk',$fileName,'public');
            $produk->gallery()->create(['foto_produk'=>$fileName]);
        }
        return redirect()->back()->with('success','Produk berhasil ditambahkan !');
    }

    public function edit(Produk $produk)
    {
        $this->authorize('ProdukEdit',$produk);
        return view('users.penjual.lihat-produk', compact('produk'));
    }

    public function update(ProdukRequest $request, Produk $produk)
    {
        $this->authorize('ProdukUpdate',$produk);
        $produk->update($request->all());
        return redirect()->back()->with('success', 'Produk ' . $produk->nama_produk . ' berhasil diperbaharui !');
    }

    public function updateKetersediaan(Produk $produk)
    {
        $this->authorize('ProdukUpdate',$produk);
        $produk->gantiKetersediaan();
        return redirect()->back()->with('success','Status produk berhasil diperbaharui.');
<<<<<<< HEAD
    }

    public function delete(Produk $produk)
    {
        $this->authorize('ProdukDelete',$produk);
        $produk->delete();
        return redirect()->back()->with('success','Produk berhasil dihapus.');
=======
>>>>>>> ea32ab5a5f33af24d91c41465a5332e8ad9dafe7
    }
}
