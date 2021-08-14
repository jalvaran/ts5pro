<?php
/**
 * Pagina para usarse como demostracion o test
 * Julian Alvaran 2021-08-08
 */

namespace Modules\Demo\Controllers;

use App\Controllers\BaseController;
use App\Models\Modules;
use Modules\Demo\Models\Customers;
use App\Controllers\FunctionsTS;


@session_start();

class Demo extends BaseController{
    
    protected $modules;
    protected $data_template;
    
    public function __construct() {
        $f=new FunctionsTS();
        $_SESSION["DB_CLIENT"]="techno_ts5_pro_900833180";
        $Domain=TS_DOMAIN;     
        $this->modules= new Modules();
        $this->customers= new Customers();
        $this->cachePage(1);
        $this->data_template["template"]="synadmin";
        $this->data_template["page"]="index";
        $this->data_template["data"]["lang"]="es";
        $this->data_template["data"]["path"]=$Domain."/";
        $this->data_template["data"]["favicon"]=$Domain."/companies_logos/1/favicon.png";
        $this->data_template["data"]["menu_logo"]=$Domain."/companies_logos/1/tslogo.png";
        $this->data_template["data"]["page_titulo"]="TS5 PRO Template";
        $this->data_template["data"]["page_content"]="";
        $this->data_template["data"]["menu_title"]=" TS5 PRO ";
        
    }
    public function fercho() {
        $this->cachePage(60);
        $data["page"]="fercho";
        $data["lang"]="es";
        $data["page_title"]="Fercho";
        $data["template"]="synadmin";
        $data["path"]=base_url()."/";
        $data["favicon"]=$data["path"]."companies_logos/1/favicon.png";
        echo view('Modules\Demo\Views\index',$data);
    }
    /**
     * Index de la Página usando smarty
     */    
    public function index(){
        $this->cachePage(1);
        $data["page"]="content_test";
        echo view('Modules\Demo\Views\index',$data);

    }
    
    public function blank() {
        //print(base_url());     
        echo view('Modules\Demo\Views\index',$this->data_template);
    }
    
    public function blank2(){
        $this->cachePage(1);
        $data["page"]="blank";
        echo view('Modules\Demo\Views\index',$data);

    }
    public function show_modules(){
        
        $this->cachePage(1);               
        $modules=$this->modules->findAll();
        $data["cols"]=array(
                        'ID'=>'id',
                        'Nombre'=>'name'            
                    );        
        $data["data"]=$modules;
        $data["template"]="synadmin";
        
        $html_table_modules= view('templates/'.$data["template"].'/table',$data);        
        
        
      
        $options["select"]="id,name";
        $options["where"]=" id>='1' ";
        $options["limit"]=10;
        $options["offset"]=0;
        $list_customers=$this->customers->get_List($options);
        
         
        //$list_customers= $this->customers->findAll();
        $data["cols"]=array(
                        'ID'=>'id',
                        'Nombre'=>'name'
            
                    );        
        $data["data"]=$list_customers;
        $html_table_customers= view('templates/'.$data["template"].'/table',$data);
        $data_card["card_title"]="Clientes";
        $data_card["card_body"]=$html_table_customers;
        $html_card_customers=view('templates/'.$data["template"].'/card',$data_card);
        
        $data_card["card_title"]="Módulos";
        $data_card["card_body"]=$html_table_modules;
        $html_card_modules=view('templates/'.$data["template"].'/card',$data_card);
        $data_div_customers["tags"]=' class="col-md-6" ';
        $data_div_customers["content_div"]=$html_card_customers;
        $html_div_customers=view('templates/'.$data["template"].'/div',$data_div_customers);
        $data_div_modules["tags"]=' class="col-md-6" ';
        $data_div_modules["content_div"]=$html_card_modules;
        $html_div_modules=view('templates/'.$data["template"].'/div',$data_div_modules);
        
        $data_div["tags"]=' class="row" ';
        $data_div["content_div"]=$html_div_customers.$html_div_modules;
        $html_div_row=view('templates/'.$data["template"].'/div',$data_div);
        
        $data["lang"]="es";
        $data["path"]=base_url()."/";
        $data["favicon"]=$data["path"]."companies_logos/1/favicon.png";
        $data["menu_logo"]=$data["path"]."companies_logos/1/tslogo.png";
        $data["page_titulo"]="TS5 PRO Template";
        $data["page_content"]=$html_div_row;
        $data["menu_title"]=" TS5 PRO ";
        $data["page"]="lists";
        echo view('Modules\Demo\Views\index',$data);
    }
    
    
    
}