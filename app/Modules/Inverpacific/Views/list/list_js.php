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
    
    var list_id='A';
    var page=1;
    var general_div="div_content_list";
    
    
    /**
     * Selecciona el listado que se debe mostrar segun un id
     */
    function select_list(){
        if(list_id=="A" || list_id<=20){
            business_sheet_draw();
        }
        
        if(list_id==100){
            thirds_draw();
        }
        
    }
    
    /**
     * Dibuja el historial de las hojas de negocio
     */
    function business_sheet_draw(){

        var search=$('#search').val();

        var urlControllerDraw ='<?= base_url('inverpacific/business_sheet_draw')?>';
        var form_data = new FormData();
            form_data.append('page',page);
            form_data.append('list_id',list_id);
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
    
    function attachments_draw(id){

        
        var urlControllerDraw ='<?= base_url('inverpacific/attachments_draw')?>';
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
                events_attachments_draw();
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
    * se agregan eventos a los botones de las tablas
    *
    */
    function event_add_list(){
        $(".ts_btn_page").unbind();
        $(".ts_btn_actions").unbind();
        $(".ts_col_table").unbind();        

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
            
            if(list_id=='A' || list_id<=20){
                form_business_sheet(id);
            }
              
            if(list_id==100){
                frm_thirds(id);
            }
            
        });
        
        $('.ts_btn_attachments').on('click',function () {
            var id=$(this).attr("data-id");            
            //if(list_id==1){
                attachments_draw(id);
            //}
        });
        
        $('.ts_btn_advance').on('click',function () {
            var id=$(this).attr("data-id");
            sheet_advance(id);
        });
        
        $('.ts_btn_back').on('click',function () {
            var id=$(this).attr("data-id");
            sheet_back(id);
        });
        
    }
    
    function events_attachments_draw(){
        $(".ts_btn_upload").unbind();        

        $(".ts_btn_upload").on('click',function () {
            var id = $(this).attr("data-id");
            var business_sheet_id = $(this).attr("data-business_sheet_id");
            frm_upload_file(business_sheet_id,id);
        });
    }
    
    function frm_upload_file(business_sheet_id,id){
        $('#modal_md').modal("show");
        var urlControllerDraw ='<?= base_url('inverpacific/frm_upload_file')?>';
        var form_data = new FormData();
            form_data.append('id',id);
            form_data.append('business_sheet_id',business_sheet_id);
            
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
                $('#modal_md_body').html(data);
                dropzone_uploads_sheet(business_sheet_id,id);
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
    
    function dropzone_uploads_sheet(){
        Dropzone.autoDiscover = false;
        $("#sheet_attachment").hover(function () {
            $(".ts_dropzone").css("color","green");

        }, function () {
            $(".ts_dropzone").css("color","black");
        })
        var document_id=$("#sheet_attachment").attr("data-document_id");
        var business_sheet_id=$("#sheet_attachment").attr("data-business_sheet_id");
        var attachment_id=$("#sheet_attachment").attr("data-attachment_id");
        urlQuery='<?php echo base_url('/inverpacific/upload_file'); ?>';

        var myDropzone = new Dropzone("#sheet_attachment", { url: urlQuery,paramName: "sheet_attachment",maxFiles: 1});
        myDropzone.on("sending", function(file, xhr, formData) {

            formData.append("document_id", document_id);
            formData.append("business_sheet_id", business_sheet_id);
            formData.append("attachment_id", attachment_id);

        });

        myDropzone.on("addedfile", function(file) {
            file.previewElement.addEventListener("click", function() {
                myDropzone.removeFile(file);
            });
        });

        myDropzone.on("success", function(file, data) {

            if(typeof(data)=='object'){
                if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                    toastr.success(data.msg);
                    attachments_draw(business_sheet_id);
                }else{
                    alert(data.msg);
                }
            }else{
                alert(data);
                //$('#'+div_messages).html(data);
            }

        });


    }
    
    function confirm_save_business_sheet(id,form_id=''){
        
        
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
                    save_business_sheet(id);
                }
            }else{

                toastr.error('<?php echo lang('Ts5.confirm_process_cancel_text')?>');
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
            confirm_save_business_sheet(id,form_id);            
        });


    });
    
    
</script>

