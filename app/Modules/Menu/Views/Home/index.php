<?php

$smarty = service("smarty");

$smarty->assign("lang",$data_template["lang"]);
$smarty->assign("favicon",$data_template["favicon"]);
$smarty->assign("company_logo",$data_template["company_logo"]);
$smarty->assign("page_title",$data_template["page_title"]);
$smarty->assign("menu_title",$data_template["menu_title"]);
$smarty->assign("menu_logo",$data_template["menu_logo"]);
$smarty->assign("page_content","");
$smarty->assign("html_errors",0);
echo($smarty->view('blank.tpl'));
































