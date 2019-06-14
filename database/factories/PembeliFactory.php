<?php

use Faker\Generator as Faker;

$factory->define(App\Pembeli::class, function (Faker $faker) {
    return [
        "kota" => $faker->city,
        "no_telp" => "+628".$faker->numberBetween(1000000,9999999),
        "alamat" => $faker->address,
        "telah_diverifikasi" => $faker->randomElement([0,1]),
    ];
});
