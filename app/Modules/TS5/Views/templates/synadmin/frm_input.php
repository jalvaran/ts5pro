<div class="<?php echo $div_class;?>">
    <label for="<?php echo $id;?>" class="form-label"><strong><?php echo $label?></strong></label>
    <div class="input-group">
        <?php
        if(isset($icon)){
            print('<span class="input-group-text bg-transparent"><i class="'.$icon.'"></i></span>');
        }
        ?>
        <input type="<?php echo $type;?>" class="form-control ts_input" id="<?php echo $id;?>" placeholder="<?php echo $placeholder;?>">
    </div>
</div>
