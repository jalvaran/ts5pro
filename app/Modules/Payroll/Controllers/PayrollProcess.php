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
 * Este archivo procesa las peticiones CRUD para el modulo de nomina
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-11-22
 * @updated 2021-11-30
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

namespace App\Modules\Payroll\Controllers;

use App\Modules\TS5\Libraries\Session;
use App\Controllers\BaseController;
use App\Modules\TS5\Libraries\Ts5_class;
use App\Modules\Payroll\Libraries\Payroll_class;

//use App\Modules\Inverpacific\Libraries\Creditmoto_class;
use CodeIgniter\API\ResponseTrait;


class PayrollProcess extends BaseController
{
    use ResponseTrait;
    private $session;
    private $module_id;

    function __construct()
    {

        $this->session = new Session();
        $this->module_id='613784ab2471f217811473';
    }
    
    
    /**
     * Función crear o editar un empleado
     * @return mixed
     */
    function save_employee() {
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
        $model=model('App\Modules\Payroll\Models\Employees');
        if($id==''){ //Crear
            $permission_id='619530962d29c295237319';  
            if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
                $response["status"]=0;
                $response["msg"]=lang('Access.access_view_error');
                return $this->setResponseFormat('json')->respond($response);
            }
        }else{  //Editar

            $permission_id='619530f6b9bd1092454025';           //Permiso para Editar singular Ver en tabla access_control_permissions
            $permission_id_all='619531174776b267392167';       //Permiso para Editar plural Ver en tabla access_control_permissions

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
        $validator["numeric"]["telephone1"]=1;
        //$validator["numeric"]["telephone2"]=1;
        $validator["numeric"]["identification"]=1;
        $validator["numeric"]["salary"]=1;
        
        
        $validator["not_required"]["telephone2"]=1;
        $validator["not_required"]["reasons_withdrawal_id"]=1;
        $validator["not_required"]["second_name"]=1;
        $validator["not_required"]["second_surname"]=1;
        $validator["not_required"]["eps_code"]=1;
        $validator["not_required"]["afp_code"]=1;
        $validator["not_required"]["arl_code"]=1;
        $validator["not_required"]["finish_date"]=1;
        $validator["not_required"]["ccf_code"]=1;  
        $validator["not_required"]["transportation_assistance"]=1;
        
        if($data_form["arl_code"]==''){
            $validator["not_required"]["arl_level_id"]=1;
        }
        if($data_form["reasons_withdrawal_id"]==''){
            $data_form["reasons_withdrawal_id"]='6128f69283025963104500';  //Trabajador activo
        }
        if($data_form["bank"]=='' and $data_form["account_type"]=='' and $data_form["account_number"]==''){
            $validator["not_required"]["bank"]=1;
            $validator["not_required"]["account_type"]=1;
            $validator["not_required"]["account_number"]=1;
        }else{
            $validator["numeric"]["account_number"]=1;
        }     
        
        
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
        
        if($model->identification_exists($data_form["identification"]) and $id==''){
            $response["status"]=0;
            $data_lang["field_name"]=lang('fields.'.$field);
            $response["msg"]=lang('Ts5.identification_exist',$data_lang);
            $response["object_id"]="identification";
            return $this->setResponseFormat('json')->respond($response);
        }
        
        $mMunicipalities=model('App\Modules\Access\Models\Municipalities');
        $data_municipalitie=$mMunicipalities->getDataMunicipalitie($data_form["municipalities_id"]);
        $data_form["departments_id"]=$data_municipalitie["department_id"];
        $data_form["countries_id"]=$data_municipalitie["country_id"];
        $modelThird=model('App\Modules\TS5\Models\Thirds');
        
        if($id==''){ //Crear
            $data_form["id"]=$ts5->getUniqueId("",true);
            $data_form["author"]=$user_id;
            
            $data_form["type_third"]=3;
            $data_form["type_liabilitie_id"]=29;
            $data_form["type_regime_id"]=2;  
            $data_form["type_organization_id"]=2;
            $data_form["countries_id"]=46;
            $modelThird->insert($data_form);
            $data_form["third_id"]=$data_form["id"];
            $data_form["active"]=1;
            
            $model->insert($data_form);
            
            
        }else{ //Editar
            $modelThird->update($id,$data_form);
            $model->update($id,$data_form);
        }

        $response["status"]=1;
        $response["msg"]=lang('msg.save_register');
        return $this->setResponseFormat('json')->respond($response);
    }
    
    
    /**
     * Función crear o editar un documento general de nomina
     * @return mixed
     */
    function save_general_document() {
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
        $model=model('App\Modules\Payroll\Models\GeneralDocuments');
        if($id==''){ //Crear
            $permission_id='61a3a415673ff904351388';  
            if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
                $response["status"]=0;
                $response["msg"]=lang('Access.access_view_error');
                return $this->setResponseFormat('json')->respond($response);
            }
        }else{  //Editar

            $permission_id='61a3a4316ed4b199726738';           //Permiso para Editar singular Ver en tabla access_control_permissions
            $permission_id_all='61a3a44759caa350482844';       //Permiso para Editar plural Ver en tabla access_control_permissions

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
        $validator["not_required"]["notes"]=1;
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
            $data_form["payment_form"]=1;  
            $data_form["payment_method_id"]=42;  
            $data_form["date_issue"]=$data_form["payment_dates"]; 
            $data_form["time_issue"]=date("H:i:s");
            $data_form["status"]=1;
            
            $model->insert($data_form);
            
            
        }else{ //Editar
            $data_form["payment_method_id"]=42;  
            $data_form["date_issue"]=$data_form["payment_dates"];
            $data_form["time_issue"]=date("H:i:s");
            $model->update($id,$data_form);
        }

        $response["status"]=1;
        $response["msg"]=lang('msg.save_register');
        return $this->setResponseFormat('json')->respond($response);
    }
    
    
    /**
     * agregar un empleado a un documento general de nomina
     * @return mixed
     */
    function employee_add() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            
        }
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');

        $request = service('request');
        $payroll_employee_id=$request->getVar('id');
        $payroll_documents_id=$request->getVar('general_document_id');
        
        $mUsers=model('App\Modules\Access\Models\Users');
        $module_id=$this->module_id;
        $model=model('App\Modules\Payroll\Models\GeneralDocuments');
        
        $permission_id='61a3a4316ed4b199726738';           //Permiso para Editar singular Ver en tabla access_control_permissions
        $permission_id_all='61a3a44759caa350482844';       //Permiso para Editar plural Ver en tabla access_control_permissions

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$model->get_Authority($payroll_documents_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);

        }

        
        
        $payroll=new Payroll_class();
        $payroll->add_EmployeeGeneralDocument( $payroll_documents_id, $payroll_employee_id);
        
        $response["status"]=1;
        $response["msg"]=lang('msg.save_register');
        return $this->setResponseFormat('json')->respond($response);
    }
    
    /**
     * borrar un empleado de un documento general de nomina
     * @return mixed
     */
    function employee_delete_general_document() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
           
        }
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');

        $request = service('request');
        $id=$request->getVar('id');
        $payroll_documents_id=$request->getVar('general_document_id');
        
        $mUsers=model('App\Modules\Access\Models\Users');
        $module_id=$this->module_id;
        $model=model('App\Modules\Payroll\Models\GeneralDocuments');
        
        $permission_id='61a3a4316ed4b199726738';           //Permiso para Editar singular Ver en tabla access_control_permissions
        $permission_id_all='61a3a44759caa350482844';       //Permiso para Editar plural Ver en tabla access_control_permissions

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$model->get_Authority($payroll_documents_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);

        }
        $payroll=new Payroll_class();
        $payroll->delete_employee_document($id);
        $response["status"]=1;
        $response["msg"]=lang('msg.delete_register');
        return $this->setResponseFormat('json')->respond($response);
    }
    
    
    /**
     * borrar todos los empleados de un documento general de nomina
     * @return mixed
     */
    function employee_delete_all_general_document() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');

        $request = service('request');
        
        $payroll_documents_id=$request->getVar('general_document_id');
        
        $mUsers=model('App\Modules\Access\Models\Users');
        $module_id=$this->module_id;
        $model=model('App\Modules\Payroll\Models\GeneralDocuments');
        
        $permission_id='61a3a4316ed4b199726738';           //Permiso para Editar singular Ver en tabla access_control_permissions
        $permission_id_all='61a3a44759caa350482844';       //Permiso para Editar plural Ver en tabla access_control_permissions

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$model->get_Authority($payroll_documents_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);

        }
        $payroll=new Payroll_class();
        $m_EmployeeAdd=model('App\Modules\Payroll\Models\EmployeesAdded');
        $data_addeds=$m_EmployeeAdd->select('id')
                        ->where('payroll_documents_id',$payroll_documents_id)
                        ->findAll();
        foreach ($data_addeds as $key => $value) {
            $payroll->delete_employee_document($value["id"]);
        }
               
        $response["status"]=1;
        $response["msg"]=lang('msg.delete_register');
       
        return $this->setResponseFormat('json')->respond($response);
    }
    
    /**
     * agregar todos los empleados de un documento general de nomina
     * @return mixed
     */
    function employee_add_all_general_document() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            
        }
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');

        $request = service('request');
        
        $payroll_documents_id=$request->getVar('general_document_id');
        
        $mUsers=model('App\Modules\Access\Models\Users');
        $module_id=$this->module_id;
        $model=model('App\Modules\Payroll\Models\GeneralDocuments');
        
        $permission_id='61a3a4316ed4b199726738';           //Permiso para Editar singular Ver en tabla access_control_permissions
        $permission_id_all='61a3a44759caa350482844';       //Permiso para Editar plural Ver en tabla access_control_permissions

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$model->get_Authority($payroll_documents_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);

        }
        
        
        $m_Employee=model('App\Modules\Payroll\Models\Employees');
        $employees=$m_Employee->get_ActiveEmployees();
        
        $payroll=new Payroll_class();
        
        foreach ($employees as $key => $value) {
            $payroll->add_EmployeeGeneralDocument($payroll_documents_id, $value["id"]);
            
        }
                                
        $response["status"]=1;
        $response["msg"]=lang('msg.save_register');
        
        return $this->setResponseFormat('json')->respond($response);
    }
    
    /**
     * construir documentos individuales de nomina
     * @return mixed
     */
    function build_individual_documents() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
           
        }
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');

        $request = service('request');
        
        $payroll_documents_id=$request->getVar('id');
        
        $mUsers=model('App\Modules\Access\Models\Users');
        $module_id=$this->module_id;
        $model=model('App\Modules\Payroll\Models\GeneralDocuments');
        
        $permission_id='61a3a4316ed4b199726738';           //Permiso para Editar singular Ver en tabla access_control_permissions
        $permission_id_all='61a3a44759caa350482844';       //Permiso para Editar plural Ver en tabla access_control_permissions

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$model->get_Authority($payroll_documents_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);

        }
        
        $m_EmployeeAdd=model('App\Modules\Payroll\Models\EmployeesAdded');
               
        $ts5=new Ts5_class();
        $payroll=new Payroll_class();
        
        $employees=$m_EmployeeAdd->get_EmployeesDocument($payroll_documents_id);
        
        foreach ($employees as $key => $value) {
            $id=$ts5->getUniqueId("", true);
            $payroll->individual_payroll_create($id,$payroll_documents_id, $value["payroll_employee_id"]);
        }
        $data["date_issue"]=date("Y-m-d");
        $data["time_issue"]=date("H:i:s");
        $model->update($payroll_documents_id,$data);                      
        $response["status"]=1;
        $response["msg"]=lang('msg.save_register');
        
        return $this->setResponseFormat('json')->respond($response);
    }
    
    /**
     * Función para contar los diferentes listados
     * @return mixed
     */
    function documents_counts() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');
        
        $mUsers=model('App\Modules\Access\Models\Users');
        $module_id=$this->module_id;
        $model=model('App\Modules\Payroll\Models\GeneralDocuments');
        
        $permission_id='61a195eaebce5408948742';  
        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
        }
        $m_individual_documents=model('App\Modules\Payroll\Models\IndividualDocuments');
        $general_documents_total=$model->countAll();
        $individual_documents_total=$m_individual_documents->countAll();
        $response["status"]=1;
        $response["count_list_1"]=$general_documents_total;
        $response["count_list_2"]=$individual_documents_total;
        $response["count_list_3"]=0;
        $response["count_list_4"]=0;
        $response["msg"]=lang('msg.save_register');
        return $this->setResponseFormat('json')->respond($response);
    }
    
    /**
     * Función para reportar una nomina electronica individual
     * @return mixed
     */
    function report_individual_document() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            
        }
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');
        
        $mUsers=model('App\Modules\Access\Models\Users');
        $module_id=$this->module_id;
        
        
        $permission_id='61a4e0518cba5930159250';  
        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
        }
        $mCompanies=model('App\Modules\Access\Models\Companies');
        $data_company=$mCompanies->get_DataCompany($company_id);
        
        $mPayrollDocument=model('App\Modules\Payroll\Models\IndividualDocuments');
        $mViewPayrollDocument=model('App\Modules\Payroll\Models\ViewIndividualDocuments');
        $request = service('request');        
        $id=$request->getVar('id'); //Id de la nomina a reportar
        
        $data_document=$mPayrollDocument->get_Data($id);
        $data_view_document=$mViewPayrollDocument->get_Data($id);
        if($data_document["is_valid"]==1 and $data_document["uuid"]<>''){
            $response["status"]=0;
            $response["msg"]=lang('payroll.error2');            
            return $this->setResponseFormat('json')->respond($response);
        }
        $payroll=new Payroll_class();
        $api_response=$payroll->report_individual_document($data_company, $data_view_document);

        $arrayResponse = json_decode($api_response,true);
        if(!is_array($arrayResponse)){

            return $this->setResponseFormat('json')->respond($api_response);
        }
        $document_update=0;
        if(isset($arrayResponse["is_valid"])){
            $document_update=1;
            $data["is_valid"]=$arrayResponse["uuid"];
        }
        if(isset($arrayResponse["uuid"])){
            $document_update=1;
            if($arrayResponse["uuid"]<>'' and $arrayResponse["uuid"]<>null){
                $data["uuid"]=$arrayResponse["uuid"];
            }
            
        }
        if(isset($arrayResponse["zip_key"])){
            $document_update=1;
            $data["zip_key"]=$arrayResponse["zip_key"];
        }
        if(isset($arrayResponse["status_code"])){
            $document_update=1;
            $data["status_code"]=$arrayResponse["status_code"];
        }
        if(isset($arrayResponse["status_description"])){
            $document_update=1;
            $data["status_description"]=$arrayResponse["status_description"];
        }
        if(isset($arrayResponse["errors_messages"])){
            $document_update=1;
            if(is_array($arrayResponse["errors_messages"])){
                $errors=json_encode($arrayResponse["errors_messages"]);
            }else{
                $errors=($arrayResponse["errors_messages"]);
            }
            $data["errors_messages"]= $errors;
        }
        
        if($document_update==1){
            
            $mPayrollDocument->update($id,$data);
        }
                
        $response["status"]=$document_update;
        $response["msg"]=lang('payroll.document_report_ok');
        $response["msg_api"]= json_encode($arrayResponse);
        return $this->setResponseFormat('json')->respond($response);
        
    }
    
    
    /**
     * Función para reportar una nota de ajuste a nomina electronica individual
     * @return mixed
     */
    function report_note() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            
        }
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');
        
        $mUsers=model('App\Modules\Access\Models\Users');
        $module_id=$this->module_id;
        
        
        $permission_id='61a4e0518cba5930159250';  
        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
        }
        $mCompanies=model('App\Modules\Access\Models\Companies');
        $data_company=$mCompanies->get_DataCompany($company_id);
        
        $mNotes=model('App\Modules\Payroll\Models\Notes');
        
        $request = service('request');        
        $id=$request->getVar('id'); //Id de la nomina a reportar
        $data_note=$mNotes->get_Data($id);
        
        if($data_note["is_valid"]==1 and $data_note["uuid"]<>''){
            $response["status"]=0;
            $response["msg"]=lang('payroll.error2');            
            return $this->setResponseFormat('json')->respond($response);
        }
        $payroll=new Payroll_class();
        $api_response=$payroll->report_note($data_company, $data_note);

        $arrayResponse = json_decode($api_response,true);
        if(!is_array($arrayResponse)){

            return $this->setResponseFormat('json')->respond($api_response);
        }
        $document_update=0;
        if(isset($arrayResponse["is_valid"])){
            $document_update=1;
            $data["is_valid"]=$arrayResponse["uuid"];
        }
        if(isset($arrayResponse["uuid"])){
            $document_update=1;
            if($arrayResponse["uuid"]<>'' and $arrayResponse["uuid"]<>null){
                $data["uuid"]=$arrayResponse["uuid"];
            }
            
        }
        if(isset($arrayResponse["zip_key"])){
            $document_update=1;
            $data["zip_key"]=$arrayResponse["zip_key"];
        }
        if(isset($arrayResponse["status_code"])){
            $document_update=1;
            $data["status_code"]=$arrayResponse["status_code"];
        }
        if(isset($arrayResponse["status_description"])){
            $document_update=1;
            $data["status_description"]=$arrayResponse["status_description"];
        }
        if(isset($arrayResponse["errors_messages"])){
            $document_update=1;
            if(is_array($arrayResponse["errors_messages"])){
                $errors=json_encode($arrayResponse["errors_messages"]);
            }else{
                $errors=($arrayResponse["errors_messages"]);
            }
            $data["errors_messages"]= $errors;
        }
        
        if($document_update==1){
            
            $mNotes->update($id,$data);
        }
                
        $response["status"]=$document_update;
        $response["msg"]=lang('payroll.document_report_ok');
        $response["msg_api"]= json_encode($arrayResponse);
        return $this->setResponseFormat('json')->respond($response);
        
    }
    
    /**
     * Función para consultar del estado de una nomina electronica individual por medio del zip_key
     * @return mixed
     */
    function check_status_zip_key() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            
        }
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');
        
        $mUsers=model('App\Modules\Access\Models\Users');
        $module_id=$this->module_id;
        
        
        $permission_id='61a4e0518cba5930159250';  
        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
        }
        $mCompanies=model('App\Modules\Access\Models\Companies');
        $data_company=$mCompanies->get_DataCompany($company_id);
        
        
        
        $request = service('request');        
        $id=$request->getVar('id'); //Id de la nomina a reportar
        $zip_key=$request->getVar('zip_key'); //Id de la nomina a reportar
        $list_id=$request->getVar('list_id');
        if($list_id==2){//Si esta consultando el zip key de un documento de nomina
            $mPayrollDocument=model('App\Modules\Payroll\Models\IndividualDocuments');
        }
        if($list_id==3){//Si está consultando el zip key de una nota
            $mPayrollDocument=model('App\Modules\Payroll\Models\Notes');
        }
        
        
        $payroll=new Payroll_class();
        if($zip_key==''){
            $response["status"]=0;
            $response["msg"]=lang('payroll.error1');
            
            return $this->setResponseFormat('json')->respond($response);
        }
        $api_response=$payroll->status_document_zip_key($data_company, $zip_key);

        $arrayResponse = json_decode($api_response,true);
        
        if(!is_array($arrayResponse)){

            return $this->setResponseFormat('json')->respond($api_response);
        }
        $document_update=0;
        if(isset($arrayResponse["is_valid"])){
            $document_update=1;
            $data["is_valid"]=$arrayResponse["is_valid"];
        }
        if(isset($arrayResponse["uuid"])){
            $document_update=1;
            if($arrayResponse["uuid"]<>'' and $arrayResponse["uuid"]<>null){
                $data["uuid"]=$arrayResponse["uuid"];
            }
            
        }
        if(isset($arrayResponse["zip_key"])){
            $document_update=1;
            $data["zip_key"]=$arrayResponse["zip_key"];
        }
        if(isset($arrayResponse["status_code"])){
            $document_update=1;
            $data["status_code"]=$arrayResponse["status_code"];
        }
        if(isset($arrayResponse["status_description"])){
            $document_update=1;
            $data["status_description"]=$arrayResponse["status_description"];
        }
        if(isset($arrayResponse["errors_messages"])){
            $document_update=1;
            if(is_array($arrayResponse["errors_messages"])){
                $errors=json_encode($arrayResponse["errors_messages"]);
            }else{
                $errors=($arrayResponse["errors_messages"]);
            }
            $arrayResponse["errors_messages"]= $errors;
        }
        
        if($document_update==1){
            
            $mPayrollDocument->update($id,$data);
        }
        
        
        $response["status"]=1;
        if(isset($arrayResponse["errors_messages"])){            
            $response["msg"]=$arrayResponse["errors_messages"];
        }else{
            $response["msg"]=$arrayResponse["status_description"];
        }
        $response["msg"]=$arrayResponse["status_description"];
        $response["msg"].=$arrayResponse["errors_messages"];
        $response["msg_api"]=$arrayResponse;
        return $this->setResponseFormat('json')->respond($response);
        
    }
    
    
    /**
     * Función que retorna el json de un documento a reportar
     * @return mixed
     */
    function get_json_payroll_report() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            
        }
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');
        
        $mUsers=model('App\Modules\Access\Models\Users');
        $module_id=$this->module_id;
        
        
        $permission_id='61a4e0518cba5930159250';  
        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
        }
        $mCompanies=model('App\Modules\Access\Models\Companies');
        $data_company=$mCompanies->get_DataCompany($company_id);
        
        //$mPayrollDocument=model('App\Modules\Payroll\Models\IndividualDocuments');
        $mViewPayrollDocument=model('App\Modules\Payroll\Models\ViewIndividualDocuments');
        $request = service('request');        
        $id=$request->getVar('id'); //Id de la nomina a reportar
        
        //$data_document=$mPayrollDocument->get_Data($id);
        $data_view_document=$mViewPayrollDocument->get_Data($id);
        
        $payroll=new Payroll_class();
        $mParameters=model('App\Modules\Payroll\Models\Parameters');
        $json=$payroll->get_json_payroll_support($data_company,$mParameters,$data_view_document);
        
                
        $response["status"]=1;
        $response["msg"]=$json;
        
        return $this->setResponseFormat('json')->respond($response);
        
    }
    
    
    /**
     * agregar un devengado
     * @return mixed
     */
    function add_earn() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            
        }
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');

        $request = service('request');
        
        $payroll_documents_id=$request->getVar('document_id');
        
        $mUsers=model('App\Modules\Access\Models\Users');
        $module_id=$this->module_id;
        $model=model('App\Modules\Payroll\Models\GeneralDocuments');
        
        $permission_id='61a3a4316ed4b199726738';           //Permiso para Editar singular Ver en tabla access_control_permissions
        $permission_id_all='61a3a44759caa350482844';       //Permiso para Editar plural Ver en tabla access_control_permissions

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$model->get_Authority($payroll_documents_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);

        }

        $data_form_serialized=$request->getVar('data_form_serialized');
        parse_str($data_form_serialized,$data_form);
        unset($data_form["payroll_type_deduction_id"]);
        
        $data_form["payroll_documents_id"]=$payroll_documents_id;
        
        $validator["numeric"]["quantity"]=1;
        $validator["numeric"]["percentage"]=1;
        $validator["numeric"]["interest_payment"]=1;
        $validator["numeric"]["layoffs_payment"]=1;
        $validator["numeric"]["payment"]=1;
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
        
        $payroll=new Payroll_class();
        $payroll->earn_add_general_document($data_form);
        
        $response["status"]=1;
        $response["msg"]=lang('msg.added_register');
        return $this->setResponseFormat('json')->respond($response);
    }
    
    
    /**
     * agregar una deduccion
     * @return mixed
     */
    function add_deduction() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            
        }
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');

        $request = service('request');
        
        $payroll_documents_id=$request->getVar('document_id');
        
        $mUsers=model('App\Modules\Access\Models\Users');
        $module_id=$this->module_id;
        $model=model('App\Modules\Payroll\Models\GeneralDocuments');
        
        $permission_id='61a3a4316ed4b199726738';           //Permiso para Editar singular Ver en tabla access_control_permissions
        $permission_id_all='61a3a44759caa350482844';       //Permiso para Editar plural Ver en tabla access_control_permissions

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$model->get_Authority($payroll_documents_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);

        }

        $data_form_serialized=$request->getVar('data_form_serialized');
        parse_str($data_form_serialized,$data_form);
        
        unset($data_form["payroll_type_earn_id"]);
        $data_form["payroll_documents_id"]=$payroll_documents_id;
        
        $validator["numeric"]["quantity"]=1;
        $validator["numeric"]["percentage"]=1;
        
        $validator["numeric"]["payment"]=1;
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
        
        $payroll=new Payroll_class();
        $payroll->deduction_add_general_document($data_form);
        
        $response["status"]=1;
        $response["msg"]=lang('msg.added_register');
        return $this->setResponseFormat('json')->respond($response);
    }
    
    
    /**
     * eliminar un devengado o una deduccion
     * @return mixed
     */
    function delete_earn_deduction_noventlie() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
        }
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');

        $request = service('request');
        
        $payroll_documents_id=$request->getVar('document_id');
        $id=$request->getVar('id');
        $earn_deduction=$request->getVar('earn_deduction'); //1 para eliminar devengado 2 para eliminar deduccion
        
        $mUsers=model('App\Modules\Access\Models\Users');
        $module_id=$this->module_id;
        $model=model('App\Modules\Payroll\Models\GeneralDocuments');
        
        $permission_id='61a3a4316ed4b199726738';           //Permiso para Editar singular Ver en tabla access_control_permissions
        $permission_id_all='61a3a44759caa350482844';       //Permiso para Editar plural Ver en tabla access_control_permissions

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$model->get_Authority($payroll_documents_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);

        }
        $payroll=new Payroll_class();
        if($earn_deduction==1){//Elimine un devengado
            $payroll->delete_earn($id,$payroll_documents_id);
             
        }else{//Elimine una deduccion
            $payroll->delete_deduction($id);
        }
        
        
        $response["status"]=1;
        $response["msg"]=lang('msg.delete_register');
        return $this->setResponseFormat('json')->respond($response);
    }
    
    
    
     /**
     * calcula el valor de una hora extra segun el tipo de hora extra
     * @return mixed
     */
    function times_value_calculation() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
        }
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');

        $request = service('request');
        
        $payroll_documents_id=$request->getVar('document_id');
        $payroll_employee_id=$request->getVar('payroll_employee_id');
        $quantity=$request->getVar('quantity');
        $type_time_id=$request->getVar('type_time_id');
        
        $mUsers=model('App\Modules\Access\Models\Users');
        $module_id=$this->module_id;
        $model=model('App\Modules\Payroll\Models\GeneralDocuments');
        
        $permission_id='61a3a4316ed4b199726738';           //Permiso para Editar singular Ver en tabla access_control_permissions
        $permission_id_all='61a3a44759caa350482844';       //Permiso para Editar plural Ver en tabla access_control_permissions

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$model->get_Authority($payroll_documents_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);

        }
        $payroll=new Payroll_class();
        
        $payment=$payroll->times_value_calculation($payroll_employee_id, $quantity, $type_time_id);
          
        $response["status"]=1;
        $response["msg"]=lang('msg.calculation_done');
        $response["payment"]=round($payment);
        return $this->setResponseFormat('json')->respond($response);
    }
    
    
    /**
     * crear una nota de ajuste para nomina
     * @return mixed
     */
    function save_note() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
           
        }
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');

        $request = service('request');
        
        $payroll_individual_document_id=$request->getVar('id');
        
        $mUsers=model('App\Modules\Access\Models\Users');
        $module_id=$this->module_id;
        $model=model('App\Modules\Payroll\Models\IndividualDocuments');
        
        $permission_id='61a3a4316ed4b199726738';           //Permiso para Editar singular Ver en tabla access_control_permissions
        $permission_id_all='61a3a44759caa350482844';       //Permiso para Editar plural Ver en tabla access_control_permissions

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$model->get_Authority($payroll_individual_document_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);

        }
        
        $data_form_serialized=$request->getVar('data_form_serialized');
        parse_str($data_form_serialized,$data_form);
        
        $payroll=new Payroll_class();
        $note_id=$payroll->note_create($payroll_individual_document_id,$data_form["description"]);             
        
        if($note_id=='E1'){
            $response["status"]=0;
            $response["msg"]=lang('msg.existing_note');
        }else{
            $response["status"]=1;
            $response["msg"]=lang('msg.save_register').' No. '.$note_id;
        }
        
        return $this->setResponseFormat('json')->respond($response);
    }
    
    
    /**
     * Función que retorna el json de una nota 
     * @return mixed
     */
    function get_json_payroll_note() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            
        }
        $company_id=$this->session->get('company_id');
        $user_id=$this->session->get('user');
        
        $mUsers=model('App\Modules\Access\Models\Users');
        $module_id=$this->module_id;
        
        
        $permission_id='61a4e0518cba5930159250';  
        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $response["status"]=0;
            $response["msg"]=lang('Access.access_view_error');
            return $this->setResponseFormat('json')->respond($response);
        }
        $mCompanies=model('App\Modules\Access\Models\Companies');
        $data_company=$mCompanies->get_DataCompany($company_id);
        
        
        $request = service('request');        
        $id=$request->getVar('id'); //Id de la nomina a reportar
        
        $mNotes=model('App\Modules\Payroll\Models\Notes');
        $data_note=$mNotes->get_Data($id);
        $mViewPayrollDocument=model('App\Modules\Payroll\Models\ViewIndividualDocuments');
        
        $data_view_document=$mViewPayrollDocument->get_Data($data_note["payroll_individual_document_id"]);
        if(!is_array($data_view_document)){
            return("No data");
        }
        $payroll=new Payroll_class();
        $mParameters=model('App\Modules\Payroll\Models\Parameters');
        $json=$payroll->get_json_payroll_note($data_company,$mParameters,$data_view_document,$data_note);
        
                
        $response["status"]=1;
        $response["msg"]=$json;
        
        return $this->setResponseFormat('json')->respond($response);
        
    }
    
    
    //Fin clase

}