<?php

use App\Libraries\Session;
use App\Modules\TS5\Libraries\Ts5_class;
$session = new Session();

$views_path='App\Modules\TS5\Views\templates\synadmin';
$views_path_module='App\Modules\Access\Views\Companies\List';
$controller_json_companies=base_url('/access/companies/jsonCompanies');
$mUsers=model('App\Modules\Access\Models\Users');
$ts5=new Ts5_class();
$user_id=$session->get('user');
$permission_id=1;  //Ver en tabla access_control_permissions
$html="";
$js_data_table="";
if($mUsers->has_Permission($user_id,$permission_id,$company_id)){
    $data_table["controller_json"]=$controller_json_companies;
    $data_table["table_id"]="companies_table";
    $data_table["views_path"]=$views_path;
    $html.= view($views_path."\data_table",$data_table);
    $js_data_table=view($views_path."\js_tables",$data_table);
}else{
    $html.=view($views_path_module."\js",array("views_path"=>$views_path));
}

$data=$ts5->getDataTemplate();
$data["data_template"]=$ts5->getDataTemplate();
$data["data_template"]["my_js"]=$js_data_table;
$data["view_path"]=$views_path;
$data["page_title"]=lang('Access.companies_page_title');
$data["module_name"]=lang('Access.module_name');
$data["page_content"]=$html;
echo view($views_path."\blank",$data);
