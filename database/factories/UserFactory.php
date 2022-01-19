<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;

use App\Models\User;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique->email,
        'email_verified_at' => now(),
        'password' => \Hash::make('password'),
        'remember_token' => Str::random(10),
    ];
});
