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
 * Modelo de la tabla sucursales de la empresa
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-09-17
 * @updated 2021-09-17
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

namespace App\Modules\Access\Models;

use CodeIgniter\Model;

class CompaniesBranches extends Model
{

    protected $table = 'app_companies_branches';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = false;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'id',
        'company_id',
        'name',
        'app_cat_municipalities_id',
        'author',
        'backed_at',
        'created_at',
        'updated_at'

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
     * Obtiene los módulos asociados a una empresa
     * @param $company_id
     * @return array
     */
    public function get_CompaniesBranches($company_id)
    {
        $result = $this
            
            ->where("company_id", $company_id)
            
            ->findAll();
        return ($result);
    }
    
    /**
     * Obtiene los datos de una sucursal
     * @param $company_id
     * @return array
     */
    public function get_DataBranch($id)
    {
        $result = $this->select("app_companies_branches.*,app_cat_municipalities.name as municipalitie_name")
            ->join("app_cat_municipalities","app_cat_municipalities.id=app_companies_branches.app_cat_municipalities_id")
            ->where("app_companies_branches.id", $id)
            
            ->first();
        return ($result);
    }

    public function get_Authority($id, $author)
    {
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

}

