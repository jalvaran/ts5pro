<!doctype html>
<html lang="<?php echo $lang?>" class="<?php if(isset($theme)) echo $theme?>">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="<?php echo $favicon?>" type="image/png" />
	<!--plugins-->
    <link href="<?php echo base_url("/themes/synadmin/assets/plugins/sweetalert2/sweetalert2.min.css")?>" rel="stylesheet" />

    <link href="<?php echo base_url("/themes/synadmin/assets/plugins/simplebar/css/simplebar.css")?>" rel="stylesheet" />

    <link href="<?php echo base_url("/themes/synadmin/assets/plugins/select2/css/select2.css")?>"  rel="stylesheet" />

    <link href="<?php echo base_url("/themes/synadmin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css")?>" rel="stylesheet" />
	<link href="<?php echo base_url("/themes/synadmin/assets/plugins/highcharts/css/highcharts.css")?>" rel="stylesheet" />
	<link href="<?php echo base_url("/themes/synadmin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css")?>" rel="stylesheet" />
	<link href="<?php echo base_url("/themes/synadmin/assets/plugins/metismenu/css/metisMenu.min.css")?>" rel="stylesheet" />
    <link href="<?php echo base_url("/themes/synadmin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css")?>" rel="stylesheet" />
	<!-- loader-->
	<link href="<?php echo base_url("/themes/synadmin/assets/css/pace.min.css")?>" rel="stylesheet" />
	<script src="<?php echo base_url("/themes/synadmin/assets/js/pace.min.js")?>"></script>
    <script src="<?php echo base_url("/themes/synadmin/assets/js/jquery.min.js")?>"></script>
	<!-- Bootstrap CSS -->

	<link href="<?php echo base_url("/themes/synadmin/assets/css/bootstrap.min.css")?>" rel="stylesheet">
	<link href="<?php echo base_url("/themes/synadmin/assets/css/bootstrap-extended.css")?>" rel="stylesheet">
    <link href="<?php echo base_url("/themes/synadmin/assets/plugins/dropzone/dropzone.min.css")?>" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="<?php echo base_url("/themes/synadmin/assets/css/app.css")?>" rel="stylesheet">
	<link href="<?php echo base_url("/themes/synadmin/assets/css/icons.css")?>"  rel="stylesheet">
    <link href="<?php echo base_url("/themes/synadmin/assets/font-awesome/css/all.min.css")?>" rel="stylesheet">
    <link href="<?php echo base_url("/themes/synadmin/assets/plugins/toastr/toastr.css")?>" rel="stylesheet" />

    <!-- Theme Style CSS -->
	<link rel="stylesheet" href="<?php echo base_url("/themes/synadmin/assets/css/dark-theme.css")?>" />
	<link rel="stylesheet" href="<?php echo base_url("/themes/synadmin/assets/css/semi-dark.css")?>" />
	<link rel="stylesheet" href="<?php echo base_url("/themes/synadmin/assets/css/header-colors.css")?>" />
	<title><?php echo $page_title?></title>
</head>