<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class ImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('database.import_tables') as $table) {
            if (!Schema::hasTable($table)) {
                try {
                    Artisan::call('bitrix:import', ['--table' => [$table]]);
                } catch (\Exception $e) {
                    dump($table);
                }
            }
        }
    }
}
