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
 * Este archivo el formulario para crear o editar un empleado
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
                            <h5 class="mb-0 text-danger"><?=lang('payroll.employee_form_title')?></h5>
                            
                    </div>
                    <h4><?=lang('payroll.personal_data')?></h4>
                    <hr>
                    <div class="row g-3">
                          
                        
                        <div class="col-6">
                            <label for="type_document_identification_id" class="form-label"><?=lang('fields.type_document_identification_id')?></label>
                            <div class="input-group"> 

                                <select id="type_document_identification_id" name="type_document_identification_id" class="form-select ts_input">

                                    <option value=""><?=lang('msg.option_select')?></option>

                                    <?php
                                        if(isset($data_form["type_document_identification_id"])){
                                            print('<option value="'.$data_form["type_document_identification_id"].'" selected>'.$data_form["type_document_identification_name"].'</option>');
                                        }
                                    ?>

                                </select>    

                            </div>
                        </div>
                        <div class="col-md-6">
                                <label for="identification" class="form-label"><?=lang('fields.identification')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-user "></i></span>
                                    <input value="<?= (isset($data_form["identification"])) ? $data_form["identification"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="identification" name="identification" placeholder="<?=lang('fields.identification')?>">
                                </div>
                        </div>
                        <div class="col-md-6">
                                <label for="firts_name" class="form-label"><?=lang('fields.firts_name')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-id-card "></i></span>
                                    <input value="<?= (isset($data_form["firts_name"])) ? $data_form["firts_name"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="firts_name" name="firts_name" placeholder="<?=lang('fields.firts_name')?>">
                                </div>
                        </div>
                        <div class="col-md-6">
                                <label for="second_name" class="form-label"><?=lang('fields.second_name')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-id-card "></i></span>
                                    <input value="<?= (isset($data_form["second_name"])) ? $data_form["second_name"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="second_name" name="second_name" placeholder="<?=lang('fields.second_name')?>">
                                </div>
                        </div>

                        <div class="col-md-6">
                                <label for="surname" class="form-label"><?=lang('fields.surname')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-id-card "></i></span>
                                    <input value="<?= (isset($data_form["surname"])) ? $data_form["surname"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="surname" name="surname" placeholder="<?=lang('fields.surname')?>">
                                </div>
                        </div>
                        <div class="col-md-6">
                                <label for="second_surname" class="form-label"><?=lang('fields.second_surname')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-id-card "></i></span>
                                    <input value="<?= (isset($data_form["second_surname"])) ? $data_form["second_surname"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="second_surname" name="second_surname" placeholder="<?=lang('fields.second_surname')?>">
                                </div>
                        </div>

                        <div class="col-12">
                                <label for="name" class="form-label"><?=lang('fields.name')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-id-card "></i></span>
                                    <input value="<?= (isset($data_form["name"])) ? $data_form["name"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="name" name="name" placeholder="<?=lang('fields.name')?>">
                                </div>
                        </div>

                        <div class="col-md-6">
                                <label for="telephone1" class="form-label"><?=lang('fields.telephone1')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-phone"></i></span>
                                    <input value="<?= (isset($data_form["telephone1"])) ? $data_form["telephone1"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="telephone1" name="telephone1" placeholder="<?=lang('fields.telephone1')?>">
                                </div>
                        </div>
                        <div class="col-md-6">
                                <label for="telephone2" class="form-label"><?=lang('fields.telephone2')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-phone"></i></span>
                                    <input value="<?= (isset($data_form["telephone2"])) ? $data_form["telephone2"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="telephone2" name="telephone2" placeholder="<?=lang('fields.telephone2')?>">
                                </div>
                        </div>
                        
                        <div class="col-6">
                            <label for="municipalities_id" class="form-label"><?=lang('fields.municipalities_id')?></label>
                            <div class="input-group"> 

                                <select id="municipalities_id" name="municipalities_id" class="form-select ts_input">

                                    <option value=""><?=lang('msg.option_select')?></option>

                                    <?php
                                        if(isset($data_form["municipalities_id"])){
                                            print('<option value="'.$data_form["municipalities_id"].'" selected>'.$data_form["municipalities_name"].'</option>');
                                        }
                                    ?>

                                </select>    

                            </div>
                        </div>
                        
                        <div class="col-md-6">
                                <label for="address" class="form-label"><?=lang('fields.address')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-address-book "></i></span>
                                    <input value="<?= (isset($data_form["address"])) ? $data_form["address"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="address" name="address" placeholder="<?=lang('fields.address')?>">
                                </div>
                        </div>
                        
                        <div class="col-md-6">
                                <label for="mail" class="form-label"><?=lang('fields.mail')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-envelope"></i></span>
                                    <input value="<?= (isset($data_form["mail"])) ? $data_form["mail"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="mail" name="mail" placeholder="<?=lang('fields.mail')?>">
                                </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="active" class="form-label"><?=lang('fields.active')?></label>
                            <div class="input-group"> 

                                <select id="active" name="active" class="form-select ts_input">
                                    <?php 
                                        $selected="";
                                        if(isset($data_form["active"])){ 
                                            if($data_form["active"]==1){
                                                $selected='selected';
                                            }
                                        }
                                            
                                     ?>    
                                    <option value="1" <?=$selected?> ><?=lang('fields.yes')?></option>
                                    
                                    <?php 
                                        $selected="";
                                        if(isset($data_form["active"])){ 
                                            if($data_form["active"]==0){
                                                $selected='selected';
                                            }
                                        }
                                            
                                     ?>    
                                    <option value="0" <?=$selected?> ><?=lang('fields.no')?></option>
                                    
                                    
                                    

                                </select>    

                            </div>
                        </div>
                        
                        <h4><?=lang('payroll.contratual_data')?></h4>
                        <hr>
                        
                        <div class="col-md-6">
                            <label for="type_worker_id" class="form-label"><?=lang('fields.type_worker_id')?></label>
                            <div class="input-group"> 

                                <select id="type_worker_id" name="type_worker_id" class="form-select ts_input">

                                    <option value=""><?=lang('msg.option_select')?></option>

                                    <?php
                                        if(isset($data_form["type_worker_id"])){
                                            print('<option value="'.$data_form["type_worker_id"].'" selected>'.$data_form["type_worker_name"].'</option>');
                                        }
                                    ?>

                                </select>    

                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="subtype_worker_id" class="form-label"><?=lang('fields.subtype_worker_id')?></label>
                            <div class="input-group"> 

                                <select id="subtype_worker_id" name="subtype_worker_id" class="form-select ts_input">

                                    <option value=""><?=lang('msg.option_select')?></option>

                                    <?php
                                        if(isset($data_form["subtype_worker_id"])){
                                            print('<option value="'.$data_form["subtype_worker_id"].'" selected>'.$data_form["subtype_worker_name"].'</option>');
                                        }
                                    ?>

                                </select>    

                            </div>
                        </div>
                        
                        
                        <div class="col-md-6">
                            <label for="company_group_id" class="form-label"><?=lang('fields.company_group_id')?></label>
                            <div class="input-group"> 

                                <select id="company_group_id" name="company_group_id" class="form-select ts_input">

                                    <option value=""><?=lang('msg.option_select')?></option>

                                    <?php
                                        if(isset($data_form["company_group_id"])){
                                            print('<option value="'.$data_form["company_group_id"].'" selected>'.$data_form["company_group_name"].'</option>');
                                        }
                                    ?>

                                </select>    

                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="employees_position_id" class="form-label"><?=lang('fields.employees_position_id')?></label>
                            <div class="input-group"> 

                                <select id="employees_position_id" name="employees_position_id" class="form-select ts_input">

                                    <option value=""><?=lang('msg.option_select')?></option>

                                    <?php
                                        if(isset($data_form["employees_position_id"])){
                                            print('<option value="'.$data_form["employees_position_id"].'" selected>'.$data_form["employees_position_name"].'</option>');
                                        }
                                    ?>

                                </select>    

                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="type_contract_id" class="form-label"><?=lang('fields.type_contract_id')?></label>
                            <div class="input-group"> 

                                <select id="type_contract_id" name="type_contract_id" class="form-select ts_input">

                                    <option value=""><?=lang('msg.option_select')?></option>

                                    <?php
                                        if(isset($data_form["type_contract_id"])){
                                            print('<option value="'.$data_form["type_contract_id"].'" selected>'.$data_form["type_contract_name"].'</option>');
                                        }
                                    ?>

                                </select>    

                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="period_id" class="form-label"><?=lang('fields.period_id')?></label>
                            <div class="input-group"> 

                                <select id="period_id" name="period_id" class="form-select ts_input">

                                    <option value=""><?=lang('msg.option_select')?></option>

                                    <?php
                                        if(isset($data_form["period_id"])){
                                            print('<option value="'.$data_form["period_id"].'" selected>'.$data_form["period_name"].'</option>');
                                        }
                                    ?>

                                </select>    

                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="high_risk_pension" class="form-label"><?=lang('fields.high_risk_pension')?></label>
                            <div class="input-group"> 

                                <select id="high_risk_pension" name="high_risk_pension" class="form-select ts_input">
                                    <?php 
                                        $selected="";
                                        if(isset($data_form["high_risk_pension"])){ 
                                            if($data_form["high_risk_pension"]==0){
                                                $selected='selected';
                                            }
                                        }
                                            
                                     ?>    
                                    <option value="0" <?=$selected?> ><?=lang('fields.no')?></option>
                                    
                                    <?php 
                                        $selected="";
                                        if(isset($data_form["high_risk_pension"])){ 
                                            if($data_form["high_risk_pension"]==1){
                                                $selected='selected';
                                            }
                                        }
                                            
                                     ?>    
                                    <option value="1" <?=$selected?> ><?=lang('fields.yes')?></option>
                                    

                                </select>    

                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="integral_salary" class="form-label"><?=lang('fields.integral_salary')?></label>
                            <div class="input-group"> 

                                <select id="integral_salary" name="integral_salary" class="form-select ts_input">
                                    <?php 
                                        $selected="";
                                        if(isset($data_form["integral_salary"])){ 
                                            if($data_form["integral_salary"]==0){
                                                $selected='selected';
                                            }
                                        }
                                            
                                     ?>    
                                    <option value="0" <?=$selected?> ><?=lang('fields.no')?></option>
                                    
                                    <?php 
                                        $selected="";
                                        if(isset($data_form["integral_salary"])){ 
                                            if($data_form["integral_salary"]==1){
                                                $selected='selected';
                                            }
                                        }
                                            
                                     ?>    
                                    <option value="1" <?=$selected?> ><?=lang('fields.yes')?></option>
                                    

                                </select>    

                            </div>
                        </div>
                        
                        <div class="col-md-3">
                                <label for="salary" class="form-label"><?=lang('fields.salary')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-dollar-sign"></i></span>
                                    <input value="<?= (isset($data_form["salary"])) ? $data_form["salary"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="salary" name="salary" placeholder="<?=lang('fields.salary')?>">
                                </div>
                        </div>
                        
                        <div class="col-md-3">
                                <label for="transportation_assistance" class="form-label"><?=lang('fields.transportation_assistance')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-bus"></i></span>
                                    <input value="<?= (isset($data_form["transportation_assistance"])) ? $data_form["transportation_assistance"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="transportation_assistance" name="transportation_assistance" placeholder="<?=lang('fields.transportation_assistance')?>">
                                </div>
                        </div>
                        
                        <div class="col-md-3">
                                <label for="start_date" class="form-label"><?=lang('fields.start_date')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-calendar "></i></span>
                                    <input value="<?= (isset($data_form["start_date"])) ? $data_form["start_date"] : ''; ?>" type="date" class="form-control border-start-0 ts_input" id="start_date" name="start_date" placeholder="<?=lang('fields.start_date')?>">
                                </div>
                        </div>
                        
                        <div class="col-md-3">
                                <label for="finish_date" class="form-label"><?=lang('fields.finish_date')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-calendar "></i></span>
                                    <input value="<?= (isset($data_form["finish_date"])) ? $data_form["finish_date"] : ''; ?>" type="date" class="form-control border-start-0 ts_input" id="finish_date" name="finish_date" placeholder="<?=lang('fields.finish_date')?>">
                                </div>
                        </div>
                        <div class="col-md-3">
                            <label for="reasons_withdrawal_id" class="form-label"><?=lang('fields.reasons_withdrawal_id')?></label>
                            <div class="input-group"> 

                                <select id="reasons_withdrawal_id" name="reasons_withdrawal_id" class="form-select ts_input">

                                    <option value=""><?=lang('msg.option_select')?></option>
                                    
                                    <?php
                                        if(isset($data_form["reasons_withdrawal_id"])){
                                            
                                            print('<option value="'.$data_form["reasons_withdrawal_id"].'" selected>'.$data_form["reasons_withdrawal_name"].'</option>');
                                        }
                                    ?>

                                </select>    

                            </div>
                        </div>
                        
                        <h4><?=lang('fields.affiliations')?></h4>
                        <hr>
                        
                        <div class="col-md-6">
                            <label for="eps_code" class="form-label"><?=lang('fields.eps_code')?></label>
                            <div class="input-group"> 

                                <select id="eps_code" name="eps_code" class="form-select ts_input">

                                    <option value=""><?=lang('msg.option_select')?></option>

                                    <?php
                                        if(isset($data_form["eps_code"])){
                                            print('<option value="'.$data_form["eps_code"].'" selected>'.$data_form["eps_name"].'</option>');
                                        }
                                    ?>

                                </select>    

                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="afp_code" class="form-label"><?=lang('fields.afp_code')?></label>
                            <div class="input-group"> 

                                <select id="afp_code" name="afp_code" class="form-select ts_input">

                                    <option value=""><?=lang('msg.option_select')?></option>

                                    <?php
                                        if(isset($data_form["afp_code"])){
                                            print('<option value="'.$data_form["afp_code"].'" selected>'.$data_form["afp_name"].'</option>');
                                        }
                                    ?>

                                </select>    

                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="arl_code" class="form-label"><?=lang('fields.arl_code')?></label>
                            <div class="input-group"> 

                                <select id="arl_code" name="arl_code" class="form-select ts_input">

                                    <option value=""><?=lang('msg.option_select')?></option>

                                    <?php
                                        if(isset($data_form["arl_code"])){
                                            print('<option value="'.$data_form["arl_code"].'" selected>'.$data_form["arl_name"].'</option>');
                                        }
                                    ?>

                                </select>    

                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="arl_level_id" class="form-label"><?=lang('fields.arl_level_id')?></label>
                            <div class="input-group"> 

                                <select id="arl_level_id" name="arl_level_id" class="form-select ts_input">

                                    <option value=""><?=lang('msg.option_select')?></option>

                                    <?php
                                        if(isset($data_form["arl_level_id"])){
                                            print('<option value="'.$data_form["arl_level_id"].'" selected>'.$data_form["arl_level_name"].'</option>');
                                        }
                                    ?>

                                </select>    

                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="ccf_code" class="form-label"><?=lang('fields.ccf_code')?></label>
                            <div class="input-group"> 

                                <select id="ccf_code" name="ccf_code" class="form-select ts_input">

                                    <option value=""><?=lang('msg.option_select')?></option>

                                    <?php
                                        if(isset($data_form["ccf_code"])){
                                            print('<option value="'.$data_form["ccf_code"].'" selected>'.$data_form["ccf_name"].'</option>');
                                        }
                                    ?>

                                </select>    

                            </div>
                        </div>
                        
                        
                        
                        
                        
                        
                    <h4><?=lang('fields.bank_info')?></h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="bank" class="form-label"><?=lang('fields.bank')?></label>
                            <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-university"></i></span>
                                <input value="<?= (isset($data_form["bank"])) ? $data_form["bank"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="bank" name="bank" placeholder="<?=lang('fields.bank')?>">
                            </div>
                                
                        </div>
                        <div class="col-md-4">
                            <label for="account_type" class="form-label"><?=lang('fields.account_type')?></label>
                            <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-university"></i></span>
                                <input value="<?= (isset($data_form["account_type"])) ? $data_form["account_type"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="account_type" name="account_type" placeholder="<?=lang('fields.account_type')?>">
                            </div>
                                
                        </div>
                        <div class="col-md-4">
                            <label for="account_number" class="form-label"><?=lang('fields.account_number')?></label>
                            <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-university"></i></span>
                                <input value="<?= (isset($data_form["account_number"])) ? $data_form["account_number"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="account_number" name="account_number" placeholder="<?=lang('fields.account_number')?>">
                            </div>
                                
                        </div>
                       
                        
                    </div>    
                    <hr>
                    <div class="row">    
                        <div class="col-md-9">
                            
                        </div>
                        
                        
                        <div class="col-md-3 text-lg-end" >
                            <button data-form_id="1" type="button" class="btn btn-primary form-control ts_btn_save_modals " data-id="<?= (isset($data_form["id"])) ? $data_form["id"] : ''; ?>"><?=lang('fields.save')?></button>
                        </div>
                    </div>
                    </div>
                    
                    
                </div>
            </div>
        
    </div>
    
</div>