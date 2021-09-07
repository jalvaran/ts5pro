<script type="text/javascript">



    var <?= $function_name?> = function() {

        var table_id='<?= $table_id?>';
        var data='<?= urlencode(base64_encode(json_encode($data)))?>';

        data_table_draw(table_id,data,<?= $function_name?>);
    };

    function buttons_data_table_events_add_2(table_id){
        $('.ts_input_view_'+table_id).unbind();
        $('.ts_input_edit_'+table_id).unbind();
        $('.ts_input_excel_'+table_id).unbind();
        $('.ts_input_pdf_'+table_id).unbind();
        $('.ts_input_delete_'+table_id).unbind();
        $('.ts_input_create_'+table_id).unbind();

        $('.ts_input_edit_'+table_id).on('click',function () {
            var id=$(this).attr("data-id");
            var data_table=$(this).attr("data-data_table");
            frm_tables_draw(id,data_table);
        });

        $('.ts_input_create_'+table_id).on('click',function () {
            var id="NA";
            var data_table=$(this).attr("data-data_table");
            frm_tables_draw(id,data_table);
        });

        console.log("entras a eventos");
    }

    $(document).ready( function () {

        <?= $function_name?>();
        $('#modal_full_btn_save').on('click',function () {
            var form_id=$(this).attr("data-form_id");
            var item_id=$(this).attr("data-item_id");
            if(form_id==1){
                confirm_save_user();
            }else if(form_id==2){
                confirm_edit_user(item_id);
            }else if(form_id==3){
                $('#'+modal_use).modal("hide");
            }else{
                toastr.error('<?php echo lang('Ts5.save_error_button')?>');
            }

        });


    });

</script>