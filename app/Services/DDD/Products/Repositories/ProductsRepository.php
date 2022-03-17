<?php

namespace App\Services\DDD\Products\Repositories;

use App\Services\DDD\Products\DTOs\AvgRatingDTO;
use App\Services\DDD\Products\Product;
use Illuminate\Support\Facades\DB;

class ProductsRepository implements ProductsRepositoryInterface
{
    public function getAvgRatingByProduct(Product $product): AvgRatingDTO
    {
        $res = DB::table('reviews')
            ->select(DB::raw('count(*) as customers_count, avg(rating) as score'))
            ->where('offer_id', $product->getId())
            ->first();

        return new AvgRatingDTO($res->score, $res->customers_count);
    }
}
