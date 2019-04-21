<?php

return [
    'location_list' => [
        'Vancouver',
        'Toronto',
        'Montreal',
        'Edmonton'
    ],
    'cache_expiration_seconds' => [
        'location_list' => 60,
        'weather_data' => 60
    ],
    'timeout_seconds' => 10,
    'api_key' => env('WEATHER_API_KEY', '12345'),
    'endpoint' => env('WEATHER_ENDPOINT', 'https://www.alphavantage.co/query'),
    'response_map' => [
        'weather_id' => env('WEATHER_RESPONSE_FROM', 'id'),
        'location' => env('WEATHER_RESPONSE_TO', 'name'),
        'type' => env('WEATHER_RESPONSE_RAT', 'weather'),
        'description' => env('WEATHER_RESPONSE_RAT', 'weather'),
        'wind' => env('WEATHER_RESPONSE_RAT', 'wind'),
        'clouds' => env('WEATHER_RESPONSE_RAT', 'clouds'),
    ],
    'cron' => [
        'weather_schedule' => env('WEATHER_CRON_SCHEDULE', '* * * * *')
    ],
];
