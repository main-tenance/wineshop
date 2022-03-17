<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Category;
use App\Models\Country;
use App\Models\Creator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Wine;

class WineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = DB::connection('mysql')->select('select bie.id, bie.active, b17.property_202 as name, b17.property_212 as original,
bie.detail_text as description, b17.property_161 as category_id, b17.property_213 as creator_id,
b17.property_162 as country_id, b17.property_163 as area_id, b17.property_151 as color_id
from b_iblock_element as bie
inner join b_iblock_element_prop_s17 as b17 on b17.iblock_element_id = bie.id
where bie.IBLOCK_ID = 17 and b17.property_161 != \'\' and b17.property_213 != \'\' and b17.property_162 != \'\'
and b17.property_202 != \'\' and b17.property_212 != \'\'');
        foreach ($items as $item) {
            if (!(Category::find($item->category_id) &&
                Creator::find($item->creator_id) &&
                Country::find($item->country_id) &&
                Area::find($item->area_id)
            )) {
                continue;
            }
            $item->active = $item->active == 'Y' ? 1 : 0;
            $item->category_id = $item->category_id == 340 ? 339 : $item->category_id;
            $this->insertIfNotExists($item->id, $item->active, $item->name, $item->original, $item->description,
                $item->category_id,  $item->creator_id, $item->country_id, $item->area_id, $item->color_id);
        }
    }


    private function insertIfNotExists($id, $active, $name, $original, $description,
                                       $category_id, $creator_id, $country_id, $area_id, $color_id)
    {
        $exists = $this->getById($id);
        if (!$exists) {
            Wine::create([
                'id' => $id,
                'active' => $active,
                'name' => $name,
                'original' => $original,
                'description' => $description,
                'category_id' => $category_id,
                'creator_id' => $creator_id,
                'country_id' => $country_id,
                'area_id' => $area_id,
                'color_id' => $color_id,
            ]);
        }
    }


    private function getById($id)
    {
        return Wine::find($id);
    }
}
