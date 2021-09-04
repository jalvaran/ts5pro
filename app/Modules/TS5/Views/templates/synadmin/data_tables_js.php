<script type="text/javascript">



    var <?= $function_name?> = function() {

        var table_id='<?= $table_id?>';
        var permissions='<?= json_encode($permissions)?>';
        var module_id='<?= $module_id?>';
        var model='<?= urlencode(base64_encode($table_model))?>';

        data_table_draw(table_id,model,module_id,permissions,<?= $function_name?>);
    };

    function buttons_data_table_events_add(){
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