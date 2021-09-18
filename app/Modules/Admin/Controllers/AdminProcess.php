<?php
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
 * Este archivo procesa las peticiones CRUD para la tabla empresas
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-08-26
 * @updated 2021-08-26
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

namespace App\Modules\Admin\Controllers;

use App\Modules\TS5\Libraries\Session;
use App\Controllers\BaseController;
use App\Modules\TS5\Libraries\Ts5_class;
use CodeIgniter\API\ResponseTrait;


class AdminProcess extends BaseController
{
    use ResponseTrait;
    private $session;
    private $module_id;

    function __construct()
    {

        $this->session = new Session();
        $this->module_id='613784ab2471f217811480';
    }

    /**
     * Función para guardar los datos de un role
     * @return mixed
     */
    function save_role() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');

        $request = service('request');
        $id=$request->getVar('id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $module_id=$this->module_id;
        $mRoles=model('App\Modules\Access\Models\Roles');
        if($id==''){ //Crear
            $permission_id='613a570cd6fb0614772306';   //Permiso para crear un role
            if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
                $response["status"]=0;
                $response["msg"]=lang('Access.access_view_error');
                return $this->setResponseFormat('json')->respond($response);
            }
        }else{  //Editar

            $permission_id='613a5731c2f9b333888639';           //Permiso para Editar singular Ver en tabla access_control_permissions
            $permission_id_all='613ace0468c5e548652327';       //Permiso para Editar plural Ver en tabla access_control_permissions

            $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
            $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
            $authority=$mRoles->get_Authority($id,$user_id);

            if(!$p_all and !($p_single and $authority)){
                $response["status"]=0;
                $response["msg"]=lang('Access.access_view_error');
                return $this->setResponseFormat('json')->respond($response);

            }

        }

        $data_form_serialized=$request->getVar('data_form_serialized');
        parse_str($data_form_serialized,$data_form);

        foreach($data_form as $field => $value){
            $data_form[$field]=trim($value);
            if($value=='' and !isset($validator["not_required"][$field])){
                $response["status"]=0;
                $data_lang["field_name"]=lang('Access.companies_frm_input_'.$field);
                $response["msg"]=lang('Ts5.validation_field_empty',$data_lang);
                $response["object_id"]=$field;
                if(isset($validator["select2"][$field])){
                    $response["object_id"]="select2-".$field."-container";
                }
                return $this->setResponseFormat('json')->respond($response);
            }
            if(isset($validator["numeric"][$field]) and !is_numeric($value)){
                $response["status"]=0;
                $data_lang["field_name"]=lang('Access.companies_frm_input_'.$field);
                $response["msg"]=lang('Ts5.validation_field_numeric_1',$data_lang);
                $response["object_id"]=$field;
                return $this->setResponseFormat('json')->respond($response);
            }
        }
        $ts5=new Ts5_class();
        if($id==''){ //Crear
            $data_form["id"]=$ts5->getUniqueId("",true);
            $data_form["author"]=$user_id;
            $data_form["app_company_id"]=$company_id;
            $mRoles->insert($data_form);
        }else{ //Editar
            $mRoles->update($id,$data_form);
        }

        $response["status"]=1;
        $response["msg"]=lang('msg.save_register');
        return $this->setResponseFormat('json')->respond($response);
    }

    function save_user() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');

        $request = service('request');
        $id=$request->getVar('id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $module_id=$this->module_id;

        if($id==''){ //Crear
            $permission_id='613ada507e730607668359';                                    //Permiso para crear un role
            if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
                $response["status"]=0;
                $response["msg"]=lang('Access.access_view_error');
                return $this->setResponseFormat('json')->respond($response);
            }
        }else{  //Editar

            $permission_id='613ada7fad7e7386240937';           //Permiso para Editar singular Ver en tabla access_control_permissions
            $permission_id_all='613ada93f23b4753305035';       //Permiso para Editar plural Ver en tabla access_control_permissions

            $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
            $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
            $authority=$mUsers->get_Authority($id,$user_id);

            if(!$p_all and !($p_single and $authority)){
                $response["status"]=0;
                $response["msg"]=lang('Access.access_view_error');
                return $this->setResponseFormat('json')->respond($response);

            }

        }

        $data_form_serialized=$request->getVar('data_form_serialized');
        parse_str($data_form_serialized,$data_form);

        foreach($data_form as $field => $value){
            $data_form[$field]=trim($value);
            if($value=='' and !isset($validator["not_required"][$field])){
                $response["status"]=0;
                $data_lang["field_name"]=lang('Access.companies_frm_input_'.$field);
                $response["msg"]=lang('Ts5.validation_field_empty',$data_lang);
                $response["object_id"]=$field;
                if(isset($validator["select2"][$field])){
                    $response["object_id"]="select2-".$field."-container";
                }
                return $this->setResponseFormat('json')->respond($response);
            }
            if(isset($validator["numeric"][$field]) and !is_numeric($value)){
                $response["status"]=0;
                $data_lang["field_name"]=lang('Access.companies_frm_input_'.$field);
                $response["msg"]=lang('Ts5.validation_field_numeric_1',$data_lang);
                $response["object_id"]=$field;
                return $this->setResponseFormat('json')->respond($response);
            }
        }
        $ts5=new Ts5_class();



        if($id==''){ //Crear
            $data_form["id"]=$ts5->getUniqueId("us_",true);
            $data_form["author"]=$user_id;
            $data_form["password"]=md5($data_form["password"]);
            $mUsers->insert($data_form);

            $data_form["app_company"]=$company_id;
            $data_form["access_control_user_id"]=$data_form["id"];
            $data_form["id"]=$ts5->getUniqueId("",true);
            $mUsersCompanies=model('App\Modules\Access\Models\UsersCompanies');
            $mUsersCompanies->insert($data_form);
        }else{ //Editar
            $current_data=$mUsers->where('id',$id)->first();

            if($current_data["password"]<>$data_form["password"]){
                $data_form["password"]=md5($data_form["password"]);
            }
            $mUsers->update($id,$data_form);
        }

        $response["status"]=1;
        $response["msg"]=lang('msg.save_register');
        return $this->setResponseFormat('json')->respond($response);
    }

    /**
     * Función para guardar los datos de una sucursal
     * @return mixed
     */
    function save_branch() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');

        $request = service('request');
        $id=$request->getVar('id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $module_id=$this->module_id;
        $mBranches=model('App\Modules\Access\Models\CompaniesBranches');
        if($id==''){ //Crear
            $permission_id='6144b0886e5d2376189346';   //Permiso para crear una sucursal
            if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
                $response["status"]=0;
                $response["msg"]=lang('Access.access_view_error');
                return $this->setResponseFormat('json')->respond($response);
            }
        }else{  //Editar

            $permission_id='6144b19b2b80d401305742';           //Permiso para Editar singular Ver en tabla access_control_permissions
            $permission_id_all='6144b24255c62277085306';       //Permiso para Editar plural Ver en tabla access_control_permissions

            $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
            $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
            $authority=$mBranches->get_Authority($id,$user_id);

            if(!$p_all and !($p_single and $authority)){
                $response["status"]=0;
                $response["msg"]=lang('Access.access_view_error');
                return $this->setResponseFormat('json')->respond($response);

            }

        }

        $data_form_serialized=$request->getVar('data_form_serialized');
        parse_str($data_form_serialized,$data_form);

        foreach($data_form as $field => $value){
            $data_form[$field]=trim($value);
            if($value=='' and !isset($validator["not_required"][$field])){
                $response["status"]=0;
                $data_lang["field_name"]=lang('Access.companies_frm_input_'.$field);
                $response["msg"]=lang('Ts5.validation_field_empty',$data_lang);
                $response["object_id"]=$field;
                if(isset($validator["select2"][$field])){
                    $response["object_id"]="select2-".$field."-container";
                }
                return $this->setResponseFormat('json')->respond($response);
            }
            if(isset($validator["numeric"][$field]) and !is_numeric($value)){
                $response["status"]=0;
                $data_lang["field_name"]=lang('Access.companies_frm_input_'.$field);
                $response["msg"]=lang('Ts5.validation_field_numeric_1',$data_lang);
                $response["object_id"]=$field;
                return $this->setResponseFormat('json')->respond($response);
            }
        }
        $ts5=new Ts5_class();
        if($id==''){ //Crear
            $data_form["id"]=$ts5->getUniqueId("",true);
            $data_form["author"]=$user_id;
            $data_form["company_id"]=$company_id;
            $mBranches->insert($data_form);
        }else{ //Editar
            $mBranches->update($id,$data_form);
        }

        $response["status"]=1;
        $response["msg"]=lang('msg.save_register');
        return $this->setResponseFormat('json')->respond($response);
    }


    public function permissions_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');

        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');
        $mUsers=model('App\Modules\Access\Models\Users');
        $permission_id='613a3cb44d1c9444282576';
        $module_id='613784ab2471f217811480';

        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)) {
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($error);
        }


        $key=$request->getVar('q');

        $text="name";
        $model_class=model('App\Modules\Access\Models\Permissions');
        $model_class->select("id,{$text} as text");
        
        $model_class->where("EXISTS ( SELECT 1 FROM app_companies_modules where app_companies_modules.`app_company_id` = '{$company_id}' AND app_companies_modules.app_module_id= access_control_permissions.app_module_id AND ISNULL(app_companies_modules.deleted_at) )");
        
        $k=0;
        if($key<>''){
            
            $model_class->like("name",$key);
            $model_class->orWhere("id",$key);
        }
        //print_r($model_class->getCompiledSelect());
        

        $results=$model_class->orderBy('name ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }
    
    public function municipalities_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');

        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');
        $mUsers=model('App\Modules\Access\Models\Users');
        $permission_id='6144ac0542c37120859682';
        $module_id='613784ab2471f217811480';

        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)) {
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($error);
        }


        $key=$request->getVar('q');

        $text="CONCAT(app_cat_municipalities.name,' || ',app_cat_departments.name)";
        $model_class=model('App\Modules\Access\Models\Municipalities');
        $model_class->select("app_cat_municipalities.id,{$text} as text");
        $model_class->join('app_cat_departments','app_cat_municipalities.department_id=app_cat_departments.id');
        $k=0;
        if($key<>''){
            
            $model_class->like("app_cat_municipalities.name",$key);
            $model_class->orWhere("app_cat_municipalities.id",$key);
        }
        
        $results=$model_class->orderBy('app_cat_municipalities.name ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }
    
    public function add_permission_role(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }
        
        $request = service('request');
        $role_id=$request->getVar('role_id');
        
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');
        $mUsers=model('App\Modules\Access\Models\Users');
        $permission_id='613a5731c2f9b333888639';
        $permission_id_all='613ace0468c5e548652327';
        $module_id='613784ab2471f217811480';
        $mRoles=model('App\Modules\Access\Models\Roles');
        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$mRoles->get_Authority($role_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
            
        }
        
        $mPolitics=model('App\Modules\Access\Models\PoliticiesModel');
        $permission_id_add=$request->getVar('permission_id');
        
        //return("Vali ".$validation);
        if($mPolitics->permission_in_role($permission_id_add,$role_id)==true){
            $response["status"]=0;
            $response["msg"]=lang('admin.permission_exists');
            return $this->setResponseFormat('json')->respond($response);
        }

        $ts5=new Ts5_class();
        
        $id=$ts5->getUniqueId("",true);
        $data["id"]=$id;
        $data["access_control_role_id"]=$role_id;
        $data["access_control_permissions_id"]=$permission_id_add;
        $data["author"]=$user_id;
        $mPolitics->insert($data);
        
        $response["status"]=1;
        $response["msg"]=lang('msg.save_register');
        return $this->setResponseFormat('json')->respond($response);
        
    }

    public function delete_permission_role() {
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }
        
        $request = service('request');
        $role_id=$request->getVar('role_id');
        
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');
        $mUsers=model('App\Modules\Access\Models\Users');
        $permission_id='613a5731c2f9b333888639';
        $permission_id_all='613ace0468c5e548652327';
        $module_id='613784ab2471f217811480';
        $mRoles=model('App\Modules\Access\Models\Roles');
        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$mRoles->get_Authority($role_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
            
        }
        
        $mPolitics=model('App\Modules\Access\Models\PoliticiesModel');
        $permission_id_del=$request->getVar('permission_id');
         
        $mPolitics->delete(['id',$permission_id_del]);
        
        $response["status"]=1;
        $response["msg"]=lang('msg.delete_register');
        return $this->setResponseFormat('json')->respond($response);
    }

    
    public function roles_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');

        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');
        $mUsers=model('App\Modules\Access\Models\Users');
        $permission_id='613adb311ef3a661853259';
        $module_id='613784ab2471f217811480';

        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)) {
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($error);
        }


        $key=$request->getVar('q');

        $text="name";
        $model_class=model('App\Modules\Access\Models\Roles');
        $model_class->select("id,{$text} as text");
        
        $model_class->where("app_company_id",$company_id);
        
        $k=0;
        if($key<>''){
            
            $model_class->like("name",$key);
            $model_class->orWhere("id",$key);
        }
        //print_r($model_class->getCompiledSelect());
        

        $results=$model_class->orderBy('name ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }
    

    public function add_role_user(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }
        
        $request = service('request');
        $role_id=$request->getVar('role_id');
        
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');
        $mUsers=model('App\Modules\Access\Models\Users');
        $permission_id='613ada7fad7e7386240937';
        $permission_id_all='613ada93f23b4753305035';
        $module_id='613784ab2471f217811480';
        
        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$mUsers->get_Authority($role_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
            
        }
        
        $mHierarchies=model('App\Modules\Access\Models\Hierarchies');
        $role_id=$request->getVar('role_id');
        $user_id_add=$request->getVar('user_id');
        
        if($mHierarchies->role_in_user($role_id,$user_id_add)==true){
            $response["status"]=0;
            $response["msg"]=lang('admin.role_exists');
            return $this->setResponseFormat('json')->respond($response);
        }

        $ts5=new Ts5_class();
        
        $id=$ts5->getUniqueId("",true);
        $data["id"]=$id;
        $data["access_control_role_id"]=$role_id;
        $data["access_control_user_id"]=$user_id_add;
        $data["author"]=$user_id;
        $mHierarchies->insert($data);
        
        $response["status"]=1;
        $response["msg"]=lang('msg.save_register');
        return $this->setResponseFormat('json')->respond($response);
        
    }

    public function delete_role_user() {
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }
        
        $request = service('request');
        $id=$request->getVar('id');
        
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');
        $mUsers=model('App\Modules\Access\Models\Users');
        $permission_id='613ada7fad7e7386240937';
        $permission_id_all='613ada93f23b4753305035';
        $module_id='613784ab2471f217811480';
        $mHierarchies=model('App\Modules\Access\Models\Hierarchies');
        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$mHierarchies->get_Authority($id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
            
        }
        
        
        $mHierarchies->delete(['id',$id]);
        
        $response["status"]=1;
        $response["msg"]=lang('msg.delete_register');
        return $this->setResponseFormat('json')->respond($response);
    }


    //Fin clase

}