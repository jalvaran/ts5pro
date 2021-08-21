<?php

$html="";
$data_error["error_title"] = lang('Menu.error_title_no_company');
$data_error["msg_error"] = lang('Menu.error_text_no_company');
$html.= (view($views_path . '\alert_error', $data_error));
echo($html);