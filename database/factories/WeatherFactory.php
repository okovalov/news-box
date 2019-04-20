<?php

use App\Models\Weather;
use Faker\Generator as Faker;

$factory->define(Weather::class, function (Faker $faker) {
    return [
        'weather_id' => $faker->randomDigit,
        'location' => $faker->city,
        'type' => $faker->word,
        'description' => $faker->paragraph ,
        'wind' => 0,
        'clouds' => 0,
    ];
});
