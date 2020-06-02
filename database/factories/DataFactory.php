<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(\App\Models\Data::class, function (Faker $faker) {
    return [
        'name'     => $faker->name,
        'amount'   => $faker->randomDigit,
        'currency' => $faker->randomElement(['USD', 'EUR', 'RUR', 'CHF']),
        'page_uid' => Str::random(10)
    ];
});
