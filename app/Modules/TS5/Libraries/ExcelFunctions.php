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
 * Funciones de excel para php
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvaran Valencia <jalvaran@gmail.com>
 * @created 2021-10-07
 * @updated 2021-10-07
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */

namespace App\Modules\TS5\Libraries;

class ExcelFunctions{

    
    /**
     * Convierte una matriz en un solo valor escalar extrayendo el primer elemento.
     *
     * @param mixed $value Array or valor escalar
     *
     * @return mixed
     */
    public function flattenSingleValue($value = '')
    {
        while (is_array($value)) {
            $value = array_pop($value);
        }

        return $value;
    }
    
    
    /**
     * Funcion PAGO o en ingles PMT
     * @param type $rate Tasa de interés por período
     * @param type $nper Numero de periodos
     * @param type $pv   Valor presente
     * @param type $fv   Valor futuro
     * @param type $type Tipo de pago: 0 = al final de cada período, 1 = al comienzo de cada período
     * @return type
     */
    public function PMT($rate = 0, $nper = 0, $pv = 0, $fv = 0, $type = 0)
    {
        $rate = $this->flattenSingleValue($rate);
        $nper = $this->flattenSingleValue($nper);
        $pv = $this->flattenSingleValue($pv);
        $fv = $this->flattenSingleValue($fv);
        $type = $this->flattenSingleValue($type);

        // Validate parameters
        if ($type != 0 && $type != 1) {
            return (false);
        }

        // Calculate
        if ($rate !== null && $rate != 0) {
            return (-$fv - $pv * pow(1 + $rate, $nper)) / (1 + $rate * $type) / ((pow(1 + $rate, $nper) - 1) / $rate);
        }

        return (-$pv - $fv) / $nper;
    }
    /**
     * Devuelve la tasa de interés efectiva dada la tasa nominal y el número de
     * pagos compuestos por año.
     * 
     * 
     * Excel Function:
     *        EFFECT(nominal_rate,npery)
     * 
     * @param type $nominal_rate tasa nominal
     * @param type $npery   numero de pagos por año
     * @return type
     */
    public function EFFECT($nominal_rate = 0, $npery = 0)
    {
        $nominal_rate = $this->flattenSingleValue($nominal_rate);
        $npery = (int) $this->flattenSingleValue($npery);

        // Validate parameters
        if ($nominal_rate <= 0 || $npery < 1) {
            return (false);
        }

        return pow((1 + $nominal_rate / $npery), $npery) - 1;
    }
    

}

