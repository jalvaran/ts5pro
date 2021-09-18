<?php
/*
 *--------------------------------------------------------------------------
 *╔╦╗╔═╗╔═╗╦ ╦╔╗╔╔═╗
 * ║ ║╣ ║  ╠═╣║║║║ ║
 * ╩ ╚═╝╚═╝╩ ╩╝╚╝╚═╝
 *--------------------------------------------------------------------------
 * Copyright 2021 - Techno Soluciones S.A.S., Inc. <info@technosoluciones.com.co>
 * Este archivo es parte de TS5 Pro V 1.0
 * Para obtener información completa sobre derechos de autor y licencia, consulte
 * la LICENCIA archivo que se distribuyó con este código fuente.
 * -----------------------------------------------------------------------------
 * EL SOFTWARE SE PROPORCIONA -TAL CUAL-, SIN GARANTÍA DE NINGÚN TIPO, EXPRESA O
 * IMPLÍCITA, INCLUYENDO PERO NO LIMITADO A LAS GARANTÍAS DE COMERCIABILIDAD,
 * APTITUD PARA UN PROPÓSITO PARTICULAR Y NO INFRACCIÓN. EN NINGÚN CASO SERÁ
 * LOS AUTORES O TITULARES DE LOS DERECHOS DE AUTOR SERÁN RESPONSABLES DE CUALQUIER RECLAMO, DAÑOS U OTROS
 * RESPONSABILIDAD, YA SEA EN UNA ACCIÓN DE CONTRATO, AGRAVIO O DE OTRO MODO, QUE SURJA
 * DESDE, FUERA O EN RELACIÓN CON EL SOFTWARE O EL USO U OTROS
 * NEGOCIACIONES EN EL SOFTWARE.
 * -----------------------------------------------------------------------------
 * Router del módulo Access
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-08-26
 * @updated 2021-08-26
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

use Config\Services;
$routes=!isset($routes)?service("routes"):$routes;
$routes->group("admin", [
    "namespace" => "App\Modules\Admin\Controllers"],
    function ($subroutes) {
        $subroutes->add("", "AdminController::index");
        $subroutes->add("list/(:any)", "AdminController::list/$1");
        $subroutes->add("roles_list", "AdminController::roles_list");
        $subroutes->add("users_list", "AdminController::users_list");
        
        $subroutes->add("frm_create_role", "AdminController::frm_create_role");
        $subroutes->add("frm_create_user", "AdminController::frm_create_user");
        
        $subroutes->add("save_role", "AdminProcess::save_role");
        $subroutes->add("save_user", "AdminProcess::save_user");
        
        $subroutes->add("permissions_searches", "AdminProcess::permissions_searches");
        $subroutes->add("municipalities_searches", "AdminProcess::municipalities_searches");
        $subroutes->add("add_permission_role", "AdminProcess::add_permission_role");
        $subroutes->add("delete_permission_role", "AdminProcess::delete_permission_role");
        $subroutes->add("role_view", "AdminController::role_view");
        $subroutes->add("roles_permissions_list", "AdminController::roles_permissions_list");
        
        $subroutes->add("user_view", "AdminController::user_view");
        $subroutes->add("user_roles_list", "AdminController::user_roles_list");  
        $subroutes->add("roles_searches", "AdminProcess::roles_searches");
        $subroutes->add("add_role_user", "AdminProcess::add_role_user");
        $subroutes->add("delete_role_user", "AdminProcess::delete_role_user");
        
        
        $subroutes->add("branches_list", "AdminController::branches_list");
        $subroutes->add("frm_create_branch", "AdminController::frm_create_branch");
        $subroutes->add("save_branch", "AdminProcess::save_branch");
        $subroutes->add("branches_user_view", "AdminController::branches_user_view");
        $subroutes->add("branches_user_list", "AdminController::branches_user_list");
        $subroutes->add("branches_searches", "AdminProcess::branches_searches");
        $subroutes->add("add_branch_user", "AdminProcess::add_branch_user");
        $subroutes->add("delete_branch_user", "AdminProcess::delete_branch_user");
        
        $subroutes->add("cost_centers_list", "AdminController::cost_centers_list");
        $subroutes->add("frm_create_cost_center", "AdminController::frm_create_cost_center");
        $subroutes->add("save_cost_center", "AdminProcess::save_cost_center");     
        

    }
);