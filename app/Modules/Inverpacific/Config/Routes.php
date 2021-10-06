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
 * Router del módulo InverPacific para gestión de créditos de motos
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-09-18
 * @updated 2021-09-18
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

use Config\Services;
$routes=!isset($routes)?service("routes"):$routes;
$routes->group("inverpacific", [
    "namespace" => "App\Modules\Inverpacific\Controllers"],
    function ($subroutes) {
        $subroutes->add("", "InverPacificDraw::index");
        $subroutes->add("list/(:any)", "InverPacificDraw::list/$1");
        $subroutes->add("business_sheet_draw", "InverPacificDraw::business_sheet_draw");
        $subroutes->add("form_business_sheet", "InverPacificDraw::form_business_sheet");
        $subroutes->add("business_sheet_severals_list", "InverPacificDraw::business_sheet_severals_list");
        $subroutes->add("business_several_add", "InverPacificProcess::business_several_add");
        $subroutes->add("business_sheet_severals_list_added", "InverPacificDraw::business_sheet_severals_list_added");
        $subroutes->add("business_sheet_totals", "InverPacificDraw::business_sheet_totals");
        
        $subroutes->add("business_sheet_field_edit", "InverPacificProcess::business_sheet_field_edit");
        $subroutes->add("business_several_adds_delete", "InverPacificProcess::business_several_adds_delete");
       
        $subroutes->add("thirds_searches", "InverPacificSearches::thirds_searches");
        $subroutes->add("type_sheets_searches", "InverPacificSearches::type_sheets_searches");
        $subroutes->add("financials_searches", "InverPacificSearches::financials_searches");
               
        
        $subroutes->add("motorcycles_list/(:any)", "MotorcyclesDraw::list/$1");
        $subroutes->add("trademarks_draw", "MotorcyclesDraw::trademarks_draw");
        $subroutes->add("trademark_form", "MotorcyclesDraw::trademark_form");
        $subroutes->add("save_trademark", "MotorcyclesProcess::save_trademark");
                
        $subroutes->add("colors_draw", "MotorcyclesDraw::colors_draw");
        $subroutes->add("color_form", "MotorcyclesDraw::color_form");
        $subroutes->add("save_color", "MotorcyclesProcess::save_color");
        
        $subroutes->add("motorcycles_draw", "MotorcyclesDraw::motorcycles_draw");
        $subroutes->add("motorcycle_form", "MotorcyclesDraw::motorcycle_form");
        $subroutes->add("save_motorcycle", "MotorcyclesProcess::save_motorcycle");
        $subroutes->add("trademarks_searches", "InverPacificSearches::trademarks_searches");
        
        
    }
);