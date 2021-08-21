<?php

use Config\Services;
$routes=!isset($routes)?service("routes"):$routes;
$routes->group("menu", [
    "namespace" => "App\Modules\Menu\Controllers"],
    function ($subroutes) {
        $subroutes->add("", "Menu::index");
        $subroutes->add("modules/(:num)", "Menu::show_modules/$1");
        $subroutes->add("components/(:num)/(:num)", "Menu::show_components/$1/$2");
        //$subroutes->add("companies", "Menu::get_html_companies");
        //$subroutes->add("html_modules/(:num)", "Menu::get_html_modules/$1");
    }
);
