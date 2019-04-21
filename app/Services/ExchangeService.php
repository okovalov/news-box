<?php
namespace App\Services;

use Exception;
use App\Models\Exchange;
use App\Events\ExchangeHasBeenReceived;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Cache;

class ExchangeService implements ExchangeInterface
{
    const EXCHANGE_RATE_FUNCTION = 'CURRENCY_EXCHANGE_RATE';
    const TOP_LEVEL_NAME = 'Realtime Currency Exchange Rate';

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
        $responseMap = config('newsbox.exchange.response_map');

        $data = [
            'from_currency_code' => $payload[$responseMap['from_currency_code']],
            'to_currency_code' => $payload[$responseMap['to_currency_code']],
            'rate' => $payload[$responseMap['rate']],
            'refreshed_at' => $payload[$responseMap['refreshed_at']],
        ];

        $entity = Exchange::create($data);

        return $entity;
    }

    /**
     * @inheritDoc
     */
    public function getData($from, $to)
    {
        $endpointAddress = config('newsbox.exchange.endpoint');

        try {
            $response = $this->client->request('GET', $endpointAddress, [
                'timeout' => config('newsbox.exchange.timeout_seconds'),
                'connect_timeout' => config('newsbox.exchange.timeout_seconds'),
                'query' => [
                    'function' => self::EXCHANGE_RATE_FUNCTION,
                    'from_currency' => strtolower($from),
                    'to_currency' => strtolower($to),
                    'apikey' => config('newsbox.exchange.api_key')
                ]
            ]);

            $result = json_decode($response->getBody(), true);

            event(new ExchangeHasBeenReceived($result[self::TOP_LEVEL_NAME]));

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

    public function fetchData($from, $to)
    {
        $seconds = config('newsbox.exchange.cache_expiration_seconds.exchange_data');

        $exchange = Cache::remember('exchangeFor_'.$from.'_'.$to, $seconds, function () use ($from, $to) {
            $this->getData($from, $to);

            \Log::info('Value cached ex');

            return Exchange::where([['from_currency_code','=',$from], ['to_currency_code','=',$to]])->latest()->first();
        });

        \Log::info('Value fetched ex');

        return $exchange;
    }
}
