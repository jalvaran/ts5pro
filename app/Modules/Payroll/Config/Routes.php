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
 * Router del módulo de nómina
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-11-15
 * @updated 2021-11-17
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

use Config\Services;
$routes=!isset($routes)?service("routes"):$routes;
$routes->group("payroll", [
    "namespace" => "App\Modules\Payroll\Controllers"],
    function ($subroutes) {
        $subroutes->add("", "PayrollDraw::index");
        $subroutes->add("admin/(:any)", "PayrollDraw::home/$1");
        
        $subroutes->add("employees_draw", "PayrollDraw::employees_draw");
        $subroutes->add("form_employee", "PayrollDraw::form_employee");
        
        $subroutes->add("type_worker_searches", "PayrollSearches::type_worker_searches");
        $subroutes->add("subtype_worker_searches", "PayrollSearches::subtype_worker_searches");
        $subroutes->add("company_groups_searches", "PayrollSearches::company_groups_searches");        
        $subroutes->add("employees_position_searches", "PayrollSearches::employees_position_searches");
        $subroutes->add("type_contract_searches", "PayrollSearches::type_contract_searches");
        $subroutes->add("reasons_withdrawal_searches", "PayrollSearches::reasons_withdrawal_searches");
        $subroutes->add("eps_code_searches", "PayrollSearches::eps_code_searches");
        $subroutes->add("afp_code_searches", "PayrollSearches::afp_code_searches");
        $subroutes->add("arl_code_searches", "PayrollSearches::arl_code_searches");
        $subroutes->add("arl_level_id_searches", "PayrollSearches::arl_level_id_searches");
        $subroutes->add("ccf_code_searches", "PayrollSearches::ccf_code_searches");
        $subroutes->add("period_id_searches", "PayrollSearches::period_id_searches");
        
        $subroutes->add("save_employee", "PayrollProcess::save_employee");
        $subroutes->add("add_earn", "PayrollProcess::add_earn");
        $subroutes->add("add_deduction", "PayrollProcess::add_deduction");
        
        $subroutes->add("documents/(:any)", "PayrollDocumentsDraw::documents/$1");
        $subroutes->add("general_documents", "PayrollDocumentsDraw::general_documents");
        $subroutes->add("individual_documents", "PayrollDocumentsDraw::individual_documents");
        $subroutes->add("novelties_form_fields_earns", "PayrollDocumentsDraw::novelties_form_fields_earns");
        $subroutes->add("novelties_form_fields_deductions", "PayrollDocumentsDraw::novelties_form_fields_deductions");
        $subroutes->add("notes_documents_draw", "PayrollDocumentsDraw::notes_documents_draw");
        
        
        
        $subroutes->add("avaible_employees_list", "PayrollDocumentsDraw::avaible_employees_list");
        $subroutes->add("added_employees_list", "PayrollDocumentsDraw::added_employees_list");
        $subroutes->add("form_general_document", "PayrollDocumentsDraw::form_general_document");
        $subroutes->add("novelties_form", "PayrollDocumentsDraw::novelties_form");
        $subroutes->add("notes_form", "PayrollDocumentsDraw::notes_form");
        $subroutes->add("sumary_noventlies_general", "PayrollDocumentsDraw::sumary_noventlies_general");        
        
        $subroutes->add("save_general_document", "PayrollProcess::save_general_document");
        $subroutes->add("save_note", "PayrollProcess::save_note");
        $subroutes->add("documents_counts", "PayrollProcess::documents_counts");
        $subroutes->add("employee_add", "PayrollProcess::employee_add");
        $subroutes->add("build_individual_documents", "PayrollProcess::build_individual_documents");
        $subroutes->add("report_individual_document", "PayrollProcess::report_individual_document");
        $subroutes->add("report_note", "PayrollProcess::report_note");
        $subroutes->add("check_status_zip_key", "PayrollProcess::check_status_zip_key");
        $subroutes->add("get_json_payroll_report", "PayrollProcess::get_json_payroll_report");
        $subroutes->add("get_json_payroll_note", "PayrollProcess::get_json_payroll_note");
        
        $subroutes->add("delete_earn_deduction_noventlie", "PayrollProcess::delete_earn_deduction_noventlie");
        $subroutes->add("times_value_calculation", "PayrollProcess::times_value_calculation");
        
        $subroutes->add("employee_add_all_general_document", "PayrollProcess::employee_add_all_general_document");
        $subroutes->add("employee_delete_all_general_document", "PayrollProcess::employee_delete_all_general_document");
        
        $subroutes->add("employee_delete_general_document", "PayrollProcess::employee_delete_general_document");
        
        
        $subroutes->add("employee_payroll_add_draw", "PayrollDocumentsDraw::employee_payroll_add_draw");
        
        
    }
);