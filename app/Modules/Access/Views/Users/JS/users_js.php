<script type="text/javascript">


    $(document).ready( function () {


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