<?php

use Faker\Generator as Faker;

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('123456'),
        'remember_token' => str_random(10),
    ];
});
