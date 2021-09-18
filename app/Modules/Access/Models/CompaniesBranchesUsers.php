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

namespace App\Modules\Access\Models;

use CodeIgniter\Model;

class CompaniesBranchesUsers extends Model
{

    protected $table = 'app_companies_branches_users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'id',
        'access_control_users_id',
        'app_companies_branches_id',
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
    protected $DBGroup = "techno";

    
    /**
     * Devuelve las sucursales de un usuario
     * @param $user_id
     * @return array
     */
    public function get_branches_user($user_id){
        $result=$this->select('id')
            ->where("access_control_user_id", $user_id)
            ->findAll();
        return($result);
    }

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
    
    public function getBranchesInUser($user_id) {
        $result=$this->select('app_companies_branches_users.id,app_companies_branches.name as branch_name,app_companies_branches_users.access_control_users_id as user_id')
                ->join('app_companies_branches','app_companies_branches.id=app_companies_branches_users.app_companies_branches_id')
                ->where("app_companies_branches_users.access_control_users_id", $user_id)
                
                ->findAll();
        return($result);
    }
    
    
    public function branch_in_user($branch_id,$user_id) {
        $result=$this->select('id')
                ->where('app_companies_branches_id',$branch_id)
                ->where('access_control_user_id',$user_id)
                ->first();
                ;
        if(isset($result["id"])){
            return(true);
        }else{
            return(false);
        }
    }

}

