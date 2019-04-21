<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ExchangeService;

class CheckForExchange extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:exchange {from} {to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieves info about currency exchange';

    /**
     * @var ExchangeService
     */
    protected $exchangeService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ExchangeService $exchangeService)
    {
        $this->exchangeService = $exchangeService;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $from = $this->argument('from');
        $to = $this->argument('to');

        if (!$this->isValidParam($from)) {
            $this->error('Only "usd" and "cad" are supported');
            return;
        }

        if (!$this->isValidParam($to)) {
            $this->error('Only "usd" and "cad" are supported');
            return;
        }

        $this->info('Fetching rate for "' . $from . '" -> "' . $to . '"');

        $result = $this->exchangeService->getData($from, $to);

        if (!isset($result['Realtime Currency Exchange Rate'])) {
            $this->error('There was an error during command execution');
            $this->info(json_encode($result));
            return;
        }

        $this->info(json_encode($result));
    }

    protected function isValidParam($param)
    {
        if (!in_array(strtolower($param), ['usd', 'cad']) ) {
            return false;
        }

        return true;
    }
}
