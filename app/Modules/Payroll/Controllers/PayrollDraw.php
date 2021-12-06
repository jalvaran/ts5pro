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
 * Este archivo contiene el controlador dibujante del módulo de nomina
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

class PayrollDraw extends BaseController
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
     * Muestra la pagina de inicio del administrador de nomina
     * @param $company_id
     * @return \CodeIgniter\HTTP\RedirectResponse|void
     */
    function home($company_id) {
            
        
        if (!$this->session->get_LoggedIn()) {
            return (redirect()->to(base_url('/ts5/signin')));
        }

        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $permission_id='6192e1a6cbe88942267234';  //ver el home del admin
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

        $home_js=view($this->views_path_module.'\admin\home_js',$data);
        //$forms_js=view($this->views_path_module.'\forms\forms_js',$data);
        
        $data["data_template"]["my_js"]=$home_js;
        $data["view_path"]=$this->views_path;
        $data["view_path_module"]=$this->views_path_module;
        $data["page_title"]=lang('payroll.admin_title');
        $data["module_name"]=lang('payroll.module_name');

        $html=view($this->views_path_module.'\admin\home',$data);
        

        $data["page_content"]=$html;
        echo view($this->views_path."\blank",$data);

    }
    /**
     * Dibuja el listado de los empleados
     * @return type
     */
    public function employees_draw() {
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id=$this->module_id;                        //nomina
        
        $permission_id="61952771828e5759928930";
        
          
        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            return (view($this->views_path."\alert_error",$data_error));

        }

        $i=0;
        $limit=20;

        $data["cols"][$i++]=lang("fields.actions");
        $data["cols"][$i++]=lang("fields.id");
        $data["cols"][$i++]=lang("fields.name");
        $data["cols"][$i++]=lang("fields.type_document_identification_name");
        $data["cols"][$i++]=lang("fields.identification");
        $data["cols"][$i++]=lang("fields.municipalities_name");
        $data["cols"][$i++]=lang("fields.departments_name");
        $data["cols"][$i++]=lang("fields.address");
        $data["cols"][$i++]=lang("fields.telephone1");
        $data["cols"][$i++]=lang("fields.telephone2");
        $data["cols"][$i++]=lang("fields.mail");
        $data["cols"][$i++]=lang("fields.salary");
        $data["cols"][$i++]=lang("fields.employees_position_name");
        $data["cols"][$i++]=lang("fields.type_contract_name");
        $data["cols"][$i++]=lang("fields.eps_name");
        $data["cols"][$i++]=lang("fields.afp_name");
        $data["cols"][$i++]=lang("fields.arl_name");
        $data["cols"][$i++]=lang("fields.arl_level_name");
        $data["cols"][$i++]=lang("fields.arl_level_percent");
        $data["cols"][$i++]=lang("fields.ccf_name");
        $data["cols"][$i++]=lang("fields.period_name");
        $data["cols"][$i++]=lang("fields.bank");
        $data["cols"][$i++]=lang("fields.account_type");
        $data["cols"][$i++]=lang("fields.account_number");
        $data["cols"][$i++]=lang("fields.reasons_withdrawal_name");
        $data["cols"][$i++]=lang("fields.author_name");
        $data["cols"][$i++]=lang("fields.created_at");
        $data["cols"][$i++]=lang("fields.updated_at");
        
        
        
        $page=$request->getVar('page');
        $search=$request->getVar('search');
        $fields=array(  'id',
                        'name',
                        'type_document_identification_name',
                        'identification',                      
                        
                        'municipalities_name',
                        'departments_name',
                        'address',
                        'telephone1',
                        'telephone2',
                        'mail',
                        'salary',
                        'employees_position_name',
                        'type_contract_name',
                        'eps_name',
                        'afp_name',
                        'arl_name',
                        'arl_level_name',
                        'arl_level_percent',
                        'ccf_name',
                        'period_name',
                        'bank',
                        'account_type',
                        'account_number',
                        'reasons_withdrawal_name',
                        'author_name',
                        
                        'created_at',
                        'updated_at',
                        
            
            );
        
        $model=model('App\Modules\Payroll\Models\EmployeesView');
                       
        $model->select($fields);
        
        $recordsTotal = $model->countAllResults(false);
        
                
        if($search<>''){
            $condition=" (identification='$search' or name like '%$search%') ";
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
        
        $data["data"]=$response;
        $data["recordsTotal"]=$recordsTotal;
        echo view($this->views_path_module.'\admin\employees_list',$data);
    }
    
    /**
     * Formulario para crear o editar un empleado
     * @return type
     */
    public function form_employee() {
        
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id=$this->module_id;                        //inverpacific
        $id=$request->getVar('id');
        
        if($id==''){  //Formulario de Creación
            $permission_id="619530962d29c295237319";
            
            if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
                $data_error["error_title"]=lang('Access.access_view_error_title');
                $data_error["msg_error"]=lang('Access.access_view_error');
                return (view($this->views_path."\alert_error",$data_error));

            }
            $ts5=new Ts5_class();
            $data["id"]=$ts5->getUniqueId("bs_", true);
            
        }else{
            $model=model('App\Modules\Payroll\Models\EmployeesView');
            $permission_id='619530f6b9bd1092454025';           //Permiso para Editar singular Ver en tabla access_control_permissions
            $permission_id_all='619531174776b267392167';       //Permiso para Editar plural Ver en tabla access_control_permissions

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
        
        
        
        return view($this->views_path_module.'\admin\forms\employee_form',$data);
    }
        
}