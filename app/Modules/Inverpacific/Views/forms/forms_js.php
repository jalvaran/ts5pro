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
        
    }
   
</script>

