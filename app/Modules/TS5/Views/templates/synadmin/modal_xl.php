<div class="row">
    <div class="col">
        <div class="modal fade " id="modal_xl"  aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo $modal_title ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                    </div>
                    <div class="modal-body">
                       <div id="modal_xl_body" class="row ts_modal_body">
                           <?php
                               if(isset($modal_body)){
                                   echo $modal_body;
                               }
                           ?>
                       </div>
                    </div>
                    <div class="modal-footer">
                        <button  data-form_id="0" type="button" class="btn btn-secondary ts_btn_cancel_modals " data-bs-dismiss="modal"><?php echo lang('Ts5.modal_btn_close') ?></button>
                        <button  data-form_id="0" type="button" class="btn btn-primary ts_btn_save_modals "><?php echo lang('Ts5.modal_btn_save') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

