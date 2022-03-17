<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = DB::connection('mysql')->select('select fl.val, fl.code, fl.rus, bie.name, bie.detail_text,
fl.preposition, fl.from, fl.adjective
from b_iblock_element as bie
inner join filter_regions fl on fl.VAL = bie.XML_ID
where bie.IBLOCK_ID = 20');
        foreach ($items as $item) {
            $original = explode('/', $item->name);
            $original = isset($original[1]) ? trim($original[1]) : '';
            $this->insertIfNotExists($item->val, $item->rus, $item->code, $original, $item->detail_text,
                $item->preposition, $item->from, $item->adjective);
        }
    }


    private function insertIfNotExists($id, $name, $code, $original, $description,
                                       $preposition, $from, $adjective)
    {
        $exists = $this->getById($id);
        if (!$exists) {
            Country::create([
                'id' => $id,
                'name' => $name,
                'code' => $code,
                'original' => $original,
                'description' => $description,
                'preposition' => $preposition,
                'from' => $from,
                'adjective' => $adjective,
            ]);
        }
    }


    private function getById($id)
    {
        return Country::find($id);
    }
}
