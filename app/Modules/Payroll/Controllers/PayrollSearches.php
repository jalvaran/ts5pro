<?php

namespace App\Modules\Payroll\Controllers;

use App\Modules\TS5\Libraries\Session;
use App\Controllers\BaseController;

use CodeIgniter\API\ResponseTrait;

class PayrollSearches extends BaseController
{
    use ResponseTrait;
    private $session;

    function __construct()
    {

        $this->session = new Session();
    }
    /**
     * Busqueda de un tipo de trabajador retorna un json para un select 2 
     * @return type
     */
    public function type_worker_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');
        
        $key=$request->getVar('q');

        $text="name";
        $model_class=model('App\Modules\Payroll\Models\TypeWorkers');
        $model_class->select("id,{$text} as text");
        
        $k=0;
        if($key<>''){
            
            $model_class->like("name",$key);
                        
        }
        
        $results=$model_class->orderBy('name ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }
    
    /**
     * Busqueda de un subtipo de trabajador retorna un json para un select 2 
     * @return type
     */
    public function subtype_worker_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');
        
        $key=$request->getVar('q');

        $text="name";
        $model_class=model('App\Modules\Payroll\Models\SubTypeWorkers');
        $model_class->select("id,{$text} as text");
        
        $k=0;
        if($key<>''){
            
            $model_class->like("name",$key);
                        
        }
        
        $results=$model_class->orderBy('name DESC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }
    
    /**
     * Busqueda de un grupo en la compañia retorna un json para un select 2 
     * @return type
     */
    public function company_groups_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');
        
        $key=$request->getVar('q');

        $text="name";
        $model_class=model('App\Modules\Payroll\Models\CompanyGroups');
        $model_class->select("id,{$text} as text");
        
        $k=0;
        if($key<>''){
            
            $model_class->like("name",$key);
                        
        }
        
        $results=$model_class->orderBy('name ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }
    
    
    /**
     * Busqueda de un cargo de empresa retorna un json para un select 2 
     * @return type
     */
    public function employees_position_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');
        
        $key=$request->getVar('q');

        $text="name";
        $model_class=model('App\Modules\Payroll\Models\EmployeesPositions');
        $model_class->select("id,{$text} as text");
        
        $k=0;
        if($key<>''){
            
            $model_class->like("name",$key);
                        
        }
        
        $results=$model_class->orderBy('name ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }
    
    
    /**
     * Busqueda de un tipo de contrato retorna un json para un select 2 
     * @return type
     */
    public function type_contract_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');
        
        $key=$request->getVar('q');

        $text="name";
        $model_class=model('App\Modules\Payroll\Models\TypeContracts');
        $model_class->select("id,{$text} as text");
        
        $k=0;
        if($key<>''){
            
            $model_class->like("name",$key);
                        
        }
        
        $results=$model_class->orderBy('name ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }
    
    
    /**
     * Busqueda de un motivo de retiro retorna un json para un select 2 
     * @return type
     */
    public function reasons_withdrawal_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');
        
        $key=$request->getVar('q');

        $text="name";
        $model_class=model('App\Modules\Payroll\Models\ReasonsWithdrawal');
        $model_class->select("id,{$text} as text");
        
        $k=0;
        if($key<>''){
            
            $model_class->like("name",$key);
                        
        }
        
        $results=$model_class->orderBy('name ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }
    
    /**
     * Busqueda de las eps retorna un json para un select 2 
     * @return type
     */
    public function eps_code_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');
        
        $key=$request->getVar('q');

        $text="name";
        $model_class=model('App\Modules\Payroll\Models\HealthAdministrators');
        $model_class->select("code as id,{$text} as text");
        $model_class->where('type_administrator_id','1');
        $k=0;
        if($key<>''){
            
            $model_class->like("alias",$key);
                        
        }
        
        $results=$model_class->orderBy('name ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }
    
    /**
     * Busqueda de los fondos de pensiones retiro retorna un json para un select 2 
     * @return type
     */
    public function afp_code_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');
        
        $key=$request->getVar('q');

        $text="name";
        $model_class=model('App\Modules\Payroll\Models\HealthAdministrators');
        $model_class->select("code as id,{$text} as text");
        $model_class->where('type_administrator_id','2');
        $k=0;
        if($key<>''){
            
            $model_class->like("name",$key);
                        
        }
        
        $results=$model_class->orderBy('name ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }
    
    /**
     * Busqueda de las ARL retorna un json para un select 2 
     * @return type
     */
    public function arl_code_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');
        
        $key=$request->getVar('q');

        $text="name";
        $model_class=model('App\Modules\Payroll\Models\HealthAdministrators');
        $model_class->select("code as id,{$text} as text");
        $model_class->where('type_administrator_id','3');
        $k=0;
        if($key<>''){
            
            $model_class->like("name",$key);
                        
        }
        
        $results=$model_class->orderBy('name ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }
    
    /**
     * Busqueda de las CAJAS DE COMPENSACION FAMILIAR retorna un json para un select 2 
     * @return type
     */
    public function ccf_code_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');
        
        $key=$request->getVar('q');

        $text="name";
        $model_class=model('App\Modules\Payroll\Models\HealthAdministrators');
        $model_class->select("code as id,{$text} as text");
        $model_class->where('type_administrator_id','4');
        $k=0;
        if($key<>''){
            
            $model_class->like("name",$key);
                        
        }
        
        $results=$model_class->orderBy('name ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }
    
    /**
     * Busqueda de los niveles de riesgo de las ARL retorna un json para un select 2 
     * @return type
     */
    public function arl_level_id_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');
        
        $key=$request->getVar('q');

        $text="name";
        $model_class=model('App\Modules\Payroll\Models\ArlLevels');
        $model_class->select("id,{$text} as text");
        
        if($key<>''){
            
            $model_class->like("name",$key);
                        
        }
        
        $results=$model_class->orderBy('name ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }
    
    /**
     * Busqueda de los periodos de pago retorna un json para un select 2 
     * @return type
     */
    public function period_id_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');
        
        $key=$request->getVar('q');

        $text="name";
        $model_class=model('App\Modules\Payroll\Models\Periods');
        $model_class->select("id,{$text} as text");
        
        if($key<>''){
            
            $model_class->like("name",$key);
                        
        }
        
        $results=$model_class->orderBy('name ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }
    
   
}