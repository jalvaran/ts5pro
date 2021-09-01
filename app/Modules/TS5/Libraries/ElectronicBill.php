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

    /**
     * Crea el logo de una empresa en el api de facturación electrónica
     * @param $data_company
     * @param $item_id
     * @param $user_id
     * @return bool|string|void
     */
    public function create_logo_company_api($data_company,$item_id,$user_id){
        $end_point_id=17;//end point para crear el logo de una empresa
        $process_id=$this->getUniqueId("",true);
        $mApiResponses=model('App\Modules\TS5\Models\AppAppsResponses');
        $mApiEndPoints=model('App\Modules\TS5\Models\AppAppsEndPoints');
        $mLogoCompany=model('App\Modules\TS5\Models\AppCompaniesLogos');
        $mApi=model('App\Modules\TS5\Models\AppApps');

        $api_id=2;
        $token_api=$data_company["token_api_soenac"];

        $logo_base64=$mLogoCompany->get_DataLogo($data_company["id"]);
        if(!isset($logo_base64["logo_base64"])){
            return(false);
        }
        $json='{
          "logo": "'.$logo_base64["logo_base64"].'"
        }';

        $url=$mApi->get_Url($api_id);
        $data_endpoint=$mApiEndPoints->get_EndPoint($end_point_id);

        $end_point=$data_endpoint["name"];
        $method=$data_endpoint["method"];
        $url=$url.$end_point;

        $response=$this->curl($method,$url,$token_api,$json);
        $data_response["id"]=$process_id;
        $data_response["app_apps_end_point_id"]=$end_point_id;
        $data_response["process_item_id"]=$item_id;
        $data_response["response"]=$response;
        $data_response["author"]=$user_id;
        $mApiResponses->insert($data_response);

        return($response);
    }

    /**
     * Crear software en el api
     * @param $data_company
     * @param $data_software
     * @param $item_id
     * @param $user_id
     * @return bool|string|void
     */
    public function create_software_api($data_company,$data_software,$item_id,$user_id){
        $end_point_id=9;//end point para crear o actualizar el software de una empresa
        $process_id=$this->getUniqueId("",true);
        $mApiResponses=model('App\Modules\TS5\Models\AppAppsResponses');
        $mApiEndPoints=model('App\Modules\TS5\Models\AppAppsEndPoints');

        $mApi=model('App\Modules\TS5\Models\AppApps');
        $api_id=2;
        $token_api=$data_company["token_api_soenac"];

        $json='{
            "id":"'.$data_software["identifier"].'",
            "pin": "'.$data_software["pin"].'"
        }';

        $url=$mApi->get_Url($api_id);
        $data_endpoint=$mApiEndPoints->get_EndPoint($end_point_id);

        $end_point=$data_endpoint["name"];
        $method=$data_endpoint["method"];
        $url=$url.$end_point;

        $response=$this->curl($method,$url,$token_api,$json);
        $data_response["id"]=$process_id;
        $data_response["app_apps_end_point_id"]=$end_point_id;
        $data_response["process_item_id"]=$item_id;
        $data_response["response"]=$response;
        $data_response["author"]=$user_id;
        $mApiResponses->insert($data_response);

        return($response);
    }


    /**
     * crea el certificado digital en el api
     * @param $data_company
     * @param $data_certificate
     * @param $item_id
     * @param $user_id
     * @return bool|string|void
     */
    public function create_certificate_api($data_company,$data_certificate,$item_id,$user_id){
        $end_point_id=11;//end point para crear o actualizar el certificado digital de una empresa
        $process_id=$this->getUniqueId("",true);
        $mApiResponses=model('App\Modules\TS5\Models\AppAppsResponses');
        $mApiEndPoints=model('App\Modules\TS5\Models\AppAppsEndPoints');

        $mApi=model('App\Modules\TS5\Models\AppApps');
        $api_id=2;
        $token_api=$data_company["token_api_soenac"];

        $json='{
            "certificate":"'.$data_certificate["base_64"].'",
            "password": "'.$data_certificate["password"].'"
        }';

        $url=$mApi->get_Url($api_id);
        $data_endpoint=$mApiEndPoints->get_EndPoint($end_point_id);

        $end_point=$data_endpoint["name"];
        $method=$data_endpoint["method"];
        $url=$url.$end_point;

        $response=$this->curl($method,$url,$token_api,$json);
        $data_response["id"]=$process_id;
        $data_response["app_apps_end_point_id"]=$end_point_id;
        $data_response["process_item_id"]=$item_id;
        $data_response["response"]=$response;
        $data_response["author"]=$user_id;
        $mApiResponses->insert($data_response);

        return($response);
    }

    /**
     * Establece el tipo de ambiente de una empresa en el api de soenac
     * @param $data_company
     * @param $type_environment > 1 producción, 2 pruebas
     * @param $item_id
     * @param $user_id
     * @return bool|string|void
     */
    public function set_type_environment_api($data_company,$type_environment,$item_id,$user_id){
        $end_point_id=7;//end point para actualizar el tipo de ambiente, producción o pruebas
        $process_id=$this->getUniqueId("",true);
        $mApiResponses=model('App\Modules\TS5\Models\AppAppsResponses');
        $mApiEndPoints=model('App\Modules\TS5\Models\AppAppsEndPoints');

        $mApi=model('App\Modules\TS5\Models\AppApps');
        $api_id=2;
        $token_api=$data_company["token_api_soenac"];

        $json='{
            "type_environment_id":"'.$type_environment.'"            
        }';

        $url=$mApi->get_Url($api_id);
        $data_endpoint=$mApiEndPoints->get_EndPoint($end_point_id);

        $end_point=$data_endpoint["name"];
        $method=$data_endpoint["method"];
        $url=$url.$end_point;

        $response=$this->curl($method,$url,$token_api,$json);
        $data_response["id"]=$process_id;
        $data_response["app_apps_end_point_id"]=$end_point_id;
        $data_response["process_item_id"]=$item_id;
        $data_response["response"]=$response;
        $data_response["author"]=$user_id;
        $mApiResponses->insert($data_response);

        return($response);
    }

    public function get_numeration($data_company,$item_id,$user_id){
        $end_point_id=51;//end point para obtener la numeración de la DIAN
        $process_id=$this->getUniqueId("",true);
        $mApiResponses=model('App\Modules\TS5\Models\AppAppsResponses');
        $mApiEndPoints=model('App\Modules\TS5\Models\AppAppsEndPoints');
        $mSoftware=model('App\Modules\TS5\Models\AppCompaniesSoftware');
        $data_software=$mSoftware->get_DataSoftware($item_id);
        if(!isset($data_software["identifier"])){
            return("E1");
        }

        $mApi=model('App\Modules\TS5\Models\AppApps');
        $api_id=2;
        $token_api=$data_company["token_api_soenac"];

        $json='';

        $url=$mApi->get_Url($api_id);
        $data_endpoint=$mApiEndPoints->get_EndPoint($end_point_id);

        $end_point=str_replace("{nit}",$data_company["identification"],$data_endpoint["name"]);
        $end_point=str_replace("{software_id}",$data_software["identifier"],$end_point);
        $method=$data_endpoint["method"];
        $url=$url.$end_point;

        $response=$this->curl($method,$url,$token_api,$json);
        $data_response["id"]=$process_id;
        $data_response["app_apps_end_point_id"]=$end_point_id;
        $data_response["process_item_id"]=$item_id;
        $data_response["response"]=$response;
        $data_response["author"]=$user_id;
        $mApiResponses->insert($data_response);

        return($response);
    }

}

