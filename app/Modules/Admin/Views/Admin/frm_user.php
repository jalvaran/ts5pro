<div class="row">
    <div class="col">
        <div class="card border-top border-0 border-4 border-danger">
            <div class="card-body p-5">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bxs-user me-1 font-22 text-danger"></i>
                    </div>
                    <h5 class="mb-0 text-danger"><?=lang('msg.create_user')?></h5>
                </div>
                <hr>
                <div class="row g-3">

                    <div class="col-6">
                        <label for="name" class="form-label"><?=lang('fields.name')?></label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-user "></i></span>
                            <input value="<?= (isset($data_form["name"])) ? $data_form["name"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="name" name="name" placeholder="<?=lang('fields.name')?>">
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="identification" class="form-label"><?=lang('fields.identification')?></label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-id-badge "></i></span>
                            <input value="<?= (isset($data_form["identification"])) ? $data_form["identification"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="identification" name="identification" placeholder="<?=lang('fields.identification')?>">
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="telephone" class="form-label"><?=lang('fields.telephone')?></label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-microphone"></i></span>
                            <input value="<?= (isset($data_form["telephone"])) ? $data_form["telephone"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="telephone" name="telephone" placeholder="<?=lang('fields.telephone')?>">
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="email" class="form-label"><?=lang('fields.email')?></label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-envelope "></i></span>
                            <input value="<?= (isset($data_form["email"])) ? $data_form["email"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="email" name="email" placeholder="<?=lang('fields.email')?>">
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="designation" class="form-label"><?=lang('fields.designation')?></label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-user-circle"></i></span>
                            <input value="<?= (isset($data_form["designation"])) ? $data_form["designation"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="designation" name="designation" placeholder="<?=lang('fields.designation')?>">
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="username" class="form-label"><?=lang('fields.username')?></label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-user "></i></span>
                            <input value="<?= (isset($data_form["username"])) ? $data_form["username"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="username" name="username" placeholder="<?=lang('fields.username')?>">
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="password" class="form-label"><?=lang('fields.password')?></label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-lock"></i></span>
                            <input value="<?= (isset($data_form["password"])) ? $data_form["password"] : ''; ?>" type="password" class="form-control border-start-0 ts_input" id="password" name="password" placeholder="<?=lang('fields.password')?>">
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="enabled" class="form-label"><?=lang('fields.enabled')?></label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-lock-open "></i></span>
                            <select id="enabled" name="enabled" class="form-select ts_input">
                                <option <?= (isset($data_form["enabled"]) and $data_form["enabled"]==1) ? 'selected' : ''; ?> value="1"><?=lang('fields.yes') ?></option>
                                <option <?= (isset($data_form["enabled"]) and $data_form["enabled"]==0) ? 'selected' : ''; ?> value="0"><?=lang('fields.no') ?></option>
                            </select>

                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>