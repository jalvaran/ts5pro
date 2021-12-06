<div class="<?php echo $div_class;?>">
    <label for="<?php echo $id;?>" class="form-label"><strong><?php echo $label?></strong></label>
    <div class="input-group">
        <?php
        if(isset($icon)){
            print('<span class="input-group-text bg-transparent"><i class="'.$icon.'"></i></span>');
        }
        
        $class_input="";
        if(isset($class)){
            $class_input=$class;
        }
        $data_input_ts="";
        if(isset($data_input)){
            $data_input_ts=$data_input;
        }
        
        ?>
        <select <?=$data_input_ts?> class="form-select ts_input <?=$class_input?>" id="<?php echo $id;?>" name="<?php echo $id;?>" >
            <?php

            foreach ($options as $key => $option) {
                $selected="";
                if(isset($options[$key]["selected"])){
                    $selected="selected";
                }
                print('<option value="'.$options[$key]["value"].'" '.$selected.'>'.$options[$key]["text"].'</option>');
            }

            ?>
        </select>
    </div>
</div>
