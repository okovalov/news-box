<?php

use App\Models\NewsTopic;
use Faker\Generator as Faker;

$factory->define(NewsTopic::class, function (Faker $faker) {
    return [
        'title' => $faker->paragraph,
        'subject' => $faker->word,
        'author' => $faker->name,
        'description' => $faker->paragraph,
        'url' => $faker->url,
        'url_to_image' => $faker->url,
        'content' => $faker->paragraph,
        'published_at' => now(),
    ];
});
