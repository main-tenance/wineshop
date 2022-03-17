<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cms\Discounts\CreateDiscountFormRequest;
use App\Http\Requests\Cms\Discounts\UpdateDiscountFormRequest;
use App\Models\Discount;
use App\Policies\Permission;
use App\Services\Discounts\DiscountsService;
use App\Services\Discounts\Forms\CmsDiscountCreateFormBuilder;
use App\Services\Discounts\Forms\CmsDiscountEditFormBuilder;
use App\Services\Discounts\Menus\CmsDiscountsPageMenuBuilder;
use App\Services\Discounts\Tables\CmsDiscountsTableBuilder;
use App\Http\Routes\Cms\CmsRoutesProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Http\JsonResponse;

class CmsDiscountController extends Controller
{
    public function getDiscountsService()
    {
        return app(DiscountsService::class);
    }

    public function getCmsDiscountsTable()
    {
        return app(CmsDiscountsTableBuilder::class);
    }

    public function getCmsDiscountCreateForm()
    {
        return app(CmsDiscountCreateFormBuilder::class);
    }

    public function getCmsDiscountEditForm()
    {
        return app(CmsDiscountEditFormBuilder::class);
    }

    public function getCmsDiscountsMenu()
    {
        return app(CmsDiscountsPageMenuBuilder::class);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize(Permission::VIEW_ANY, Discount::class);
        $table = $this->getCmsDiscountsTable();
        $pageMenu = $this->getCmsDiscountsMenu();
        View::share([
            'table' => $table,
            'pageMenu' => $pageMenu,
            'url' => CmsRoutesProvider::discountIndex(),
        ]);
        if (request()->expectsJson()) {
            return response()->json([
                'html' => view('table.list')->render(),
                'pagination' => view('table.pagination-inner')->render(),
                'pagecount' => $table->getPageCount(),
                'pageid' => $table->getPageId(),
            ]);
        }

        return view('cms.discounts.index');
    }

    public function create()
    {
        $this->authorize(Permission::CREATE, Discount::class);
        $pageMenu = $this->getCmsDiscountsMenu();
        $form = $this->getCmsDiscountCreateForm();
        View::share([
            'form' => $form,
            'url' => CmsRoutesProvider::discountStore(),
            'pageMenu' => $pageMenu
        ]);

        return view('cms.discounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateDiscountFormRequest $request
     * @return JsonResponse
     */
    public function store(CreateDiscountFormRequest $request)
    {
        $this->authorize(Permission::CREATE, Discount::class);
        $discount = $this->getDiscountsService()->createDiscount($request->getFormData());

        return response()->json(['ok' => 1, 'id' => $discount->id]);
    }


    public function edit(Discount $discount)
    {
        $this->authorize(Permission::UPDATE, $discount);
        $pageMenu = $this->getCmsDiscountsMenu();
        $form = $this->getCmsDiscountEditForm();
        View::share([
            'model' => $discount,
            'form' => $form,
            'url' => CmsRoutesProvider::discountUpdate($discount),
            'pageMenu' => $pageMenu
        ]);

        Cache::restoreLock('discount-update', session('discount-update.owner'))
            ->release();
        $lock = Cache::lock('discount-update', 100);
        if ($lock->get()) {
            session(['discount-update.owner' => $lock->owner()]);
            return view('cms.discounts.edit');
        } else {
            return view('cms.discounts.edit-blocked');
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDiscountFormRequest $request
     * @param Discount $discount
     * @return JsonResponse
     */
    public function update(Discount $discount, UpdateDiscountFormRequest $request)
    {
        $this->authorize(Permission::UPDATE, $discount);
        $this->getDiscountsService()->updateDiscount($discount, $request->getFormData());
        Cache::restoreLock('discount-update', session('discount-update.owner'))
            ->release();

        return response()->json(['ok' => 1, 'message' => __('app.info_saved')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Discount $discount
     * @return JsonResponse
     */
    public function destroy(Discount $discount)
    {
        $this->authorize(Permission::DELETE, $discount);
        $this->getDiscountsService()->destroy($discount);

        return response()->json(['ok' => 1]);;
    }
}
