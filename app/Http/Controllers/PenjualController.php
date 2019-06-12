<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjual;
use App\Http\Requests\Edit\PenjualRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Profil\PenjualRequest as ProfilPenjualRequest;
use Illuminate\Support\Facades\Hash;

class PenjualController extends Controller
{
    public function edit($id)
    {
        $penjual = Penjual::findOrFail($id)->load(['user']);
        return view('users.admin.profile-penjual',['penjual'=>$penjual]);
    }

    public function update(PenjualRequest $request,$id)
    {
        $penjual = Penjual::findOrFail($id)->load(["user"]);
        $reqArray = empty($request->password) ? $request->except('password') : $request->all();
        DB::transaction(function() use($request,$reqArray,$penjual){
            $reqArray['password'] = Hash::make($request['password']);
            if(!empty($request->file('foto_profil')))
            {
                $reqArray['foto_profil'] = uniqid().'.'.$request->file('foto_profil')->extension();
                if(!empty($penjual->foto_profil))
                {
                    Storage::disk('public')->delete('foto_profil/'.$penjual->foto_profil);
                }
                $request->file('foto_profil')->storeAs("foto_profil",$reqArray['foto_profil'],'public');
            }
            $penjual->update($reqArray);
            $penjual->user()->update($reqArray);
        });
        return redirect()->back()->with('success',"Profil ". $penjual->user->nama." berhasil diperbaharui !");
    }

    public function editProfil()
    {
        $user = Auth::user()->load(['penjual']);
        return view('users.penjual.profil-saya',compact('user'));
    }

    public function updateProfil(ProfilPenjualRequest $request)
    {
        $user = Auth::user()->load(['penjual']);
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
        $arrProfilPenjual = [
            "deskripsi" => $request->deskripsi,
            "no_telp" => $request->no_telp,
            "kota" => $request->kota,
            "nama_toko" => $request->nama_toko,
            "alamat" => $request->alamat,
        ];
        if($request->hasFile('foto_profil'))
        {
            $filename = empty($user->penjual->foto_profil) ? uniqid().'.'.$request->file('foto_profil')->extension() : explode(".",$user->penjual->foto_profil)[0].'.'.$request->file('foto_profile');
            $request->file('foto')->storeAs('foto_profil',$filename,'public');
            $arrProfilPenjual["foto_profil"] = $filename;
        }
        $user->penjual->update($arrProfilPenjual);
        return redirect()->back()->with("success","Profil anda berhasil diperbaharui !");
    }
}
