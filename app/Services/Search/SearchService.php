<?php

namespace App\Services\Search;

use App\Services\Search\Repositories\SearchRepository;
use Illuminate\Support\Collection;

class SearchService
{
    private SearchRepository $searchRepository;

    public function __construct(SearchRepository $searchRepository)
    {
        $this->searchRepository = $searchRepository;
    }

    public function getFindedOffers(string $q): Collection
    {
        return $this->searchRepository->getFindedOffers($q);
    }
}
