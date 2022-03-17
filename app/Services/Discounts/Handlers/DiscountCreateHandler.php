<?php


namespace App\Services\Discounts\Handlers;


use App\Models\Discount;
use App\Services\Discounts\Repositories\DiscountsRepository;

class DiscountCreateHandler
{

    private DiscountsRepository $discountsRepository;


    public function __construct(DiscountsRepository $discountsRepository)
    {
        $this->discountsRepository = $discountsRepository;
    }


    public function handle(array $data): Discount
    {
        $discount = $this->discountsRepository->create($data);
        $this->discountsRepository->setGroups($discount, $data);

        return $discount;
    }


}
