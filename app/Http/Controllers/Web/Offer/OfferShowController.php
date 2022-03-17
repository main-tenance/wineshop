<?php

namespace App\Http\Controllers\Web\Offer;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Support\Facades\View;

class OfferShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param string $code
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke(Offer $offer)
    {
        if (!$offer) {
            abort(404);
        }

        View::share(['offer' => $offer]);

        return view('offers.show');
    }
}
