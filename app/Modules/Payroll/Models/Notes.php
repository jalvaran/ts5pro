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
 * Modelo para las notas de ajustes a la nomina
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-12-05
 * @updated 2021-12-05
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

namespace App\Modules\Payroll\Models;

use CodeIgniter\Model;

class Notes extends Model
{

    protected $table = 'payroll_notes';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = false;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'id',
        
        'payroll_individual_document_id',
        'prefix',
        'consecutive',
        'description',
        'status',
        'author',
        
        'is_valid',
        'status_code',
        'zip_key',
        'uuid',
        'errors_messages',
        'status_description',
        
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
     * Valida si ya está creado un documento de nomina individual
     * @param type $payroll_documents_id
     * @param type $payroll_employee_id
     * @return type
     */
    public function is_Created($payroll_individual_document_id) {
        $row = $this->select("id")
                ->where("payroll_individual_document_id", $payroll_individual_document_id)
                
                ->first();
        if (isset($row["id"])) {
                return (true);
            } else {
                return (false);
            }
    }
    
}
