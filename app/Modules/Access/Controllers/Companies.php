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

use App\Modules\TS5\Libraries\Session;
use App\Controllers\BaseController;
use App\Modules\TS5\Libraries\Ts5_class;

class Companies extends BaseController
{

    private $session;
    private $views_path;
    private $views_path_module;

    function __construct()
    {
        $this->views_path='App\Modules\TS5\Views\templates\synadmin';
        $this->views_path_module='App\Modules\Access\Views\Companies';
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
    function list($company_id) {

        if (!$this->session->get_LoggedIn()) {
            return (redirect()->to(base_url('/ts5/signin')));
        } else {

            $ts5=new Ts5_class();
            //$company_id=$this->session->get('company_id');
            $this->session->set('company_id',$company_id);
            $controller_json_companies=base_url('/access/companies/jsonCompanies');
            $controller_draw_form_companies=base_url('/access/companies/frm_create');
            $controller_search_languages=base_url('/access/companies/languages?company_id='.$company_id);
            $controller_search_type_documents=base_url('/access/companies/documents_identifications?company_id='.$company_id);
            $controller_search_countries=base_url('/access/companies/countries?company_id='.$company_id);
            $controller_search_currencies=base_url('/access/companies/currencies?company_id='.$company_id);
            $controller_search_type_organizations=base_url('/access/companies/type_organizations?company_id='.$company_id);
            $controller_search_type_regime=base_url('/access/companies/type_regime?company_id='.$company_id);
            $controller_search_type_liability=base_url('/access/companies/type_liabilities?company_id='.$company_id);
            $controller_search_municipality=base_url('/access/companies/municipalities?company_id='.$company_id);
            $controller_save_company=base_url('/access/companies/create?company_id='.$company_id);
            $controller_edit_company=base_url('/access/companies/edit?company_id='.$company_id);
            $controller_companies_draw=base_url('/access/companies/table_companies?company_id='.$company_id);
            $controller_edit_draw=base_url('/access/companies/frm_edit/');
            $controller_view_company=base_url('/access/companies/view/');
            $data_table["controller_json"]=$controller_json_companies;
            $data_table["controller_draw"]=$controller_draw_form_companies;
            $data_table["controller_search_languages"]=$controller_search_languages;
            $data_table["controller_search_type_documents"]=$controller_search_type_documents;
            $data_table["controller_search_countries"]=$controller_search_countries;
            $data_table["controller_search_currencies"]=$controller_search_currencies;
            $data_table["controller_search_type_organizations"]=$controller_search_type_organizations;
            $data_table["controller_search_type_regime"]=$controller_search_type_regime;
            $data_table["controller_search_type_liability"]=$controller_search_type_liability;
            $data_table["controller_search_municipality"]=$controller_search_municipality;
            $data_table["controller_save_company"]=$controller_save_company;
            $data_table["controller_edit_company"]=$controller_edit_company;
            $data_table["controller_companies_draw"]=$controller_companies_draw;
            $data_table["controller_edit_draw"]=$controller_edit_draw;
            $data_table["controller_view_company"]=$controller_view_company;

            $data_table["table_id"]="companies_table";
            $data_table["company_id"]=$company_id;
            $data_table["views_path"]=$this->views_path;

            $my_js=view($this->views_path_module."\JS/js",$data_table);
            $my_js_company=view($this->views_path_module."\JS/js_view_company",$data_table);


            $data_div["tags"]='class="col-md-12" id="div_table_companies" ';
            $data_div["content_div"]='';
            $div_md_12=view($this->views_path."\div",$data_div);

            $data_div["tags"]='class="col-md-9" id="div_view_company" ';
            $data_div["content_div"]="";
            $div_md_9=view($this->views_path."\div",$data_div);

            $data_div["tags"]='class="col-md-3" id="div_view_msg" ';
            $data_div["content_div"]='';
            $div_md_3=view($this->views_path."\div",$data_div);

            $data_div["tags"]='class="row" ';
            $data_div["content_div"]=$div_md_12.$div_md_9.$div_md_3;
            $div_md_row=view($this->views_path."\div",$data_div);

            $html=$div_md_row;

            $data=$ts5->getDataTemplate($this->session);
            $data["data_template"]=$ts5->getDataTemplate($this->session);
            $data["data_template"]["my_js"]=$my_js.$my_js_company;
            $data["view_path"]=$this->views_path;
            $data["page_title"]=lang('Access.companies_page_title');
            $data["module_name"]=lang('Access.module_name');
            $data["page_content"]=$html;
            echo view($this->views_path."\blank",$data);

        }

    }

    /**
     * Dibuja la tabla de empresas
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     */
    function table_companies(){
        if (!$this->session->get_LoggedIn()){
            return (redirect()->to(base_url('/ts5/signin')));
        }

        $mUsers=model('App\Modules\Access\Models\Users');
        $ts5=new Ts5_class();
        $user_id=$this->session->get('user');
        $company_id=$this->session->get('company_id');
        $permission_id='613784ab2471f217811501';  //Ver en tabla access_control_permissions
        $module_id='613784ab2471f217811472'; //Access
        $html="";
        if($mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){

            $data_table["table_id"]="companies_table";
            $data_table["actions_path"]=base_url("/access/companies/list");
            $data_table["table_title"]=lang('Access.companies_table_title');
            $data_table["div_cols"]=12;
            $i=0;
            //$data_table["cols"][$i++]="id";
            $data_table["cols"][$i++]=lang('Access.companies_table_col1');
            $data_table["cols"][$i++]=lang("Access.companies_table_col2");
            $data_table["cols"][$i++]=lang("Access.companies_table_col3");
            $data_table["cols"][$i++]=lang("Access.companies_table_col4");
            $data_table["cols"][$i++]=lang("Access.companies_table_col5");
            $data_table["cols"][$i++]=lang("Access.companies_table_col6");
            $data_table["cols"][$i++]=lang("Access.companies_table_col7");
            $data_table["cols"][$i++]=lang("Access.companies_table_col8");



            $html.= view($this->views_path."\data_table",$data_table);

        }else{
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            $html.=view($this->views_path."\alert_error",$data_error);
        }

        return($html);
    }

    /**
     * Dibuja el formulario para crear una empresa
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     */
    function frm_create(){
        if (!$this->session->get_LoggedIn()){
            return (redirect()->to(base_url('/ts5/signin')));
        }
        $request = service('request');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $company_id=$request->getVar('company_id');
        $permission_id='613784ab2471f217811502';  //Ver en tabla access_control_permissions
        $module_id='613784ab2471f217811472'; //Access
        $html="";

        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $data["error_title"]=lang('Access.access_view_error_title');
            $data["msg_error"]=lang('Access.access_view_error');
            $html.= view($this->views_path."\alert_error",$data);
            return($html);
        }else{
            $data["views_path"]=$this->views_path;
            $html.= view($this->views_path_module."/Forms/frm_company",$data);
            return($html);

        }

    }

    /**
     * Dibuja el formulario para editar una empresa
     * @param $id => id de la empresa que se desea editar
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     */
    function frm_edit($id) {
        if (!$this->session->get_LoggedIn()){
            return (redirect()->to(base_url('/ts5/signin')));
        }
        $request = service('request');
        $mUsers=model('App\Modules\Access\Models\Users');
        $mCompanies=model('App\Modules\Access\Models\Companies');
        $user_id=$this->session->get('user');
        $company_id=$request->getVar('company_id');
        $permission_id='613784ab2471f217811504';           //Permiso para Editar singular Ver en tabla access_control_permissions
        $permission_id_all='613784ab2471f217811505';       //Permiso para Editar plural Ver en tabla access_control_permissions
        $module_id='613784ab2471f217811472'; //Access
        $html="";
        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$mCompanies->get_Authority($id,$user_id);

        if($p_all or  ($p_single and $authority) ){
            $data["views_path"]=$this->views_path;
            $data_company=$mCompanies->get_DataCompany($id);
            $data["data_form"]=$data_company;
            $html.= view($this->views_path_module."/Forms/frm_company",$data);
            return($html);
        }else{
            $data["error_title"]=lang('Access.access_view_error_title');
            $data["msg_error"]=lang('Access.access_view_error');
            $html.= view($this->views_path."\alert_error",$data);
            return($html);
        }

    }

    /**
     * Dibuja la interfaz con las diferentes opciones para el api de documentos electrónicos
     * @param $id
     */
    public function view($id){
        if (!$this->session->get_LoggedIn()){
            return (redirect()->to(base_url('/ts5/signin')));
        }

        $request = service('request');
        $mUsers=model('App\Modules\Access\Models\Users');
        $mCompanies=model('App\Modules\Access\Models\Companies');
        $user_id=$this->session->get('user');
        $company_id=$request->getVar('company_id');
        $permission_id='613784ab2471f217811506';           //Permiso para ver la configuración singular Ver en tabla access_control_permissions
        $permission_id_all='613784ab2471f217811507';       //Permiso para ver la configuración plural Ver en tabla access_control_permissions
        $module_id='613784ab2471f217811472'; //Access
        $html="";
        $p_all=$mUsers->has_Permission($user_id,$permission_id_all,$company_id,$module_id);
        $p_single=$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id);
        $authority=$mCompanies->get_Authority($id,$user_id);

        if($p_all or  ($p_single and $authority) ){
            $mCompanies=model('App\Modules\Access\Models\Companies');
            $data_company=$mCompanies->get_DataCompany($id);
            $data["id"]=$id;
            $data["data_company"]=$data_company;
            $image_link="public".DIRECTORY_SEPARATOR."companies".DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR."img".DIRECTORY_SEPARATOR."header-logo.png";

            $data["company_logo"]=$image_link;
            $data["views_path"]=$this->views_path;

            if(!is_file(ROOTPATH.$image_link)){
                $data["company_logo"]="/companies/general/images/no_image.jpg";
            }else{
                $data["company_logo"]="/companies/$id/img/header-logo.png";
            }

            return(view($this->views_path_module."\View\Company",$data));

        }else{
            $data["error_title"]=lang('Access.access_view_error_title');
            $data["msg_error"]=lang('Access.access_view_error');
            $html.= view($this->views_path."\alert_error",$data);
            return($html);
        }



    }


}