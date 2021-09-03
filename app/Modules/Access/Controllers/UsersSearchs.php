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
    function jsonUsers() {
        $dataTable = new DataTable();
        $modelClass='App\Modules\Access\Models\Users';
        $helper='App\Modules\Access\Helpers\actions_users';
        $i=0;
        $field_dataTable[$i]["field"]='id';
        $field_dataTable[$i]["action_links"]='action_links';

        $field_dataTable[++$i]["field"]='name';
        $field_dataTable[++$i]["field"]='identification';
        $field_dataTable[++$i]["field"]='telephone';
        $field_dataTable[++$i]["field"]='email';
        $field_dataTable[++$i]["field"]='designation';
        $field_dataTable[++$i]["field"]='username';
        $field_dataTable[++$i]["field"]='enabled';

        $response = $dataTable->process($helper,$modelClass, $field_dataTable);

        return $this->setResponseFormat('json')->respond($response);

    }


}