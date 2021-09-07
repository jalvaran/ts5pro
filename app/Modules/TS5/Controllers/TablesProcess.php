<?php

namespace App\Modules\TS5\Controllers;

use App\Libraries\Session;
use App\Controllers\BaseController;
use App\Modules\TS5\Libraries\DataTable;
use CodeIgniter\API\ResponseTrait;

class TablesProcess extends BaseController
{
    use ResponseTrait;
    private $session;

    function __construct()
    {

        $this->session = new Session();
    }

    /**
     * retorna el json para el datatable de los usuarios
     * @return mixed
     */
    function tables_json($data_table)
    {
        $user_id=$this->session->get('user');
        $company_id=$this->session->get('company_id');
        $array_data_table=json_decode(base64_decode(urldecode($data_table)),true);
        $model=$array_data_table["model"];

        $mUsers=model('App\Modules\Access\Models\Users');

        $p_single=$mUsers->has_Permission($user_id,$array_data_table["permissions"]["list"],$company_id,$array_data_table["module_id"]);

        if(!$p_single){
            $data["error_title"]=lang('Access.access_view_error_title');
            $data["msg_error"]=lang('Access.access_view_error');
            return(view($this->views_path."\alert_error",$data));
        }


        $dataTable=new DataTable();
        $data["data_table"]=$data_table;
        $response=$dataTable->getDataTable($model,$data);
        return $this->setResponseFormat('json')->respond($response);
    }


}