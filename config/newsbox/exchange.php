<?php

return [
    'timeout_seconds' => 10,
    'api_key' => env('EXCHANGE_API_KEY', '12345'),
    'endpoint' => env('EXCHANGE_ENDPOINT', 'https://www.alphavantage.co/query'),
    'currency_pairs_list' => [
        'usd cad',
        'cad usd'
    ],
    'response_map' => [
        'from_currency_code' => env('EXCHANGE_RESPONSE_FROM', '1. From_Currency Code'),
        'to_currency_code' => env('EXCHANGE_RESPONSE_TO', '3. To_Currency Code'),
        'rate' => env('EXCHANGE_RESPONSE_RAT', '5. Exchange Rate'),
        'refreshed_at' => env('EXCHANGE_RESPONSE_REFRESHED', '6. Last Refreshed')
    ],
    'cron' => [
        'exchange_schedule' => env('EXCHANGE_CRON_SCHEDULE', '* * * * *')
    ],
];
