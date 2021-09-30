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
 * Este archivo contiene el controlador para el modulo de creditos de motos
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-09-18
 * @updated 2021-09-18
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */
namespace App\Modules\Inverpacific\Controllers;

use App\Modules\TS5\Libraries\Session;
use App\Controllers\BaseController;
use App\Modules\TS5\Libraries\Ts5_class;

class InverPacificDraw extends BaseController
{

    private $session;
    private $views_path;
    private $views_path_module;
    private $module_id;

    function __construct()
    {
        $this->views_path='App\Modules\TS5\Views\templates\synadmin';
        $this->views_path_module='App\Modules\Inverpacific\Views';
        $this->session = new Session();
        $this->module_id="613784ab2471f217811481";

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
     * Muestra la página de administración de los créditos para motos
     * @param $company_id
     * @return \CodeIgniter\HTTP\RedirectResponse|void
     */
    function list($company_id) {
            
        
        if (!$this->session->get_LoggedIn()) {
            return (redirect()->to(base_url('/ts5/signin')));
        }

        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $permission_id='613a3cb44d1c9444282576';  //listar roles
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

        $list_js=view($this->views_path_module.'\list\list_js',$data);
        $forms_js=view($this->views_path_module.'\forms\forms_js',$data);
        
        $data["data_template"]["my_js"]=$list_js.$forms_js;
        $data["view_path"]=$this->views_path;
        $data["view_path_module"]=$this->views_path_module;
        $data["page_title"]=lang('creditmoto.creditmoto_title');
        $data["module_name"]=lang('creditmoto.creditmoto');

        $html=view($this->views_path_module.'\list\index',$data);


        $data["page_content"]=$html;
        echo view($this->views_path."\blank",$data);

    }
    /**
     * Dibuja las hojas de negocio segun el listado seleccionado
     * @return type
     */
    function business_sheet_draw(){
        
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id=$this->module_id;                        //inverpacific
        $list_id=$request->getVar('list_id');
        $permission_id="";
        switch ($list_id) {
            case "A": //Listar el historial de las hojas de negocio
                $permission_id='6149022bf2bff062214145'; 
            break;
            case 1: //Listar el historial de las hojas de negocio en estado solicitada
                $permission_id='61494b3150ea6632631526'; 
            break;
            case 2: //Listar el historial de las hojas de negocio en estado de analisis
                $permission_id='61495079796f2594150933'; 
            break;
            case 3: //Listar el historial de las hojas de negocio en estado pre aprobado
                $permission_id='61494bc55c2e3827172881'; 
            break;
            case 4: //Listar el historial de las hojas de negocio en estado pre aprobado negado
                $permission_id='61494c45d60d3090342990'; 
            break;
            case 5: //Listar el historial de las hojas de negocio en estado APROBADO
                $permission_id='61494ca3c94e1534968211'; 
            break;
            case 6: //Listar el historial de las hojas de negocio en estado facturado
                $permission_id='61494d51dc110940219084'; 
            break;
            case 7: //Listar el historial de las hojas de negocio en estado documentos generados
                $permission_id='61494da5de2c8189330103'; 
            break;
            case 8: //Listar el historial de las hojas de negocio en estado documentos firmados
                $permission_id='61494e5303d43932249969'; 
            break;
            case 9: //Listar el historial de las hojas de negocio en estado a la espera de documentos oficiales
                $permission_id='6149523eb5fe5302607425'; 
            break;
            case 10: //Listar el historial de las hojas de negocio en estado para entrega
                $permission_id='6149536021af6056488420'; 
            break;
            case 11: //Listar el historial de las hojas de negocio en estado entregado
                $permission_id='614953c4736a5433999033'; 
            break;
            case 12: //Listar el historial de las hojas de negocio en estado archivado por comercial
                $permission_id='61495412c072e613111003'; 
            break;
           
           
        }
                
        
        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            return (view($this->views_path."\alert_error",$data_error));

        }

        $i=0;
        $limit=20;

        $data["cols"][$i++]=lang("fields.actions");
        $data["cols"][$i++]=lang("fields.id");
        $data["cols"][$i++]=lang("fields.consecutive");
        $data["cols"][$i++]=lang("fields.created_at");
        $data["cols"][$i++]=lang("fields.third_name");
        $data["cols"][$i++]=lang("fields.third_identification");
        $data["cols"][$i++]=lang("fields.motorcycle");
        $data["cols"][$i++]=lang("fields.color");
        $data["cols"][$i++]=lang("fields.maker");        
        $data["cols"][$i++]=lang("fields.status_name");
        $data["cols"][$i++]=lang("fields.total_to_pay");
        $data["cols"][$i++]=lang("fields.term");
        $data["cols"][$i++]=lang("fields.fee_value_monthly");
        $data["cols"][$i++]=lang("fields.observations");
        $data["cols"][$i++]=lang("fields.author_name");
        
        $page=$request->getVar('page');
        $search=$request->getVar('search');
        $fields=array(  'id',
                        'consecutive',
                        'created_at',
                        'third_name',
                        'third_identification',
                        'motorcycle',
                        'color',
                        'maker',
                        'status_name',
                        'total_to_pay',
                        'term',
                        'fee_value_monthly',
                        'observations',
                        'author_name',    
                        
            
            );
        
        $model=model('App\Modules\Inverpacific\Models\BusinessSheetsView');
                
        $model->select($fields);
                
        //$model->where('author',$user_id);   //Por si se quiere que solo se vean los negocios del mismo usuario
        $recordsTotal = $model->countAllResults(false);
        
        $z=0;
       
        if($search<>''){
            foreach ($fields as $field){

                if($z==0){
                    $z=1;
                    $model->like($field, $search);
                }else{
                    $model->orLike($field, $search);
                }

            }
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
        $model->orderBy('consecutive DESC');
        $response=$model->findAll($limit,$start_point);
        
        //print($model->getCompiledSelect());
        //print_r($response);
        $info=lang("msg.info");
        $info=str_replace("_START_",$page,$info);
        $info=str_replace("_END_",$totalPages,$info);
        $info=str_replace("_TOTAL_",$recordsTotal,$info);
        $data["info_pagination"]=$info;
        $data["previous_page"]=$previous_page;
        $data["next_page"]=$next_page;

        $data["actions"]["edit"]=1;
        $data["data"]=$response;
        echo view($this->views_path_module.'\list\table_list',$data);
    }
    
    
    /**
     * Formulario para una hoja de negocio
     * @return type
     */
    public function form_business_sheet() {
        
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id=$this->module_id;                        //inverpacific
        $id=$request->getVar('id');
        
        if($id==''){  //Formulario de Creación
            $permission_id="61548efe7ee2c964405841";
            
            if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
                $data_error["error_title"]=lang('Access.access_view_error_title');
                $data_error["msg_error"]=lang('Access.access_view_error');
                return (view($this->views_path."\alert_error",$data_error));

            }
            $ts5=new Ts5_class();
            $data["id"]=$ts5->getUniqueId("bs_", true);
            
        }else{
            $model=model('App\Modules\Inverpacific\Models\BusinessSheetsView');
            $permission_id='6156159284c77599840464';           //Permiso para Editar singular Ver en tabla access_control_permissions
            $permission_id_all='615615ad6efa6294907733';       //Permiso para Editar plural Ver en tabla access_control_permissions

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
        
        
        
        return view($this->views_path_module.'\forms\business_sheet',$data);
    }
    
    /**
     * Dibuja el listado de los elementos o items adicionales para agregar en una hoja de trabajo 
     * @return type
     */
    public function business_sheet_severals_list() {
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $permission_id='6149022bf2bff062214145';  //listar el historial de hojas de negocio
        $module_id=$this->module_id;      //inverpacific

        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            return (view($this->views_path."\alert_error",$data_error));

        }
        $request = service('request');
        $id=$request->getVar('id');
        $model=model('App\Modules\Inverpacific\Models\BusinessSheetSeverals');
        $data_model["data_severals"]=$model->get_List();
        $data_model["business_sheet_id"]=$id;
        return(view($this->views_path_module.'\list\business_sheet_severals',$data_model));
    }
    
    /**
     * Dibuja el listado de los elementos o items adicionales agregados en una hoja de trabajo 
     * @return type
     */
    public function business_sheet_severals_list_added() {
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $permission_id='6149022bf2bff062214145';  //listar el historial de hojas de negocio
        $module_id=$this->module_id;      //inverpacific

        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            return (view($this->views_path."\alert_error",$data_error));

        }
        $request = service('request');
        $business_sheet_id=$request->getVar('business_sheet_id');
        $model=model('App\Modules\Inverpacific\Models\BusinessSheetSeveralsAdds');
        $condition="business_sheet_id='{$business_sheet_id}'";
        $data_model["data_severals"]=$model->get_List($condition);
        $data_model["business_sheet_id"]=$business_sheet_id;
        return(view($this->views_path_module.'\list\business_sheet_severals_added',$data_model));
    }
    

}