<?php


namespace App\Services\Creators\Menus;


use App\Http\Routes\Cms\CmsRoutes;
use App\Http\Routes\Cms\CmsRoutesProvider;
use App\Menus\PageMenuBuilder;

class CmsCreatorsPageMenuBuilder extends PageMenuBuilder
{

    public function setMenu()
    {
        $this->menu = [
            CmsRoutes::CREATOR_INDEX => ['index' => 1, 'url' => CmsRoutesProvider::creatorIndex(), 'caption' => __('creators.cmsIndexTitle')],
            CmsRoutes::CREATOR_CREATE => ['index' => 2, 'url' => CmsRoutesProvider::creatorCreate(), 'caption' => __('creators.cmsCreateTitle')],
        ];
    }

}
