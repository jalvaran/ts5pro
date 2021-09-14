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
 * Este archivo contiene el controlador para el modulo de creación de empresas
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-08-26
 * @updated 2021-08-26
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */
namespace App\Modules\Admin\Controllers;

use App\Libraries\Session;
use App\Controllers\BaseController;
use App\Modules\TS5\Libraries\Ts5_class;

class AdminController extends BaseController
{

    private $session;
    private $views_path;
    private $views_path_module;
    private $module_id;

    function __construct()
    {
        $this->views_path='App\Modules\TS5\Views\templates\synadmin';
        $this->views_path_module='App\Modules\Admin\Views';
        $this->session = new Session();
        $this->module_id="613784ab2471f217811480";

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
     * Muestra el listado de los roles asignados a los modulos de una empresa
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

        $data=$ts5->getDataTemplate($this->session);
        $data["data_template"]=$ts5->getDataTemplate($this->session);

        $admin_js=view($this->views_path_module.'\Admin\admin_js',$data);

        $data["data_template"]["my_js"]=$admin_js;
        $data["view_path"]=$this->views_path;
        $data["view_path_module"]=$this->views_path_module;
        $data["page_title"]=lang('admin.admin_title');
        $data["module_name"]=lang('admin.admin');

        $html=view($this->views_path_module.'\Admin\index',$data);


        $data["page_content"]=$html;
        echo view($this->views_path."\blank",$data);



    }

    /**
     * Lista los roles que tiene creados una empresa
     * @return string|void
     */
    function roles_list(){

        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $permission_id='613a3cb44d1c9444282576';  //listar roles
        $module_id=$this->module_id;      //Admin

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

        $request=service('request');
        $page=$request->getVar('page');
        $search=$request->getVar('search');
        $fields=array('id','name');
        $model=model('App\Modules\Access\Models\Roles');
        $model->select($fields);
        $model->where('app_company_id',$company_id);
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

        $info=lang("msg.info");
        $info=str_replace("_START_",$page,$info);
        $info=str_replace("_END_",$totalPages,$info);
        $info=str_replace("_TOTAL_",$recordsTotal,$info);
        $data["info_pagination"]=$info;
        $data["previous_page"]=$previous_page;
        $data["next_page"]=$next_page;

        $data["actions"]["edit"]=1;
        $data["data"]=$response;
        echo view($this->views_path.'\table_list',$data);
    }

    /**
     * Formulario para crear o editar un role
     * @return string
     */
    function frm_create_role(){

        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');

        $request=service('request');
        $id=$request->getVar('id');
        $module_id=$this->module_id;
        $data=[];
        if($id==''){ //Crear
            $permission_id='613a570cd6fb0614772306';  //Crear un role
            if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
                $data_error["error_title"]=lang('Access.access_view_error_title');
                $data_error["msg_error"]=lang('Access.access_view_error');
                return (view($this->views_path."\alert_error",$data_error));
            }
        }else{       //Editar

            $mRoles=model('App\Modules\Access\Models\Roles');

            $permission_id='613a5731c2f9b333888639';           //Permiso singular para editar la configuración de una empresa
            $permission_id_all='613ace0468c5e548652327';       //Permiso plural para editar la configuración de una empresa

            $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
            $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
            $authority=$mRoles->get_Authority($id,$user_id);

            if(!$p_all and !($p_single and $authority)){
                $data_error["error_title"]=lang('Access.access_view_error_title');
                $data_error["msg_error"]=lang('Access.access_view_error');
                return (view($this->views_path."\alert_error",$data_error));
            }
            $data_model=$mRoles->where('id',$id)->first();
            $data["data_form"]=$data_model;

        }

        return(view($this->views_path_module.'\Admin\frm_role',$data));
    }

    /**
     * Formulario para crear o editar un usuario
     * @return string
     */
    function frm_create_user(){

        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');

        $request=service('request');
        $id=$request->getVar('id');
        $module_id=$this->module_id;
        $data=[];
        if($id==''){ //Crear
            $permission_id='613ada507e730607668359';  //Crear un usuario desde admin
            if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
                $data_error["error_title"]=lang('Access.access_view_error_title');
                $data_error["msg_error"]=lang('Access.access_view_error');
                return (view($this->views_path."\alert_error",$data_error));
            }
        }else{       //Editar


            $permission_id='613ada7fad7e7386240937';           //Permiso singular para editar la configuración de una empresa
            $permission_id_all='613ada93f23b4753305035';       //Permiso plural para editar la configuración de una empresa

            $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
            $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
            $authority=$mUsers->get_Authority($id,$user_id);

            if(!$p_all and !($p_single and $authority)){
                $data_error["error_title"]=lang('Access.access_view_error_title');
                $data_error["msg_error"]=lang('Access.access_view_error');
                return (view($this->views_path."\alert_error",$data_error));
            }
            $data_model=$mUsers->where('id',$id)->first();
            $data["data_form"]=$data_model;

        }

        return(view($this->views_path_module.'\Admin\frm_user',$data));
    }

    /**
     * lista los usuarios asignados a la empresa activa
     * @return string|void
     */
    function users_list(){
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $permission_id='613adb311ef3a661853259';  //listar usuarios
        $module_id=$this->module_id;      //Admin

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
        $data["cols"][$i++]=lang("fields.identification");
        $data["cols"][$i++]=lang("fields.telephone");
        $data["cols"][$i++]=lang("fields.email");
        $data["cols"][$i++]=lang("fields.username");
        $data["cols"][$i++]=lang("fields.designation");


        $request=service('request');
        $page=$request->getVar('page');
        $search=$request->getVar('search');
        $fields=['access_control_users.id',
                'access_control_users.name',
                'access_control_users.identification',
                'access_control_users.telephone',
                'access_control_users.email',
                'access_control_users.username',
                'access_control_users.designation',
        ];
        $model=model('App\Modules\Access\Models\UsersCompanies');
        $model->select($fields);
        $model->join('access_control_users', 'access_control_users.id=access_control_user_id' )

            ->where("app_company", $company_id);

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

        $info=lang("msg.info");
        $info=str_replace("_START_",$page,$info);
        $info=str_replace("_END_",$totalPages,$info);
        $info=str_replace("_TOTAL_",$recordsTotal,$info);
        $data["info_pagination"]=$info;
        $data["previous_page"]=$previous_page;
        $data["next_page"]=$next_page;

        $data["actions"]["edit"]=1;
        $data["data"]=$response;
        echo view($this->views_path.'\table_list',$data);
    }
    /**
     * Abre la vista para ver los permisos que tiene un role, ademas de poder agregarlos
     * @return type
     */
    public function role_view(){
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $permission_id='613a3cb44d1c9444282576';  //listar roles
        $module_id=$this->module_id;      //Admin

        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            return (view($this->views_path."\alert_error",$data_error));

        }
        $request = service('request');

        $id=$request->getVar('id');
        $mRole=model('App\Modules\Access\Models\Roles');
        $data=$mRole->getDataRole($id);
        //return("role");
        return(view($this->views_path_module.'\Admin\role_view',$data));
    }
    /**
     * Lista los permisos que tiene un role
     * @return type
     */
    public function roles_permissions_list(){
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $permission_id='613a3cb44d1c9444282576';  //listar roles
        $module_id=$this->module_id;      //Admin

        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            return (view($this->views_path."\alert_error",$data_error));

        }
        $request = service('request');
        $id=$request->getVar('id');
        $model=model('App\Modules\Access\Models\PoliticiesModel');
        $data_model["data_permissions"]=$model->get_ListPermissionsRole($id);
        return(view($this->views_path_module.'\Admin\role_permissions_list',$data_model));

    }
    /**
     * muestra la informacion de un usuario y los roles que tiene asignados
     * @return type
     */
    public function user_view(){
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $permission_id='613a3cb44d1c9444282576';  //listar roles
        $module_id=$this->module_id;      //Admin

        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            return (view($this->views_path."\alert_error",$data_error));

        }
        $request = service('request');

        $id=$request->getVar('id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $data=$mUsers->getDataUser($id);
        
        return(view($this->views_path_module.'\Admin\user_view',$data));
    }
    
    public function user_roles_list(){
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $permission_id='613adb311ef3a661853259';  //listar usuarios
        $module_id=$this->module_id;      //Admin

        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            return (view($this->views_path."\alert_error",$data_error));

        }
        $request = service('request');
        $id=$request->getVar('id');
        $model=model('App\Modules\Access\Models\Herarchies');
        $data_model["data_roles"]=$model->getRolesInUser($id,$company_id);
        
        return(view($this->views_path_module.'\Admin\user_roles_list',$data_model));

    }


}