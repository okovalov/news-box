<?php

use Illuminate\Database\Seeder;
use App\Models\Exchange;

class ExchangesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['from_currency_code' => 'USD', 'to_currency_code' => 'CAD', 'rate' => 1.33850000],
            ['from_currency_code' => 'CAD', 'to_currency_code' => 'USD', 'rate' => 0.74710494],
        ];

        foreach ($data as $payload) {
            factory(Exchange::class)->create($payload);
        }
    }
}
