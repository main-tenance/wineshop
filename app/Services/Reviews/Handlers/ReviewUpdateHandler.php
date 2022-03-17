<?php


namespace App\Services\Reviews\Handlers;


use App\Models\Review;
use App\Services\Reviews\Repositories\ReviewsRepository;

class ReviewUpdateHandler
{
    private $reviewRepository;

    public function __construct(ReviewsRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function handle(Review $review, array $data): Review
    {
        return $this->reviewRepository->update($review, $data);
    }


}
