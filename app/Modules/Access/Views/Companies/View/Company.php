<div class="row bg-light ">
    <h6 class="mb-0 text-uppercase "><?= lang('Access.access_view_title')." ".$data_company["name"]." ".$data_company["identification"];?></h6>
    <hr>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-danger" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#tab1" role="tab" aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class="fa fa-building font-18 me-1"></i>
                                </div>
                                <div class="tab-title"><?= lang('Access.access_view_tab1')?></div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab2" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class="lni lni-image font-18 me-1"></i>
                                </div>
                                <div class="tab-title"><?= lang('Access.access_view_tab2')?></div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab3" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class="fa fa-code-branch font-18 me-1"></i>
                                </div>
                                <div class="tab-title"><?= lang('Access.access_view_tab3')?></div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab4" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class="fa fa-certificate font-18 me-1"></i>
                                </div>
                                <div class="tab-title"><?= lang('Access.access_view_tab4')?></div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab5" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class="fa fa-list font-18 me-1"></i>
                                </div>
                                <div class="tab-title"><?= lang('Access.access_view_tab5')?></div>
                            </div>
                        </a>
                    </li>

                </ul>
                <div class="tab-content py-3">
                    <div class="tab-pane fade active show" id="tab1" role="tabpanel">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            <img id="img_company" src="<?= $company_logo;?>" alt="Admin" class="rounded p-1 bg-transparent" width="150">
                                            <div class="mt-3">
                                                <h4><?= $data_company["name"] ?></h4>
                                                <p class="text-secondary mb-1"><?= $data_company["description"] ?></p>
                                                <p class="text-muted font-size-sm"><?= $data_company["address"] ?></p>
                                                <button id="btn_create_api" data-item_id="<?= $data_company["id"] ?>" name="btn_create_api" class="btn btn-primary"><?= lang('Access.access_view_button_create_company_api')?></button>
                                                <button id="btn_update_api" data-item_id="<?= $data_company["id"] ?>" name="btn_update_api" class="btn btn-outline-danger"><?= lang('Access.access_view_button_update_company_api')?></button>
                                                <br><br>
                                                <button id="btn_environment_test" data-item_id="<?= $data_company["id"] ?>" name="btn_environment_test" class="btn btn-dark"><?= lang('Access.btn_environment_test')?></button>
                                                <button id="btn_environment_production" data-item_id="<?= $data_company["id"] ?>" name="btn_environment_production" class="btn btn-outline-secondary"><?= lang('Access.btn_environment_production')?></button>

                                            </div>
                                        </div>
                                        <hr class="my-4">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                <h6 class="mb-0"><?= lang('Access.companies_table_col4')?>:</h6>
                                                <span class="text-secondary"><?= $data_company["identification"]?></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                <h6 class="mb-0"><?= lang('Access.companies_table_col6')?></h6>
                                                <span class="text-secondary"><?= $data_company["mail"]?></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                <h6 class="mb-0"><?= lang('Access.companies_table_col8')?></h6>
                                                <span class="text-secondary"><?= $data_company["phone"]?></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                <h6 class="mb-0"><?= lang('Access.companies_frm_input_test_set_dian')?></h6>
                                                <span class="text-secondary"><?= $data_company["test_set_dian"]?></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                <h6 class="mb-0"><?= lang('Access.companies_table_col9')?></h6>
                                                <span class="text-secondary"><?= $data_company["token_api_soenac"]?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="tab2" role="tabpanel">
                        <div class="row">
                            <?php
                            $data_dropzone["cols"]=6;
                            $data_dropzone["tags_form"]='data-company_id="'.$data_company["id"].'"' ;
                            $data_dropzone["id"]="company_logo";
                            $data_dropzone["title"]=lang('Access.dropzone_company_logo_title');
                            $data_dropzone["sub_title"]=lang('Access.dropzone_company_logo_subtitle');
                            echo view($views_path.'\dropzone_upload',$data_dropzone);

                            ?>
                            <div class="col-md-6">

                                <div class="col-12">
                                    <button id="btn_create_logo" type="button" data-item_id="<?= $data_company["id"] ?>" name="btn_crear_api" class="form-control btn btn-primary btn-lg px-5 "><?= lang('Access.btn_create_logo')?></button>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab3" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="identifier" class="form-label "><?= lang('Access.input_software_id')?></label>
                                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-id-badge"></i></span>
                                            <input type="text" class="form-control border-start-0 ts_input_software" id="identifier" name="identifier" placeholder="<?= lang('Access.input_software_id')?>">
                                        </div>

                                    </div>
                                    <div class="col-6">
                                        <label for="pin" class="form-label"><?= lang('Access.input_software_pin')?></label>
                                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-map-marker"></i></span>
                                            <input type="text" class="form-control border-start-0 ts_input_software" id="pin" name="pin" placeholder="<?= lang('Access.input_software_pin')?>">
                                        </div>

                                    </div>
                                </div>
                                <br>
                                <div class="col-12">
                                    <button id="btn_create_software" data-item_id="<?= $data_company["id"] ?>" type="button" class="form-control btn btn-primary btn-lg px-5 "><?= lang('Access.btn_software_id')?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab4" role="tabpanel">
                        <div class="row">
                            <?php
                            $data_dropzone["cols"]=6;
                            $data_dropzone["tags_form"]='data-company_id="'.$data_company["id"].'"' ;
                            $data_dropzone["id"]="company_certificate";
                            $data_dropzone["title"]=lang('Access.dropzone_certified_title');
                            $data_dropzone["sub_title"]=lang('Access.dropzone_certified_subtitle');
                            echo view($views_path.'\dropzone_upload',$data_dropzone);

                            ?>
                            <div class="col-md-6">
                                <div class="col-12">
                                    <label for="password" class="form-label"><?= lang('Access.password')?></label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-lock"></i></span>
                                        <input type="text" class="form-control border-start-0 ts_input_certificate" id="password" name="password" placeholder="<?= lang('Access.password')?>">
                                    </div>

                                </div>
                                <br>
                                <div class="col-12">
                                    <button id="btn_create_certificate" data-item_id="<?= $data_company["id"] ?>" type="button" class="form-control btn btn-primary btn-lg px-5 "><?= lang('Access.btn_certified')?></button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab5" role="tabpanel">

                        <div class="card border-top border-0 border-4 border-primary">
                            <div class="card-body p-5">

                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="type_document_id" class="form-label"><?= lang('Access.type_document_id');?></label>
                                        <select id="resolution_type_document_id" name="resolution_type_document" class="form-select ts_input_resolution">
                                            <option value="1"><?= lang('Access.type_document_id_option1');?></option>
                                            <option value="5"><?= lang('Access.type_document_id_option2');?></option>
                                            <option value="6"><?= lang('Access.type_document_id_option3');?></option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="resolution_date" class="form-label "><?= lang('Access.date');?></label>
                                        <input type="text" value="0001-01-01" class="form-control ts_input_resolution" id="resolution_date" name="resolution_date" placeholder="<?= lang('Access.date');?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="prefix" class="form-label "><?= lang('Access.prefix');?></label>
                                        <input type="text" value="SETP" class="form-control ts_input_resolution" id="prefix" name="prefix" placeholder="<?= lang('Access.prefix');?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="resolution" class="form-label "><?= lang('Access.resolution');?></label>
                                        <input type="text" value="18760000001" class="form-control ts_input_resolution" id="resolution" name="resolution" placeholder="<?= lang('Access.resolution');?>">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="technical_key" class="form-label "><?= lang('Access.technical_key');?></label>
                                        <input type="text" value="fc8eac422eba16e22ffd8c6f94b3f40a6e38162c" class="form-control ts_input_resolution" id="technical_key" name="technical_key" placeholder="<?= lang('Access.technical_key');?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="from" class="form-label "><?= lang('Access.from');?></label>
                                        <input type="text" value="990000000" class="form-control ts_input_resolution" id="from" name="from" placeholder="<?= lang('Access.from');?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="to" class="form-label "><?= lang('Access.to');?></label>
                                        <input type="text" value="995000000" class="form-control ts_input_resolution" id="to" name="to" placeholder="<?= lang('Access.to');?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="date_from" class="form-label "><?= lang('Access.date_from');?></label>
                                        <input type="text" value="2019-01-19" class="form-control ts_input_resolution" id="date_from" name="date_from" placeholder="<?= lang('Access.date_from');?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="date_to" class="form-label "><?= lang('Access.date_to');?></label>
                                        <input type="text" value="2030-01-19" class="form-control ts_input_resolution" id="date_to" name="date_to" placeholder="<?= lang('Access.date_to');?>">
                                    </div>
                                    <div class="col-md-8">
                                        <label for="action_type" class="form-label "><?= lang('Access.resolution_action_type');?></label>
                                        <select id="action_type" name="action_type" class="form-select ts_input_resolution">
                                            <option value="1"><?= lang('Access.action_type_option1');?></option>
                                            <option value="2"><?= lang('Access.action_type_option2');?></option>
                                            <option value="3"><?= lang('Access.action_type_option3');?></option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="action_type_resolution_id" class="form-label "><?= lang('Access.action_type_resolution_id');?></label>
                                        <input type="text" class="form-control ts_input_resolution" id="action_type_resolution_id" name="action_type_resolution_id" placeholder="<?= lang('Access.action_type_resolution_id');?>">
                                    </div>
                                    <div class="col-4">
                                        <button id="btn_get_numeration" data-item_id="<?= $data_company["id"] ?>" class="btn btn-primary px-5 form-control"><?= lang('Access.resolution_btn_get_numeration');?></button>
                                    </div>
                                    <div class="col-4">
                                        <button id="btn_get_resolutions" data-item_id="<?= $data_company["id"] ?>" class="btn btn-success px-5 form-control"><?= lang('Access.resolution_btn_get_resolutions');?></button>
                                    </div>
                                    <div class="col-4">
                                        <button id="btn_resolution_create" data-item_id="<?= $data_company["id"] ?>" class="btn btn-danger px-5 form-control"><?= lang('Access.resolution_btn_resolution_create');?></button>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row g-3 responsive">

                                    <div class="col table-responsive">
                                    <table id="table_resolutions" class="table table-striped">

                                        <thead>
                                            <tr><th>ResolutionNumber</th><th>ResolutionDate</th><th>Prefix</th><th>FromNumber</th><th>ToNumber</th><th>ValidDateFrom</th><th>ValidDateTo</th><th>TechnicalKey</th></tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <span>Mensajes API</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col" id="div_messages_api">

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
