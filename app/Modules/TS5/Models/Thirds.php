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
 * Modelo para gestionar la tabla de terceros
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-09-21
 * @updated 2021-09-21
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

namespace App\Modules\TS5\Models;

use CodeIgniter\Model;

class Thirds extends Model
{

    protected $table = 'app_thirds';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = false;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'id',
        'type_third',
        'type_organization_id',
        'type_regime_id',
        'type_liabilitie_id',
        'type_document_identification_id',
        'identification',
        'dv',
        'firts_name',
        'second_name',
        'surname',
        'second_surname',
        'name',
        'municipalities_id',
        'departments_id',
        'countries_id',
        'address',
        'neighborhood',
        'telephone1',
        'telephone2',
        'mail',
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

    public function get_DataThird($id)
    {
        $row = $this->select('app_companies.*')
            ->select('app_cat_languages.name as name_language')
            ->select('app_cat_languages.code as code_language')
            ->join("app_cat_languages", "app_cat_languages.id=app_companies.language_id")

            ->select('app_cat_type_document_identifications.name as name_type_document')
            ->join("app_cat_type_document_identifications", "app_cat_type_document_identifications.id=app_companies.type_document_identification_id")

            ->select('app_cat_countries.name as name_country_id')
            ->join("app_cat_countries", "app_cat_countries.id=app_companies.country_id")

            ->select('app_cat_type_currencies.name as name_type_currency_id')
            ->join("app_cat_type_currencies", "app_cat_type_currencies.id=app_companies.type_currency_id")

            ->select('app_cat_type_organizations.name as name_type_organization_id')
            ->join("app_cat_type_organizations", "app_cat_type_organizations.id=app_companies.type_organization_id")

            ->select('app_cat_type_regimes.name as name_type_regime_id')
            ->join("app_cat_type_regimes", "app_cat_type_regimes.id=app_companies.type_regime_id")

            ->select('app_cat_type_liabilities.name as name_type_liability_id')
            ->join("app_cat_type_liabilities", "app_cat_type_liabilities.id=app_companies.type_liability_id")

            ->select('app_cat_municipalities.name as name_municipality_id')
            ->join("app_cat_municipalities", "app_cat_municipalities.id=app_companies.municipality_id")

            ->where("app_companies.id", $id)
            ->first();
        if (@$row["id"] == $id) {
            return ($row);
        } else {
            return (false);
        }
    }

    public function identification_exists($identification) {
        $result=$this
                ->where('identification',$identification)
                ->first();
        if(isset($result['id'])){
            if($result['id']<>''){
                return(true);
            }else{
                return(false);
            }
        }
        
        
    }    
    
}

