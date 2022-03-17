<?php

namespace App\Services\DDD\Products\Services;

use App\Services\DDD\Products\DTOs\AvgRatingDTO;
use App\Services\DDD\Products\Product;
use App\Services\DDD\Products\Repositories\ProductsRepositoryInterface;

class ProductsService
{
    private ProductsRepositoryInterface $productsRepository;

    public function __construct(ProductsRepositoryInterface $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    public function getAvgRating(Product $product): AvgRatingDTO
    {
        return $this->productsRepository->getAvgRatingByProduct($product);
    }
}
