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

    function dropzone_certified(){
        Dropzone.autoDiscover = false;
        $("#company_certificate").hover(function () {
            $(".ts_dropzone").css("color","green");

        }, function () {
            $(".ts_dropzone").css("color","black");
        })
        urlQuery='procesadores/admin_empresas.process.php';
        var empresa_id=$("#company_certificate").data("empresa_id");

        var myDropzone = new Dropzone("#company_certificate", { url: urlQuery,paramName: "certificado_empresa",maxFiles: 1,acceptedFiles: '.p12'});
        myDropzone.on("sending", function(file, xhr, formData) {

            formData.append("Accion", 4);
            formData.append("empresa_id", empresa_id);

        });

        myDropzone.on("addedfile", function(file) {
            file.previewElement.addEventListener("click", function() {
                myDropzone.removeFile(file);
            });
        });

        myDropzone.on("success", function(file, data) {

            var respuestas = data.split(';');
            if(respuestas[0]=="OK"){
                toastr.success(respuestas[1]);

            }else if(respuestas[0]=="E1"){
                toastr.warning(respuestas[1]);
            }else{
                swal(data);
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
        urlQuery='procesadores/admin_empresas.process.php';
        var empresa_id=$("#company_logo").data("empresa_id");

        var myDropzone = new Dropzone("#company_logo", { url: urlQuery,paramName: "certificado_empresa",maxFiles: 1,acceptedFiles: '.png'});
        myDropzone.on("sending", function(file, xhr, formData) {

            formData.append("Accion", 4);
            formData.append("empresa_id", empresa_id);

        });

        myDropzone.on("addedfile", function(file) {
            file.previewElement.addEventListener("click", function() {
                myDropzone.removeFile(file);
            });
        });

        myDropzone.on("success", function(file, data) {

            var respuestas = data.split(';');
            if(respuestas[0]=="OK"){
                toastr.success(respuestas[1]);

            }else if(respuestas[0]=="E1"){
                toastr.warning(respuestas[1]);
            }else{
                swal(data);
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


</script>
