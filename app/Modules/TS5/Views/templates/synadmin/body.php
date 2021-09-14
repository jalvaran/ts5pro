<body>
	<!--wrapper-->
	<div id="div_wrapper" class="wrapper toggled">

        <?php echo view($view_path.'\sidebar',array('data_template'=>$data_template)) ?>
        <?php echo view($view_path.'\header',array('data_template'=>$data_template)) ?>

		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">

                <div id="div_spinner" style="z-index: 1000"></div>
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3"> <?php echo $module_name ?> </div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('/menu')?>"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $page_title ?></li>
                            </ol>
                        </nav>
                    </div>

                </div>
                <div class="row">
                    <div class="col">
                        <?php echo view($view_path.'\modal_md',array('modal_title'=>"TS5")) ?>
                        <?php echo view($view_path.'\modal_fullscreen',array('modal_title'=>"TS5")) ?>
                        <?php echo view($view_path.'\modal_xl',array('modal_title'=>"TS5")) ?>
                    </div>
                </div>
                <div id="body_page_content" class="row">
				    <?php echo $page_content?>
                </div>
			</div>
						  
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->

        <?php echo view($view_path.'\footer',array('data_template'=>$data_template)) ?>

    </div>
	<!--end wrapper-->

    <?php //echo view($view_path.'\switcher',array('data_template'=>$data_template)) ?>
    <?php echo view($view_path.'\scripts',array('data_template'=>$data_template)) ?>

</body>
</html>