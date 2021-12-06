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
 * Este archivo contiene el controlador dibujante de los documentos de nomina
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-11-15
 * @updated 2021-11-15
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */
namespace App\Modules\Payroll\Controllers;

use App\Modules\TS5\Libraries\Session;
use App\Controllers\BaseController;
use App\Modules\TS5\Libraries\Ts5_class;

class PayrollDocumentsDraw extends BaseController
{

    private $session;
    private $views_path;
    private $views_path_module;
    private $module_id;

    function __construct()
    {
        $this->views_path='App\Modules\TS5\Views\templates\synadmin';
        $this->views_path_module='App\Modules\Payroll\Views';
        $this->session = new Session();
        $this->module_id="613784ab2471f217811473";

    }

    /**
     * pagina inicial
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    function index() {

        if (!$this->session->get_LoggedIn()) {
            return (redirect()->to(base_url('/ts5/signin')));
        } else {
            return (redirect()->to(base_url('/menu')));
        }

    }

    /**
     * Muestra el listado de las nóminas
     * @param $company_id
     * @return \CodeIgniter\HTTP\RedirectResponse|void
     */
    function documents($company_id) {
            
        
        if (!$this->session->get_LoggedIn()) {
            return (redirect()->to(base_url('/ts5/signin')));
        }

        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $permission_id='61a195eaebce5408948742';  //documentos generales de nomina
        $module_id=$this->module_id;      //Admin
        $html="";
        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            $html.=view($this->views_path."\alert_error",$data_error);

        }

        $ts5=new Ts5_class();

        $this->session->set('company_id',$company_id);
        $mCompanies=model('App\Modules\Access\Models\Companies');        
        $db_company=$mCompanies->get_database($company_id); 
        
        $this->session->set("DB_CLIENT", $db_company);

        $data=$ts5->getDataTemplate($this->session);
        $data["data_template"]=$ts5->getDataTemplate($this->session);

        $home_js=view($this->views_path_module.'\documents\home_js',$data);
        //$forms_js=view($this->views_path_module.'\forms\forms_js',$data);
        
        $data["data_template"]["my_js"]=$home_js;
        $data["view_path"]=$this->views_path;
        $data["view_path_module"]=$this->views_path_module;
        $data["page_title"]=lang('payroll.documents_title');
        $data["module_name"]=lang('payroll.module_name');

        $html=view($this->views_path_module.'\documents\home',$data);
        

        $data["page_content"]=$html;
        echo view($this->views_path."\blank",$data);

    }
    
    /**
     * Dibuja el listado general de los documentos
     * @return type
     */
    public function general_documents() {
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id=$this->module_id;                        //nomina
        
        $permission_id="61a195eaebce5408948742";
        
          
        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            return (view($this->views_path."\alert_error",$data_error));

        }
        
        $limit=20;
        
        $fields=array(  'id',
                        'consecutive',
                        'description',
                        'status_name',
                        'payroll_period_name',
                        'settlement_start_date',
                        'settlement_end_date',
                        'notes',
                        
                        'payment_dates',
                        'payment_method_name',
                        'date_issue',
                        'time_issue',
                        
                        'author_name',                                               
            
            );
        
        $i=0;
        
        
        $data["cols"][$i++]=lang("fields.actions");
        
        foreach ($fields as $key => $value) {
            $data["cols"][$i++]=lang("fields.".$value);
        }
        
        
        $page=$request->getVar('page');
        $search=$request->getVar('search');
        
        
        $model=model('App\Modules\Payroll\Models\ViewGeneralDocuments');
                       
        $model->select($fields);
        
        $recordsTotal = $model->countAllResults(false);
        
                
        if($search<>''){
            $condition=" (description like '%$search%' or notes like '%$search%') ";
            $model->where($condition);
            
        }
        
        
        $recordsFiltered = $model->countAllResults(false);
        $totalPages= ceil($recordsFiltered/$limit);
        if($page>1){
            $previous_page=$page-1;
        }else{
            $previous_page=1;
        }
        $next_page=$page;
        $start_point=round($page * $limit - $limit);
        if($recordsFiltered>($start_point+$limit)){
            $next_page=$page+1;
        }
        $model->orderBy('id DESC');
        $response=$model->findAll($limit,$start_point);
        
        $info=lang("msg.info");
        $info=str_replace("_START_",$page,$info);
        $info=str_replace("_END_",$totalPages,$info);
        $info=str_replace("_TOTAL_",$recordsTotal,$info);
        $data["info_pagination"]=$info;
        $data["previous_page"]=$previous_page;
        $data["next_page"]=$next_page;

        
        $data["actions"]["edit"]=1;
        $data["actions"]["employees"]=1;
        //$data["actions"]["generate"]=1;
        $data["actions"]["novelties"]=1;
        //$data["actions"]["report"]=1;
        $data["data"]=$response;
        $data["recordsTotal"]=$recordsTotal;
        echo view($this->views_path_module.'\documents\general_documents_list',$data);
    }
    
    /**
     * Formulario para crear un documento general
     * @return type
     */
    public function form_general_document() {
        
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id=$this->module_id;                        //inverpacific
        $id=$request->getVar('id');
        
        if($id==''){  //Formulario de Creación
            $permission_id="61a3a415673ff904351388";
            
            if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
                $data_error["error_title"]=lang('Access.access_view_error_title');
                $data_error["msg_error"]=lang('Access.access_view_error');
                return (view($this->views_path."\alert_error",$data_error));

            }
            $ts5=new Ts5_class();
            $data["id"]=$ts5->getUniqueId("bs_", true);
            
        }else{
            $model=model('App\Modules\Payroll\Models\ViewGeneralDocuments');
            $permission_id='61a3a4316ed4b199726738';           //Permiso para Editar singular Ver en tabla access_control_permissions
            $permission_id_all='61a3a44759caa350482844';       //Permiso para Editar plural Ver en tabla access_control_permissions

            $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
            $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
            $authority=$model->get_Authority($id,$user_id);

            if(!$p_all and !($p_single and $authority)){
                $data_error["error_title"]=lang('Access.access_view_error_title');
                $data_error["msg_error"]=lang('Access.access_view_error');
                return (view($this->views_path."\alert_error",$data_error));

            }
            $data["id"]=$id;
            $data["data_form"]=$model->where('id',$id)->first();
            
        }
        
        
        
        return view($this->views_path_module.'\documents\forms\general_document_form',$data);
    }
    
    /**
     * Formulario para agregar un empleado a un documento de nomina general
     * @return type
     */
    public function employee_payroll_add_draw() {
        
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id=$this->module_id;                       
        $id=$request->getVar('id');
        
        $model=model('App\Modules\Payroll\Models\ViewGeneralDocuments');
        $permission_id='61a3a4316ed4b199726738';           //Permiso para Editar singular Ver en tabla access_control_permissions
        $permission_id_all='61a3a44759caa350482844';       //Permiso para Editar plural Ver en tabla access_control_permissions

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$model->get_Authority($id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            return (view($this->views_path."\alert_error",$data_error));

        }
        $data["id"]=$id;
        $data["data_form"]=$model->where('id',$id)->first();           
        
        return view($this->views_path_module.'\documents\forms\employees_add',$data);
    }
    /**
     * Lista de empleados disponibles en una nomina general
     * @return type
     */
    public function avaible_employees_list() {
        
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id=$this->module_id;                       
        $id=$request->getVar('id');
        
        $model=model('App\Modules\Payroll\Models\GeneralDocuments');
        $permission_id='61a3a4316ed4b199726738';           //Permiso para Editar singular Ver en tabla access_control_permissions
        $permission_id_all='61a3a44759caa350482844';       //Permiso para Editar plural Ver en tabla access_control_permissions

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$model->get_Authority($id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            return (view($this->views_path."\alert_error",$data_error));

        }
        $mEmployees=model('App\Modules\Payroll\Models\EmployeesView');
        $data["general_document_id"]=$id;
        $data["data_employees"]=$mEmployees->findAll();         
        
        return view($this->views_path_module.'\documents\avaible_employees_list',$data);
    }
    
    /**
     * Lista de empleados agregados en una nomina general
     * @return type
     */
    public function added_employees_list() {
        
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id=$this->module_id;                       
        $id=$request->getVar('id');
        
        $model=model('App\Modules\Payroll\Models\GeneralDocuments');
        $permission_id='61a3a4316ed4b199726738';           //Permiso para Editar singular Ver en tabla access_control_permissions
        $permission_id_all='61a3a44759caa350482844';       //Permiso para Editar plural Ver en tabla access_control_permissions

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$model->get_Authority($id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            return (view($this->views_path."\alert_error",$data_error));

        }
        $mEmployees=model('App\Modules\Payroll\Models\EmployeesAdded');
        $data["general_document_id"]=$id;
        $data["data_employees"]=$mEmployees->get_EmployeesDocument($id);         
        //print_r($data["data_employees"]);
        //exit();
        return view($this->views_path_module.'\documents\added_employees_list',$data);
    }
    
    
    /**
     * Dibuja el listado de los documentos individuales
     * @return type
     */
    public function individual_documents() {
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id=$this->module_id;                        
        
        $permission_id="61a195eaebce5408948742";
        
          
        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            return (view($this->views_path."\alert_error",$data_error));

        }
        
        $limit=20;
        
        $fields=array(  'id',
                        'prefix',
                        'consecutive',
                        'description',
                        'name',
                        'identification',
                        'settlement_start_date',
                        'settlement_end_date',
                        
                        'is_valid',
                        'zip_key',
                        'uuid',
                                                                   
            
            );
        
        $i=0;
        
        
        $data["cols"][$i++]=lang("fields.actions");
        
        foreach ($fields as $key => $value) {
            $data["cols"][$i++]=lang("fields.".$value);
        }
        
        
        $page=$request->getVar('page');
        $search=$request->getVar('search');
        
        
        $model=model('App\Modules\Payroll\Models\ViewIndividualDocuments');
                       
        $model->select($fields);
        
        $recordsTotal = $model->countAllResults(false);
        
                
        if($search<>''){
            $condition=" (payroll_documents_id = '$search') ";
            $model->where($condition);
            
        }
        
        
        $recordsFiltered = $model->countAllResults(false);
        $totalPages= ceil($recordsFiltered/$limit);
        if($page>1){
            $previous_page=$page-1;
        }else{
            $previous_page=1;
        }
        $next_page=$page;
        $start_point=round($page * $limit - $limit);
        if($recordsFiltered>($start_point+$limit)){
            $next_page=$page+1;
        }
        $model->orderBy('id DESC');
        $response=$model->findAll($limit,$start_point);
        
        $info=lang("msg.info");
        $info=str_replace("_START_",$page,$info);
        $info=str_replace("_END_",$totalPages,$info);
        $info=str_replace("_TOTAL_",$recordsTotal,$info);
        $data["info_pagination"]=$info;
        $data["previous_page"]=$previous_page;
        $data["next_page"]=$next_page;

        $data["actions"]["view"]=1;
        $data["actions"]["pdf"]=1;        
        $data["actions"]["report"]=1;
        $data["actions"]["status_zip_key"]=1;
        $data["actions"]["delete"]=1;
        $data["actions"]["code"]=1;
        $data["data"]=$response;
        $data["recordsTotal"]=$recordsTotal;
        
        echo view($this->views_path_module.'\documents\individual_documents_list',$data);
    }
    
    
    /**
     * Formulario para agregar novedades a una nomina
     * @return type
     */
    public function novelties_form() {
        
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id=$this->module_id;                       
        $id=$request->getVar('id');
        
        $model=model('App\Modules\Payroll\Models\ViewGeneralDocuments');
        $permission_id='61a3a4316ed4b199726738';           //Permiso para Editar singular Ver en tabla access_control_permissions
        $permission_id_all='61a3a44759caa350482844';       //Permiso para Editar plural Ver en tabla access_control_permissions

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$model->get_Authority($id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            return (view($this->views_path."\alert_error",$data_error));

        }
        $data["id"]=$id;
        $data["data_form"]=$model->where('id',$id)->first();           
        
        $model_earns=model('App\Modules\Payroll\Models\TypeEarns');
        $data["data_earns"]=$model_earns->where('id>2')->orderBy('description','ASC')->findAll();
        
        $model_deductions=model('App\Modules\Payroll\Models\TypeDeductions');
        $data["data_deductions"]=$model_deductions->orderBy('description','ASC')->findAll();
        
        $model_employees=model('App\Modules\Payroll\Models\EmployeesAdded');
        $data["data_employees"]=$model_employees->get_EmployeesDocument($id);
        return view($this->views_path_module.'\documents\forms\novelties_add',$data);
    }
    
    /**
     * Formulario realizar una nota de ajuste para una nomina
     * @return type
     */
    public function notes_form() {
        
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id=$this->module_id;                       
        $id=$request->getVar('id');
        
        $model=model('App\Modules\Payroll\Models\ViewIndividualDocuments');
        $permission_id='61a3a4316ed4b199726738';           //Permiso para Editar singular Ver en tabla access_control_permissions
        $permission_id_all='61a3a44759caa350482844';       //Permiso para Editar plural Ver en tabla access_control_permissions

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$model->get_Authority($id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            return (view($this->views_path."\alert_error",$data_error));

        }
        $data["id"]=$id;
        $data["data_form"]=$model->where('id',$id)->first();           
        
        return view($this->views_path_module.'\documents\forms\notes_form',$data);
    }
    
    /**
     * dibuja los campos necesarios de acuerdo a cada devengado
     * @return type
     */
    public function novelties_form_fields_earns() {
        
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id=$this->module_id;                       
        $id=$request->getVar('id');
        $document_id=$request->getVar('document_id');
        
        $model=model('App\Modules\Payroll\Models\GeneralDocuments');
        $permission_id='61a3a4316ed4b199726738';           //Permiso para Editar singular Ver en tabla access_control_permissions
        $permission_id_all='61a3a44759caa350482844';       //Permiso para Editar plural Ver en tabla access_control_permissions

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$model->get_Authority($document_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            return (view($this->views_path."\alert_error",$data_error));

        }
        
        
        $fields["quantity"]=array(5,12,13,14,15,17,18,19,20,25,28,29,39);
        $fields["type_time_id"]=array(5);
        $fields["percentage"]=array(16);
        $fields["layoffs_payment"]=array(16);
        $fields["interest_payment"]=array(16);
        $fields["type_incapacity_id"]=array(17);
        $fields["description"]=array(26,27);
        if(in_array($id, $fields["quantity"])){
            $data["fields"]["quantity"]=1;
        }
        
        if(in_array($id, $fields["percentage"])){
            $data["fields"]["percentage"]=1;
        }
        if(in_array($id, $fields["layoffs_payment"])){
            $data["fields"]["layoffs_payment"]=1;
        }
        
        if(in_array($id, $fields["interest_payment"])){
            $data["fields"]["interest_payment"]=1;
        }
        
        if(in_array($id, $fields["type_incapacity_id"])){            
            
            $mIncapacities=model('App\Modules\Payroll\Models\TypeIncapacities');
            $data["fields"]["type_incapacity_id"]=$mIncapacities->findAll();
            
        }
        if(in_array($id, $fields["type_time_id"])){            
            
            $mTimes=model('App\Modules\Payroll\Models\TypeTimes');
            $data["fields"]["type_time_id"]=$mTimes->findAll();
            
        }
        if(in_array($id, $fields["description"])){          
            
            
            $data["fields"]["description"]=1;
            
        }
        if($id<>'25' and $id<>'20'){
            $data["fields"]["payment"]=1;
        }
        
        $data["document_id"]=$document_id;
        
        return view($this->views_path_module.'\documents\forms\novelties_earns_fields',$data);
    }
    
    
    /**
     * dibuja los campos necesarios de acuerdo a cada deduccion
     * @return type
     */
    public function novelties_form_fields_deductions() {
        
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id=$this->module_id;                       
        $id=$request->getVar('id');
        $document_id=$request->getVar('document_id');
        
        $model=model('App\Modules\Payroll\Models\GeneralDocuments');
        $permission_id='61a3a4316ed4b199726738';           //Permiso para Editar singular Ver en tabla access_control_permissions
        $permission_id_all='61a3a44759caa350482844';       //Permiso para Editar plural Ver en tabla access_control_permissions

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$model->get_Authority($document_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            return (view($this->views_path."\alert_error",$data_error));

        }
        
        
            
        $fields["percentage"]=array(1,2,3,4,19);        
        $fields["description"]=array(6);
                
        if(in_array($id, $fields["percentage"])){
            $data["fields"]["percentage"]=1;
        }
          
        if(in_array($id, $fields["description"])){
            $data["fields"]["description"]=1;
        }
        
        $data["fields"]["payment"]=1;
        
        $data["document_id"]=$document_id;
        
        return view($this->views_path_module.'\documents\forms\novelties_deductions_fields',$data);
    }
    
    /**
     * dibuja el resumen de novedades
     * @return type
     */
    public function sumary_noventlies_general() {
        
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id=$this->module_id;                       
        $document_id=$request->getVar('id');
       
        $model=model('App\Modules\Payroll\Models\GeneralDocuments');
        $permission_id='61a3a4316ed4b199726738';           //Permiso para Editar singular Ver en tabla access_control_permissions
        $permission_id_all='61a3a44759caa350482844';       //Permiso para Editar plural Ver en tabla access_control_permissions

        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$model->get_Authority($document_id,$user_id);

        if(!$p_all and !($p_single and $authority)){
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            return (view($this->views_path."\alert_error",$data_error));

        }
        
        $mEarns=model('App\Modules\Payroll\Models\DocumentsEarns');
        $data["data_earns"]=$mEarns->get_DocumentEarns($document_id);
        
        $mDeductions=model('App\Modules\Payroll\Models\DocumentsDeductions');
        $data["data_deductions"]=$mDeductions->get_DocumentDeductions($document_id);
        $data["document_id"]=$document_id;
        
        return view($this->views_path_module.'\documents\sumary_noventlies',$data);
    }
    
    /**
     * Dibuja el listado de las notas de nomina
     * @return type
     */
    public function notes_documents_draw() {
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id=$this->module_id;                        
        
        $permission_id="61a195eaebce5408948742";
        
          
        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            return (view($this->views_path."\alert_error",$data_error));

        }
        
        $limit=20;
        
        $fields=array(  'id',
                        'prefix',
                        'consecutive',
                        'description',
                                        
                        'is_valid',
                        'zip_key',
                        'uuid',
                        'status_code',
                        'status_description',
                        'status_message',
                        'errors_messages',
                                                                   
            
            );
        
        $i=0;
        
        
        $data["cols"][$i++]=lang("fields.actions");
        
        foreach ($fields as $key => $value) {
            $data["cols"][$i++]=lang("fields.".$value);
        }
        
        
        $page=$request->getVar('page');
        $search=$request->getVar('search');
        
        
        $model=model('App\Modules\Payroll\Models\Notes');
                       
        $model->select($fields);
        
        $recordsTotal = $model->countAllResults(false);
        
                
        if($search<>''){
            $condition=" (consecutive = '$search') ";
            $model->where($condition);
            
        }
        
        
        $recordsFiltered = $model->countAllResults(false);
        $totalPages= ceil($recordsFiltered/$limit);
        if($page>1){
            $previous_page=$page-1;
        }else{
            $previous_page=1;
        }
        $next_page=$page;
        $start_point=round($page * $limit - $limit);
        if($recordsFiltered>($start_point+$limit)){
            $next_page=$page+1;
        }
        $model->orderBy('id DESC');
        $response=$model->findAll($limit,$start_point);
        
        $info=lang("msg.info");
        $info=str_replace("_START_",$page,$info);
        $info=str_replace("_END_",$totalPages,$info);
        $info=str_replace("_TOTAL_",$recordsTotal,$info);
        $data["info_pagination"]=$info;
        $data["previous_page"]=$previous_page;
        $data["next_page"]=$next_page;

        $data["actions"]["report"]=1;
        $data["actions"]["status_zip_key"]=1;        
        $data["actions"]["code"]=1;
        $data["data"]=$response;
        $data["recordsTotal"]=$recordsTotal;
        
        echo view($this->views_path_module.'\documents\individual_documents_list',$data);
    }
    
    
    
    
}//Fin clase