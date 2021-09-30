<!-- Bootstrap JS -->
	<script src="<?php echo base_url("/themes/synadmin/assets/js/bootstrap.bundle.min.js")?>"></script>
	<!--plugins-->

	<script src="<?php echo base_url("/themes/synadmin/assets/plugins/simplebar/js/simplebar.min.js")?>"></script>
	<script src="<?php echo base_url("/themes/synadmin/assets/plugins/metismenu/js/metisMenu.min.js")?>"></script>
	<script src="<?php echo base_url("/themes/synadmin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js")?>"></script>

    <script src="<?php echo base_url("/themes/synadmin/assets/plugins/dropzone/dropzone.min.js")?>"></script>

    <script src="<?php echo base_url("/themes/synadmin/assets/plugins/select2/js/select2.js")?>"></script>

    <script src="<?php echo base_url("/themes/synadmin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js")?>"></script>
	<script src="<?php echo base_url("/themes/synadmin/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js")?>"></script>
    <script src="<?php echo base_url("/themes/synadmin/assets/plugins/datatable/js/jquery.dataTables.min.js")?>"></script>
    <script src="<?php echo base_url("/themes/synadmin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js")?>"></script>

    <!--notification js -->
    <script src="<?php echo base_url("/themes/synadmin/assets/plugins/toastr/toastr.js")?>"></script>
    <script src="<?php echo base_url("/themes/synadmin/assets/plugins/sweetalert2/sweetalert2.min.js")?>"></script>
    <script src="<?php echo base_url("/themes/synadmin/assets/plugins/jquery/js.cookie.min.js")?>"></script>

    <!--app JS-->
    <script src="<?php echo base_url("/themes/synadmin/assets/js/app.js")?>"></script>

    <?php echo view('App\Modules\TS5\Views\templates\synadmin\general_scripts') ?>

    <?php if(isset($data_template["my_js"])){
        echo  $data_template["my_js"];        
    }
    ?>