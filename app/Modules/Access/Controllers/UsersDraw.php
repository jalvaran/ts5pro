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
 * Este archivo contiene el controlador para el modulo de creación de empresas
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-08-26
 * @updated 2021-08-26
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */
namespace App\Modules\Access\Controllers;

use App\Libraries\Session;
use App\Controllers\BaseController;
use App\Modules\TS5\Libraries\Ts5_class;

class UsersDraw extends BaseController
{

    private $session;
    private $views_path;
    private $views_path_module;

    function __construct()
    {
        $this->views_path='App\Modules\TS5\Views\templates\synadmin';
        $this->views_path_module='App\Modules\Access\Views\Users';
        $this->session = new Session();
    }

    /**
     * pagina inicial
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    function index() {

        if (!$this->session->get_LoggedIn()) {
            return (redirect()->to(base_url('/ts5/signin')));
        } else {
            return (redirect()->to(base_url('/menu')));
        }

    }

    /**
     * Muestra el listado de las empresas creadas en el sistema, más las opciones para crear, editar y ver
     * @param $company_id
     * @return \CodeIgniter\HTTP\RedirectResponse|void
     */
    function home($company_id) {
        if (!$this->session->get_LoggedIn()) {
            return (redirect()->to(base_url('/ts5/signin')));
        }
        $ts5=new Ts5_class();
        $html="";
        $data["views_path_module"]=$this->views_path_module;
        $data["view_path"]=$this->views_path;
        $data["company_id"]=$company_id;

        $data["table_id"]='table_users';
        $data["function_name"]='users_draw';
        $data["table_model"]='App\Modules\Access\Models\Users';
        $data["permissions"]["list"]=8;
        $data["permissions"]["create"]=9;
        $data["permissions"]["edit"]=11;
        $data["permissions"]["edit_all"]=12;
        $data["module_id"]=2;

        $data_tables_js=view($this->views_path."\data_tables_js",$data);

        $data_card["title"]=lang('Access_Pages.users_table_title');
        $data_card["sub_title"]="";
        $data_card["content"]="";
        $data_card["cols"]="12";
        $data_card["div_id"]="div_".$data["table_id"];
        $html.=view($this->views_path."\card",$data_card);


        /**
         * libro
         */

        $data["table_id"]='table_libro';
        $data["function_name"]='libro_draw';
        $data["table_model"]='App\Modules\Access\Models\Libro';
        $data["permissions"]["list"]=8;
        $data["permissions"]["create"]=9;
        $data["permissions"]["edit"]=11;
        $data["permissions"]["edit_all"]=12;
        $data["module_id"]=2;

        $data_tables_libro_js=view($this->views_path."\data_tables_js",$data);

        $data_card["title"]="libro Diario";
        $data_card["sub_title"]="";
        $data_card["content"]="";
        $data_card["cols"]="12";
        $data_card["div_id"]="div_".$data["table_id"];
        $html.=view($this->views_path."\card",$data_card);

        /**
         * Fin libro
         */

        $this->session->set('company_id',$company_id);
        $data=$ts5->getDataTemplate($this->session);
        $data["data_template"]=$ts5->getDataTemplate($this->session);
        $data["data_template"]["my_js"]=$data_tables_libro_js.$data_tables_js;

        $data["page_title"]=lang('Access_Pages.users_title');
        $data["module_name"]=lang('Access_Pages.users');
        $data["page_content"]=$html;
        echo view($this->views_path."\blank",$data);

    }





}