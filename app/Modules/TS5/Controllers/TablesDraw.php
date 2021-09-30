<?php

namespace App\Modules\TS5\Controllers;

use App\Modules\TS5\Libraries\Session;
use App\Controllers\BaseController;
use App\Modules\TS5\Libraries\Ts5_class;

class TablesDraw extends BaseController
{
    private $session;
    private $views_path;
    private $views_path_module;

    function __construct()
    {
        $this->views_path='App\Modules\TS5\Views\templates\synadmin';
        $this->views_path_module='App\Modules\Access\Views\Users';
        $this->session = new Session();
    }


    public function index()
    {
        if (!$this->session->get_LoggedIn()) {
            return (redirect()->to(base_url('/ts5/signin')));
        } else {
            return (redirect()->to(base_url('/menu')));
        }
    }

    public function tables_draw($data_table,$table_id)
    {
        $user_id=$this->session->get('user');
        $company_id=$this->session->get('company_id');
        $array_data_table=json_decode(base64_decode(urldecode($data_table)),true);
        $model=$array_data_table["model"];

        $mUsers=model('App\Modules\Access\Models\Users');

        $p_single=$mUsers->has_Permission($user_id,$array_data_table["permissions"]["list"],$company_id,$array_data_table["module_id"]);

        if(!$p_single){
            $data["error_title"]=lang('Access.access_view_error_title');
            $data["msg_error"]=lang('Access.access_view_error');
            return(view($this->views_path."\alert_error",$data));
        }

        $model = model($model);
        $data['fields']=$model->allowedFields;
        $data['data_model'] ='';
        $data['table_id']=$table_id;
        $data['data_table']=$data_table;
        $html= view('App\Modules\TS5\Views\templates\synadmin\data_table2', $data);
        return($html);
    }

    public function frm_tables_draw($id,$data_table)
    {
        $user_id=$this->session->get('user');
        $company_id=$this->session->get('company_id');
        $array_data_table=json_decode(base64_decode(urldecode($data_table)),true);


        $mUsers=model('App\Modules\Access\Models\Users');

        $p_single=$mUsers->has_Permission($user_id,$array_data_table["permissions"]["create"],$company_id,$array_data_table["module_id"]);

        if(!$p_single){
            $data["error_title"]=lang('Access.access_view_error_title');
            $data["msg_error"]=lang('Access.access_view_error');
            return(view($this->views_path."\alert_error",$data));
        }
        $html="";
        $model_table=$array_data_table["model"];

        $model = model($model_table);
        $fields=$model->allowedFields;
        $table=$model->table;
        $html_fields='';
        $data_register=$model->where('id',$id)->first();

        foreach($fields as $field => $value){
            if($value<>'author' and $value<>'id' and $value<>'backed_at'){
                $data_field["div_class"]="col-4";
                $data_field["id"]=$value;
                $data_field["label"]=lang('fields.'.$value);
                $data_field["placeholder"]=$data_field["label"];
                $data_field["value"]="";

                if(isset($data_register[$value])){
                    $data_field["value"]=$data_register[$value];
                }

                $data_field["type"]="text";
                if(isset($array_data_table["fields"][$value]["type"])){
                    $data_field["type"]=$array_data_table["fields"][$value]["type"];
                }

                if($data_field["type"]=='textarea'){
                    $html_fields.=view('App\Modules\TS5\Views\templates\synadmin\frm_input_textarea',$data_field);
                }else if($data_field["type"]=='select2'){
                    $data_field["model"]="";
                    if(isset($array_data_table["fields"][$value]["model"])){
                        $data_field["model"]=$array_data_table["fields"][$value]["model"];

                    }
                    $data_field["labels"]="";
                    if(isset($array_data_table["fields"][$value]["labels"])){
                        $data_field["labels"]=$array_data_table["fields"][$value]["labels"];
                    }
                    $data_field["data_table"]=$data_table;
                    if(isset($data_register[$value])){
                        $data_field["options"][0]["value"]=$data_register[$value];
                        $model_select=model($array_data_table["fields"][$value]["model"]);
                        $data_model=$model_select->select($data_field["labels"])->where('id',$data_register[$value])->first();
                        $text="";
                        foreach($data_model as $label){
                            $text.=$label." ";
                        }
                        $data_field["options"][0]["label"]=$text;
                    }

                    $html_fields.=view('App\Modules\TS5\Views\templates\synadmin\frm_select2',$data_field);
                }else{
                    $html_fields.=view('App\Modules\TS5\Views\templates\synadmin\frm_input',$data_field);
                }

            }

        }
        $data_card["div_form_class"]="col-12";
        $data_card["form_icon"]="fa fa-list-alt";
        $data_card["form_color"]="primary";
        $data_card["form_title"]=lang('tables.'.$table);
        $data_card["form_body"]=$html_fields;
        $html.=view('App\Modules\TS5\Views\templates\synadmin\frm_card',$data_card);
        //print_r($fields);
        return($html);

    }

    /**
     * Dibuja el listado de terceros
     * @return type
     */
    public function thirds_draw() {
        $request=service('request');
        $company_id=$this->session->get('company_id');
        $mUsers=model('App\Modules\Access\Models\Users');
        $user_id=$this->session->get('user');
        $module_id='613784ab2471f217811472';                       
          
        $permission_id="61533883cbabd775315806";
        if(!$mUsers->has_Permission($user_id,$permission_id,$company_id,$module_id)){
            $data_error["error_title"]=lang('Access.access_view_error_title');
            $data_error["msg_error"]=lang('Access.access_view_error');
            return (view($this->views_path."\alert_error",$data_error));

        }

        $i=0;
        $limit=20;

        $data["cols"][$i++]=lang("fields.actions");
        $data["cols"][$i++]=lang("fields.id");
        $data["cols"][$i++]=lang("fields.name");
        $data["cols"][$i++]=lang("fields.identification");
        $data["cols"][$i++]=lang("fields.dv");
        $data["cols"][$i++]=lang("fields.type_organization_name");
        $data["cols"][$i++]=lang("fields.type_regime_name");
        $data["cols"][$i++]=lang("fields.type_liabilitie_name");
        $data["cols"][$i++]=lang("fields.type_document_identification_name");        
        $data["cols"][$i++]=lang("fields.municipalities_name");
        $data["cols"][$i++]=lang("fields.departments_name");
        $data["cols"][$i++]=lang("fields.address");
        $data["cols"][$i++]=lang("fields.telephone1");
        $data["cols"][$i++]=lang("fields.telephone2");
        $data["cols"][$i++]=lang("fields.mail");
        $data["cols"][$i++]=lang("fields.created_at");
        
        $page=$request->getVar('page');
        $search=$request->getVar('search');
        $fields=array(  'id',
                        'name',
                        'identification',
                        'dv',
                        'type_organization_name',
                        'type_regime_name',
                        'type_liabilitie_name',
                        'type_document_identification_name',
                        'municipalities_name',
                        'departments_name',
                        'address',
                        'telephone1',
                        'telephone2',
                        'mail',
                        'created_at',    
                        
            
            );
        
        $model=model('App\Modules\TS5\Models\ViewThirds');
                
        $model->select($fields);
                
        //$model->where('author',$user_id);   //Por si se quiere que solo se vean los negocios del mismo usuario
        $recordsTotal = $model->countAllResults(false);
        
        $z=0;
       
        if($search<>''){
            foreach ($fields as $field){

                if($z==0){
                    $z=1;
                    $model->like($field, $search);
                }else{
                    $model->orLike($field, $search);
                }

            }
        }
         
        
        $recordsFiltered = $model->countAllResults(false);
        $totalPages= ceil($recordsFiltered/$limit);
        if($page>1){
            $previous_page=$page-1;
        }else{
            $previous_page=1;
        }
        $next_page=$page;
        $start_point=round($page * $limit - $limit);
        if($recordsFiltered>($start_point+$limit)){
            $next_page=$page+1;
        }
        $model->orderBy('id DESC');
        $response=$model->findAll($limit,$start_point);
        
        //print($model->getCompiledSelect());
        //print_r($response);
        $info=lang("msg.info");
        $info=str_replace("_START_",$page,$info);
        $info=str_replace("_END_",$totalPages,$info);
        $info=str_replace("_TOTAL_",$recordsTotal,$info);
        $data["info_pagination"]=$info;
        $data["previous_page"]=$previous_page;
        $data["next_page"]=$next_page;

        $data["actions"]["edit"]=1;
        $data["data"]=$response;
        echo view($this->views_path.'\table_list',$data);
    }    
    

}