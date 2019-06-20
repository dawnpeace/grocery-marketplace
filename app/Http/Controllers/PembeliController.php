<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Edit\PembeliRequest;
use App\Http\Requests\Profil\PembeliRequest as ProfilPembeliRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use App\Pembeli;
use Illuminate\Support\Facades\Auth;

class PembeliController extends Controller
{
    public function edit($id)
    {
        $pembeli = Pembeli::findOrFail($id)->load(['user']);
        return view('users.admin.profile-pembeli',["pembeli"=>$pembeli]);
    }

    public function update(PembeliRequest $request,$id)
    {   
        $pembeli = Pembeli::findOrFail($id)->load(['user']);
        $reqArray = empty($request->password) ? $request->except('password') : $request->all();

        DB::transaction(function () use ($request, $reqArray, $pembeli){
            $reqArray['password'] = Hash::make($request['password']);
            if(!empty($request->file('foto_profil')))
            {
                $reqArray['foto_profil'] = uniqid().'.'.$request->file('foto_profil')->extension();
                if(!empty($pembeli->foto_profil))
                {
                    Storage::disk('public')->delete('foto_profil/'.$pembeli->foto_profil);
                }
                $request->file('foto_profil')->storeAs("foto_profil",$reqArray['foto_profil'],'public');
            }
            $pembeli->update($reqArray);
            $pembeli->user()->update($reqArray);
        });

        return redirect()->back()->with('success',"Profil ". $pembeli->user->nama." berhasil diperbaharui !");
    }

    public function editProfil()
    {
        $user = Auth::user()->load(['pembeli']);
        if(!Gate::allows('pembeli')){
            return redirect('/')->with('warning','Akun anda belum diverifikasi pihak Admin.');
        }
        return view('users.pembeli.profil-saya',compact('user'));

    }

    public function updateProfil(ProfilPembeliRequest $request)
    {
        $user = Auth::user();
        $arrUser = [
            "nama" => $request->nama,
            "email" => $request->email,
        ];
        if(!empty($request->password))
        {
            if(Hash::check($request->password_lama,$user->password)){
                $arrUser['password'] = Hash::make($request->password);
            } else {
                return redirect()->back()->with("error","Password Lama Tidak sesuai");
            }
        }
        $user->update($arrUser);
        $arrProfilPembeli = [
            "deskripsi" => $request->deskripsi,
            "no_telp" => $request->no_telp,
            "kota" => $request->kota,
            "alamat" => $request->alamat,
        ];
        if($request->hasFile('foto_profil'))
        {
            Storage::disk('public')->delete('foto_profil/'.$user->pembeli->foto_profil);            
            $filename = uniqid().$request->file('foto_profil')->extension();
            $arrProfilPembeli["foto_profil"] = $filename;
            $request->file('foto_profil')->storeAs('foto_profil',$filename,'public');
        }
        $user->pembeli->update($arrProfilPembeli);
        return redirect()->back()->with("success","Profil anda berhasil diperbaharui !");
    }

}
