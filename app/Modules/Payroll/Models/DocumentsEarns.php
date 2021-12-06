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
 * Modelo para los devengados agregados a un documento de nomina
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-11-30
 * @updated 2021-11-30 
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

namespace App\Modules\Payroll\Models;

use CodeIgniter\Model;

class DocumentsEarns extends Model
{

    protected $table = 'payroll_documents_earns';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = false;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'id',
        'payroll_documents_id',
        'payroll_employee_id',
        
        'payroll_type_earn_id',
        'description',
        'payment',
        'quantity',
        'percentage',
        'interest_payment',
        'layoffs_payment',
        'type_incapacity_id',
        'type_time_id',
        
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
     * Retorna los datos de un id
     * @param type $id
     * @return type
     */
    public function get_Data($id) {
        $result=$this
                ->where('id',$id)
                ->first();
        return($result);
    }
    /**
     * retorna los devengados en un documento de nomina
     * @param type $payroll_documents_id
     * @return type
     */
    public function get_DocumentEarns($payroll_documents_id,$payroll_employee_id="") {
        $this->select('payroll_documents_earns.*,app_thirds.name as third_name,app_thirds.identification as third_identification,payroll_type_earns.description as earn_description,payroll_type_earns.salary_concept as earn_salary_concept,payroll_type_earns.account as earn_account')
                ->select('(SELECT name FROM payroll_type_times WHERE payroll_type_times.id=payroll_documents_earns.type_time_id) as time_name')
                ->join('payroll_type_earns','payroll_type_earns.id=payroll_documents_earns.payroll_type_earn_id')
                ->join('app_thirds','app_thirds.id=payroll_documents_earns.payroll_employee_id')
                ->where('payroll_documents_id',$payroll_documents_id);
        if($payroll_employee_id<>''){
            $this->where('payroll_employee_id',$payroll_employee_id);
        }
                $this->orderBy('payroll_documents_earns.id','ASC');
        $result=$this->findAll();
        return($result);
    }
    
    /**
     * 
     * @param type $payroll_documents_id
     */
    public function get_SalarialEarnsValue($payroll_documents_id) {
        $result=$this->selectSum('payroll_documents_earns.payment')
                ->join('payroll_type_earns','payroll_type_earns.id=payroll_documents_earns.payroll_type_earn_id')
                ->where('payroll_documents_earns.payroll_documents_id',$payroll_documents_id)
               
                ->where('payroll_type_earns.salary_concept=1')
                ->first();
        return($result["payment"]);
    }
    /**
     * Obtiene el salario basico agregado en los devengados
     * @param type $payroll_documents_id
     * @param type $payroll_employee_id
     * @return type
     */
    public function get_BasicSalaryInDocument($payroll_documents_id,$payroll_employee_id) {
        $result=$this->select()
                    ->where('payroll_documents_id',$payroll_documents_id)
                    ->where('payroll_employee_id',$payroll_employee_id)
                    ->where('payroll_type_earn_id',1)
                    ->first()
                    ;
        return($result);
    }
    
    /**
     * Obtiene el auxilio de transporte agregado a un documento de nomina
     * @param type $payroll_documents_id
     * @param type $payroll_employee_id
     * @return type
     */
    public function get_TransportationAssistance($payroll_documents_id,$payroll_employee_id) {
        $result=$this->select()
                    ->where('payroll_documents_id',$payroll_documents_id)
                    ->where('payroll_employee_id',$payroll_employee_id)
                    ->where('payroll_type_earn_id',2)
                    ->first()
                    ;
        return($result);
    }
    
}

