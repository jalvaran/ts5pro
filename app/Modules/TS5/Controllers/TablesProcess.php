<?php

namespace App\Modules\TS5\Controllers;

use App\Modules\TS5\Libraries\Session;
use App\Controllers\BaseController;
use App\Modules\TS5\Libraries\DataTable;
use App\Modules\TS5\Libraries\Ts5_class;
use CodeIgniter\API\ResponseTrait;
use function explode;

class TablesProcess extends BaseController
{
    use ResponseTrait;
    private $session;

    function __construct()
    {

        $this->session = new Session();
    }

    /**
     * retorna el json para el datatable de los usuarios
     * @return mixed
     */
    function tables_json($data_table)
    {
        $user_id=$this->session->get('user');
        $company_id=$this->session->get('company_id');
        $array_data_table=json_decode(base64_decode(urldecode($data_table)),true);
        $model=$array_data_table["model"];

        $mUsers=model('App\Modules\Access\Models\Users');

        $p_single=$mUsers->has_Permission($user_id,$array_data_table["permissions"]["list"],$company_id,$array_data_table["module_id"]);

        if(!$p_single){
            $data["error_title"]=lang('Access.access_view_error_title');
            $data["msg_error"]=lang('Access.access_view_error');
            return(view($this->views_path."\alert_error",$data));
        }


        $dataTable=new DataTable();
        $data["data_table"]=$data_table;
        $response=$dataTable->getDataTable($model,$data);
        return $this->setResponseFormat('json')->respond($response);
    }

    function tables_create_register()
    {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $user_id=$this->session->get('user');
        $company_id=$this->session->get('company_id');
        $request=service('request');
        $data_table=$request->getVar('data_table');
        $array_data_table=json_decode(base64_decode(urldecode($data_table)),true);

        $mUsers=model('App\Modules\Access\Models\Users');

        $permission_id=$array_data_table["permissions"]["create"];           //Permiso singular para editar la configuración de una empresa

        $module_id=$array_data_table["module_id"];
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);


        if(!$p_single){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $data_form_serialized=$request->getVar('data_form_serialized');
        parse_str($data_form_serialized,$data_form);

        foreach($data_form as $field => $value){
            $data_form[$field]=trim($value);
            if($value==''){
                $response["status"]=0;
                $data_lang["field_name"]=lang('fields.'.$field);
                $response["msg"]=lang('Ts5.validation_field_empty',$data_lang);
                $response["object_id"]=$field;
                if(isset($validator["select2"][$field])){
                    $response["object_id"]="select2-".$field."-container";
                }
                return $this->setResponseFormat('json')->respond($response);
            }
            if(isset($array_data_table["fields"][$field]["validation"]["number"]) and !is_numeric($value)){
                $response["status"]=0;
                $data_lang["field_name"]=lang('fields.'.$field);
                $response["msg"]=lang('Ts5.validation_field_numeric_1',$data_lang);
                $response["object_id"]=$field;
                return $this->setResponseFormat('json')->respond($response);
            }
        }

        $model=$array_data_table["model"];
        $model_class=model($model);
        $table=$model_class->table;
        $prefix="";
        if($table=='access_control_users'){
            $data_form["password"]=md5($data_form["password"]);
            $prefix="us_";

        }
        $ts5=new Ts5_class();
        $data_form["id"]=$ts5->getUniqueId($prefix,true);
        $data_form["author"]=$user_id;
        $model_class->insert($data_form);
        $response["status"]=1;
        $response["msg"]=lang('msg.saving_register_ok');
        return $this->setResponseFormat('json')->respond($response);

    }

    function tables_edit_register()
    {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $user_id=$this->session->get('user');
        $company_id=$this->session->get('company_id');
        $request=service('request');
        $edit_id=$request->getVar('edit_id');
        $data_table=$request->getVar('data_table');
        $array_data_table=json_decode(base64_decode(urldecode($data_table)),true);
        $model=$array_data_table["model"];
        $model_class=model($model);
        $mUsers=model('App\Modules\Access\Models\Users');

        $permission_id=$array_data_table["permissions"]["edit"];           //Permiso singular para editar la configuración de una empresa


        $permission_id_all=$array_data_table["permissions"]["edit_all"];       //Permiso plural para editar la configuración de una empresa
        $module_id=$array_data_table["module_id"];

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$model_class->get_Authority($edit_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $data_form_serialized=$request->getVar('data_form_serialized');

        parse_str($data_form_serialized,$data_form);

        foreach($data_form as $field => $value){
            $data_form[$field]=trim($value);
            if($value==''){
                $response["status"]=0;
                $data_lang["field_name"]=lang('fields.'.$field);
                $response["msg"]=lang('Ts5.validation_field_empty',$data_lang);
                $response["object_id"]=$field;
                if(isset($validator["select2"][$field])){
                    $response["object_id"]="select2-".$field."-container";
                }
                return $this->setResponseFormat('json')->respond($response);
            }
            if(isset($array_data_table["fields"][$field]["validation"]["number"]) and !is_numeric($value)){
                $response["status"]=0;
                $data_lang["field_name"]=lang('fields.'.$field);
                $response["msg"]=lang('Ts5.validation_field_numeric_1',$data_lang);
                $response["object_id"]=$field;
                return $this->setResponseFormat('json')->respond($response);
            }
        }


        $table=$model_class->table;

        $current_data=$model_class->where('id',$edit_id)->first();
        if($table=='access_control_users'){
            if($current_data["password"]<>$data_form["password"]){
                $data_form["password"]=md5($data_form["password"]);
            }
        }

        $model_class->update($edit_id,$data_form);
        $response["status"]=1;
        $response["msg"]=lang('msg.saving_register_ok');
        return $this->setResponseFormat('json')->respond($response);

    }

    public function tables_searchs(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');
        $array_data_table=json_decode(base64_decode(urldecode($request->getVar('data_table'))),true);
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');
        $mUsers=model('App\Modules\Access\Models\Users');
        $permission_id=$array_data_table["permissions"]["list"];
        $module_id=$array_data_table["module_id"];


        if($mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)) {

            $key=$request->getVar('q');
            $model=$request->getVar('model');
            $labels=$request->getVar('labels');
            if(empty($key)){
                $key="";
            }

            $text=str_replace(",",",' || ',",$labels);
            $searchs=explode(",",$labels);
            $text="concat($text)";
            $model_class=model($model);
            $model_class->select("id,{$text} as text");
            $z=0;
            foreach($searchs as $field => $value){
                if($z==0){
                    $model_class->like($value,$key);
                }else{
                    $model_class->orLike($value,$key);
                }
            }
            $results=$model_class->limit(20)->findAll();

            return $this->setResponseFormat('json')->respond($results);
        }else{
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($error);
        }
    }


}