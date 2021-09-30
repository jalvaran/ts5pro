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
 * Modelo para los valores adicionales de una hoja de negocio
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-09-29
 * @updated 2021-09-29 
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

namespace App\Modules\Inverpacific\Models;

use CodeIgniter\Model;

class BusinessSheetSeveralsAdds extends Model
{

    protected $table = 'creditmoto_business_sheet_severals_adds';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = false;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'id',
        'business_sheet_id',
        'several_id',
        'value',
        'iva',
        'concept',
        'bill_number',
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
     * Valida si un adicional ya fué agregado a una hoja de negocio
     * @param type $several_id
     * @param type $business_sheet_id
     * @return type
     */
    public function is_add($several_id,$business_sheet_id) {
        $row = $this->select("id")
                ->where("several_id", $several_id)
                ->where("business_sheet_id", $business_sheet_id)
                ->first();
        if (@$row["id"] <>'') {
            return (true);
        } else {
            return (false);
        }
    }
    /**
     * Retorna los adicionales agregados a una hoja de negocio
     * @param type $condition
     * @return type
     */
    public function get_List($condition='') {
        
        if($condition<>''){
            $this->where($condition);
        }
        $result=$this->select('creditmoto_business_sheet_severals_adds.*,creditmoto_business_sheet_severals.name as several_name')
                ->join('creditmoto_business_sheet_severals','creditmoto_business_sheet_severals.id=creditmoto_business_sheet_severals_adds.several_id')
                ->findAll();
        return($result);
    }   
    

}

