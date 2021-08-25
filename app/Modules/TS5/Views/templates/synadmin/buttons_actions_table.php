<div class="btn-group " role="group" >
    <?php
        if(isset($buttons)){
            foreach ($buttons as $button){
                print('<a href="'.$button["link"].'" type="button" class="btn btn-outline-'.$button["color"].' btn-sm"><i class="'.$button["icon"].'"></i></a>');
            }
        }

    ?>

</div>