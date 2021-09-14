
    <div class="customers-list ps--active-y">
        <div class="row" style="text-align: center">
            <h5 class="mb-0"><?=lang('admin.user_roles_list')?></h5>
        </div>
        <hr class="my-4">

        <?php

            foreach ($data_roles as $key => $data_role){
                print('<div class="customers-list-item d-flex align-items-center border-top border-bottom p-2 cursor-pointer">

                            <div class="ms-2">
                                <h6 class="mb-1 font-14">'.$data_role["role_name"].'</h6>
                                
                            </div>
                            <div class="list-inline d-flex customers-contacts ms-auto">	
                                
                                <a href="javascript:;" title="'.lang("admin.delete").'" data-user_id="'.$data_role["user_id"].'" data-id="'.$data_role["id"].'" class="list-inline-item ts_btn_delete"><i class="bx bx-trash rounded text-danger"></i></a>
                            </div>
                        </div>');
            }

        ?>
    </div>