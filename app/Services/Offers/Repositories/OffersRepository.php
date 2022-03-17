<?php


namespace App\Services\Offers\Repositories;


use App\Models\Offer;

class OffersRepository
{
    public function getByCodeWithReviews($code)
    {
        return Offer::where('code', $code)->with('reviews')->first();
    }

    public function prepareCache()
    {
        Offer::remember(60 * 60 * 24)->cacheTags('offers')->orderBy('id')->get();
        Offer::remember(60 * 60 * 24)->cacheTags('offers')->orderByDesc('id')->get();
        Offer::remember(60 * 60 * 24)->cacheTags('offers')->orderBy('name')->get();
        Offer::remember(60 * 60 * 24)->cacheTags('offers')->orderByDesc('name')->get();
        Offer::remember(60 * 60 * 24)->cacheTags('offers')->orderBy('code')->get();
        Offer::remember(60 * 60 * 24)->cacheTags('offers')->orderByDesc('code')->get();
        echo "Offers are cached\n";
    }

    public function getById(int $id): Offer
    {
        return Offer::find($id);
    }
}
