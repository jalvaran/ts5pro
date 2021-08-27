<?php

namespace App\Modules\Access\Controllers;

use App\Libraries\Session;
use App\Controllers\BaseController;
use App\Modules\TS5\Libraries\DataTable;
use CodeIgniter\API\ResponseTrait;

class CompaniesSearchs extends BaseController
{
    use ResponseTrait;
    private $session;

    function __construct()
    {

        $this->session = new Session();
    }

    function jsonCompanies() {
        $dataTable = new DataTable();
        $modelClass='App\Modules\Access\Models\Companies';
        $helper='App\Modules\Access\Helpers\actions_tables';
        $i=0;
        $field_dataTable[$i]["field"]='id';
        $field_dataTable[$i]["action_links"]='action_links_companies';
        //$field_dataTable[++$i]["field"]='id';
        $field_dataTable[++$i]["field"]='name';
        $field_dataTable[++$i]["field"]='description';
        $field_dataTable[++$i]["field"]='identification';
        $field_dataTable[++$i]["field"]='dv';
        $field_dataTable[++$i]["field"]='mail';
        $field_dataTable[++$i]["field"]='address';
        $field_dataTable[++$i]["field"]='phone';

        $response = $dataTable->process($helper,$modelClass, $field_dataTable);

        return $this->setResponseFormat('json')->respond($response);

    }
    /**
     * Funcion para retornar en json una búsqueda sobre la tabla lenguajes
     * @return mixed
     */
    function Languages() {
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }


        $user_id=$this->session->get('user');
        $mUsers=model('App\Modules\Access\Models\Users');
        $permission_id=3;  //Ver en tabla access_control_permissions
        $module_id=2; //Access
        $request = service('request');
        $company_id=$request->getVar('company_id');
        if($mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)) {

            $key=$request->getVar('q');
            if(empty($key)){
                $key="";
            }
            $mLanguages=model('App\Modules\Access\Models\Languages');
            $Languages=$mLanguages->select('id,name as text')->like('name',$key)->limit(20)->findAll();
            return $this->setResponseFormat('json')->respond($Languages);
        }else{
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($error);
        }

    }

    /**
     * Retorna los tipos de documento de identificación que existen
     * @return mixed
     */
    function type_documents_identification() {
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }


        $user_id=$this->session->get('user');
        $mUsers=model('App\Modules\Access\Models\Users');
        $permission_id=3;  //Ver en tabla access_control_permissions
        $module_id=2; //Access
        $request = service('request');
        $company_id=$request->getVar('company_id');
        if($mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)) {

            $key=$request->getVar('q');
            $mLanguages=model('App\Modules\Access\Models\TypeDocumentsIdentifications');
            if(empty($key)){
                $key="";
            }
            $Languages=$mLanguages->select('id,name as text')->like('name',$key)->limit(20)->findAll();
            return $this->setResponseFormat('json')->respond($Languages);
        }else{
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($error);
        }

    }

    /**
     * Retorna los paises en json
     * @return mixed
     */
    function countries() {
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }


        $user_id=$this->session->get('user');
        $mUsers=model('App\Modules\Access\Models\Users');
        $permission_id=3;  //Ver en tabla access_control_permissions
        $module_id=2; //Access
        $request = service('request');
        $company_id=$request->getVar('company_id');
        if($mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)) {

            $key=$request->getVar('q');
            $mLanguages=model('App\Modules\Access\Models\Countries');
            if(empty($key)){
                $key="";
            }
            $Languages=$mLanguages->select('id,name as text')->like('name',$key)->limit(20)->findAll();
            return $this->setResponseFormat('json')->respond($Languages);
        }else{
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($error);
        }

    }


    /**
     * Retorna los tipos de moneda en json
     * @return mixed
     */
    function currencies() {
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }


        $user_id=$this->session->get('user');
        $mUsers=model('App\Modules\Access\Models\Users');
        $permission_id=3;  //Ver en tabla access_control_permissions
        $module_id=2; //Access
        $request = service('request');
        $company_id=$request->getVar('company_id');
        if($mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)) {

            $key=$request->getVar('q');
            $mLanguages=model('App\Modules\Access\Models\TypeCurrencies');
            if(empty($key)){
                $key="";
            }
            $Languages=$mLanguages->select('id,name as text')->like('name',$key)->limit(20)->findAll();
            return $this->setResponseFormat('json')->respond($Languages);
        }else{
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($error);
        }

    }

    /**
     * Retorna los tipos de organizaciones en json
     * @return mixed
     */
    function type_organizations() {
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }


        $user_id=$this->session->get('user');
        $mUsers=model('App\Modules\Access\Models\Users');
        $permission_id=3;  //Ver en tabla access_control_permissions
        $module_id=2; //Access
        $request = service('request');
        $company_id=$request->getVar('company_id');
        if($mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)) {

            $key=$request->getVar('q');
            $mLanguages=model('App\Modules\Access\Models\TypeOrganizations');
            if(empty($key)){
                $key="";
            }
            $Languages=$mLanguages->select('id,name as text')->like('name',$key)->limit(20)->findAll();
            return $this->setResponseFormat('json')->respond($Languages);
        }else{
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($error);
        }

    }

    /**
     * Retorna los tipos de regimen de una organizacion en json
     * @return mixed
     */
    function type_regime() {
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }


        $user_id=$this->session->get('user');
        $mUsers=model('App\Modules\Access\Models\Users');
        $permission_id=3;  //Ver en tabla access_control_permissions
        $module_id=2; //Access
        $request = service('request');
        $company_id=$request->getVar('company_id');
        if($mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)) {

            $key=$request->getVar('q');
            $mLanguages=model('App\Modules\Access\Models\TypeRegimes');
            if(empty($key)){
                $key="";
            }
            $Languages=$mLanguages->select('id,name as text')->like('name',$key)->limit(20)->findAll();
            return $this->setResponseFormat('json')->respond($Languages);
        }else{
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($error);
        }

    }

    /**
     * Retorna los tipos de responsabilidades de una organización en json
     * @return mixed
     */
    function type_liabilities() {
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }


        $user_id=$this->session->get('user');
        $mUsers=model('App\Modules\Access\Models\Users');
        $permission_id=3;  //Ver en tabla access_control_permissions
        $module_id=2; //Access
        $request = service('request');
        $company_id=$request->getVar('company_id');
        if($mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)) {

            $key=$request->getVar('q');
            $mLanguages=model('App\Modules\Access\Models\TypeLiabilities');
            if(empty($key)){
                $key="";
            }
            $Languages=$mLanguages->select('id,name as text')->like('name',$key)->limit(20)->findAll();
            return $this->setResponseFormat('json')->respond($Languages);
        }else{
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($error);
        }

    }

    /**
     * Retorna los municipios
     * @return mixed
     */
    function municipalities() {
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }


        $user_id=$this->session->get('user');
        $mUsers=model('App\Modules\Access\Models\Users');
        $permission_id=3;  //Ver en tabla access_control_permissions
        $module_id=2; //Access
        $request = service('request');
        $company_id=$request->getVar('company_id');
        if($mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)) {

            $key=$request->getVar('q');
            $mLanguages=model('App\Modules\Access\Models\Municipalities');
            if(empty($key)){
                $key="";
            }
            $Languages=$mLanguages->select("app_cat_municipalities.id,concat(app_cat_municipalities.name,' ',app_cat_departments.name) as text")
                ->join('app_cat_departments','app_cat_municipalities.department_id=app_cat_departments.id')
                ->like('app_cat_municipalities.name',$key)
                ->limit(20)
                ->findAll();
            return $this->setResponseFormat('json')->respond($Languages);
        }else{
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($error);
        }

    }




}