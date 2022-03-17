<?php

namespace App\Console\Commands;

use App\Services\Cache\CacheService;
use Illuminate\Console\Command;

class CachePrepare extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:prepare';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepare cache of entity';

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
     * @return int
     */
    public function handle(CacheService $cacheService)
    {
        $entity = $this->choice(
            'Select an entity:',
            ['creators', 'offers', 'reviews',],
            'creators'
        );
        $function = $entity . 'PrepareCache';
        $cacheService->$function();

        return 0;
    }
}
