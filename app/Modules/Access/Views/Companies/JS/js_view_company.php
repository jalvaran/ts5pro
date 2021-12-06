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
 * Este archivo contiene los scripts para el control de procesos en para la creacion de las empresas en el
 * api de factura y nomina electronica
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
    var div_messages="div_messages_api";

    function dropzone_certified(){
        Dropzone.autoDiscover = false;
        $("#company_certificate").hover(function () {
            $(".ts_dropzone").css("color","green");

        }, function () {
            $(".ts_dropzone").css("color","black");
        })
        urlQuery='<?php echo base_url('/access/companies/receive_certificate'); ?>';
        var item_id=$("#company_logo").attr("data-company_id");

        var myDropzone = new Dropzone("#company_certificate", { url: urlQuery,paramName: "company_certificate",maxFiles: 1,acceptedFiles: '.p12'});
        myDropzone.on("sending", function(file, xhr, formData) {

            formData.append("item_id", item_id);

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
                    $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");
                }else{
                    toastr.error(data.msg);
                    $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");

                }
            }else{
                alert(data);
                $('#'+div_messages).html(data);
            }

        });

    }

    function dropzone_logo(){
        Dropzone.autoDiscover = false;
        $("#company_logo").hover(function () {
            $(".ts_dropzone").css("color","green");

        }, function () {
            $(".ts_dropzone").css("color","black");
        })
        var item_id=$("#company_logo").attr("data-company_id");

        urlQuery='<?php echo base_url('/access/companies/receive_logo_company'); ?>';

        var myDropzone = new Dropzone("#company_logo", { url: urlQuery,paramName: "company_logo",maxFiles: 1,acceptedFiles: '.png'});
        myDropzone.on("sending", function(file, xhr, formData) {

            formData.append("item_id", item_id);

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
                    $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");
                }else{
                    toastr.error(data.msg);
                    $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");

                }
            }else{
                alert(data);
                $('#'+div_messages).html(data);
            }

        });


    }

    /**
     * Función para dibujar las opciones que se tienen en el api de documentos electrónicos
     */
    function company_view(id){
        $('#'+modal_use).modal("show");
        $("#"+modal_button).attr("data-form_id",3);

        var urlController='<?php echo $controller_view_company;?>/'+id;

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
                add_events_buttons_config_company();
                dropzone_certified();
                dropzone_logo();

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
        });//Fin petición ajax
    }

    function create_company_api(urlControllerProcess,item_id){


        var btnSave = $("#btn_crear_api");
        var form_data = new FormData();

        form_data.append('item_id',item_id);

        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('Ts5.creating_company')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");
                    }else{
                        toastr.error(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");

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
     * Actualiza los datos de una empresa en el api de soenac
     * @param urlControllerProcess
     * @param item_id
     */
    function update_company_api(urlControllerProcess,item_id){


        var btnSave = $("#btn_crear_api");
        var form_data = new FormData();

        form_data.append('item_id',item_id);

        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('Ts5.updating_company')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");
                    }else{
                        toastr.error(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");

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
     * crea el logo de la empresa en el api de soenac
     * @param urlControllerProcess
     * @param item_id
     */
    function create_logo_company_api(urlControllerProcess,item_id){


        var btnSave = $("#btn_create_logo");
        var form_data = new FormData();

        form_data.append('item_id',item_id);

        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('Ts5.creating_company')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");
                    }else{
                        toastr.error(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");

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
     * crea el software en la base de datos local y en el api de soenac
     * @param urlControllerProcess
     * @param item_id
     */
    function create_software(urlControllerProcess,item_id){


        var btnSave = $("#btn_create_logo");
        var data_form_serialized=$('.ts_input_software').serialize();

        var form_data = new FormData();

        form_data.append('item_id',item_id);
        form_data.append('data_form_serialized',data_form_serialized);

        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('Ts5.creating_software')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");
                    }else{
                        toastr.error(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");

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
     * crea el certificado digital en el api de soenac
     * @param urlControllerProcess
     * @param item_id
     */
    function create_certificate(urlControllerProcess,item_id){


        var btnSave = $("#btn_create_logo");
        var data_form_serialized=$('.ts_input_certificate').serialize();

        var form_data = new FormData();

        form_data.append('item_id',item_id);
        form_data.append('data_form_serialized',data_form_serialized);

        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('Ts5.creating_certificate')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");
                    }else{
                        toastr.error(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");

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
     * cambia el tipo de ambiente a pruebas o producción
     * @param urlControllerProcess
     * @param item_id
     * @param type_environment
     */
    function set_environment_api (urlControllerProcess,item_id,type_environment){


        var btnSave = $("#btn_create_logo");

        var form_data = new FormData();

        form_data.append('item_id',item_id);
        form_data.append('type_environment',type_environment);

        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('Ts5.set_environment')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");
                    }else{
                        toastr.error(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");

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
     * Coloca los valores de la resolucion en sus respectivos campos de texto
     */
    function set_valuesResolution(i){
        var btn_id="btn_"+i;

        $("#resolution_date").val($("#"+btn_id).attr("data-ResolutionDate"));
        $("#prefix").val($("#"+btn_id).attr("data-prefix"));
        $("#resolution").val($("#"+btn_id).attr("data-resolutionNumber"));
        $("#technical_key").val($("#"+btn_id).attr("data-TechnicalKey"));
        $("#from").val($("#"+btn_id).attr("data-FromNumber"));
        $("#to").val($("#"+btn_id).attr("data-ToNumber"));
        $("#date_from").val($("#"+btn_id).attr("data-ValidDateFrom"));
        $("#date_to").val($("#"+btn_id).attr("data-ValidDateTo"));
    }

    /**
     * obtiene las numeraciones asociadas a una empresa
     * @param urlControllerProcess
     * @param item_id
     * @param type_environment
     */
    function get_numeration(urlControllerProcess,item_id){


        var btnSave = $("#btn_create_logo");

        var form_data = new FormData();

        form_data.append('item_id',item_id);

        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('msg.get_numeration')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg)+"</code>");
                        $('#table_resolutions tbody').empty();
                        var resolution_list=data.msg_api.responseDian.Envelope.Body.GetNumberingRangeResponse.GetNumberingRangeResult.ResponseList;
                        var i=0;
                        $.each(resolution_list, function (index, item) {
                            i=i+1;
                            var newRow=
                                "<tr>"
                                +'<td><button id="btn_'+i+'" onclick="set_valuesResolution('+i+');" class="btn btn-primary" data-resolutionNumber="'+item.ResolutionNumber+'" data-ResolutionDate="'+item.ResolutionDate+'" data-Prefix="'+item.Prefix+'" data-FromNumber="'+item.FromNumber+'" data-ToNumber="'+item.ToNumber+'" data-ValidDateFrom="'+item.ValidDateFrom+'" data-ResolutionNumber="'+item.ResolutionNumber+'" data-ValidDateTo="'+item.ValidDateTo+'" data-TechnicalKey="'+item.TechnicalKey+'">Add</button></td>'
                                +"<td> </td>"
                                +"<td> </td>"
                                +"<td>"+item.ResolutionNumber+"</td>"
                                +"<td>"+item.ResolutionDate+"</td>"
                                +"<td>"+item.Prefix+"</td>"
                                +"<td>"+item.FromNumber+"</td>"
                                +"<td>"+item.ToNumber+"</td>"
                                +"<td>"+item.ValidDateFrom+"</td>"
                                +"<td>"+item.ValidDateTo+"</td>"
                                +"<td>"+item.TechnicalKey+"</td>"

                                +"</tr>";
                            $(newRow).appendTo("#table_resolutions tbody");
                        });

                    }else{
                        toastr.error(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");

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
     * crea una resolucion en la base de datos y en el api de soenac
     * @param urlControllerProcess
     * @param item_id
     */
    function create_resolution(urlControllerProcess,item_id){

        console.log("Entras")
        var btnSave = $("#btn_resolution_create");
        var data_form_serialized=$('.ts_input_resolution').serialize();

        var form_data = new FormData();

        form_data.append('item_id',item_id);
        form_data.append('data_form_serialized',data_form_serialized);

        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('msg.creating_resolution')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");
                    }else{
                        toastr.error(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");

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
     * crea una resolucion en la base de datos y en el api de soenac
     * @param urlControllerProcess
     * @param item_id
     */
    function delete_resolution(item_id,resolution_id){

        var urlControllerProcess='<?php echo base_url('/access/companies/delete_resolution') ?>'+'/'+item_id+'/'+resolution_id;
        var btnSave = $("#btn_resolution_create");

        var form_data = new FormData();

        form_data.append('item_id',item_id);

        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('msg.deleting_resolution')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");
                        get_resolutions(item_id);
                    }else{
                        toastr.error(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");

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
     * obtiene las resoluciones asociadas a una empresa
     * @param urlControllerProcess
     * @param item_id
     * @param type_environment
     */
    function get_resolutions(item_id){

        var urlControllerProcess='<?php echo base_url('/access/companies/get_resolutions') ?>'+'/'+item_id;

        var btnSave = $("#btn_create_logo");

        var form_data = new FormData();

        form_data.append('item_id',item_id);

        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('msg.get_resolutions')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg)+"</code>");
                        $('#table_resolutions tbody').empty();
                        var resolution_list=data.msg_api;
                        var i=0;
                        $.each(resolution_list, function (index, item) {
                            i=i+1;
                            var newRow=
                                "<tr>"
                                +'<td><button id="btn_delete_'+i+'" onclick="delete_resolution(`'+item_id+'`,`'+item.id+'`);" class="btn btn-danger" >Delete</button></td>'
                                +"<td>"+item.id+"</td>"
                                +"<td>"+item.type_document_id+"</td>"
                                +"<td>"+item.resolution+"</td>"
                                +"<td>"+item.resolution_date+"</td>"
                                +"<td>"+item.prefix+"</td>"
                                +"<td>"+item.from+"</td>"
                                +"<td>"+item.to+"</td>"
                                +"<td>"+item.date_from+"</td>"
                                +"<td>"+item.date_to+"</td>"
                                +"<td>"+item.technical_key+"</td>"


                                +"</tr>";
                            $(newRow).appendTo("#table_resolutions tbody");
                        });

                    }else{
                        toastr.error(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");

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

    function get_software(urlControllerProcess,item_id){


        var btnSave = $("#btn_get_software");

        var form_data = new FormData();

        form_data.append('item_id',item_id);

        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('msg.get_numeration')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");
                        
                    }else{
                        toastr.error(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");

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

    
    function get_certificates(urlControllerProcess,item_id){


        var btnSave = $("#btn_get_certificate");

        var form_data = new FormData();

        form_data.append('item_id',item_id);

        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('msg.get_numeration')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");
                        
                    }else{
                        toastr.error(data.msg);
                        $('#'+div_messages).html("<code>"+JSON.stringify(data.msg_api)+"</code>");

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
     * agrega los eventos a los botones de la vista configuracion
     */
    function add_events_buttons_config_company(){

        $('#btn_create_api').on('click',function () {
            var item_id=$(this).attr("data-item_id");
            var controller='<?php echo base_url('/access/companies/api_create_company') ?>'+'/'+item_id;
            create_company_api(controller,item_id);
        });

        $('#btn_update_api').on('click',function () {
            var item_id=$(this).attr("data-item_id");
            var controller='<?php echo base_url('/access/companies/api_update_company') ?>'+'/'+item_id;
            update_company_api(controller,item_id);
        });
        $('#btn_create_logo').on('click',function () {
            var item_id=$(this).attr("data-item_id");
            var controller='<?php echo base_url('/access/companies/create_logo_company_api') ?>'+'/'+item_id;
            create_logo_company_api(controller,item_id);
        });

        $('#btn_create_software').on('click',function () {
            var item_id=$(this).attr("data-item_id");
            var controller='<?php echo base_url('/access/companies/create_software') ?>'+'/'+item_id;
            create_software(controller,item_id);
        });

        $('#btn_create_certificate').on('click',function () {
            var item_id=$(this).attr("data-item_id");
            var controller='<?php echo base_url('/access/companies/create_certificate') ?>'+'/'+item_id;
            create_certificate(controller,item_id);
        });

        $('#btn_environment_test').on('click',function () {
            var item_id=$(this).attr("data-item_id");
            var controller='<?php echo base_url('/access/companies/set_environment_api') ?>'+'/'+item_id;
            set_environment_api(controller,item_id,2);
        });
        $('#btn_environment_production').on('click',function () {
            var item_id=$(this).attr("data-item_id");
            var controller='<?php echo base_url('/access/companies/set_environment_api') ?>'+'/'+item_id;
            set_environment_api(controller,item_id,1);
        });

        $('#btn_get_numeration').on('click',function () {
            var item_id=$(this).attr("data-item_id");
            var controller='<?php echo base_url('/access/companies/get_numeration') ?>'+'/'+item_id;
            get_numeration(controller,item_id);
        });

        $('#btn_resolution_create').on('click',function () {
            var item_id=$(this).attr("data-item_id");
            var controller='<?php echo base_url('/access/companies/create_resolution') ?>'+'/'+item_id;
            create_resolution(controller,item_id);
        });

        $('#btn_get_resolutions').on('click',function () {
            var item_id=$(this).attr("data-item_id");

            get_resolutions(item_id);
        });
        
        $('#btn_get_software').on('click',function () {
            var item_id=$(this).attr("data-item_id");
            var controller='<?php echo base_url('/access/companies/get_software') ?>'+'/'+item_id;
            get_software(controller,item_id);
        });
        
        $('#btn_get_certificate').on('click',function () {
            var item_id=$(this).attr("data-item_id");
            var controller='<?php echo base_url('/access/companies/get_certificates') ?>'+'/'+item_id;
            get_software(controller,item_id);
        });

    }


</script>
