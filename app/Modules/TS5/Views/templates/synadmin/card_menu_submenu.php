<div class="col-md-<?php echo $card_num_cols ?> ts_card" >
    <a href="<?php echo $link ?>" >
        <div class="card shadow-none border radius-15 ">
            <div class="card-body ">
                <div class="d-flex align-items-center ts">
                    <div class="fm-icon-box radius-15 bg-primary text-white"><i class="<?php echo $card_icon_menu ?>"></i>
                    </div>
                    <div class="ms-auto font-24"><i class="lni lni-bookmark text-danger"></i>
                    </div>
                </div>
                <h5 class="mt-3 mb-0" ><?php echo $card_title ?></h5>
                <p class="mb-1 mt-4"><span><?php echo $card_sub_title ?></span>  <span class="float-end"><?php echo $company_nit ?></span>
                </p>
                <div class="progress" style="height: 7px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </a>
</div>
