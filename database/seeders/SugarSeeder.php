<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Sugar;

class SugarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = DB::connection('mysql')->select('select fl.val, fl.code, fl.rus
from filter_lists fl
where fl.property_id = 264');
        foreach ($items as $item) {
            $this->insertIfNotExists($item->val, $item->rus, $item->code);
        }
    }


    private function insertIfNotExists($id, $name, $code)
    {
        $exists = $this->getById($id);
        if (!$exists) {
            Sugar::create([
                'id' => $id,
                'name' => $name,
                'code' => $code,
            ]);
        }
    }


    private function getById($id)
    {
        return Sugar::find($id);
    }
}
