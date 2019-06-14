<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\UserLevel;
use App\User;
use App\Driver;
use App\Pembeli;
use App\Penjual;



class VerifikasiController extends Controller
{
    public function indexDriver()
    {
        $user = User::join('tb_driver','tb_driver.user_id','users.id')
            ->select('users.*','tb_driver.telah_diverifikasi')
            ->where('jenis','driver')->where('users.nama','like','%'.request('nama').'%')
            ->orderBy('telah_diverifikasi','asc')
            ->orderBy('created_at','desc')
            ->with("driver")
            ->paginate(15);
        return view('users.admin.daftar-driver',["users" => $user]);
    }

    public function indexPembeli()
    {
        $user = User::join('tb_pembeli','users.id','tb_pembeli.user_id')
            ->select('users.*','tb_pembeli.telah_diverifikasi')
            ->where('jenis','pembeli')
            ->where('users.nama','like','%'.request('nama').'%')
            ->with("pembeli")
            ->orderBy('telah_diverifikasi','asc')
            ->orderBy('created_at','desc')
            ->paginate(15);
        return view('users.admin.daftar-pembeli',["users" => $user]);
    }

    public function indexPenjual()
    {
        $user = User::join('tb_penjual','users.id','tb_penjual.user_id')
            ->select('users.*','tb_penjual.telah_diverifikasi')
            ->where('jenis','penjual')
            ->where('users.nama','like','%'.request('nama').'%')
            ->with("penjual")
            ->orderBy('telah_diverifikasi','asc')
            ->orderBy('created_at','desc')
            ->paginate(15);
        return view('users.admin.daftar-penjual',["users" => $user]);
    }

    public function updateDriver($idDriver)
    {
        $driver = Driver::findOrFail($idDriver);
        // toggle status
        $driver->telah_diverifikasi = $driver->telah_diverifikasi ? 0 : 1;
        $driver->save();
        return redirect()->back()->with('info',"Status ". $driver->user->nama ." telah diperbaharui");
    }

    public function updatePembeli($idPembeli)
    {
        $pembeli = Pembeli::findOrFail($idPembeli);
        // toggle status
        $pembeli->telah_diverifikasi = $pembeli->telah_diverifikasi ? 0 : 1;
        $pembeli->save();
        return redirect()->back()->with('info',"Status ". $pembeli->user->nama ." telah diperbaharui");
    }

    public function updatePenjual($idPenjual)
    {
        $penjual = Penjual::findOrFail($idPenjual);
        // toggle status
        $penjual->telah_diverifikasi = $penjual->telah_diverifikasi ? 0 : 1;
        $penjual->save();
        return redirect()->back()->with('info',"Status ". $penjual->user->nama ." telah diperbaharui");
    }
}
