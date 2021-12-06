<?php

/* 
 * Vista para la pagina de inicio de los documentos de nomina
 */

?>
<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
    <div class="col">
        <div class="card radius-10 overflow-hidden ts_pages_links" data-id="1" style="cursor: pointer">
                <div class="card-body">
                        <div class="d-flex align-items-center">
                                <div>
                                        <p class="mb-0"><?=lang('payroll.general_documents')?></p>
                                        <h5 id="count_list_1" class="mb-0">0</h5>
                                </div>
                                <div class="ms-auto">	<i class='fa fa-list-ol font-30'></i>
                                </div>
                        </div>
                </div>
                <div class="" id="chart2"></div>
        </div>
    </div>
    <div class="col">
            <div class="card radius-10 overflow-hidden ts_pages_links" data-id="2" style="cursor: pointer">
                    <div class="card-body">
                            <div class="d-flex align-items-center">
                                    <div>
                                            <p class="mb-0"><?=lang('payroll.individual_documents')?></p>
                                            <h5 id="count_list_2" class="mb-0">0</h5>
                                    </div>
                                    <div class="ms-auto">	<i class='fa fa-list-alt font-30'></i>
                                    </div>
                            </div>
                    </div>
                    <div class="" id="chart4"></div>
            </div>
    </div>
    
    
    
    <div class="col">
            <div class="card radius-10 overflow-hidden ts_pages_links" data-id="3" style="cursor: pointer">
                    <div class="card-body">
                            <div class="d-flex align-items-center">
                                    <div>
                                            <p class="mb-0"><?=lang('payroll.notes')?></p>
                                            <h5 id="count_list_3" class="mb-0">0</h5>
                                    </div>
                                    <div class="ms-auto">	<i class='fa fa-list font-30'></i>
                                    </div>
                            </div>
                    </div>
                    <div class="" id="chart1"></div>
            </div>
    </div>
    
</div><!--end row-->


<div class="row ">
    
        <div class="card">
            <div class="card-header">
                <div class="col-md-12 d-xl-flex align-items-center">
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
            
            </div>  
            
            <div class="card-body">
                <div class="col-md-12">
                    
                        <div id="div_content_list" class="email-list" style="overflow:auto">

                        </div>
                    
                </div>
                
            </div>  
        </div>    

        
</div>