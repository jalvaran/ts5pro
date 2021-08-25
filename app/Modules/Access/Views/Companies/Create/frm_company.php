<?php
$html='';
$input["div_class"]="col-md-6";
$input["id"]="name";
$input["label"]=lang('Access.companies_frm_input_name');
$input["type"]="text";
//$input["icon"]="fa fa-home";
$input["value"]="";
$input["placeholder"]=lang('Access.companies_frm_input_name');
$html.=view($views_path."/frm_input",$input);

$input["id"]="description";
$input["label"]=lang('Access.companies_frm_input_description');
$input["type"]="text";
$input["value"]="";
$input["placeholder"]=lang('Access.companies_frm_input_description');
$html.=view($views_path."/frm_input",$input);

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

$form["div_form_class"]="col";
$form["form_icon"]="fa fa-building";
$form["form_color"]="danger";
$form["form_title"]=lang('Access.companies_frm_create_title');
$form["form_body"]=$html;
echo view($views_path."/frm_card",$form);

