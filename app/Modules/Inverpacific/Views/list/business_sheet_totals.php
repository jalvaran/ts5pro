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
 * Este archivo contiene la vista de los totales de una hoja de negocio 
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvarán Valencia <jalvaran@gmail.com>
 * @created 2021-10-01
 * @updated 2021-10-01
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

?>
<div class="row">    
    <div class="col-md-6">
        <div class="card radius-10">
                <div class="card-body">
                        <div class="d-flex align-items-center">
                                <h6 class="mb-0 font-weight-bold"><?=lang('fields.subtotal_general')?></h6>
                                <p class="mb-0 ms-auto"><i class="bx bx-dots-horizontal-rounded float-end font-24"></i>
                                </p>
                        </div>
                    <div class="d-flex my-4" style="text-align: right">
                                <h1 class="mb-0 font-weight-bold">$ <?= (isset($data["subtotal_general"])) ? number_format($data["subtotal_general"]) : '0'; ?></h1>
                                
                        </div>
                        <div class="progress radius-10" style="height: 10px">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 45%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 10%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-success" role="progressbar" style="width: 15%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="table-responsive mt-4">
                                <table class="table mb-0">
                                        <tbody>
                                                <tr>
                                                    <td class="px-0">
                                                            <div class="d-flex align-items-center">
                                                                    <div><i class="bx bxs-checkbox me-2 font-24 text-primary"></i>
                                                                    </div>
                                                                    <div><?=lang('fields.motorcycle_value') ?></div>
                                                            </div>
                                                    </td>
                                                    <td style="text-align: right">$ <?= (isset($data["motorcycle_value"])) ? number_format($data["motorcycle_value"]) : '0'; ?></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td class="px-0">
                                                            <div class="d-flex align-items-center">
                                                                    <div><i class="bx bxs-checkbox me-2 font-24 text-danger"></i>
                                                                    </div>
                                                                    <div><?=lang('fields.motorcycle_value_before_taxes') ?></div>
                                                            </div>
                                                    </td>
                                                    <td style="text-align: right">$ <?= (isset($data["motorcycle_value_before_taxes"])) ? number_format($data["motorcycle_value_before_taxes"]) : '0'; ?></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td class="px-0">
                                                            <div class="d-flex align-items-center">
                                                                    <div><i class="bx bxs-checkbox me-2 font-24 text-success"></i>
                                                                    </div>
                                                                    <div><?=lang('fields.discount') ?></div>
                                                            </div>
                                                    </td>
                                                        <td style="text-align: right">$ <?= (isset($data["discount"])) ? number_format($data["discount"]) : '0'; ?></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td class="px-0">
                                                        <div class="d-flex align-items-center">
                                                                <div><i class="bx bxs-checkbox me-2 font-24 text-warning"></i>
                                                                </div>
                                                                <div><?=lang('fields.subtotal') ?></div>
                                                        </div>
                                                    </td>
                                                        <td style="text-align: right">$ <?= (isset($data["subtotal"])) ? number_format($data["subtotal"]) : '0'; ?></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td class="px-0">
                                                        <div class="d-flex align-items-center">
                                                                <div><i class="bx bxs-checkbox me-2 font-24 text-info"></i>
                                                                </div>
                                                                <div><?=lang('fields.iva_value') ?></div>
                                                        </div>
                                                    </td>
                                                        <td style="text-align: right">$ <?= (isset($data["iva_value"])) ? number_format($data["iva_value"]) : '0'; ?></td>
                                                        
                                                </tr>
                                                
                                                
                                                
                                                <tr>
                                                    <td class="px-0">
                                                            <div class="d-flex align-items-center">
                                                                    <div><i class="bx bxs-checkbox me-2 font-24 text-primary"></i>
                                                                    </div>
                                                                    <div><?=lang('fields.total_motorcycle') ?></div>
                                                            </div>
                                                    </td>
                                                    <td style="text-align: right"><strong>$ <?= (isset($data["total_motorcycle"])) ? number_format($data["total_motorcycle"]) : '0'; ?></strong></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td class="px-0">
                                                            <div class="d-flex align-items-center">
                                                                    <div><i class="bx bxs-checkbox me-2 font-24 text-danger"></i>
                                                                    </div>
                                                                    <div><?=lang('fields.several_value') ?></div>
                                                            </div>
                                                    </td>
                                                    <td style="text-align: right">$ <?= (isset($data["several_value"])) ? number_format($data["several_value"]) : '0'; ?></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td class="px-0">
                                                            <div class="d-flex align-items-center">
                                                                    <div><i class="bx bxs-checkbox me-2 font-24 text-success"></i>
                                                                    </div>
                                                                    <div><?=lang('fields.total_more_several') ?></div>
                                                            </div>
                                                    </td>
                                                        <td style="text-align: right">$ <?= (isset($data["total_more_several"])) ? number_format($data["total_more_several"]) : '0'; ?></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td class="px-0">
                                                        <div class="d-flex align-items-center">
                                                                <div><i class="bx bxs-checkbox me-2 font-24 text-warning"></i>
                                                                </div>
                                                                <div><?=lang('fields.initial_fee') ?></div>
                                                        </div>
                                                    </td>
                                                        <td style="text-align: right">$ <?= (isset($data["initial_fee"])) ? number_format($data["initial_fee"]) : '0'; ?></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td class="px-0">
                                                        <div class="d-flex align-items-center">
                                                                <div><i class="bx bxs-checkbox me-2 font-24 text-info"></i>
                                                                </div>
                                                                <div><?=lang('fields.retake') ?></div>
                                                        </div>
                                                    </td>
                                                        <td style="text-align: right">$ <?= (isset($data["retake"])) ? number_format($data["retake"]) : '0'; ?></td>
                                                        
                                                </tr>
                                                
                                                
                                        </tbody>
                                </table>
                        </div>
                </div>
        </div>
    </div>




    <div class="col-md-6">
        <div class="card radius-10">
                <div class="card-body">
                        <div class="d-flex align-items-center">
                                <h6 class="mb-0 font-weight-bold"><?=lang('fields.total_to_pay')?></h6>
                                <p class="mb-0 ms-auto"><i class="bx bx-dots-horizontal-rounded float-end font-24"></i>
                                </p>
                        </div>
                    <div class="d-flex my-4" style="text-align: right">
                                <h1 class="mb-0 font-weight-bold">$ <?= (isset($data["total_to_pay"])) ? number_format($data["total_to_pay"]) : '0'; ?></h1>
                                
                        </div>
                        <div class="progress radius-10" style="height: 10px">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 45%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 10%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-success" role="progressbar" style="width: 15%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="table-responsive mt-4">
                                <table class="table mb-0">
                                        <tbody>
                                                <tr>
                                                    <td class="px-0">
                                                            <div class="d-flex align-items-center">
                                                                    <div><i class="bx bxs-checkbox me-2 font-24 text-primary"></i>
                                                                    </div>
                                                                    <div><?=lang('fields.guarantee_fund_value') ?></div>
                                                            </div>
                                                    </td>
                                                    <td style="text-align: right">$ <?= (isset($data["guarantee_fund_value"])) ? number_format($data["guarantee_fund_value"]) : '0'; ?></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td class="px-0">
                                                            <div class="d-flex align-items-center">
                                                                    <div><i class="bx bxs-checkbox me-2 font-24 text-danger"></i>
                                                                    </div>
                                                                    <div><?=lang('fields.guarantee_fund_iva_value') ?></div>
                                                            </div>
                                                    </td>
                                                    <td style="text-align: right">$ <?= (isset($data["guarantee_fund_iva_value"])) ? number_format($data["guarantee_fund_iva_value"]) : '0'; ?></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td class="px-0">
                                                            <div class="d-flex align-items-center">
                                                                    <div><i class="bx bxs-checkbox me-2 font-24 text-success"></i>
                                                                    </div>
                                                                    <div><?=lang('fields.total_administration_expenses') ?></div>
                                                            </div>
                                                    </td>
                                                        <td style="text-align: right">$ <?= (isset($data["total_administration_expenses"])) ? number_format($data["total_administration_expenses"]) : '0'; ?></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td class="px-0">
                                                        <div class="d-flex align-items-center">
                                                                <div><i class="bx bxs-checkbox me-2 font-24 text-warning"></i>
                                                                </div>
                                                                <div><?=lang('fields.total_general') ?></div>
                                                        </div>
                                                    </td>
                                                        <td style="text-align: right"><strong>$ <?= (isset($data["total_general"])) ? number_format($data["total_general"]) : '0'; ?></strong></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td class="px-0">
                                                        <div class="d-flex align-items-center">
                                                                <div><i class="bx bxs-checkbox me-2 font-24 text-info"></i>
                                                                </div>
                                                                <div><?=lang('fields.financing_balance') ?></div>
                                                        </div>
                                                    </td>
                                                        <td style="text-align: right">$ <?= (isset($data["financing_balance"])) ? number_format($data["financing_balance"]) : '0'; ?></td>
                                                        
                                                </tr>
                                                
                                                
                                                
                                                <tr>
                                                    <td class="px-0">
                                                            <div class="d-flex align-items-center">
                                                                    <div><i class="bx bxs-checkbox me-2 font-24 text-primary"></i>
                                                                    </div>
                                                                    <div><?=lang('fields.financing_value') ?></div>
                                                            </div>
                                                    </td>
                                                    <td style="text-align: right"><strong>$ <?= (isset($data["financing_value"])) ? number_format($data["financing_value"]) : '0'; ?></strong></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td class="px-0">
                                                            <div class="d-flex align-items-center">
                                                                    <div><i class="bx bxs-checkbox me-2 font-24 text-danger"></i>
                                                                    </div>
                                                                    <div><?=lang('fields.financing_value_adjustment') ?></div>
                                                            </div>
                                                    </td>
                                                    <td style="text-align: right">$ <?= (isset($data["financing_value_adjustment"])) ? number_format($data["financing_value_adjustment"]) : '0'; ?></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td class="px-0">
                                                            <div class="d-flex align-items-center">
                                                                    <div><i class="bx bxs-checkbox me-2 font-24 text-success"></i>
                                                                    </div>
                                                                    <div><?=lang('fields.life_insurance_value') ?></div>
                                                            </div>
                                                    </td>
                                                        <td style="text-align: right">$ <?= (isset($data["life_insurance_value"])) ? number_format($data["life_insurance_value"]) : '0'; ?></td>
                                                        
                                                </tr>
                                                                                                
                                                
                                                <tr>
                                                    <td class="px-0">
                                                            <div class="d-flex align-items-center">
                                                                    <div><i class="bx bxs-checkbox me-2 font-24 text-primary"></i>
                                                                    </div>
                                                                    <div><?=lang('fields.fee_value') ?></div>
                                                            </div>
                                                    </td>
                                                    <td style="text-align: right">$ <?= (isset($data["fee_value"])) ? number_format($data["fee_value"]) : '0'; ?></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td class="px-0">
                                                            <div class="d-flex align-items-center">
                                                                    <div><i class="bx bxs-checkbox me-2 font-24 text-danger"></i>
                                                                    </div>
                                                                    <div><?=lang('fields.fee_value_life_insurance') ?></div>
                                                            </div>
                                                    </td>
                                                    <td style="text-align: right">$ <?= (isset($data["fee_value_life_insurance"])) ? number_format($data["fee_value_life_insurance"]) : '0'; ?></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td class="px-0">
                                                            <div class="d-flex align-items-center">
                                                                    <div><i class="bx bxs-checkbox me-2 font-24 text-success"></i>
                                                                    </div>
                                                                    <div><?=lang('fields.fee_value_monthly') ?></div>
                                                            </div>
                                                    </td>
                                                        <td style="text-align: right"><strong>$ <?= (isset($data["fee_value_monthly"])) ? number_format($data["fee_value_monthly"]) : '0'; ?></strong></td>
                                                        
                                                </tr>
                                                
                                        </tbody>
                                </table>
                        </div>
                </div>
        </div>
    </div>
</div>    
