<?php

namespace App\Console\Commands;

use App\Services\Bitrix\Exceptions\BitrixDBImpotrException;
use App\Services\Bitrix\BitrixDBImpotrService;
use Illuminate\Console\Command;

class BitrixDBImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bitrix:import {--t|table=* : Tables to import}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bitrix from Bitrix DB';

    public function handle(BitrixDBImpotrService $importService): void
    {
        $tables = $this->option('table');
        if (empty($tables) && !$this->confirm('Do import all tables?', true)) {
            $tables = [
                $this->anticipate('Which table to import?',
                    config('database.import_tables'))
            ];
        }

        $files = $importService->getFiles($tables);
        if (empty($files)) {
            $this->warn('No files to process.');

            return;
        }

        $bar = $this->output->createProgressBar(count($files));
        $bar->start();
        foreach ($files as $file) {
            $this->newLine();
            try {
                $importService->import($file);
                $this->info(" File $file was processed.");
                $bar->advance();
            } catch (BitrixDBImpotrException $e) {
                $this->error($e->getMessage());
            }
        }
//        $bar->finish();
        $this->newLine();
    }
}
