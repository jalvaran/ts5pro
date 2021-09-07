<div class="table table-responsive">
    <button class="btn btn-primary ts_input_create_<?=$table_id?>" data-data_table="<?=$data_table?>"><li class="fa fa-plus"> </li></button>

    <table class="table  table-hover" id="<?= $table_id?>">
            <thead>
                <tr>

                    <?php
                        print('<th>'.lang('fields.actions').'</th>');
                        foreach ($fields as $field_table){
                            echo('<th>'.lang('fields.'.$field_table).'</th>');
                        }
                    ?>
                </tr>
            </thead>
            <tbody>

            </tbody>
         </table>


</div>