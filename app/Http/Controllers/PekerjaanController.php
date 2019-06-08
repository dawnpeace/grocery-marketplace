<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PekerjaanController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load([
            'driver'=> function($query){
                $query->with([
                    'keranjang'=>function($query){
                        $query->with([
                            'pembeli'=>function($query){
                                $query->with(['user']);
                            },
                            'belanjaan'=>function($query){
                                $query->with(['produk']);
                            },

                    'penjual'=>function($query){
                        $query->with(['pasar']);
                    }]);
                }]);
            }]);
        
        return view('users.driver.pekerjaan-saya',['user' => $user]);

    }

    public function selesaikanPekerjaan()
    {
        $user = Auth::user()->load(['driver'=>function($query){
            $query->with(['keranjang']);
        }]);
        $this->authorize('DapatDiselesaikan',$user->driver->keranjang);
        
        $keranjang = $user->driver->keranjang;
        $keranjang->status->update(['telah_sampai'=>1,'transaksi_selesai'=>1]);
        $user->driver->update(['sedang_bekerja'=>0,'keranjang_id' => null]);

        return redirect()->route('driver.dashboard')->with('success','Pekerjaan telah selesai, Silahkan ambil pekerjaan lain !');
    }

}
