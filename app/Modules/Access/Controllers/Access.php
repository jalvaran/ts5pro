<?php

namespace App\Modules\Access\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Session;
use App\Modules\TS5\Libraries\Ts5_class;

class Access extends BaseController
{
    private $session;
    private $namespace;
    private $ts5;
    private $data_template;

    function __construct()
    {
        $this->ts5 = new Ts5_class();
        $this->data_template = $this->ts5->getDataTemplate();
        $this->namespace = 'App\Modules\Access';
        $this->session = new Session();
    }

    function index()
    {
        if (!$this->session->get_LoggedIn()) {
            return ($this->signin());
        } else {
            return (redirect()->to(base_url('/menu')));
        }
    }


}