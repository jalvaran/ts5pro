<?php

$routes->group("demo", ["namespace" => "\Modules\Demo\Controllers"], function ($routes) {

	// welcome page - URL: /student
	$routes->get("/", "Demo::index");
  
    // other page - URL: /student/other-method
	$routes->get("blank", "Demo::blank");
        $routes->get("show_modules", "Demo::show_modules");
        $routes->get("fercho", "Demo::fercho");

});

