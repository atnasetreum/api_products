<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'code'        => str_random(10),
        'description' => $faker->unique()->text($maxNbChars = 50) ,
    ];
});
