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
 * Este archivo contiene los scripts para el control de procesos en la creacion de empresas
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-08-26
 * @updated 2021-08-26
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */
?>
<script type="text/javascript">
    /**
     * Variables de uso general
    */
    var modal_use="modal_fullscreen";
    var modal_body="modal_fullscreen_body";
    var modal_button="modal_full_btn_save";

    /**
     * Función para convertir los Select a Select2
     */
    function select2_converter(){
        var urlControllerSearchLanguages='<?php echo $controller_search_languages;?>';
        var urlControllerSearchTypeDocuments='<?php echo $controller_search_type_documents;?>';
        var urlControllerSearchCountries='<?php echo $controller_search_countries;?>';
        var urlControllerSearchCurrencies='<?php echo $controller_search_currencies;?>';
        var urlControllerSearchTypeOrganization='<?php echo $controller_search_type_organizations;?>';
        var urlControllerSearchTypeRegime='<?php echo $controller_search_type_regime;?>';
        var urlControllerSearchTypeLiability='<?php echo $controller_search_type_liability;?>';
        var urlControllerSearchMunicipality='<?php echo $controller_search_municipality;?>';

        $('#municipality_id').select2({
            dropdownParent: $('#'+modal_use),
            width: '100%',
            ajax: {
                url: urlControllerSearchMunicipality,
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

        $('#type_liability_id').select2({
            dropdownParent: $('#'+modal_use),
            width: '100%',
            ajax: {
                url: urlControllerSearchTypeLiability,
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

        $('#type_regime_id').select2({
            dropdownParent: $('#'+modal_use),
            width: '100%',
            ajax: {
                url: urlControllerSearchTypeRegime,
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

        $('#type_organization_id').select2({
            dropdownParent: $('#'+modal_use),
            width: '100%',
            ajax: {
                url: urlControllerSearchTypeOrganization,
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

        $('#type_currency_id').select2({
            dropdownParent: $('#'+modal_use),
            width: '100%',
            ajax: {
                url: urlControllerSearchCurrencies,
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

        $('#language_id').select2({
            dropdownParent: $('#'+modal_use),
            width: '100%',
            ajax: {
                url: urlControllerSearchLanguages,
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

        $('#type_document_identification_id').select2({
            dropdownParent: $('#'+modal_use),
            width: '100%',
            ajax: {
                url: urlControllerSearchTypeDocuments,
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

        $('#country_id').select2({
            dropdownParent: $('#'+modal_use),
            width: '100%',
            ajax: {
                url: urlControllerSearchCountries,
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
     * Función para dibujar el listado de empresas
     */
    function companies_draw(){

        var urlController='<?php echo $controller_companies_draw;?>';

        var form_data = new FormData();
        form_data.append('company_id', '<?php echo $company_id;?>');

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
                print('$("#body_page_content").html(`'.$spinner.'`)');
                ?>

            },
            complete: function(){
                //$('#loader').fadeOut();
            },
            success: function(data){
                $('#body_page_content').html(data);
                data_table_init('companies_table','<?php echo $controller_json;?>');

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
    /**
     * Función para dibujar el formulario para crear una empresa
     */
    function frm_company_draw(){

        $('#'+modal_use).modal("show");
        $("#"+modal_button).attr("data-form_id",1);
        var urlController='<?php echo $controller_draw;?>';

        var form_data = new FormData();
        form_data.append('company_id', '<?php echo $company_id;?>');

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
                select2_converter();

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


    /**
     * Función para dibujar el formulario para editar una empresa
     */
    function frm_company_edit_draw(item_id){

        $('#'+modal_use).modal("show");
        $("#"+modal_button).attr("data-form_id",2);
        $("#"+modal_button).attr("data-item_id",item_id);
        var urlController='<?php echo $controller_edit_draw;?>/'+item_id;

        var form_data = new FormData();
        form_data.append('company_id', '<?php echo $company_id;?>');

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
                select2_converter();

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



    /**
     * Función para pedir confirmacion para grabar los datos en la tabla empresas
     */
    function confirm_save_company(){

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
                save_company();
            }else{

                toastr.error('<?php echo lang('Ts5.confirm_process_cancel_text')?>');
            }
        });
    }
    /**
     * Función para grabar los datos en la tabla empresas
     */
    function save_company(){

        var urlControllerProcess='<?php echo $controller_save_company;?>';
        var btnSave = $("#modal_full_btn_save");
        var data_form_serialized=$('.ts_input').serialize();

        var form_data = new FormData();
            form_data.append('data_form_serialized',data_form_serialized);

        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                btnSave.val("Enviando");
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                btnSave.val("Guardar");
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        $('#'+modal_use).modal("hide");
                        companies_draw();
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
                btnSave.val("Guardar");
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

    /**
     * Función para pedir confirmacion para grabar los datos en la tabla empresas
     */
    function confirm_edit_company(item_id){

        Swal.fire({
            title: '<?php echo lang('Ts5.confirm_edit_title')?>',
            //text: "<?php echo lang('Ts5.confirm_text')?>",
            icon: 'warning',

            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?php echo lang('Ts5.confirm_button_ok')?>',
            cancelButtonText: '<?php echo lang('Ts5.confirm_button_cancel')?>'
        }).then((result) => {
            if (result.isConfirmed) {
                edit_company(item_id);
            }else{

                toastr.error('<?php echo lang('Ts5.confirm_process_cancel_text')?>');
            }
        });
    }
    /**
     * Función para grabar los datos en la tabla empresas
     */
    function edit_company(item_id){

        var urlControllerProcess='<?php echo $controller_edit_company;?>';
        var btnSave = $("#modal_full_btn_save");
        var data_form_serialized=$('.ts_input').serialize();

        var form_data = new FormData();
        form_data.append('data_form_serialized',data_form_serialized);
        form_data.append('item_id',item_id);

        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                btnSave.val("Enviando");
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                btnSave.val("Guardar");
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        $('#'+modal_use).modal("hide");
                        companies_draw();
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
                btnSave.val("Guardar");
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

    function buttons_data_table_events_add(){

        $('#btn_new_<?php echo $table_id;?>').on('click',function () {

            frm_company_draw();
        });

        $('.ts_button_edit').on('click',function () {

            $(this).removeAttr("href");
            frm_company_edit_draw($(this).attr("data-item_id"));
        });

    }

    /**
     * callback para agregar los eventos a los botones
     */
    $(document).ready( function () {

        companies_draw();
        $('#modal_full_btn_save').on('click',function () {
            var form_id=$(this).attr("data-form_id");
            var item_id=$(this).attr("data-item_id");
            if(form_id==1){
                confirm_save_company();
            }else if(form_id==2){
                confirm_edit_company(item_id);
            }else{
                toastr.error('<?php echo lang('Ts5.save_error_button')?>');
            }

        });
    });


</script>