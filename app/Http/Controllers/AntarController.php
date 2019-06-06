<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Keranjang;
use Illuminate\Support\Facades\Auth;
use App\Delivery;

class AntarController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load(['driver']);
        $keranjang =  Keranjang::where('telah_diselesaikan',1)
            ->where('telah_diproses',1)
            ->where('telah_diambil_driver',0)
            ->orderBy('created_at','asc')
            ->with([
                'pembeli' => function($query){
                    $query->with(['user']);
                },
                'penjual' => function($query){
                    $query->with(['user']);
                },
                'status'
            ])
            ->paginate(15);
        return view('users.driver.dashboard',compact('keranjang'));
    }

    public function detailPesanan(Keranjang $keranjang)
    {
        $user = Auth::user()->load(['driver']);
        if(!$keranjang->telah_diselesaikan && !$keranjang->telah_diproses && is_null($keranjang->status->driver_id) && $user->driver->sedang_bekerja)
        {
            return abort(404);
        }

        $keranjang->load([
            'belanjaan' => function($query){
                $query->with(['produk']);
            },
            'pembeli' => function($query){
                $query->with(['user']);
            },
            'penjual' => function($query){
                $query->with(['user','pasar']);

            }
        ]);
        return view('users.driver.detail-pesanan',['keranjang'=>$keranjang]);
    }

    public function ambilPesanan(Keranjang $keranjang)
    {
        if(!$keranjang->telah_diselesaikan && !$keranjang->telah_diproses && !$keranjang->telah_diambil_driver)
        {
            return abort(404);
        }
        
        $user = Auth::user()->load(['driver']);
        $user->driver->gantiStatusBekerja();
        $keranjang->ambilPesanan();
        $keranjang->status->update(['driver_id'=>$user->driver->id]);
        
        return redirect()->route('driver.dashboard')->with('success','Pesanan berhasil diambil, Selamat Bekerja');
    }
}
