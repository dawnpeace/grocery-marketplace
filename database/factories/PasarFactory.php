<?php

use Faker\Generator as Faker;

$factory->define(App\Pasar::class, function (Faker $faker) {

    return [
        "nama_pasar" => "Pasar ".$faker->city,
        "alamat" => $faker->address,
    ];
});
