<?php

namespace App\Menus;

use App\Http\Routes\Cms\CmsRoutesProvider;
use App\Http\Routes\Web\WebRoutesProvider;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class MainMenu
{
    public static function getMainMenu()
    {
        $menu = [
            [
                'link' => WebRoutesProvider::aboutIndex(),
                'text' => __('app.menu.about')
            ],
            [
                'link' => WebRoutesProvider::creatorIndex(),
                'text' => __('app.menu.creators')
            ],
            [
                'link' => WebRoutesProvider::userEdit(),
                'text' => __('app.menu.profile')
            ],
            [
                'link' => WebRoutesProvider::passportIndex(),
                'text' => __('app.menu.passport')
            ],
        ];

        if (Auth::check()) {
            $user = User::find(Auth::id());
            if ($user->isManager()) {
                $menu[] = [
                    'link' => CmsRoutesProvider::creatorIndex(),
                    'text' => __('app.menu.makers')
                ];
                $menu[] = [
                    'link' => CmsRoutesProvider::discountIndex(),
                    'text' => __('app.menu.discounts')
                ];
            }
        }

        return $menu;
    }
}
