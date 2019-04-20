<?php
namespace App\Services;

use Exception;
use App\Models\Exchange;
use App\Events\ExchangeHasBeenReceived;
use GuzzleHttp\Client as GuzzleClient;

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
    public function preserveRate($rateInfo)
    {
        $responseMap = config('newsbox.exchange.response_map');

        $payload = [
            'from_currency_code' => $rateInfo[$responseMap['from_currency_code']],
            'to_currency_code' => $rateInfo[$responseMap['to_currency_code']],
            'rate' => $rateInfo[$responseMap['rate']],
            'refreshed_at' => $rateInfo[$responseMap['refreshed_at']],
        ];

        $exchange = Exchange::create($payload);

        return $exchange;
    }

    /**
     * @inheritDoc
     */
    public function getRate($from, $to)
    {
        $apiKey = config('newsbox.exchange.api_key');
        $endpointAddress = config('newsbox.exchange.endpoint');

        try {
            $response = $this->client->request('GET', $endpointAddress, [
                'timeout' => config('newsbox.exchange.timeout_seconds'),
                'connect_timeout' => config('newsbox.exchange.timeout_seconds'),
                'query' => [
                    'function' => self::EXCHANGE_RATE_FUNCTION,
                    'from_currency' => strtolower($from),
                    'to_currency' => strtolower($to),
                    'apikey' => $apiKey
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
}
