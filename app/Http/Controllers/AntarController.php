<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Keranjang;
use Illuminate\Support\Facades\Auth;
use App\Delivery;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AntarController extends Controller
{
    public function index()
    {
        if(!Gate::allows('driver')){
            return redirect('/')->with('warning','Akun anda belum diverifikasi pihak Admin.');            
        }
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

        
        return view('users.driver.dashboard',compact(['keranjang','user']));
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

        DB::transaction(function() use($keranjang){
            $user = Auth::user()->load(['driver']);
            $user->driver->update(['sedang_bekerja'=>1,'keranjang_id'=>$keranjang->id]);
            $keranjang->update(['telah_diambil_driver'=>1]);
            $keranjang->status->update(['driver_id'=>$user->driver->id]);
            $keranjang->load(['status']);
        });
        
        return redirect()->route('driver.dashboard')->with('success','Pesanan berhasil diambil, Selamat Bekerja');
    }

    public function transaksiSelesai(Keranjang $keranjang)
    {
        $this->authorize('SelesaikanTransaksi',$keranjang);
        $keranjang->load(['status']);   
        $keranjang->update(['transaksi_selesai'=>1]);
        $keranjang->status->driver->selesaiBekerja();
        return redirect()->back()->with('success','Transaksi telah diselesaikan. Terima kasih telah beberbelanja di Dapurpedia !');
    }
}
