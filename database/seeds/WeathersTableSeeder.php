<?php

use Illuminate\Database\Seeder;
use App\Models\Weather;

class WeathersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'weather_id' => 5814616,
                'location' => 'Vancouver',
                'type' => 'Clouds',
                'description' => 'overcast clouds',
                'wind' => 4.1,
                'clouds' => 90,
            ],
            [
                'weather_id' => 6167865,
                'location' => 'Toronto',
                'type' => 'Rain',
                'description' => 'light rain',
                'wind' => 4.1,
                'clouds' => 90,
            ],
            [
                'weather_id' => 6167865,
                'location' => 'Montreal',
                'type' => 'Clouds',
                'description' => 'overcast clouds',
                'wind' => 9.1,
                'clouds' => 90,
            ],
            [
                'weather_id' => 5946768,
                'location' => 'Edmonton',
                'type' => 'Clouds',
                'description' => 'few clouds',
                'wind' => 5.1,
                'clouds' => 20,
            ],
        ];

        foreach ($data as $payload) {
            factory(Weather::class)->create($payload);
        }
    }
}
