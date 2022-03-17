<?php


namespace App\Services\Reviews\Handlers;


use App\Models\Offer;
use App\Models\Review;
use App\Models\User;
use App\Services\Reviews\Repositories\ReviewsRepository;

class ReviewCreateHandler
{
    private $reviewRepository;

    public function __construct(ReviewsRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function handle(Offer $offer, User $user, array $data): Review
    {
        $data['user_id'] = $user->id;
        $data['offer_id'] = $offer->id;

        return $this->reviewRepository->create($data);
    }

}
