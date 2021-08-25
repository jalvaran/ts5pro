<div class="<?php echo $div_form_class;?>">
    <div class="card border-top border-0 border-4 border-danger">
        <div class="card-body p-5">
            <div class="card-title d-flex align-items-center">
                <div><i class="<?php echo $form_icon;?> me-1 font-22 text-<?php echo $form_color;?>"></i>
                </div>
                <h5 class="mb-0 text-<?php echo $form_color;?>"><?php echo $form_title;?></h5>
            </div>
            <hr>
            <form class="row g-3">
                <?php echo $form_body;?>
            </form>
        </div>
    </div>
</div>