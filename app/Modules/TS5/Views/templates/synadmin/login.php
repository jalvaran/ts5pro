<!doctype html>
<html lang="<?php echo $lang; ?>">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
        <link rel="icon" href="<?php echo $favicon;?>" type="image/png" />
	<!--plugins-->
	<link href="/themes/synadmin/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="/themes/synadmin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="/themes/synadmin/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="/themes/synadmin/assets/css/pace.min.css" rel="stylesheet" />
	<script src="/themes/synadmin/assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="/themes/synadmin/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="/themes/synadmin/assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="/themes/synadmin/assets/css/app.css" rel="stylesheet">
	<link href="/themes/synadmin/assets/css/icons.css" rel="stylesheet">
	<title>TS5 Pro</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<div class="authentication-header"></div>
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">

						<div class="card">
							<div class="card-body">
                                    <div class="mb-4 text-center">
                                            <img src="<?php echo $company_logo;?>" width="180" alt="Imagen" />
                                    </div>
								<div class="p-4 rounded">
									<div class="text-center">
										<h3 class=""><?php echo lang('Login.login_welcome');?></h3>

									</div>
                                    <?php echo $html_errors; ?>
									<div class="login-separater text-center mb-4"> <span><?php echo lang('Login.login_title');?></span>
										<hr/>
									</div>
									<div class="form-body">
										<form action="/ts5/signin" method="POST" enctype="multipart/form-data" class="row g-3">
											<div class="col-12">
												<label for="user_email" class="form-label"><?php lang('Login.login_title_field_username')?></label>
												<input type="text" class="form-control" id="user_username" name="user_username" placeholder="<?php echo lang('Login.login_title_field_username');?>">
											</div>
											<div class="col-12">
												<label for="user_pass" class="form-label"><?php echo lang('Login.login_title_field_pass')?></label>
												<div class="input-group" id="show_hide_password">
													<input type="password" class="form-control border-end-0" id="user_pass" name="user_pass" value="" placeholder="<?php echo lang('Login.login_title_field_pass');?>"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
													<label class="form-check-label" for="flexSwitchCheckChecked"><?php echo lang('Login.login_rememberme');?></label>
												</div>
											</div>

											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i><?php echo lang('Login.button_signin_value');?></button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="/themes/synadmin/assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="/themes/synadmin/assets/js/jquery.min.js"></script>
	<script src="/themes/synadmin/assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="/themes/synadmin/assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="/themes/synadmin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="/themes/synadmin/assets/js/app.js"></script>
</body>

</html>