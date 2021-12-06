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
 * Este archivo muestra el resumen de novedades de una nomina general
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-11-30
 * @updated 2021-11-30
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */
?>
<br>
 
        <div class="card border-top border-0 border-4 border-danger">
            <div class="card-body p-3">
                <div class="card-title d-flex align-items-center">
                        <div><i class="fa fa-list-alt me-1 font-22 text-danger"></i>
                        </div>
                        <h5 class="mb-0 text-dark"><?=lang('payroll.noventlies_sumary_title')?></h5>
                       
                </div>
                
                 <hr>
                 <div class="row">
                    <div class="col-md-6 ">
                        <div class="card">
                               <div class="card-body">
                                   <table class="table mb-0" style="font-size: 12px;">
                                               <thead>
                                                       <tr>
                                                           <th scope="col" colspan="4" style="text-align: center"><?=lang('payroll.earns')?></th>

                                                       </tr>
                                                       <tr>
                                                               <th scope="col"><?=lang('fields.third')?></th>
                                                               <th scope="col"><?=lang('fields.concept')?></th>
                                                               <th scope="col"><?=lang('fields.quantity')?></th>
                                                               <th scope="col"><?=lang('fields.value')?></th>
                                                       </tr>
                                               </thead>
                                               <tbody>
                                                       <?php
                                                       if(isset($data_earns)){
                                                           $total_earns=0;
                                                           foreach ($data_earns as $key => $data_earn) {
                                                               $quantity=1;
                                                               $total_earns=$total_earns+$data_earn["payment"];
                                                               if($data_earn["quantity"]<>0){
                                                                   $quantity=$data_earn["quantity"];
                                                               }
                                                               print('<tr>');
                                                                   print('<th><li data-earn_deduction="1" data-document_id="'.$document_id.'" data-id="'.$data_earn["id"].'" class="fa fa-times text-danger ts_btn_delete_earn_deduction" style="cursor:pointer"></li> '.$data_earn["third_identification"].'</th>');
                                                                   print('<td>'.$data_earn["earn_description"].' '.$data_earn["time_name"].'</td>');
                                                                   print('<td style="text-align:right">'.number_format($quantity,2).'</td>');
                                                                   print('<td style="text-align:right">'.number_format($data_earn["payment"],2).'</td>');

                                                               print('</tr>');
                                                           }
                                                           print('<tr>');
                                                               print('<th colspan="3" style="text-align:right">TOTAL</th>');
                                                               print('<th style="text-align:right">'.number_format($total_earns,2).'</th>');
                                                           print('</tr>');

                                                       }
                                                       ?>
                                               </tbody>
                                       </table>
                               </div>
                       </div>
                    </div>


                    <div class="col-md-6 ">
                        <div class="card">
                               <div class="card-body">
                                   <table class="table mb-0" style="font-size: 12px;">
                                               <thead>
                                                       <tr>
                                                           <th scope="col" colspan="4" style="text-align: center"><?=lang('payroll.deductions')?></th>

                                                       </tr>
                                                       <tr>
                                                               <th scope="col"><?=lang('fields.third')?></th>
                                                               <th scope="col"><?=lang('fields.concept')?></th>
                                                               <th scope="col"><?=lang('fields.quantity')?></th>
                                                               <th scope="col"><?=lang('fields.value')?></th>
                                                       </tr>
                                               </thead>
                                               <tbody>
                                                       <?php
                                                       if(isset($data_deductions)){
                                                           $total_deductions=0;
                                                           foreach ($data_deductions as $key => $data_deduction) {
                                                               $quantity=1;
                                                               $total_deductions=$total_deductions+$data_deduction["payment"];
                                                               if($data_deduction["quantity"]<>0){
                                                                   $quantity=$data_deduction["quantity"];
                                                               }
                                                               print('<tr>');
                                                                   print('<th><li data-earn_deduction="2" data-document_id="'.$document_id.'" data-id="'.$data_deduction["id"].'" class="fa fa-times text-danger ts_btn_delete_earn_deduction" style="cursor:pointer"></li> '.$data_deduction["third_identification"].'</th>');
                                                                   print('<td>'.$data_deduction["deduction_description"].'</td>');
                                                                   print('<td style="text-align:right">'.number_format($quantity,2).'</td>');
                                                                   print('<td style="text-align:right">'.number_format($data_deduction["payment"],2).'</td>');

                                                               print('</tr>');
                                                           }
                                                           print('<tr>');
                                                               print('<th colspan="3" style="text-align:right">TOTAL</th>');
                                                               print('<th style="text-align:right">'.number_format($total_deductions,2).'</th>');
                                                           print('</tr>');

                                                       }
                                                       ?>
                                               </tbody>
                                       </table>
                               </div>
                       </div>
                    </div>
                     
                     
                         <div class="col-md-6"></div>
                         <div class="col-md-6">
                                <div class="card radius-10">
                                        <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                        <div>
                                                                <p class="mb-0 text-secondary"><?=lang('payroll.payroll_total')?></p>
                                                                <h4 class="my-1">$<?=number_format($total_earns-$total_deductions)?></h4>
                                                        </div>
                                                        <div class="text-success ms-auto font-35"><i class="bx bxl-shopify"></i>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                     
                </div> 
            </div>
    </div>
    