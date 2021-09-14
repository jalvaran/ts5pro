
    <div class="customers-list ps--active-y">
        <div class="row" style="text-align: center">
            <h5 class="mb-0"><?=lang('admin.role_permissions_list')?></h5>
        </div>
        <hr class="my-4">

        <?php

            foreach ($data_permissions as $key => $data_permission){
                print('<div class="customers-list-item d-flex align-items-center border-top border-bottom p-2 cursor-pointer">

                            <div class="ms-2">
                                <h6 class="mb-1 font-14">'.$data_permission["permission_name"].'</h6>
                                <p class="mb-0 font-13 text-secondary">'.$data_permission["role_name"].'</p>
                            </div>
                            <div class="list-inline d-flex customers-contacts ms-auto">	
                                
                                <a href="javascript:;" title="'.lang("admin.delete").'" data-role_id="'.$data_permission["role_id"].'" data-id="'.$data_permission["id"].'" class="list-inline-item ts_btn_delete"><i class="bx bx-trash rounded text-danger"></i></a>
                            </div>
                        </div>');
            }

        ?>
    </div>