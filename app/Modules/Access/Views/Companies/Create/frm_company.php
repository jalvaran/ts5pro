<?php
$html='';
$input["div_class"]="col-md-4";
$input["id"]="name";
$input["label"]=lang('Access.companies_frm_input_name');
$input["type"]="text";
//$input["icon"]="fa fa-home";
$input["value"]="";
$input["placeholder"]=lang('Access.companies_frm_input_name');
$html.=view($views_path."/frm_input",$input);

$input["id"]="address";
$input["label"]=lang('Access.companies_frm_input_address');
$input["type"]="text";
$input["value"]="";
$input["placeholder"]=$input["label"];
$html.=view($views_path."/frm_input",$input);

$input["id"]="phone";
$input["label"]=lang('Access.companies_frm_input_phone');
$input["type"]="text";
$input["value"]="";
$input["placeholder"]=$input["label"];
$html.=view($views_path."/frm_input",$input);

$input["id"]="description";
$input["label"]=lang('Access.companies_frm_input_description');
$input["type"]="text";
$input["value"]="";
$input["placeholder"]=lang('Access.companies_frm_input_description');
$html.=view($views_path."/frm_input",$input);

$input["id"]="type_document_identification_id";
$input["label"]=lang('Access.companies_frm_input_type_document_identification_id');
$input["options"][0]["value"]='';
$input["options"][0]["text"]=lang('Access.companies_frm_input_selectors_value_initial');
$html.=view($views_path."/frm_select",$input);

$input["id"]="identification";
$input["label"]=lang('Access.companies_frm_input_identification');
$input["type"]="text";
$input["value"]="";
$input["placeholder"]=$input["label"];
$html.=view($views_path."/frm_input",$input);

$input["id"]="mail";
$input["label"]=lang('Access.companies_frm_input_mail');
$input["type"]="text";
$input["value"]="";
$input["placeholder"]=$input["label"];
$html.=view($views_path."/frm_input",$input);

$input["id"]="country_id";
$input["label"]=lang('Access.companies_frm_input_country_id');
$input["options"][0]["value"]='';
$input["options"][0]["text"]=lang('Access.companies_frm_input_selectors_value_initial');
$input["options"][1]["value"]='46';
$input["options"][1]["selected"]='1';
$input["options"][1]["text"]='Colombia';
$html.=view($views_path."/frm_select",$input);


unset($input);

$input["div_class"]="col-md-4";

$input["id"]="municipality_id";
$input["label"]=lang('Access.companies_frm_input_municipality_id');
$input["options"][0]["value"]='';
$input["options"][0]["text"]=lang('Access.companies_frm_input_selectors_value_initial');

$html.=view($views_path."/frm_select",$input);

$input["id"]="type_organization_id";
$input["label"]=lang('Access.companies_frm_input_type_organization_id');
$input["options"][0]["value"]='';
$input["options"][0]["text"]=lang('Access.companies_frm_input_selectors_value_initial');

$html.=view($views_path."/frm_select",$input);

$input["id"]="type_regime_id";
$input["label"]=lang('Access.companies_frm_input_type_regime_id');
$input["options"][0]["value"]='';
$input["options"][0]["text"]=lang('Access.companies_frm_input_selectors_value_initial');

$html.=view($views_path."/frm_select",$input);

$input["id"]="language_id";
$input["label"]=lang('Access.companies_frm_input_language_id');
$input["options"][0]["value"]='';
$input["options"][0]["text"]=lang('Access.companies_frm_input_language_value_initial');
$input["options"][1]["value"]='79';
$input["options"][1]["selected"]='1';
$input["options"][1]["text"]='Spanish';
$html.=view($views_path."/frm_select",$input);

unset($input);

$input["div_class"]="col-md-4";

$input["id"]="type_currency_id";
$input["label"]=lang('Access.companies_frm_input_type_currency_id');
$input["options"][0]["value"]='';
$input["options"][0]["text"]=lang('Access.companies_frm_input_selectors_value_initial');
$input["options"][1]["value"]='35';
$input["options"][1]["selected"]='1';
$input["options"][1]["text"]='Peso Colombiano';
$html.=view($views_path."/frm_select",$input);

unset($input);
$input["div_class"]="col-md-4";


$input["id"]="type_liability_id";
$input["label"]=lang('Access.companies_frm_input_type_liability_id');
$input["options"][0]["value"]='';
$input["options"][0]["text"]=lang('Access.companies_frm_input_selectors_value_initial');

$html.=view($views_path."/frm_select",$input);

$input["id"]="ciius";
$input["label"]=lang('Access.companies_frm_input_ciius');
$input["type"]="text";
$input["value"]="";
$input["placeholder"]=$input["label"];
$html.=view($views_path."/frm_input",$input);

$input["id"]="merchant_registration";
$input["label"]=lang('Access.companies_frm_input_merchant_registration');
$input["type"]="text";
$input["value"]="";
$input["placeholder"]=$input["label"];
$html.=view($views_path."/frm_input",$input);

$input["id"]="icon";
$input["label"]=lang('Access.companies_frm_input_icon');
$input["type"]="text";
$input["value"]="";
$input["placeholder"]=$input["label"];
$html.=view($views_path."/frm_input",$input);

$input["id"]="test_set_dian";
$input["label"]=lang('Access.companies_frm_input_test_set_dian');
$input["type"]="text";
$input["value"]="";
$input["placeholder"]=$input["label"];
$html.=view($views_path."/frm_input",$input);

$input["id"]="post_documents_automatically";
$input["label"]=lang('Access.companies_frm_input_post_documents_automatically');
$input["type"]="text";
$input["value"]="";
$input["placeholder"]=$input["label"];
$html.=view($views_path."/frm_input",$input);

$form["div_form_class"]="col";
$form["form_icon"]="fa fa-building";
$form["form_color"]="primary";
$form["form_title"]=lang('Access.companies_frm_create_title');
$form["form_body"]=$html;
echo view($views_path."/frm_card",$form);

