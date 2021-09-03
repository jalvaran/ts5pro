<script type="text/javascript">

    var table_id='<?= $table_id?>';
    var permission_id='<?= $permission_id?>';
    var module_id='<?= $module_id?>';
    var model='<?= urlencode(base64_encode($table_model))?>';

    var users_draw = function() {
        data_table_draw(table_id,model,module_id,permission_id,'users_draw');
    };

    function buttons_data_table_events_add(){
        console.log("entras a eventos");
    }

    $(document).ready( function () {

        users_draw();
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