<?php

if (! function_exists('action_links'))
{
	function action_links(string $value, array $row,$key): string
	{
        $html=' <span id="table_id_'.$value.'" class="btn btn-outline-dark btn-sm ts_button_table_id" title="'.lang('msg.title_table_id').'">'.$value.'</span> || ';


        $data["buttons"]["view"]["id"]=$value;
        $data["buttons"]["view"]["class"]="ts_button_view";
        $data["buttons"]["view"]["color"]="success";
        $data["buttons"]["view"]["title"]=lang('Ts5.config');
        $data["buttons"]["view"]["icon"]="fa fa-cogs";
        $data["buttons"]["view"]["link"]=base_url('/access/companies/view/'.$value);

        $data["buttons"]["edit"]["id"]=$value;
        $data["buttons"]["edit"]["class"]="ts_button_edit";
        $data["buttons"]["edit"]["color"]="primary";
        $data["buttons"]["edit"]["title"]=lang('Ts5.edit');
        $data["buttons"]["edit"]["icon"]="fa fa-edit";
        $data["buttons"]["edit"]["link"]=base_url('/access/companies/edit/'.$value);
        /*
        $data["buttons"]["delete"]["id"]=$value;
        $data["buttons"]["delete"]["class"]="ts_button_delete";
        $data["buttons"]["delete"]["color"]="danger";
        $data["buttons"]["delete"]["title"]=lang('Ts5.edit');
        $data["buttons"]["delete"]["icon"]="fa fa-trash-alt";
        $data["buttons"]["delete"]["link"]=base_url('/access/companies/delete/'.$value);
        */
        $html.=view('App\Modules\TS5\Views\templates\synadmin\buttons_actions_table',$data);


        return($html);
	}
}