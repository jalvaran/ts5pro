
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
                                if(isset($actions["back"])){                                    
                                    print('<button data-id="'.$id.'" title="'.lang('msg.btn_title_back').'" class="btn btn-white ms-2 ts_btn_back" ><li class="fa fa-reply text-dark"></li></button>');
                                }
                                if(isset($actions["edit"]) and $data_col["status"]==1){
                                    
                                    print('<button data-id="'.$id.'" title="'.lang('msg.btn_title_edit').'" class="btn btn-white ms-2 ts_btn_actions" ><li class="fa fa-edit text-primary"></li></button>');
                                }
                                if(isset($actions["pdf"])){
                                    
                                    print('<a href="'.base_url('inverpacific/business_sheet_pdf/'.$id).'" target="_blank" data-id="'.$id.'" title="'.lang('msg.btn_title_pdf').'" class="btn btn-white ms-2 ts_btn_pdf" ><li class="fa fa-file-pdf text-danger"></li></a>');
                                }
                                if(isset($actions["attachments"])){
                                    
                                    print('<button data-id="'.$id.'" title="'.lang('msg.btn_title_attachments').'" class="btn btn-white ms-2 ts_btn_attachments" ><li class="fa fa-upload text-success"></li></button>');
                                }
                                if(isset($actions["uploads"])){                                    
                                    print('<button data-id="'.$id.'" title="'.lang('msg.btn_title_uploads').'" class="btn btn-white ms-2 ts_btn_uploads" ><li class="fa fa-paperclip text-primary"></li></button>');
                                }
                                if(isset($actions["advance"])){                                    
                                    print('<button data-id="'.$id.'" title="'.lang('msg.btn_title_advance').'" class="btn btn-white ms-2 ts_btn_advance" ><li class="fa fa-share text-dark"></li></button>');
                                }
                                
                                
                            print('</td>');
                        }
                        if(is_numeric($value_col)){
                            $decimals=0;
                            if($key=="tax_percent"){
                                $decimals=2;
                            }                           
                            
                            print('<td class="ts_col_table text-dark" style="cursor:pointer" data-id="'.$id.'" align="right"><span>'.number_format($value_col,$decimals).'</span></td>');
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

