<div class="col-md-<?= $cols?> ">
    <div class="card ">
        <div class="card-header bg-dark">
            <div class="card-title text-light">
                <span class="card-title"><strong><?= $title?></strong></span>
            </div>
        </div>
        <div class="card-body ">
            <form <?= $tags_form;?> action="/" class="dropzone dz-clickable bg-light border-dark border-3 radius-30 ts_dropzone" style="border-style: dashed;" id="<?= $id?>"><div class="dz-default dz-message"><span><h1 class="ts_dropzone"><i class="fa fa-plus-circle "></i></h1><?= $sub_title?></span></div></form>
        </div>
    </div>
</div>