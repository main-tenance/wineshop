<?php

namespace Database\Seeders;

use App\Models\Offer;
use App\Models\Vine;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\OfferVine;

class OfferVineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = DB::connection('mysql')->select('select offer_id, vine_id, `position`, percent
from vine_offer as vo
');
        foreach ($items as $item) {
            if (!(Offer::find($item->offer_id) && Vine::find($item->vine_id))) {
                continue;
            }
            $this->insertIfNotExists($item->offer_id, $item->vine_id, $item->position, $item->percent);
        }
    }


    private function insertIfNotExists($offer_id, $vine_id, $position, $percent)
    {
        $exists = $this->getByIds($offer_id, $vine_id);
        if (!$exists) {
            OfferVine::create([
                'offer_id' => $offer_id,
                'vine_id' => $vine_id,
                'position' => $position,
                'percent' => $percent,
            ]);
        }
    }


    private function getByIds($offer_id, $vine_id)
    {
        return OfferVine::where('offer_id', $offer_id)
            ->where('vine_id', $vine_id)
            ->first();
    }
}
