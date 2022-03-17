<?php

namespace App\Http\Controllers\Web\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Review\ReviewCreateFormRequest;
use App\Http\Requests\Web\Review\ReviewEditFormRequest;
use App\Models\Offer;
use App\Models\Review;
use App\Policies\Permission;
use App\Services\Reviews\Forms\ReviewCreateFormBuilder;
use App\Services\Reviews\Forms\ReviewEditFormBuilder;
use App\Services\Reviews\ReviewsService;
use App\Http\Routes\Web\WebRoutesProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\View;

class ReviewController extends Controller
{
    protected $reviewsService;

    public function __construct(ReviewsService $reviewsService)
    {
        $this->reviewsService = $reviewsService;
    }

    public function getReviewsService()
    {
        return app(ReviewsService::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Offer $offer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Offer $offer)
    {
        View::share(['offer' => $offer]);

        return view('reviews.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Offer $offer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Offer $offer)
    {
        $this->authorize(Permission::CREATE, Review::class);
        $form = app(ReviewCreateFormBuilder::class);
        View::share([
            'form' => $form,
            'model' => $offer,
            'url' => WebRoutesProvider::reviewStore($offer),
        ]);

        return view('reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReviewCreateFormRequest $request
     * @return JsonResponse
     */
    public function store(Offer $offer, ReviewCreateFormRequest $request)
    {
        $this->authorize(Permission::CREATE, Review::class);
        $review = $this->getReviewsService()->createReview($offer, request()->user(), $request->getFormData());

        return response()->json(['ok' => 1, 'id' => $review->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param Offer $offer
     * @param Review $review
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Offer $offer, Review $review)
    {
        if (!$review) {
            abort(404);
        }

        View::share(['offer' => $offer, 'review' => $review]);

        return view('reviews.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Offer $offer
     * @param Review $review
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Offer $offer, Review $review)
    {
        $this->authorize(Permission::UPDATE, $review);
        $form = app(ReviewEditFormBuilder::class);
        View::share([
            'model' => $review,
            'form' => $form,
            'url' => WebRoutesProvider::reviewUpdate($offer, $review),
        ]);

        return view('reviews.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Offer $offer
     * @param Review $review
     * @param ReviewEditFormRequest $request
     * @return JsonResponse
     */
    public function update(Offer $offer, Review $review, ReviewEditFormRequest $request)
    {
        $this->authorize(Permission::UPDATE, $review);
        $this->getReviewsService()->updateReview($review, $request->getFormData());

        return response()->json(['ok' => 1, 'message' => __('app.info_saved')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Offer $offer
     * @param Review $review
     * @param ReviewEditFormRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Offer $offer, Review $review)
    {
        $this->authorize(Permission::DELETE, $review);
        $this->getReviewsService()->destroy($review);

        return redirect(WebRoutesProvider::reviewIndex($offer));
    }
}
