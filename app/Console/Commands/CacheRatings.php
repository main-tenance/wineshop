<?php

namespace App\Console\Commands;

use App\Services\Cache\CacheService;
use Illuminate\Console\Command;

class CacheRatings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:ratings';

    protected $name = 'Сache the ratings counted by country';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Сache the ratings counted by country';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(CacheService $cacheService): void
    {
        $cacheService->ratingsByCountryPrepareCache();
    }
}
