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
        $this->session = new Session();
        $this->ts5 = new Ts5_class();
        $this->data_template = $this->ts5->getDataTemplate($this->session);
        $this->namespace = 'App\Modules\TS5';

    }

    function index()
    {
        if (!$this->session->get_LoggedIn()) {
            return ($this->signin());
        } else {
            return (redirect()->to(base_url('/menu')));
        }
    }

    function signin()
    {

        $this->data_template["html_errors"]="";
        if (isset($_REQUEST["user_username"])) {
            $request = service('request');
            $user_mail = $request->getVar('user_username', FILTER_SANITIZE_STRING);
            $pass_pass = $request->getVar('user_pass', FILTER_SANITIZE_STRING);
            if ($user_mail <> '' and $pass_pass <> '') {
                $session = new Session();
                if ($session->login($user_mail, $pass_pass)) {
                    return (redirect()->to(base_url('/menu')));
                } else {
                    $data_errors["error_title"]= (lang('Login.error_title'));
                    $data_errors["msg_error"]=(lang('Login.error_msg_password'));
                    $this->data_template["html_errors"]=view($this->namespace . '\Views\templates\synadmin\alert_error',$data_errors);
                }
            } else {


                $data_errors["error_title"]= (lang('Login.error_title'));
                $data_errors["msg_error"]= (lang('Login.error_msg_field_empty'));
                $this->data_template["html_errors"]=view($this->namespace . '\Views\templates\synadmin\alert_error',$data_errors);
            }

        }
        return (view($this->namespace . '\Views\templates\synadmin\login', $this->data_template));
    }

    function signout()
    {

        $this->session->session_destroy();
        echo($this->signin());
    }

}