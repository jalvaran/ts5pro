<?php

namespace App\Modules\Access\Controllers;

use App\Libraries\Session;
use App\Controllers\BaseController;
use App\Modules\TS5\Libraries\DataTable;
use CodeIgniter\API\ResponseTrait;

class Companies extends BaseController
{
    use ResponseTrait;
    private $session;

    function __construct()
    {

        $this->session = new Session();
    }

    function index() {

        if (!$this->session->get_LoggedIn()) {
            return (redirect()->to(base_url('/ts5/signin')));
        } else {
            return (redirect()->to(base_url('/menu')));
        }

    }

    function list($company_id) {

        return(view('App\Modules\Access\Views\Companies\List\index',array("company_id"=>$company_id)));
    }

    function jsonCompanies() {
        $dataTable = new DataTable();
        $modelClass='App\Modules\Access\Models\Companies';
        $helper='App\Modules\Access\Helpers\formatter';
        $i=0;
        $field_dataTable[$i]["field"]='id';
        $field_dataTable[$i]["formatter"]='action_links';
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
    function create() {
        return("create ");
    }
    function edit($id) {
        return("edit {$id}");
    }
    function delete($id) {
        return("delete {$id}");
    }




}