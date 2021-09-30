<?php

namespace App\Modules\TS5\Controllers;

use App\Modules\TS5\Libraries\Session;
use App\Controllers\BaseController;

use CodeIgniter\API\ResponseTrait;

class FormsSearchers extends BaseController
{
    use ResponseTrait;
    private $session;

    function __construct()
    {

        $this->session = new Session();
    }

    public function municipalities_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');
        
        $key=$request->getVar('q');

        $text="CONCAT(app_cat_municipalities.name,' || ',app_cat_departments.name)";
        $model_class=model('App\Modules\Access\Models\Municipalities');
        $model_class->select("app_cat_municipalities.id,{$text} as text");
        $model_class->join('app_cat_departments','app_cat_municipalities.department_id=app_cat_departments.id');
        $k=0;
        if($key<>''){
            
            $model_class->like("app_cat_municipalities.name",$key);
            $model_class->orWhere("app_cat_municipalities.id",$key);
        }
        
        $results=$model_class->orderBy('app_cat_municipalities.name ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }
    
    public function type_organization_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');
        
        $key=$request->getVar('q');

        $text="name";
        $model_class=model('App\Modules\Access\Models\TypeOrganizations');
        $model_class->select("id,{$text} as text");
        
        $k=0;
        if($key<>''){
            
            $model_class->like("name",$key);
            $model_class->orWhere("id",$key);
        }
        
        $results=$model_class->orderBy('name ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }
    
    public function type_regimes_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');
        
        $key=$request->getVar('q');

        $text="name";
        $model_class=model('App\Modules\Access\Models\TypeRegimes');
        $model_class->select("id,{$text} as text");
        
        $k=0;
        if($key<>''){
            
            $model_class->like("name",$key);
            $model_class->orWhere("id",$key);
        }
        
        $results=$model_class->orderBy('name ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }
    
    public function type_document_identification_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');
        
        $key=$request->getVar('q');

        $text="CONCAT(name,' || ',id)";
        $model_class=model('App\Modules\Access\Models\TypeDocumentsIdentifications');
        $model_class->select("id,{$text} as text");
        
        $k=0;
        if($key<>''){
            
            $model_class->like("name",$key);
            $model_class->orWhere("id",$key);
        }
        
        $results=$model_class->orderBy('id ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }

    public function type_liabilities_searches(){
        if (!$this->session->get_LoggedIn()){
            $error[0]["id"]="";
            $error[0]["text"]=lang('Access.access_no_logged_in');
            return $this->setResponseFormat('json')->respond($error);
        }

        $request = service('request');
        
        $key=$request->getVar('q');

        $text="CONCAT(name,' || ',id)";
        $model_class=model('App\Modules\Access\Models\TypeLiabilities');
        $model_class->select("id,{$text} as text");
        
        $k=0;
        if($key<>''){
            
            $model_class->like("name",$key);
            $model_class->orWhere("id",$key);
        }
        
        $results=$model_class->orderBy('id ASC')->findAll(100);

        return $this->setResponseFormat('json')->respond($results);

    }


}