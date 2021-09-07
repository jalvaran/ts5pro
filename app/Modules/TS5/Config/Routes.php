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
        $routes->add("tables_draw/(:any)/(:any)", "TablesDraw::tables_draw/$1/$2");
        $routes->add("frm_tables_draw/(:any)/(:any)", "TablesDraw::frm_tables_draw/$1/$2");
        $routes->add("tables_json/(:any)", "TablesProcess::tables_json/$1");
        $routes->add("tables_create_register", "TablesProcess::tables_create_register");
        $routes->add("tables_edit_register", "TablesProcess::tables_edit_register");
        $routes->add("tables_searchs", "TablesProcess::tables_searchs");

    }
);