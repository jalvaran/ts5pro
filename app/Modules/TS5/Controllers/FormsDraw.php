<?php

namespace App\Modules\TS5\Controllers;

use App\Modules\TS5\Libraries\Session;
use App\Controllers\BaseController;
use App\Modules\TS5\Libraries\Ts5_class;

class FormsDraw extends BaseController
{
    private $session;
    private $views_path;
    private $views_path_module;

    function __construct()
    {
        $this->views_path='App\Modules\TS5\Views\templates\synadmin';
        $this->views_path_module='App\Modules\TS5\Views';
        $this->session = new Session();
    }


    public function index()
    {
        if (!$this->session->get_LoggedIn()) {
            return (redirect()->to(base_url('/ts5/signin')));
        } else {
            return (redirect()->to(base_url('/menu')));
        }
    }

    public function frm_thirds()
    {
        
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        
        $request=service('request');
        $id=$request->getVar('id');
        $module_id='613784ab2471f217811472';
        $data=[];
        
        if($id==''){ //Crear
            $permission_id='614a8dcecfb92004869650';  //Crear un tercero
            if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
                $data_error["error_title"]=lang('Access.access_view_error_title');
                $data_error["msg_error"]=lang('Access.access_view_error');
                return (view($this->views_path."\alert_error",$data_error));
            }
        }else{       //Editar

            $mThirds=model('App\Modules\TS5\Models\ViewThirds');

            $permission_id='614a8f02ca149481212955';           //Permiso singular para editar la configuración de una empresa
            $permission_id_all='614a8f1d7e7c2698916521';       //Permiso plural para editar la configuración de una empresa

            $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
            $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
            $authority=$mThirds->get_Authority($id,$user_id);

            if(!$p_all and !($p_single and $authority)){
                $data_error["error_title"]=lang('Access.access_view_error_title');
                $data_error["msg_error"]=lang('Access.access_view_error');
                return (view($this->views_path."\alert_error",$data_error));
            }
            
            $data_model=$mThirds->where('id',$id)->first();
            $data["data_form"]=$data_model;
                       
            

        }
        
        return(view($this->views_path_module.'\Forms\frm_third',$data));
    }

    


}