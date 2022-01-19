<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;

use App\Models\Ville;

$factory->define(Ville::class, function (Faker $faker) {
    return [
        'nom' => $faker->unique->text(255),
    ];
});
