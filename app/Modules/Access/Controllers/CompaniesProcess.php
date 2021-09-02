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

namespace App\Modules\Access\Controllers;

use App\Libraries\Session;
use App\Controllers\BaseController;
use App\Modules\TS5\Libraries\Ts5_class;
use App\Modules\TS5\Libraries\ElectronicBill;
use CodeIgniter\API\ResponseTrait;


class CompaniesProcess extends BaseController
{
    use ResponseTrait;
    private $session;

    function __construct()
    {

        $this->session = new Session();
    }

    /**
     * Función para crear una empresa
     * @return mixed
     */
    function create() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $user_id=$this->session->get('user');

        $request = service('request');
        $mUsers=model('App\Modules\Access\Models\Users');
        $company_id=$request->getVar('company_id');
        $permission_id=2;  //Ver en tabla access_control_permissions
        $module_id=2; //Access

        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $data_form_serialized=$request->getVar('data_form_serialized');
        parse_str($data_form_serialized,$data_form);
        $validator["numeric"]["identification"]=1;
        $validator["numeric"]["phone"]=1;
        $validator["numeric"]["post_documents_automatically"]=1;
        $validator["not_required"]["test_set_dian"]=1;
        $validator["not_required"]["ciius"]=1;
        $validator["not_required"]["icon"]=1;
        $validator["not_required"]["merchant_registration"]=1;

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
        $data_form["id"]=$ts5->getUniqueId("cp_",true);
        $data_form["dv"]=$ts5->calculate_dv($data_form["identification"]);
        $data_form["author"]=$user_id;
        $mCompanies=model('App\Modules\Access\Models\Companies');

        $mCompanies->insert($data_form);
        $response["status"]=1;
        $response["msg"]="Registro Guardado";
        return $this->setResponseFormat('json')->respond($response);
    }

    /**
     * Función para editar una empresa
     * @return mixed
     */
    function edit() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $user_id=$this->session->get('user');

        $request = service('request');
        $mUsers=model('App\Modules\Access\Models\Users');
        $mCompanies=model('App\Modules\Access\Models\Companies');
        $company_id=$request->getVar('company_id');
        $item_id=$request->getVar('item_id');

        $permission_id=4;           //Permiso para Editar singular Ver en tabla access_control_permissions
        $permission_id_all=5;       //Permiso para Editar plural Ver en tabla access_control_permissions
        $module_id=2; //Access

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$mCompanies->get_Authority($item_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $data_form_serialized=$request->getVar('data_form_serialized');

        parse_str($data_form_serialized,$data_form);

        $validator["numeric"]["identification"]=1;
        $validator["numeric"]["phone"]=1;
        $validator["numeric"]["post_documents_automatically"]=1;
        $validator["not_required"]["test_set_dian"]=1;
        $validator["not_required"]["ciius"]=1;
        $validator["not_required"]["icon"]=1;
        $validator["not_required"]["merchant_registration"]=1;

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

        $data_form["dv"]=$ts5->calculate_dv($data_form["identification"]);
        //$data_form["author"]=$user_id;
        $mCompanies=model('App\Modules\Access\Models\Companies');
        $mCompanies->edit_company($data_form,$item_id);
        $response["status"]=1;
        $response["msg"]="Registro Editado";
        return $this->setResponseFormat('json')->respond($response);
    }

    /**
     * Crea una empresa en el api de documentos electrónicos de soenac
     * @param $item_id
     * @return mixed|void
     */
    public function api_create_company($item_id){

        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $user_id=$this->session->get('user');
        $request = service('request');
        $mUsers=model('App\Modules\Access\Models\Users');
        $mCompanies=model('App\Modules\Access\Models\Companies');
        $company_id=$this->session->get('company_id');
        $item_id=$request->getVar('item_id');

        $permission_id=6;           //Permiso singular para editar la configuración de una empresa
        $permission_id_all=7;       //Permiso plural para editar la configuración de una empresa
        $module_id=2; //Access

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$mCompanies->get_Authority($item_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }


        $obEB=new ElectronicBill();
        $data_company=$mCompanies->get_DataCompany($item_id);
        $api_response=$obEB->create_company_api($data_company,$item_id,$user_id);

        $arrayResponse = json_decode($api_response,true);
        if(!is_array($arrayResponse)){

            return $this->setResponseFormat('json')->respond($api_response);
        }
        if(isset($arrayResponse["errors"])){
            foreach ($arrayResponse["errors"] as $key => $value) {
                $response["status"]=0;
                $response["msg"]=$value[0];
                $response["msg_api"]=$arrayResponse;
                return $this->setResponseFormat('json')->respond($response);
            }
        }else{
            if(isset($arrayResponse["token"])){
                $data_form["token_api_soenac"]=$arrayResponse["token"];

                $mCompanies->edit_company($data_form,$item_id);
                $response["status"]=1;
                $response["msg"]=$arrayResponse["message"];
                $response["msg_api"]=$arrayResponse;
                return $this->setResponseFormat('json')->respond($response);
            }else{
                return $this->setResponseFormat('json')->respond($api_response);
            }

        }



    }

    /**
     * Actualiza una empresa en el api de documentos electrónicos de soenac
     * @param $item_id
     * @return mixed|void
     */
    public function api_update_company($item_id){

        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $user_id=$this->session->get('user');
        $request = service('request');
        $mUsers=model('App\Modules\Access\Models\Users');
        $mCompanies=model('App\Modules\Access\Models\Companies');
        $company_id=$this->session->get('company_id');
        $item_id=$request->getVar('item_id');

        $permission_id=6;           //Permiso singular para editar la configuración de una empresa
        $permission_id_all=7;       //Permiso plural para editar la configuración de una empresa
        $module_id=2; //Access

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$mCompanies->get_Authority($item_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }


        $obEB=new ElectronicBill();
        $data_company=$mCompanies->get_DataCompany($item_id);
        $api_response=$obEB->update_company_api($data_company,$item_id,$user_id);

        $arrayResponse = json_decode($api_response,true);
        if(!is_array($arrayResponse)){

            return $this->setResponseFormat('json')->respond($api_response);
        }
        if(isset($arrayResponse["errors"])){
            foreach ($arrayResponse["errors"] as $key => $value) {
                $response["status"]=0;
                $response["msg"]=$value[0];
                $response["msg_api"]=$arrayResponse;
                return $this->setResponseFormat('json')->respond($response);
            }
        }else{
            if(isset($arrayResponse["company"])){

                $response["status"]=1;
                $response["msg"]=$arrayResponse["message"];
                $response["msg_api"]=$arrayResponse;
                return $this->setResponseFormat('json')->respond($response);
            }else{
                return $this->setResponseFormat('json')->respond($api_response);
            }

        }
    }

    /**
     * recibe el logo de una empresa y lo almacena en su carpeta correspondiente
     * @return string
     */
    public function receive_logo_company(){


        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $request = service('request');
        $user_id=$this->session->get('user');
        $company_id=$this->session->get('company_id');
        $item_id=$request->getVar('item_id');

        $mUsers=model('App\Modules\Access\Models\Users');
        $mCompanies=model('App\Modules\Access\Models\Companies');

        $permission_id=6;           //Permiso singular para editar la configuración de una empresa
        $permission_id_all=7;       //Permiso plural para editar la configuración de una empresa
        $module_id=2; //Access

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$mCompanies->get_Authority($item_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }


        $file = $this->request->getFile('company_logo');

        $destiny="public".DIRECTORY_SEPARATOR."companies".DIRECTORY_SEPARATOR.$item_id.DIRECTORY_SEPARATOR."img";
        $destiny=ROOTPATH.$destiny;
        $file->move($destiny, "header-logo.png",true);
        $destiny.="/header-logo.png";
        $image=service('image');
        $image->withFile($destiny)
            ->resize(700, 300, false)
            ->save($destiny);

        $im = file_get_contents($destiny);
        $logo_base_64=base64_encode($im);

        $mLogo=model('App\Modules\TS5\Models\AppCompaniesLogos');
        $data_logo=$mLogo->get_DataLogo($item_id);
        if(!isset($data_logo["id"])){
            $ts5=new Ts5_class();
            $data_logo["id"]=$ts5->getUniqueId();
            $data_logo["logo_base64"]=$logo_base_64;
            $data_logo["company_id"]=$item_id;
            $data_logo["author"]=$user_id;
            $mLogo->insert($data_logo);
        }else{
            $data_logo["logo_base64"]=$logo_base_64;
            $mLogo->edit_Logo($data_logo,$data_logo["id"]);
        }
        $response["status"]=1;
        $response["msg"]=lang('Access.msg_create_logo');

        return $this->setResponseFormat('json')->respond($response);


    }

    /**
     * Crea el logo en el api de soenac
     * @param $item_id
     * @return mixed
     */
    public function create_logo_company_api($item_id){

        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $user_id=$this->session->get('user');
        $company_id=$this->session->get('company_id');

        $mUsers=model('App\Modules\Access\Models\Users');
        $mCompanies=model('App\Modules\Access\Models\Companies');

        $permission_id=6;           //Permiso singular para editar la configuración de una empresa
        $permission_id_all=7;       //Permiso plural para editar la configuración de una empresa
        $module_id=2; //Access

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$mCompanies->get_Authority($item_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }
        $obEB=new ElectronicBill();
        $data_company=$mCompanies->get_DataCompany($item_id);
        $api_response=$obEB->create_logo_company_api($data_company,$item_id,$user_id);
        if($api_response==false){
            $response["status"]=0;
            $response["msg"]=lang('Ts5.not_logo');
            return $this->setResponseFormat('json')->respond($response);
        }

        $arrayResponse = json_decode($api_response,true);

        if(isset($arrayResponse["message"])){
            $response["status"]=1;
            $response["msg"]=$arrayResponse["message"];
            $response["msg_api"]=$arrayResponse;
            return $this->setResponseFormat('json')->respond($response);
        }else{
            $response["status"]=0;
            $response["msg"]="Error";
            $response["msg_api"]=$arrayResponse;
            return $this->setResponseFormat('json')->respond($response);
        }

    }

    /**
     * crea el software tanto en la base de datos local como en el api de soenac
     * @param $item_id
     * @return mixed|void
     */
    public function create_software($item_id){
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $user_id=$this->session->get('user');
        $company_id=$this->session->get('company_id');

        $mUsers=model('App\Modules\Access\Models\Users');
        $mCompanies=model('App\Modules\Access\Models\Companies');

        $permission_id=6;           //Permiso singular para editar la configuración de una empresa
        $permission_id_all=7;       //Permiso plural para editar la configuración de una empresa
        $module_id=2; //Access

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$mCompanies->get_Authority($item_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $request=service('request');
        $data_form_serialized=$request->getVar('data_form_serialized');

        parse_str($data_form_serialized,$data_form);

        $validator["numeric"]["pin"]=1;

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

        $mSoftware=model('App\Modules\TS5\Models\AppCompaniesSoftware');
        $data_software=$mSoftware->get_DataSoftware($item_id);
        if(!isset($data_software["id"])){
            $ts5=new Ts5_class();
            $data_form["id"]=$ts5->getUniqueId("sf_",true);
            $data_form["author"]=$user_id;
            $data_form["company_id"]=$company_id;
            $mSoftware->insert($data_form);
        }else{
            $mSoftware->edit_Software($data_form,$data_software["id"]);
        }

        $obEB=new ElectronicBill();
        $data_company=$mCompanies->get_DataCompany($item_id);
        $api_response=$obEB->create_software_api($data_company,$data_software,$item_id,$user_id);

        $arrayResponse = json_decode($api_response,true);

        if(isset($arrayResponse["message"])){
            $response["status"]=1;
            $response["msg"]=$arrayResponse["message"];
            $response["msg_api"]=$arrayResponse;
            return $this->setResponseFormat('json')->respond($response);
        }else{
            $response["status"]=0;
            $response["msg"]="Error";
            $response["msg_api"]=$arrayResponse;
            return $this->setResponseFormat('json')->respond($response);
        }


    }

    /**
     * recibe y guarda el certificado digital en p.12
     * @return mixed
     */
    public function receive_certificate(){


        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $request = service('request');
        $user_id=$this->session->get('user');
        $company_id=$this->session->get('company_id');
        $item_id=$request->getVar('item_id');

        $mUsers=model('App\Modules\Access\Models\Users');
        $mCompanies=model('App\Modules\Access\Models\Companies');

        $permission_id=6;           //Permiso singular para editar la configuración de una empresa
        $permission_id_all=7;       //Permiso plural para editar la configuración de una empresa
        $module_id=2; //Access

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$mCompanies->get_Authority($item_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }


        $file = $this->request->getFile('company_certificate');

        $im = file_get_contents($file->getTempName());
        $base_64=base64_encode($im);

        $destiny="companies".DIRECTORY_SEPARATOR.$item_id.DIRECTORY_SEPARATOR."certificates";
        $destiny=WRITEPATH.$destiny;
        $file->move($destiny, "Certificate.p12",true);



        $mCertificate=model('App\Modules\TS5\Models\AppCertificates');
        $data_certificate = $mCertificate->get_DataCertificate($item_id);
        if(!isset($data_certificate["id"])){
            $ts5=new Ts5_class();
            $data_certificate["id"]=$ts5->getUniqueId("cf_",true);
            $data_certificate["base_64"]=$base_64;
            $data_certificate["company_id"]=$item_id;
            $data_certificate["author"]=$user_id;
            $mCertificate->insert($data_certificate);
        }else{
            $data_certificate["base_64"]=$base_64;
            $mCertificate->edit_Certificate($data_certificate,$data_certificate["id"]);
        }
        $response["status"]=1;
        $response["msg"]=lang('Access.msg_received_certificate');

        return $this->setResponseFormat('json')->respond($response);


    }


    /**
     * crea el certificado digital en el api de soenac
     * @param $item_id
     * @return mixed|void
     */
    public function create_certificate($item_id){
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $user_id=$this->session->get('user');
        $company_id=$this->session->get('company_id');

        $mUsers=model('App\Modules\Access\Models\Users');
        $mCompanies=model('App\Modules\Access\Models\Companies');

        $permission_id=6;           //Permiso singular para editar la configuración de una empresa
        $permission_id_all=7;       //Permiso plural para editar la configuración de una empresa
        $module_id=2; //Access

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$mCompanies->get_Authority($item_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $request=service('request');
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

        $mCertificate=model('App\Modules\TS5\Models\AppCertificates');
        $data_certificate=$mCertificate->get_DataCertificate($item_id);
        if(!isset($data_certificate["id"])){
            $response["status"]=0;
            $response["msg"]="Error";
            $response["msg_api"]=lang('Ts5.not_certificate');
            return $this->setResponseFormat('json')->respond($response);
        }else{
            $mCertificate->edit_Certificate($data_form,$data_certificate["id"]);
        }

        $obEB=new ElectronicBill();
        $data_company=$mCompanies->get_DataCompany($item_id);
        $api_response=$obEB->create_certificate_api($data_company,$data_certificate,$item_id,$user_id);

        $arrayResponse = json_decode($api_response,true);

        if(isset($arrayResponse["message"])){
            $response["status"]=1;
            $response["msg"]=$arrayResponse["message"];
            $response["msg_api"]=$arrayResponse;
            return $this->setResponseFormat('json')->respond($response);
        }else{
            $response["status"]=0;
            $response["msg"]="Error";
            $response["msg_api"]=$arrayResponse;
            return $this->setResponseFormat('json')->respond($response);
        }


    }

    /**
     * Establece el tipo de ambiente de la empresa, producción o pruebas
     * @param $item_id
     * @return mixed
     */
    public function set_environment_api($item_id){
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $user_id=$this->session->get('user');
        $company_id=$this->session->get('company_id');

        $mUsers=model('App\Modules\Access\Models\Users');
        $mCompanies=model('App\Modules\Access\Models\Companies');

        $permission_id=6;           //Permiso singular para editar la configuración de una empresa
        $permission_id_all=7;       //Permiso plural para editar la configuración de una empresa
        $module_id=2; //Access

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$mCompanies->get_Authority($item_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $request=service('request');
        $type_environment=$request->getVar('type_environment');
        if($type_environment <> 1 and $type_environment<>2 ){
            $response["status"]=0;
            $response["msg"]=lang('Access.type_environment_empty');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }
        $obEB=new ElectronicBill();
        $data_company=$mCompanies->get_DataCompany($item_id);
        $api_response=$obEB->set_type_environment_api($data_company,$type_environment,$item_id,$user_id);

        $arrayResponse = json_decode($api_response,true);

        if(isset($arrayResponse["type_environment_id"])){
            $response["status"]=1;
            $response["msg"]=lang('msg.set_environment_test');
            if($type_environment==1){
                $response["msg"]=lang('msg.set_environment_production');
            }
            $response["msg_api"]=$arrayResponse;
            return $this->setResponseFormat('json')->respond($response);
        }else{
            $response["status"]=0;
            $response["msg"]="Error";
            $response["msg_api"]=$arrayResponse;
            return $this->setResponseFormat('json')->respond($response);
        }


    }

    /**
     * Obtiene la numeración dian de una empresa
     * @param $item_id
     */
    public function get_numeration($item_id){
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $user_id=$this->session->get('user');
        $company_id=$this->session->get('company_id');

        $mUsers=model('App\Modules\Access\Models\Users');
        $mCompanies=model('App\Modules\Access\Models\Companies');

        $permission_id=6;           //Permiso singular para editar la configuración de una empresa
        $permission_id_all=7;       //Permiso plural para editar la configuración de una empresa
        $module_id=2; //Access

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$mCompanies->get_Authority($item_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $obEB=new ElectronicBill();
        $data_company=$mCompanies->get_DataCompany($item_id);
        $api_response=$obEB->get_numeration($data_company,$item_id,$user_id);
        if($api_response=='E1'){
            $response["status"]=0;
            $response["msg"]=lang('msg.not_software');

            return $this->setResponseFormat('json')->respond($response);
        }

        $arrayResponse = json_decode($api_response,true);

        if(isset($arrayResponse["responseDian"])){
            $response["status"]=1;
            $response["msg"]=lang('msg.get_numeration_ok');
            $response["msg_api"]=$arrayResponse;
            return $this->setResponseFormat('json')->respond($response);
        }else{
            $response["status"]=0;
            $response["msg"]="Error";
            $response["msg_api"]=$arrayResponse;
            return $this->setResponseFormat('json')->respond($response);
        }


    }

    public function create_resolution($item_id){
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $user_id=$this->session->get('user');
        $company_id=$this->session->get('company_id');

        $mUsers=model('App\Modules\Access\Models\Users');
        $mCompanies=model('App\Modules\Access\Models\Companies');

        $permission_id=6;           //Permiso singular para editar la configuración de una empresa
        $permission_id_all=7;       //Permiso plural para editar la configuración de una empresa
        $module_id=2; //Access

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$mCompanies->get_Authority($item_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $request=service('request');
        $data_form_serialized=$request->getVar('data_form_serialized');

        parse_str($data_form_serialized,$data_form);

        $validator["numeric"]["resolution"]=1;
        $validator["numeric"]["from"]=1;
        $validator["numeric"]["to"]=1;
        $validator["not_required"]["prefix"]=1;
        $validator["not_required"]["action_type_resolution_id"]=1;

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

        $obEB=new ElectronicBill();
        $data_company=$mCompanies->get_DataCompany($item_id);

        return("resolution");
    }

    //Fin clase

}