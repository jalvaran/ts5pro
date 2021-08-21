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

    public function index()
    {
        $data["views_path"]=$this->views_path ;
        $data["view_path_module"]=$this->view_path_module ;
        return(view($this->views_path_module.'\Home\index',$data));
    }

    /**
     * Muestra las Empresas que tiene asignado el usuario
     * Index de la página
     */
    public function index2()
    {
        $validation=$this->access->validate_access_permission($this->user_id);
        $this->data_template["page_content"] ="";
        if($validation<>"OK"){
            $this->data_template["page_content"] = $this->html_errors($validation);
        }else {
            $this->data_template["page_content"] = $this->get_html_companies();
        }

        $this->data_template["data_template"] = $this->data_template;

        return (view($this->views_path . '\blank', $this->data_template));
    }

    /**
     * Obtiene el html para dibujar las compañías asociadas a un usuario
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     */
    public function get_html_companies()
    {
        $validation=$this->access->validate_access_permission($this->user_id);
        $page_content = "";
        if($validation<>"OK"){
            $this->data_template["page_content"] = $this->html_errors($validation);
        }else {
            $companies=$this->data_template["menu"];
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
        }

        return ($page_content);
    }

    /**
     * Muestra los módulos de una empresa
     * @param $company_id
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     */
    public function show_modules($company_id)
    {
        $validation=$this->access->validate_access_permission($this->user_id,$company_id);
        if($validation<>"OK"){
            $this->data_template["page_content"] = $this->html_errors($validation);
        }else{
            $this->data_template["page_content"] = $this->get_html_modules($company_id);
        }
        $this->data_template["sidebar_title"]=lang('Menu.siderbar_title_modules');
        $this->data_template["data_template"] = $this->data_template;
        return (view($this->views_path . '\blank', $this->data_template));

    }

    /**
     * Obtiene el html para mostrar las cards de los modulos de una empresa
     * @param $company_id
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     */
    public function get_html_modules($company_id)
    {
        $validation=$this->access->validate_access_permission($this->user_id,$company_id);
        $page_content="";
        if($validation<>"OK"){
            $this->data_template["page_content"] = $this->html_errors($validation);
        }else {
            $this->session->set("company_id", $company_id);
            $modules=$this->data_template["menu_submenu"];
            $page_content = "";
            foreach ($modules[$company_id] as $data_module) {
                $this->data_template["link"] = base_url("/menu/components/$company_id/" . $data_module["module_id"]);
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
        }
        return ($page_content);

    }

    /**
     * Muestra los componentes de un módulo
     * @param $company_id
     * @param $module_id
     * @return string
     */
    public function show_components($company_id,$module_id)
    {
        $this->data_template["page_title"] = lang('Menu.page_title_module_'.$module_id);
        $validation=$this->access->validate_access_permission($this->user_id,$company_id,$module_id);
        if($validation<>"OK"){
            $this->data_template["page_content"] = $this->html_errors($validation);
        }else{
            $this->data_template["page_content"]=$this->get_html_components($company_id,$module_id);
        }

        $this->data_template["data_template"] = $this->data_template;
        return (view($this->views_path . '\blank', $this->data_template));


    }

    public function get_html_components($company_id,$module_id)
    {
        $validation=$this->access->validate_access_permission($this->user_id,$company_id,$module_id);
        $page_content="";
        if($validation<>"OK"){
            $this->data_template["page_content"] = $this->html_errors($validation);
        }else {

            $components=$this->data_template["menu_pages"];
            foreach ($components[$module_id] as $data_module) {
                $this->data_template["link"] =$data_module["link"];
                $this->data_template["card_title"] = lang('Menu.card_title_component_'.$data_module["id"]);
                $this->data_template["card_sub_title"] = lang('Menu.card_sub_title_component_'.$data_module["id"]);
                $this->data_template["card_num_cols"] = "3";
                $this->data_template["card_icon_menu"] = "bx bx-shape-square";
                $this->data_template["company_nit"] = '';
                $page_content .= (view($this->views_path . '\card_menu_submenu', $this->data_template));
            }
        }
        return ($page_content);

    }

    /**
     * Retorna el html de un error según su código
     * @param $validation
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     */
    public function html_errors($validation){
        $html="";
        if($validation=='E1'){//El usuario no ha iniciado sesión
            return (redirect()->to(base_url('/ts5/signin')));
        }

        if ($validation=='E2') { //El usuario no tiene asignada esta empresa
            $data_error["error_title"] = lang('Menu.error_title_no_company');
            $data_error["msg_error"] = lang('Menu.error_text_no_company');
            $html.= (view($this->views_path . '\alert_error', $data_error));
        }

        if ($validation=='E3') { //El usuario no tiene roles asignados
            $data_error["error_title"] = lang('Menu.error_title_no_roles');
            $data_error["msg_error"] = lang('Menu.error_text_no_roles');
            $html.= (view($this->views_path . '\alert_error', $data_error));
        }

        if ($validation=='E4') { //El Usuario no tiene permitido ingresar a este módulo
            $data_error["error_title"] = lang('Menu.error_title_no_module');
            $data_error["msg_error"] = lang('Menu.error_text_no_module');
            $html.= (view($this->views_path . '\alert_error', $data_error));
        }

        if ($validation=='E5') { //El Usuario no tiene permitido realizar la acción solicitada
            $data_error["error_title"] = lang('Menu.error_title_no_action');
            $data_error["msg_error"] = lang('Menu.error_text_no_action');
            $html.= (view($this->views_path . '\alert_error', $data_error));
        }

        if ($validation=='E6') { //El Módulo no está asignado a la empresa
            $data_error["error_title"] = lang('Menu.error_title_no_module_company');
            $data_error["msg_error"] = lang('Menu.error_text_no_module_company');
            $html.= (view($this->views_path . '\alert_error', $data_error));
        }

        return($html);

    }

}
