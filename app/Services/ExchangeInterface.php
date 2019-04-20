<?php
namespace App\Services;

interface ExchangeInterface
{
    /**
     * Creates an instance of Wallet in the database
     *
     * @param array  $rateInfo
     *
     * @return App\Models\Exchange
     */
    public function preserveRate($rateInfo);

    /**
     * Retrieves the balance for the given wallet address and currencyCode
     *
     * @param string $from
     * @param string $to
     *
     * @return mixed|array
     */
    public function getRate($from, $to);
}