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
 * formulario para crear un tercero
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-09-21
 * @updated 2021-09-21
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */


?>
<div class="row">
    <div class="col">
        <div class="container">
            <div class="card border-top border-0 border-4 border-primary">
                
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                            <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                            </div>
                            <h5 class="mb-0 text-primary"><?=lang('forms.third_title')?></h5>
                    </div>

                    <hr>
                    <div class="row g-3">
                        <div class="col-6">
                            <label for="type_organization_id" class="form-label"><?=lang('fields.type_organization_id')?></label>
                            <div class="input-group"> 

                                <select id="type_organization_id" name="type_organization_id" class="form-select ts_input">

                                    <option value=""><?=lang('msg.option_select')?></option>

                                    <?php
                                        if(isset($data_form["type_organization_id"])){
                                            print('<option value="'.$data_form["type_organization_id"].'" selected>'.$data_form["type_organization_name"].'</option>');
                                        }
                                    ?>

                                </select>    

                            </div>
                        </div>

                        <div class="col-6">
                            <label for="type_regime_id" class="form-label"><?=lang('fields.type_regime_id')?></label>
                            <div class="input-group"> 

                                <select id="type_regime_id" name="type_regime_id" class="form-select ts_input">

                                    <option value=""><?=lang('msg.option_select')?></option>

                                    <?php
                                        if(isset($data_form["type_regime_id"])){
                                            print('<option value="'.$data_form["type_regime_id"].'" selected>'.$data_form["type_regime_name"].'</option>');
                                        }
                                    ?>

                                </select>    

                            </div>
                        </div>

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

                        <div class="col-md-12">
                                <label for="mail" class="form-label"><?=lang('fields.mail')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-envelope"></i></span>
                                    <input value="<?= (isset($data_form["mail"])) ? $data_form["mail"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="mail" name="mail" placeholder="<?=lang('fields.mail')?>">
                                </div>
                        </div>
                        
                        <div class="col-6">
                            <label for="type_liabilitie_id" class="form-label"><?=lang('fields.type_liabilitie_id')?></label>
                            <div class="input-group"> 

                                <select id="type_liabilitie_id" name="type_liabilitie_id" class="form-select ts_input">

                                    <option value=""><?=lang('msg.option_select')?></option>

                                    <?php
                                        if(isset($data_form["type_liabilitie_id"])){
                                            print('<option value="'.$data_form["type_liabilitie_id"].'" selected>'.$data_form["type_liabilitie_name"].'</option>');
                                        
                                            
                                        }else{
                                            print('<option value="29" selected>No aplica</option>');
                                        
                                        }
                                    ?>

                                </select>    

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
                                <label for="neighborhood" class="form-label"><?=lang('fields.neighborhood')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-address-book "></i></span>
                                    <input value="<?= (isset($data_form["neighborhood"])) ? $data_form["neighborhood"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="neighborhood" name="neighborhood" placeholder="<?=lang('fields.neighborhood')?>">
                                </div>
                        </div>
                        
                    </div>
                </div>
            </div>
         </div>
    </div>
</div>