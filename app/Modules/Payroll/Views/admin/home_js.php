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
 * Este archivo contiene el javascript para controlar lo procesos del modulo de administracion de nomina
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-11-17
 * @updated 2021-11-17
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */
?>

<script>
    
    var list_id='1';
    var page=1;
    var general_div="div_content_list";
    
    
    /**
     * Selecciona el listado que se debe mostrar segun un id
     */
    function select_list(){
        if(list_id==1){
            employees_draw();
        }
                
    }
    
    /**
     * Dibuja el historial de los empleados
     */
    function employees_draw(){

        var search=$('#search').val();

        var urlControllerDraw ='<?= base_url('payroll/employees_draw')?>';
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
     * Dibuja el formulario para crear o editar un empleado
     */
    function form_employee(id=''){

        var urlControllerDraw ='<?= base_url('payroll/form_employee')?>';
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
                select2_employees_form();
                events_save_buttons();
                auto_complete_third_name_events_add();
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
    
    function confirm_save(id,form_id=''){
        
        
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
                if(form_id == '1'){
                    save_employee(id);
                }
                
            }else{

                toastr.error('<?php echo lang('Ts5.confirm_process_cancel_text')?>');
            }
        });
        
        
        
    }
    
    /**
    * Grabar los datos para la creacion de un empleado

     * @param {type} id
     * @returns {undefined}     */
    function save_employee(id){
                
        var urlControllerProcess='<?php echo base_url('/payroll/save_employee') ?>';
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
                        
                        select_list();
                    }else{
                        toastr.error(data.msg);

                        if(data.object_id){
                            error_mark(data.object_id)
                        }

                    }
                }else{
                    alert(data);
                    //$('#'+div_messages).html(data);
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
    
    function events_save_buttons(){
        /**
         * se agregan eventos a los botones de guardar de los modales
         */
        $('.ts_btn_save_modals').unbind();     
        $('.ts_btn_save_modals').on('click',function () {
            var id=$(this).attr("data-id");
            var form_id=$(this).attr("data-form_id");
            confirm_save(id,form_id);            
        });
    }
    
    
    function select2_employees_form(){
    
        $('#municipalities_id').unbind();                        
        $('#municipalities_id').select2({
                        
            width: '100%',
            ajax: {
                
                url: '<?= base_url('ts5/municipalities_searches');?>',
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
        
        
        $('#type_document_identification_id').unbind();
        $('#type_document_identification_id').select2({
            
            width: '100%',
            ajax: {
                
                url: '<?= base_url('ts5/type_document_identification_searches');?>',
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
        
        $('#type_worker_id').unbind();
        $('#type_worker_id').select2({
            
            width: '100%',
            ajax: {
                
                url: '<?= base_url('payroll/type_worker_searches');?>',
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
        
        $('#subtype_worker_id').unbind();
        $('#subtype_worker_id').select2({
            
            width: '100%',
            ajax: {
                
                url: '<?= base_url('payroll/subtype_worker_searches');?>',
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
        
        $('#company_group_id').unbind();
        $('#company_group_id').select2({
            
            width: '100%',
            ajax: {
                
                url: '<?= base_url('payroll/company_groups_searches');?>',
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
        
        
        $('#employees_position_id').unbind();
        $('#employees_position_id').select2({
            
            width: '100%',
            ajax: {
                
                url: '<?= base_url('payroll/employees_position_searches');?>',
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
        
        $('#type_contract_id').unbind();
        $('#type_contract_id').select2({
            
            width: '100%',
            ajax: {
                
                url: '<?= base_url('payroll/type_contract_searches');?>',
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
        
        
        $('#reasons_withdrawal_id').unbind();
        $('#reasons_withdrawal_id').select2({
            
            width: '100%',
            ajax: {
                
                url: '<?= base_url('payroll/reasons_withdrawal_searches');?>',
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
        
        $('#eps_code').unbind();
        $('#eps_code').select2({
            
            width: '100%',
            ajax: {
                
                url: '<?= base_url('payroll/eps_code_searches');?>',
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
        
        $('#afp_code').unbind();
        $('#afp_code').select2({
            
            width: '100%',
            ajax: {
                
                url: '<?= base_url('payroll/afp_code_searches');?>',
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
        
        $('#arl_code').unbind();
        $('#arl_code').select2({
            
            width: '100%',
            ajax: {
                
                url: '<?= base_url('payroll/arl_code_searches');?>',
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
        
        $('#arl_level_id').unbind();
        $('#arl_level_id').select2({
            
            width: '100%',
            ajax: {
                
                url: '<?= base_url('payroll/arl_level_id_searches');?>',
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
        
        $('#ccf_code').unbind();
        $('#ccf_code').select2({
            
            width: '100%',
            ajax: {
                
                url: '<?= base_url('payroll/ccf_code_searches');?>',
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
        
        $('#period_id').unbind();
        $('#period_id').select2({
            
            width: '100%',
            ajax: {
                
                url: '<?= base_url('payroll/period_id_searches');?>',
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
    
        
    /**
    * se agregan eventos a los botones de las tablas
    *
    */
    function event_add_list(){
        $(".ts_btn_page").unbind();
        
        $(".ts_btn_page").on('click',function () {
            page = $(this).attr("data-page");
            select_list();
        });
        
        $("#btn_register_add").unbind();
        $('#btn_register_add').on('click',function () {
                    
            if(list_id==1){
                form_employee();
            }           
            
        });
        
        $(".ts_btn_edit").unbind();
        $('.ts_btn_edit').on('click',function () {
            var id=$(this).attr("data-id");            
            if(list_id==1){
                form_employee(id);
            }           
            
        });
        
        
        
    }
    
    $(document).ready( function () {
        select_list(); //Selecciona el primer listado

        /**
         * se agrega evento al link que muestra los roles
         */
        $('.ts_pages_links').on('click',function () {
            $(".ts_pages_links").removeClass("active");
            $(this).addClass("active");            
            list_id=$(this).attr("data-id");
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
            
                form_business_sheet();
            
        });
        
        $('#btn_thirds').on('click',function () {
            
            frm_thirds();
        });

        /**
         * se agregan eventos a los botones de guardar de los modales
         */
        $('.ts_btn_save_modals ').on('click',function () {
            var id=$(this).attr("data-id");
            var form_id=$(this).attr("data-form_id");
            confirm_save(id,form_id);            
        });


    });
    
    
</script>

