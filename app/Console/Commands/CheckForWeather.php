<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WeatherService;

class CheckForWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:weather {location}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches latest weather';

    /**
     * @var WeatherService
     */
    protected $service;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(WeatherService $service)
    {
        $this->service = $service;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $location = $this->argument('location');

        if (!$this->isValidParam($location)) {
            $this->error('Location must not contain any spaces (it must be one word)');
            return;
        }

        $this->info('Fetching latest weather for "' . $location . '"');

        $result = $this->service->getData($location);

        if (!isset($result[WeatherService::TOP_LEVEL_NAME])) {
            $this->error('There was an error during command execution');
            $this->info(json_encode($result));
            return;
        }

        $this->info(json_encode($result));
    }

    protected function isValidParam($param)
    {
        if (strpos($param, ' ') !== false) {
            return false;
        }

        return true;
    }
}
