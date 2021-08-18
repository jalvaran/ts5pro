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
 *
 * -----------------------------------------------------------------------------
 *
 * Ésta página se encarga de construir la interfaz de usuario del módulo del login
 *
 * -----------------------------------------------------------------------------
 * @Author Julian Andres Alvaran Valencia <jalvaran@gmail.com>
 * @link https://www.technosoluciones.com.co
 * @Version 1.0
 * @since PHP 7, PHP 8
 */
use \App\Modules\TS5\Libraries\Ts5;
/*
 * $request=service('request');
$login=$request->getVar("login");
$pass=$request->getVar("pass");
 */

$ts5=new TS5();
$smarty = service("smarty");

$data_tempate=$ts5->getDataTemplate();

$smarty->assign("lang",$data_tempate["lang"]);
$smarty->assign("favicon",$data_tempate["favicon"]);
$smarty->assign("company_logo",$data_tempate["company_logo"]);
$smarty->assign("page_title",$data_tempate["page_title"]);
$smarty->assign("menu_title",$data_tempate["menu_title"]);
$smarty->assign("menu_logo",$data_tempate["menu_logo"]);
$smarty->assign("page_content","");
$smarty->assign("html_errors",0);
echo($smarty->view('blank.tpl'));
/*
switch ($view) {
    case 'home':echo(view($namespace.'\Views\Home\index'));break;
    case 'signin':echo(view($namespace.'\Views\Signin\index'));break;
    case 'signout':$html=view($namespace.'\Views\Signout\index');break;
    default:$html=view($namespace.'\Views\E404\index');break;
}
*/
