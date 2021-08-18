<?php

use Config\Services;
$routes=!isset($routes)?service("routes"):$routes;
$routes->group("login", [
    "namespace" => "App\Modules\Login\Controllers"],
    function ($routes) {
        //$routes->get("", "Login::index");
        //$routes->post("validate", "Login::validate_pass");
        //$routes->get("validate", "Login::validate_pass");
        //$routes->get("validate/(:any)", "Login::validate/$1");
        //$routes->get("validate/(:any)/(:any)", "Login::validate/$1/$2");
        $routes->add("", "Login::index");//https://dominio/login
        $routes->add("logout", "Login::logout");//https://dominio/login/logout
    }
);
