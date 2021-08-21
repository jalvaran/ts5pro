<?php

$html="";
$data_error["error_title"] = lang('Access.access_view_error_title');
$data_error["msg_error"] = lang('Access.access_view_error');
$html.= (view($views_path . '\alert_error', $data_error));
echo($html);