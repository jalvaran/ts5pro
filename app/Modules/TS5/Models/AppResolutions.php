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

namespace App\Modules\TS5\Models;

use CodeIgniter\Model;

class AppResolutions extends Model
{

    protected $table = 'app_resolutions';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'id',
        'company_id',
        'type_document_id',
        'prefix',
        'resolution',
        'resolution_date',
        'technical_key',
        'from',
        'to',
        'date_from',
        'date_to',
        'backed_at',
        'resolution_id_api'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    //protected $cache_time = "10";
    protected $DBGroup = "techno";

    /**
     * retorna los valores de una resolución
     * @param $company_id
     * @param $resolution
     * @return array|false|object|null
     */
    public function get_Resolution($company_id,$resolution){
        $result=$this
            ->where("company_id",$company_id)
            ->where("resolution",$resolution)
            ->first()
        ;
        if(isset($result["company_id"])){
            return($result);
        }else{
            return(false);
        }
    }

    /**
     * Edita una resolución
     * @param $data
     * @param $company_id
     * @throws \ReflectionException
     */
    public function edit_Resolution($data,$resolution_id_api){
        $result=$this->select('id')
                ->where('resolution_id_api',$resolution_id_api)
                ->first();
        if(!isset($result["id"])){
            return(false);
        }
        $id=$result["id"];

        $this->where("resolution_id_api",$resolution_id_api);
        $this->update($id,$data);
    }

}

