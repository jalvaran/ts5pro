<?php
    use App\Modules\TS5\Libraries\Session;
    use App\Modules\TS5\Libraries\Ts5_class;

/**
 * Funcion para construir el json del menu lateral
 * @param $user_id
 */
function create_json_menu($user_id){
    $session = new Session();
    $mCompanies=model('App\Modules\Access\Models\UsersCompanies');
    $mCompaniesModules=model('App\Modules\Access\Models\CompaniesModules');
    $mModulesComponents=model('App\Modules\Access\Models\ModulesComponents');
    $companies=$mCompanies->get_UserCompanies($user_id);

    $menu=[];
    $submenu=[];
    $pages=[];

    foreach($companies as $data_company){
        $company_id=$data_company["id"];
        $menu[$company_id]["id"]=$company_id;
        $menu[$company_id]["identification"]=$data_company["identification"];
        $menu[$company_id]["name"]=$data_company["name"];
        $menu[$company_id]["description"]=$data_company["description"];
        $menu[$company_id]["icon"]=$data_company["icon"];
        $menu[$company_id]["link"]=base_url("/menu/modules/" . $data_company["id"]);
        $modules=$mCompaniesModules->get_CompaniesModules($data_company["id"]);

        $j=0;
        foreach($modules as $data_module){
            $module_id=$data_module["id"];
            $submenu[$company_id][$j]["id"]=$module_id;
            $submenu[$company_id][$j]["module_id"]=$module_id;
            $submenu[$company_id][$j]["name"]=$data_module["name"];
            $submenu[$company_id][$j]["description"]=$data_module["description"];
            $submenu[$company_id][$j]["icon"]=$data_module["icon"];
            $submenu[$company_id][$j]["link"]=base_url("/menu/modules/$company_id/" . $data_module["id"]);
            $j++;
            $z=0;
            $components=$mModulesComponents->get_ModulesComponents($data_module["id"]);
            foreach($components as $data_module){
                $pages[$module_id][$z]["link"]=base_url("/".$data_module["alias"]."/" . $data_module["controller"]."/".$company_id);
                $pages[$module_id][$z]["name"]=lang('Menu.card_title_component_'.$data_module["id"]);
                $pages[$module_id][$z]["description"]=lang('Menu.card_sub_title_component_'.$data_module["id"]);
                $pages[$module_id][$z]["icon"]='bx bx-arrow-to-right';
                $pages[$module_id][$z]["alias"]=$data_module["alias"];
                $pages[$module_id][$z]["id"]=$data_module["id"];
                $pages[$module_id][$z]["controller"]=$data_module["controller"];
                $z++;
            }

        }
    }

    $json_menu=json_encode($menu);
    $json_sub_menu=json_encode($submenu);
    $json_menu_pages=json_encode($pages);

    $session->set('json_menu',$json_menu);
    $session->set('json_sub_menu',$json_sub_menu);
    $session->set('json_menu_pages',$json_menu_pages);

}

    $session = new Session();
    $user_id=$session->get('user');
    $ts5=new Ts5_class();
    create_json_menu($user_id);
    $data_template["data_template"]=$ts5->getDataTemplate($session);
    $data=$data_template["data_template"];

    $data_template["view_path"]=$views_path;



    $companies=$data["menu"];
    $page_content="";
    $data_template["page_title"] = lang('Menu.page_title_index');

    $data_template["module_name"] = "Menu";
    foreach ($companies as $data_company) {
        $data_template["link"] = base_url("/menu/modules/" . $data_company["id"]);
        $data_template["card_title"] = $data_company["name"];
        $data_template["card_sub_title"] = $data_company["description"];
        $data_template["card_num_cols"] = "3";
        if ($data_company["icon"] == '') {
            $data_company["icon"] = "bx bx-buildings";
        }
        $data_template["card_icon_menu"] = $data_company["icon"];
        $data_template["company_nit"] = $data_company["identification"];
        $page_content .= (view($views_path . '\card_menu_submenu', $data_template));
    }

    $data["page_content"]=$page_content;
    $data["data_template"]=$data_template["data_template"];

    echo (view($views_path . '\blank',$data));
