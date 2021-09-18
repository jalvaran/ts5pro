<div class="row">
    <div class="col">
        <div class="email-wrapper">
            <div class="email-sidebar">
                <div class="email-sidebar-header d-grid"> <?=lang('admin.admin_title')?>
                </div>
                <div class="email-sidebar-content">
                    <div class="email-navigation ps ps--active-y">
                        <div class="list-group list-group-flush">
                            <a id="link_users" href="javascript:;" class="list-group-item d-flex align-items-center ts_pages_links"><i class="bx bxs-user me-3 font-20"></i><span><?=lang('fields.users')?></span></a>

                            <a id="link_roles" href="javascript:;" class="list-group-item active d-flex align-items-center ts_pages_links"><i class="bx bx-merge me-3 font-20"></i><span><?=lang('fields.roles')?></span></a>
                            <a id="link_branches" href="javascript:;" class="list-group-item active d-flex align-items-center ts_pages_links"><i class="fa fa-crop me-3 font-20"></i><span><?=lang('fields.branches')?></span></a>
                            <a id="link_cost_centers" href="javascript:;" class="list-group-item active d-flex align-items-center ts_pages_links"><i class="fa fa-briefcase me-3 font-20"></i><span><?=lang('fields.cost_centers')?></span></a>
                            
                        </div>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 345px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 257px;"></div></div></div>

                </div>
            </div>
            <div class="email-header d-xl-flex align-items-center">
                <div class="d-flex align-items-center">
                    <div class="">
                        <button id="btn_refresh" type="button" class="btn btn-white ms-2"><i class="bx bx-refresh me-0"></i>
                        </button>
                    </div>
                    <div class="">
                        <button id="btn_register_add" type="button" class="btn btn-white ms-2"><i class="bx bx-plus me-0"></i>
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
                    <div id="div_content_list" class="email-list ps ps--active-y">

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>