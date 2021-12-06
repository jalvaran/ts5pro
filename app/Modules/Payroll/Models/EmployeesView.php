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
 * Modelo para la vista de los empleados
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-10-06
 * @updated 2021-10-06 
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

namespace App\Modules\Payroll\Models;

use CodeIgniter\Model;

class EmployeesView extends Model
{

    protected $table = 'view_payroll_employees';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = false;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'id',
        'third_id',
        'type_worker_id',
        'subtype_worker_id',
        
        'company_group_id',
        'employees_position_id',
        
        'high_risk_pension',
        'integral_salary',
        'type_contract_id',
        
        'start_date',
        'finish_date',
        
        
        'salary',
        'transportation_assistance',
        'eps_code',
        'afp_code',
        'arl_code',
        'arl_level_id',
        'ccf_code',
        'period_id',
        'bank',
        'account_type',
        'account_number',
        
        'active',
        'reasons_withdrawal_id',
        
        'author',
        
        'created_at',
        'updated_at',
        'deleted_at',
        'backed_at',
        
        'type_document_identification_id',
        'identification',
        'firts_name',
        'second_name',
        'surname',
        'second_surname',
        'name',
        'address',
        'telephone1',
        'telephone2',
        'mail',
        'type_document_identification_name',
        'municipalities_id',
        'municipalities_name',
        'departments_name',
        'author_name',
        'type_worker_name',
        'subtype_worker_name',
        'company_group_name',
        'employees_position_name',
        'type_contract_name',
        'eps_name',
        'afp_name',
        'arl_name',
        'ccf_name',
        'arl_level_name',
        'arl_level_percent',
        'period_name',
        'reasons_withdrawal_name',

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
    
    
    public function get_Data($id) {
        $result=$this
                ->where('id',$id)
                ->first();
        return($result);
    }
    
    
    public function get_List($id) {
        $result=$this
                ->where('id',$id)                
                ->find();
        return($result);
    }

}

