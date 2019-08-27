<?php

use Illuminate\Database\Seeder;
use App\Enums\UserLevel;
use App\Pasar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pasar = Pasar::all();
        DB::transaction(function() use ($pasar) {
            factory(App\User::class, 300)
                ->create()
                ->each(function($user) use ($pasar) {
                    switch($user->jenis)
                    {
                        case UserLevel::PENJUAL:
                            $user->penjual()->save(factory(App\Penjual::class)->make(["pasar_id"=> $pasar->random(1)->first()->id]));
                            break;
                        // case UserLevel::DRIVER:
                        //     $user->driver()->save(factory(App\Driver::class)->make());
                        //     break;
                        case UserLevel::PEMBELI:
                            $user->pembeli()->save(factory(App\Pembeli::class)->make());
                            break;
                    }
                });
        });
    }
}
