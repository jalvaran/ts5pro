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
 * Modelo para los parametros de calculo de una hoja de negocio
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-10-06
 * @updated 2021-10-06 
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

namespace App\Modules\Inverpacific\Models;

use CodeIgniter\Model;

class Parameters extends Model
{

    protected $table = 'creditmoto_business_sheet_parameters';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = false;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'id',
        'concept',
        'value',
        'author',
        'created_at',
        'updated_at',
        'deleted_at',
        'backed_at',
        

    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    //protected $cache_time = "10";
    protected $DBGroup = "techno_client";
    
    /**
     * Retorna falso o verdadero si el usuario activo ne la sesión es el
     * autor del registro que se desea acceder, editar o eliminar.
     * @param type $id código primario del registro a consultar
     * @param type $author código del usuario del cual se pretende establecer la autoría
     * @return boolean falso o verdadero según sea el caso
     */
    public function get_Authority($id, $author)
    {
        //$this->db->setDatabase($_SESSION["DB_CLIENT"]);
        $row = $this->select("id")
                ->where("id", $id)
                ->where("author", $author)
                ->first();
        if (@$row["id"] == $id) {
            return (true);
        } else {
            return (false);
        }
    }
    /**
     * Obtiene el porcentaje del fondo de garantias
     * @return type
     */
    public function get_guarantee_fund_percent() {
        $result=$this->select('value')
                ->where('id',2)
                ->first();
        if (isset($result["value"])) {
            return ($result["value"]);
        } else {
            return (0);
        }
    }
    
    /**
     * Obtiene el porcentaje del fondo de garantias
     * @return type
     */
    public function guarantee_fund_percent_iva() {
        $result=$this->select('value')
                ->where('id',3)
                ->first();
        if (isset($result["value"])) {
            return ($result["value"]);
        } else {
            return (0);
        }
    }
    
    /**
     * Obtiene el valor del porcentaje del seguro segun si es con tenedor o sin tenedor o portador
     * @return type
     */
    public function life_insurance_percent($holder) {
        if($holder==0){
            $id=4;
        }else{
            $id=5;
        }
        $result=$this->select('value')
                ->where('id',$id)
                ->first();
        if (isset($result["value"])) {
            return ($result["value"]);
        } else {
            return (0);
        }
    }
    
    /**
     * Obtiene la tasa maxima legal vigente
     * @return type
     */
    public function get_maximum_legal_rate() {
        
        $result=$this->select('value')
                ->where('id',6)
                ->first();
        if (isset($result["value"])) {
            return ($result["value"]);
        } else {
            return (0);
        }
    }
    
    
    
}

