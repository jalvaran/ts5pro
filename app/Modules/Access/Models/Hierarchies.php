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

class Hierarchies extends Model
{

    protected $table = 'access_control_hierarchies';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'id',
        'access_control_user_id',
        'access_control_role_id',
        'author'

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
     * Valida si el usuario es o no Super administrador
     * @param $user_id
     */
    public function is_super_admin($user_id){
        $result=$this
            ->select("id")
            ->where("access_control_user_id", $user_id)
            ->where("access_control_role_id", 1)
            ->find();
        if(isset($result[0]["id"])){
            return(true);
        }else{
            return(false);
        }

    }

    /**
     * Devuelve los roles de un usuario
     * @param $user_id
     * @return array
     */
    public function get_roles_user($user_id){
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
    
    public function getRolesInUser($user_id,$company_id) {
        $result=$this->select('access_control_hierarchies.id,access_control_roles.name as role_name,access_control_hierarchies.access_control_user_id as user_id')
                ->join('access_control_roles','access_control_roles.id=access_control_hierarchies.access_control_role_id')
                ->where("access_control_hierarchies.access_control_user_id", $user_id)
                ->where("access_control_roles.app_company_id", $company_id)
                //->where("isnull(access_control_roles.deleted_at) ")
                ->findAll();
        return($result);
    }
    
    
    public function role_in_user($role_id,$user_id) {
        $result=$this->select('id')
                ->where('access_control_role_id',$role_id)
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

