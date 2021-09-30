
    <div class="customers-list ps--active-y">
        

        <?php
            if(isset($data_severals)){
                
                foreach ($data_severals as $key => $data_several){
                    print('<div class="customers-list-item d-flex align-items-center border-top border-bottom p-2">

                                <div class="col-md-3 font-8">
                                    '.$data_several["name"].'

                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="several_value_'.$data_several["id"].'" id="several_value_'.$data_several["id"].'" data-id="'.$data_several["id"].'" value="'.$data_several["value"].'" placeholder="'.lang('fields.value').'" class="form-control ts_input_severals " style="text-align:right">

                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="several_concept_'.$data_several["id"].'" id="several_concept_'.$data_several["id"].'" data-id="'.$data_several["id"].'" value="" placeholder="'.lang('fields.concept').'" class="form-control  ts_input_severals">

                                </div>
                                <div class="list-inline d-flex customers-contacts ms-auto">	

                                    <a href="javascript:;" title="'.lang("fields.add").'" data-id="'.$data_several["id"].'" data-business_sheet_id="'.$business_sheet_id.'" data-id="'.$data_several["id"].'" class="list-inline-item ts_btn_add_severals  cursor-pointer"><i class="fa fa-share rounded text-success"></i></a>
                                </div>
                            </div>');
                }
            }

        ?>
    </div> 
