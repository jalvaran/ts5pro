<div class="<?php echo $div_class;?>">
    <label for="<?php echo $id;?>" class="form-label"><strong><?php echo $label?></strong></label>
    <div class="input-group">
        <?php
        if(isset($icon)){
            print('<span class="input-group-text bg-transparent"><i class="'.$icon.'"></i></span>');
        }
        ?>
        <select data-data_table="<?php echo $data_table;?>" data-model="<?php echo $model;?>" data-labels="<?php echo $labels;?>" class="form-select ts_input ts_input_select2" id="<?php echo $id;?>" name="<?php echo $id;?>" >
            <option value=""><?=lang('msg.option_select2') ?></option>
        </select>
    </div>
</div>
