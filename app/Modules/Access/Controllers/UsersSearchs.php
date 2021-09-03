<?php

namespace App\Modules\Access\Controllers;

use App\Libraries\Session;
use App\Controllers\BaseController;
use App\Modules\TS5\Libraries\DataTable;
use CodeIgniter\API\ResponseTrait;

class UsersSearchs extends BaseController
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
    function jsonUsers($model_base64)
    {

        $modelClass=base64_decode(urldecode($model_base64));
        $dataTable=new DataTable();
        $response=$dataTable->getDataTable($modelClass);
        return $this->setResponseFormat('json')->respond($response);
    }


}