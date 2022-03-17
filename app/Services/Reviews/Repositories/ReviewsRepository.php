<?php


namespace App\Services\Reviews\Repositories;


use App\Models\Review;

class ReviewsRepository
{
    public function create(array $data): Review
    {
        return Review::create($data);
    }


    public function update(Review $review, array $data): Review
    {
        $review->update($data);

        return $review;
    }

    public function prepareCache()
    {
        Review::remember(60 * 60 * 24)->cacheTags('reviews')->orderBy('id')->get();
        Review::remember(60 * 60 * 24)->cacheTags('reviews')->orderByDesc('id')->get();
        Review::remember(60 * 60 * 24)->cacheTags('reviews')->orderBy('offer_id')->get();
        Review::remember(60 * 60 * 24)->cacheTags('reviews')->orderByDesc('offer_id')->get();
        Review::remember(60 * 60 * 24)->cacheTags('reviews')->orderBy('rating')->get();
        Review::remember(60 * 60 * 24)->cacheTags('reviews')->orderByDesc('rating')->get();
        echo "Reviews are cached\n";
    }
}
