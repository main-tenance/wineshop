<?php

namespace App\Console\Commands;

use App\Models\Creator;
use App\Models\Offer;
use App\Models\Vine;
use App\Models\Wine;
use Illuminate\Console\Command;

class ReindexSearchableModels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reindex Searchable Models';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        Offer::query()->searchable();
        Wine::query()->searchable();
        Vine::query()->searchable();
    }
}
