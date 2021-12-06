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
 * Clase con las funciones para realizar una nomina
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvaran Valencia <jalvaran@gmail.com>
 * @created 2021-11-28
 * @updated 2021-11-28
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

namespace App\Modules\Payroll\Libraries;

use App\Modules\TS5\Libraries\Session;
use App\Modules\TS5\Libraries\Ts5_class;

class Payroll_class{

    private $session;
    private $user_id;
    private $api_id;
    private $ts5;

    public function __construct(){
        $this->session = new Session();
        $this->user_id=$this->session->get('user');
        $this->api_id=2;  //Api de SOENAC
        $this->ts5=new Ts5_class();
    }
    /**
     * Agregar empleado a un documento de nomina general
     * @param type $payroll_documents_id
     * @param type $payroll_employee_id
     */
    public function add_EmployeeGeneralDocument($payroll_documents_id,$payroll_employee_id) {
        $id=$this->ts5->getUniqueId("",true);
        $m_EmployeeAdd=model('App\Modules\Payroll\Models\EmployeesAdded');
        //valido si ya se ha agregado un empleado a un documento de nomina general
        $result=$m_EmployeeAdd->select('id')
                ->where('payroll_documents_id',$payroll_documents_id)
                ->where('payroll_employee_id',$payroll_employee_id)
                
                ->first();
        
        if(!isset($result["id"])){//Si no está agregado se realiza el proceso
            $m_EmployeeAdd->add_Employee($id,$payroll_documents_id,$payroll_employee_id,$this->user_id);
            $indivial_document_id=$this->ts5->getUniqueId("",true);
            $this->individual_payroll_create($indivial_document_id, $payroll_documents_id, $payroll_employee_id, 0);
            
         }
        
    }
    /**
     * Elimina un devengado de un documento de nomina
     * @param type $id
     */
    public function delete_earn($id) {
        $mEarn=model('App\Modules\Payroll\Models\DocumentsEarns');
        $data_form=$mEarn->get_Data($id);
        
        $types_adjust=array(12,17,18,19,20,25,28,29,39);  //incapacidades, huelgas, suspensiones, teletrabajo, compensatorios,vacaciones etc
        if(in_array($data_form["payroll_type_earn_id"],$types_adjust)   ){
            /*
             * Ajusto los dias y pagos por concepto de salario
             */
            $data_basic_salary=$mEarn->get_BasicSalaryInDocument($data_form["payroll_documents_id"],$data_form["payroll_employee_id"]);
            
            if(isset($data_basic_salary["id"])){
                $quantity_new=$data_basic_salary["quantity"]+$data_form["quantity"];
                $payment_new=(($data_basic_salary["payment"]/$data_basic_salary["quantity"])*$quantity_new);
                $mEarn->set('quantity',$quantity_new);
                $mEarn->set('payment',$payment_new);
                $mEarn->where('id',$data_basic_salary["id"]);
                $mEarn->update();
            }
            /*
             * Ajusto los dias y pagos por concepto de auxilio de transporte
             */
            $data_basic_salary=$mEarn->get_TransportationAssistance($data_form["payroll_documents_id"],$data_form["payroll_employee_id"]);
            if(isset($data_basic_salary["id"])){
                $quantity_new=$data_basic_salary["quantity"]+$data_form["quantity"];
                $payment_new=(($data_basic_salary["payment"]/$data_basic_salary["quantity"])*$quantity_new);               
                $mEarn->set('quantity',$quantity_new);
                $mEarn->set('payment',$payment_new);
                $mEarn->where('id',$data_basic_salary["id"]);
                $mEarn->update();
            }
        }
        
        
        $mEarn->where('id',$id);
        $mEarn->delete(); 
        $this->update_noveltlies($data_form,1);
    }
    
    /**
     * Elimina una deduccion de un documento de nomina
     * @param type $id
     */
    public function delete_deduction($id) {
        $mEarnDeduction=model('App\Modules\Payroll\Models\DocumentsDeductions');
        $data_form=$mEarnDeduction->get_Data($id);
        $mEarnDeduction->where('id',$id);
        $mEarnDeduction->delete(); 
        $this->update_noveltlies($data_form,2);
    }
    
    /**
     * Agrega un devengado a un documento de nomina general
     * 
     * @param type $data_form
     */
    public function earn_add_general_document($data_form,$update=1) {
        
        $mEarn=model('App\Modules\Payroll\Models\DocumentsEarns');
        $data_form["id"]=$this->ts5->getUniqueId("",true);
        $data_form["author"]=$this->user_id;                
        $mEarn->insert($data_form);
        $types_adjust=array(12,17,18,19,20,25,28,29,39);  //incapacidades, huelgas, suspensiones, teletrabajo, compensatorios,vacaciones etc
        if(in_array($data_form["payroll_type_earn_id"],$types_adjust)   ){
            /*
             * Ajusto los dias y pagos por concepto de salario
             */
            $data_basic_salary=$mEarn->get_BasicSalaryInDocument($data_form["payroll_documents_id"],$data_form["payroll_employee_id"]);
            
            if(isset($data_basic_salary["id"])){
                $quantity_new=$data_basic_salary["quantity"]-$data_form["quantity"];
                $payment_new=(($data_basic_salary["payment"]/$data_basic_salary["quantity"])*$quantity_new);
                $mEarn->set('quantity',$quantity_new);
                $mEarn->set('payment',$payment_new);
                $mEarn->where('id',$data_basic_salary["id"]);
                $mEarn->update();
            }
            /*
             * Ajusto los dias y pagos por concepto de auxilio de transporte
             */
            $data_basic_salary=$mEarn->get_TransportationAssistance($data_form["payroll_documents_id"],$data_form["payroll_employee_id"]);
            if(isset($data_basic_salary["id"])){
                $quantity_new=$data_basic_salary["quantity"]-$data_form["quantity"];
                $payment_new=(($data_basic_salary["payment"]/$data_basic_salary["quantity"])*$quantity_new);               
                $mEarn->set('quantity',$quantity_new);
                $mEarn->set('payment',$payment_new);
                $mEarn->where('id',$data_basic_salary["id"]);
                $mEarn->update();
            }
        }
            
        if($update==1){
            $this->update_noveltlies($data_form,1);
        }
        
        
    }
        
    /**
     * Agrega una deduccion a un documento de nomina general
     * 
     * @param type $data_form
     */
    public function deduction_add_general_document($data_form,$update=1) {
        
        $mDeduction=model('App\Modules\Payroll\Models\DocumentsDeductions');
        $data_form["id"]=$this->ts5->getUniqueId("",true);
        $data_form["author"]=$this->user_id;                
        $mDeduction->insert($data_form);
        if($update==1){
            $this->update_noveltlies($data_form,2);
        }
    }
    /**
     * Actualiza los conceptos de las novedades, dias laborados, salario trabajado, deducciones por salud, pension, de acuerdo a los devengados 
     * 
     * @param type $data_form
     */
    function update_noveltlies($data_form,$type_novelty){
        $m_general_payroll=model('App\Modules\Payroll\Models\GeneralDocuments');        
        $m_parameters=model('App\Modules\Payroll\Models\Parameters');
        $m_employee=model('App\Modules\Payroll\Models\Employees');
        $mEarns=model('App\Modules\Payroll\Models\DocumentsEarns');
        $mDeductions=model('App\Modules\Payroll\Models\DocumentsDeductions');
        if($type_novelty==1){ //Si es un devengado
            
            $total_salary=$mEarns->get_SalarialEarnsValue($data_form["payroll_documents_id"]);
            /*
             * actualizo los aportes a salud
             */
            $data_parameters=$m_parameters->get_Data(6);  //Ubicacion del porcentaje de aporte a salud por parte del trabajador                 
            $percent_health=$data_parameters["value"]/100;
            
            $payment=$total_salary*$percent_health;
            $mDeductions->set('payment',$payment);
            $mDeductions->where('payroll_documents_id', $data_form["payroll_documents_id"]);
            $mDeductions->where('payroll_type_deduction_id', 1);            
            $mDeductions->update();
            
            /*
             * actualizo los aportes a salud
             */
            $data_parameters=$m_parameters->get_Data(8);  //Ubicacion del porcentaje de aporte a pensiones por parte del trabajador                                   
            $percent_pension=$data_parameters["value"]/100;
            
            $payment=$total_salary*$percent_pension;
            $mDeductions->set('payment',$payment);
            $mDeductions->where('payroll_documents_id', $data_form["payroll_documents_id"]);
            $mDeductions->where('payroll_type_deduction_id', 2);            
            $mDeductions->update();
            
        }
        
        if($type_novelty==2){ //Si es una deduccion
            
        }
    }
    
    
    /**
     * Crea un documento de nomina individual
     * @param type $general_payroll_id
     * @param type $payroll_employee_id
     */
    public function individual_payroll_create($id,$payroll_documents_id,$payroll_employee_id,$novelty=0) {
        $m_individual_payroll=model('App\Modules\Payroll\Models\IndividualDocuments');
        $m_general_payroll=model('App\Modules\Payroll\Models\GeneralDocuments');        
        $m_parameters=model('App\Modules\Payroll\Models\Parameters');
        $m_employee=model('App\Modules\Payroll\Models\Employees');
        $data_employee=$m_employee->get_Data($payroll_employee_id);
        $prefix=$m_parameters->get_Prefix();
        $general_data=$m_general_payroll->get_Data($payroll_documents_id);
        
        if($m_individual_payroll->is_Created($payroll_documents_id,$payroll_employee_id)){
           return("E1"); 
        }
        if($data_employee["salary"]<=0){
            return("E2");
        }
        $amount_time=$this->days_calculate($data_employee["start_date"], $general_data["settlement_end_date"]);
        $data["id"]=$id;
        $data["payroll_documents_id"]=$payroll_documents_id;
        $data["payroll_employee_id"]=$payroll_employee_id;
        $data["novelty"]=$novelty;        
        $data["prefix"]=$prefix;
        $data["amount_time"]=$amount_time;
        //$data["worked_days"]=$worked_days;
        //$data["worked_salary"]=$worked_salary;
        //$data["rounding"]=round($worked_salary);
        $data["status"]=1;
        $data["author"]=$this->user_id;
        $m_individual_payroll->insert($data);
        

        //para uso futuro
        //$worked_days=$this->worked_days_calculate($general_data["settlement_start_date"], $general_data["settlement_end_date"]);

        $worked_days=30; //Se calcula en la primera versión siempre para 30 dias
        $worked_salary=$this->worked_salary_calculate($data_employee["salary"], $worked_days);
        
        /*
         * Se agrega el basico
         */
        
        $data_form["payroll_documents_id"]=$payroll_documents_id;
        $data_form["payroll_employee_id"]=$payroll_employee_id;
        $data_form["payroll_type_earn_id"]=1;
        $data_form["payment"]=$worked_salary;
        $data_form["quantity"]=$worked_days;
        $this->earn_add_general_document($data_form,0);
        
        /*
         * Se agrega el auxilio de transporte si aplica
         */
        if($data_employee["transportation_assistance"]>0){
            unset($data_form);            
            $data_form["quantity"]=30;
            $data_form["payroll_documents_id"]=$payroll_documents_id;
            $data_form["payroll_employee_id"]=$payroll_employee_id;
            $data_form["payroll_type_earn_id"]=2;
            $data_form["payment"]=$data_employee["transportation_assistance"];

            $this->earn_add_general_document($data_form,0);
        }
        /*
         * se agrega deduccion por salud
         */
        if($data_employee["eps_code"]<>''){ 
            unset($data_form);            
            $data_parameters=$m_parameters->get_Data(6);//Ubicacion donde está el porcentaje a cargo del empleado para salud
            $percent=$data_parameters["value"]/100;
            $payment=$percent*$worked_salary;
            $data_form["quantity"]=1;
            $data_form["payroll_documents_id"]=$payroll_documents_id;
            $data_form["payroll_employee_id"]=$payroll_employee_id;
            $data_form["payroll_type_deduction_id"]=1;
            $data_form["payment"]=$payment;
            $data_form["percentage"]=$data_parameters["value"];
            $this->deduction_add_general_document($data_form,0);
            
        }
        /*
         * Se agrega deduccion por fondo de pensiones
         */
        if($data_employee["afp_code"]<>''){ 
            unset($data_form);
            $data_parameters=$m_parameters->get_Data(8);//Ubicacion donde está el porcentaje a cargo del empleado para fondo de pensiones
            $percent=$data_parameters["value"]/100;
            $payment=$percent*$worked_salary;
            $data_form["quantity"]=1;
            $data_form["payroll_documents_id"]=$payroll_documents_id;
            $data_form["payroll_employee_id"]=$payroll_employee_id;
            $data_form["payroll_type_deduction_id"]=2;
            $data_form["payment"]=$payment;
            $data_form["percentage"]=$data_parameters["value"];
            $this->deduction_add_general_document($data_form,0);
            
        }
        
    }
    
    /**
     * Borrar un empleado de un documento de nomina
     * @param type $id
     */
    public function delete_employee_document($id) {
        $m_EmployeeAdd=model('App\Modules\Payroll\Models\EmployeesAdded');
        $data_add=$m_EmployeeAdd->get_Data($id);
        $m_EmployeeAdd->delete($id);
        $m_Earns=model('App\Modules\Payroll\Models\DocumentsEarns');
        $m_Earns->where('payroll_documents_id',$data_add["payroll_documents_id"]);
        $m_Earns->where('payroll_employee_id',$data_add["payroll_employee_id"]);
        $m_Earns->delete();        
        $m_Deductions=model('App\Modules\Payroll\Models\DocumentsDeductions');
        $m_Deductions->where('payroll_documents_id',$data_add["payroll_documents_id"]);
        $m_Deductions->where('payroll_employee_id',$data_add["payroll_employee_id"]);
        $m_Deductions->delete();
        $m_individual_document=model('App\Modules\Payroll\Models\IndividualDocuments');
        $m_individual_document->where('payroll_documents_id',$data_add["payroll_documents_id"]);
        $m_individual_document->where('payroll_employee_id',$data_add["payroll_employee_id"]);
        $m_individual_document->delete();
    }
    
    /**
     * Calcula los dias entre dos fechas
     * @param type $date_initial
     * @param type $date_end
     * @return type
     */
    public function days_calculate($date_initial,$date_end) {
        $date1 = new \DateTime($date_initial);
        $date2 = new \DateTime($date_end);
        $diff = $date1->diff($date2);
        $days=$diff->days;
        
        return($days);
    }
    
    /**
     * Calcula el salario trabajado
     * @param type $date_initial
     * @param type $date_end
     * @return type
     */
    public function worked_salary_calculate($salary,$worked_days) {        
        $worked_salary=($salary/30)*$worked_days;
        return($worked_salary);
    }
    
    /**
     * calcula el valor de una hora extra
     * @param type $payroll_employee_id
     * @param type $quantity
     * @param type $type_time_id
     * @return type
     */
    public function times_value_calculation($payroll_employee_id,$quantity,$type_time_id) {
        
        $mEmployees=model('App\Modules\Payroll\Models\Employees');
        $mTypeTimes=model('App\Modules\Payroll\Models\TypeTimes');
        $data_employee=$mEmployees->get_Data($payroll_employee_id);
        $data_TypeTime=$mTypeTimes->get_Data($type_time_id);
        $payment=($data_employee["salary"]/240)*$data_TypeTime["factor"]*$quantity;
        return($payment);
    }
    
    
    /**
     * Reportar un documento de nomina
     * @param type $data_company
     * @param type $data_document
     * @return type
     */
    public function report_individual_document($data_company,$data_document) {
        $end_point_id=28;//end point para reportar un documento de nomina electronica
        $document_id=$data_document["id"];
        $process_id=$this->ts5->getUniqueId("",true);
        $mApiResponses=model('App\Modules\TS5\Models\AppAppsResponsesClient');
        $mApiEndPoints=model('App\Modules\TS5\Models\AppAppsEndPoints');
        $mParameters=model('App\Modules\Payroll\Models\Parameters');
        
        $mApi=model('App\Modules\TS5\Models\AppApps');
        $api_id=$this->api_id;
        $token_api=$data_company["token_api_soenac"];
        $environment=$mParameters->get_Environment();
        $json=$this->get_json_payroll_support($data_company,$mParameters,$data_document);
        //exit($json);
        $url=$mApi->get_Url($api_id);
        $data_endpoint=$mApiEndPoints->get_EndPoint($end_point_id);
        $end_point=$data_endpoint["name"];
        
        if($environment==2){//Si está en ambiente de pruebas
            $testSetId=$mParameters->get_TestSetld();
            $end_point=$data_endpoint["name"]."/".$testSetId;
        }
        
        
        $method=$data_endpoint["method"];
        $url=$url.$end_point;

        $response=$this->ts5->curl($method,$url,$token_api,$json);
        $data_response["id"]=$process_id;
        $data_response["app_apps_end_point_id"]=$end_point_id;
        $data_response["process_item_id"]=$document_id;
        $data_response["response"]=$response;
        $data_response["author"]=$this->user_id;
        $mApiResponses->insert($data_response);

        return($response);
    }
    
    /**
     * Reportar una nota de ajuste a nomina
     * @param type $data_company
     * @param type $data_note
     * @return type
     */ 
    public function report_note($data_company,$data_note) {
        $end_point_id=29;//end point para reportar un documento de nomina electronica
        $document_id=$data_note["id"];
        $process_id=$this->ts5->getUniqueId("",true);
        $mApiResponses=model('App\Modules\TS5\Models\AppAppsResponsesClient');
        $mApiEndPoints=model('App\Modules\TS5\Models\AppAppsEndPoints');
        $mParameters=model('App\Modules\Payroll\Models\Parameters');
        $mIndividualDocument=model('App\Modules\Payroll\Models\ViewIndividualDocuments');
        $data_document=$mIndividualDocument->get_Data($data_note["payroll_individual_document_id"]);
        $mApi=model('App\Modules\TS5\Models\AppApps');
        $api_id=$this->api_id;
        $token_api=$data_company["token_api_soenac"];
        $environment=$mParameters->get_Environment();
        $json=$this->get_json_payroll_note($data_company,$mParameters,$data_document,$data_note);
        //exit($json);
        $url=$mApi->get_Url($api_id);
        $data_endpoint=$mApiEndPoints->get_EndPoint($end_point_id);
        $end_point=$data_endpoint["name"];
        
        if($environment==2){//Si está en ambiente de pruebas
            $testSetId=$mParameters->get_TestSetld();
            $end_point=$data_endpoint["name"]."/".$testSetId;
        }
        
        
        $method=$data_endpoint["method"];
        $url=$url.$end_point;

        $response=$this->ts5->curl($method,$url,$token_api,$json);
        $data_response["id"]=$process_id;
        $data_response["app_apps_end_point_id"]=$end_point_id;
        $data_response["process_item_id"]=$document_id;
        $data_response["response"]=$response;
        $data_response["author"]=$this->user_id;
        $mApiResponses->insert($data_response);

        return($response);
    }
    
    /**
     * Limpia una cadena de caracteres extraños
     * @param type $string
     * @return type
     */
    public function string_clean($string) {
        $string = htmlentities($string);
        $string = preg_replace('/\&(.)[^;]*;/', '', $string);
        $string = str_replace('\n', ' ', $string);
        $string = str_replace(',', ' ', $string);
        $string = trim(preg_replace('/[\r\n|\n|\r]+/', ' ', $string));
        return $string;
    }
    /**
     * Devuelve el json de los devengados
     * @param type $data_document
     * @return type
     */
    public function json_earns($data_document) {
        $mEarns=model('App\Modules\Payroll\Models\DocumentsEarns');
        $data_query=$mEarns->get_DocumentEarns($data_document["payroll_documents_id"],$data_document["payroll_employee_id"]);
        $key_id="payroll_type_earn_id";
        $json=',
                "earn": {';
        
        foreach ($data_query as $key => $data) {
            /**
             * Basico
             */
            if($data[$key_id]=='1'){ // basico
                $json.=' "basic":{
                            "worked_days":'.$data["quantity"].',
                            "worker_salary":'.round($data["payment"]).'
                          }';
            }
            /**
             * Auxilios de transporte y viaticos
             */
            if($data[$key_id]=='2'){ // auxilio de transporte
                $json.=',
                    "transports": 
                            [{
                                "transportation_assistance":'.round($data["payment"]).'
                            }]
                            ';
            }
            
            if($data[$key_id]=='3'){ //Viaticos salariales
                $json.=',
                    "transports": 
                        [{
                            "viatic":'.round($data["payment"]).'
                        }]';
            }
            if($data[$key_id]=='4'){ //Viaticos salariales
                $json.=',
                    "transports": 
                        [{
                            "non_salary_viatic":'.round($data["payment"]).'
                        }]';
            }
            
            /**
             * Horas Extras
             */
            if($data[$key_id]=='5'){ // horas extras
                if($data["type_time_id"]==1){ //Horas Extras Diarias
                    $json.=',
                        "daily_overtime":[{
                            "quantity":'.$data["quantity"].',
                            "payment":'.$data["payment"].'    
                        }]
                    ';
                }
                if($data["type_time_id"]==2){ //Horas Extras Nocturnas
                    $json.=',
                        "overtime_night_hours":[{
                            "quantity":'.$data["quantity"].',
                            "payment":'.$data["payment"].'    
                        }]
                    ';
                }
                if($data["type_time_id"]==3){ //Horas Recargo Nocturno
                    $json.=',
                        "hours_night_surcharge":[{
                            "quantity":'.$data["quantity"].',
                            "payment":'.$data["payment"].'    
                        }]
                    ';
                }
                if($data["type_time_id"]==4){ //Horas Extras Diarias Dominicales y Festivas
                    $json.=',
                        "sunday_and_holiday_daily_overtime":[{
                            "quantity":'.$data["quantity"].',
                            "payment":'.$data["payment"].'    
                        }]
                    ';
                }
                if($data["type_time_id"]==5){ //Horas Recargo Diarias Dominicales y Festivas
                    $json.=',
                        "daily_surcharge_hours_on_sundays_and_holidays":[{
                            "quantity":'.$data["quantity"].',
                            "payment":'.$data["payment"].'    
                        }]
                    ';
                }
                if($data["type_time_id"]==6){ //Horas Extras Nocturnas Dominicales y Festivas
                    $json.=',
                        "sunday_night_overtime_and_holidays":[{
                            "quantity":'.$data["quantity"].',
                            "payment":'.$data["payment"].'    
                        }]
                    ';
                }
                if($data["type_time_id"]==7){ //Horas Recargo Nocturno Dominicales y Festivas
                    $json.=',
                        "sunday_and_holidays_night_surcharge_hours":[{
                            "quantity":'.$data["quantity"].',
                            "payment":'.$data["payment"].'    
                        }]
                    ';
                }
                                
            }
            
            if($data[$key_id]=='12'){ // vacaciones comunes
                
                $json.=',
                        "vacation":{
                            "common":[{
                                "quantity":'.$data["quantity"].',
                                "payment":'.$data["payment"].'    
                            }]
                            
                        }
                    ';
                
            }
            
            if($data[$key_id]=='13'){ // vacaciones compensadas
                
                $json.=',
                        "vacation":{
                            "compensated":[{
                                "quantity":'.$data["quantity"].',
                                "payment":'.$data["payment"].'    
                            }]
                            
                        }
                    ';
                
            }
            
            if($data[$key_id]=='14'){ // primas salariales
                
                $json.=',
                        "primas":{
                                "quantity":'.$data["quantity"].',
                                "payment":'.$data["payment"].'    
                            }
                    ';
                
            }
            
            if($data[$key_id]=='15'){ // primas no salariales
                
                $json.=',
                        "primas":{
                                "quantity":'.$data["quantity"].',
                                "payment":0,
                                "non_salary_payment":'.$data["payment"].'     
                            }
                    ';
                
            }
           
            if($data[$key_id]=='16'){ // cesantias
                
                $json.=',
                        "layoffs":{
                                "percentage":'.$data["percentage"].',
                                "payment":'.$data["layoffs_payment"].',
                                "interest_payment":'.$data["interest_payment"].'     
                            }
                    ';
                
            }
            
            
            if($data[$key_id]=='17'){ // incapacidades
                
                $json.=',
                        "incapacities":[{
                                "type_incapacity_id":'.$data["type_incapacity_id"].',
                                "payment":'.$data["payment"].',
                                "quantity":'.$data["quantity"].'     
                            }]
                    ';
                
            }
            
            
            if($data[$key_id]=='18'){ // Licencia de Maternidad o Paternidad
                
                $json.=',
                        "licensings":{
                            "maternity_or_paternity_leaves":[{
                                "quantity":'.$data["quantity"].',
                                "payment":'.$data["payment"].'
                                
                            }]
                        }        
                    ';
                
            }
            
            if($data[$key_id]=='19'){ // Licencia remunerada
                
                $json.=',
                        "licensings":{
                            "permit_or_paid_licenses":[{
                                "quantity":'.$data["quantity"].',
                                "payment":'.$data["payment"].'
                                
                            }]
                        }        
                    ';
                
            }
            
            if($data[$key_id]=='20'){ // Licencia no remunerada
                
                $json.=',
                        "licensings":{
                            "suspension_or_unpaid_leaves":[{
                                "quantity":'.$data["quantity"].'
                                
                                
                            }]
                        }        
                    ';
                
            }
            
            if($data[$key_id]=='21'){ // bonificaciones salariales
                $json.=',
                        "bonuses":[{                                
                                "payment":'.$data["payment"].'     
                            }]
                    ';
            }
            
            if($data[$key_id]=='22'){ // bonificaciones no salariales
                $json.=',
                        "bonuses":[{                                
                                "non_salary_payment":'.$data["payment"].'     
                            }]
                    ';
            }
            
            if($data[$key_id]=='23'){ // bonificaciones salariales
                $json.=',
                        "assistances":[{                                
                                "payment":'.$data["payment"].'     
                            }]
                    ';
            }
            
            if($data[$key_id]=='24'){ // bonificaciones no salariales
                $json.=',
                        "assistances":[{                                
                                "non_salary_payment":'.$data["payment"].'     
                            }]
                    ';
            }
            
            if($data[$key_id]=='25'){ // huelgas legales
                $json.=',
                        "legal_strikes":[{                                
                                "quantity":'.$data["quantity"].'     
                            }]
                    ';
            }
           
            if($data[$key_id]=='26'){ // otros conceptos legales
                $description=$this->string_clean($data["description"]);
                $json.=',
                        "other_concepts":[{                                
                                "description":"'.$description.'",
                                "payment":'.$data["payment"].'   
                            }]
                    ';
            }
            
            if($data[$key_id]=='27'){ // otros conceptos no salariales
                $description=$this->string_clean($data["description"]);
                $json.=',
                        "other_concepts":[{                                
                                "description":"'.$description.'",
                                "non_salary_payment":'.$data["payment"].'   
                            }]
                    ';
            }
            
            if($data[$key_id]=='28'){ // compensatorios ordinarios
                $json.=',
                        "compensations":[{                                
                                "ordinary":'.$data["payment"].'
                                 
                            }]
                    ';
            }
            if($data[$key_id]=='29'){ // compensatorios extra ordinarios
                $json.=',
                        "compensations":[{                                
                                "extraordinary":'.$data["payment"].'
                                 
                            }]
                    ';
            }
            
            if($data[$key_id]=='30'){ // bonos salariales
                $json.=',
                        "vouchers":[{                                
                                "payment":'.$data["payment"].'
                                 
                            }]
                    ';
            }
            if($data[$key_id]=='31'){ // bonos no salarial
                $json.=',
                        "vouchers":[{                                
                                "non_salary_payment":'.$data["payment"].'
                                 
                            }]
                    ';
            }
            if($data[$key_id]=='32'){ // alimentacion salarial
                $json.=',
                        "vouchers":[{                                
                                "salary_food_Payment":'.$data["payment"].'
                                 
                            }]
                    ';
            }
            if($data[$key_id]=='33'){ // alimentacion no salarial
                $json.=',
                        "vouchers":[{                                
                                "non_salary_food_payment":'.$data["payment"].'
                                 
                            }]
                    ';
            }
            
            
            if($data[$key_id]=='34'){ // comisiones
                $json.=',
                        "commissions":[{                                
                                "payment":'.$data["payment"].'
                                 
                            }]
                    ';
            }
            
            
            if($data[$key_id]=='35'){ // pagos a terceros
                $json.=',
                        "third_party_payments":[{                                
                                "payment":'.$data["payment"].'
                                 
                            }]
                    ';
            }
            
            
            if($data[$key_id]=='36'){ //anticipos
                $json.=',
                        "advances":[{                                
                                "payment":'.$data["payment"].'
                                 
                            }]
                    ';
            }
            
                        
            if($data[$key_id]=='37'){ // dotacion
                $json.=',
                        "endowment":'.$data["payment"].'
                    ';
            }
            
            if($data[$key_id]=='38'){ //apoyo a sostenimiento
                $json.=',
                        "sustainment_support":'.$data["payment"].'
                    ';
            }
            
            if($data[$key_id]=='39'){ //teletrabajo
                $json.=',
                        "telecommuting":'.$data["payment"].'
                    ';
            }
           
            if($data[$key_id]=='40'){//Bonificacion Retiro 
                $json.=',
                        "company_withdrawal_bonus":'.$data["payment"].'
                    ';
            }
            
            if($data[$key_id]=='41'){ //Indemnizacion
                $json.=',
                        "compensation":'.$data["payment"].'
                    ';
            }
           
            if($data[$key_id]=='42'){ //reintegro
                $json.=',
                        "refund":'.$data["payment"].'
                    ';
            }
                       
            
        }
                
        $json.='}';
        return($json);
    }
    
    /**
     * json ambiente (1 produccion, 2 Pruebas)
     * @param type $environment
     * @param type $data_software_id
     * @return type
     */
    public function json_environment($environment,$data_software_id) {
        $json=',
                "environment":{
                       "type_environment_id":'.$environment.',
                       "id":"'.$data_software_id["value"].'",
                       "pin":'.$data_software_id["key"].'

                }';
        return($json);
    }
    
    /**
     * json con la informacion general del documento
     * @param type $data_document
     * @return type
     */
    public function json_general_information($data_document) {
        $json=',
                "general_information": {
                  "payroll_period_id": '.$data_document["payroll_period_id"].'
                }';
        return($json);
    }
    /**
     * Json con la informacion del empleador
     * @param type $data_company
     * @return type
     */
    public function json_employer($data_company) {
        $json=',
                "employer": {
                  "identification_number": '.$data_company["identification"].',
                  "municipality_id": '.$data_company["municipality_id"].',
                  "address": "'.$data_company["address"].'"
                }';
        return($json);
    }
    
    /**
     * Informacion del empleado
     * @param type $data_document
     * @return type
     */
    public function json_employee($data_document) {
        $json=',
                "employee": {
                  "type_worker_id": '.$data_document["type_worker_id"].',
                  "subtype_worker_id": '.$data_document["subtype_worker_id"].',
                  "high_risk_pension": '.$data_document["high_risk_pension"].',
                  "type_document_identification_id": '.$data_document["type_document_identification_id"].',
                  "identification_number": '.$data_document["identification"].',
                  "surname": "'.$data_document["surname"].'",
                  "second_surname": "'.$data_document["second_surname"].'",
                  "first_name": "'.$data_document["firts_name"].'",
                  "municipality_id": '.$data_document["municipalities_id"].',
                  "address": "'.$data_document["address"].'",
                  "integral_salary": '.$data_document["integral_salary"].',
                  "type_contract_id": '.$data_document["type_contract_id"].',
                  "salary": '.$data_document["salary"].'
                }';
        return($json);
    }
    /**
     * Informacion del periodo de la nomina a reportar
     * @param type $data_document
     * @return type
     */
    public function json_period($data_document) {
        $json=',
                "period": {
                  "admission_date": "'.$data_document["start_date"].'",
                  "settlement_start_date": "'.$data_document["settlement_start_date"].'",
                  "settlement_end_date": "'.$data_document["settlement_end_date"].'",
                  "amount_time": '.$data_document["amount_time"].',
                  "date_issue": "'.$data_document["date_issue"].'"
                }';
        return($json);
    }
    /**
     * Informacion del pago 
     * @param type $data_document
     * @return type
     */
    public function json_payment($data_document) {
        $json=',
                "payment": {
                  "payment_form_id": '.$data_document["payment_form"].',
                  "payment_method_id": '.$data_document["payment_method_id"].'
                }';
        return($json);
    }
    /**
     * json con la Fecha de pago
     * @param type $data_document
     * @return type
     */
    public function json_payment_dates($data_document) {
        $json=',
                "payment_dates": [
                  {
                    "date": "'.$data_document["payment_dates"].'"
                  }
                ]';
        return($json);
    }
    
    public function json_deductions($data_document) {
        $mEarns=model('App\Modules\Payroll\Models\DocumentsDeductions');
        $data_query=$mEarns->get_DocumentDeductions($data_document["payroll_documents_id"],$data_document["payroll_employee_id"]);
        if(!is_array($data_query)){
            return;
        }
        $key_id="payroll_type_deduction_id";
        $json=',
                "deduction":{';
        $first=1;
        foreach ($data_query as $key => $data) {
            if($data[$key_id]=='1'){ //salud
                if($first==1){
                    $first=0;                    
                }else{
                    $json.=',';
                }
                $json.='
                        "health":{
                            "percentage":'.$data["percentage"].',
                            "payment":'.round($data["payment"]).'    
                        }
                    ';
            }
            
            if($data[$key_id]=='2'){ //fondo de pension
                if($first==1){
                    $first=0;                    
                }else{
                    $json.=',';
                }
                $json.='
                        "pension_fund":{
                            "percentage":'.$data["percentage"].',
                            "payment":'.round($data["payment"]).'    
                        }
                    ';
            }
            
            if($data[$key_id]=='3'){ //fondo de seguridad pensional
                if($first==1){
                    $first=0;                    
                }else{
                    $json.=',';
                }
                $json.='
                        "pension_security_fund":{
                            "percentage":'.$data["percentage"].',
                            "payment":'.round($data["payment"]).',
                            "percentage_subsistence":0,
                            "payment_subsistence":0    
                        }
                    ';
            }
            
            
            if($data[$key_id]=='19'){ //fondo de subsistencia
                if($first==1){
                    $first=0;                    
                }else{
                    $json.=',';
                }
                $json.='
                        "subsistence_security_fund":{
                            "percentage":0,
                            "payment":0,
                            "percentage_subsistence":'.$data["percentage"].',
                            "payment_subsistence":'.round($data["payment"]).'    
                        }
                    ';
            }
            
            if($data[$key_id]=='4'){ //sindicatos
                if($first==1){
                    $first=0;                    
                }else{
                    $json.=',';
                }
                $json.='
                        "trade_unions":[{
                            "percentage":'.$data["percentage"].',
                            "payment":'.round($data["payment"]).'
                        }]
                    ';
            }
            if($data[$key_id]=='5'){ //sanciones publicas
                if($first==1){
                    $first=0;                    
                }else{
                    $json.=',';
                }
                $json.='
                        "sanctions":[{
                            "payment_public":'.round($data["payment"]).',
                            "payment_private":0
                        }]
                    ';
            }
            if($data[$key_id]=='20'){ //sanciones privadas
                if($first==1){
                    $first=0;                    
                }else{
                    $json.=',';
                }
                $json.='
                        "sanctions":[{
                            "payment_private":'.round($data["payment"]).',
                            "payment_public":0
                        }]
                    ';
            }
            
            if($data[$key_id]=='6'){ //libranzas
                if($first==1){
                    $first=0;                    
                }else{
                    $json.=',';
                }
                $json.='
                        "libranzas":[{
                            "description":"'.$data["description"].'",
                            "payment":'.round($data["payment"]).'
                        }]
                    ';
            }
            
            if($data[$key_id]=='7'){ //pagos a terceros
                if($first==1){
                    $first=0;                    
                }else{
                    $json.=',';
                }
                $json.='
                        "third_party_payments":[{
                            "payment":'.round($data["payment"]).'
                        }]
                    ';
            }
            
            if($data[$key_id]=='8'){ //anticipos
                if($first==1){
                    $first=0;                    
                }else{
                    $json.=',';
                }
                $json.='
                        "advances":[{
                            "payment":'.round($data["payment"]).'
                        }]
                    ';
            }
            
            if($data[$key_id]=='9'){ //otras deducciones
                if($first==1){
                    $first=0;                    
                }else{
                    $json.=',';
                }
                $json.='
                        "other_deductions":[{
                            "payment":'.round($data["payment"]).'
                        }]
                    ';
            }
            
            if($data[$key_id]=='10'){ //pension voluntaria
                if($first==1){
                    $first=0;                    
                }else{
                    $json.=',';
                }
                $json.='
                         "voluntary_pension":'.round($data["payment"]).'
                    ';
            }
            if($data[$key_id]=='11'){ //retencion en la fuente
                if($first==1){
                    $first=0;                    
                }else{
                    $json.=',';
                }
                $json.='
                         "withholding_source":'.round($data["payment"]).'
                    ';
            }
            if($data[$key_id]=='12'){ //ahorro de fomento a la construccion
                if($first==1){
                    $first=0;                    
                }else{
                    $json.=',';
                }
                $json.='
                         "afc":'.round($data["payment"]).'
                    ';
            }
            if($data[$key_id]=='13'){ //cooperativas
                if($first==1){
                    $first=0;                    
                }else{
                    $json.=',';
                }
                $json.='
                         "cooperative":'.round($data["payment"]).'
                    ';
            }
            
            if($data[$key_id]=='14'){ //embargo fiscal
                if($first==1){
                    $first=0;                    
                }else{
                    $json.=',';
                }
                $json.='
                         "tax_lien":'.round($data["payment"]).'
                    ';
            }
            if($data[$key_id]=='15'){ //planes complementarios
                if($first==1){
                    $first=0;                    
                }else{
                    $json.=',';
                }
                $json.='
                         "complementary_plans":'.round($data["payment"]).'
                    ';
            }
            if($data[$key_id]=='16'){ //educacion
                if($first==1){
                    $first=0;                    
                }else{
                    $json.=',';
                }
                $json.='
                         "education":'.round($data["payment"]).'
                    ';
            }
            if($data[$key_id]=='17'){ //reintegro
                if($first==1){
                    $first=0;                    
                }else{
                    $json.=',';
                }
                $json.='
                         "refund":'.round($data["payment"]).'
                    ';
            }
            if($data[$key_id]=='18'){ //deuda
                if($first==1){
                    $first=0;                    
                }else{
                    $json.=',';
                }
                $json.='
                         "debt":'.round($data["payment"]).'
                    ';
            }
            
            
        }
        $json.=' 
                }';
        return($json);
    }
    /**
     * json para los totales del documento
     * @param type $data_document
     * @return type
     */
    public function json_totals_document($data_document) {
        $json=',
                "accrued_total":'.round($data_document["accrued_total"]).',
                "deductions_total":'.round($data_document["deductions_total"]).',
                "total": '.round($data_document["total"]).'';
        return($json);
    }
    
    public function json_xml_sequence_number($data_document) {
        $json=' ,
                "xml_sequence_number": {
                  "prefix": "'.$data_document["prefix"].'",
                  "number": '.$data_document["consecutive"].'
                }';
        return($json);
    }
    
    /**
     * Devuelve el json de una nomina electronica
     * @param type $data_company
     * @param type $mParameters
     * @param type $data_document
     * @return type
     */
    public function get_json_payroll_support($data_company,$mParameters,$data_document) {
        $method=$mParameters->get_Method();        
        $environment=$mParameters->get_Environment();
        $data_software_id=$mParameters->get_Data(5);
        
        $json='{
                "sync":'.$method.'
                ';
        $json.=$this->json_xml_sequence_number($data_document);
        $json.=$this->json_environment($environment, $data_software_id); 
        $json.=$this->json_general_information($data_document);
        $json.=$this->json_employer($data_company);
        $json.=$this->json_employee($data_document);
        $json.=$this->json_period($data_document);
        $json.=$this->json_payment($data_document);
        $json.=$this->json_payment_dates($data_document);        
        $json.=$this->json_earns($data_document);
        $json.=$this->json_deductions($data_document);
        $json.=$this->json_totals_document($data_document);
        $json.='
              }';
        return($json);
    }
    
    public function payroll_reference($data_document) {
        $json=',
                "payroll_reference": {
                "number": "'.$data_document["prefix"].$data_document["consecutive"].'",
                "uuid": "'.$data_document["uuid"].'",
                "issue_date": "'.$data_document["date_issue"].'"
              }';
        return($json);
    }
    
    /**
     * Devuelve el json de una nota de una nomina electronica
     * @param type $data_company
     * @param type $mParameters
     * @param type $data_document
     * @return type
     */
    public function get_json_payroll_note($data_company,$mParameters,$data_document,$data_note) {
        $method=$mParameters->get_Method();        
        $environment=$mParameters->get_Environment();
        $data_software_id=$mParameters->get_Data(5);
        
        $json='{
                "type_payroll_note_id":2
                ';
        $json.=',                
                "sync":'.$method.'
                ';
        $json.=$this->json_xml_sequence_number($data_note);
        $json.=$this->json_environment($environment, $data_software_id); 
        $json.=$this->payroll_reference($data_document);       
        $json.=$this->json_general_information($data_document);     
        $json.=$this->json_employer($data_company);
        
        $json.='
              }';
        return($json);
    }
    
    /**
     * revisar el estado de un documento electronico
     * @param type $data_company
     * @param type $zip_key
     * @return type
     */
    public function status_document_zip_key($data_company,$zip_key) {
        $end_point_id=30;//end point para consultar el status de un documento electrónico
        
        $process_id=$this->ts5->getUniqueId("",true);
        $mApiResponses=model('App\Modules\TS5\Models\AppAppsResponsesClient');
        $mApiEndPoints=model('App\Modules\TS5\Models\AppAppsEndPoints');
        $mParameters=model('App\Modules\Payroll\Models\Parameters');
        
        $mApi=model('App\Modules\TS5\Models\AppApps');
        $api_id=$this->api_id;
        $token_api=$data_company["token_api_soenac"];
        $environment=$mParameters->get_Environment();
        $json='{
                "environment": {
                  "type_environment_id": '.$environment.'
                }
              }';

        $url=$mApi->get_Url($api_id);
        $data_endpoint=$mApiEndPoints->get_EndPoint($end_point_id);
        
        $end_point=str_replace("{zip_key}",$zip_key,$data_endpoint["name"]);
        
        $method=$data_endpoint["method"];
        $url=$url.$end_point;

        $response=$this->ts5->curl($method,$url,$token_api,$json);
        $data_response["id"]=$process_id;
        $data_response["app_apps_end_point_id"]=$end_point_id;
        $data_response["process_item_id"]=$zip_key;
        $data_response["response"]=$response;
        $data_response["author"]=$this->user_id;
        $mApiResponses->insert($data_response);

        return($response);
    }
    
    /**
     * Crea una nota de ajuste para una nomina
     * @param type $payroll_individual_document_id
     * @param type $description
     */
    public function note_create($payroll_individual_document_id,$description) {
        $m_individual_payroll=model('App\Modules\Payroll\Models\IndividualDocuments');
        $m_notes=model('App\Modules\Payroll\Models\Notes');   
        $m_parameters=model('App\Modules\Payroll\Models\Parameters');
        
        $prefix=$m_parameters->get_PrefixNotes();
        if($m_notes->is_Created($payroll_individual_document_id)){
           return("E1"); 
        }
        $id=$this->ts5->getUniqueId("", true);
        
        $data["id"]=$id;
        $data["payroll_individual_document_id"]=$payroll_individual_document_id;  
        $data["description"]=$description;
        $data["prefix"]=$prefix;        
        $data["status"]=1;
        $data["author"]=$this->user_id;
        $m_notes->insert($data);
        
        $m_individual_payroll->set('status',10);
        $m_individual_payroll->where('id',$payroll_individual_document_id);
        $m_individual_payroll->update();
        
        return($id);
        
    }
    
    
    
}//Fin clase

