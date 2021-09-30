
    <div class="row">

        <div class="col-md-12" style="text-align:right;"><br>

                <button class="btn btn-sm btn-light"><?=$info_pagination?></button>
                <button id="previous_page" data-page="<?=$previous_page?>" class="btn btn-white px-2 ms-2 ts_btn_page"><i class="bx bx-chevron-left me-0"></i>
                </button>
                <button id="next_page"  data-page="<?=$next_page?>" class="btn btn-white px-2 ms-2 ts_btn_page"><i class="bx bx-chevron-right me-0"></i>
                </button>

        </div>
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table mb-0 table-hover table-striped">
                <thead>
                <tr>
                    <?php

                    foreach ($cols as $col_name){
                        print('<th scope="col">'.$col_name.'</th>');
                    }

                    ?>

                </tr>
                </thead>
                <tbody>

                <?php

                foreach ($data as $data_col){
                    print('<tr >');
                    $id=$data_col["id"];
                    foreach ($data_col as $key => $value_col){
                        if($key=="id"){
                            print('<td>');
                                if(isset($actions["edit"])){
                                    print('<button data-id="'.$id.'" title="'.lang('msg.btn_title_edit').'" class="btn btn-white ms-2 ts_btn_actions" ><li class="fa fa-edit text-primary"></li>');
                                }
                                if(isset($actions["branches"])){
                                    print('<button data-id="'.$id.'" title="'.lang('msg.btn_title_branch').'" class="btn btn-white ms-2 ts_btn_branches" ><li class="fa fa-crop text-success"></li>');
                                }
                            print('</td>');
                        }
                        if(is_numeric($value_col) and $key<>'phone' and $key<>'telephone' and $key<>'telephone1' and $key<>'telephone2'){
                            print('<td class="ts_col_table" style="cursor:pointer;" data-id="'.$id.'" align="right">'.number_format($value_col).'</td>');
                        }else{
                            print('<td class="ts_col_table" style="cursor:pointer;" data-id="'.$id.'">'.$value_col.'</td>');
                        }
                        
                    }
                    print('</tr>');
                }

                ?>


                </tbody>
            </table>
        </div>
    </div>
