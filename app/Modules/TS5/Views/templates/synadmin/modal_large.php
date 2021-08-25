<div class="col">

    <div class="modal fade" id="modal_large" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo $modal_title ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <div id="modal_large_body" class="row">
                       <?php
                           if(isset($modal_body)){
                               echo $modal_body;
                           }
                       ?>
                   </div>
                    </div>
                    <div class="modal-footer">
                        <button id="modal_large_btn_close" data-form_id="0" type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo lang('Ts5.modal_btn_close') ?></button>
                        <button id="modal_large_btn_save" data-form_id="0" type="button" class="btn btn-primary"><?php echo lang('Ts5.modal_btn_save') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>