<?php

namespace App\Modules\Inverpacific\Controllers;

use App\Modules\TS5\Libraries\Session;
use App\Controllers\BaseController;

use CodeIgniter\API\ResponseTrait;

class InverPacificSearches extends BaseController
{
    use ResponseTrait;
    private $session;

    function __construct()
    {

        $this->session = new Session();
    }
    /**
     * Busqueda de un tercero retorna un json para un select 2 
     * @return type
     */
    public function thirds_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');
        
        $key=$request->getVar('q');

        $text="CONCAT(name,' || ',identification)";
        $model_class=model('App\Modules\TS5\Models\Thirds');
        $model_class->select("id,{$text} as text");
        
        $k=0;
        if($key<>''){
            
            $model_class->like("name",$key);
            $model_class->orWhere("identification",$key);
            
        }
        
        $results=$model_class->orderBy('name ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }
    /**
     * Busqueda de los tipos de hoja de negocio, retorna json para select2
     * @return type
     */
    public function type_sheets_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');
        
        $key=$request->getVar('q');

        $text="name";
        $model_class=model('App\Modules\Inverpacific\Models\BusinessSheetsTypes');
        $model_class->select("id,{$text} as text");
        
        $k=0;
        if($key<>''){
            
            $model_class->like("name",$key);
            $model_class->orWhere("id",$key);
        }
        
        $results=$model_class->orderBy('name ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }
    /**
     * Busqueda de las financieras que se manejan en las hojas de negocio
     * @return type
     */
    public function financials_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');
        
        $key=$request->getVar('q');

        $text="name";
        $model_class=model('App\Modules\Inverpacific\Models\BusinessSheetFinancials');
        $model_class->select("id,{$text} as text");
        
        $k=0;
        if($key<>''){
            
            $model_class->like("name",$key);
            $model_class->orWhere("id",$key);
        }
        
        $results=$model_class->orderBy('name ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }
    
    /**
     * Busqueda de las financieras que se manejan en las hojas de negocio
     * @return type
     */
    public function trademarks_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');
        
        $key=$request->getVar('q');

        $text="name";
        $model_class=model('App\Modules\Inverpacific\Models\Trademarks');
        $model_class->select("id,{$text} as text");
        
        $k=0;
        if($key<>''){
            
            $model_class->like("name",$key);
            $model_class->orWhere("id",$key);
        }
        
        $results=$model_class->orderBy('name ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }
    
    
}