<?php

use Faker\Generator as Faker;

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
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Eloquent\Mesin::class, function (Faker $faker) {
    return [
        'nama' => 'Mesin ' . $faker->numberBetween(1,100),
        'ip' => $faker->ipv4,
        'password' => $faker->randomDigit,
        'is_default' => 1
    ];
});

$factory->define(App\Eloquent\MesinUsers::class, function (Faker $faker) {
    return [
        'mesin_id' => 1,
        'nama' => $faker->name,
        'user_id' => $faker->unique()->randomDigit
    ];
});

$factory->define(App\Eloquent\AbsenLog::class, function (Faker $faker) {
    return [
        'mesin_id' => 1,
        'pin' => $faker->randomDigit,
        'date_time' => $faker->date($format = 'Y-m-d', $max = 'now') . ' ' . $faker->time($format = 'H:i:s', $max = 'now'),
        'ver' => 1,
        'status_absen_id' => 2
    ];
});