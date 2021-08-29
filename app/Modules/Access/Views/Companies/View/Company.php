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
                                                <button id="btn_crear_api" name="btn_crear_api" class="btn btn-primary"><?= lang('Access.access_view_button_create_company_api')?></button>
                                                <button id="btn_update_api" name="btn_update_api" class="btn btn-outline-danger"><?= lang('Access.access_view_button_update_company_api')?></button>
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
                                                <span class="text-secondary"><?= $data_company["token_api_fe"]?></span>
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
                                    <button id="btn_create_logo" type="button" class="form-control btn btn-primary btn-lg px-5 "><?= lang('Access.btn_create_logo')?></button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab3" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="software_id" class="form-label"><?= lang('Access.input_software_id')?></label>
                                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-id-badge"></i></span>
                                            <input type="text" class="form-control border-start-0" id="software_id" name="software_id" placeholder="<?= lang('Access.input_software_id')?>">
                                        </div>

                                    </div>
                                    <div class="col-6">
                                        <label for="software_pin" class="form-label"><?= lang('Access.input_software_pin')?></label>
                                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa fa-map-marker"></i></span>
                                            <input type="text" class="form-control border-start-0" id="software_pin" name="software_pin" placeholder="<?= lang('Access.input_software_pin')?>">
                                        </div>

                                    </div>
                                </div>
                                <br>
                                <div class="col-12">
                                    <button id="btn_create_software" type="button" class="form-control btn btn-primary btn-lg px-5 "><?= lang('Access.btn_software_id')?></button>
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
                                    <label for="password_certified" class="form-label"><?= lang('Access.input_certified_password')?></label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bxs-lock"></i></span>
                                        <input type="text" class="form-control border-start-0" id="password_certified" name="password_certified" placeholder="<?= lang('Access.input_certified_password')?>">
                                    </div>

                                </div>
                                <br>
                                <div class="col-12">
                                    <button id="btn_create_certified" type="button" class="form-control btn btn-primary btn-lg px-5 "><?= lang('Access.btn_certified')?></button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab5" role="tabpanel">
                        Resolucion
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
                    <div class="col" id="div_mensajes_api">

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
