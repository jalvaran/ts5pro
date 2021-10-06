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

class MotorcyclesDraw extends BaseController
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
        $permission_id='615d8dc9c2ea2682694933';  //listar los lsitados de las motos
        $module_id=$this->module_id;      
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

        $list_js=view($this->views_path_module.'\list\motorcycles_list_js',$data);
        $forms_js=view($this->views_path_module.'\forms\motorcycles_forms_js',$data);
        
        $data["data_template"]["my_js"]=$list_js.$forms_js;
        $data["view_path"]=$this->views_path;
        $data["view_path_module"]=$this->views_path_module;
        $data["page_title"]=lang('creditmoto.creditmoto_title');
        $data["module_name"]=lang('creditmoto.motorcycles_list');

        $html=view($this->views_path_module.'\list\motorcycles_index',$data);


        $data["page_content"]=$html;
        echo view($this->views_path."\blank",$data);

    }
    /**
     * Dibuja dibuja el listado de marcas
     * @return type
     */
    function trademarks_draw(){
        
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id=$this->module_id;                        //inverpacific
        
        $permission_id="615daa1f2e56d644771587";
        
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
        $data["cols"][$i++]=lang("fields.created_at");
        
        
        $page=$request->getVar('page');
        $search=$request->getVar('search');
        $fields=array(  'id',
                        'name',
                        'created_at',
                        
            );
        
        $model=model('App\Modules\Inverpacific\Models\Trademarks');
                
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
        $model->orderBy('id DESC');
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
    public function trademark_form() {
        
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id=$this->module_id;                        //inverpacific
        $id=$request->getVar('id');
        
        if($id==''){  //Formulario de Creación
            $permission_id="615dab3b09b10517033606";
            
            if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
                $data_error["error_title"]=lang('Access.access_view_error_title');
                $data_error["msg_error"]=lang('Access.access_view_error');
                return (view($this->views_path."\alert_error",$data_error));

            }
            $ts5=new Ts5_class();
            $data["id"]=$ts5->getUniqueId("", true);
            
        }else{
            $model=model('App\Modules\Inverpacific\Models\Trademarks');
            $permission_id='615dab5df34ee985076898';           //Permiso para Editar singular Ver en tabla access_control_permissions
            $permission_id_all='615dab803944e879614837';       //Permiso para Editar plural Ver en tabla access_control_permissions

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
        
        
        
        return view($this->views_path_module.'\forms\trademark_form',$data);
    }
    
   
    /**
     * Dibuja dibuja el listado de colores
     * @return type
     */
    function colors_draw(){
        
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id=$this->module_id;                        //inverpacific
        
        $permission_id="615db068cc766603660910";  //LISTA LOS COLORES
        
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
        $data["cols"][$i++]=lang("fields.created_at");
        
        
        $page=$request->getVar('page');
        $search=$request->getVar('search');
        $fields=array(  'id',
                        'name',
                        'created_at',
                        
            );
        
        $model=model('App\Modules\Inverpacific\Models\Colors');
                
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
        $model->orderBy('id DESC');
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
     * Formulario para crear un color
     * @return type
     */
    public function color_form() {
        
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id=$this->module_id;                        //inverpacific
        $id=$request->getVar('id');
        
        if($id==''){  //Formulario de Creación
            $permission_id="615db07a3f68b738893281";
            
            if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
                $data_error["error_title"]=lang('Access.access_view_error_title');
                $data_error["msg_error"]=lang('Access.access_view_error');
                return (view($this->views_path."\alert_error",$data_error));

            }
            $ts5=new Ts5_class();
            $data["id"]=$ts5->getUniqueId("", true);
            
        }else{
            $model=model('App\Modules\Inverpacific\Models\Colors');
            $permission_id='615db08b32051588262617';           //Permiso para Editar singular Ver en tabla access_control_permissions
            $permission_id_all='615db09d529f2472480252';       //Permiso para Editar plural Ver en tabla access_control_permissions

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
        
        
        
        return view($this->views_path_module.'\forms\color_form',$data);
    }
    
    /**
     * Dibuja dibuja el listado de las motos
     * @return type
     */
    function motorcycles_draw(){
        
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id=$this->module_id;                        //inverpacific
        
        $permission_id="615d8dc9c2ea2682694933";  //LISTA LAS MOTOS
        
        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            return (view($this->views_path."\alert_error",$data_error));

        }

        $i=0;
        $limit=20;

        $data["cols"][$i++]=lang("fields.actions");
        $data["cols"][$i++]=lang("fields.id");
        $data["cols"][$i++]=lang("fields.trademark_name");
        $data["cols"][$i++]=lang("fields.name");
        $data["cols"][$i++]=lang("fields.value"); 
        $data["cols"][$i++]=lang("fields.tax_percent"); 
        $data["cols"][$i++]=lang("fields.created_at");
        $data["cols"][$i++]=lang("fields.author_name");
        
        
        $page=$request->getVar('page');
        $search=$request->getVar('search');
        $fields=array(  'id',
                        'trademark_name',
                        'name',
                        'value',
                        'tax_percent',
                        'created_at',
                        'author_name',
                        
            );
        
        $model=model('App\Modules\Inverpacific\Models\MotorcyclesView');
                
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
        $model->orderBy('id DESC');
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
     * Formulario para crear un color
     * @return type
     */
    public function motorcycle_form() {
        
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id=$this->module_id;                        //inverpacific
        $id=$request->getVar('id');
        
        if($id==''){  //Formulario de Creación
            $permission_id="615db462e5b5c049416492";
            
            if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
                $data_error["error_title"]=lang('Access.access_view_error_title');
                $data_error["msg_error"]=lang('Access.access_view_error');
                return (view($this->views_path."\alert_error",$data_error));

            }
            $ts5=new Ts5_class();
            $data["id"]=$ts5->getUniqueId("", true);
            
        }else{
            $model=model('App\Modules\Inverpacific\Models\MotorcyclesView');
            $permission_id='615db470a09b2589556818';           //Permiso para Editar singular Ver en tabla access_control_permissions
            $permission_id_all='615db4833969a467985118';       //Permiso para Editar plural Ver en tabla access_control_permissions

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
        
        return view($this->views_path_module.'\forms\motorcycle_form',$data);
    }
    

}