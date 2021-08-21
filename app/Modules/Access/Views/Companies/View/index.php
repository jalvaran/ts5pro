<?php
$maccesso=model();
$mcompanies=model('App\Modules\Access\Models\Companies');
//has_Permission("XXXXXX");
$singular=$maccesso->has_Permission("singular");
$plural=$maccesso->has_Permission("plural");
if($singular) {
    if($plural||$singular&&$mcompanies->get_Authority($id,$userid)){
        view("App\Modules\Access\Views\Companies\View\form");
    }
}else{
    view("App\Modules\Access\Views\Companies\View\deny");
}