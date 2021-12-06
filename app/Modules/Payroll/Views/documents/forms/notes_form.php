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
 * Este archivo el formulario para crear las notas de una nomina electronica
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-12-05
 * @updated 2021-12-05
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
                            <h5 class="mb-0 text-danger"><?=lang('payroll.notes_form_title')." ".$data_form["consecutive"]?></h5>
                            
                    </div>
                    
                    <div class="row g-3">
                          
                        
                        
                        <div class="col-md-6">
                                <label for="description" class="form-label"><?=lang('fields.description')?></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-comment"></i></span>
                                    <textarea class="form-control border-start-0 ts_input" id="description" name="description" placeholder="<?=lang('fields.description')?>"></textarea>
                                </div>
                        </div>
                        
                    
                    </div>
                    
            </div>
        
    </div>
    
</div>