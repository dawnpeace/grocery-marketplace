<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(PasarSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProdukSeeder::class);
        $this->call(KeranjangSeeder::class);
        $this->call(ItemSeeder::class);
    }
}
