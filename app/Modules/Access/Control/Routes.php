<?php

use Config\Services;
$routes=!isset($routes)?service("routes"):$routes;
$routes->group("access", [
    "namespace" => "App\Modules\Access\Controllers"],
    function ($routes) {
        $routes->add("", "Access::index");

    }
);