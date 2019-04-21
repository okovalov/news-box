<?php
namespace App\Services;

interface WeatherInterface
{
    /**
     * Creates an instance of Weather in the database
     *
     * @param array $payload
     *
     * @return App\Models\Weather
     */
    public function preserveData($payload);

    /**
     * Fetches the weather for given $location
     *
     * @param string $location
     * @param string $fromDte
     *
     * @return mixed|array
     */
    public function getData($location);
}