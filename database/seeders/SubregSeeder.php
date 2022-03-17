<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Subreg;

class SubregSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = DB::connection('mysql')->select('select fl.val, fl.code, fl.rus, bie.name, bie.detail_text,
fl.preposition, fl.from, fl.adjective, cou.xml_id
from b_iblock_element as bie
inner join filter_regions fl on fl.VAL = bie.XML_ID
left join b_iblock_element_property as biep on biep.iblock_element_id = bie.id and biep.iblock_property_id = 53
left join b_iblock_element as cou on cou.id = biep.value_num
where bie.IBLOCK_ID = 27');
        foreach ($items as $item) {
            $original = explode('/', $item->name);
            $original = isset($original[1]) ? trim($original[1]) : '';
            $this->insertIfNotExists($item->val, $item->rus, $item->code, $original, $item->detail_text,
                $item->preposition, $item->from, $item->adjective, $item->xml_id);
        }
    }


    private function insertIfNotExists($id, $name, $code, $original, $description,
                                       $preposition, $from, $adjective, $xmlId)
    {
        $exists = $this->getById($id);
        if (!$exists) {
            Subreg::create([
                'id' => $id,
                'name' => $name,
                'code' => $code,
                'original' => $original,
                'description' => $description,
                'preposition' => $preposition,
                'from' => $from,
                'adjective' => $adjective,
                'area_id' => $xmlId,
            ]);
        }
    }


    private function getById($id)
    {
        return Subreg::find($id);
    }
}
