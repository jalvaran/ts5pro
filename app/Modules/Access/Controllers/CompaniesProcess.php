<?php

namespace App\Modules\Access\Controllers;

use App\Libraries\Session;
use App\Controllers\BaseController;
use App\Modules\TS5\Libraries\DataTable;
use CodeIgniter\API\ResponseTrait;

class CompaniesProcess extends BaseController
{
    use ResponseTrait;
    private $session;

    function __construct()
    {

        $this->session = new Session();
    }

    function jsonCompanies() {
        $dataTable = new DataTable();
        $modelClass='App\Modules\Access\Models\Companies';
        $helper='App\Modules\Access\Helpers\actions_tables';
        $i=0;
        $field_dataTable[$i]["field"]='id';
        $field_dataTable[$i]["action_links"]='action_links_companies';
        $field_dataTable[++$i]["field"]='name';
        $field_dataTable[++$i]["field"]='description';
        $field_dataTable[++$i]["field"]='identification';
        $field_dataTable[++$i]["field"]='dv';
        $field_dataTable[++$i]["field"]='mail';
        $field_dataTable[++$i]["field"]='address';
        $field_dataTable[++$i]["field"]='phone';

        $response = $dataTable->process($helper,$modelClass, $field_dataTable);

        return $this->setResponseFormat('json')->respond($response);

    }


}