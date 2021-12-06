
    <div class="row">
        <div class="col-md-3" style="text-align:left;">
            
        </div>
        <div class="col-md-9" style="text-align:right;"><br>

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
                        if($col_name<>'id'){
                            print('<th scope="col">'.$col_name.'</th>');
                        }
                        
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
                                    print('<button data-id="'.$id.'" title="'.lang('msg.btn_title_edit').'" class="btn btn-white ms-2 ts_btn_edit" ><li class="fa fa-edit text-primary"></li></button>');
                                }
                                if(isset($actions["employees"])){                                    
                                    print('<button data-id="'.$id.'" title="'.lang('payroll.btn_title_employees').'" class="btn btn-white ms-2 ts_btn_employees" ><li class="fa fa-users text-success"></li></button>');
                                }
                                if(isset($actions["novelties"])){                                    
                                    print('<button data-id="'.$id.'" title="'.lang('payroll.btn_title_novelties').'" class="btn btn-white ms-2 ts_btn_novelties" ><li class="fa fa-tasks text-dark"></li></button>');
                                }
                                if(isset($actions["generate"])){                                    
                                    print('<button data-id="'.$id.'" title="'.lang('payroll.btn_title_generate').'" class="btn btn-white ms-2 ts_btn_generate" ><li class="fa fa-random text-warning"></li></button>');
                                }
                                if(isset($actions["report"])){                                    
                                    print('<button data-id="'.$id.'" title="'.lang('payroll.btn_title_report').'" class="btn btn-white ms-2 ts_btn_report" ><li class="fa fa-paper-plane text-success"></li></button>');
                                }
                                
                                                                
                                
                            print('</td>');
                        }
                        if(is_numeric($value_col)){
                            $decimals=0;
                            if($key=="tax_percent"){
                                $decimals=2;
                            }                           
                            
                            print('<td class="text-dark" data-id="'.$id.'" align="right"><span>'.number_format($value_col,$decimals).'</span></td>');
                            
                            
                        }else{
                            if($key<>'id'){
                                print('<td  data-id="'.$id.'">'.$value_col.'</td>');
                            }
                            
                        }
                        
                    }
                    print('</tr>');
                }

                ?>


                </tbody>
            </table>
        </div>
    </div>

