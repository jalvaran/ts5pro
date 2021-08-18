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

use App\Modules\Access\Models\UsersCompanies;
use App\Modules\Access\Models\Herarchies;
use App\Modules\Access\Models\CompaniesModules;

class Access{
    /**
     * Obtiene las empresas asociadas a un usuario
     * @param $user_id
     * @return array
     */
    public function get_UserCompanies($user_id){
        $UsersCompanies = new UsersCompanies();
        return($UsersCompanies->get_UserCompanies($user_id));
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

