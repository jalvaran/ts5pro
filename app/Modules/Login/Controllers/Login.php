<?php
/*
 *--------------------------------------------------------------------------
 *╔╦╗╔═╗╔═╗╦ ╦╔╗╔╔═╗
 * ║ ║╣ ║  ╠═╣║║║║ ║
 * ╩ ╚═╝╚═╝╩ ╩╝╚╝╚═╝
 *--------------------------------------------------------------------------
 * Copyright 2021 - Techno Soluciones S.A.S., Inc. <info@technosoluciones.com.co>
 * Este archivo es parte de TS5 Pro V 1.0
 * Para obtener información completa sobre derechos de autor y licencia, consulte
 * la LICENCIA archivo que se distribuyó con este código fuente.
 * -----------------------------------------------------------------------------
 * EL SOFTWARE SE PROPORCIONA -TAL CUAL-, SIN GARANTÍA DE NINGÚN TIPO, EXPRESA O
 * IMPLÍCITA, INCLUYENDO PERO NO LIMITADO A LAS GARANTÍAS DE COMERCIABILIDAD,
 * APTITUD PARA UN PROPÓSITO PARTICULAR Y NO INFRACCIÓN. EN NINGÚN CASO SERÁ
 * LOS AUTORES O TITULARES DE LOS DERECHOS DE AUTOR SERÁN RESPONSABLES DE CUALQUIER RECLAMO, DAÑOS U OTROS
 * RESPONSABILIDAD, YA SEA EN UNA ACCIÓN DE CONTRATO, AGRAVIO O DE OTRO MODO, QUE SURJA
 * DESDE, FUERA O EN RELACIÓN CON EL SOFTWARE O EL USO U OTROS
 * NEGOCIACIONES EN EL SOFTWARE.
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvaran Valencia <jalvaran@gmail.com>
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

namespace App\Modules\Login\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Session;

class Login extends BaseController
{

    function __construct(){
        //Libraries
        //Models
        //Helpers
        //Views
        //Languages
        helper('App\Modules\TS5\Helpers\TS5');
    }

    /**
     * Index de la pagina
     */
    public function index()
    {
        $ts5=TS5();
        $data=$ts5->getDataTemplate();
        $data["page"] = "index";
        $data["message_error"] = 0;
        return (view('App\Modules\Login\Views\index', $data));
    }

    public function validate_pass()
    {
        $data["lang"] = "es";
        $data["page"] = "error";
        $data["favicon"] = "/companies_logos/1/favicon.png";
        $data["company_logo"] = "/companies_logos/1/header-logo.png";

        $request = service('request');
        $user_mail = $request->getVar('user_email', FILTER_SANITIZE_STRING);
        $pass_pass = $request->getVar('user_pass', FILTER_SANITIZE_STRING);
        if ($user_mail <> '' and $pass_pass <> '') {
            $user = new Users();
            $data_user = $user->get_UserLogin($user_mail, ($pass_pass));
            if (isset($data_user[0]["id"])) {
                @session_start();
                $_SESSION['user'] = $data_user[0]["id"];

                echo("usuario inicia sesion");
            } else {
                $data["error_title"] = lang('Login.error_title');
                $data["msg_error"] = lang('Login.error_msg_password');
                return (view('App\Modules\Login\Views\index', $data));
            }

        } else {

            $data["error_title"] = lang('Login.error_title');
            $data["msg_error"] = lang('Login.error_msg_field_empty');
            return (view('App\Modules\Login\Views\index', $data));
        }

    }
    public function logout()
    {
        session_destroy();
    }
}
