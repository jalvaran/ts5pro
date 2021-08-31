<?php

    use App\Libraries\Session;
    use App\Modules\TS5\Libraries\Ts5_class;
    $session = new Session();

    $mUserCompanies=model('App\Modules\Access\Models\UsersCompanies');
    $ts5=new Ts5_class();
    $data_template["data_template"]=$ts5->getDataTemplate($session);


    $data_template["view_path"]=$views_path;


    $user_id=$session->get('user');
    $page_content="";

    $data_template["page_title"] = lang('Menu.page_title_index');

    $data_template["module_name"] = "Menu";
    $data["data_template"]=$data_template["data_template"];
    if($mUserCompanies->validate_user_company($user_id,$company_id)==false){
        $page_content=view($views_path_module.'\Modules\View\deny',$data_template);
    }else{
        $mComponents=model('App\Modules\Access\Models\ModulesComponents');
        $Components=$mComponents->get_ModulesComponents($module_id);

        foreach ($Components as $data_module) {
            $data_template["link"] = base_url("/".$data_module["alias"]."/" . $data_module["controller"]."/".$company_id);
            $data_template["card_title"] = lang('Menu.card_title_component_'.$data_module["id"]);
            $data_template["card_sub_title"] = lang('Menu.card_sub_title_component_'.$data_module["id"]);
            $data_template["card_num_cols"] = "3";

            $data_template["card_icon_menu"] = "bx bx-shape-square";
            $data_template["company_nit"] ="";
            $page_content .= (view($views_path . '\card_menu_submenu', $data_template));
        }


    }
    $data=$data_template["data_template"];
    $data["page_content"]=$page_content;
    $data2 = array_merge($data, $data_template);

    echo (view($views_path . '\blank',$data2));





