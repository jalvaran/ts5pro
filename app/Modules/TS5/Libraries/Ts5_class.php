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

class Ts5_class{

    private $session;
    private $user_id;

    public function __construct(){
        //$this->session=service('session');
        //$this->user_id=$this->session->get('user');

    }

    /**
     * Función para retornar una llave única
     * @param string $prefix
     * @param string $more_entropy default false
     * @return string
     */
    function getUniqueId($prefix="",$more_entropy=false)
    {
        return(str_replace(".","",uniqid($prefix,$more_entropy)));
    }

    /**
     * retorna los valores generales para construir una página de un template
     * @param string $company_id
     * @return array
     */
    function getDataTemplate($session,$company_id=""){
        //$this->access->create_json_menu($this->user_id);

        $data["lang"] = "es";
        $data["page"] = "index";
        $data["favicon"] = "/companies/cp_6128f69283025963104543/img/favicon.png";
        $data["company_logo"] = "/companies/cp_6128f69283025963104543/img/header-logo.png";
        $data["menu_logo"] = "/companies/cp_6128f69283025963104543/img/tslogo.png";
        $data["message_error"] = 0;
        $data["menu_title"] = "TS5 PRO";
        $data["user_name"] = $session->get('user_name');
        $data["user_designation"] = $session->get('user_designation');

        $data["menu"]=json_decode($session->get('json_menu'),true);
        $data["menu_submenu"]=json_decode($session->get('json_sub_menu'),true);
        $data["menu_pages"]=json_decode($session->get('json_menu_pages'),true);
        $data["sidebar_title"]="Menu";
        $data["theme"]="dark-theme";//Para modo oscuro
        $data["theme"]="";

        return($data);
    }

    /**
     * Función para calcular el digito de verificación de un nit
     * @param $identification
     * @return int
     */
    public function calculate_dv($identification) {
        $arr = array(1 => 3, 4 => 17, 7 => 29, 10 => 43, 13 => 59, 2 => 7, 5 => 19,
            8 => 37, 11 => 47, 14 => 67, 3 => 13, 6 => 23, 9 => 41, 12 => 53, 15 => 71);
        $x = 0;
        $y = 0;
        $z = strlen($identification);
        $dv = '';

        for ($i=0; $i<$z; $i++) {
            $y = substr($identification, $i, 1);
            $x += ($y*$arr[$z-$i]);
        }

        $y = $x%11;

        if ($y > 1) {
            $dv = 11-$y;
            return $dv;
        } else {
            $dv = $y;
            return $dv;
        }
    }

    public function curl($method, $url,$Token, $data){
        $curl = curl_init();

        switch ($method){
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "DELETE":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer '.$Token,
            'Content-Type: application/json',
            'Accept: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // EXECUTE:
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;
    }

}

