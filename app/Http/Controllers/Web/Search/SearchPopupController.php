<?php

namespace App\Http\Controllers\Web\Search;

use App\Http\Controllers\Controller;
use App\Services\Search\SearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SearchPopupController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke(Request $request)
    {
        $findedOffers = $this->getSearchService()->getFindedOffers($request->get('q'));
        View::share(['offers' => $findedOffers]);

        return view('search.popup');
    }

    public function getSearchService()
    {
        return app(SearchService::class);
    }
}
