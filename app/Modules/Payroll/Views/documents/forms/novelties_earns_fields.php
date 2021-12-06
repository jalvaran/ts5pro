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
 * Este archivo el formulario para dibujar los campos requeridos  para agregar devengados a una nomina
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-11-28
 * @updated 2021-11-28
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */
?>

<div class="row">
    <div class="col-md-10">
        <div class="row">
<?php


if(isset($fields["quantity"])){
    
    print('<div class="col-md-3">
            <br>
            <label for="quantity" class="form-label">'.lang('fields.quantity').'</label>
            <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-list-ol"></i></span>
                <input id="quantity" name="quantity" placeholder="'.lang('fields.quantity').'" type="text"  value="" class="form-control border-start-0 ts_input">
            </div>


        </div>');

    
}


if(isset($fields["percentage"])){
    print('<div class="col-md-3">
                <br>
                <label for="percentage" class="form-label">'.lang('fields.percentage').'</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-percent"></i></span>
                    <input value="" type="text" class="form-control border-start-0 ts_input" id="percentage" name="percentage" placeholder="'.lang('fields.percentage').'">
                </div>


            </div>');
}

if(isset($fields["interest_payment"])){
    
    print('<div class="col-md-3">
            <br>
            <label for="interest_payment" class="form-label">'.lang('fields.interest_payment').'</label>
            <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-angle-double-up"></i></span>
                <input id="interest_payment" name="interest_payment" placeholder="'.lang('fields.interest_payment').'" type="text"  value="" class="form-control border-start-0 ts_input">
            </div>


        </div>');

    
}

if(isset($fields["type_incapacity_id"])){
    print('<div class="col-md-3">
                <br>
                <label for="type_incapacity_id" class="form-label">'.lang('fields.type_incapacity_id').'</label>
    
                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-medkit"></i></span>');
                    
    print('<select id="type_incapacity_id" name="type_incapacity_id" class="form-control ts_input">');             
    foreach ($fields["type_incapacity_id"] as $key => $value) {
        
        print('<option value="'.$value["id"].'">'.$value["name"].'</option>');   
    }
    print('</select>');
    print('</div>
            </div>');
}

if(isset($fields["type_time_id"])){
    print('<div class="col-md-6">
                <br>
                <label for="type_time_id" class="form-label">'.lang('fields.type_time_id').'</label>
    
                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-clock"></i></span>');
                    
    print('<select id="type_time_id" name="type_time_id" class="form-control ts_input">');             
    foreach ($fields["type_time_id"] as $key => $value) {
        
        print('<option value="'.$value["id"].'">'.$value["name"].' ('.$value["percentage"].'%)</option>');   
    }
    print('</select>');
    print('</div>
            </div>');
}

if(isset($fields["layoffs_payment"])){
    print('<div class="col-md-3">
                <br>
                <label for="layoffs_payment" class="form-label">'.lang('fields.layoffs_payment').'</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bx-dollar-circle"></i></span>
                    <input value="" type="text" class="form-control border-start-0 ts_input" id="layoffs_payment" name="layoffs_payment" placeholder="'.lang('fields.layoffs_payment').'">
                </div>


            </div>');
}

if(isset($fields["description"])){
    print('<div class="col-md-6">
                <br>
                <label for="description" class="form-label">'.lang('fields.description').'</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-comment"></i></span>
                    <textarea class="form-control ts_input" id="description" name="description" placeholder="'.lang('fields.description').'"></textarea>
                </div>


            </div>');
}

if(isset($fields["payment"])){
    print('<div class="col-md-3">
                <br>
                <label for="payment" class="form-label">'.lang('fields.payment').'</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bx-dollar-circle"></i></span>
                    <input value="" type="text" class="form-control border-start-0 ts_input" id="payment" name="payment" placeholder="'.lang('fields.payment').'">
                </div>


            </div>');
}



?>
      
        </div>
        
    </div>
    
    <div class="col-md-2" style="text-align: right">
        <br>
        <label for="btn_add_earn" class="form-label"> + </label><br>
        <button class="btn btn-success form-control" id="btn_add_earn" data-document_id="<?=$document_id?>" ><?=lang('fields.add')?></button>
    </div>
</div>