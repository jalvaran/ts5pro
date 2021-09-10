<script>
    /**
     * Variables generales del script
     *
     */
    var list_id=1;
    var page=1;
    var general_div="div_content_list";

    /**
     * Selecciona el listado que se debe mostrar segun un id
     */
    function select_list(){
        if(list_id==1){
            roles_draw();
        }
        if(list_id==2){
            users_draw();
        }
    }

    /**
     * Dubuja los roles del sistema
     */
    function roles_draw(){

        $(".ts_pages_links").removeClass("active");
        $("#link_roles").addClass("active");

        var search=$('#search').val();

        var urlControllerDraw ='<?= base_url('admin/roles_list')?>';
        var form_data = new FormData();
            form_data.append('page',page);
            form_data.append('search',search);

        $.ajax({
            url: urlControllerDraw,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('fields.loading')?>');

            },
            complete: function(){

            },
            success: function(data){
                hide_spinner();
                $('#'+general_div).html(data);
                event_add_list();

            },
            error: function(xhr, ajaxOptions, thrownError){
                hide_spinner();
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
        });
    }

    /**
     * Dibuja los usuarios
     */
    function users_draw(){
        $(".ts_pages_links").removeClass("active");
        $("#link_users").addClass("active");

        var search=$('#search').val();
        var urlControllerDraw ='<?= base_url('admin/users_list')?>';
        var form_data = new FormData();

            form_data.append('page',page);
            form_data.append('search',search);

        $.ajax({
            url: urlControllerDraw,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('fields.loading')?>');

            },
            complete: function(){

            },
            success: function(data){
                hide_spinner();
                $('#'+general_div).html(data);
                event_add_list();

            },
            error: function(xhr, ajaxOptions, thrownError){
                hide_spinner();
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
        });
    }

    function frm_create_edit_role(id=''){
        $('#modal_md').modal("show");
        $(".ts_btn_save_modals").attr("data-id",id);
        var urlControllerDraw ='<?= base_url('admin/frm_create_role')?>';
        var form_data = new FormData();
            form_data.append('id',id);

        $.ajax({
            url: urlControllerDraw,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('fields.loading')?>');

            },
            complete: function(){

            },
            success: function(data){
                hide_spinner();
                $('#modal_xl_body').html('');
                $('#modal_md_body').html(data);

            },
            error: function(xhr, ajaxOptions, thrownError){

                hide_spinner();
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
        });
    }


    function frm_create_edit_user(id=''){
        $('#modal_xl').modal("show");
        $(".ts_btn_save_modals").attr("data-id",id);
        var urlControllerDraw ='<?= base_url('admin/frm_create_user')?>';
        var form_data = new FormData();
        form_data.append('id',id);

        $.ajax({
            url: urlControllerDraw,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('fields.loading')?>');

            },
            complete: function(){

            },
            success: function(data){
                hide_spinner();
                $('#modal_md_body').html('');
                $('#modal_xl_body').html(data);

            },
            error: function(xhr, ajaxOptions, thrownError){

                hide_spinner();
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
        });
    }


    function confirm_save_role(id){

        Swal.fire({
            title: '<?php echo lang('Ts5.confirm_title')?>',
            //text: "<?php echo lang('Ts5.confirm_text')?>",
            icon: 'warning',

            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?php echo lang('Ts5.confirm_button_ok')?>',
            cancelButtonText: '<?php echo lang('Ts5.confirm_button_cancel')?>'
        }).then((result) => {
            if (result.isConfirmed) {
                save_role(id);
            }else{

                toastr.error('<?php echo lang('Ts5.confirm_process_cancel_text')?>');
            }
        });
    }

    function save_role(id){

        var urlControllerProcess='<?php echo base_url('/admin/save_role') ?>';
        var btnSave = $(".ts_btn_save_modals");
        var data_form_serialized=$('.ts_input').serialize();
        var form_data = new FormData();

            form_data.append('id',id);
            form_data.append('data_form_serialized',data_form_serialized);

        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('msg.saving')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        $('#modal_md').modal("hide");
                        if(id==''){
                            page=1;
                        }
                        select_list();
                    }else{
                        toastr.error(data.msg);

                        if(data.object_id){
                            error_mark(data.object_id)
                        }

                    }
                }else{
                    alert(data);

                }


            },
            error: function(xhr, ajaxOptions, thrownError){
                hide_spinner();
                btnSave.removeAttr("disabled");
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

    function confirm_save_user(id){

        Swal.fire({
            title: '<?php echo lang('Ts5.confirm_title')?>',
            //text: "<?php echo lang('Ts5.confirm_text')?>",
            icon: 'warning',

            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?php echo lang('Ts5.confirm_button_ok')?>',
            cancelButtonText: '<?php echo lang('Ts5.confirm_button_cancel')?>'
        }).then((result) => {
            if (result.isConfirmed) {
                save_user(id);
            }else{

                toastr.error('<?php echo lang('Ts5.confirm_process_cancel_text')?>');
            }
        });
    }

    function save_user(id){

        var urlControllerProcess='<?php echo base_url('/admin/save_user') ?>';
        var btnSave = $(".ts_btn_save_modals");
        var data_form_serialized=$('.ts_input').serialize();
        var form_data = new FormData();

        form_data.append('id',id);
        form_data.append('data_form_serialized',data_form_serialized);

        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('msg.saving')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        $('#modal_xl').modal("hide");
                        if(id==''){
                            page=1;
                        }
                        select_list();
                    }else{
                        toastr.error(data.msg);

                        if(data.object_id){
                            error_mark(data.object_id)
                        }

                    }
                }else{
                    alert(data);

                }


            },
            error: function(xhr, ajaxOptions, thrownError){
                hide_spinner();
                btnSave.removeAttr("disabled");
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

    function event_add_list(){
        $(".ts_btn_page").unbind();
        $(".ts_btn_actions").unbind();

        $(".ts_btn_page").on('click',function () {
            page = $(this).attr("data-page");
            select_list();
        });

        $('.ts_btn_actions').on('click',function () {
            var id=$(this).attr("data-id");
            if(list_id==1){
                frm_create_edit_role(id);
            }
            if(list_id==2){
                frm_create_edit_user(id);
            }
        });
    }

    /**
     * Acciones a ejecutar cuando el documento esté listo
     */
    $(document).ready( function () {
        select_list(); //Selecciona el primer listado

        /**
         * se agrega evento al link que muestra los roles
         */
        $('#link_roles').on('click',function () {
            list_id=1;
            page=1;
            select_list();
        });
        /**
         * Se le agrega evento al boton de refrescar
         */
        $('#btn_refresh').on('click',function () {
            page=1;
            select_list();
        });
        /**
         * Se le agrega evento al link que muestra los usuarios
         */
        $('#link_users').on('click',function () {
            list_id=2;
            page=1;
            select_list();
        });
        /**
         * se agregan eventos a la caja de busquedas
         */
        $("#search").keypress(function(e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code==13){
                select_list();
            }
        });
        /**
         * Se agrega evento para dibujar el formulario segun listado
         */
        $('#btn_register_add').on('click',function () {
            if(list_id==1){
                frm_create_edit_role();
            }
            if(list_id==2){
                frm_create_edit_user();
            }
        });



        /**
         * se agregan eventos a los botones de guardar de los modales
         */
        $('.ts_btn_save_modals ').on('click',function () {
            var id=$(this).attr("data-id");
            if(list_id==1){
                confirm_save_role(id);
            }
            if(list_id==2){
                confirm_save_user(id);
            }

        });


    });

</script>