<?php

use Config\Services;
$routes=!isset($routes)?service("routes"):$routes;
$routes->group("menu", [
    "namespace" => "App\Modules\Menu\Controllers"],
    function ($subroutes) {
        $subroutes->add("", "Menu::index");
        $subroutes->add("modules/(:any)", "Menu::show_modules/$1");
        $subroutes->add("components/(:any)/(:any)", "Menu::show_components/$1/$2");

    }
);
