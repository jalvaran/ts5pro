<?php

use Config\Services;
$routes=!isset($routes)?service("routes"):$routes;
$routes->group("ts5", [
    "namespace" => "App\Modules\TS5\Controllers"],
    function ($routes) {
        $routes->add("", "TS5::index");//https://dominio/TS5
        $routes->add("signin", "TS5::signin");//https://dominio/ts5/signin
        $routes->add("signup", "TS5::signup");//https://dominio/ts5/signup
        $routes->add("signout", "TS5::signout");//https://dominio/ts5/signout
    }
);