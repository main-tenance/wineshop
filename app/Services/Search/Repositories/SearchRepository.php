<?php

namespace App\Services\Search\Repositories;

use App\Models\Offer;
use App\Models\Vine;
use App\Models\Wine;
use Illuminate\Support\Collection;

class SearchRepository
{
    public function getFindedOffers(string $q): Collection
    {
        $wineOffers = Wine::search($q)->get()->load('offers')->pluck('offers');
        $vineOffers = Vine::search($q)->get()->load('offers')->pluck('offers');
        $offers = Offer::search($q)->get();
        foreach ($vineOffers as $vine) {
            if($vine->count() == 0) {
                continue;
            }

            foreach ($vine as $offer) {
                $offers->push($offer);
            }
        }
        foreach ($wineOffers as $wine) {
            if ($wine->count() == 0) {
                continue;
            }

            foreach ($wine as $offer) {
                $offers->push($offer);
            }
        }

        if ($offers->count() > 10) {
            $offers = $offers->slice(0, 10);
        }

        return $offers;
    }

}
