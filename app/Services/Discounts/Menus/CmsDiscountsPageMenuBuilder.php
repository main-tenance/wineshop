<?php


namespace App\Services\Discounts\Menus;


use App\Http\Routes\Cms\CmsRoutes;
use App\Http\Routes\Cms\CmsRoutesProvider;
use App\Menus\PageMenuBuilder;

class CmsDiscountsPageMenuBuilder extends PageMenuBuilder
{

    public function setMenu()
    {
        $this->menu = [
            CmsRoutes::DISCOUNT_INDEX => ['index' => 1, 'url' => CmsRoutesProvider::discountIndex(), 'caption' => __('discounts.cmsIndexTitle')],
            CmsRoutes::DISCOUNT_CREATE => ['index' => 2, 'url' => CmsRoutesProvider::discountCreate(), 'caption' => __('discounts.cmsCreateTitle')],
        ];
    }

}
