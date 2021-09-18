<script>
    /**
     * Variables generales del script
     *
     */
    var list_id=2;
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
        if(list_id==3){
            branches_draw();
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

    /**
     * Dubuja las sucursales de la empresa
     */
    function branches_draw(){

        $(".ts_pages_links").removeClass("active");
        $("#link_branches").addClass("active");

        var search=$('#search').val();

        var urlControllerDraw ='<?= base_url('admin/branches_list')?>';
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

    function frm_create_edit_branch(id=''){
        $('#modal_md').modal("show");
        $(".ts_btn_save_modals").attr("data-id",id);
        var urlControllerDraw ='<?= base_url('admin/frm_create_branch')?>';
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
                
                select2_municipalities();

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

    function select2_municipalities(){
        $('#app_cat_municipalities_id').select2({
            dropdownParent: $('#modal_md'),
            width: '100%',
            ajax: {
                
                url: '<?= base_url('admin/municipalities_searches');?>',
                dataType: 'json',
                delay: 250,


                processResults: function (data) {

                    return {
                        results: data
                    };
                },
                cache: true
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

    function confirm_save_branch(id){

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
                save_branch(id);
            }else{

                toastr.error('<?php echo lang('Ts5.confirm_process_cancel_text')?>');
            }
        });
    }

    function save_branch(id){

        var urlControllerProcess='<?php echo base_url('/admin/save_branch') ?>';
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

    function role_view(id){


        var urlControllerDraw ='<?= base_url('admin/role_view')?>';
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

                $('#'+general_div).html(data);
                roles_permissions_list(id);
                select2_permission();
                

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

    function roles_permissions_list(id){


        var urlControllerDraw ='<?= base_url('admin/roles_permissions_list')?>';
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
                $('#div_permissions_list').html(data);
                event_add_btn_permissions_list();
                //event_add_list();

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
    
    
        
    function event_add_btn_permissions_list(){
        $("#btn_add_permission").unbind();
        $(".ts_btn_delete").unbind();

        $("#btn_add_permission").on('click',function () {
            var role_id = $(this).attr("data-id");
            add_permission_role(role_id);
        });
        
        $(".ts_btn_delete").on('click',function () {
            var permission_id = $(this).attr("data-id");
            var role_id = $(this).attr("data-role_id");
            delete_permission_role(role_id,permission_id);
        });
    }
    
    function add_permission_role(role_id){

        var urlControllerProcess='<?php echo base_url('/admin/add_permission_role') ?>';
        var btnSave = $("#btn_add_permission");
        var permission_id=$('#permission_id').val();
        var form_data = new FormData();

            form_data.append('role_id',role_id);
            form_data.append('permission_id',permission_id);

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
                        roles_permissions_list(role_id);
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
    
    function delete_permission_role(role_id,permission_id){

        var urlControllerProcess='<?php echo base_url('/admin/delete_permission_role') ?>';
        var btnSave = $("#btn_add_permission");
        
        var form_data = new FormData();            
            form_data.append('permission_id',permission_id);

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
                        roles_permissions_list(role_id);
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
    
    
    
    function branches_user_view(id){


        var urlControllerDraw ='<?= base_url('admin/branches_user_view')?>';
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
                $('#'+general_div).html(data);
                branches_user_list(id);
                select2_branches();
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

    function branches_user_list(id){


        var urlControllerDraw ='<?= base_url('admin/branches_user_list')?>';
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
                $('#div_branches_list').html(data);
                event_add_btn_branches_list();
                //event_add_list();

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
    
    
    
    function user_view(id){


        var urlControllerDraw ='<?= base_url('admin/user_view')?>';
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
                $('#'+general_div).html(data);
                user_roles_list(id);
                select2_roles();
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
    
    function user_roles_list(id){
    
        var urlControllerDraw ='<?= base_url('admin/user_roles_list')?>';
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
                $('#div_roles_list').html(data);
                event_add_btn_roles_list();
                

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

    
    function add_role_user(user_id){

        var urlControllerProcess='<?php echo base_url('/admin/add_role_user') ?>';
        var btnSave = $("#btn_add_role");
        var role_id=$('#role_id').val();
        var form_data = new FormData();

            form_data.append('user_id',user_id);
            form_data.append('role_id',role_id);

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
                        user_roles_list(user_id);
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
    
    function delete_role_user(user_id,id){

        var urlControllerProcess='<?php echo base_url('/admin/delete_role_user') ?>';
        var btnSave = $("#btn_add_permission");
        
        var form_data = new FormData();            
            form_data.append('id',id);

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
                        user_roles_list(user_id);
                    }else{
                        toastr.error(data.msg);

                        if(data.object_id){
                            error_mark(data.object_id);
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



    function select2_permission(){
        $('#permission_id').select2({
            ajax: {
                url: '<?= base_url('admin/permissions_searches');?>',
                dataType: 'json',
                delay: 250,


                processResults: function (data) {

                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    }
    
    function select2_roles(){
        $('#role_id').select2({
            ajax: {
                url: '<?= base_url('admin/roles_searches');?>',
                dataType: 'json',
                delay: 250,


                processResults: function (data) {

                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    }

    function event_add_btn_roles_list(){
        $("#btn_add_role").unbind();
        $(".ts_btn_delete").unbind();

        $("#btn_add_role").on('click',function () {
            var user_id = $(this).attr("data-id");            
            add_role_user(user_id);
        });
        
        $(".ts_btn_delete").on('click',function () {
            var user_id = $(this).attr("data-user_id");
            var id = $(this).attr("data-id");
            delete_role_user(user_id,id);
        });
    }
    
    function event_add_btn_branches_list(){
        $("#btn_add_branch").unbind();
        $(".ts_btn_delete").unbind();

        $("#btn_add_branch").on('click',function () {
            var user_id = $(this).attr("data-id");            
            add_branch_user(user_id);
        });
        
        $(".ts_btn_delete").on('click',function () {
            var user_id = $(this).attr("data-user_id");
            var id = $(this).attr("data-id");
            delete_role_user(user_id,id);
        });
    }


    function event_add_list(){
        $(".ts_btn_page").unbind();
        $(".ts_btn_actions").unbind();
        $(".ts_col_table").unbind();
        $(".ts_btn_branches").unbind();

        $(".ts_btn_page").on('click',function () {
            page = $(this).attr("data-page");
            select_list();
        });

        $(".ts_col_table").on('click',function () {
            id = $(this).attr("data-id");

            if(list_id==1){
                role_view(id);
            }
            if(list_id==2){
                user_view(id);
            }
            if(list_id==3){
                branch_view(id);
            }

        });

        $('.ts_btn_actions').on('click',function () {
            var id=$(this).attr("data-id");
            if(list_id==1){
                frm_create_edit_role(id);
            }
            if(list_id==2){
                frm_create_edit_user(id);
            }
            if(list_id==3){
                frm_create_edit_branch(id);
            }
        });
        
        $('.ts_btn_branches').on('click',function () {
            var id=$(this).attr("data-id");
            
            if(list_id==2){
                branches_user_view(id);
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
         * Se le agrega evento al link que muestra las sucursales
         */
        $('#link_branches').on('click',function () {
            list_id=3;
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
            if(list_id==3){
                frm_create_edit_branch();
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
            if(list_id==3){
                confirm_save_branch(id);
            }

        });


    });

</script>