<div class="row">
    <div class="col">
        <div class="card border-top border-0 border-4 border-danger">
            <div class="card-body p-5">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bx-merge me-1 font-22 text-danger"></i>
                    </div>
                    <h5 class="mb-0 text-danger"><?=lang('msg.create_branch')?></h5>
                </div>
                <hr>
                <div class="row g-3">

                    <div class="col-12">
                        <label for="name" class="form-label"><?=lang('fields.name')?></label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-id-card "></i></span>
                            <input value="<?= (isset($data_form["name"])) ? $data_form["name"] : ''; ?>" type="text" class="form-control border-start-0 ts_input" id="name" name="name" placeholder="<?=lang('fields.name')?>">
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <label for="app_cat_municipalities_id" class="form-label"><?=lang('fields.app_cat_municipalities_id')?></label>
                        <div class="input-group"> 
                            
                            <select id="app_cat_municipalities_id" name="app_cat_municipalities_id" class="form-select ts_input">
                                
                                <option value=""><?=lang('msg.option_select')?></option>
                                
                                <?php
                                    if(isset($data_form["app_cat_municipalities_id"])){
                                        print('<option value="'.$data_form["app_cat_municipalities_id"].'" selected>'.$data_form["municipalitie_name"].'</option>');
                                    }
                                ?>
                                
                            </select>    
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>