<div class="row">
    <div class="col">
        <div class="email-wrapper">
            <div class="email-sidebar">
                <div class="email-sidebar-header d-grid"> <?=lang('admin.admin_title')?>
                </div>
                <div class="email-sidebar-content">
                    <div class="email-navigation" style="overflow:auto">
                        <div class="list-group list-group-flush">
                            <a id="link_trademarks" data-id="1" href="javascript:;" class="list-group-item active d-flex align-items-center ts_pages_links"><i class="fa fa-list me-3 font-20"></i><span><?=lang('creditmoto.trademarks_list')?></span></a>
                            <a id="link_colors" data-id="2" href="javascript:;" class="list-group-item  d-flex align-items-center ts_pages_links"><i class="fa fa-list-alt me-3 font-20"></i><span><?=lang('creditmoto.colors_list')?></span></a>
                            <a id="link_motorcycles" data-id="3" href="javascript:;" class="list-group-item  d-flex align-items-center ts_pages_links"><i class="fa fa-list-ol me-3 font-20"></i><span><?=lang('creditmoto.motorcycles_list')?></span></a>
                                                        
                        </div>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 345px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 257px;"></div></div></div>

                </div>
            </div>
            <div class="email-header d-xl-flex align-items-center">
                <div class="d-flex align-items-center">
                    
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