<?php

namespace Database\Seeders;

use App\Models\Sugar;
use App\Models\Wine;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Offer;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = DB::connection('mysql')->select('select bie.id, bie.active, bie.`name`, bie.code,
bie.detail_text as description, b23.property_89 as wine_id, b23.property_264 as sugar_id,
cast(b23.property_166 as float) as spirt, cast(b23.property_165 as float) as volume,
cast(b23.property_164 as unsigned) as `year`, cast(b23.property_186 as float) as price
from b_iblock_element as bie
inner join b_iblock_element_prop_s23 as b23 on b23.iblock_element_id = bie.id
where bie.IBLOCK_ID = 23 and bie.code != \'\' and b23.property_166 != \'\' and b23.property_165 != \'\'');
        foreach ($items as $item) {
            if (!(Wine::find($item->wine_id) &&
                Sugar::find($item->sugar_id))) {
                continue;
            }
            $item->active = $item->active == 'Y' ? 1 : 0;
            $this->insertIfNotExists($item->id, $item->active, $item->name, $item->code, $item->description,
                $item->wine_id,  $item->sugar_id, $item->spirt, $item->volume, $item->year, $item->price);
        }
    }


    private function insertIfNotExists($id, $active, $name, $code, $description,
                                       $wine_id, $sugar_id, $spirt, $volume, $year, $price)
    {
        $exists = $this->getById($id);
        if (!$exists) {
            Offer::create([
                'id' => $id,
                'active' => $active,
                'name' => $name,
                'code' => $code,
                'description' => $description,
                'wine_id' => $wine_id,
                'sugar_id' => $sugar_id,
                'spirt' => $spirt,
                'volume' => $volume,
                'year' => $year,
                'price' => $price,
            ]);
        }
    }


    private function getById($id)
    {
        return Offer::find($id);
    }
}
