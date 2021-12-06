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
 * Este archivo el formulario para crear o editar un documento general de nomina
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-11-17
 * @updated 2021-11-17
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */
?>
<br>
<div class="row">
    <div class="col-md-12">
        
            <div class="card border-top border-0 border-4 border-danger">
                
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                            <div><i class="fa fa-save me-1 font-22 text-danger"></i>
                            </div>
                            <h5 class="mb-0 text-danger"><?=lang('payroll.general_document_form_title')?></h5>
                            
                    </div>
                    
                    <div class="row g-3">
                          
                        
                        <div class="col-3">
                            <label for="payroll_period_id" class="form-label"><?=lang('fields.payroll_period_id')?></label>
                            <div class="input-group"> 

                                <select id="payroll_period_id" name="payroll_period_id" class="form-select ts_input">

                                    <option value=""><?=lang('msg.option_select')?></option>

                                    <?php
                                        if(isset($data_form["payroll_period_id"])){
                                            print('<option value="'.$data_form["payroll_period_id"].'" selected>'.$data_form["payroll_period_name"].'</option>');
                                        }
                                    ?>

                                </select>    

                            </div>
                        </div>
                                                
                        <div class="col-md-3">
                                <label for="settlement_start_date" class="form-label"><?=lang('fields.settlement_start_date')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-calendar-alt "></i></span>
                                    <input value="<?= (isset($data_form["settlement_start_date"])) ? $data_form["settlement_start_date"] : ''; ?>" type="date" class="form-control border-start-0 ts_input" id="settlement_start_date" name="settlement_start_date" placeholder="<?=lang('fields.settlement_start_date')?>">
                                </div>
                        </div>
                        <div class="col-md-3">
                                <label for="settlement_end_date" class="form-label"><?=lang('fields.settlement_end_date')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-calendar-alt "></i></span>
                                    <input value="<?= (isset($data_form["settlement_end_date"])) ? $data_form["settlement_end_date"] : ''; ?>" type="date" class="form-control border-start-0 ts_input" id="settlement_end_date" name="settlement_end_date" placeholder="<?=lang('fields.settlement_end_date')?>">
                                </div>
                        </div>
                        
                        <div class="col-md-3">
                                <label for="payment_dates" class="form-label"><?=lang('fields.payment_dates')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-calendar-alt "></i></span>
                                    <input value="<?= (isset($data_form["payment_dates"])) ? $data_form["payment_dates"] : ''; ?>" type="date" class="form-control border-start-0 ts_input" id="payment_dates" name="payment_dates" placeholder="<?=lang('fields.payment_dates')?>">
                                </div>
                        </div>
                        
                        <div class="col-md-6">
                                <label for="description" class="form-label"><?=lang('fields.description')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-comment"></i></span>
                                    <textarea class="form-control border-start-0 ts_input" id="description" name="description" placeholder="<?=lang('fields.description')?>"><?= (isset($data_form["description"])) ? $data_form["description"] : ''; ?></textarea>
                                </div>
                        </div>
                        <div class="col-md-6">
                                <label for="notes" class="form-label"><?=lang('fields.notes')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-comment-alt "></i></span>
                                    <textarea class="form-control border-start-0 ts_input" id="notes" name="notes" placeholder="<?=lang('fields.notes')?>"><?= (isset($data_form["notes"])) ? $data_form["notes"] : ''; ?></textarea>
                                </div>
                        </div>
                    
                    </div>
                    
            </div>
        
    </div>
    
</div>