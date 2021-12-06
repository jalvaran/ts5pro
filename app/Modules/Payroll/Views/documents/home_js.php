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
 * Este archivo contiene el javascript para controlar lo procesos del modulo de nomina
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-11-26
 * @updated 2021-11-26
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */
?>
<script>
    
    function graphics_animate(){
	"use strict";
	// chart 1
	var options = {
		series: [{
			
			data: [240, 160, 671, 414, 555, 257, 901, 613, 727, 414, 555, 257]
		}],
		chart: {
			type: 'area',
			height: 65,
			toolbar: {
				show: false
			},
			zoom: {
				enabled: false
			},
			dropShadow: {
				enabled: true,
				top: 3,
				left: 14,
				blur: 4,
				opacity: 0.12,
				color: '#f41127',
			},
			sparkline: {
				enabled: true
			}
		},
		markers: {
			size: 0,
			colors: ["#f41127"],
			strokeColors: "#fff",
			strokeWidth: 2,
			hover: {
				size: 7,
			}
		},
		plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '45%',
				endingShape: 'rounded'
			},
		},
		dataLabels: {
			enabled: false
		},
		stroke: {
			show: true,
			width: 2.4,
			curve: 'smooth'
		},
		colors: ["#f41127"],
		xaxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		},
		fill: {
			opacity: 1
		},
		tooltip: {
			theme: 'dark',
			fixed: {
				enabled: false
			},
			x: {
				show: false
			},
			y: {
				title: {
					formatter: function (seriesName) {
						return ''
					}
				}
			},
			marker: {
				show: false
			}
		}
	};
	var chart = new ApexCharts(document.querySelector("#chart1"), options);
	chart.render();
	// chart 2
	var options = {
		series: [{
			name: 'Total Income',
			data: [240, 160, 671, 414, 555, 257, 901, 613, 727, 414, 555, 257]
		}],
		chart: {
			type: 'area',
			height: 65,
			toolbar: {
				show: false
			},
			zoom: {
				enabled: false
			},
			dropShadow: {
				enabled: true,
				top: 3,
				left: 14,
				blur: 4,
				opacity: 0.12,
				color: '#8833ff',
			},
			sparkline: {
				enabled: true
			}
		},
		markers: {
			size: 0,
			colors: ["#8833ff"],
			strokeColors: "#fff",
			strokeWidth: 2,
			hover: {
				size: 7,
			}
		},
		plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '45%',
				endingShape: 'rounded'
			},
		},
		dataLabels: {
			enabled: false
		},
		stroke: {
			show: true,
			width: 2.4,
			curve: 'smooth'
		},
		colors: ["#8833ff"],
		xaxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		},
		fill: {
			opacity: 1
		},
		tooltip: {
			theme: 'dark',
			fixed: {
				enabled: false
			},
			x: {
				show: false
			},
			y: {
				title: {
					formatter: function (seriesName) {
						return ''
					}
				}
			},
			marker: {
				show: false
			}
		}
	};
	var chart = new ApexCharts(document.querySelector("#chart2"), options);
	chart.render();
	
	// chart 4
	var options = {
		series: [{
			name: 'Comments',
			data: [240, 160, 671, 414, 555, 257, 901, 613, 727, 414, 555, 257]
		}],
		chart: {
			type: 'area',
			height: 65,
			toolbar: {
				show: false
			},
			zoom: {
				enabled: false
			},
			dropShadow: {
				enabled: true,
				top: 3,
				left: 14,
				blur: 4,
				opacity: 0.12,
				color: '#29cc39',
			},
			sparkline: {
				enabled: true
			}
		},
		markers: {
			size: 0,
			colors: ["#29cc39"],
			strokeColors: "#fff",
			strokeWidth: 2,
			hover: {
				size: 7,
			}
		},
		plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '45%',
				endingShape: 'rounded'
			},
		},
		dataLabels: {
			enabled: false
		},
		stroke: {
			show: true,
			width: 2.4,
			curve: 'smooth'
		},
		colors: ["#29cc39"],
		xaxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		},
		fill: {
			opacity: 1
		},
		tooltip: {
			theme: 'dark',
			fixed: {
				enabled: false
			},
			x: {
				show: false
			},
			y: {
				title: {
					formatter: function (seriesName) {
						return ''
					}
				}
			},
			marker: {
				show: false
			}
		}
	};
	var chart = new ApexCharts(document.querySelector("#chart4"), options);
	chart.render();
        
        
        }
      
    var list_id='1';
    var page=1;
    var general_div="div_content_list";
    
    
    /**
     * Selecciona el listado que se debe mostrar segun un id
     */
    function select_list(){
        
        if(list_id==1){
            general_documents_draw();
        }
        if(list_id==2){
            individual_documents_draw();
        }
        if(list_id==3){
            notes_documents_draw();
        }
                
    }
      
    /**
     * Dibuja el historial de las notas de nomina
     */
    function notes_documents_draw(){

        var search=$('#search').val();

        var urlControllerDraw ='<?= base_url('payroll/notes_documents_draw')?>';
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
     * Dibuja el historial de los documentos individuales
     */
    function individual_documents_draw(){

        var search=$('#search').val();

        var urlControllerDraw ='<?= base_url('payroll/individual_documents')?>';
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
     * Dibuja el historial de los documentos generales
     */
    function general_documents_draw(){

        var search=$('#search').val();

        var urlControllerDraw ='<?= base_url('payroll/general_documents')?>';
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
    function form_general_document(id=''){
        $('#modal_xl').modal("show");
        $(".ts_btn_save_modals").attr("data-form_id",1);        
        $(".ts_btn_save_modals").attr("data-id",id);
        var urlControllerDraw ='<?= base_url('payroll/form_general_document')?>';
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
                $('.ts_modal_body').html('');
                $('#modal_xl_body').html(data);
                select2_general_documents_form();
                
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
    
    function select2_general_documents_form(){
        $('#payroll_period_id').unbind();
                
        $('#payroll_period_id').select2({
            dropdownParent: $('#modal_xl'),
            width: '100%',
            ajax: {
                url: '<?php echo base_url('/payroll/period_id_searches') ?>',
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
                    save_general_document(id);
                }
                if(form_id == '2'){
                    build_individual_documents(id);
                }
                if(form_id == '3'){
                    report_individual_document(id);
                }
                
                if(form_id == '5'){
                    save_note(id);
                }
                
                if(form_id == '6'){
                    report_note(id);
                }
                
            }else{

                toastr.error('<?php echo lang('Ts5.confirm_process_cancel_text')?>');
            }
        });
        
        
        
    }
    
    
    /**
    * obtiene el json para reportar una nomina

     * @param {type} id
     * @returns {undefined}    
     */
    function get_json_payroll_report(id){
        $('#modal_xl').modal("show");
        $(".ts_btn_save_modals").attr("data-form_id",4);        
        $(".ts_btn_save_modals").attr("data-id",id);        
        var urlControllerProcess='<?php echo base_url('/payroll/get_json_payroll_report') ?>';
        var btnSave = $(".ts_btn_code");
       
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
                show_spinner('<?=lang('msg.getting')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        //toastr.alert(data.msg);
                        $('.ts_modal_body').html('');
                        $('#modal_xl_body').html('<pre>'+data.msg+'</pre>');
                    }else{
                        toastr.error(data.msg);
                        if(data.msg_api){
                            alert(data.msg_api);
                        }  
                        if(data.object_id){
                            error_mark(data.object_id);
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
    
    
    /**
    * obtiene el json para reportar una nota de nomina

     * @param {type} id
     * @returns {undefined}    
     */
    function get_json_payroll_note(id){
        $('#modal_xl').modal("show");
        $(".ts_btn_save_modals").attr("data-form_id",4);        
        $(".ts_btn_save_modals").attr("data-id",id);        
        var urlControllerProcess='<?php echo base_url('/payroll/get_json_payroll_note') ?>';
        var btnSave = $(".ts_btn_code");
       
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
                show_spinner('<?=lang('msg.getting')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        //toastr.alert(data.msg);
                        $('.ts_modal_body').html('');
                        $('#modal_xl_body').html('<pre>'+data.msg+'</pre>');
                    }else{
                        toastr.error(data.msg);
                        if(data.msg_api){
                            alert(data.msg_api);
                        }  
                        if(data.object_id){
                            error_mark(data.object_id);
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
    
    /**
    * reporta una nomina individual

     * @param {type} id
     * @returns {undefined}    
     */
    function report_individual_document(id){
           
        var urlControllerProcess='<?php echo base_url('/payroll/report_individual_document') ?>';
        var btnSave = $(".ts_btn_report");
       
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
                show_spinner('<?=lang('payroll.reporting_individual_documents')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        documents_counts();
                        select_list();
                    }else{
                        toastr.error(data.msg);
                        if(data.msg_api){
                            alert(data.msg_api);
                        }  
                        if(data.object_id){
                            error_mark(data.object_id);
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
    
    /**
    * reporta una nota de ajuste a nomina individual

     * @param {type} id
     * @returns {undefined}    
     */
    function report_note(id){
           
        var urlControllerProcess='<?php echo base_url('/payroll/report_note') ?>';
        var btnSave = $(".ts_btn_report");
       
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
                show_spinner('<?=lang('payroll.reporting_individual_documents')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        documents_counts();
                        select_list();
                    }else{
                        toastr.error(data.msg);
                        if(data.msg_api){
                            alert(data.msg_api);
                        }  
                        if(data.object_id){
                            error_mark(data.object_id);
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
    
    /**
    * Construir documentos de nomina individual

     * @param {type} id
     * @returns {undefined}    
     */
    function build_individual_documents(id){
                
        var urlControllerProcess='<?php echo base_url('/payroll/build_individual_documents') ?>';
        var btnSave = $(".ts_btn_generate");
       
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
                show_spinner('<?=lang('payroll.creating_individual_documents')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        documents_counts();
                        select_list();
                    }else{
                        toastr.error(data.msg);

                        if(data.object_id){
                            error_mark(data.object_id);
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
    
    
    /**
    * contar los documentos en los diferentes listados

     * @param {type} id
     * @returns {undefined}    
     */
    function documents_counts(){
         
        var urlControllerProcess='<?php echo base_url('/payroll/documents_counts') ?>';
       
        
        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            
            type: 'post',
           
            success: function(data){

                
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                       $('#count_list_1').text(data.count_list_1);
                       $('#count_list_2').text(data.count_list_2);
                       $('#count_list_3').text(data.count_list_3);
                       $('#count_list_4').text(data.count_list_4);
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
    
    /**
    * Grabar los datos de un documento general

     * @param {type} id
     * @returns {undefined}     */
    function save_general_document(id){
                
        var urlControllerProcess='<?php echo base_url('/payroll/save_general_document') ?>';
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
    
    /**
    * Grabar los datos de una nota de ajuste

     * @param {type} id
     * @returns {undefined}     */
    function save_note(id){
                
        var urlControllerProcess='<?php echo base_url('/payroll/save_note') ?>';
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
    
    
    /**
     * Dibuja el formulario para crear o editar un empleado
     */
    function employee_payroll_add_draw(id=''){
        $('#modal_xl').modal("show");
        $(".ts_btn_save_modals").attr("data-form_id",2);        
        $(".ts_btn_save_modals").attr("data-id",id);
        var urlControllerDraw ='<?= base_url('payroll/employee_payroll_add_draw')?>';
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
                $('.ts_modal_body').html('');
                $('#modal_xl_body').html(data);
                avaible_employees_list(id);
                added_employees_list(id);
                
                
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
     * Dibuja el listado de los empleados disponibles
     */
    function added_employees_list(id=''){
        
        var urlControllerDraw ='<?= base_url('payroll/added_employees_list')?>';
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
                
                $('#div_added_employees').html(data);
                event_added_employees_list();
                
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
    
    function event_added_employees_list(){
        $(".ts_btn_delete_employee").unbind();
        $('.ts_btn_delete_employee').on('click',function () {
            var id=$(this).attr("data-id");  
            var general_document_id=$(this).attr("data-general_document_id"); 
            
            employee_delete_general_document(general_document_id,id);                   
            
        });
        
        $("#btn_delete_empleyees_all").unbind();
        $('#btn_delete_empleyees_all').on('click',function () {
            
            var general_document_id=$(this).attr("data-general_document_id"); 
            
            employee_delete_all_general_document(general_document_id);                   
            
        });
    }
    
    
    /**
    * eliminar un empleado a un documento general de nomina

     * @param {type} id
     * @returns {undefined}     */
    function employee_delete_general_document(general_document_id,id){
                
        var urlControllerProcess='<?php echo base_url('/payroll/employee_delete_general_document') ?>';
        var btnSave = $(".ts_btn_add_employees");
          
        var form_data = new FormData();

            form_data.append('id',id);
            form_data.append('general_document_id',general_document_id);
        
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
                        added_employees_list(general_document_id);
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
    
    
    /**
     * Dibuja el listado de los empleados disponibles
     */
    function avaible_employees_list(id=''){
        
        var urlControllerDraw ='<?= base_url('payroll/avaible_employees_list')?>';
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
                
                $('#div_available_employees').html(data);
                event_avaible_employees_list();
                
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
    
    function event_avaible_employees_list(){
        $(".ts_btn_add_employees").unbind();
        $('.ts_btn_add_employees').on('click',function () {
            var id=$(this).attr("data-id");  
            var general_document_id=$(this).attr("data-general_document_id"); 
            
            employee_add(general_document_id,id);                   
            
        });
        
        $("#btn_add_empleyees_all").unbind();
        $('#btn_add_empleyees_all').on('click',function () {
            
            var general_document_id=$(this).attr("data-general_document_id"); 
            
            employee_add_all_general_document(general_document_id);                   
            
        });
        
    }
    
    
    /**
    * agregar un empleado a un documento general de nomina

     * @param {type} id
     * @returns {undefined}     */
    function employee_add(general_document_id,id){
                
        var urlControllerProcess='<?php echo base_url('/payroll/employee_add') ?>';
        var btnSave = $(".ts_btn_add_employees");
          
        var form_data = new FormData();

            form_data.append('id',id);
            form_data.append('general_document_id',general_document_id);
        
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
                        added_employees_list(general_document_id);
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
    
    
    /**
    * agregar todos los empleados de un documento general de nomina

     * @param {type} id
     * @returns {undefined}     
     * */
    function employee_add_all_general_document(general_document_id){
                
        var urlControllerProcess='<?php echo base_url('/payroll/employee_add_all_general_document') ?>';
        var btnSave = $(".ts_btn_add_employees");
          
        var form_data = new FormData();

            form_data.append('general_document_id',general_document_id);
        
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
                        added_employees_list(general_document_id);
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
    
    /**
    * eliminar todos los empleados de un documento general de nomina

     * @param {type} id
     * @returns {undefined}     
     * */
    function employee_delete_all_general_document(general_document_id){
                
        var urlControllerProcess='<?php echo base_url('/payroll/employee_delete_all_general_document') ?>';
        var btnSave = $(".ts_btn_add_employees");
          
        var form_data = new FormData();

            form_data.append('general_document_id',general_document_id);
        
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
                        added_employees_list(general_document_id);
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
    
    /**
    * consultar el estado de un documento de nomina electronica por medio del zip key

     * @param {type} id
     * @returns {undefined}     
     * */
    function check_status_zip_key(id,zip_key){
                
        var urlControllerProcess='<?php echo base_url('/payroll/check_status_zip_key') ?>';
        var btnSave = $(".ts_btn_status_zip_key");
          
        var form_data = new FormData();

            form_data.append('id',id);
            form_data.append('zip_key',zip_key);
            form_data.append('list_id',list_id);
        
        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('payroll.consulting_document')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);                        
                        added_employees_list(general_document_id);
                    }else{
                        toastr.error(data.msg);
                        if(data.msg_api){
                            alert(data.msg_api);
                        }   
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
    
    
    /**
     * Dibuja el formulario para agregar novedades a una nomina
     */
    
    function novelties_form(id){
        $('#modal_xl').modal("show");
        $(".ts_btn_save_modals").attr("data-form_id",4);        
        $(".ts_btn_save_modals").attr("data-id",id);
        var urlControllerDraw ='<?= base_url('payroll/novelties_form')?>';
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
                $('.ts_modal_body').html('');
                $('#modal_xl_body').html(data);
                event_add_novelties_form();
                $('#payroll_employee_id').select2({
                                        dropdownParent: $('#modal_xl'),
                                        width: '100%'});
                $('#payroll_type_earn_id').select2({
                                        dropdownParent: $('#modal_xl'),
                                        width: '100%'});
                $('#payroll_type_deduction_id').select2({
                                        dropdownParent: $('#modal_xl'),
                                        width: '100%'});                    
                                    
                sumary_noventlies_general(id);                   
                
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
     * Dibuja los campos necesarios por cada devengado seleccionado 
     */
    
    function novelties_form_fields_earns(document_id,id){
        
        var urlControllerDraw ='<?= base_url('payroll/novelties_form_fields_earns')?>';
        var form_data = new FormData();
            form_data.append('document_id',document_id);     
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
                $('#div_form_fields_deductions').html('');
                $('#div_form_fields_earns').html(data);
                event_add_novelties_fields_form();            
                
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
     * Dibuja los campos necesarios por cada deduccion seleccionado 
     */
    
    function novelties_form_fields_deductions(document_id,id){
        
        var urlControllerDraw ='<?= base_url('payroll/novelties_form_fields_deductions')?>';
        var form_data = new FormData();
            form_data.append('document_id',document_id);     
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
                $('#div_form_fields_earns').html('');
                $('#div_form_fields_deductions').html(data);
                event_add_novelties_fields_form();            
                
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
    
    
    function event_add_novelties_fields_form(){
    
        $("#btn_add_earn").unbind();        
        $("#btn_add_earn").on('click',function () {
            var document_id = $(this).attr("data-document_id");            
            add_earn(document_id);
        });
        
        $("#btn_add_deduction").unbind();        
        $("#btn_add_deduction").on('click',function () {
            var document_id = $(this).attr("data-document_id");            
            add_deduction(document_id);
        });
        
        $("#quantity").unbind();
        if($('#type_time_id').length){
            $("#quantity").on('change',function () {
                var document_id = $(this).attr("data-document_id");            
                times_value_calculation(document_id);
            });
            $("#type_time_id").unbind();
            $("#type_time_id").on('change',function () {
                var document_id = $(this).attr("data-document_id");            
                times_value_calculation(document_id);
            });
        }
        
        
    }
    
    function times_value_calculation(document_id){
        var urlControllerProcess='<?php echo base_url('/payroll/times_value_calculation') ?>';
        var type_time_id=$("#type_time_id").val();
        var quantity=$("#quantity").val();
        var payroll_employee_id=$("#payroll_employee_id").val();
        var form_data = new FormData();

            form_data.append('document_id',document_id);
            form_data.append('type_time_id',type_time_id);
            form_data.append('quantity',quantity);
            form_data.append('payroll_employee_id',payroll_employee_id);
        
        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('msg.calculated')?>');
                
            },
            success: function(data){

                hide_spinner();
                
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        quantity=$("#payment").val(data.payment);
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
    * agrega un devengado

     * @param {type} document_id
     * @returns {undefined}     */
    function add_earn(document_id){
                
        var urlControllerProcess='<?php echo base_url('/payroll/add_earn') ?>';
        var btnSave = $("#btn_add_earn");
        var data_form_serialized=$('.ts_input').serialize(); 
        
        var form_data = new FormData();

            form_data.append('document_id',document_id);
            
            form_data.append('data_form_serialized',data_form_serialized);
        
        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('msg.adding')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        sumary_noventlies_general(document_id);
                        $(".ts_input").css("background-color","transparent");
                        $(".select2-selection__rendered").css("background-color","transparent");
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
    
    
    /**
    * agrega una deduccion

     * @param {type} document_id
     * @returns {undefined}     */
    function add_deduction(document_id){
                
        var urlControllerProcess='<?php echo base_url('/payroll/add_deduction') ?>';
        var btnSave = $("#btn_add_deduction");
        var data_form_serialized=$('.ts_input').serialize(); 
        
        var form_data = new FormData();

            form_data.append('document_id',document_id);
            
            form_data.append('data_form_serialized',data_form_serialized);
        
        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('msg.adding')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        sumary_noventlies_general(document_id);
                        $(".ts_input").css("background-color","transparent");
                        $(".select2-selection__rendered").css("background-color","transparent");
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
    
    
    function event_add_novelties_form(){
    
        $("#payroll_type_earn_id").unbind();        
        $("#payroll_type_earn_id").on('change',function () {
            var document_id = $(this).attr("data-document_id");
            var id = $(this).val();
            novelties_form_fields_earns(document_id,id);
        });
        
        $("#payroll_type_deduction_id").unbind();        
        $("#payroll_type_deduction_id").on('change',function () {
            var document_id = $(this).attr("data-document_id");
            var id = $(this).val();
            novelties_form_fields_deductions(document_id,id);
        });
        
        
    }
    
    /**
    * elimina un devengado o una deduccion

     * @param {type} document_id
     * @returns {undefined}     */
    function delete_earn_deduction_noventlie(document_id,id,earn_deduction){
                
        var urlControllerProcess='<?php echo base_url('/payroll/delete_earn_deduction_noventlie') ?>';
        var btnSave = $(".ts_btn_delete_earn_deduction");
        
        var form_data = new FormData();

            form_data.append('document_id',document_id);            
            form_data.append('id',id);
            form_data.append('earn_deduction',earn_deduction);
        
        $.ajax({
            url: urlControllerProcess,

            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                show_spinner('<?=lang('msg.deleting')?>');
                btnSave.attr("disabled","disabled");

            },
            success: function(data){

                hide_spinner();
                btnSave.removeAttr("disabled");
                if(typeof(data)=='object'){
                    if(data.status==1){// el controlador contesta 1 si se realiza el proceso sin novedad
                        toastr.success(data.msg);
                        sumary_noventlies_general(document_id);
                        
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
    
    
    /**
     * Dibuja el resumen de novedades de un documento general
     */
    function sumary_noventlies_general(id){
        
        var urlControllerDraw ='<?= base_url('payroll/sumary_noventlies_general')?>';
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
                $('#div_sumary_noventlies').html(data);                
                events_sumary_noventlies(id);                
                
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
    
    function events_sumary_noventlies(){
        $(".ts_btn_delete_earn_deduction").unbind();        
        $(".ts_btn_delete_earn_deduction").on('click',function () {
            var document_id = $(this).attr("data-document_id");
            var id = $(this).attr("data-id");
            var earn_deduction = $(this).attr("data-earn_deduction");
            delete_earn_deduction_noventlie(document_id,id,earn_deduction);
        });
    }
    
    
    /**
     * Dibuja el formulario para agregar novedades a una nomina
     */
    
    function notes_form(id){
        $('#modal_xl').modal("show");
        $(".ts_btn_save_modals").attr("data-form_id",5);        
        $(".ts_btn_save_modals").attr("data-id",id);
        var urlControllerDraw ='<?= base_url('payroll/notes_form')?>';
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
    
    function event_add_list(){
    
        $(".ts_btn_page").unbind();        
        $(".ts_btn_page").on('click',function () {
            page = $(this).attr("data-page");
            select_list();
        });
        
                
        $(".ts_btn_edit").unbind();
        $('.ts_btn_edit').on('click',function () {
            var id=$(this).attr("data-id");            
            if(list_id==1){
                form_general_document(id);
            }           
            
        });
        
        $(".ts_btn_employees").unbind();
        $('.ts_btn_employees').on('click',function () {
            var id=$(this).attr("data-id");            
            if(list_id==1){
                employee_payroll_add_draw(id);
            }           
            
        });
        
        $(".ts_btn_generate").unbind();
        $('.ts_btn_generate').on('click',function () {
            var id=$(this).attr("data-id");            
            
                confirm_save(id,2);
          
            
        });
        
        $(".ts_btn_report").unbind();
        $('.ts_btn_report').on('click',function () {
            var id=$(this).attr("data-id");            
            if(list_id==2){
                confirm_save(id,3);
            }
            if(list_id==3){
                confirm_save(id,6);
            }
        });
        
        $(".ts_btn_status_zip_key").unbind();
        $('.ts_btn_status_zip_key').on('click',function () {
            var id=$(this).attr("data-id");  
            var zip_key=$(this).attr("data-zip_key");             
            check_status_zip_key(id,zip_key);
            
        });
        
        $(".ts_btn_code").unbind();
        $('.ts_btn_code').on('click',function () {
            var id=$(this).attr("data-id");  
            if(list_id==2){
                get_json_payroll_report(id);
            }
            if(list_id==3){
                get_json_payroll_note(id);
            }
        });
        
        $(".ts_btn_novelties").unbind();
        $('.ts_btn_novelties').on('click',function () {
            var id=$(this).attr("data-id");  
            if(list_id==1){
                novelties_form(id);
            }
        });
        
        $(".ts_btn_delete").unbind();
        $('.ts_btn_delete').on('click',function () {
            var id=$(this).attr("data-id");  
            if(list_id==2){
                notes_form(id);
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
            if(list_id==1){
                form_general_document();
            }
                
            
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

        graphics_animate();
        documents_counts();
    });
        
        
        
    
</script>

