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
 * Modelo para los parametros de la nomina electronica
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-11-22
 * @updated 2021-11-22 
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

namespace App\Modules\Payroll\Models;

use CodeIgniter\Model;

class Parameters extends Model
{

    protected $table = 'payroll_parameters';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = false;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'id',
        'name',
        'value',
        'key',
        
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
     * Retorna el prefijo de los documentos de nomina electronica
     * @param type $id
     * @return type
     */
    public function get_Prefix() {
        $result=$this
                ->where('id',1)
                ->first();
        return($result["value"]);
    }
    /**
     * Retorna el prefijo de una nota de ajuste de nomina
     * @return type
     */
    public function get_PrefixNotes() {
        $result=$this
                ->where('id',11)
                ->first();
        return($result["value"]);
    }
    /**
     * Retorna si está en ambiente de pruebas de la DIAN
     * @param type $id
     * @return type
     */
    public function get_Environment() {
        $result=$this
                ->where('id',2)
                ->first();
        return($result["value"]);
    }
    /**
     * Retorna el set de pruebas de la DIAN
     * @param type $id
     * @return type
     */
    public function get_TestSetld() {
        $result=$this
                ->where('id',3)
                ->first();
        return($result["value"]);
    }
    
    /**
     * Retorna el metodo que se usará para transmitir
     * true metodo sincrono, false metodo asincrono
     * @param type $id
     * @return type
     */
    public function get_Method() {
        $result=$this
                ->where('id',4)
                ->first();
        return($result["value"]);
               
    }
    /**
     * retorna todos los parametros de la nomina
     * @return type
     */
    public function get_PayrollParameters() {
        $result=$this->findAll();
        return($result);      
                
    }
    
    
}

