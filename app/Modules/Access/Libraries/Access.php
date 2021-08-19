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
 * @created 2021-08-13
 * @updated 2021-08-14
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

namespace App\Modules\Access\Libraries;

use App\Libraries\Session;
use App\Modules\Access\Models\UsersCompanies;
use App\Modules\Access\Models\Herarchies;
use App\Modules\Access\Models\CompaniesModules;
use App\Modules\Access\Models\ModulesComponentsPermissions;
use App\Modules\Access\Models\ModulesComponents;

class Access{

    private $session;
    private $user_id;

    public function __construct(){
        $this->session = new Session();
        $this->user_id = $this->session->get('user');
    }

    public function validate_access_permission($user_id,$company_id='',$module_id='',$component_id='',$permission_id=''){
        if (!$this->session->get_LoggedIn()) {
            return ('E1'); //El usuario no tiene una sesión activa
        }
        if($company_id<>''){
            if (!$this->validate_user_company($user_id, $company_id)) {
                return ('E2'); //E2 el usuario no está asignado a la empresa enviada
            }
        }
        if($module_id<>''){

            if($this->module_in_company($company_id,$module_id)==false){
                return ('E6'); //E6 el módulo no está asignado a la empresa enviada
            }

            $roles_user=$this->get_roles_user($user_id);
            if(!isset($roles_user[0]["id"])){
                return('E3'); //E3 el usuario no tiene roles asignados
            }
            $error_module=1;
            $error_component=1;
            foreach($roles_user as $role_id){
                if($this->validate_module_role($role_id["id"],$module_id)==true){
                    $error_module=0;
                }
                if($component_id<>'' and $permission_id<>''){
                    if($this->validate_permission_component($role_id["id"],$module_id,$component_id,$permission_id)==true){
                        $error_component=0;
                    }
                }else{
                    $error_component=0;
                }


            }
            if($error_module==1){
                return('E4');// el usuario no tiene el módulo enviado asignado
            }
            if($error_component==1){
                return('E5');// el usuario no tiene permiso para ejecutar la acción solicitada en el componente enviado
            }


        }
        return("OK");

    }

    public function validate_permission_component($role_id,$module_id,$component_id,$permission_id)
    {
        $mModulesComponentsPermissions = new ModulesComponentsPermissions();
        return $mModulesComponentsPermissions->validate_permission_component($role_id,$module_id,$component_id,$permission_id);
    }

    /**
     * Retorna los componentes de un módulo
     * @param $module_id
     * @return mixed
     */
    public function get_ModulesComponents($module_id){
        $mModulesComponents = new ModulesComponents();
        return($mModulesComponents->get_ModulesComponents($module_id));
    }

    /**
     * valida si un role tiene un modulo asignado
     * @param $role_id
     * @param $module_id
     * @return bool
     */

    public function validate_module_role($role_id,$module_id)
    {
        $mModulesComponentsPermissions = new ModulesComponentsPermissions();
        return $mModulesComponentsPermissions->validate_module_role($role_id,$module_id);
    }

    /**
     * retorna los roles de un usuario
     * @param $user_id
     * @return array
     */

    public function get_roles_user($user_id){
        $mHerarchies = new Herarchies();
        return($mHerarchies->get_roles_user($user_id));
    }

    /**
     * Obtiene las empresas asociadas a un usuario
     * @param $user_id
     * @return array
     */
    public function get_UserCompanies($user_id){
        $UsersCompanies = new UsersCompanies();
        return($UsersCompanies->get_UserCompanies($user_id));
    }

    public function module_in_company($company_id,$module_id){
        $mCompaniesModules = new CompaniesModules();
        return($mCompaniesModules->module_in_company($company_id,$module_id));
    }

    /**
     * Obtiene las empresas asociadas a un usuario
     * @param $company_id
     * @return array
     */
    public function get_CompaniesModules($company_id){
        $mCompaniesModules = new CompaniesModules();
        return($mCompaniesModules->get_CompaniesModules($company_id));
    }

    /**
     * retorna las empresas asignadas a un usuario
     * @param $user_id
     * @param $company_id
     * @return bool
     */
    public function validate_user_company($user_id,$company_id){
        $UsersCompanies = new UsersCompanies();
        return($UsersCompanies->validate_user_company($user_id,$company_id));
    }

    /**
     * Valida si el usuario es super administrador
     * @param $user_id
     * @return bool
     */
    public function is_super_admin($user_id){
        $mHerarchie= new Herarchies();
        return($mHerarchie->is_super_admin($user_id));
    }


}

