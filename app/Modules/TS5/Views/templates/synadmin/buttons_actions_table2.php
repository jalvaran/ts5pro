<div class="btn-group " role="group" >
        <?php
            $array_data_table=json_decode(base64_decode(urldecode($data_table)),true);

            if(!isset($array_data_table["buttons"]["pdf"]["disabled"])){
                print('<button data-id="'.$value.'" title="pdf" id="btn_input_pdf_'.$array_data_table["table_id"].'" data-data_table="'.$data_table.'"  type="button" class="btn btn-sm btn-outline-danger ts_input_pdf_'.$array_data_table["table_id"].'"><i class="fa fa-file-pdf"></i></button>');
            }
            if(!isset($array_data_table["buttons"]["excel"]["disabled"])){
                print('<button data-id="'.$value.'" title="excel" id="btn_input_excel_'.$array_data_table["table_id"].'" data-data_table="'.$data_table.'"  type="button" class="btn btn-sm btn-outline-success ts_input_excel_'.$array_data_table["table_id"].'"><i class="fa fa-file-excel"></i></button>');
            }
            if(!isset($array_data_table["buttons"]["view"]["disabled"])){
                print('<button data-id="'.$value.'" title="'.lang("fields.view").'" id="btn_input_view_'.$array_data_table["table_id"].'" data-data_table="'.$data_table.'"  type="button" class="btn btn-sm btn-outline-primary ts_input_view_'.$array_data_table["table_id"].'"><i class="fa fa-eye"></i></button>');
            }
            if(!isset($array_data_table["buttons"]["edit"]["disabled"])){
                print('<button data-id="'.$value.'" title="'.lang("fields.edit").'" id="btn_input_edit_'.$array_data_table["table_id"].'" data-data_table="'.$data_table.'"  type="button" class="btn btn-sm btn-outline-warning ts_input_edit_'.$array_data_table["table_id"].'"><i class="fa fa-edit"></i></button>');
            }
            if(!isset($array_data_table["buttons"]["delete"]["disabled"])){
                print('<button data-id="'.$value.'" title="'.lang("fields.delete").'" id="btn_input_delete_'.$array_data_table["table_id"].'" data-data_table="'.$data_table.'"  type="button" class="btn btn-sm btn-outline-danger ts_input_delete_'.$array_data_table["table_id"].'"><i class="fa fa-trash"></i></button>');
            }

        ?>


</div>