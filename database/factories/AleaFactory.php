<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;

use App\Models\Alea;

$factory->define(Alea::class, function (Faker $faker) {
    return [
        'nom' => $faker->unique->text(255),
        'url' => $faker->url,
    ];
});
