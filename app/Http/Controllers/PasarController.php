<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pasar;
use App\Http\Requests\PasarRequest;
use App\Http\Requests\Edit\PasarRequest as EditRequest;
use Illuminate\Support\Facades\Storage;

class PasarController extends Controller
{
    public function index()
    {
        $pasar = Pasar::with(['pedagang'])->get();
        return view('users.admin.daftar-pasar',compact('pasar'));
    }

    public function create()
    {
        return view('users.admin.tambah-pasar');
    }

    public function store(PasarRequest $request)
    {
        $gambar = $request->file('foto_pasar');
        $ext = $gambar->extension();
        $foto_pasar = uniqid('pasar-').".".$ext;
        $gambar->storeAs('foto_pasar',$foto_pasar,'public');
        $pasar = Pasar::create([
            "nama_pasar" => $request->nama_pasar,
            "alamat" => $request->alamat,
            "foto_pasar" => $foto_pasar,
        ]);
        return redirect()->route('admin.manajemen.pasar')->with('success','Pasar berhasil ditambahkan.');
    }

    public function edit(Pasar $pasar)
    {
        return view('users.admin.edit-pasar',compact('pasar'));
    }

    public function update(Pasar $pasar, EditRequest $request)
    {
        if($request->has('foto_pasar')){
            $gambar = $request->file('foto_pasar');
            $ext = $gambar->extension();
            $foto_pasar = explode('.',$pasar->foto_pasar)[0].".".$ext;
            Storage::disk('public')->delete('foto_pasar/'.$pasar->foto_pasar);
            $gambar->storeAs('foto_pasar',$foto_pasar,'public');
        }

        $pasar->update([
            'nama_pasar' => $request->nama_pasar,
            'alamat' => $request->alamat,
            'foto_pasar' => $request->has('foto_pasar') ? $foto_pasar : $pasar->foto_pasar
        ]);

        return redirect()->back()->with('success','Data Pasar berhasil diperbaharui.');
    }

    public function delete(Pasar $pasar)
    {
        $this->authorize('PasarDelete',$pasar);
        Storage::disk('public')->delete('foto_pasar/'.$pasar->foto_pasar);
        $pasar->delete();
        return redirect()->back()->with('success','Pasar berhasil dihapus.');
    }
    
}
