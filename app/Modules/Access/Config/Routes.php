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
$routes->group("access", [
    "namespace" => "App\Modules\Access\Controllers"],
    function ($subroutes) {
        $subroutes->add("", "Companies::index");
        $subroutes->add("companies/view/(:any)", "Companies::view/$1");
        $subroutes->add("companies/table_companies", "Companies::table_companies");
        $subroutes->add("companies/frm_create", "Companies::frm_create");
        $subroutes->add("companies/frm_edit/(:any)", "Companies::frm_edit/$1");
        $subroutes->add("companies/create", "CompaniesProcess::create");
        $subroutes->add("companies/edit", "CompaniesProcess::edit");
        $subroutes->add("companies/list/(:any)", "Companies::list/$1");
        $subroutes->add("companies/jsonCompanies", "CompaniesSearchs::jsonCompanies");
        $subroutes->add("companies/languages", "CompaniesSearchs::Languages");
        $subroutes->add("companies/documents_identifications", "CompaniesSearchs::type_documents_identification");
        $subroutes->add("companies/countries", "CompaniesSearchs::countries");
        $subroutes->add("companies/currencies", "CompaniesSearchs::currencies");
        $subroutes->add("companies/type_organizations", "CompaniesSearchs::type_organizations");
        $subroutes->add("companies/type_regime", "CompaniesSearchs::type_regime");
        $subroutes->add("companies/type_liabilities", "CompaniesSearchs::type_liabilities");
        $subroutes->add("companies/municipalities", "CompaniesSearchs::municipalities");


        $subroutes->add("companies/api_create_company/(:any)", "CompaniesProcess::api_create_company/$1");
        $subroutes->add("companies/api_update_company/(:any)", "CompaniesProcess::api_update_company/$1");
        $subroutes->add("companies/receive_logo_company", "CompaniesProcess::receive_logo_company");
        $subroutes->add("companies/create_logo_company_api/(:any)", "CompaniesProcess::create_logo_company_api/$1");
        $subroutes->add("companies/create_software/(:any)", "CompaniesProcess::create_software/$1");
        $subroutes->add("companies/receive_certificate", "CompaniesProcess::receive_certificate");
        $subroutes->add("companies/create_certificate/(:any)", "CompaniesProcess::create_certificate/$1");
        $subroutes->add("companies/set_environment_api/(:any)", "CompaniesProcess::set_environment_api/$1");
        $subroutes->add("companies/get_numeration/(:any)", "CompaniesProcess::get_numeration/$1");

    }
);