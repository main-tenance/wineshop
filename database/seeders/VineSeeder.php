<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Vine;

class VineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = DB::connection('mysql')->select('select v.id, v.code, v.rus, bie.detail_text
from vine as v
left join b_iblock_element as bie on v.id = bie.XML_ID
where bie.IBLOCK_ID = 33');
        foreach ($items as $item) {
             $this->insertIfNotExists($item->id, $item->rus, $item->code, $item->detail_text);
        }
    }


    private function insertIfNotExists($id, $name, $code, $description)
    {
        $exists = $this->getById($id);
        if (!$exists) {
            Vine::create([
                'id' => $id,
                'name' => $name,
                'code' => $code,
                'description' => $description,
            ]);
        }
    }


    private function getById($id)
    {
        return Vine::find($id);
    }
}
