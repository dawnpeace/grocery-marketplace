<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\Register\DriverRequest;
use App\Http\Requests\Register\PembeliRequest;
use App\Http\Requests\Register\PenjualRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Enums\UserLevel;
use App\Pasar;
use App\User;

class CustomRegisterController extends Controller
{
    public function buat()
    {
        $pasar = Pasar::all();
        return view('auth.daftar-registrasi',compact('pasar'));
    }

    public function index()
    {
        $pasar = Pasar::all();
        return view('auth.custom-register',compact('pasar'));
    }
    
    public function simpanDriver(DriverRequest $request)
    {
        $request['password'] = Hash::make($request->password);  
        $namaberkasfoto =  uniqid().".".$request->file('foto_profil')->extension();
        $namaberkasfotosim = uniqid().".".$request->file('foto_sim')->extension();
        DB::transaction(function() use ($request,$namaberkasfoto,$namaberkasfotosim){
            $array = [
                'nama' => $request->nama,
                'password' => $request->password,
                'email' => $request->email,
                'username' => $request->username,
                'password' => $request->password,
                'plat_nomor_kendaraan' => $request->plat_nomor_kendaraan,
                'kota' => $request->kota,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'nomor_sim' => $request->nomor_sim,
                'jenis' => UserLevel::DRIVER,
                'foto_profil' => $namaberkasfoto,
                'foto_sim' => $namaberkasfotosim
            ];
            $userDriver = User::create($array);
            $userDriver->driver()->create($array);
            $request->file('foto_profil')->storeAs('foto_profil',$namaberkasfoto,'public');
            $request->file('foto_sim')->storeAs('foto_sim',$namaberkasfotosim,'public');
        });

        return redirect()->route('login')->with("success","Akun Anda berhasil diajukan. Mohon tunggu maksimal 2 x 24 jam sebelum akun anda dapat digunakan");
    }

    public function simpanPenjual(PenjualRequest $request)
    {
        $request['jenis'] = UserLevel::PENJUAL;
        $request['password'] = Hash::make($request->password);
        DB::transaction(function() use ($request){
            if($request->hasFile('foto_profil')){
                $namaberkasfoto = uniqid().".".$request->file('foto_profil')->extension();
                $request->file('foto_profil')->storeAs('foto_profil',$namaberkasfoto,'public');
            } else {
                $namaberkasfoto = null;
            }
            $array = [
                'nama' => $request->nama,
                'password' => $request->password,
                'email' => $request->email,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'kota' => $request->kota,
                'nama_toko' => $request->nama_toko,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'jenis' => UserLevel::PENJUAL,
                'foto_profil' => $namaberkasfoto,
                'pasar_id' => $request->pasar_id
            ];
            $userPenjual = User::create($array);
            $penjual = $userPenjual->penjual()->create($array);
        });        
        session()->flash('success',"Akun Anda berhasil diajukan. Mohon tunggu maksimal 2 x 24 jam sebelum akun anda dapat digunakan");
        // return redirect()->route('login')->with("success","Akun Anda berhasil diajukan. Mohon tunggu maksimal 2 x 24 jam sebelum akun anda dapat digunakan");
    }

    public function simpanPembeli(PembeliRequest $request)
    {
        $request['password'] = Hash::make($request->password);
        DB::transaction(function() use ($request){
            if($request->hasFile('foto_profil')){
                $namaberkasfoto = uniqid().".".$request->file('foto_profil')->extension();
                $request->file('foto_profil')->storeAs('foto_profil',$namaberkasfoto,'public');
            } else {
                $namaberkasfoto = null;
            }
            $array = [
                'nama' => $request->nama,
                'password' => $request->password,
                'email' => $request->email,
                'username' => $request->username,
                'password' => $request->password,
                'kota' => $request->kota,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'jenis' => UserLevel::PEMBELI,
                'foto_profil' => $namaberkasfoto,
            ];
            $userPembeli = User::create($array);
            $pembeli = $userPembeli->pembeli()->create($array);
        });
        session()->flash('success',"Akun Anda berhasil diajukan. Mohon tunggu maksimal 2 x 24 jam sebelum akun anda dapat digunakan");
        // return redirect()->route('login')->with("success","Akun Anda berhasil diajukan. Mohon tunggu maksimal 2 x 24 jam sebelum akun anda dapat digunakan");
    }
}
