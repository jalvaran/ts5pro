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
 * Este archivo contiene el controlador para el modulo de creación de empresas
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-08-26
 * @updated 2021-08-26
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */
namespace App\Modules\Accounting\Controllers;

use App\Modules\TS5\Libraries\Session;
use App\Controllers\BaseController;
use App\Modules\TS5\Libraries\Ts5_class;

class MigrationsController extends BaseController
{

    private $session;
    private $module_id;
    private $views_path;
    private $views_path_module;

    function __construct()
    {
        $this->views_path='App\Modules\TS5\Views\templates\synadmin';
        $this->views_path_module='App\Modules\Accounting\Views';
        $this->module_id="613784ab2471f217811476";
        $this->session = new Session();
        
    }

        
    function migrations($company_id) {
        if (!$this->session->get_LoggedIn()) {
            return (redirect()->to(base_url('/ts5/signin')));
        }
        
        $ts5=new Ts5_class();
        
        $permission_id='61401c0c9123a794188707';
        $module_id=$this->module_id;
        
        $mCompanies=model('App\Modules\Access\Models\Companies');        
        $db_company=$mCompanies->get_database($company_id);
        
        $this->session->set("DB_CLIENT", $db_company);
        $mMigratios=model('App\Modules\Accounting\Models\Migrations');
        $result=$mMigratios->create_database($db_company);
        
        if($result==true){
            echo("Database Created");
        }else{
            echo("Database no Created");
        }
        $mMigratios->table_accounting_accounts($db_company);
        
        return("<br>".$company_id." ".$db_company);
    }





}