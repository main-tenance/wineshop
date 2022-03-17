<?php

namespace App\Services\Countries;

use App\Services\Countries\Repositories\CountriesRepository;

class CountriesService
{
    private CountriesRepository $countriesRepository;

    public function __construct(CountriesRepository $countriesRepository)
    {
        $this->countriesRepository = $countriesRepository;
    }

    public function ratingsPrepareCache()
    {
        $this->countriesRepository->ratingsPrepareCache();
    }

}
