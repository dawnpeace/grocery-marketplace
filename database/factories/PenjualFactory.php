<?php

use Faker\Generator as Faker;

$factory->define(App\Penjual::class, function (Faker $faker) {
    return [
        "kota" => $faker->city,
        "nama_toko" => "Toko ".$faker->city,
        "no_telp" => "+628".$faker->numberBetween(1000000,9999999),
        "alamat" => $faker->address,
        "deskripsi" => $faker->text('100'),
        "telah_diverifikasi" => $faker->randomElement([0,1]),
    ];
});
