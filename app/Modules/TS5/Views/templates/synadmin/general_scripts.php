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
            buttons_data_table_events_add_2(table_id);
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

    function data_table_draw(table_id,data_table,function_name){

        var urlControllerDraw ='<?= base_url('ts5/tables_draw')?>'+'/'+data_table+'/'+table_id;
        var urlControllerJson='<?= base_url('ts5/tables_json')?>'+'/'+data_table;
        //console.log(urlControllerDraw);
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
                data_table_init_2(table_id,urlControllerJson);

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


    function frm_tables_draw(id,data_table,table_id){
        $('#modal_xl').modal("show");

        $(".ts_btn_save_modals").attr("data-data_table",data_table);
        $(".ts_btn_save_modals").attr("data-id",id);
        $(".ts_btn_save_modals").attr("data-table_id",table_id);
        if(id=='NA'){
            $(".ts_btn_save_modals").attr("data-form_id",1);
        }else{
            $(".ts_btn_save_modals").attr("data-form_id",2);
        }
        var urlControllerDraw ='<?= base_url('ts5/frm_tables_draw')?>'+'/'+id+'/'+data_table;
        var form_data = new FormData();

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
                $('#modal_xl_body').html(data);
                select2_forms_converter();

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

    function confirm_save_register(data_table,table_id){

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
                create_register(data_table,table_id);
            }else{

                toastr.error('<?php echo lang('Ts5.confirm_process_cancel_text')?>');
            }
        });
    }

    function create_register(data_table,table_id){

        var urlControllerProcess='<?php echo base_url('/ts5/tables_create_register') ?>';
        var btnSave = $(".ts_btn_save_modals");
        var data_form_serialized=$('.ts_input').serialize();
        var form_data = new FormData();

        form_data.append('data_table',data_table);
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

                        eval(table_id+"_draw()");
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
        });//Fin peticion ajax
    }

    function confirm_edit_register(id,data_table,table_id){

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
                edit_register(id,data_table,table_id);
            }else{

                toastr.error('<?php echo lang('Ts5.confirm_process_cancel_text')?>');
            }
        });
    }

    function edit_register(id,data_table,table_id){

        var urlControllerProcess='<?php echo base_url('/ts5/tables_edit_register') ?>';
        var btnSave = $(".ts_btn_save_modals");
        var data_form_serialized=$('.ts_input').serialize();
        var form_data = new FormData();

        form_data.append('data_table',data_table);
        form_data.append('edit_id',id);
        form_data.append('data_form_serialized',data_form_serialized);

        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('msg.editing')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        $('#modal_xl').modal("hide");
                        eval(table_id+"_draw()");

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
        });//Fin peticion ajax
    }

    function theme_sidebar(id){
        if(id==null){
            return;
        }
        $('html').attr('class', 'color-sidebar sidebarcolor'+id);
    }
    
    function theme_header(id){
        if(id==null){
            return;
        }
        $("html").removeClass("headercolor1 headercolor2 headercolor3 headercolor4 headercolor5 headercolor6 headercolor7 headercolor8");
        $("html").addClass("color-header headercolor"+id);
        
    }
    
    function selector_theme_mode(){
        var dark_mode = Cookies.get('dark-mode');
        
        if(dark_mode==1){
            
            $('#btn_dark_mode').attr('data-id',0);
            $('#btn_dark_mode').removeClass("fa fa-moon");
            $('#btn_dark_mode').addClass("fa fa-sun");
            $('html').attr('class', 'dark-theme');
        }else{
            
            $('#btn_dark_mode').attr('data-id',1);
            $('#btn_dark_mode').removeClass("fa fa-sun");
            $('#btn_dark_mode').addClass("fa fa-moon");
            $('html').attr('class', 'light-theme');
            theme_sidebar('<?=$theme_sidebar?>');
            theme_header('<?=$theme_header?>');
        }
        
    }
    
    selector_theme_mode();     
     
     
    $(document).ready( function () {       
       $('#btn_dark_mode').on('click',function () {
           var dark_mode = Cookies.get('dark-mode');
           if(dark_mode==1){
                Cookies.set('dark-mode',0, { sameSite: 'strict' });
           }else{
               Cookies.set('dark-mode',1, { sameSite: 'strict' });
            }
           selector_theme_mode();
           
       });
       
    });    
    
    
    function frm_thirds(id=""){
        $('#modal_xl').modal("show");
        var Controller='<?php echo base_url('/ts5/frm_thirds') ?>';
        $(this).attr("data-form_id",100);
        
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
   

</script>