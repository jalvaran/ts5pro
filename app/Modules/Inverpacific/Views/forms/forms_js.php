<?php

/*
 *--------------------------------------------------------------------------
 *╔╦╗╔═╗╔═╗╦ ╦╔╗╔╔═╗
 * ║ ║╣ ║  ╠═╣║║║║ ║
 * ╩ ╚═╝╚═╝╩ ╩╝╚╝╚═╝
 *--------------------------------------------------------------------------
 * Copyright 2021 - Techno Soluciones S.A.S., Inc. <info@technosoluciones.com.co>
 * Este archivo es parte de TS5 Pro V 1.0
 * Para obtener información completa sobre derechos de autor y licencia, consulte
 * la LICENCIA archivo que se distribuyó con este código fuente.
 * -----------------------------------------------------------------------------
 * EL SOFTWARE SE PROPORCIONA -TAL CUAL-, SIN GARANTÍA DE NINGÚN TIPO, EXPRESA O
 * IMPLÍCITA, INCLUYENDO PERO NO LIMITADO A LAS GARANTÍAS DE COMERCIABILIDAD,
 * APTITUD PARA UN PROPÓSITO PARTICULAR Y NO INFRACCIÓN. EN NINGÚN CASO SERÁ
 * LOS AUTORES O TITULARES DE LOS DERECHOS DE AUTOR SERÁN RESPONSABLES DE CUALQUIER RECLAMO, DAÑOS U OTROS
 * RESPONSABILIDAD, YA SEA EN UNA ACCIÓN DE CONTRATO, AGRAVIO O DE OTRO MODO, QUE SURJA
 * DESDE, FUERA O EN RELACIÓN CON EL SOFTWARE O EL USO U OTROS
 * NEGOCIACIONES EN EL SOFTWARE.
 * -----------------------------------------------------------------------------
 * Este archivo contiene el javascript para controlar lo procesos del modulo de creditmoto
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-09-20
 * @updated 2021-09-20
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */
?>

<script>
    
   function form_business_sheet(id=''){
        $('#modal_xl').modal("show");
        
        var Controller='<?php echo base_url('/inverpacific/form_business_sheet') ?>';
        $(".ts_btn_save_modals").attr("data-form_id",1);        
        $(".ts_btn_save_modals").attr("data-id",id);
        var form_data = new FormData();        
        form_data.append('id',id);        

        $.ajax({
            url: Controller,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('msg.loading')?>');
            },
            success: function(data){

                hide_spinner();                
                $('.ts_modal_body').html('');
                $('#modal_xl_body').html(data);
                select2_form_business_sheet();
                form_business_sheet_events();
                
                if(id==''){
                    id=$('#app_thirds_id').attr('data-business_sheet_id');
                }
                business_sheet_severals_list(id);
                business_sheet_severals_list_added(id);
                business_sheet_totals(id);
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
   
    
    function form_business_sheet_events(){
        $(".ts_edit_sheet").unbind();
        
        $(".ts_edit_sheet").on('change',function () {
            var field = $(this).attr("id");
            var business_sheet_id = $(this).attr("data-business_sheet_id");
            business_sheet_field_edit(field,business_sheet_id);
            if(field=='motorcycle_id'){
                var motorcycle_id = $(this).val();
                get_motorcycle_value(motorcycle_id,business_sheet_id);
            }
            
        });
        
    }
   
    function business_sheet_field_edit(field,business_sheet_id){
         
        
        var urlControllerProcess='<?php echo base_url('/inverpacific/business_sheet_field_edit') ?>';
        var value = $('#'+field).val();
        
        
        var form_data = new FormData();
            form_data.append('business_sheet_id',business_sheet_id);
            form_data.append('field',field);
            form_data.append('value',value);
               
        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('msg.saving')?>');
                
            },
            success: function(data){

                hide_spinner();
               
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);                        
                        error_unmark(field);
                        business_sheet_totals(business_sheet_id);
                       
                    }else{
                        toastr.error(data.msg);
                        if(data.object_id){
                            error_mark(data.object_id,0);
                        }
                        if(data.value_old){
                            $('#'+field).val(data.value_old);
                        }
                    }
                }else{
                    alert(data);
                    $('#'+div_messages).html(data);
                }


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
   
    function select2_form_business_sheet(){
        $('#app_thirds_id').unbind();
        $('#creditmoto_business_sheet_types_id').unbind();
        $('#financial_id').unbind();
        $('#color_id').unbind();
        $('#motorcycle_id').unbind();
        
        $('#app_thirds_id').select2({
            dropdownParent: $('#modal_xl'),
            width: '100%',
            ajax: {
                url: '<?php echo base_url('/inverpacific/thirds_searches') ?>',
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
        
        $('#creditmoto_business_sheet_types_id').select2({
            dropdownParent: $('#modal_xl'),
            width: '100%',
            ajax: {
                url: '<?php echo base_url('/inverpacific/type_sheets_searches') ?>',
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
        
        $('#financial_id').select2({
            dropdownParent: $('#modal_xl'),
            width: '100%',
            ajax: {
                url: '<?php echo base_url('/inverpacific/financials_searches') ?>',
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
        
        $('#color_id').select2({
            dropdownParent: $('#modal_xl'),
            width: '100%',
            ajax: {
                url: '<?php echo base_url('/inverpacific/colors_searches') ?>',
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
        
        $('#motorcycle_id').select2({
            dropdownParent: $('#modal_xl'),
            width: '100%',
            ajax: {
                url: '<?php echo base_url('/inverpacific/motorcycles_searches') ?>',
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
    
    function get_motorcycle_value(id,business_sheet_id){
   
        var urlControllerProcess='<?php echo base_url('/inverpacific/get_motorcycle_value') ?>';
          
        var form_data = new FormData();
            form_data.append('business_sheet_id',business_sheet_id);
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
                
            },
            success: function(data){

                hide_spinner();
               
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        
                        $('#motorcycle_value').val(data.value);
                        business_sheet_field_edit('motorcycle_value',business_sheet_id);
                       
                    }else{
                        toastr.error(data.msg);
                        if(data.object_id){
                            error_mark(data.object_id,0);
                        }
                        if(data.value_old){
                            $('#'+field).val(data.value_old);
                        }
                    }
                }else{
                    alert(data);
                    $('#'+div_messages).html(data);
                }


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
    
    function business_sheet_severals_list(id=''){
        
        var div="div_business_sheet_several";        
        var Controller='<?php echo base_url('/inverpacific/business_sheet_severals_list') ?>';
        
        var form_data = new FormData();        
        form_data.append('id',id);        

        $.ajax({
            url: Controller,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('msg.loading')?>');
            },
            success: function(data){

                hide_spinner();                
                
                $('#'+div).html(data);
                business_sheet_severals_event_add();
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
   
   
    function business_sheet_severals_event_add(){
        
        $(".ts_btn_add_severals").unbind();
        
        $(".ts_btn_add_severals").on('click',function () {
            var id = $(this).attr("data-id");
            var business_sheet_id = $(this).attr("data-business_sheet_id");
            business_several_add(id,business_sheet_id);
        });
        
    }
    /**
    * agrega un adicional a la hoja de negocio

     * @param {type} id
     * @param {type} business_sheet_id
     * @returns {undefined}     */
    function business_several_add(id,business_sheet_id){
        var box_id="several_value_"+id;
        var concept_id="several_concept_"+id;
        
        var urlControllerProcess='<?php echo base_url('/inverpacific/business_several_add') ?>';
        var btnSave = $(".ts_btn_add_severals");
        
        var value=$('#'+box_id).val();
        var concept=$('#'+concept_id).val();
        
        var form_data = new FormData();

        form_data.append('several_id',id);
        form_data.append('value',value);
        form_data.append('concept',concept);
        form_data.append('business_sheet_id',business_sheet_id);

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
                        business_sheet_severals_list_added(business_sheet_id);
                        business_sheet_totals(business_sheet_id);
                    }else{
                        toastr.error(data.msg);

                        if(data.object_id){
                            error_mark(data.object_id)
                        }

                    }
                }else{
                    alert(data);
                    $('#'+div_messages).html(data);
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
        });
        
    }
    
    /**
    * Lista los adicionales de una hoja de negocio
     * @param {type} business_sheet_id
     * @returns {undefined}     
     * 
     * */
    function business_sheet_severals_list_added(business_sheet_id){
        
        var div="div_business_sheet_several_added";        
        var Controller='<?php echo base_url('/inverpacific/business_sheet_severals_list_added') ?>';
        
        var form_data = new FormData();        
        form_data.append('business_sheet_id',business_sheet_id);        

        $.ajax({
            url: Controller,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('msg.loading')?>');
            },
            success: function(data){

                hide_spinner();                
                
                $('#'+div).html(data);
                business_sheet_severals_event_added();
                
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
   
   function business_sheet_severals_event_added(){
        
        $(".ts_btn_delete_several").unbind();
        
        $(".ts_btn_delete_several").on('click',function () {
            var id = $(this).attr("data-id");
            var business_sheet_id = $(this).attr("data-business_sheet_id");
            business_several_delete(id,business_sheet_id);
        });
        
    }
   
   
   function business_several_delete(id,business_sheet_id){
               
        var urlControllerProcess='<?php echo base_url('/inverpacific/business_several_adds_delete') ?>';
        
        var form_data = new FormData();

        form_data.append('id',id);
        form_data.append('business_sheet_id',business_sheet_id);
        
        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('msg.saving')?>');
                
            },
            success: function(data){

                hide_spinner();
               
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.error(data.msg);                        
                        business_sheet_severals_list_added(business_sheet_id);
                        business_sheet_totals(business_sheet_id);
                    }else{
                        toastr.error(data.msg);

                        if(data.object_id){
                            error_mark(data.object_id)
                        }

                    }
                }else{
                    alert(data);
                    $('#'+div_messages).html(data);
                }


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
        
    function business_sheet_totals(id){
        
        var div="div_business_sheet_totals";        
        var Controller='<?php echo base_url('/inverpacific/business_sheet_totals') ?>';
        
        var form_data = new FormData();        
        form_data.append('id',id);        

        $.ajax({
            url: Controller,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('msg.loading')?>');
            },
            success: function(data){

                hide_spinner();                
                
                $('#'+div).html(data);
                business_sheet_severals_event_add();
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
   
   
   function save_business_sheet(id){
                
        var urlControllerProcess='<?php echo base_url('/inverpacific/save_business_sheet') ?>';
        var btnSave = $(".ts_btn_add_severals");
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
                        $(".ts_pages_links").removeClass("active");
                        $('#link_on_request').addClass("active");     
                        list_id=1;
                        select_list();
                    }else{
                        toastr.error(data.msg);

                        if(data.object_id){
                            error_mark(data.object_id)
                        }

                    }
                }else{
                    alert(data);
                    $('#'+div_messages).html(data);
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
        });
        
    }
    
    
    function sheet_advance(id){
                
        var urlControllerProcess='<?php echo base_url('/inverpacific/sheet_advance') ?>';
        var btnSave = $(".ts_btn_add_severals");
             
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
                        select_list();
                    }else{
                        toastr.error(data.msg);

                        if(data.object_id){
                            error_mark(data.object_id)
                        }

                    }
                }else{
                    alert(data);
                    $('#'+div_messages).html(data);
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
        });
        
    }
    
    function sheet_back(id){
                
        var urlControllerProcess='<?php echo base_url('/inverpacific/sheet_back') ?>';
        var btnSave = $(".ts_btn_add_severals");
             
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
                        select_list();
                    }else{
                        toastr.error(data.msg);

                        if(data.object_id){
                            error_mark(data.object_id)
                        }

                    }
                }else{
                    alert(data);
                    $('#'+div_messages).html(data);
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
        });
        
    }
    
</script>

