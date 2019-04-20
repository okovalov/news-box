<?php

use App\Models\Exchange;
use Faker\Generator as Faker;

$factory->define(Exchange::class, function (Faker $faker) {
    return [
        'from_currency_code' => $faker->word,
        'to_currency_code' => $faker->word,
        'rate' => $faker->randomDigit,
        'refreshed_at' => now()
    ];
});
