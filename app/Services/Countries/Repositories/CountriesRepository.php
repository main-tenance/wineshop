<?php

namespace App\Services\Countries\Repositories;

use App\Models\Country;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CountriesRepository
{
    public function ratingsPrepareCache()
    {
        $countries = Country::all();
        foreach ($countries as $country) {
            Cache::remember('ratings-by-country-' . $country, 120, function () use ($country) {
                return DB::table('countries')
                    ->join('wines', 'country_id', '=', 'countries.id')
                    ->join('offers', 'wine_id', '=', 'wines.id')
                    ->join('reviews', 'offer_id', '=', 'offers.id')
                    ->where('countries.code', $country->code)
                    ->select('wines.id', DB::raw('avg(reviews.rating) as rating'))
                    ->groupBy('wines.id')
                    ->get()->map(fn($item) => round(collect($item)->toArray()['rating'], 2));
            });
        }
    }

}
