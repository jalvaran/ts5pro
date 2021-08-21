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

class Users extends Model
{

    protected $table = 'access_control_users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'name',
        'identification',
        'telephone',
        'email',
        'username',
        'password',
        'enabled',
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
     * verifica si existe el usuario y la contraseña
     * @param $username
     * @param $password
     * @return array
     */
    public function get_UserLogin($username, $password)
    {
        $result = $this
            ->select()
            ->where("username", $username)
            ->where("password", $password)
            ->get()
            ->getResultArray();

        return($result);

    }

    /**
     * retorna los roles asignados a un usuario
     * @param $user_id
     * @return array
     */
    public function get_UserRoles($user_id)
    {
        $roles = $this
            ->select('access_control_herarchies.access_control_role_id')
            ->join('access_control_herarchies', 'access_control_herarchies.access_control_user_id=access_control_users.id')
            ->where("access_control_users.id", $user_id)
            ->get()->getResultArray();


        return($result);

    }

    /**
     * Retorna falso o verdadero si el usuario activo ne la sesión es el
     * autor del regsitro que se desea acceder, editar o eliminar.
     * @param type $id codigo primario del registro a consultar
     * @param type $author codigo del usuario del cual se pretende establecer la autoria
     * @return boolean falso o verdadero segun sea el caso
     */
    public function get_Authority($id, $author)
    {
        $row = $this->where("author", $id)->first();
        if (@$row["author"] == $author) {
            return (true);
        } else {
            return (false);
        }
    }

    public function has_Permission($user_id, $permission_id,$company_id)
    {
        $result=$this->select('access_control_users.id')
                ->join('access_control_users_companies','access_control_users_companies.access_control_user_id=access_control_users.id')
                ->join('access_control_herarchies','access_control_herarchies.access_control_user_id=access_control_users.id')
                ->join('access_control_politics','access_control_politics.access_control_role_id=access_control_herarchies.access_control_role_id')
                ->where('access_control_users.id',$user_id)
                ->where('access_control_politics.access_control_permissions_id',$permission_id)
                ->where('access_control_users_companies.app_company',$company_id)
                ->first()
                ;
        if(isset($result["id"])){
            return(true);
        }else{
            return(false);
        }

    }

}

