<?php


namespace App\Services\Reviews;


use App\Models\Offer;
use App\Models\Review;
use App\Models\User;
use App\Services\Reviews\Handlers\ReviewCreateHandler;
use App\Services\Reviews\Handlers\ReviewUpdateHandler;
use App\Services\Reviews\Repositories\ReviewsRepository;

class ReviewsService
{
    protected ReviewCreateHandler $reviewCreateHandler;
    protected ReviewUpdateHandler $reviewUpdateHandler;
    private ReviewsRepository $reviewsRepository;

    public function __construct(
        ReviewCreateHandler $reviewCreateHandler,
        ReviewUpdateHandler $reviewUpdateHandler,
        ReviewsRepository   $reviewsRepository
    )
    {
        $this->reviewCreateHandler = $reviewCreateHandler;
        $this->reviewUpdateHandler = $reviewUpdateHandler;
        $this->reviewsRepository = $reviewsRepository;
    }

    public function createReview(Offer $offer, User $user, array $data): Review
    {
        return $this->reviewCreateHandler->handle($offer, $user, $data);
    }

    public function updateReview(Review $review, array $data): Review
    {
        return $this->reviewUpdateHandler->handle($review, $data);
    }

    public function destroy(Review $review)
    {
        $review->delete();
    }

    public function prepareCache()
    {
        $this->reviewsRepository->prepareCache();
    }

}
