<?php

namespace App\Menus;



abstract class PageMenuBuilder
{

    protected $menu, $pageIndex;


    public function __construct()
    {
        $this->setMenu();
    }


    abstract protected function setMenu();


    public function getMenu($currentRouteName)
    {
        $menu = $this->menu;
        if (isset($menu[$currentRouteName])) {
            unset($menu[$currentRouteName]);
        }

        return array_column($menu, null, 'index');
    }

}
