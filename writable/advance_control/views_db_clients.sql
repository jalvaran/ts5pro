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
    (SELECT `identification` FROM techno_ts5_pro.access_control_users t4 WHERE t4.id=t1.author limit 1) as author_identification
    
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
