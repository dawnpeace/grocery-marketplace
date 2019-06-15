<?php

use Illuminate\Database\Seeder;
use App\Penjual;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $penjual = Penjual::all();
        DB::transaction(function() use ($penjual){
            foreach($penjual as $penj){
                for($i = 0 ; $i < 30 ; $i++){
                    $penj->produk()->save(factory(App\Produk::class)->make());
                }
            }
        });
        
    }
}
