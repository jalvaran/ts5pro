<?php

    use App\Libraries\Session;
    use App\Modules\TS5\Libraries\Ts5_class;
    $session = new Session();

    $mUserCompanies=model('App\Modules\Access\Models\UsersCompanies');
    $ts5=new Ts5_class();
    $data_template["data_template"]=$ts5->getDataTemplate($company_id);


    $data_template["view_path"]=$views_path;
    $data=$data_template["data_template"];

    $user_id=$session->get('user');
    $page_content="";

    $data_template["page_title"] = lang('Menu.page_title_index');

    $data_template["module_name"] = "Menu";
    $data["data_template"]=$data_template["data_template"];

    if($mUserCompanies->validate_user_company($user_id,$company_id)==false){
        $page_content=view($views_path_module.'\Modules\View\deny',$data_template);
    }else{

        $Modules=$data["menu_submenu"][$company_id];

        foreach ($Modules as $data_module) {
            $data_template["link"] = base_url("/menu/components/$company_id/" . $data_module["id"]);
            $data_template["card_title"] = $data_module["name"];
            $data_template["card_sub_title"] = $data_module["description"];
            $data_template["card_num_cols"] = "3";
            if ($data_module["icon"] == '') {
                $data_module["icon"] = "bx bx-buildings";
            }
            $data_template["card_icon_menu"] = $data_module["icon"];
            $data_template["company_nit"] ="";
            $page_content .= (view($views_path . '\card_menu_submenu', $data_template));
        }


    }

    $data["page_content"]=$page_content;


    echo (view($views_path . '\blank',$data));





