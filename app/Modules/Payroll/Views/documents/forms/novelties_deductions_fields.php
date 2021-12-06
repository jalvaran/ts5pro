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
 * Este archivo el formulario para dibujar los campos requeridos  para agregar deducciones a una nomina
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-11-30
 * @updated 2021-11-30
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */
?>

<div class="row">
    <div class="col-md-10">
        <div class="row">
<?php

if(isset($fields["percentage"])){
    print('<div class="col-md-3">
                <br>
                <label for="percentage" class="form-label">'.lang('fields.percentage').'</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-percent"></i></span>
                    <input value="" type="text" class="form-control border-start-0 ts_input" id="percentage" name="percentage" placeholder="'.lang('fields.percentage').'">
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
        <label for="btn_add_deduction" class="form-label"> + </label><br>
        <button class="btn btn-warning form-control" id="btn_add_deduction" data-document_id="<?=$document_id?>" ><?=lang('fields.add')?></button>
    </div>
</div>