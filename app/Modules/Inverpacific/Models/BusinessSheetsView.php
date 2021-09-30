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
 * Modelo para las hojas de trabajo
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-09-20
 * @updated 2021-09-20 
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

namespace App\Modules\Inverpacific\Models;

use CodeIgniter\Model;

class BusinessSheetsView extends Model
{

    protected $table = 'view_creditmoto_business_sheet';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = false;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'id',
        'creditmoto_business_sheet_types_id',
        'creditmoto_business_sheet_types_name',
        'consecutive',
        'app_thirds_id',
        'third_name',
        'third_identification',
        'motorcycle',
        'color',
        'maker',
        'invoice',
        'sticker',
        'motor_number',
        'motorcycle_value',
        'motorcycle_value_before_taxes',
        'tax_percent_value',
        'discount',
        'subtotal',
        'iva_value',
        'total_motorcycle',
        'several_value',
        'total_more_several',
        'initial_fee',
        'retake',
        'subtotal_general',
        'guarantee_fund_percent',
        'guarantee_fund_percent_iva',
        'guarantee_fund_value',        
        'guarantee_fund_iva_value',        
        'total_administration_expenses',
        'total_general',
        'capital_xtra',
        
        'financing_balance',
        'financing_value',
        'financing_value_adjustment',
        'life_insurance_percent',
        'life_insurance_value',
        'total_to_pay',
        'type_of_sale',
        'financial_id',
        'financing_rate',
        'term',
        'solidarity_debtor',
        'responsible_in_financial',
        'promissory_note_value',
        'fee_value',
        'fee_value_life_insurance',
        'fee_value_monthly',
        'observations',
        'cifin',
        'fosiga',
        'simit',
        'runt',
        'author',
        'author_name',
        
        'status',
        'status_name',
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
    
    

}

