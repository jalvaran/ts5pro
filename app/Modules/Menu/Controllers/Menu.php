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

namespace App\Modules\Menu\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Session;

class Menu extends BaseController
{

    private $namespace;
    private $session;
    private $views_path;
    private $views_path_module;
    private $module_id;

    function __construct()
    {
        $this->session = new Session();
        $this->module_id = '613784ab2471f217811471';  //identifico el módulo
        $this->namespace = 'App\Modules\Menu';
        $this->views_path = 'App\Modules\TS5\Views\templates\synadmin';
        $this->views_path_module = 'App\Modules\Menu\Views';

    }

    public function index()
    {
        if(!$this->session->get_LoggedIn()) {
            return(redirect()->to(base_url('/ts5/signin')));
        }
        $data["views_path"]=$this->views_path;
        $data["view_path"]=$this->views_path;
        $data["views_path_module"]=$this->views_path_module;
        return(view($this->views_path_module.'\Home\View\index',$data));
    }

    public function show_modules($company_id)
    {
        if(!$this->session->get_LoggedIn()) {
            return(redirect()->to(base_url('/ts5/signin')));
        }
        $this->session->set('company_id',$company_id);
        $data["company_id"]=$company_id;
        $data["views_path"]=$this->views_path;
        $data["views_path_module"]=$this->views_path_module;
        return(view($this->views_path_module.'\Modules\View\index',$data));
    }
    public function show_components($company_id,$module_id)
    {
        if(!$this->session->get_LoggedIn()) {
            return(redirect()->to(base_url('/ts5/signin')));
        }
        $data["company_id"]=$company_id;
        $data["module_id"]=$module_id;
        $data["views_path"]=$this->views_path;
        $data["views_path_module"]=$this->views_path_module;
        return(view($this->views_path_module.'\Components\View\index',$data));
    }

}
