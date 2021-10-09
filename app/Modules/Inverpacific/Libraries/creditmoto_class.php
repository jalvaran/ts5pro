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
 * @Author Julian Andres Alvaran Valencia <jalvaran@gmail.com>
 * @created 2021-08-13
 * @updated 2021-08-14
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

namespace App\Modules\Inverpacific\Libraries;

use App\Modules\TS5\Libraries\Session;
use App\Modules\TS5\Libraries\ExcelFunctions;

class Creditmoto_class{

    private $session;
    private $user_id;

    public function __construct(){
        $this->session = new Session();
        $this->user_id=$this->session->get('user');

    }
    /**
     * Calcula los totales de una hoja de negocio
     * @param type $business_sheet_id
     * @return type
     */
    function totals_calculate($business_sheet_id){
        
        $fExcel=new ExcelFunctions();
        $mSheet=model('App\Modules\Inverpacific\Models\BusinessSheets');
        $mMotorcycle=model('App\Modules\Inverpacific\Models\Motorcycles');
        $mSeverals=model('App\Modules\Inverpacific\Models\BusinessSheetSeveralsAdds');
        $mParameters=model('App\Modules\Inverpacific\Models\Parameters');
        $mFinalcials=model('App\Modules\Inverpacific\Models\BusinessSheetFinancials');
        $data_sheet=$mSheet->where('id',$business_sheet_id)->first();
        if(is_array($data_sheet)){
            if($data_sheet["motorcycle_id"]<>''){
                $data_motorcycle=$mMotorcycle->where('id',$data_sheet["motorcycle_id"])->first();
                $data["tax_percent_value"]=$data_motorcycle["tax_percent"];                
                $data["motorcycle_value_before_taxes"]=round($data_sheet["motorcycle_value"]/($data_motorcycle["tax_percent"]+1));
                $data["subtotal"]=$data["motorcycle_value_before_taxes"]-$data_sheet["discount"];
                
                $data["iva_value"]=round($data_sheet["subtotal"]*((($data_motorcycle["tax_percent"]+1)*100-100)/100));
                $data["total_motorcycle"]=$data["subtotal"]+$data["iva_value"];
                $data["total_more_several"]=$data["total_motorcycle"];
                $several_totals=$mSeverals->selectSum('value')->where('business_sheet_id',$business_sheet_id)->first();
                if(is_array($several_totals)){
                    $data["several_value"]=$several_totals["value"];                    
                    $data["total_more_several"]=$data["total_more_several"]+$data["several_value"];
                }
                $data["subtotal_general"]=$data["total_more_several"]-$data_sheet["initial_fee"]-$data_sheet["retake"];
                $data["guarantee_fund_percent"]=$mParameters->get_guarantee_fund_percent();
                $data["guarantee_fund_percent_iva"]=$mParameters->guarantee_fund_percent_iva();
                $data["guarantee_fund_value"]=round($data["subtotal_general"]*$data["guarantee_fund_percent"]);
                $data["guarantee_fund_iva_value"]=round($data["guarantee_fund_value"]*$data["guarantee_fund_percent_iva"]);
                $data["total_administration_expenses"]=$data["guarantee_fund_value"]+$data["guarantee_fund_iva_value"];
                $data["total_general"]=round($data["subtotal_general"]+$data["total_administration_expenses"]);
                $data["financing_balance"]=$data["total_general"]; //Total de la financiacion
                $data["financing_rate"]=$mFinalcials->get_rate($data_sheet["financial_id"]);  //obtiene el porcentaje de interes de acuerdo a la finaciera que se seleccionó         
                $data["fee_value"]=ceil($fExcel->PMT($data["financing_rate"]/100, $data_sheet["term"], $data["financing_balance"]*(-1), 0, 0) );  //Calculo del valor de cuota
                $data["life_insurance_percent"]=$mParameters->life_insurance_percent($data_sheet["holder"]);  //Porcentaje del seguro de vida
                
                $data["fee_value_life_insurance"]=round($data["total_general"]*$data["life_insurance_percent"]);//Cuota del seguro de vida
                $data["fee_value_monthly"]=$data["fee_value"]+$data["fee_value_life_insurance"]; //Valor de la cuota mensual
                $data["life_insurance_value"]=$data["fee_value_life_insurance"]*$data_sheet["term"];   //Valor del seguro de vida
                
                $data["financing_value"]=0;
                
                if($data["fee_value"]>0 and $data_sheet["term"]>0 and $data["financing_balance"]>0 and $data["financing_rate"]>0){
                    $data["financing_value"]=$this->get_financing_value($data["financing_balance"], $data["fee_value"], $data["financing_rate"], $data_sheet["term"]); //Se calcula el valor total de los intereses
                }
                
                $data["financing_value_adjustment"]=($data["fee_value"]*$data_sheet["term"])-$data["financing_balance"]-$data["financing_value"];  //Se calcula el ajuste al peso
                
                $data["total_to_pay"]=$data["financing_balance"]+$data["life_insurance_value"]+$data["financing_value"]+$data["financing_value_adjustment"];
                $data["promissory_note_value"]=$data["total_to_pay"];
                
                if($data["financing_value"]>0){
                    $data["maximum_legal_rate"]=$mParameters->get_maximum_legal_rate();
                    $data["nominal_rate"]=($data["financing_rate"])*12;
                    $data["annual_effective_rate"]=round($fExcel->EFFECT($data["nominal_rate"]/100, 12)*100,2);
                }
                
            }
        }
        
        
        
        if(is_array($data)){
            $mSheet->update($business_sheet_id,$data);
        }
        
    }
    /**
     * Calcula el valor total de los intereses
     * @param type $capital
     * @param type $fee_value
     * @param type $rate
     * @param type $therm
     * @return type
     */
    function get_financing_value($capital, $fee_value,$rate,$therm){
        $financing_value=0;
        $financing_value_count=0;
        $rate=$rate/100;
        for($i=0;$i<=$therm;$i++){
            if($i==0){
                $financing_value_count=$capital;
                continue;
            }
            $interest=$financing_value_count*$rate;
            $capital_pay=$fee_value-$interest;
            $financing_value_count=$financing_value_count-$capital_pay;
            $financing_value=$financing_value+$interest;
        }
        return(round($financing_value));
    }

    
}

