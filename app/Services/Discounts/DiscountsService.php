<?php


namespace App\Services\Discounts;

use App\Models\Discount;
use App\Services\Discounts\Handlers\DiscountCreateHandler;
use App\Services\Discounts\Handlers\DiscountUpdateHandler;
use App\Services\Discounts\Repositories\DiscountsRepository;
use Illuminate\Support\Collection;

class DiscountsService
{
    /**
     * @var DiscountsRepository
     */
    private DiscountsRepository $discountsRepository;
    /**
     * @var DiscountCreateHandler
     */
    private DiscountCreateHandler $createDiscountHandler;
    /**
     * @var DiscountUpdateHandler
     */
    private DiscountUpdateHandler $updateDiscountHandler;

    public function __construct(
        DiscountsRepository   $discountsRepository,
        DiscountCreateHandler $createDiscountHandler,
        DiscountUpdateHandler $updateDiscountHandler
    )
    {
        $this->discountsRepository = $discountsRepository;
        $this->createDiscountHandler = $createDiscountHandler;
        $this->updateDiscountHandler = $updateDiscountHandler;
    }

    public function getAllSortedDiscounts(string $sortField = 'id', string $sortDirection = 'asc')
    {
        return $this->discountsRepository->getAll($sortField, $sortDirection);
    }

    public function getDiscounts(int $limit = 20, int $offset = 0): Collection
    {
        return $this->discountsRepository->getBy([], $limit, $offset);
    }


    public function createDiscount(array $data): Discount
    {
        return $this->createDiscountHandler->handle($data);
    }


    public function updateDiscount(Discount $discount, array $data): Discount
    {
        return $this->updateDiscountHandler->handle($discount, $data);
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();
    }

}
