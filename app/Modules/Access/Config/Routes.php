<?php

use Config\Services;
$routes=!isset($routes)?service("routes"):$routes;
$routes->group("access", [
    "namespace" => "App\Modules\Access\Controllers"],
    function ($subroutes) {
        $subroutes->add("", "Companies::index");

        $subroutes->add("companies/view/(:any)", "Companies::view/$1");
        $subroutes->add("companies/table_companies", "Companies::table_companies");
        $subroutes->add("companies/frmCompany", "Companies::frm_company");
        $subroutes->add("companies/edit/(:any)", "Companies::edit/$1");
        $subroutes->add("companies/delete/(:any)", "Companies::delete/$1");
        $subroutes->add("companies/create", "Companies::create");
        $subroutes->add("companies/list/(:any)", "Companies::list/$1");
        $subroutes->add("companies/jsonCompanies", "CompaniesProcess::jsonCompanies");
    }
);