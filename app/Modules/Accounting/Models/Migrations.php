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
 * Modelo para realizar las migraciones del módulo de contabilidad
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-09-13
 * @updated 2021-09-13
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

namespace App\Modules\Accounting\Models;

use CodeIgniter\Model;

class Migrations extends Model
{

    private $forge;
    
    protected $DBGroup = "techno_client";
    
    function __construct() {        
        
        $this->forge = \Config\Database::forge();  
        $this->db  = \Config\Database::connect();
        
    }
    
    public function create_database($db_name)
    {        
        if ($this->forge->createDatabase($db_name,true)) {
            return(true);
        }else{
            return(false);
        }
    }
    
    public function table_accounting_accounts($db_company)
    {     
        $this->db->setDatabase($db_company);
        $attributes = ['ENGINE' => 'InnoDB'];
        
        $fields = [
                    'id'          => [
                            'type'           => 'VARCHAR',
                            'constraint'     => 25,
                            
                    ],
                    'code'       => [
                            'type'           => 'BIGINT',
                            
                    ],
                    'name'       => [
                            'type'           => 'TEXT',
                            
                    ],
                    
                    
                    'author'      => [
                            'type'           =>'VARCHAR',
                            'constraint'     => 25,
                            
                    ],
                    'created_at'      => [
                            'type'           =>'datetime',
                            'null'           => true,
                            
                    ],
                    'updated_at'      => [
                            'type'           =>'datetime',
                            'null'           => true,
                            
                    ],
                    'deleted_at'      => [
                            'type'           =>'datetime',
                            'null'           => true,
                            
                    ],
                    'backed_at'      => [
                            'type'           =>'datetime',
                            'null'           => true,
                            
                    ],
                    
            ];
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id');
        $this->forge->addKey('code');
        $this->forge->createTable('accounting_codes_classes', true, $attributes);
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id');
        $this->forge->addKey('code');
        $this->forge->createTable('accounting_codes_groups', true, $attributes);
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id');
        $this->forge->addKey('code');
        $this->forge->createTable('accounting_codes_subaccounts', true, $attributes);
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id');
        $this->forge->addKey('code');
        $this->forge->createTable('accounting_codes_accounts', true, $attributes);
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id');
        $this->forge->addKey('code');
        $this->forge->createTable('accounting_codes_auxiliaries', true, $attributes);
        $this->db->close();
        
    }
    
    

    

}

