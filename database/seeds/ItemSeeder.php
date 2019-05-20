<?php

use Illuminate\Database\Seeder;
use App\Keranjang;
use App\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keranjang = Keranjang::with(['penjual'=>function($query){
            $query->with(['produk']);
        }])->get();
        foreach($keranjang as $cart){
            $var = [];
            $produk = $cart->penjual->produk->random(10);
            foreach($produk as $belanjaan){
                $itemKeranjang = new App\Item([
                    'keranjang_id'=>$cart->id,
                    'produk_id'=> $belanjaan->id,
                    'jumlah' => rand(1,$belanjaan->jumlah_tersedia),
                    'harga' => $belanjaan->harga,
                ]);
                $var[] = $itemKeranjang;
            }
            
            $cart->belanjaan()->saveMany($var);
        }
    }
}
