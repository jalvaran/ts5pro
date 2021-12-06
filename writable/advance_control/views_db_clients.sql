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
 * vistas de las bases de datos de los clientes
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-09-21
 * @updated 2021-09-21 
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */


DROP VIEW IF EXISTS `view_creditmoto_business_sheet`;
CREATE VIEW view_creditmoto_business_sheet AS
SELECT t1.*,
    t2.`name` as status_name,
    (SELECT `name` FROM app_thirds t6 WHERE t6.id=t1.app_thirds_id limit 1) as third_name,
    (SELECT `identification` FROM app_thirds t6 WHERE t6.id=t1.app_thirds_id limit 1) as third_identification,
     
    (SELECT `name` FROM creditmoto_business_sheet_types t5 WHERE t5.id=t1.creditmoto_business_sheet_types_id limit 1) as creditmoto_business_sheet_types_name,
    (SELECT `name` FROM creditmoto_financial t7 WHERE t7.id=t1.financial_id limit 1) as financial_name,
    
    (SELECT `name` FROM creditmoto_motorcycles t7 WHERE t7.id=t1.motorcycle_id limit 1) as motorcycle_name,
    (SELECT `trademark` FROM creditmoto_motorcycles t7 WHERE t7.id=t1.motorcycle_id limit 1) as trademark,
    (SELECT `name` FROM creditmoto_trademarks t7 WHERE t7.id=(SELECT trademark) limit 1) as trademark_name,
    (SELECT `name` FROM creditmoto_colors t7 WHERE t7.id=t1.color_id limit 1) as color_name,
         
    (SELECT `name` FROM techno_ts5_pro.access_control_users t4 WHERE t4.id=t1.author limit 1) as author_name,
    (SELECT `identification` FROM techno_ts5_pro.access_control_users t4 WHERE t4.id=t1.author limit 1) as author_identification,
    
    (SELECT `name` FROM techno_ts5_pro.access_control_users t4 WHERE t4.id=t1.author_reject limit 1) as author_reject_name,
    (SELECT `identification` FROM techno_ts5_pro.access_control_users t4 WHERE t4.id=t1.author_reject limit 1) as author_reject_identification,
    
    (SELECT `name` FROM techno_ts5_pro.access_control_users t4 WHERE t4.id=t1.author_pre_approved limit 1) as author_pre_approved_name,
    (SELECT `identification` FROM techno_ts5_pro.access_control_users t4 WHERE t4.id=t1.author_pre_approved limit 1) as author_pre_approved_identification,
    
    (SELECT `name` FROM techno_ts5_pro.access_control_users t4 WHERE t4.id=t1.author_approved limit 1) as author_approved_name,
    (SELECT `identification` FROM techno_ts5_pro.access_control_users t4 WHERE t4.id=t1.author_approved limit 1) as author_approved_identification 
    


    FROM `creditmoto_business_sheet` t1 
    INNER JOIN creditmoto_business_sheet_status t2 ON t1.status=t2.id;
    
    



DROP VIEW IF EXISTS `view_app_thirds`;
CREATE VIEW view_app_thirds AS
SELECT t1.*,
    (SELECT `name` FROM techno_ts5_pro.app_cat_type_organizations t2 WHERE t2.id=t1.type_organization_id limit 1) as type_organization_name,
    (SELECT `name` FROM techno_ts5_pro.app_cat_type_regimes t2 WHERE t2.id=t1.type_regime_id limit 1) as type_regime_name,
    (SELECT `name` FROM techno_ts5_pro.app_cat_type_liabilities t2 WHERE t2.id=t1.type_liabilitie_id limit 1) as type_liabilitie_name,
    (SELECT `name` FROM techno_ts5_pro.app_cat_type_document_identifications t2 WHERE t2.id=t1.type_document_identification_id limit 1) as type_document_identification_name,
    (SELECT `name` FROM techno_ts5_pro.app_cat_municipalities t2 WHERE t2.id=t1.municipalities_id limit 1) as municipalities_name,
     
    (SELECT `name` FROM techno_ts5_pro.app_cat_departments t2 WHERE t2.id=t1.departments_id limit 1) as departments_name,
    (SELECT `name` FROM techno_ts5_pro.app_cat_countries t2 WHERE t2.id=t1.countries_id limit 1) as countries_name,
    (SELECT `name` FROM techno_ts5_pro.access_control_users t4 WHERE t4.id=t1.author limit 1) as author_name 
    
    FROM `app_thirds` t1 ;




DROP VIEW IF EXISTS `view_creditmoto_motorcycles`;
CREATE VIEW view_creditmoto_motorcycles AS
SELECT t1.*,
    (SELECT `name` FROM creditmoto_trademarks t2 WHERE t2.id=t1.trademark limit 1) as trademark_name,    
    (SELECT `name` FROM techno_ts5_pro.access_control_users t4 WHERE t4.id=t1.author limit 1) as author_name 
    
    FROM `creditmoto_motorcycles` t1 ;



DROP VIEW IF EXISTS `view_creditmoto_business_sheet_attachments`;
CREATE VIEW view_creditmoto_business_sheet_attachments AS
SELECT t1.*,
    (SELECT `name` FROM creditmoto_business_sheet_types_documents t2 WHERE t2.id=t1.document_id limit 1) as document_name,  
    (SELECT `name` FROM techno_ts5_pro.access_control_users t4 WHERE t4.id=t1.author limit 1) as author_name 
    
    FROM `creditmoto_business_sheet_attachments` t1 ;


DROP VIEW IF EXISTS `view_payroll_employees`;
CREATE VIEW view_payroll_employees AS
SELECT t1.*,t2.type_document_identification_id,t2.identification,t2.firts_name,
    t2.second_name,t2.surname,t2.second_surname,
    t2.`name`,t2.address,t2.telephone1,t2.telephone2, t2.mail, t2.type_document_identification_name, 
    t2.municipalities_id,t2.municipalities_name,t2.departments_name,t2.author_name,
    (SELECT `name` from payroll_type_workers t3 WHERE t3.id=t1.type_worker_id LIMIT 1) as type_worker_name,
    (SELECT `name` from payroll_subtype_workers t3 WHERE t3.id=t1.subtype_worker_id LIMIT 1) as subtype_worker_name, 
    (SELECT `name` from payroll_company_groups t3 WHERE t3.id=t1.company_group_id LIMIT 1) as company_group_name, 
    (SELECT `name` from payroll_employees_positions t3 WHERE t3.id=t1.employees_position_id LIMIT 1) as employees_position_name, 
    (SELECT `name` from payroll_type_contracts t3 WHERE t3.id=t1.type_contract_id LIMIT 1) as type_contract_name, 
    (SELECT `name` from app_health_administrators t3 WHERE t3.code=t1.eps_code LIMIT 1) as eps_name, 
    (SELECT `name` from app_health_administrators t3 WHERE t3.code=t1.afp_code LIMIT 1) as afp_name, 
    (SELECT `name` from app_health_administrators t3 WHERE t3.code=t1.arl_code LIMIT 1) as arl_name, 
    (SELECT `name` from app_health_administrators t3 WHERE t3.code=t1.ccf_code LIMIT 1) as ccf_name, 
    (SELECT `name` from payroll_arl_levels t3 WHERE t3.id=t1.arl_level_id LIMIT 1) as arl_level_name, 
    (SELECT `percent` from payroll_arl_levels t3 WHERE t3.id=t1.arl_level_id LIMIT 1) as arl_level_percent, 
    (SELECT `name` from payroll_periods t3 WHERE t3.id=t1.period_id LIMIT 1) as period_name, 
    (SELECT `name` from payroll_reasons_withdrawal t3 WHERE t3.id=t1.reasons_withdrawal_id LIMIT 1) as reasons_withdrawal_name  

    FROM `payroll_employees` t1 
    INNER JOIN view_app_thirds t2 ON t1.third_id=t2.id
    
    ;



DROP VIEW IF EXISTS `view_payroll_documents`;
CREATE VIEW view_payroll_documents AS
SELECT t1.*,
    (SELECT `name` FROM payroll_documents_status t2 WHERE t2.id=t1.status limit 1) as status_name,
    (SELECT `name` FROM payroll_periods t2 WHERE t2.id=t1.payroll_period_id limit 1) as payroll_period_name,
    (SELECT `name` FROM app_payment_forms t2 WHERE t2.id=t1.payment_form limit 1) as payment_form_name,
    (SELECT `name` FROM app_payment_methods t2 WHERE t2.id=t1.payment_method_id limit 1) as payment_method_name,
    
    (SELECT `name` FROM techno_ts5_pro.access_control_users t4 WHERE t4.id=t1.author limit 1) as author_name 
    
    FROM `payroll_documents` t1 ;



DROP VIEW IF EXISTS `view_payroll_individual_documents`;
CREATE VIEW view_payroll_individual_documents AS
SELECT t1.*,t3.settlement_start_date,t3.settlement_end_date,t3.consecutive as payroll_documents_consecutive,
        t3.date_issue,t3.time_issue,t3.payment_dates,
        t3.description,t3.payroll_period_id,t3.payment_form,t3.payment_method_id,t3.status as payroll_documents_status,
        t2.third_id,t2.type_worker_id,t2.subtype_worker_id,t2.company_group_id,t2.employees_position_id,t2.high_risk_pension,t2.integral_salary,t2.type_contract_id,t2.start_date,
        t2.finish_date,t2.salary,t2.eps_code,t2.afp_code,t2.arl_code,t2.arl_level_id,
        t2.ccf_code,t2.period_id,t2.bank,t2.account_type,t2.account_number,t2.active,
        t2.reasons_withdrawal_id,t2.type_document_identification_id,t2.identification,t2.firts_name,t2.second_name,t2.surname,
        t2.second_surname,t2.`name`,t2.address,t2.telephone1,t2.telephone2,t2.mail,
        t2.type_document_identification_name,t2.municipalities_id,t2.municipalities_name,t2.departments_name,t2.type_worker_name,
        t2.subtype_worker_name,t2.`company_group_name`,t2.employees_position_name,t2.type_contract_name,t2.eps_name,t2.afp_name,
        t2.arl_name,t2.`ccf_name`,t2.arl_level_name,t2.arl_level_percent,t2.period_name,t2.reasons_withdrawal_name,
        
        (SELECT IFNULL((SELECT SUM(payment) FROM payroll_documents_earns t4 WHERE t4.payroll_documents_id=t1.payroll_documents_id AND t4.payroll_employee_id=t1.payroll_employee_id AND ISNULL(deleted_at) ),0)) as accrued_total,
        (SELECT IFNULL((SELECT SUM(payment) FROM payroll_documents_deductions t4 WHERE t4.payroll_documents_id=t1.payroll_documents_id AND t4.payroll_employee_id=t1.payroll_employee_id AND ISNULL(deleted_at) ),0)) as deductions_total,
        
        ((SELECT accrued_total)-(SELECT deductions_total) ) as total,

        (SELECT `name` FROM techno_ts5_pro.access_control_users t4 WHERE t4.id=t1.author limit 1) as author_name 
    
        
    FROM `payroll_individual_documents` t1 
    INNER JOIN view_payroll_employees t2 ON t1.payroll_employee_id=t2.id 
    INNER JOIN payroll_documents t3 ON t3.id=t1.payroll_documents_id
    
    ;

