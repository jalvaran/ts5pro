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
 * Este archivo procesa las peticiones CRUD para las hojas de negocio
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-09-30
 * @updated 2021-09-30
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


class InverPacificProcess extends BaseController
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
     * Función para agregar un adicional a una hoja de negocios
     * @return mixed
     */
    function business_several_add() {
        
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
        
       
        $permission_id='61548efe7ee2c964405841';   //Permiso para crear una hoja de negocio
        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
        }
        
        $model=model('App\Modules\Inverpacific\Models\BusinessSheetSeveralsAdds');
        
        $mBusiness_sheet=model('App\Modules\Inverpacific\Models\BusinessSheets');
        
        $data_form["business_sheet_id"]=$request->getVar('business_sheet_id');
        if(!$mBusiness_sheet->exists_id($data_form["business_sheet_id"])){
            $data_init["id"]=$data_form["business_sheet_id"];
            $mBusiness_sheet->sheet_init($data_init);
        }
        $data_form["value"]=$request->getVar('value');
        $data_form["several_id"]=$request->getVar('several_id');
        $data_form["concept"]=$request->getVar('concept');
        $validator["numeric"]["value"]=1;
        $validator["not_required"]["concept"]=1;
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
            if(isset($validator["numeric"][$field]) and !is_numeric($value) and $value<1){
                $response["status"]=0;
                $data_lang["field_name"]=lang('fields.'.$field);
                $response["msg"]=lang('Ts5.validation_field_numeric_1',$data_lang);
                $response["object_id"]=$field;
                return $this->setResponseFormat('json')->respond($response);
            }
        }
        
        if($model->is_add($data_form["several_id"],$data_form["business_sheet_id"])){
            $response["status"]=0;            
            $response["msg"]=lang('msg.exists');
            $response["object_id"]=$field;
            return $this->setResponseFormat('json')->respond($response);
        }
        
        $mSeveral=model('App\Modules\Inverpacific\Models\BusinessSheetSeverals');
        $data_several=$mSeveral->get_Data($data_form["several_id"]);
        $ts5=new Ts5_class();
        
        $data_form["id"]=$ts5->getUniqueId("",true);
        $data_form["author"]=$user_id;
        
        $data_form["iva"]=$data_several["iva"];
        
        $model->insert($data_form);
        
        $obBusiness=new Creditmoto_class();
        $obBusiness->totals_calculate($data_form["business_sheet_id"]);

        $response["status"]=1;
        $response["msg"]=lang('msg.save_register');
        return $this->setResponseFormat('json')->respond($response);
    }
    
    
    function business_several_adds_delete() {
        
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');

        $request = service('request');
        
        $mUsers=model('App\Modules\Access\Models\Users');
        $module_id=$this->module_id;
        
       
        $permission_id='61548efe7ee2c964405841';   //Permiso para crear una hoja de negocio
        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
        }
        $id=$request->getVar('id');
        $business_sheet_id=$request->getVar('business_sheet_id');
        $model=model('App\Modules\Inverpacific\Models\BusinessSheetSeveralsAdds');
        
        $model->delete($id);        
        $obBusiness=new Creditmoto_class();
        $obBusiness->totals_calculate($business_sheet_id);
        $response["status"]=1;
        $response["msg"]=lang('msg.delete_register');
        return $this->setResponseFormat('json')->respond($response);
    }
    
    /**
     * Edita los campos de una hoja de negocio y si no existe la crea
     * @return type
     */
    function business_sheet_field_edit() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');
        
        $request = service('request');
        $business_sheet_id=$request->getVar('business_sheet_id');
        $field=$request->getVar('field');
        $value=$request->getVar('value');
        $model=model('App\Modules\Inverpacific\Models\BusinessSheets');
        if($model->exists_id($business_sheet_id)){
            $create=0;
        }else{
            $create=1;
        }
        
        $data_form[$field]=$value;
        $validator["numeric"]["motorcycle_value"]=1;
        $validator["numeric"]["discount"]=1;
        $validator["numeric"]["initial_fee"]=1;
        $validator["numeric"]["term"]=1;
        $mUsers=model('App\Modules\Access\Models\Users');
        $module_id=$this->module_id;
        
        if($create==1){ //Crear
            $permission_id='61548efe7ee2c964405841';                                    //Permiso para crear un role
            if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
                $response["status"]=0;
                $response["msg"]=lang('Access.access_view_error');
                return $this->setResponseFormat('json')->respond($response);
            }
            $validations=$this->validations($data_form,$validator);
            
            if(isset($validations["E1"])){
                return($this->setResponseFormat('json')->respond($validations));
            }else{
                $data_form=$validations;
            }
            $data_form["id"]=$business_sheet_id;                        
            $model->sheet_init($data_form);            
            $msg=lang('msg.saving_register_ok');
            
        }else{  //Editar

            $permission_id='6156159284c77599840464';           //Permiso para Editar singular Ver en tabla access_control_permissions
            $permission_id_all='615615ad6efa6294907733';       //Permiso para Editar plural Ver en tabla access_control_permissions

            $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
            $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
            $authority=$model->get_Authority($business_sheet_id,$user_id);

            if(!$p_all and !($p_single and $authority)){
                $response["status"]=0;
                $response["msg"]=lang('Access.access_view_error');
                return $this->setResponseFormat('json')->respond($response);

            }
            $validations=$this->validations($data_form,$validator);
            
            if(isset($validations["E1"])){
                $value_old=$model->get_Field($business_sheet_id,$field);                
                $validations["value_old"]=$value_old;               
                
                return($this->setResponseFormat('json')->respond($validations));
            }else{
                $data_form=$validations;
            }
            $data_form["status"]=1;
            
            $model->update($business_sheet_id,$data_form);
            
            $obBusiness=new Creditmoto_class();
            $obBusiness->totals_calculate($business_sheet_id);
            $msg=lang('msg.edit_register_ok');
            
        }
        
        $response["status"]=1;
        $response["msg"]=$msg;
        return $this->setResponseFormat('json')->respond($response);
        
        
        
        
    }
    
    
    public function validations($data_form,$validator='') {
        foreach($data_form as $field => $value){
            $data_form[$field]=trim($value);
            if($value=='' and !isset($validator["not_required"][$field])){
                $response["E1"]=1;
                $response["status"]=0;
                $data_lang["field_name"]=lang('fields.'.$field);
                $response["msg"]=lang('Ts5.validation_field_empty',$data_lang);
                $response["object_id"]=$field;
                if(isset($validator["select2"][$field])){
                    $response["object_id"]="select2-".$field."-container";
                }
                return($response);
               
                
            }
            if(isset($validator["numeric"][$field]) and !is_numeric($value)){
                $response["E1"]=1;
                $response["status"]=0;
                $data_lang["field_name"]=lang('fields.'.$field);
                $response["msg"]=lang('Ts5.validation_field_numeric_1',$data_lang);
                $response["object_id"]=$field;
                return($response);
                
                
            }
        }
        
        return($data_form);
        
    }
    
    //Fin clase

}