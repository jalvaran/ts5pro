<?php
$html='';
$input["div_class"]="col-md-4";
$input["id"]="name";
$input["label"]=lang('Access.companies_frm_input_name');
$input["type"]="text";
//$input["icon"]="fa fa-home";
$input["value"]=(isset($data_form["name"])) ? $data_form["name"] : '';
$input["placeholder"]=lang('Access.companies_frm_input_name');
$html.=view($views_path."/frm_input",$input);

$input["id"]="address";
$input["label"]=lang('Access.companies_frm_input_address');
$input["type"]="text";
$input["value"]=(isset($data_form["address"])) ? $data_form["address"] : '';
$input["placeholder"]=$input["label"];
$html.=view($views_path."/frm_input",$input);

$input["id"]="phone";
$input["label"]=lang('Access.companies_frm_input_phone');
$input["type"]="text";
$input["value"]=(isset($data_form["phone"])) ? $data_form["phone"] : '';
$input["placeholder"]=$input["label"];
$html.=view($views_path."/frm_input",$input);

$input["id"]="description";
$input["label"]=lang('Access.companies_frm_input_description');
$input["type"]="text";
$input["value"]=(isset($data_form["description"])) ? $data_form["description"] : '';
$input["placeholder"]=lang('Access.companies_frm_input_description');
$html.=view($views_path."/frm_input",$input);

$input["id"]="type_document_identification_id";
$input["label"]=lang('Access.companies_frm_input_type_document_identification_id');
$input["options"][0]["value"]=(isset($data_form["type_document_identification_id"])) ? $data_form["type_document_identification_id"] : '';
$input["options"][0]["text"]=(isset($data_form["name_type_document"])) ? $data_form["name_type_document"] : lang('Access.companies_frm_input_selectors_value_initial');
$html.=view($views_path."/frm_select",$input);

$input["id"]="identification";
$input["label"]=lang('Access.companies_frm_input_identification');
$input["type"]="text";
$input["value"]=(isset($data_form["identification"])) ? $data_form["identification"] : '';
$input["placeholder"]=$input["label"];
$html.=view($views_path."/frm_input",$input);

$input["id"]="mail";
$input["label"]=lang('Access.companies_frm_input_mail');
$input["type"]="text";
$input["value"]=(isset($data_form["mail"])) ? $data_form["mail"] : '';
$input["placeholder"]=$input["label"];
$html.=view($views_path."/frm_input",$input);

$input["id"]="country_id";
$input["label"]=lang('Access.companies_frm_input_country_id');
$input["options"][0]["value"]=(isset($data_form["country_id"])) ? $data_form["country_id"] : '46';
$input["options"][0]["text"]=(isset($data_form["name_country_id"])) ? $data_form["name_country_id"] : 'Colombia';

$html.=view($views_path."/frm_select",$input);


unset($input);

$input["div_class"]="col-md-4";

$input["id"]="municipality_id";
$input["label"]=lang('Access.companies_frm_input_municipality_id');
$input["options"][0]["value"]=(isset($data_form["municipality_id"])) ? $data_form["municipality_id"] : '';
$input["options"][0]["text"]=(isset($data_form["name_municipality_id"])) ? $data_form["name_municipality_id"] : lang('Access.companies_frm_input_selectors_value_initial');

$html.=view($views_path."/frm_select",$input);

$input["id"]="type_organization_id";
$input["label"]=lang('Access.companies_frm_input_type_organization_id');
$input["options"][0]["value"]=(isset($data_form["type_organization_id"])) ? $data_form["type_organization_id"] : '';
$input["options"][0]["text"]=(isset($data_form["name_type_organization_id"])) ? $data_form["name_type_organization_id"] : lang('Access.companies_frm_input_selectors_value_initial');

$html.=view($views_path."/frm_select",$input);

$input["id"]="type_regime_id";
$input["label"]=lang('Access.companies_frm_input_type_regime_id');
$input["options"][0]["value"]=(isset($data_form["type_regime_id"])) ? $data_form["type_regime_id"] : '';
$input["options"][0]["text"]=(isset($data_form["name_type_regime_id"])) ? $data_form["name_type_regime_id"] : lang('Access.companies_frm_input_selectors_value_initial');

$html.=view($views_path."/frm_select",$input);

$input["id"]="language_id";
$input["label"]=lang('Access.companies_frm_input_language_id');
$input["options"][0]["value"]=(isset($data_form["language_id"])) ? $data_form["language_id"] : '79';
$input["options"][0]["text"]=(isset($data_form["name_language"])) ? $data_form["name_language"] : 'Spanish';
$html.=view($views_path."/frm_select",$input);

unset($input);

$input["div_class"]="col-md-4";

$input["id"]="type_currency_id";
$input["label"]=lang('Access.companies_frm_input_type_currency_id');
$input["options"][0]["value"]=(isset($data_form["type_currency_id"])) ? $data_form["type_currency_id"] : '35';
$input["options"][0]["text"]=(isset($data_form["name_type_currency_id"])) ? $data_form["name_type_currency_id"] : 'Peso Colombiano';
$html.=view($views_path."/frm_select",$input);

unset($input);
$input["div_class"]="col-md-4";


$input["id"]="type_liability_id";
$input["label"]=lang('Access.companies_frm_input_type_liability_id');
$input["options"][0]["value"]=(isset($data_form["type_liability_id"])) ? $data_form["type_liability_id"] : '';
$input["options"][0]["text"]=(isset($data_form["name_type_liability_id"])) ? $data_form["name_type_liability_id"] : lang('Access.companies_frm_input_selectors_value_initial');


$html.=view($views_path."/frm_select",$input);

$input["id"]="ciius";
$input["label"]=lang('Access.companies_frm_input_ciius');
$input["type"]="text";
$input["value"]=(isset($data_form["ciius"])) ? $data_form["ciius"] : '';
$input["placeholder"]=$input["label"];
$html.=view($views_path."/frm_input",$input);

$input["id"]="merchant_registration";
$input["label"]=lang('Access.companies_frm_input_merchant_registration');
$input["type"]="text";
$input["value"]=(isset($data_form["merchant_registration"])) ? $data_form["merchant_registration"] : '';
$input["placeholder"]=$input["label"];
$html.=view($views_path."/frm_input",$input);

$input["id"]="icon";
$input["label"]=lang('Access.companies_frm_input_icon');
$input["type"]="text";
$input["value"]=(isset($data_form["icon"])) ? $data_form["icon"] : '';
$input["placeholder"]=$input["label"];
$html.=view($views_path."/frm_input",$input);

$input["id"]="test_set_dian";
$input["label"]=lang('Access.companies_frm_input_test_set_dian');
$input["type"]="text";
$input["value"]=(isset($data_form["test_set_dian"])) ? $data_form["test_set_dian"] : '';
$input["placeholder"]=$input["label"];
$html.=view($views_path."/frm_input",$input);

$input["id"]="sync";
$input["label"]=lang('fields.sync');
$input["type"]="text";
$input["value"]=(isset($data_form["sync"])) ? $data_form["sync"] : '';
$input["placeholder"]=$input["label"];
$html.=view($views_path."/frm_input",$input);

$input["id"]="post_documents_automatically";
$input["label"]=lang('Access.companies_frm_input_post_documents_automatically');
$input["type"]="text";
$input["value"]=(isset($data_form["post_documents_automatically"])) ? $data_form["post_documents_automatically"] : '';
$input["placeholder"]=$input["label"];
$html.=view($views_path."/frm_input",$input);

$form["div_form_class"]="col";
$form["form_icon"]="fa fa-building";
$form["form_color"]="primary";
$form["form_title"]=lang('Access.companies_frm_create_title');
$form["form_body"]=$html;
echo view($views_path."/frm_card",$form);

