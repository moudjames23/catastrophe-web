<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;

use App\Models\Catastrophe;

$factory->define(Catastrophe::class, function (Faker $faker) {
    return [
        'valeur' => $faker->randomNumber(0),
        'url' => $faker->url,
        'alea_id' => factory(App\Models\Alea::class),
        'ville_id' => factory(App\Models\Ville::class),
    ];
});
