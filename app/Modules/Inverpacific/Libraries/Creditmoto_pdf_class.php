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

use App\Modules\TS5\Libraries\Ts5_Tcpdf;

class Creditmoto_pdf_class extends Ts5_Tcpdf{

    /**
     * Genera el pdf de una hoja de negocios
     * @param type $id
     * @return type
     */   
    public function business_sheet_pdf($id){
        
        $mSheet=model('App\Modules\Inverpacific\Models\BusinessSheetsView');
        $data_sheet=$mSheet->get_Data($id);
        $mFormat=model('App\Modules\TS5\Models\AppQualityFormats');
        $format_id=500;
        $data_format=$mFormat->get_Data($format_id);
        $this->pdf_init();
        $html=$this->quality_header($data_format,'No. '.$data_sheet["consecutive"]);
        $this->writeHTML($html);
        //$html=$this->company_info(lang('creditmoto.format_consecutive').' <strong>'.$data_sheet["consecutive"].'</strong>');
        //$this->writeHTML($html);
        if($data_sheet["app_thirds_id"]<>''){
            $mThirds=model('App\Modules\TS5\Models\ViewThirds');
            $data_third=$mThirds->get_Data($data_sheet["app_thirds_id"]);
            $html=$this->general_info($data_sheet,$data_third);
            $this->writeHTML($html);
            $html=$this->severals($id);
            $this->writeHTML($html);
            $html=$this->totals_sheet($data_sheet);
            $this->writeHTML($html);
            $html=$this->observations_sheet($data_sheet);
            $this->writeHTML($html);
            $html='<div style="text-align: justify;font-size:8px">'.$data_format["notes"]."</div>";
            $this->writeHTML($html);
            $this->SetY(240);
            $html=$this->signatures_sheet($data_sheet, $data_third);            
            $this->writeHTML($html);
            
        }
        $this->Output('hoja_negocio_'.$data_sheet["consecutive"].'.pdf', 'I');
        
        
        return($html);
        
    }
    
    
    /**
     * retorna el html para las firmas del formato
     * @param type $data_sheet
     * @param type $data_third
     */
    public function signatures_sheet($data_sheet,$data_third) {
        $html='<table >';
            $html.='<tr >';
                $html.='<td style="text-align:center">';
                    $html.='<strong>'.lang('fields.buyer').'</strong>';
                $html.='</td>';
              
                $html.='<td style="text-align:center">';
                    $html.='<strong>'.lang('fields.seller').'</strong>';
                $html.='</td>';                
             
                $html.='<td style="text-align:center">';
                    $html.='<strong>Vo Bo '.lang('fields.verified').'</strong>';
                $html.='</td>';                
               
                $html.='<td style="text-align:center">';
                    $html.='<strong>Vo Bo '.lang('fields.approved').'</strong>';
                $html.='</td>';                
             
                $html.='<td style="text-align:center">';
                    $html.='<strong>Vo Bo '.lang('fields.reviewed').'</strong>';
                $html.='</td>';                
            $html.='</tr>';
            
            $line='<br><br><br><br>__________________';
            $html.='<tr >';
                $html.='<td style="text-align:center;border: 1px solid #ddd">';
                    $html.=$line.'<br><strong>'.$data_third["identification"].'</strong>';
                $html.='</td>';
              
                $html.='<td style="text-align:center;border: 1px solid #ddd">';
                    $html.='<br><br><br>'.$data_sheet["author_name"].'<br>__________________<br>'.'<strong>'.$data_sheet["author_identification"].'</strong>';
                $html.='</td>';                
             
                $html.='<td style="text-align:center;border: 1px solid #ddd">';
                    $html.=$line;
                $html.='</td>';                
               
                $html.='<td style="text-align:center;border: 1px solid #ddd">';
                    $html.=$line;
                $html.='</td>';                
             
                $html.='<td style="text-align:center;border: 1px solid #ddd">';
                    $html.=$line;
                $html.='</td>';                
            $html.='</tr>';
        $html.='</table>';
        return($html);
    }
    
    /**
     * retorna el html con las observaciones de la hoja de negocios
     * @param type $data_sheet
     */
    public function observations_sheet($data_sheet) {
        $html='<table cellspacing="0" cellpadding="2" border="1">';
            $html.='<tr border="1">';
                $html.='<td style="border: 1px solid #ddd;text-align:center">';
                    $html.='<strong>'.lang('fields.observations').'</strong>';
                $html.='</td>';
            $html.='</tr>';
            $html.='<tr border="1">';    
                $html.='<td style="border: 1px solid #ddd;text-align:left">';
                    $html.=$data_sheet["observations"];
                $html.='</td>';
                
            $html.='</tr>';
        $html.='</table>';
        return($html);
            
    }
    
    /**
     * html de los adicionales de la moto
     * @param type $id
     */
    public function severals($business_sheet_id) {
        $html='';
        $mSeverals=model('App\Modules\Inverpacific\Models\BusinessSheetSeveralsAdds');
        $result=$mSeverals->select('creditmoto_business_sheet_severals_adds.*,creditmoto_business_sheet_severals.name as several_name')
                ->join('creditmoto_business_sheet_severals','creditmoto_business_sheet_severals.id=creditmoto_business_sheet_severals_adds.several_id')
                ->where('creditmoto_business_sheet_severals_adds.business_sheet_id',$business_sheet_id)->find();
        
        if(!isset($result[0])){
           return($html);            
        }
        
        $html.='<table cellspacing="0" cellpadding="2" border="1">';
            $html.='<tr border="1">';
                $html.='<td colspan="4"  style="border: 1px solid #ddd;text-align:center">';
                    $html.='<strong>'.lang('fields.severals').'</strong>';
                $html.='</td>';
            $html.='</tr>'; 
            $html.='<tr border="1">';
                $html.='<td  style="border: 1px solid #ddd;text-align:center">';
                    $html.='<strong>'.lang('fields.several_id').'</strong>';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;text-align:center">';
                    $html.='<strong>'.lang('fields.concept').'</strong>';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;text-align:center">';
                    $html.='<strong>'.lang('fields.bill_number').'</strong>';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;text-align:center">';
                    $html.='<strong>'.lang('fields.value').'</strong>';
                $html.='</td>';
            $html.='</tr>'; 
            $total=0;
            foreach ($result as $key => $value) {
                $total=$total+$value["value"];
                $html.='<tr border="1">';
                    $html.='<td style="border: 1px solid #ddd;text-align:left">';
                        $html.=$value["several_name"];
                    $html.='</td>';
                    $html.='<td style="border: 1px solid #ddd;text-align:left">';
                        $html.=$value["concept"];
                    $html.='</td>';
                    $html.='<td style="border: 1px solid #ddd;text-align:left">';
                        $html.=$value["bill_number"];
                    $html.='</td>';
                    $html.='<td style="border: 1px solid #ddd;text-align:right">';
                        $html.=number_format($value["value"]);
                    $html.='</td>';
                $html.='</tr>';   
            }
            $html.='<tr border="1">';
                $html.='<td colspan="3"  style="border: 1px solid #ddd;text-align:right">';
                    $html.='<strong>'.lang('fields.total').' </strong>:';
                $html.='</td>';
                $html.='<td style="border: 1px solid #ddd;text-align:right">';
                    $html.='<strong>'.number_format($total).' </strong>';
                $html.='</td>';
            $html.='</tr>';      
        $html.='</table>';    
        return($html);
    }   
    /**
     * Información general de la hoja de negocios
     * @param type $data_sheet
     * @param type $data_third
     * @return type
     */
    public function general_info($data_sheet,$data_third) {
        
        $html='<table cellspacing="0" cellpadding="2" border="1">';
            $html.='<tr border="1">';
                $html.='<td width="15%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.date').' </strong>:';
                $html.='</td>';
                $html.='<td width="35%;" style="border: 1px solid #ddd;">';
                    $html.=$data_sheet["created_at"];
                $html.='</td>';
                $html.='<td width="12%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.invoice').' </strong>:';
                $html.='</td>';
                $html.='<td width="18%;" style="border: 1px solid #ddd;">';
                    $html.=$data_sheet["invoice"];
                $html.='</td>';
                $html.='<td width="10%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.cifin').' </strong>:';
                $html.='</td>';
                $html.='<td width="10%;" style="border: 1px solid #ddd;">';
                    $html.=$data_sheet["cifin"];
                $html.='</td>';
            $html.='</tr>';
            
            $html.='<tr border="1">';
                $html.='<td width="15%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.customer').' </strong>:';
                $html.='</td>';
                $html.='<td width="35%;" style="border: 1px solid #ddd;">';
                    $html.=$data_third["name"];
                $html.='</td>';
                $html.='<td width="12%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.identification').' </strong>:';
                $html.='</td>';
                $html.='<td width="18%;" style="border: 1px solid #ddd;">';
                    $html.=$data_third["identification"];
                $html.='</td>';
                $html.='<td width="10%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.fosiga').' </strong>:';
                $html.='</td>';
                $html.='<td width="10%;" style="border: 1px solid #ddd;">';
                    $html.=$data_sheet["fosiga"];
                $html.='</td>';
            $html.='</tr>';
            
            $html.='<tr border="1">';
                $html.='<td width="15%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.address').' </strong>:';
                $html.='</td>';
                $html.='<td width="35%;" style="border: 1px solid #ddd;">';
                    $html.=$data_third["address"];
                $html.='</td>';
                $html.='<td width="12%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.neighborhood').' </strong>:';
                $html.='</td>';
                $html.='<td width="18%;" style="border: 1px solid #ddd;">';
                    $html.=$data_third["neighborhood"];
                $html.='</td>';
                $html.='<td width="10%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.simit').' </strong>:';
                $html.='</td>';
                $html.='<td width="10%;" style="border: 1px solid #ddd;">';
                    $html.=$data_sheet["simit"];
                $html.='</td>';
            $html.='</tr>';
            
            $html.='<tr border="1">';
                $html.='<td width="15%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.phone').' </strong>:';
                $html.='</td>';
                $html.='<td width="35%;" style="border: 1px solid #ddd;">';
                    $html.=$data_third["telephone1"];
                $html.='</td>';
                $html.='<td width="12%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.municipalities_name').' </strong>:';
                $html.='</td>';
                $html.='<td width="18%;" style="border: 1px solid #ddd;">';
                    $html.=$data_third["municipalities_name"];
                $html.='</td>';
                $html.='<td width="10%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.runt').' </strong>:';
                $html.='</td>';
                $html.='<td width="10%;" style="border: 1px solid #ddd;">';
                    $html.=$data_sheet["runt"];
                $html.='</td>';
            $html.='</tr>';
            
            $html.='<tr border="1">';
                $html.='<td width="15%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.mail').' </strong>:';
                $html.='</td>';
                $html.='<td width="35%;" style="border: 1px solid #ddd;">';
                    $html.=$data_third["mail"];
                $html.='</td>';
                $html.='<td width="12%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.mobile').' </strong>:';
                $html.='</td>';
                $html.='<td width="18%;" style="border: 1px solid #ddd;">';
                    $html.=$data_third["telephone2"];
                $html.='</td>';
                $html.='<td width="10%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.trademark').' </strong>:';
                $html.='</td>';
                $html.='<td width="10%;" style="border: 1px solid #ddd;">';
                    $html.=$data_sheet["trademark_name"];
                $html.='</td>';
            $html.='</tr>';
            
            $html.='<tr border="1">';
                $html.='<td width="15%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.motorcycle').' </strong>:';
                $html.='</td>';
                $html.='<td width="35%;" style="border: 1px solid #ddd;">';
                    $html.=$data_sheet["motorcycle_name"];
                $html.='</td>';
                $html.='<td width="12%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.color').' </strong>:';
                $html.='</td>';
                $html.='<td width="18%;" style="border: 1px solid #ddd;">';
                    $html.=$data_sheet["color_name"];
                $html.='</td>';
                $html.='<td width="10%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.motor_number').' </strong>:';
                $html.='</td>';
                $html.='<td width="10%;" style="border: 1px solid #ddd;">';
                    $html.=$data_sheet["motor_number"];
                $html.='</td>';
            $html.='</tr>';
            
            $html.='<tr border="1">';
                $html.='<td width="15%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.financial_name').' </strong>:';
                $html.='</td>';
                $html.='<td width="35%;" style="border: 1px solid #ddd;">';
                    $html.=$data_sheet["financial_name"].' ('.$data_sheet["creditmoto_business_sheet_types_name"].') ';
                $html.='</td>';
                $html.='<td width="12%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.solidarity_debtor').' </strong>:';
                $html.='</td>';
                $html.='<td width="18%;" style="border: 1px solid #ddd;">';
                    $html.=$data_sheet["solidarity_debtor"];
                $html.='</td>';
                $html.='<td width="10%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.term').' </strong>:';
                $html.='</td>';
                $html.='<td width="10%;" style="border: 1px solid #ddd;">';
                    $html.=$data_sheet["term"];
                $html.='</td>';
            $html.='</tr>';
            
        $html.='</table>';
        return($html);
    }
    
    /**
     * html de los totales de la hoja de negocio
     * @param type $data_sheet
     * @return type
     */
    public function totals_sheet($data_sheet) {
        
        $html='<table cellspacing="0" cellpadding="2" border="1">';
            $html.='<tr border="1">';
                $html.='<td width="48%;" colspan="2"  style="border: 1px solid #ddd;text-align:center">';
                    $html.='<strong>'.lang('fields.subtotal_general').'</strong>';
                $html.='</td>';
                $html.='<td width="4%;" colspan="1" style="border: 1px solid #ddd;text-align:center">';
                    $html.=' ';
                $html.='</td>';
                $html.='<td width="48%;" colspan="2" style="border: 1px solid #ddd;text-align:center">';
                    $html.='<strong>'.lang('fields.total').'</strong>';
                $html.='</td>';
            $html.='</tr>';
            $html.='<tr border="1">';
                $html.='<td width="38%;" style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.motorcycle_value').' </strong>:';
                $html.='</td>';
                $html.='<td width="10%;" style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["motorcycle_value"]);
                $html.='</td>';
                $html.='<td width="4%;"  colspan="1" style="border: 1px solid #ddd;text-align:center">';
                    $html.=' ';
                $html.='</td>';
                $html.='<td width="38%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.guarantee_fund').' </strong>('.($data_sheet["guarantee_fund_percent"]*100).'%):';
                $html.='</td>';
                $html.='<td width="10%;" style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["guarantee_fund_value"]);
                $html.='</td>';
                
            $html.='</tr>';
            
            $html.='<tr border="1">';
                $html.='<td   style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.tax_percent_value').' </strong>:';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["tax_percent_value"]*100).'%';
                $html.='</td>';
                $html.='<td colspan="1" style="border: 1px solid #ddd;text-align:center">';
                    $html.=' ';
                $html.='</td>';
                $html.='<td   style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.guarantee_fund_iva_value').' </strong>:';
                $html.='</td>';
                $html.='<td style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["guarantee_fund_iva_value"]);
                $html.='</td>';
                
            $html.='</tr>';
            
            $html.='<tr border="1">';
                $html.='<td   style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.motorcycle_value_before_taxes').' </strong>:';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["motorcycle_value_before_taxes"]);
                $html.='</td>';
                $html.='<td colspan="1" style="border: 1px solid #ddd;text-align:center">';
                    $html.=' ';
                $html.='</td>';
                $html.='<td   style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.total_administration_expenses').' </strong>:';
                $html.='</td>';
                $html.='<td style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["total_administration_expenses"]);
                $html.='</td>';
                
            $html.='</tr>';
            
            $html.='<tr border="1">';
                $html.='<td   style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.discount').' </strong>:';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["discount"]);
                $html.='</td>';
                $html.='<td colspan="1" style="border: 1px solid #ddd;text-align:center">';
                    $html.=' ';
                $html.='</td>';
                $html.='<td   style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.total_general').' </strong>:';
                $html.='</td>';
                $html.='<td style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["total_general"]);
                $html.='</td>';
                
            $html.='</tr>';
            
            $html.='<tr border="1">';
                $html.='<td   style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.subtotal').' </strong>:';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["subtotal"]);
                $html.='</td>';
                $html.='<td colspan="1" style="border: 1px solid #ddd;text-align:center">';
                    $html.=' ';
                $html.='</td>';
                $html.='<td   style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.financing_balance').' </strong>:';
                $html.='</td>';
                $html.='<td style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["financing_balance"]);
                $html.='</td>';
                
            $html.='</tr>';
            
            $html.='<tr border="1">';
                $html.='<td   style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.iva_value').' </strong>:';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["iva_value"]);
                $html.='</td>';
                $html.='<td colspan="1" style="border: 1px solid #ddd;text-align:center">';
                    $html.=' ';
                $html.='</td>';
                $html.='<td   style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.financing_value').' </strong>:';
                $html.='</td>';
                $html.='<td style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["financing_value"]);
                $html.='</td>';
                
            $html.='</tr>';
            
            $html.='<tr border="1">';
                $html.='<td   style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.total_motorcycle').' </strong>:';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["total_motorcycle"]);
                $html.='</td>';
                $html.='<td colspan="1" style="border: 1px solid #ddd;text-align:center">';
                    $html.=' ';
                $html.='</td>';
                $html.='<td   style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.financing_value_adjustment').' </strong>:';
                $html.='</td>';
                $html.='<td style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["financing_value_adjustment"]);
                $html.='</td>';
                
            $html.='</tr>';
            
            $html.='<tr border="1">';
                $html.='<td   style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.several_value').' </strong>:';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["several_value"]);
                $html.='</td>';
                $html.='<td colspan="1" style="border: 1px solid #ddd;text-align:center">';
                    $html.=' ';
                $html.='</td>';
                $html.='<td   style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.life_insurance_value').' </strong> ('.$data_sheet["life_insurance_percent"].'):';
                $html.='</td>';
                $html.='<td style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["life_insurance_value"]);
                $html.='</td>';
                
            $html.='</tr>';
            
            $html.='<tr border="1">';
                $html.='<td   style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.total_more_several').' </strong>:';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["total_more_several"]);
                $html.='</td>';
                $html.='<td colspan="1" style="border: 1px solid #ddd;text-align:center">';
                    $html.=' ';
                $html.='</td>';
                $html.='<td   style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.total_to_pay').' </strong>:';
                $html.='</td>';
                $html.='<td style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["total_to_pay"]);
                $html.='</td>';
                
            $html.='</tr>';
            
            $html.='<tr border="1">';
                $html.='<td   style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.initial_fee').' </strong>:';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["initial_fee"]);
                $html.='</td>';
                $html.='<td colspan="1" style="border: 1px solid #ddd;text-align:center">';
                    $html.=' ';
                $html.='</td>';
                $html.='<td   style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.fee_value').' </strong>:';
                $html.='</td>';
                $html.='<td style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["fee_value"]);
                $html.='</td>';
                
            $html.='</tr>';
            
            $html.='<tr border="1">';
                $html.='<td   style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.retake').' </strong>:';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["retake"]);
                $html.='</td>';
                $html.='<td colspan="1" style="border: 1px solid #ddd;text-align:center">';
                    $html.=' ';
                $html.='</td>';
                $html.='<td   style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.fee_value_life_insurance').' </strong>:';
                $html.='</td>';
                $html.='<td style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["fee_value_life_insurance"]);
                $html.='</td>';
                
            $html.='</tr>';
            
            $html.='<tr border="1">';
                $html.='<td   style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.subtotal_general').' </strong>:';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["subtotal_general"]);
                $html.='</td>';
                $html.='<td colspan="1" style="border: 1px solid #ddd;text-align:center">';
                    $html.=' ';
                $html.='</td>';
                $html.='<td   style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.fee_value_monthly').' </strong>:';
                $html.='</td>';
                $html.='<td style="border: 1px solid #ddd;text-align:right">';
                    $html.='<strong>'.number_format($data_sheet["fee_value_monthly"]).'</strong>';
                $html.='</td>';
                
            $html.='</tr>';
            
        $html.='</table>';
        return($html);
    }
    
    
    /**
     * Genera el pdf de un liquidador de una hoja de negocios
     * @param type $id
     * @return type
     */   
    public function business_sheet_pdf_liquidator($id){
        
        $mSheet=model('App\Modules\Inverpacific\Models\BusinessSheetsView');
        $data_sheet=$mSheet->get_Data($id);
        $mFormat=model('App\Modules\TS5\Models\AppQualityFormats');
        $format_id=500;
        $data_format=$mFormat->get_Data($format_id);
        $this->pdf_init();
        $html=$this->quality_header($data_format,'No. '.$data_sheet["consecutive"]);
        $this->writeHTML($html);
        
        $mThirds=model('App\Modules\TS5\Models\ViewThirds');
        $data_third=$mThirds->get_Data($data_sheet["app_thirds_id"]);
        $html=$this->general_info($data_sheet,$data_third);
        $this->writeHTML($html);
        
        $html='<h2>LIQUIDADOR</h2><br>';
        $this->writeHTML($html);
        if($data_sheet["payment_start_date"]<>''){
            $html=$this->general_info_liquidator($data_sheet);
            $this->writeHTML($html);
            $html=$this->payment_plan($data_sheet);
            $this->writeHTML($html);
        }else{
            $this->writeHTML('Debe establecer una fecha inicial de pagos');
        }
        
        $this->Output('hoja_negocio_liquidador'.$data_sheet["consecutive"].'.pdf', 'I');
        
        
        return($html);
        
    }
    /**
     * Genera el plan de pagos
     * @param type $data_sheet
     * @return type
     */
    public function payment_plan($data_sheet) {
        $html='<table cellspacing="0" cellpadding="2" border="1">';
            $html.='<tr border="1">';
                $html.='<td colspan="9"  style="border: 1px solid #ddd;background-color:#010243;color:white;text-align:center">';
                    $html.='<strong>'.lang('creditmoto.payment_plan').' </strong>';
                $html.='</td>';
            $html.='</tr>';    
            $html.='<tr border="1">';
            
                $html.='<td colspan="1"  style="border: 1px solid #ddd;background-color:#010243;color:white;text-align:center">';
                    $html.='<strong>'.lang('creditmoto.expiration').' </strong>';
                $html.='</td>';
                $html.='<td colspan="1"  style="border: 1px solid #ddd;background-color:#010243;color:white;text-align:center">';
                    $html.='<strong>'.lang('creditmoto.months').' </strong>';
                $html.='</td>';
                $html.='<td colspan="1"  style="border: 1px solid #ddd;background-color:#010243;color:white;text-align:center">';
                    $html.='<strong>'.lang('creditmoto.capital_balance').' </strong>';
                $html.='</td>';
                $html.='<td colspan="1"  style="border: 1px solid #ddd;background-color:#010243;color:white;text-align:center">';
                    $html.='<strong>'.lang('creditmoto.capital_payment').' </strong>';
                $html.='</td>';
                $html.='<td colspan="1"  style="border: 1px solid #ddd;background-color:#010243;color:white;text-align:center">';
                    $html.='<strong>'.lang('creditmoto.interest').' </strong>';
                $html.='</td>';
                $html.='<td colspan="1"  style="border: 1px solid #ddd;background-color:#010243;color:white;text-align:center">';
                    $html.='<strong>'.lang('creditmoto.fee').' </strong>';
                $html.='</td>';
                $html.='<td colspan="1"  style="border: 1px solid #ddd;background-color:#010243;color:white;text-align:center">';
                    $html.='<strong>'.lang('creditmoto.extra_fee').' </strong>';
                $html.='</td>';
                $html.='<td colspan="1"  style="border: 1px solid #ddd;background-color:#010243;color:white;text-align:center">';
                    $html.='<strong>'.lang('creditmoto.total').' </strong>';
                $html.='</td>';
                $html.='<td colspan="1"  style="border: 1px solid #ddd;background-color:#010243;color:white;text-align:center">';
                    $html.='<strong>'.lang('creditmoto.interest_balance').' </strong>';
                $html.='</td>';
            $html.='</tr>';
            
            $financing_value=0;
            $financing_value_count=0;
            $rate=$data_sheet["financing_rate"]/100;
            $financing_balance=$data_sheet["financing_value"];
            $therm=$data_sheet["term"];
            $capital=$data_sheet["total_general"];
            $fee_value=$data_sheet["fee_value"];
            $months=0;
            $capital_pay_total=0;
            $fee_summation=0;
            $extra_fee_total=0;
            $fee_totals=0;
            for($i=0;$i<=$therm;$i++){
                $date_payment_day = date('Y-m-d', strtotime($data_sheet["payment_start_date"]) + 86400);
                
                $expiration = date("m-Y",strtotime("$date_payment_day + $months month"));
                $extra_fee=0;
                if($i==0){
                    $financing_value_count=$capital;
                    $interest=0;
                    $capital_pay=0;
                    //$fee_value=0;
                    $financing_value=0;
                    $total_fee=0;
                }else{
                    $interest=$financing_value_count*$rate;
                    $capital_pay=$fee_value-$interest;
                    $financing_value_count=$financing_value_count-$capital_pay;
                    $financing_value=$financing_value+$interest;
                    $financing_balance=$financing_balance-$interest;
                    $total_fee=$fee_value+$extra_fee;
                    $capital_pay_total=$capital_pay_total+$capital_pay;
                    $fee_summation=$fee_summation+$fee_value;
                    $extra_fee_total=$extra_fee_total+$extra_fee;
                    $fee_totals=$total_fee+$fee_totals;
                }
                $html.='<tr border="1">';
            
                    $html.='<td colspan="1"  style="border: 1px solid #ddd;text-align:rigth">';
                        $html.=$expiration;
                    $html.='</td>';
                    $html.='<td colspan="1"  style="border: 1px solid #ddd;text-align:rigth">';
                        $html.=$months;
                    $html.='</td>';
                    $html.='<td colspan="1"  style="border: 1px solid #ddd;text-align:rigth">';
                        $html.=number_format($financing_value_count);
                    $html.='</td>';
                    $html.='<td colspan="1"  style="border: 1px solid #ddd;text-align:rigth">';
                        $html.=number_format($capital_pay);
                    $html.='</td>';
                    $html.='<td colspan="1"  style="border: 1px solid #ddd;text-align:rigth">';
                        $html.=number_format($interest,2);
                    $html.='</td>';
                    $html.='<td colspan="1"  style="border: 1px solid #ddd;text-align:rigth">';
                        if($i==0){
                            $f=0;
                        }else{
                            $f=$fee_value;
                        }
                        $html.= number_format($f);
                    $html.='</td>';
                    $html.='<td colspan="1"  style="border: 1px solid #ddd;text-align:rigth">';
                        $html.=$extra_fee;
                    $html.='</td>';
                    $html.='<td colspan="1"  style="border: 1px solid #ddd;text-align:rigth">';
                        $html.=number_format($total_fee);
                    $html.='</td>';
                    $html.='<td colspan="1"  style="border: 1px solid #ddd;text-align:rigth">';
                        $html.=number_format($financing_balance);
                    $html.='</td>';
                $html.='</tr>';
                
                $months=$months+1;
            }
            $html.='<tr>';
                $html.='<td colspan="3"  style="border: 1px solid #ddd;text-align:rigth">';
                    $html.='TOTAL';
                $html.='</td>';
                $html.='<td colspan="1"  style="border: 1px solid #ddd;text-align:rigth">';
                    $html.='<strong>'.number_format($capital_pay_total).'</strong>';  
                $html.='</td>';
                $html.='<td colspan="1"  style="border: 1px solid #ddd;text-align:rigth">';
                    $html.='<strong>'.number_format($financing_value).'</strong>';
                $html.='</td>';
                $html.='<td colspan="1"  style="border: 1px solid #ddd;text-align:rigth">';
                    $html.='<strong>'.number_format($fee_summation).'</strong>';  
                $html.='</td>';
                $html.='<td colspan="1"  style="border: 1px solid #ddd;text-align:rigth">';
                    $html.='<strong>'.number_format($extra_fee_total).'</strong>';  
                $html.='</td>';
                $html.='<td colspan="1"  style="border: 1px solid #ddd;text-align:rigth">';
                    $html.='<strong>'.number_format($fee_totals).'</strong>';   
                $html.='</td>';
                $html.='<td colspan="1"  style="border: 1px solid #ddd;text-align:rigth">';
                    $html.=' ';
                $html.='</td>';
            $html.='</tr>';
        $html.='</table>';
        return($html);
    }
    
    /**
     * Info general del liquidador
     * @param type $data_sheet
     * @return type
     */
    public function general_info_liquidator($data_sheet) {
        
        $html='<table cellspacing="0" cellpadding="2" border="1">';
            $html.='<tr border="1">';
                $html.='<td width="22%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.credit_value').' </strong>:';
                $html.='</td>';
                $html.='<td width="13%;" style="border: 1px solid #ddd; text-align:right">';
                    $html.=number_format($data_sheet["total_general"]);
                $html.='</td>';
                $html.='<td width="18%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.iva_rate').' </strong>:';
                $html.='</td>';
                $html.='<td width="13%;" style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["tax_percent_value"]*100,2).'%';
                $html.='</td>';
                $html.='<td width="20%;"  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.payment_start_date').' </strong>:';
                $html.='</td>';
                $html.='<td width="14%;" style="border: 1px solid #ddd;text-align:right">';
                    $html.=$data_sheet["payment_start_date"];
                $html.='</td>';
            $html.='</tr>';
            
            $html.='<tr border="1">';
                $html.='<td  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.fee_value').' </strong>:';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd; text-align:right">';
                    $html.=number_format($data_sheet["fee_value"]);
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.maximum_legal_rate').' </strong>:';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;text-align:right">';
                    $html.=($data_sheet["maximum_legal_rate"]).'%';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.initial_fee').' </strong>:';
                $html.='</td>';
                $html.='<td style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["initial_fee"]);
                $html.='</td>';
            $html.='</tr>';
            
            $html.='<tr border="1">';
                $html.='<td  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.fee_value_life_insurance').' </strong>:';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd; text-align:right">';
                    $html.=number_format($data_sheet["fee_value_life_insurance"]);
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.annual_effective_rate').' </strong>:';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;text-align:right">';
                    $html.=($data_sheet["annual_effective_rate"]).'%';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.payment_day_month').' </strong>:';
                $html.='</td>';
                $html.='<td style="border: 1px solid #ddd;text-align:right">';
                    $html.=($data_sheet["payment_day_month"])." día de cada mes";
                $html.='</td>';
            $html.='</tr>';
            
            $html.='<tr border="1">';
                $html.='<td  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.fee_value_monthly').' </strong>:';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd; text-align:right">';
                    $html.=number_format($data_sheet["fee_value_monthly"]);
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.nominal_rate').' </strong>:';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["nominal_rate"],2).'%';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.life_insurance_value').' </strong>:';
                $html.='</td>';
                $html.='<td style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["life_insurance_value"]);
                $html.='</td>';
            $html.='</tr>';
            
            
            $html.='<tr border="1">';
                $html.='<td  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.term').' </strong>:';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd; text-align:right">';
                    $html.=number_format($data_sheet["term"]);
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;">';
                    $html.='<strong>'.lang('fields.financing_rate').' </strong>:';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;text-align:right">';
                    $html.=number_format($data_sheet["financing_rate"],2).'%';
                $html.='</td>';
                $html.='<td  style="border: 1px solid #ddd;">';
                    $html.="";
                $html.='</td>';
                $html.='<td style="border: 1px solid #ddd;text-align:right">';
                    $html.="";
                $html.='</td>';
            $html.='</tr>';
            
            
        $html.='</table>';
        return($html);
    }
    
    
}

