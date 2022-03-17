<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = DB::connection('mysql')->select('select code from filter_categories');
        foreach ($items as $item) {
            $this->insertIfNotExists($item->code);
        }
        $items = DB::connection('mysql')->select('select code from filter_regions');
        foreach ($items as $item) {
            $this->insertIfNotExists($item->code);
        }
        $items = DB::connection('mysql')->select('select code from filter_lists');
        foreach ($items as $item) {
            $this->insertIfNotExists($item->code);
        }
        $items = DB::connection('mysql')->select('select code from vine');
        foreach ($items as $item) {
            $this->insertIfNotExists($item->code);
        }
    }


    private function insertIfNotExists($code)
    {
        $exists = $this->getByCode($code);
        if (!$exists) {
            DB::table('codes')->insert(['code' => $code]);
        }
    }


    private function getByCode($code)
    {
        return DB::table('codes')->where('code', $code)->first();
    }
}
