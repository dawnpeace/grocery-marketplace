<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Edit\DriverRequest;
use App\Http\Requests\Profil\DriverRequest as ProfileDriverRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Driver;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    public function edit($id)
    {   
        $driver = Driver::findOrFail($id)->load(['user']);
        return view('users.admin.profile-driver',['driver'=>$driver]);
    }

    public function update(DriverRequest $request,$id)
    {
        $driver = Driver::findOrFail($id)->load(["user"]);
        // get mass assignment array
        $reqArray = empty($request->password) ? $request->except('password') : $request->all();

        DB::transaction(function() use ($request,$reqArray,$driver){
            $reqArray['password'] = Hash::make($request['password']);
            if(!empty($request->file('foto_profil')))
            {
                $reqArray['foto_profil'] = uniqid().'.'.$request->file('foto_profil')->extension();
                if(!empty($driver->foto_profil))
                {
                    Storage::disk('public')->delete('foto_profil/'.$driver->foto_profil);
                }
                $request->file('foto_profil')->storeAs("foto_profil",$reqArray['foto_profil'],'public');
            }
            $driver->update($reqArray);
            $driver->user()->update($reqArray);
        });
        return redirect()->back()->with('success',"Profil ".$driver->user->nama." berhasil diperbaharui !");
    }

    public function editProfil()
    {
        $user = Auth::user()->load(['driver']);
        return view('users.driver.profil-saya',compact('user'));
    }

    public function updateProfil(ProfileDriverRequest $request)
    {
        $user = Auth::user()->load(['driver']);
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
        $arrProfilDriver = [
            "deskripsi" => $request->deskripsi,
            "no_telp" => $request->no_telp,
            "kota" => $request->kota,
            "alamat" => $request->alamat,
        ];
        if($request->hasFile('foto_profil'))
        {
            $filename = empty($user->driver->foto_profil) ? uniqid().'.'.$request->file('foto_profil')->extension() : explode(".",$user->driver->foto_profil)[0].'.'.$request->file('foto_profil')->extension();
            $arrProfilDriver["foto_profil"] = $filename;
            $request->file('foto_profil')->storeAs('foto_profil',$filename,'public');
        }
        $user->driver->update($arrProfilDriver);
        return redirect()->back()->with("success","Profil anda berhasil diperbaharui !");
    }
}
