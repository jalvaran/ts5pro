<?php

namespace App\Modules\TS5\Controllers;

use App\Controllers\BaseController;
use App\Modules\TS5\Libraries\Session;
use App\Modules\TS5\Libraries\Ts5_class;

class TS5 extends BaseController
{
    private $session;
    private $namespace;
    private $ts5;
    private $data_template;

    function __construct()
    {
        $this->ts5 = new Ts5_class();
        $this->data_template["data_template"] = $this->ts5->getDataTemplate();
        $this->namespace = 'App\Modules\TS5';
        $this->session = new Session();
    }

    function index()
    {
        if (!$this->session->get_LoggedIn()) {
            return ($this->signin());
        } else {
            return (redirect()->to('/menu'));
        }
    }

    function signin()
    {

        $this->data_template["data_template"]["error"] = 0;
        if (isset($_REQUEST["user_username"])) {
            $request = service('request');
            $user_mail = $request->getVar('user_username', FILTER_SANITIZE_STRING);
            $pass_pass = $request->getVar('user_pass', FILTER_SANITIZE_STRING);
            if ($user_mail <> '' and $pass_pass <> '') {
                $session = new Session();

                if ($session->login($user_mail, $pass_pass)) {
                    return (redirect()->to('/menu'));
                } else {
                    $this->data_template["data_template"]["error"] = 2;
                }

            } else {
                $this->data_template["data_template"]["error"] = 1;
            }

        }

        return (view($this->namespace . '\Views\Signin\index', $this->data_template));

    }

    function signout()
    {
        session_destroy();
        echo($this->signin());
    }

}