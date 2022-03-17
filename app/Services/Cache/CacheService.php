<?php

namespace App\Services\Cache;

use App\Services\Countries\CountriesService;
use App\Services\Creators\CreatorsService;
use App\Services\Offers\OffersService;
use App\Services\Reviews\ReviewsService;

class CacheService
{
    private CreatorsService $creatorsService;
    private OffersService $offersService;
    private ReviewsService $reviewsService;
    private CountriesService $countriesService;

    public function __construct(
        CreatorsService $creatorsService,
        OffersService   $offersService,
        ReviewsService  $reviewsService,
        CountriesService $countriesService
    )
    {
        $this->creatorsService = $creatorsService;
        $this->offersService = $offersService;
        $this->reviewsService = $reviewsService;
        $this->countriesService = $countriesService;
    }

    public function creatorsPrepareCache(): void
    {
        $this->creatorsService->prepareCache();
    }

    public function offersPrepareCache(): void
    {
        $this->offersService->prepareCache();
    }

    public function reviewsPrepareCache(): void
    {
        $this->reviewsService->prepareCache();
    }

    public function ratingsByCountryPrepareCache(): void
    {
        $this->countriesService->ratingsPrepareCache();
    }
}
