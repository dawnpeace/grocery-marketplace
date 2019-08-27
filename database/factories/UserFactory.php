<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserLevel;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {

    $username = $faker->unique()->username;
    $level_pool = collect(UserLevel::LEVELS)->except([UserLevel::SUPERADMIN,UserLevel::DRIVER])->keys();

    return [
        'username' => $username,
        'nama' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'jenis' => $faker->randomElement($level_pool),
        'email_verified_at' => now(),
        'password' => Hash::make($username),
    ];
});
