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
 * Este archivo carga las funciones generales de javascript para la aplicación
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-08-26
 * @updated 2021-08-26
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */
?>
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    function show_spinner(msg=''){
        var cadena='';
        cadena +='<div id="spinner1" style="position:fixed;top: 50%;left: 50%;z-index:10000;text-align:center;color:red">';
        cadena +='<strong>'+msg+'</strong><br>';
        cadena += `<?= view('App\Modules\TS5\Views\templates\synadmin\spinner_page')?>`;
        cadena +='</div>';
        var spinner = $(cadena);
        $("#div_spinner").prepend(spinner);
    }

    function hide_spinner(){
        $("#spinner1").remove();
    }

    function error_mark(obj_id){
        var select2_id='select2-'+obj_id+'-container';

        $(".ts_input").css("background-color","transparent");
        $(".select2-selection__rendered").css("background-color","transparent");
        $("#"+obj_id).css("background-color","pink");
        $("#"+select2_id).css("background-color","pink");
        $("#"+obj_id).focus();
    }


    function data_table_init_2(table_id,urlControllerJson){

        $('#'+table_id).DataTable({

            ajax: urlControllerJson,

            order: [[ 0, "desc" ]],
            processing: true,
            serverSide: true,
            language: {

                processing:     "<?php echo lang('DataTables.processing') ?>",
                search:         "<?php echo lang('DataTables.search') ?>&nbsp;:",
                lengthMenu:     "<?php echo lang('DataTables.lengthMenu') ?>",
                info:           "<?php echo lang('DataTables.info') ?>",
                infoEmpty:      "<?php echo lang('DataTables.infoEmpty') ?>",
                infoFiltered:   "<?php echo lang('DataTables.infoFiltered') ?>",
                infoPostFix:    "<?php echo lang('DataTables.infoPostFix') ?>",
                loadingRecords: "<?php echo lang('DataTables.loadingRecords') ?>",
                zeroRecords:    "<?php echo lang('DataTables.zeroRecords') ?>",
                emptyTable:     "<?php echo lang('DataTables.emptyTable') ?>",
                paginate: {
                    first:      "<?php echo lang('DataTables.pag_first') ?>",
                    previous:   "<?php echo lang('DataTables.pag_previous') ?>",
                    next:       "<?php echo lang('DataTables.pag_next') ?>",
                    last:       "<?php echo lang('DataTables.pag_last') ?>"
                },
                aria: {
                    sortAscending:  ": <?php echo lang('DataTables.sortAscending') ?>",
                    sortDescending: ": <?php echo lang('DataTables.sortDescending') ?>"
                }
            },

        }).on('draw.dt', function () {
            buttons_data_table_events_add();
        });
    }


    function data_table_init(table_id,controller_data){

        $('#'+table_id).DataTable({

            language: {
                processing:     "<?php echo lang('DataTables.processing') ?>",
                search:         "<?php echo lang('DataTables.search') ?>&nbsp;:",
                lengthMenu:     "<?php echo lang('DataTables.lengthMenu') ?>",
                info:           "<?php echo lang('DataTables.info') ?>",
                infoEmpty:      "<?php echo lang('DataTables.infoEmpty') ?>",
                infoFiltered:   "<?php echo lang('DataTables.infoFiltered') ?>",
                infoPostFix:    "<?php echo lang('DataTables.infoPostFix') ?>",
                loadingRecords: "<?php echo lang('DataTables.loadingRecords') ?>",
                zeroRecords:    "<?php echo lang('DataTables.zeroRecords') ?>",
                emptyTable:     "<?php echo lang('DataTables.emptyTable') ?>",
                paginate: {
                    first:      "<?php echo lang('DataTables.pag_first') ?>",
                    previous:   "<?php echo lang('DataTables.pag_previous') ?>",
                    next:       "<?php echo lang('DataTables.pag_next') ?>",
                    last:       "<?php echo lang('DataTables.pag_last') ?>"
                },
                aria: {
                    sortAscending:  ": <?php echo lang('DataTables.sortAscending') ?>",
                    sortDescending: ": <?php echo lang('DataTables.sortDescending') ?>"
                }
            },

            order: [[ 0, "desc" ]],
            processing: true,
            serverSide: true,
            ajax: controller_data
        }).on('draw.dt', function () {
            buttons_data_table_events_add();
        });
    }

    $(function () {
        $( ".ts_card" )
            .mouseout(function() {
            $(this).css({ opacity: '1','transform' : 'rotate('+ 0 +'deg)'});
        })
            .mouseover(function() {
            $(this).css({ opacity: '0.8','transform' : 'rotate('+ 10 +'deg)'});
        });
    });


    function copyToClipboard(elemento) {
        var $temp = $("<input>")
        $("body").append($temp);
        $temp.val($(elemento).text()).select();
        document.execCommand("copy");
        $temp.remove();
        toastr.success("<?= lang('msg.copy_to_clipboard')?>");
    }

    function data_table_draw(table_id,model,module_id,permission_id,function_name){

        var urlControllerDraw ='<?= base_url('access/users/data_table_users')?>'+'/'+model+'/'+table_id+'/'+permission_id+'/'+module_id;
        var urlControllerJson='<?= base_url('access/users/jsonUsers')?>'+'/'+model+'/'+permission_id+'/'+module_id;

        var form_data = new FormData();

        $.ajax({
            url: urlControllerDraw,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('Cargando');

            },
            complete: function(){

            },
            success: function(data){
                hide_spinner();
                $('#div_'+table_id).html(data);
                data_table_init_2(table_id,urlControllerJson,model);

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
        });
    }


</script>