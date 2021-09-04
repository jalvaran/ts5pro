<?php

namespace App\Modules\TS5\Controllers;

use App\Libraries\Session;
use App\Controllers\BaseController;
use App\Modules\TS5\Libraries\Ts5_class;

class TablesDraw extends BaseController
{
    private $session;
    private $views_path;
    private $views_path_module;

    function __construct()
    {
        $this->views_path='App\Modules\TS5\Views\templates\synadmin';
        $this->views_path_module='App\Modules\Access\Views\Users';
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

    public function tables_draw($model_base64,$table_id,$permissions,$module_id)
    {
        $user_id=$this->session->get('user');
        $company_id=$this->session->get('company_id');
        $array_permissions=json_decode($permissions,true);

        $mUsers=model('App\Modules\Access\Models\Users');

        $p_single=$mUsers->has_Permission($user_id,$array_permissions["list"],$company_id,$module_id);

        if(!$p_single){
            $data["error_title"]=lang('Access.access_view_error_title');
            $data["msg_error"]=lang('Access.access_view_error');
            return(view($this->views_path."\alert_error",$data));
        }
        $model_path=base64_decode(urldecode($model_base64));
        $model = model($model_path);
        $data['fields']=$model->allowedFields;
        $data['data_model'] ='';
        $data['table_id']=$table_id;
        $html= view('App\Modules\TS5\Views\templates\synadmin\data_table2', $data);
        return($html);
    }



}