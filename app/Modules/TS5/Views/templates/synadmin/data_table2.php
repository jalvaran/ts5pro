<div class="table table-responsive">
    <table class="table table-striped table-hover" id="<?= $table_id?>">
        <thead>
            <tr>
                <th>Actions</th>
                <?php
                    foreach ($fields as $field_table){
                        echo('<th>'.$field_table.'</th>');
                    }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php if($data_model): ?>
            <?php foreach($data_model as $field): ?>
            <tr>
            <?php
                foreach($field as $key => $value){
                    if($key=='id'){
                        echo('<td><button >Prueba '.$value.'</button></td>');
                    }
                    echo('<td>'.$value.'</td>');
                }
            ?>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
     </table>
</div>