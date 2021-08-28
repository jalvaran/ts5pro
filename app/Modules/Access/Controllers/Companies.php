<?php

namespace App\Modules\Access\Controllers;

use App\Libraries\Session;
use App\Controllers\BaseController;
use App\Modules\TS5\Libraries\Ts5_class;

class Companies extends BaseController
{

    private $session;
    private $views_path;
    private $views_path_module;

    function __construct()
    {
        $this->views_path='App\Modules\TS5\Views\templates\synadmin';
        $this->views_path_module='App\Modules\Access\Views\Companies';
        $this->session = new Session();
    }

    function index() {

        if (!$this->session->get_LoggedIn()) {
            return (redirect()->to(base_url('/ts5/signin')));
        } else {
            return (redirect()->to(base_url('/menu')));
        }

    }

    function list($company_id) {

        if (!$this->session->get_LoggedIn()) {
            return (redirect()->to(base_url('/ts5/signin')));
        } else {

            $ts5=new Ts5_class();
            $company_id=$this->session->get('company_id');
            $this->session->set('company_id',$company_id);
            $controller_json_companies=base_url('/access/companies/jsonCompanies');
            $controller_draw_form_companies=base_url('/access/companies/frm_create');
            $controller_search_languages=base_url('/access/companies/languages?company_id='.$company_id);
            $controller_search_type_documents=base_url('/access/companies/documents_identifications?company_id='.$company_id);
            $controller_search_countries=base_url('/access/companies/countries?company_id='.$company_id);
            $controller_search_currencies=base_url('/access/companies/currencies?company_id='.$company_id);
            $controller_search_type_organizations=base_url('/access/companies/type_organizations?company_id='.$company_id);
            $controller_search_type_regime=base_url('/access/companies/type_regime?company_id='.$company_id);
            $controller_search_type_liability=base_url('/access/companies/type_liabilities?company_id='.$company_id);
            $controller_search_municipality=base_url('/access/companies/municipalities?company_id='.$company_id);
            $controller_save_company=base_url('/access/companies/create?company_id='.$company_id);
            $controller_edit_company=base_url('/access/companies/edit?company_id='.$company_id);
            $controller_companies_draw=base_url('/access/companies/table_companies?company_id='.$company_id);
            $controller_edit_draw=base_url('/access/companies/frm_edit/');
            $data_table["controller_json"]=$controller_json_companies;
            $data_table["controller_draw"]=$controller_draw_form_companies;
            $data_table["controller_search_languages"]=$controller_search_languages;
            $data_table["controller_search_type_documents"]=$controller_search_type_documents;
            $data_table["controller_search_countries"]=$controller_search_countries;
            $data_table["controller_search_currencies"]=$controller_search_currencies;
            $data_table["controller_search_type_organizations"]=$controller_search_type_organizations;
            $data_table["controller_search_type_regime"]=$controller_search_type_regime;
            $data_table["controller_search_type_liability"]=$controller_search_type_liability;
            $data_table["controller_search_municipality"]=$controller_search_municipality;
            $data_table["controller_save_company"]=$controller_save_company;
            $data_table["controller_edit_company"]=$controller_edit_company;
            $data_table["controller_companies_draw"]=$controller_companies_draw;
            $data_table["controller_edit_draw"]=$controller_edit_draw;

            $data_table["table_id"]="companies_table";
            $data_table["company_id"]=$company_id;
            $data_table["views_path"]=$this->views_path;

            $my_js=view($this->views_path_module."\JS/js",$data_table);

            $html="";

            $data=$ts5->getDataTemplate();
            $data["data_template"]=$ts5->getDataTemplate();
            $data["data_template"]["my_js"]=$my_js;
            $data["view_path"]=$this->views_path;
            $data["page_title"]=lang('Access.companies_page_title');
            $data["module_name"]=lang('Access.module_name');
            $data["page_content"]=$html;
            echo view($this->views_path."\blank",$data);

        }

    }

    function table_companies(){
        if (!$this->session->get_LoggedIn()){
            return (redirect()->to(base_url('/ts5/signin')));
        }

        $mUsers=model('App\Modules\Access\Models\Users');
        $ts5=new Ts5_class();
        $user_id=$this->session->get('user');
        $company_id=$this->session->get('company_id');
        $permission_id=1;  //Ver en tabla access_control_permissions
        $module_id=2; //Access
        $html="";
        if($mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){

            $data_table["table_id"]="companies_table";
            $data_table["actions_path"]=base_url("/access/companies/list");
            $data_table["table_title"]=lang('Access.companies_table_title');
            $data_table["div_cols"]=12;
            $data_table["cols"][0]=lang('Access.companies_table_col1');
            $data_table["cols"][1]=lang("Access.companies_table_col2");
            $data_table["cols"][2]=lang("Access.companies_table_col3");
            $data_table["cols"][3]=lang("Access.companies_table_col4");
            $data_table["cols"][4]=lang("Access.companies_table_col5");
            $data_table["cols"][5]=lang("Access.companies_table_col6");
            $data_table["cols"][6]=lang("Access.companies_table_col7");
            $data_table["cols"][7]=lang("Access.companies_table_col8");


            $html.= view($this->views_path."\data_table",$data_table);

        }else{
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            $html.=view($this->views_path."\alert_error",$data_error);
        }

        return($html);
    }

    function frm_create(){
        if (!$this->session->get_LoggedIn()){
            return (redirect()->to(base_url('/ts5/signin')));
        }
        $request = service('request');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $company_id=$request->getVar('company_id');
        $permission_id=2;  //Ver en tabla access_control_permissions
        $module_id=2; //Access
        $html="";

        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $data["error_title"]=lang('Access.access_view_error_title');
            $data["msg_error"]=lang('Access.access_view_error');
            $html.= view($this->views_path."\alert_error",$data);
            return($html);
        }else{
            $data["views_path"]=$this->views_path;
            $html.= view($this->views_path_module."/Forms/frm_company",$data);
            return($html);

        }

    }

    function frm_edit($id) {
        if (!$this->session->get_LoggedIn()){
            return (redirect()->to(base_url('/ts5/signin')));
        }
        $request = service('request');
        $mUsers=model('App\Modules\Access\Models\Users');
        $mCompanies=model('App\Modules\Access\Models\Companies');
        $user_id=$this->session->get('user');
        $company_id=$request->getVar('company_id');
        $permission_id=4;           //Permiso para Editar singular Ver en tabla access_control_permissions
        $permission_id_all=5;       //Permiso para Editar plural Ver en tabla access_control_permissions
        $module_id=2; //Access
        $html="";
        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$mCompanies->get_Authority($id,$user_id);

        if($p_all or  ($p_single and $authority) ){
            $data["views_path"]=$this->views_path;
            $data_company=$mCompanies->get_DataCompany($id);
            $data["data_form"]=$data_company;
            $html.= view($this->views_path_module."/Forms/frm_company",$data);
            return($html);
        }else{
            $data["error_title"]=lang('Access.access_view_error_title');
            $data["msg_error"]=lang('Access.access_view_error');
            $html.= view($this->views_path."\alert_error",$data);
            return($html);
        }

    }
    function delete($id) {
        return("delete {$id}");
    }




}