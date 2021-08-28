<div class="col-md-<?php echo $div_cols; ?> ">
    <div class="card shadow-none border radius-15 ">
        <div class="card-header">
            <div class="row">

                <div class="col-md-6">
                    <h3><?php echo $table_title; ?></h3>
                </div>

                <div class="col-md-6 text-end  rounded">

                        <button class="btn btn-primary radius-30 "  id="<?php echo "btn_new_".$table_id;?>" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo lang('Ts5.tables_link_new_register')  ?></button>


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
