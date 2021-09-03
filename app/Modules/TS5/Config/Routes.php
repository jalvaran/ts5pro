<?php

use Config\Services;
$routes=!isset($routes)?service("routes"):$routes;
$routes->group("ts5", [
    "namespace" => "App\Modules\TS5\Controllers"],
    function ($routes) {
        $routes->add("", "TS5::index");
        $routes->add("signin", "TS5::signin");
        $routes->add("signup", "TS5::signup");
        $routes->add("signout", "TS5::signout");


    }
);