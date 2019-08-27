<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use App\Keranjang;
use Illuminate\Support\Facades\Gate;

class ReviewController extends Controller
{
    public function index()
    {
        $keranjang = Keranjang::query()
            ->select('id','created_at')
            ->where('transaksi_selesai',1)
            ->with([
                'belanjaan' => function($query){
                    $query->with([
                        'produk' => function($query){
                            $query->with('display');
                        },
                        'review'
                    ]);
                },
            ])
            ->orderBy('created_at','DESC')
            ->get();
            
        return view('users.pembeli.penilaian-saya',compact('keranjang'));
    }

    public function show(Item $item)
    {
        $item->load(['review','produk.display','keranjang']);
        if(!Gate::allows('BeriPenilaian',$item))
        {
            return abort(404);
        }
        return view('users.pembeli.penilaian-barang',compact('item'));
    }

    public function store(Item $item, Request $request)
    {
        if(!Gate::allows('BeriPenilaian',$item))
        {
            return abort(404);
        }
        $request->validate([
            'penilaian' => 'required|integer|between:1,5',
            'review' => 'required|string'
        ]);
        
        $item->review()->create([
            "review" => $request->review,
            "rating" => $request->penilaian,
            "produk_id" => $item->produk_id
        ]);
        return redirect()->route('review.index')->with('success','Penilaian berhasil diberikan. Terima kasih telah berpartisipasi');
    }
}
