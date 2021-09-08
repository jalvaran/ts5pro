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
        $('.ts_btn_save_modals').unbind();
        $('.ts_input_select2').unbind();

        $('.ts_input_edit_'+table_id).on('click',function () {
            var id=$(this).attr("data-id");
            var data_table=$(this).attr("data-data_table");
            frm_tables_draw(id,data_table,table_id);
        });

        $('.ts_input_create_'+table_id).on('click',function () {
            var id="NA";
            var data_table=$(this).attr("data-data_table");
            frm_tables_draw(id,data_table,table_id);
        });

        $('.ts_btn_save_modals').on('click',function () {

            var form_id=$(this).attr("data-form_id");
            var data_table=$(this).attr("data-data_table");
            var table_id=$(this).attr("data-table_id");
            var id=$(this).attr("data-id");
            if(form_id==1){
                confirm_save_register(data_table,table_id);
            }else if(form_id==2){
                confirm_edit_register(id,data_table,table_id);
            }else if(form_id==3){
                $('#'+modal_use).modal("hide");
            }else{
                toastr.error('<?php echo lang('Ts5.save_error_button')?>');
            }

        });


    }

    function select2_forms_converter(){

        $(".ts_input_select2").each(function(){
            var select_id=($(this).attr("id"));
            var model=($(this).attr("data-model"));
            var data_table=($(this).attr("data-data_table"));
            var labels=($(this).attr("data-labels"));
            var form_data = new FormData();
                form_data.append('data_table',data_table);
                form_data.append('model',model);
                form_data.append('labels',labels);

            $('#'+select_id).select2({
                dropdownParent: $('#modal_xl'),
                width: '100%',

                ajax: {
                    url: '<?= base_url('ts5/tables_searchs');?>',
                    dataType: 'json',
                    delay: 250,
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    processResults: function (data) {

                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });

        });


    }


    $(document).ready( function () {

        <?= $function_name?>();


    });

</script>