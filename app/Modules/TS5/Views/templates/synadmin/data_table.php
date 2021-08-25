<div class="col-md-<?php echo $div_cols; ?> ">
    <div class="card shadow-none border radius-15 ">
        <div class="card-header">
            <div class="row">

                <div class="col-md-6">
                    <h3><?php echo $table_title; ?></h3>
                </div>

                <div class="col-md-6 text-end  rounded">
                    <div class="dropdown">
                        <button class="btn btn-primary radius-30 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo lang('Ts5.tables_btn_actions')  ?></button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" id="<?php echo "btn_new_".$table_id;?>" style="cursor:pointer"> <?php echo lang('Ts5.tables_link_new_register')  ?></a>
                            </li>
                            <li><a class="dropdown-item " href="<?php echo ($actions_path."/export/excel");?>" target="_blank"> <?php echo lang('Ts5.tables_link_export_excel')  ?></a>
                            </li>
                            <li><a class="dropdown-item " href="<?php echo ($actions_path."/export/csv");?>" target="_blank"> <?php echo lang('Ts5.tables_link_export_csv')  ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body ">

            <div class="table-responsive">
                <table id="<?php echo $table_id; ?>" class="table table-hover">
                    <thead>
                    <tr>
                        <?php
                            foreach ($cols as $column) {
                                echo("<th>$column</th>");
                            }
                        ?>

                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
