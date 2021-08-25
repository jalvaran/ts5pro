<script type="text/javascript">
    /**
     * Funcion para dibujar el formulario para crear una empresa
     */
    function frm_company_draw(){
        var modal_use="modal_large";
        var modal_body="modal_large_body";
        $('#'+modal_use).modal("show");
        $("#modal_large_btn_save").attr("data-form_id",1);
        var urlController='<?php echo $controller_draw;?>';

        var form_data = new FormData();
        form_data.append('company_id', <?php echo $company_id;?>);

        $.ajax({
            url: urlController,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                <?php
                $spinner=view($views_path.'/spinner_blue');
                print('$("#"+modal_body).html(`'.$spinner.'`)');
                ?>

            },
            complete: function(){
                //$('#loader').fadeOut();
            },
            success: function(data){
                $('#'+modal_body).html(data);
            }
        });//Fin peticion ajax
    }


    $(document).ready( function () {

        $('#btn_new_<?php echo $table_id;?>').on('click',function () {
            frm_company_draw();
        });

    });


</script>