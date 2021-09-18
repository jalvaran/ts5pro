
    <div class="customers-list ps--active-y">
        <div class="row" style="text-align: center">
            <h5 class="mb-0"><?=lang('admin.branches_user_list')?></h5>
        </div>
        <hr class="my-4">

        <?php

            foreach ($data_branches as $key => $data_branch){
                print('<div class="customers-list-item d-flex align-items-center border-top border-bottom p-2 cursor-pointer">

                            <div class="ms-2">
                                <h6 class="mb-1 font-14">'.$data_branch["branch_name"].'</h6>
                                
                            </div>
                            <div class="list-inline d-flex customers-contacts ms-auto">	
                                
                                <a href="javascript:;" title="'.lang("admin.delete").'" data-user_id="'.$data_branch["user_id"].'" data-id="'.$data_branch["id"].'" class="list-inline-item ts_btn_delete"><i class="bx bx-trash rounded text-danger"></i></a>
                            </div>
                        </div>');
            }

        ?>
    </div>