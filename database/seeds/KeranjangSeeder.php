<?php

use Illuminate\Database\Seeder;
use App\Keranjang;
use App\Pembeli;
use App\Produk;
use Illuminate\Support\Facades\DB;

class KeranjangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produk = Produk::with(['penjual'])->get();
        $buyers = Pembeli::all();
        DB::transaction(function() use ($produk,$buyers){
            foreach($buyers as $pembeli){
                $randProduk = $produk->random();
                $keranjang = new Keranjang(['penjual_id'=>$randProduk->penjual->id]);
                $pembeli->keranjang()->save($keranjang);
            }
        });
    }
}
