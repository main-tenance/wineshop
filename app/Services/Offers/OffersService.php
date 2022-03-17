<?php


namespace App\Services\Offers;


use App\Models\Offer;
use App\Services\Offers\Repositories\OffersRepository;

class OffersService
{
    protected $offersRepository;

    public function __construct(OffersRepository $offersRepository)
    {
        $this->offersRepository = $offersRepository;
    }

    public function getOfferByCodeWithReviews($code)
    {
        return $this->offersRepository->getByCodeWithReviews($code);
    }

    public function prepareCache()
    {
        $this->offersRepository->prepareCache();
    }

    public function getById(int $id): Offer
    {
        return $this->offersRepository->getById($id);
    }
}
