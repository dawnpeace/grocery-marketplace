<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Http\Requests\FotoProdukRequest;
use App\FotoProduk;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function create(Produk $produk)
    {
        $this->authorize('PhotoCreate',$produk);
        $galeri = $produk->load(['gallery'])->gallery;
        return view('users.penjual.galeri',compact('galeri'));
    }

    public function store(FotoProdukRequest $request, Produk $produk)
    {
        $this->authorize('PhotoStore',$produk);
        $fileName = uniqid(now()).".".$request->file('foto_produk')->extension();
        $request->file('foto_produk')->storeAs('foto_produk',$fileName,'public');
        $produk->gallery()->create(['foto_produk'=>$fileName]);
        return redirect()->back()->with('success','Foto Berhasil di Upload');
    }

    public function edit(FotoProduk $fotoproduk)
    {
        $this->authorize('PhotoEdit',$fotoproduk);
        return view('users.penjual.edit-fotoproduk',compact('fotoproduk'));
    }

    public function update(FotoProdukRequest $request, FotoProduk $fotoproduk)
    {
        $this->authorize('PhotoUpdate',$fotoproduk);
        $file = $request->file('foto_produk');
        $filename = uniqid(now().'_').$file->extension();
        $fotoproduk->updateFoto($filename);
        $file->storeAs('foto_produk',$filename,'public');
        
        return redirect()->back()->with("success","Foto berhasil dirubah");
    }

    public function delete(FotoProduk $fotoproduk)
    {
        $this->authorize('PhotoDelete',$fotoproduk);
        Storage::disk('public')->delete("foto_produk/".$fotoproduk->foto_produk);
        $fotoproduk->delete();
        return redirect()->back()->with('success','Foto Berhasil dihapus !');
    }
}
