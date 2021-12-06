<div class="row">
    <div class="col">
        <div class="email-wrapper">
            <div class="email-sidebar">
                <div class="email-sidebar-header d-grid"> <?=lang('admin.admin_title')?>
                </div>
                <div class="email-sidebar-content">
                    <div class="email-navigation" style="overflow:auto">
                        <div class="list-group list-group-flush">
                            <a id="link_thirds" data-id="100" href="javascript:;" class="list-group-item d-flex align-items-center ts_pages_links"><i class="fa fa-users me-3 font-20"></i><span><?=lang('fields.thirds')?></span></a>
                            <a id="link_history" data-id="A" href="javascript:;" class="list-group-item active d-flex align-items-center ts_pages_links"><i class="fa fa-history me-3 font-20"></i><span><?=lang('fields.history')?></span></a>
                            <a id="link_on_request" data-id="1" href="javascript:;" class="list-group-item  d-flex align-items-center ts_pages_links"><i class="fa fa-inbox me-3 font-20"></i><span><?=lang('fields.on_request')?></span></a>
                            <a id="link_analysis" data-id="2" href="javascript:;" class="list-group-item  d-flex align-items-center ts_pages_links"><i class="fa fa-crop me-3 font-20"></i><span><?=lang('fields.in_analisys')?></span></a>
                            <a id="link_pre_approved" data-id="3" href="javascript:;" class="list-group-item  d-flex align-items-center ts_pages_links"><i class="fa fa-check me-3 font-20"></i><span><?=lang('fields.pre_approved')?></span></a>                            
                            <a id="link_approved" data-id="4" href="javascript:;" class="list-group-item  d-flex align-items-center ts_pages_links"><i class="fa fa-handshake me-3 font-20"></i><span><?=lang('fields.approved')?></span></a>
                            <a id="link_invoiced" data-id="5" href="javascript:;" class="list-group-item  d-flex align-items-center ts_pages_links"><i class="bx bx-dollar-circle me-3 font-20"></i><span><?=lang('fields.invoiced')?></span></a>
                            <a id="link_documents_delivered" data-id="6" href="javascript:;" class="list-group-item  d-flex align-items-center ts_pages_links"><i class="fa fa-briefcase me-3 font-20"></i><span><?=lang('fields.documents_delivered')?></span></a>
                            <a id="link_signed_documents" data-id="7" href="javascript:;" class="list-group-item  d-flex align-items-center ts_pages_links"><i class="bx bx-edit me-3 font-20"></i><span><?=lang('fields.signed_documents')?></span></a>
                            <a id="link_official_documents" data-id="8" href="javascript:;" class="list-group-item  d-flex align-items-center ts_pages_links"><i class="fa fa-ellipsis-h me-3 font-20"></i><span><?=lang('fields.official_documents')?></span></a>
                            <a id="link_for_delivery" data-id="9" href="javascript:;" class="list-group-item  d-flex align-items-center ts_pages_links"><i class="fa fa-truck me-3 font-20"></i><span><?=lang('fields.for_delivery')?></span></a>
                            <a id="link_delivered" data-id="10" href="javascript:;" class="list-group-item  d-flex align-items-center ts_pages_links"><i class="fa fa-tags me-3 font-20"></i><span><?=lang('fields.delivered')?></span></a>
                            
                            <a id="link_pre_approved_denied" data-id="11" href="javascript:;" class="list-group-item  d-flex align-items-center ts_pages_links"><i class="fa fa-reply me-3 font-20"></i><span><?=lang('fields.pre_approved_denied')?></span></a>                            
                            <a id="link_archived_by_commercial" data-id="12" href="javascript:;" class="list-group-item  d-flex align-items-center ts_pages_links"><i class="fa fa-archive me-3 font-20"></i><span><?=lang('fields.archived_by_commercial')?></span></a>
                            
                            
                        </div>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 345px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 257px;"></div></div></div>

                </div>
            </div>
            <div class="email-header d-xl-flex align-items-center">
                <div class="d-flex align-items-center">
                    <div class="">
                        <button id="btn_thirds" type="button" class="btn btn-outline-primary ms-2"><i class="fa fa-users me-0"></i>
                        </button>
                    </div>
                    <div class="">
                        <button id="btn_refresh" type="button" class="btn btn-outline-dark  ms-2"><i class="bx bx-refresh me-0"></i>
                        </button>
                    </div>
                    <div class="">
                        <button id="btn_register_add" type="button" class="btn btn-outline-success ms-2"><i class="bx bx-plus me-0"></i>
                        </button>
                    </div>

                </div>
                <div class="flex-grow-1 mx-xl-2 my-2 my-xl-0">
                    <div class="input-group">	<span class="input-group-text bg-transparent"><i class="bx bx-search"></i></span>
                        <input id="search" type="text" class="form-control" placeholder="<?=lang('fields.search')?>">
                    </div>
                </div>

            </div>
            <div class="email-content">
                <div class="container">
                    <div id="div_content_list" class="email-list" style="overflow:auto">

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>