<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Services\NewsTopicService;

class CheckForNewsTopic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:news {subject}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches latest news';

    /**
     * @var NewsTopicService
     */
    protected $service;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(NewsTopicService $service)
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
        $subject = $this->argument('subject');
        $fromDate = Carbon::today()->format('Y-m-d');

        if (!$this->isValidParam($subject)) {
            $this->error('Subject must not contain any spaces (it must be one word)');
            return;
        }

        $this->info('Fetching latest news about "' . $subject . '" for "' . $fromDate . '"');

        $result = $this->service->getData($subject, $fromDate);

        if (!isset($result[NewsTopicService::TOP_LEVEL_NAME])) {
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
