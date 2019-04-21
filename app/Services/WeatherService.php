<?php
namespace App\Services;

use Exception;
use App\Models\Weather;
use App\Events\WeatherHasBeenReceived;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Cache;

class WeatherService implements WeatherInterface
{
    const TOP_LEVEL_NAME = 'main';

    /**
     * Guzzle Client Instance
     *
     * @var GuzzleClient
     */
    private $client;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(GuzzleClient $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function preserveData($payload)
    {
        $responseMap = config('newsbox.weather.response_map');

        $data = [
            'weather_id' => $payload[$responseMap['weather_id']],
            'location' => $payload[$responseMap['location']],
            'type' => $payload[$responseMap['type']][0]['main'],
            'description' => $payload[$responseMap['type']][0]['description'],
            'wind' => $payload[$responseMap['wind']]['speed'],
            'clouds' => $payload[$responseMap['clouds']]['all'],
        ];

        $entity = Weather::updateOrCreate(
            ['location' => $data['location'], 'weather_id' => $data['weather_id']],
            $data
        );

        return $entity;
    }

    /**
     * @inheritDoc
     */
    public function getData($location)
    {
        $endpointAddress = config('newsbox.weather.endpoint');

        try {
            $response = $this->client->request('GET', $endpointAddress, [
                'timeout' => config('newsbox.weather.timeout_seconds'),
                'connect_timeout' => config('newsbox.weather.timeout_seconds'),
                'query' => [
                    'q' => $location,
                    'APPID' => config('newsbox.weather.api_key'),
                ]
            ]);

            $result = json_decode($response->getBody(), true);

            if (isset($result[self::TOP_LEVEL_NAME])) {
                event(new WeatherHasBeenReceived($result));
            }

            return $result;
        }
        catch(Exception $e) {
            $error = [];
            $error['error'] = $e->getMessage();
            $error['code'] = $e->getCode();
            $error['url'] = $endpointAddress;

            return $error;
        }
    }

    public function fetchData($location)
    {
        $seconds = config('newsbox.weather.cache_expiration_seconds.weather_data');

        $weather = Cache::remember('weatherFor_'.$location, $seconds, function () use ($location) {
            $this->getData($location);
            return Weather::whereLocation($location)->latest()->first();
        });

        return $weather;
    }
}
