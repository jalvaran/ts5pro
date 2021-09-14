<!--sidebar wrapper -->
<div class="sidebar-wrapper  " data-simplebar="init">
    <div class="sidebar-header ">
            <div>
                    <img src=" <?php echo $menu_logo?>" class="logo-icon" alt="logo icon">
            </div>
            <div>
                    <h4 class="logo-text"><?php echo $menu_title ?></h4>
            </div>
            <div class="toggle-icon ms-auto"><i id="btn_sidebar_menu" class='bx bx-first-page'></i>
            </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">


            <li class="menu-label"><?php
                if(isset($sidebar_title)){
                    echo($sidebar_title);
                }else{
                    echo("Menu");
                }

                ?></li>
            <?php

                if(isset($menu)){

                    if(is_array($menu)){
                        foreach($menu as $key => $data_menu){
                            $company_id = $key;
                            $icon=$data_menu["icon"];
                            if($icon==''){
                                $icon='bx bx-buildings';
                            }
                            print('<li><a href="javascript:;" class="has-arrow">
                                                    <div class="parent-icon"><i class="'.($icon).'" ></i>
                                                    </div>
                                                    <div class="menu-title">'.($data_menu["name"]).'</div>
                                            </a>
                                            <ul>');
                            $name_menu=$data_menu["name"];
                            if(isset($menu_submenu[$company_id])){
                                foreach($menu_submenu[$company_id] as $key2 => $data_sub_menus){
                                    $icon=$data_sub_menus["icon"];
                                    $module_id=$data_sub_menus["module_id"];
                                    if($icon==''){
                                        $icon='bx bx-buildings';
                                    }
                                    print('<li><a href="javascript:;" class="has-arrow">
                                                        <div class="parent-icon"><i class="'.($icon).'" ></i>
                                                        </div>
                                                        <div class="menu-title">'.($data_sub_menus["name"]).'</div>
                                                </a>
                                                <ul>');
                                    if(isset($menu_pages[$module_id])){
                                        foreach($menu_pages[$module_id]  as $data_menu_page){
                                            print('<li> <a href="'.$data_menu_page["link"].'"><i class="'.$data_menu_page["icon"].'"></i>'.$data_menu_page["name"].'</a></li>');
                                        }
                                    }
                                    print('</ul></li>');
                                    //print('<li> <a href="'.$data_sub_menus["link"].'"><i class="'.$data_sub_menus["icon"].'"></i>'.$data_sub_menus["name"].'</a></li>');
                                }
                            }
                        print('</ul></li>');
                        }
                    }
                }

            ?>


    </ul>

<!--end navigation-->

</div>
 <!--end sidebar wrapper -->