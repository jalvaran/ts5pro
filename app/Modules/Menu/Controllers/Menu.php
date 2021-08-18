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
use App\Modules\Access\Libraries\Access;
use App\Modules\TS5\Libraries\Ts5_class;

class Menu extends BaseController
{
    private $session;
    private $namespace;
    private $views_path;
    private $views_path_module;
    private $ts5;
    private $data_template;
    private $module_id;
    private $access;
    private $user_id;

    function __construct()
    {
        $this->module_id = 2;  //identifico el módulo
        $this->ts5 = new Ts5_class();
        $this->access = new Access();
        $this->data_template = $this->ts5->getDataTemplate();
        $this->data_template["page_title"] = lang('Menu.page_title_index');
        $this->data_template["module_name"] = "Menu";
        $this->namespace = 'App\Modules\Menu';
        $this->views_path = 'App\Modules\TS5\Views\templates\synadmin';
        $this->views_path_module = 'App\Modules\Menu\Views';
        $this->data_template["view_path"] = $this->views_path;
        $this->data_template["view_path_module"] = $this->views_path_module;
        $this->session = new Session();
        $this->user_id = $this->session->get('user');

    }

    /**
     * Muestra las Compañias que tiene asignado el usuario
     * Index de la pagina
     */
    public function index()
    {
        if (!$this->session->get_LoggedIn()) {
            return (redirect()->to(base_url('/ts5/signin')));
        }
        $this->data_template["page_content"] = $this->get_html_companies();
        $this->data_template["data_template"] = $this->data_template;
        return (view($this->views_path . '\blank', $this->data_template));
    }

    /**
     * Obtiene el html para dibujar las compañías asociadas a un usuario
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     */
    public function get_html_companies()
    {
        if (!$this->session->get_LoggedIn()) {
            return (redirect()->to(base_url('/ts5/signin')));
        }
        $companies = $this->access->get_UserCompanies($this->user_id);
        $page_content = "";
        if ($this->access->is_super_admin($this->user_id)) {
            $this->data_template["link"] = base_url("/access/platform_admin/");
            $this->data_template["card_title"] = lang("Menu.card_super_admin_title");
            $this->data_template["card_sub_title"] = lang("Menu.card_super_admin_sub_title");
            $this->data_template["card_num_cols"] = "3";
            $this->data_template["card_icon_menu"] = "lni lni-cog";
            $this->data_template["company_nit"] = "001";
            $page_content .= (view($this->views_path . '\card_menu_submenu', $this->data_template));
        }

        foreach ($companies as $data_company) {
            $this->data_template["link"] = base_url("/menu/modules/" . $data_company["id"]);
            $this->data_template["card_title"] = $data_company["name"];
            $this->data_template["card_sub_title"] = $data_company["description"];
            $this->data_template["card_num_cols"] = "3";
            if ($data_company["icon"] == '') {
                $data_company["icon"] = "bx bx-buildings";
            }
            $this->data_template["card_icon_menu"] = $data_company["icon"];
            $this->data_template["company_nit"] = $data_company["identification"];
            $page_content .= (view($this->views_path . '\card_menu_submenu', $this->data_template));
        }
        return ($page_content);
    }

    public function show_modules($company_id)
    {
        if (!$this->session->get_LoggedIn()) {
            return (redirect()->to(base_url('/ts5/signin')));
        }

        $this->data_template["page_content"] = $this->get_html_modules($company_id);
        $this->data_template["data_template"] = $this->data_template;
        return (view($this->views_path . '\blank', $this->data_template));

    }

    public function get_html_modules($company_id)
    {
        if (!$this->session->get_LoggedIn()) {
            return (redirect()->to(base_url('/ts5/signin')));
        }

        if (!$this->access->validate_user_company($this->user_id, $company_id)) {
            $data_error["error_title"] = lang('Menu.error_title_no_company');
            $data_error["msg_error"] = lang('Menu.error_text_no_company');
            return (view($this->views_path . '\alert_error', $data_error));
        }

        $modules = $this->access->get_CompaniesModules($company_id);
        $page_content = "";
        foreach ($modules as $data_module) {
            $this->data_template["link"] = base_url("/menu/modules/" . $data_module["id"]);
            $this->data_template["card_title"] = strtoupper($data_module["name"]);
            $this->data_template["card_sub_title"] = $data_module["description"];
            $this->data_template["card_num_cols"] = "3";
            if ($data_module["icon"] == '') {
                $data_module["icon"] = "lni lni-indent-increase";
            }
            $this->data_template["card_icon_menu"] = $data_module["icon"];
            $this->data_template["company_nit"] = '';
            $page_content .= (view($this->views_path . '\card_menu_submenu', $this->data_template));
        }
        return ($page_content);

    }

}
