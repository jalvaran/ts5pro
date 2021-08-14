<?php

//Tabla= customers
//File = Customers.php

namespace Modules\Demo\Models;

use CodeIgniter\Model;

class Customers extends Model{
    
    protected $table      = 'customers';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    protected $cache_time="10"; 
    protected $DBGroup = "techno_client"; 

    
    /**
     * Obtenga la lista de Clientes
     * @param array $options = array(
     *                              'select' => 'col1,col2' ,
     *                              'where' => 'col1=1 and col2> 1',
     *                              'limit' => 10 ,
     *                              'offset' => 0 ,
     *                          );
     * 
     * @return boolean
     */
    
    public function get_List($options='') {
        if(isset($options["select"])){
            $this->select($options["select"]);
        }
        if(isset($options["where"])){
            $this->where($options["where"]);
        }
        if(isset($options["limit"])){
            if(isset($options["offset"])){
                $this->limit($options["limit"],$options["offset"]);
            }else{
                $this->limit($options["limit"]);
            }
            
        }
        $result=$this->get()->getResultArray();
        
        if(is_array($result)){
            return($result);
        }else{
            return false;
        }
        
    }
    
    
    
    
}

