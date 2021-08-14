<?php
/**
 * Vista Demo para ver las diferentes paginas que se pueden crear
 *
 * @package Example-application
 */

$smarty = new Smarty;
$smarty->template_dir = APPPATH . "Views/templates/ts5/templates";
$smarty->compile_dir = APPPATH . "Views/templates/ts5/templates_c";
//$smarty->force_compile = true;
$smarty->debugging = false;
$smarty->caching = true;
$smarty->cache_lifetime = 1;

switch ($page) {
    
    //Mostrar un ejemplo de la pagina llamada fercho
    case 'fercho':
        
        $data["lang"]="es";
        $data["page_title"]="TS5 PRO Template";
        $data["path"]=base_url()."/";
        $data["favicon"]=$data["path"]."companies_logos/1/favicon.png";
        $html=view('templates\synadmin\head',$data);
        $data["menu_logo"]=$data["path"]."companies_logos/1/tslogo.png";
        $data["menu_title"]=" TS5 PRO ";
        $data["siderbar"]=view('templates\synadmin\siderbar',$data);            
        $data["header"]=view('templates\synadmin\header');        
        $data["page_content"]="";
        $data["footer"]=view('templates\synadmin\footer');
        $data["switcher"]=view('templates\synadmin\switcher');
        $data["scripts"]=view('templates\synadmin\scripts');
        $html.=view('templates\synadmin\body',$data);
        
    break;//Fin caso fercho    
    
    case 'blank':
        $data["lang"]="es";
        $data["page_title"]="TS5 PRO Template";
        $data["path"]='../';
        $data["favicon"]=$data["path"]."companies_logos/1/favicon.png";
        $html=view('templates\synadmin\head',$data);
        $data["menu_logo"]=$data["path"]."companies_logos/1/tslogo.png";
        $data["menu_title"]=" TS5 PRO ";
        $data["siderbar"]=view('templates\synadmin\siderbar',$data);            
        $data["header"]=view('templates\synadmin\header');        
        $data["page_content"]="";
        $data["footer"]=view('templates\synadmin\footer');
        $data["switcher"]=view('templates\synadmin\switcher');
        $data["scripts"]=view('templates\synadmin\scripts');
        $html.=view('templates\synadmin\body',$data);
    break;

    case 'lists':
        $data["lang"]=$lang;
        $data["page_title"]=$page_titulo;
        $data["path"]=base_url()."/";
        $data["favicon"]=$favicon;
        $html=view('templates/'.$template.'/head',$data);
        $data["menu_logo"]=$menu_logo;
        $data["menu_title"]=$menu_title;
        $data["siderbar"]=view('templates/'.$template.'/siderbar',$data);            
        $data["header"]=view('templates/'.$template.'/header');        
        
        $data["footer"]=view('templates/'.$template.'/footer');
        $data["switcher"]=view('templates/'.$template.'/switcher');
        $data["scripts"]=view('templates/'.$template.'/scripts');
        $html.=view('templates/'.$template.'/body',$data);
    break;
    
    case 'index':
               
        $html=view('templates/'.$template.'/index',$data);      

    break;//Fin caso index    

    case 'content_test':
        $data["lang"]="es";
        $data["page_title"]="TS5 PRO Template";
        $data["path"]=base_url()."/";
        $data["favicon"]=$data["path"]."companies_logos/1/favicon.png";
        $html=view('templates\synadmin\head',$data);
        $data["menu_logo"]=$data["path"]."companies_logos/1/tslogo.png";
        $data["menu_title"]=" TS5 PRO ";
        $data["siderbar"]=view('templates\synadmin\siderbar',$data);            
        $data["header"]=view('templates\synadmin\header');
        $data["page_content"]=view('templates\synadmin\content_test');
        //$data["page_content"]="";
        $data["footer"]=view('templates\synadmin\footer');
        $data["switcher"]=view('templates\synadmin\switcher');
        $data["scripts"]=view('templates\synadmin\demo_scripts');
        $html.=view('templates\synadmin\body',$data);
    break;

    case 'table':
        
        $data["lang"]="es";
        $data["page_title"]="TS5 PRO Template";
        $data["path"]=base_url()."/";
        $data["favicon"]=$data["path"]."companies_logos/1/favicon.png";
        $html=view('templates\synadmin\head',$data);       
        
    break;    

    
}



$smarty->assign("html",$html);
$smarty->display('index.tpl');
