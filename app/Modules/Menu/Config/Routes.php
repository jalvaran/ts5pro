<?php

use Config\Services;
$routes=!isset($routes)?service("routes"):$routes;
$routes->group("menu", [
    "namespace" => "App\Modules\Menu\Controllers"],
    function ($routes) {
        $routes->add("", "Menu::index");
        $routes->add("modules/(:num)", "Menu::show_modules/$1");
        $routes->add("companies", "Menu::get_html_companies");
    }
);
