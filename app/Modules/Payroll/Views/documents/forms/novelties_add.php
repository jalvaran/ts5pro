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
 * Este archivo el formulario para asociar los empleados a una nomina
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-11-28
 * @updated 2021-11-28
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */
?>
<br>
    
<div class="row">
    <div class="col-md-12"> 
        <div class="card border-top border-0 border-4 border-primary">
            <div class="card-body p-3">
                <div class="card-title d-flex align-items-center">
                        <div><i class="fa fa-save me-1 font-22 text-primary"></i>
                        </div>
                        <h5 class="mb-0 text-primary"><?=lang('payroll.novelties_add_title').$data_form["consecutive"].' '.$data_form["description"]?></h5>
                       
                </div>
                <div class="col-md-6">
                    <label for="payroll_employee_id" class="form-label"><?=lang('fields.payroll_employee_id')?></label>
                    <?php

                    print('<select id="payroll_employee_id" name="payroll_employee_id" data-document_id="'.$id.'" class="form-control ts_input" >');
                        print('<option value="">'.lang('msg.option_select').'</option>');
                        foreach ($data_employees as $key => $value) {
                            print('<option value="'.$value["payroll_employee_id"].'">'.$value["name"].' '.$value["identification"].'</option>');
                        }
                    print('</select>')
                    ?>
                </div>  
                 <hr>
                    <ul class="nav nav-tabs nav-success" role="tablist">
                            <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
                                            <div class="d-flex align-items-center">
                                                    <div class="tab-icon"><i class="fa fa-plus-circle font-18 me-1"></i>
                                                    </div>
                                                    <div class="tab-title"><?=lang('payroll.earns')?></div>
                                            </div>
                                    </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false">
                                            <div class="d-flex align-items-center">
                                                    <div class="tab-icon"><i class="fa fa-minus-circle font-18 me-1"></i>
                                                    </div>
                                                    <div class="tab-title"><?=lang('payroll.deductions')?></div>
                                            </div>
                                    </a>
                            </li>

                    </ul>
                    <div class="tab-content py-3">
                            <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
                                   
                                <div class="row">
                                            
                                            <div class="col-md-6">
                                                <label for="payroll_type_earn_id" class="form-label"><?=lang('fields.payroll_type_earn_id')?></label>
                                                <?php
                                                print('<select id="payroll_type_earn_id" name="payroll_type_earn_id" data-document_id="'.$id.'" class="form-control ts_input" >');
                                                    print('<option value="">'.lang('msg.option_select').'</option>');
                                                    foreach ($data_earns as $key => $value) {
                                                        print('<option value="'.$value["id"].'">'.$value["description"].'</option>');
                                                    }
                                                print('</select>')
                                                ?>
                                            </div>  
                                            
                                            <div id="div_form_fields_earns" class="row">
                                                
                                                
                                            </div>
                                            
                                        </div>
                                
                                
                                
                            </div>
                            <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                                    <div class="row">
                                            
                                            <div class="col-md-6">
                                                <label for="payroll_type_deduction_id" class="form-label"><?=lang('fields.payroll_type_deduction_id')?></label>
                                                <?php
                                                print('<select id="payroll_type_deduction_id" name="payroll_type_deduction_id" data-document_id="'.$id.'" class="form-control ts_input" >');
                                                    print('<option value="">'.lang('msg.option_select').'</option>');
                                                    foreach ($data_deductions as $key => $value) {
                                                        print('<option value="'.$value["id"].'">'.$value["description"].'</option>');
                                                    }
                                                print('</select>')
                                                ?>
                                            </div>  
                                            
                                            <div id="div_form_fields_deductions" class="row">
                                                
                                                
                                            </div>
                                            
                                        </div>
                                
                                
                            </div>

                    </div>
            </div>
    </div>
    </div>
   
    <div id="div_sumary_noventlies" class="col-md-12">
        
    </div>
    
</div>
