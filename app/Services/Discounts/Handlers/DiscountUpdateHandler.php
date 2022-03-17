<?php

namespace App\Services\Discounts\Handlers;

use App\Models\Discount;
use App\Services\Discounts\Repositories\DiscountsRepository;

class DiscountUpdateHandler
{

    private DiscountsRepository $discountsRepository;


    public function __construct(DiscountsRepository $discountsRepository)
    {
        $this->discountsRepository = $discountsRepository;
    }


    public function handle(Discount $discount, array $data): Discount
    {
        $discount = $this->discountsRepository->update($discount, $data);
        $this->discountsRepository->setGroups($discount, $data);

        return $discount;
    }


}
