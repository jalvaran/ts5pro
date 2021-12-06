<div class="table-responsive mt-3">
    <table class="table table-striped table-hover table-sm mb-0">
        <thead>
            <tr>
                <th><?=lang('fields.document_name')?></th>
                <th><?=lang('fields.name')?></th>
                <th><?=lang('fields.size')?></th>
                <th><?=lang('fields.author')?></th>
                <th><?=lang('fields.created_at')?></th>
            </tr>
        </thead>
            <tbody>
                
                <?php
                    $image_ext=array('png','jpg','jpeg','ico','bmp');
                    $video_ext=array('mp4','wma','wmv','avi','mov','mkv');
                    foreach ($data as $key => $value) {
                        $icon='fa fa-file';
                        $color='primary';
                        $size=0;
                        $name_file='<a href="'. base_url('inverpacific/attachment_view/'.$value["id"]).'" target="_blank">'.$value["name"].'</a>';
                        if(in_array($value["extension"], $image_ext)){
                            $icon='fa fa-file-image';
                            $color='warning';
                        }
                        if(in_array($value["extension"], $video_ext)){
                            $icon='fa fa-file-video';
                            $color='warning';
                        }
                        if($value["extension"]=='pdf'){
                            $icon='fa fa-file-pdf';
                            $color='danger';
                        }
                        if($value["extension"]=='doc' or $value["extension"]=='docx'){
                            $icon='fa fa-file-word';
                            $color='primary';
                        }
                        if($value["extension"]=='xls' or $value["extension"]=='xlsx'){
                            $icon='fa fa-file-excel';
                            $color='success';
                        }
                        if($value["size"]>0 and $value["size"]<1000){
                            $size=$value["size"]." Bites";
                        }
                        if($value["size"]>=1000 and $value["size"]<1000000){
                            $size=round($value["size"]/1000,2)." KB";
                        }
                        if($value["size"]>=1000000 and $value["size"]<1000000000){
                            $size=round($value["size"]/1000000,2)." MB";
                        }
                        if($value["size"]>=1000000000){
                            $size=round($value["size"]/1000000000,2)." GB";
                        }    
                        print('<tr>');
                            print('<td>');
                                print(' <div class="d-flex align-items-center">
                                            <div><i class="'.$icon.' me-2 font-24 text-'.$color.'"></i>
                                            </div>
                                            <div class="font-weight-bold text-'.$color.'">'.$value["document_name"].'</div>
                                        </div>');
                            print('</td>');
                            print('<td>');
                                print($name_file);
                            print('</td>');
                            print('<td>');
                                print($size);
                            print('</td>');
                            print('<td>');
                                print($value["author_name"]);
                            print('</td>');
                            print('<td>');
                                print($value["created_at"]);
                            print('</td>');
                            
                        print('</tr>');
                    }
                ?>
                    
            </tbody>
    </table>
</div>