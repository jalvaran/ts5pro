<?php

namespace App\Modules\TS5\Controllers;

use App\Controllers\BaseController;
use App\Modules\TS5\Libraries\Session;
use App\Modules\TS5\Libraries\Ts5_class;

class DatatableController extends BaseController
{
    private $session;
    private $namespace;
    private $ts5;
    private $data_template;

    function __construct()
    {
        $this->session = new Session();
        $this->ts5 = new Ts5_class();
        $this->data_template = $this->ts5->getDataTemplate($this->session);
        $this->namespace = 'App\Modules\TS5';

    }

    // Show users list

    public function index(){
        $model_path='App\Modules\Access\Models\Companies';
        $model = model($model_path);
        $data['fields']=$model->allowedFields;
        $data['data_model'] = $model->select($data['fields'])->orderBy('id', 'DESC')->findAll();
        $data['table_id']="table_companies";
        $html= view('App\Modules\TS5\Views\templates\synadmin\data_table2', $data);

        $model_path='App\Modules\Access\Models\Users';
        $model = model($model_path);
        $data['fields']=$model->allowedFields;
        $data['data_model'] = $model->select($data['fields'])->orderBy('id', 'DESC')->findAll();
        $data['table_id']="users_companies";
        $html.= view('App\Modules\TS5\Views\templates\synadmin\data_table2', $data);
        return($html);
    }



}