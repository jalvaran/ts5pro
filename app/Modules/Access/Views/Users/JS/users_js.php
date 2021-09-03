<script type="text/javascript">


    /**
     * Función para dibujar el listado de usuarios
     */
    function users_draw(){
        var urlController='<?= base_url('access/users/data_table_users')?>';

        var form_data = new FormData();

        $.ajax({
            url: urlController,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('Cargando');

            },
            complete: function(){
                //$('#loader').fadeOut();
            },
            success: function(data){
                hide_spinner();
                $('#div_table_users').html(data);
                data_table_init_2('table_users');

            },
            error: function(xhr, ajaxOptions, thrownError){

                var code_error=xhr.status;
                if(code_error==0){
                    alert('No connect, verify Network.');
                }else if(code_error==404){
                    alert('Page not found [404]');
                }else if(code_error==500){
                    alert(xhr.responseText+' '+thrownError);
                }else{
                    alert(code_error +' '+xhr.responseText+' '+thrownError);
                }


            }
        });//Fin peticion ajax
    }

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