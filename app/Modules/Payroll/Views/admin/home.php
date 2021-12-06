<?php

/* 
 * vista para el home de administración de la nomina
 */

?>
<div class="row ">
    
    <div class="col-md-12" >
            
        <div class="card " >
            <div class="card-header">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-gradient rounded">
                    <div class="container-fluid">	
                        
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span></button>
                            
                            <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                       
                                        <li class="nav-item"> <a id="link_thirds" class="nav-link active ts_pages_links" href="#" data-id="1"><i class="fa fa-users me-1"></i><?=lang('fields.employees')?></a></li>

                                        
                                    </ul>
                                    <div class="d-flex nav-search">
                                        <div class="input-group">
                                            <input id="search" type="text" class="form-control" placeholder="<?=lang('fields.search') ?>">
                                                <button id="btn_search" class="btn" type="submit"><i class="bx bx-search"></i>
                                                </button>
                                        </div>
                                    </div>
                            </div>
                    </div>
                </nav>
            </div>   

            <div class="card-body ">
                <div id="div_content_list" class="row">
                    
                <div>    
            </div>
        </div>
    </div>
    
</div>