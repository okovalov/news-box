<?php

return [
    'timeout_seconds' => 10,
    'api_key' => env('NEWSTOPIC_API_KEY', '12345'),
    'endpoint' => env('NEWSTOPIC_ENDPOINT', 'https://newsapi.org/v2/everything'),
    'response_map' => [
        'title' => env('NEWSTOPIC_RESPONSE_TITLE', 'title'),
        'author' => env('NEWSTOPIC_RESPONSE_AUTHOR', 'author'),
        'description' => env('NEWSTOPIC_RESPONSE_DESCRIPTION', 'description'),
        'url' => env('NEWSTOPIC_RESPONSE_URL', 'url'),
        'url_to_image' => env('NEWSTOPIC_RESPONSE_URL_TO_IMAGE', 'urlToImage'),
        'content' => env('NEWSTOPIC_RESPONSE_CONTENT', 'content'),
        'published_at' => env('NEWSTOPIC_RESPONSE_PUBLISHED_AT', 'publishedAt'),
    ],
    'cron' => [
        'newstopic_schedule' => env('NEWSTOPIC_CRON_SCHEDULE', '*/5 * * * *')
    ],
    'sort_by' => env('NEWSTOPIC_SORT_BY', 'publishedAt'),
    'page_size' => env('NEWSTOPIC_PAGE_SIZE', 10),
];
