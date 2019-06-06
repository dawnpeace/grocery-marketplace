<?php

use Illuminate\Database\Seeder;

class PasarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Pasar::class,8)->create();
    }
}