<?php
namespace App\Services;

interface NewsTopicInterface
{
    /**
     * Creates an instance of NewsTopics in the database
     *
     * @param array $payload
     *
     * @return App\Models\NewsTopic
     */
    public function preserveData($payload);

    /**
     * Fetches the news by given $query and $fromDate
     *
     * @param string $query
     * @param string $fromDate
     *
     * @return mixed|array
     */
    public function getData($query, $fromDate);
}