<?php

namespace App\Modules\Access\Controllers;

use App\Controllers\BaseController;


class Companies extends BaseController
{

    function index() {
        return("Companies");
    }

    function view($id) {
        return(view('App\Modules\Access\Views\Companies\View\index',array("id"=>$id)));
    }

    function list() {
        return("list");
    }
    function create() {
        return("create ");
    }
    function edit($id) {
        return("edit {$id}");
    }
    function delete($id) {
        return("delete {$id}");
    }




}