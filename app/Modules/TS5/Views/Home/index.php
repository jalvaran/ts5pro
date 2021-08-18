<?php
use \App\Modules\TS5\Libraries\Ts5;
/*
 * $request=service('request');
$login=$request->getVar("login");
$pass=$request->getVar("pass");
 */

$ts5=new TS5();
$smarty = service("smarty");

$data_tempate=$ts5->getDataTemplate();

$smarty->assign("lang",$data_tempate["lang"]);
$smarty->assign("favicon",$data_tempate["favicon"]);
$smarty->assign("company_logo",$data_tempate["company_logo"]);
$smarty->assign("page_title",$data_tempate["page_title"]);
$smarty->assign("menu_title",$data_tempate["menu_title"]);
$smarty->assign("menu_logo",$data_tempate["menu_logo"]);
$smarty->assign("page_content","");
$smarty->assign("html_errors",0);
echo($smarty->view('login.tpl'));
































