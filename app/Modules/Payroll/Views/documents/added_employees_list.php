
    <div class="customers-list ps--active-y">
        

        <?php
            if(isset($data_employees)){
                
                foreach ($data_employees as $key => $data_employee){
                    print('<div class="customers-list-item d-flex align-items-center border-top border-bottom p-2">

                                <div class="col-md-7 font-8">
                                    '.$data_employee["name"].'

                                </div>
                                <div class="col-md-3 font-8" style="text-align:right">
                                    '.$data_employee["identification"].'

                                </div>
                                
                                <div class="list-inline d-flex customers-contacts ms-auto">	

                                    <a href="javascript:;" title="'.lang("fields.add").'" data-id="'.$data_employee["id"].'" data-general_document_id="'.$general_document_id.'" class="list-inline-item ts_btn_delete_employee  cursor-pointer"><i class="fa fa-trash rounded text-danger"></i></a>
                                </div>
                            </div>');
                }
            }

        ?>
    </div> 
