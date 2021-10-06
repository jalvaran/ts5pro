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
 * Este archivo procesa las peticiones CRUD para creacion de motocicletas
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-10-06
 * @updated 2021-10-06
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

namespace App\Modules\Inverpacific\Controllers;

use App\Modules\TS5\Libraries\Session;
use App\Controllers\BaseController;
use App\Modules\TS5\Libraries\Ts5_class;
use App\Modules\Inverpacific\Libraries\Creditmoto_class;
use CodeIgniter\API\ResponseTrait;


class MotorcyclesProcess extends BaseController
{
    use ResponseTrait;
    private $session;
    private $module_id;

    function __construct()
    {

        $this->session = new Session();
        $this->module_id='613784ab2471f217811481';
    }

    /**
     * Función crear o editar una marca
     * @return mixed
     */
    function save_trademark() {
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
        $model=model('App\Modules\Inverpacific\Models\Trademarks');
        if($id==''){ //Crear
            $permission_id='615dab3b09b10517033606';  
            if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
                $response["status"]=0;
                $response["msg"]=lang('Access.access_view_error');
                return $this->setResponseFormat('json')->respond($response);
            }
        }else{  //Editar

            $permission_id='615dab5df34ee985076898';           //Permiso para Editar singular Ver en tabla access_control_permissions
            $permission_id_all='615dab803944e879614837';       //Permiso para Editar plural Ver en tabla access_control_permissions

            $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
            $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
            $authority=$model->get_Authority($id,$user_id);

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
                $data_lang["field_name"]=lang('fields.'.$field);
                $response["msg"]=lang('Ts5.validation_field_empty',$data_lang);
                $response["object_id"]=$field;
                if(isset($validator["select2"][$field])){
                    $response["object_id"]="select2-".$field."-container";
                }
                return $this->setResponseFormat('json')->respond($response);
            }
            if(isset($validator["numeric"][$field]) and !is_numeric($value)){
                $response["status"]=0;
                $data_lang["field_name"]=lang('fields.'.$field);
                $response["msg"]=lang('Ts5.validation_field_numeric_1',$data_lang);
                $response["object_id"]=$field;
                return $this->setResponseFormat('json')->respond($response);
            }
        }
        $ts5=new Ts5_class();
        if($id==''){ //Crear
            $data_form["id"]=$ts5->getUniqueId("",true);
            $data_form["author"]=$user_id;
            
            $model->insert($data_form);
        }else{ //Editar
            $model->update($id,$data_form);
        }

        $response["status"]=1;
        $response["msg"]=lang('msg.save_register');
        return $this->setResponseFormat('json')->respond($response);
    }
    
    /**
     * Función crear o editar una marca
     * @return mixed
     */
    function save_color() {
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
        $model=model('App\Modules\Inverpacific\Models\Colors');
        if($id==''){ //Crear
            $permission_id='615db07a3f68b738893281';  
            if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
                $response["status"]=0;
                $response["msg"]=lang('Access.access_view_error');
                return $this->setResponseFormat('json')->respond($response);
            }
        }else{  //Editar

            $permission_id='615db08b32051588262617';           //Permiso para Editar singular Ver en tabla access_control_permissions
            $permission_id_all='615db09d529f2472480252';       //Permiso para Editar plural Ver en tabla access_control_permissions

            $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
            $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
            $authority=$model->get_Authority($id,$user_id);

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
                $data_lang["field_name"]=lang('fields.'.$field);
                $response["msg"]=lang('Ts5.validation_field_empty',$data_lang);
                $response["object_id"]=$field;
                if(isset($validator["select2"][$field])){
                    $response["object_id"]="select2-".$field."-container";
                }
                return $this->setResponseFormat('json')->respond($response);
            }
            if(isset($validator["numeric"][$field]) and !is_numeric($value)){
                $response["status"]=0;
                $data_lang["field_name"]=lang('fields.'.$field);
                $response["msg"]=lang('Ts5.validation_field_numeric_1',$data_lang);
                $response["object_id"]=$field;
                return $this->setResponseFormat('json')->respond($response);
            }
        }
        $ts5=new Ts5_class();
        if($id==''){ //Crear
            $data_form["id"]=$ts5->getUniqueId("",true);
            $data_form["author"]=$user_id;
            
            $model->insert($data_form);
        }else{ //Editar
            $model->update($id,$data_form);
        }

        $response["status"]=1;
        $response["msg"]=lang('msg.save_register');
        return $this->setResponseFormat('json')->respond($response);
    }
    
    
    /**
     * Función crear o editar una motocicleta
     * @return mixed
     */
    function save_motorcycle() {
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
        $model=model('App\Modules\Inverpacific\Models\Motorcycles');
        if($id==''){ //Crear
            $permission_id='615db462e5b5c049416492';  
            if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
                $response["status"]=0;
                $response["msg"]=lang('Access.access_view_error');
                return $this->setResponseFormat('json')->respond($response);
            }
        }else{  //Editar

            $permission_id='615db470a09b2589556818';           //Permiso para Editar singular Ver en tabla access_control_permissions
            $permission_id_all='615db4833969a467985118';       //Permiso para Editar plural Ver en tabla access_control_permissions

            $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
            $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
            $authority=$model->get_Authority($id,$user_id);

            if(!$p_all and !($p_single and $authority)){
                $response["status"]=0;
                $response["msg"]=lang('Access.access_view_error');
                return $this->setResponseFormat('json')->respond($response);

            }

        }

        $data_form_serialized=$request->getVar('data_form_serialized');
        parse_str($data_form_serialized,$data_form);
        $validator["numeric"]["value"]=1;
        $validator["numeric"]["tax_percent"]=1;
        foreach($data_form as $field => $value){
            $data_form[$field]=trim($value);
            if($value=='' and !isset($validator["not_required"][$field])){
                $response["status"]=0;
                $data_lang["field_name"]=lang('fields.'.$field);
                $response["msg"]=lang('Ts5.validation_field_empty',$data_lang);
                $response["object_id"]=$field;
                
                return $this->setResponseFormat('json')->respond($response);
            }
            if(isset($validator["numeric"][$field]) and !is_numeric($value) and $value<0){
                $response["status"]=0;
                $data_lang["field_name"]=lang('fields.'.$field);
                $response["msg"]=lang('Ts5.validation_field_numeric_1',$data_lang);
                $response["object_id"]=$field;
                return $this->setResponseFormat('json')->respond($response);
            }
        }
        $ts5=new Ts5_class();
        if($id==''){ //Crear
            $data_form["id"]=$ts5->getUniqueId("",true);
            $data_form["author"]=$user_id;            
            $model->insert($data_form);
        }else{ //Editar
            $model->update($id,$data_form);
        }

        $response["status"]=1;
        $response["msg"]=lang('msg.save_register');
        return $this->setResponseFormat('json')->respond($response);
    }
    
    //Fin clase

}