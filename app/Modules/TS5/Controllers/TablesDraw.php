<?php

namespace App\Modules\TS5\Controllers;

use App\Libraries\Session;
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



}