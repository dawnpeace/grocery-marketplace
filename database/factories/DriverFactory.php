<?php

use Faker\Generator as Faker;

$factory->define(App\Driver::class, function (Faker $faker) {
    return [
        "plat_nomor_kendaraan" => $faker->unique()->regexify('/^[A-Z]{1,2}[0-9]{1,3}[A-Z]{1,3}/'),
        "no_telp" => "+628".$faker->numberBetween(1000000,9999999),
        "kota" => $faker->city,
        'alamat' => $faker->address,
        'telah_diverifikasi' => $faker->randomElement([0,1]),
        'nomor_sim' => uniqid()
    ];
});
