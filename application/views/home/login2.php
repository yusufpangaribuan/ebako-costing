<!DOCTYPE html>
<html lang="en">
<head>
<title>Ebako Costing</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<link href="assets/vendors/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
<link href="assets/vendors/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
<link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="assets/vendors/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
<link href="assets/vendors/pace-progress/css/pace.min.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="app flex-row align-items-center">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card-group">
					<div class="card p-4">
						<div class="card-body">
							<form name="login-form" class="login-form" action="<?php echo base_url("home/login") ?>" method="post">
								<h1>Login</h1>
								<p class="text-muted">
									<?php 
										if( empty( $this->session->userdata('msg') ) ){
											echo "Sign In to your account";
										}else{ ?>
											<span style="color: red">&nbsp;<?php echo $this->session->userdata('msg') ?></span>
									<?php	}
									?>
								</p>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text"> <i class="icon-user"></i> </span>
									</div>
									<input class="form-control" type="text" name="username" placeholder="Username">
								</div>
								<div class="input-group mb-4">
									<div class="input-group-prepend">
										<span class="input-group-text"> <i class="icon-lock"></i> </span>
									</div>
									<input class="form-control" name="password" type="password" value="" placeholder="Password">
								</div>
								<div class="row">
									<div class="col-6">
										<input type="submit" class="btn btn-primary px-4" value="Login"></input>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="card text-white bg-primary py-5 d-md-down-none" style="width: 44%">
						<div class="card-body text-center">
								<p>
									<h2>Costing System</h2>
								</p>
								<p> <h6>PT.EBAKO NUSANTARA</h6> </p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="assets/vendors/jquery/js/jquery.min.js"></script>
	<script src="assets/vendors/popper.js/js/popper.min.js"></script>
	<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendors/pace-progress/js/pace.min.js"></script>
	<script src="assets/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
	<script src="assets/vendors/@coreui/coreui/js/coreui.min.js"></script>
</body>
</html>
