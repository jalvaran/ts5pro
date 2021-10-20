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
 * Libreria para generar pdf con la libreria TCPDF
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvaran Valencia <jalvaran@gmail.com>
 * @created 2021-10-12
 * @updated 2021-10-12
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

namespace App\Modules\TS5\Libraries;

use App\Modules\TS5\Libraries\Session;
require_once(APPPATH.'ThirdParty/tcpdf/tcpdf.php' );

class Ts5_Tcpdf extends \TCPDF{

    private $session;
    private $user_id;

    public function __construct(){
        parent::__construct();
        $this->session = new Session();
        $this->user_id=$this->session->get('user');
        $this->company_id=$this->session->get('company_id');
        
    }
    /**
     * inicializa un documento pdf 
     * @param type $font
     * @param type $fontsize
     * @param type $margins
     * @param string $orientation
     * @param type $page
     * @param type $title
     * @param type $subject
     * @param type $keywords
     */
    public function pdf_init($font="helvetica",$fontsize=8,$margins=1,$orientation='P',$page='LETTER',$title="pdf",$subject="",$keywords='Techno, soluciones, ts5pro') {
        $this->SetCreator('TECHNO SOLUCIONES SAS');
        $this->SetAuthor('TECHNO SOLUCIONES SAS');
        $this->SetTitle($title);
        $this->SetSubject($subject);
        $this->SetKeywords($keywords);
        
        $this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // set default monospaced font
        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        if($margins==1){
            $this->SetMargins(10, 10, PDF_MARGIN_RIGHT);
            $this->SetHeaderMargin(PDF_MARGIN_HEADER);
            $this->SetFooterMargin(10);
        }
        
        // set auto page breaks
        $this->SetAutoPageBreak(TRUE, 10);
        // set image scale factor
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/spa.php')) {
                require_once(dirname(__FILE__).'/lang/spa.php');
                $this->setLanguageArray($l);
        }
        
        // ---------------------------------------------------------
        // set font
        //$pdf->SetFont('helvetica', 'B', 6);
        // add a page
        if($orientation<>'L' AND $orientation<>'P'){
            $orientation='P';
        }
        $this->AddPage($orientation, $page);
        $this->SetFont($font, '', $fontsize);
    }
    
    public function company_info($format_numbering) {
        $mCompany=model('App\Modules\Access\Models\Companies');
        $data_company=$mCompany->get_DataCompany($this->company_id);
        $html='<table><tr>';
        $html.='<td style="width:33%;text-align:left"><h3>'.$data_company["name"];
        $html.='<br>'.$data_company["identification"].' - '.$data_company["dv"].'</h3>';
        $html.='</td>';
        $html.='<td style="width:33%;text-align:center">';
        $html.=$data_company["address"];
        $html.='<br>'.$data_company["phone"];
        $html.='<br>'.$data_company["name_country_id"];
        $html.='<br>'.$data_company["mail"];
        $html.='</td>';
        $html.='<td style="width:33%;text-align:rigth">'.$format_numbering;
        
        $html.='</td>';
        $html.='</tr></table>';
        return($html);
        
    }
    
    /**
     * información del formato de calidad
     * @param type $format_id
     * @return type
     */
    public function quality_header($data_format,$format_numbering=''){
        
        
        $image_link="public".DIRECTORY_SEPARATOR."companies".DIRECTORY_SEPARATOR.$this->company_id.DIRECTORY_SEPARATOR."img".DIRECTORY_SEPARATOR."header-logo.png";
        if(!is_file(ROOTPATH.$image_link)){
            $company_logo="/companies/general/images/pdf.png";
        }else{
            $company_logo="/companies/".$this->company_id."/img/header-logo.png";
        }
        
        $html='
            <table cellspacing="0" cellpadding="1" border="1">
                <tr border="1">
                    <td  rowspan="3" border="1" style="text-align: center;"><img src="'.$company_logo.'" style="width:110px;height:60px;"></td>

                    <td rowspan="3" width="340px" style="text-align: center; vertical-align: center;"><h2><br>'.$data_format["name"].'<br>'.$format_numbering.' </h2></td>
                    <td width="60px" style="text-align: center;">Versión<br></td>
                    <td width="107px"> '.$data_format["version"].'</td>
                </tr>
                <tr>

                    <td style="text-align: center;" >Código<br></td>
                    <td> '.$data_format["code"].'</td>

                </tr>
                <tr>
                   <td style="text-align: center;" >Fecha<br></td>
                   <td style="font-size:6px;"> '.$data_format["date"].'</td> 
                </tr>
            </table>
            ';
        return($html);
        
    }
        
    
    
}

