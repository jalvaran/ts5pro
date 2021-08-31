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
 * @created 2021-08-13
 * @updated 2021-08-14
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

namespace App\Modules\TS5\Libraries;
use App\Modules\TS5\Libraries\Ts5_class;


class ElectronicBill extends Ts5_class{
    /**
     * retorna el json de la creación de una empresa
     * @param $data_company
     * @return string
     */
    public function get_json_company_create($data_company){
        $json="";
        if(isset($data_company["id"])){
            $json.='{ 
                "type_document_identification_id": '.$data_company["type_document_identification_id"].',
                "type_organization_id": '.$data_company["type_organization_id"].',
                "type_regime_id": '.$data_company["type_regime_id"].',
                "type_liability_id": '.$data_company["type_liability_id"].',
                "business_name": "'.$data_company["municipality_id"].'",
                "merchant_registration": "'.$data_company["merchant_registration"].'",
                "municipality_id": '.$data_company["municipality_id"].',
                "address": "'.$data_company["address"].'",
                "phone": '.$data_company["phone"].',
                "ciius": "'.$data_company["ciius"].'",    
                "email": "'.$data_company["mail"].'"
            }' ;
        }

        return($json);
    }

    /**
     * Crear una empresa en el API de Factura electrónica
     * @param $data_company
     * @param $item_id
     * @param $user_id
     * @return bool|string|void
     */
    public function create_company_api($data_company,$item_id,$user_id){
        $end_point_id=4;
        $process_id=$this->getUniqueId("",true);
        $mApiResponses=model('App\Modules\TS5\Models\AppAppsResponses');
        $mApiEndPoints=model('App\Modules\TS5\Models\AppAppsEndPoints');
        $mApi=model('App\Modules\TS5\Models\AppApps');

        $json_company=$this->get_json_company_create($data_company);

        $mConfig=model('App\Modules\TS5\Models\AppConfig');
        $api_id=2;
        $token_api=$mConfig->get_TokenApi($api_id);  //Token el api de documentos electrónicos
        $url=$mApi->get_Url($api_id);
        $data_endpoint=$mApiEndPoints->get_EndPoint($end_point_id); //end point crear  una empresa

        $end_point=str_replace("{nit}",$data_company["identification"],$data_endpoint["name"]);
        $method=$data_endpoint["method"];
        $url=$url.$end_point;

        $response=$this->curl($method,$url,$token_api,$json_company);
        $data_response["id"]=$process_id;
        $data_response["app_apps_end_point_id"]=$end_point_id;                          //Crear una empresa
        $data_response["process_item_id"]=$item_id;
        $data_response["response"]=$response;
        $data_response["author"]=$user_id;
        $mApiResponses->insert($data_response);

        return($response);
    }

    /**
     * Actualiza una empresa en el API de Factura electrónica
     * @param $data_company
     * @param $item_id
     * @param $user_id
     * @return bool|string|void
     */
    public function update_company_api($data_company,$item_id,$user_id){
        $end_point_id=3;//end point para actualizar una empresa
        $process_id=$this->getUniqueId("",true);
        $mApiResponses=model('App\Modules\TS5\Models\AppAppsResponses');
        $mApiEndPoints=model('App\Modules\TS5\Models\AppAppsEndPoints');
        $mApi=model('App\Modules\TS5\Models\AppApps');

        $json_company=$this->get_json_company_create($data_company);

        $mConfig=model('App\Modules\TS5\Models\AppConfig');
        $api_id=2;
        $token_api=$mConfig->get_TokenApi($api_id);  //Token el api de documentos electrónicos
        $url=$mApi->get_Url($api_id);
        $data_endpoint=$mApiEndPoints->get_EndPoint($end_point_id);

        $end_point=str_replace("{nit}",$data_company["identification"],$data_endpoint["name"]);
        $method=$data_endpoint["method"];
        $url=$url.$end_point;

        $response=$this->curl($method,$url,$token_api,$json_company);
        $data_response["id"]=$process_id;
        $data_response["app_apps_end_point_id"]=$end_point_id;
        $data_response["process_item_id"]=$item_id;
        $data_response["response"]=$response;
        $data_response["author"]=$user_id;
        $mApiResponses->insert($data_response);

        return($response);
    }

}

