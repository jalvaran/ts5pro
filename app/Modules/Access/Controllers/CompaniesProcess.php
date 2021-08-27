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
 * Este archivo procesa las peticiones CRUD para la tabla empresas
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
use CodeIgniter\API\ResponseTrait;

class CompaniesProcess extends BaseController
{
    use ResponseTrait;
    private $session;

    function __construct()
    {

        $this->session = new Session();
    }

    /**
     * Función para crear una empresa
     * @return mixed
     */
    function create() {
        if (!$this->session->get_LoggedIn()) {
            $response["status"]=0;
            $response["msg"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($response);
            exit();
        }

        $user_id=$this->session->get('user');
        $request = service('request');
        $company_id=$request->getVar('company_id');
        $data_form_serialized=$request->getVar('data_form_serialized');
        parse_str($data_form_serialized,$data_form);
        $validator["numeric"]["identification"]=1;
        $validator["numeric"]["phone"]=1;
        $validator["numeric"]["post_documents_automatically"]=1;
        $validator["not_required"]["test_set_dian"]=1;
        $validator["not_required"]["ciius"]=1;
        $validator["not_required"]["icon"]=1;
        $validator["not_required"]["merchant_registration"]=1;
        /*
        $validator["select2"]["type_document_identification_id"]=1;
        $validator["select2"]["country_id"]=1;
        $validator["select2"]["municipality_id"]=1;
        $validator["select2"]["type_organization_id"]=1;
        $validator["select2"]["type_regime_id"]=1;
        $validator["select2"]["language_id"]=1;
        $validator["select2"]["type_currency_id"]=1;
        $validator["select2"]["type_currency_id"]=1;
        $validator["select2"]["type_currency_id"]=1;
        $validator["select2"]["type_currency_id"]=1;
        */
        foreach($data_form as $field => $value){
            if($value=='' and !isset($validator["not_required"][$field])){
                $response["status"]=0;
                $data_lang["field_name"]=lang('Access.companies_frm_input_'.$field);
                $response["msg"]=lang('Ts5.validation_field_empty',$data_lang);
                $response["object_id"]=$field;
                if(isset($validator["select2"][$field])){
                    $response["object_id"]="select2-".$field."-container";
                }
                return $this->setResponseFormat('json')->respond($response);
            }
            if(isset($validator["numeric"][$field]) and !is_numeric($value)){
                $response["status"]=0;
                $data_lang["field_name"]=lang('Access.companies_frm_input_'.$field);
                $response["msg"]=lang('Ts5.validation_field_numeric_1',$data_lang);
                $response["object_id"]=$field;
                return $this->setResponseFormat('json')->respond($response);
            }
        }
        $ts5=new Ts5_class();

        $data_form["dv"]=$ts5->calculate_dv($data_form["identification"]);
        $data_form["author"]=$user_id;
        $mCompanies=model('App\Modules\Access\Models\Companies');

        $mCompanies->insert($data_form);
        $response["status"]=1;
        $response["msg"]="Registro Guardado";
        return $this->setResponseFormat('json')->respond($response);
    }


}