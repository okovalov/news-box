<?php
namespace App\Services;

interface ExchangeInterface
{
    /**
     * Creates an instance of Exchange
     *
     * @param array  $payload
     *
     * @return App\Models\Exchange
     */
    public function preserveData($payload);

    /**
     * Fetches the latest rate by given $from and $to
     *
     * @param string $from
     * @param string $to
     *
     * @return mixed|array
     */
    public function getData($from, $to);
}