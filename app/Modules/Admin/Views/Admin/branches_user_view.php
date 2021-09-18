<div class="row">
    <div class="col-md-12" style="text-align: center">
        <br>
        <h3><?=lang('admin.ranches_user_view_title')?></h3>
        <hr class="my-4">
    </div>
    <div class="col-lg-4">

        <div class="card shadow-lg">
            <div class="card-body ">
                <div class="d-flex flex-column align-items-center text-center">
                    <div class="mt-3">
                        <h4><?=$name?></h4>
                        <p class="text-secondary mb-1"><?=$id?></p>
                        <p class="text-muted font-size-sm"><?=$created_at?></p>
                        <p class="text-muted font-size-sm"><?=$updated_at?></p>

                    </div>
                </div>
                <hr class="my-4">

            </div>
        </div>
    </div>

    <div class="col-lg-8">

        <div class="card shadow-lg" >
            <div class="card-header">

                <div class="input-group">
                    <select id="branch_id"  class="form-select">
                        <option value=""><?=lang("admin.select_branch")?></option>
                    </select>
                    <button id="btn_add_branch" class="btn btn-success btn-sm" data-id="<?=$id?>" type="button"><li class="fa fa-plus"></li></button>
                </div>
            </div>
            <div class="card-body" style="overflow: auto;max-height: 300px;">
                <div class="row ">
                    <div id="div_branches_list" class="col" >

                    </div>
                </div>


            </div>
        </div>
    </div>

</div>