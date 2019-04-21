<?php
namespace App\Services;

use Exception;
use App\Models\NewsTopic;
use App\Events\NewsTopicHasBeenReceived;
use GuzzleHttp\Client as GuzzleClient;
use Carbon\Carbon;

class NewsTopicService implements NewsTopicInterface
{
    const TOP_LEVEL_NAME = 'articles';

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
        $responseMap = config('newsbox.newstopic.response_map');

        $data = [
            'title' => $payload[$responseMap['title']],
            'author' => $payload[$responseMap['author']],
            'description' => $payload[$responseMap['description']],
            'url' => $payload[$responseMap['url']],
            'url_to_image' => $payload[$responseMap['url_to_image']],
            'content' => $payload[$responseMap['content']],
            'published_at' => Carbon::parse(
                $payload[$responseMap['published_at']])
            ->toDateTimeString(),
        ];


        $entity = NewsTopic::updateOrCreate(
            ['title' => $data['title'], 'author' => $data['author']],
            $data
        );

        return $entity;
    }

    /**
     * @inheritDoc
     */
    public function getData($query, $fromDate)
    {
        $endpointAddress = config('newsbox.newstopic.endpoint');

        try {
            $response = $this->client->request('GET', $endpointAddress, [
                'timeout' => config('newsbox.newstopic.timeout_seconds'),
                'connect_timeout' => config('newsbox.newstopic.timeout_seconds'),
                'query' => [
                    'q' => $query,
                    'from' => $fromDate,
                    'sortBy' => config('newsbox.newstopic.sort_by'),
                    'apikey' => config('newsbox.newstopic.api_key'),
                    'pageSize' => config('newsbox.newstopic.page_size'),
                ]
            ]);

            $result = json_decode($response->getBody(), true);

            if (isset($result[self::TOP_LEVEL_NAME])) {
                foreach ($result[self::TOP_LEVEL_NAME] as $item) {
                    event(new NewsTopicHasBeenReceived($item));
                }
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
}
