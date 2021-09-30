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
 * Este archivo el formulario para crear una hoja de negocio
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-09-29
 * @updated 2021-09-29
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */
?>
<br>
<div class="row">
    <div class="col-md-8">
        
            <div class="card border-top border-0 border-4 border-primary">
                
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                            <div><i class="fa fa-briefcase me-1 font-22 text-primary"></i>
                            </div>
                            <h5 class="mb-0 text-primary"><?=lang('creditmoto.business_sheet_title')?></h5>
                    </div>

                    <hr>
                    <div class="row g-3">
                        <div class="col-6">
                            <label for="app_thirds_id" class="form-label"><?=lang('fields.app_thirds_id')?></label>
                            <div class="input-group"> 

                                <select id="app_thirds_id" name="app_thirds_id" class="form-select ts_input">

                                    <option value=""><?=lang('msg.option_select')?></option>

                                    <?php
                                        if(isset($data_form["app_thirds_id"])){
                                            print('<option value="'.$data_form["app_thirds_id"].'" selected>'.$data_form["third_name"].'</option>');
                                        }
                                    ?>

                                </select>    

                            </div>
                        </div>

                        <div class="col-6">
                            <label for="creditmoto_business_sheet_types_id" class="form-label"><?=lang('fields.creditmoto_business_sheet_types_id')?></label>
                            <div class="input-group"> 

                                <select id="creditmoto_business_sheet_types_id" name="creditmoto_business_sheet_types_id" class="form-select ts_input">

                                    <option value=""><?=lang('msg.option_select')?></option>

                                    <?php
                                        if(isset($data_form["creditmoto_business_sheet_types_id"])){
                                            print('<option value="'.$data_form["creditmoto_business_sheet_types_id"].'" selected>'.$data_form["creditmoto_business_sheet_types_name"].'</option>');
                                        }
                                    ?>

                                </select>    

                            </div>
                        </div>

                        
                        <div class="col-md-6">
                                <label for="motorcycle" class="form-label"><?=lang('fields.motorcycle')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-user "></i></span>
                                    <input value="<?= (isset($data_form["motorcycle"])) ? $data_form["motorcycle"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="motorcycle" name="motorcycle" placeholder="<?=lang('fields.motorcycle')?>">
                                </div>
                        </div>
                        <div class="col-md-6">
                                <label for="color" class="form-label"><?=lang('fields.color')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-id-card "></i></span>
                                    <input value="<?= (isset($data_form["color"])) ? $data_form["color"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="color" name="color" placeholder="<?=lang('fields.color')?>">
                                </div>
                        </div>
                        <div class="col-md-6">
                                <label for="maker" class="form-label"><?=lang('fields.maker')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-id-card "></i></span>
                                    <input value="<?= (isset($data_form["maker"])) ? $data_form["maker"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="maker" name="maker" placeholder="<?=lang('fields.maker')?>">
                                </div>
                        </div>

                        <div class="col-md-6">
                                <label for="motorcycle_value" class="form-label"><?=lang('fields.motorcycle_value')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-id-card "></i></span>
                                    <input value="<?= (isset($data_form["motorcycle_value"])) ? $data_form["motorcycle_value"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="motorcycle_value" name="motorcycle_value" placeholder="<?=lang('fields.motorcycle_value')?>">
                                </div>
                        </div>
                        <div class="col-md-6">
                                <label for="discount" class="form-label"><?=lang('fields.discount')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-id-card "></i></span>
                                    <input value="<?= (isset($data_form["discount"])) ? $data_form["discount"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="discount" name="discount" placeholder="<?=lang('fields.discount')?>">
                                </div>
                        </div>

                        <div class="col-md-6">
                                <label for="initial_fee" class="form-label"><?=lang('fields.initial_fee')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-id-card "></i></span>
                                    <input value="<?= (isset($data_form["initial_fee"])) ? $data_form["initial_fee"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="initial_fee" name="initial_fee" placeholder="<?=lang('fields.initial_fee')?>">
                                </div>
                        </div>

                        <div class="col-md-6">
                                <label for="term" class="form-label"><?=lang('fields.term')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-phone"></i></span>
                                    <input value="<?= (isset($data_form["term"])) ? $data_form["term"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="term" name="term" placeholder="<?=lang('fields.term')?>">
                                </div>
                        </div>
                        
                        <div class="col-6">
                            <label for="financial_id" class="form-label"><?=lang('fields.financial_id')?></label>
                            <div class="input-group"> 

                                <select id="financial_id" name="financial_id" class="form-select ts_input">

                                    <option value=""><?=lang('msg.option_select')?></option>

                                    <?php
                                        if(isset($data_form["financial_id"])){
                                            print('<option value="'.$data_form["financial_id"].'" selected>'.$data_form["financial_id_name"].'</option>');
                                        
                                            
                                        }
                                    ?>

                                </select>    

                            </div>
                        </div>
                        
                        <div class="col-12">
                            <label for="observations" class="form-label"><?=lang('fields.observations')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-id-card "></i></span>
                                    <textarea  class="form-control border-start-0 ts_input" id="observations" name="observations" placeholder="<?=lang('fields.observations')?>"><?= (isset($data_form["observations"])) ? $data_form["observations"] : ''; ?></textarea>
                                </div>
                        </div>
                        
                        
                        
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="float-end text-success"><li id="btn_add_several_all" title="<?=lang('creditmoto.btn_title_add_all') ?>" class=" btn btn-success fa fa-share-square cursor-pointer"></li></div>
                                    <div class="card-title">
                                        <h5><?=lang('creditmoto.several_title') ?></h5>
                                    </div>  
                                </div>  
                                <div class="card-body">
                                    <div class="row">
                                        <div id="div_business_sheet_several" class="col">
                                            
                                        </div>    
                                    </div>     
                                </div> 
                            </div>   
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                   
                                    <div class="card-title">
                                        <h5><?=lang('creditmoto.several_add_title') ?></h5>
                                    </div>  
                                </div>  
                                <div class="card-body">
                                    <div class="row">
                                        <div id="div_business_sheet_several_adds" class="col">
                                            
                                        </div>    
                                    </div>     
                                </div> 
                            </div>   
                        </div>
                        
                    </div>
                </div>
            </div>
        
    </div>
    
    
    <div class="col-md-4 ">
        
        <div class="card border-top border-0 border-4 border-danger position-fixed w-25" >

            <div class="card-body p-5" >
                <div class="card-title d-flex align-items-center">
                        <div><i class="fa fa-dollar-sign me-1 font-22 text-danger"></i>
                        </div>
                        <h5 class="mb-0 text-danger"><?=lang('fields.totals')?></h5>
                </div>
                <hr>
                <div class="row g-3" >
                    <div id="div_business_sheet_totals" class="col">
                        
                    </div>    
                </div>
            </div>   
        </div>   
            
    </div>       
        
    
</div>