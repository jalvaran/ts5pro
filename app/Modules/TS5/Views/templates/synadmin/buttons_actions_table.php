<div class="btn-group " role="group" >
    <?php
        if(isset($buttons)){
            foreach ($buttons as $button){
                print('<button data-item_id="'.$button["id"].'"  type="button" class="btn btn-outline-'.$button["color"].' btn-sm '.$button["class"].'"><i class="'.$button["icon"].'"></i></button>');
            }
        }

    ?>

</div>