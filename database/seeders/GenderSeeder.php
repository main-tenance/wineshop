<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Gender;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertIfNotExists('мужской', 'masculine');
        $this->insertIfNotExists('средний', 'neuter');
        $this->insertIfNotExists('женский', 'feminine');
    }


    private function insertIfNotExists($name, $code)
    {
        $exists = $this->getByCode($code);
        if (!$exists) {
            Gender::create(['name' => $name, 'code' => $code]);
        }
    }


    private function getByCode($code)
    {
        return Gender::where('code', $code)->first();
    }


}
