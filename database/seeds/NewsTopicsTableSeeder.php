<?php

use Illuminate\Database\Seeder;
use App\Models\NewsTopic;

class NewsTopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'Crypto Tidbits: Bitcoin SV Delisting, Binance Chain Launch, HTC Backs Blockchain Fund',
                'author' => 'Nick Chong',
                'subject' => 'boo',
                'description' => 'Another week, another round of Crypto Tidbits. The movement in the value of Bitcoin (BTC) has slowed, with volume and volatility falling across the board, but underlying industry developments have been absolutely monumental. Bitcoin Satoshi’s Vision (BSV) was',
                'url' => 'https://www.newsbtc.com/2019/04/20/crypto-tidbits-bitcoin-sv-delisting-binance-chain-launch-htc-backs-blockchain-fund/',
                'url_to_image' => 'https://www.newsbtc.com/wp-content/uploads/2019/04/shutterstock_620257853-1100x733.jpg"',
                'content' => 'Another week, another round of Crypto Tidbits. The movement in the value of Bitcoin (BTC) has slowed, with volume and volatility falling across the board, but underlying industry developments have been absolutely monumental.\r\nBitcoin Satoshi’s Vision (BSV) wa',
            ]
        ];

        foreach ($data as $payload) {
            factory(NewsTopic::class)->create($payload);
        }
    }
}
