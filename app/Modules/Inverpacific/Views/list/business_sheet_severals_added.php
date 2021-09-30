
    <div class="customers-list ps--active-y">
        

        <?php
            if(isset($data_severals)){
                
                foreach ($data_severals as $key => $data_several){
                    print('<div class="customers-list-item d-flex align-items-center border-top border-bottom p-2">

                                <div class="col-md-3 font-8">
                                    '.$data_several["several_name"].'

                                </div>
                                <div class="col-md-4" style="text-align:left">
                                    '.number_format($data_several["value"]).' 

                                </div>
                                <div class="col-md-4"> || 
                                    '.$data_several["concept"].'

                                </div>
                                
                                <div class="list-inline d-flex customers-contacts ms-auto">	

                                    <a href="javascript:;" title="'.lang("fields.delete").'" data-business_sheet_id="'.$business_sheet_id.'" data-id="'.$data_several["id"].'" class="list-inline-item ts_btn_delete_several  cursor-pointer"><i class="fa fa-trash-alt rounded text-danger"></i></a>
                                </div>
                            </div>');
                }
            }

        ?>
    </div> 
