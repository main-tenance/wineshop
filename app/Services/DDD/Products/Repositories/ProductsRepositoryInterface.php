<?php

namespace App\Services\DDD\Products\Repositories;

use App\Services\DDD\Products\DTOs\AvgRatingDTO;
use App\Services\DDD\Products\Product;

interface ProductsRepositoryInterface
{
    public function getAvgRatingByProduct(Product $product): AvgRatingDTO;
}
