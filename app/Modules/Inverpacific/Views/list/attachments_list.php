<div class="row mt-3">
    <h4><?=lang('creditmoto.title_form_attachments')?></h4>
        <?php 
            foreach ($necessary_attachments as $key => $value) {
                
                $name_file=$value["name"];
                $icon='fa fa-circle text-danger';
                $bar_width=0;
                if($value["attachment_id"]<>''){
                    $icon='fa fa-check text-success';
                    $bar_width=100;
                    $name_file='<a href="'. base_url('inverpacific/attachment_view/'.$value["attachment_id"]).'" target="_blank">'.$value["name"].'</a>';
                }
                $size=0;
                if($value["attachment_size"]<>''){
                    $size=number_format($value["attachment_size"]/1000000,2);
                }
                print('<div class="col-lg-4">
                            <div class="card shadow-none border radius-15">
                                    <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                    <button id="btn_upload_'.$value["id"].'" data-id="'.$value["id"].'" data-business_sheet_id="'.$data_sheet["id"].'" class="fm-icon-box radius-15 bg-primary text-white ts_btn_upload"><i class="fa fa-upload"></i>
                                                    </button>
                                                    <div class="ms-auto font-24"><i class="'.$icon.'"></i>
                                                    </div>
                                            </div>
                                            <h5 class="mt-3 mb-0">'.$name_file.'</h5>
                                            <p class="mb-1 mt-4"><span>'.$size.' Mb</span>
                                            </p>
                                            <div class="progress" style="height: 7px;">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: '.$bar_width.'%;" aria-valuenow="'.$bar_width.'" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                    </div>
                            </div>
                            
                    </div>');
            }
        ?>
        
        
</div>