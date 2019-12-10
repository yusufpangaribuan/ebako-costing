<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ebako Costing</title>
    <script type="text/javascript">var url = '<?php $base_url = base_url(); echo $base_url; ?>';</script>
    <link href="<?php echo $base_url ?>assets/vendors/nifty/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>assets/vendors/nifty/css/nifty.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>assets/vendors/nifty/css/demo/nifty-demo.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>assets/vendors/pace-progress/css/pace.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>assets/css/custom.css" rel="stylesheet">
    <script data-pace-options='{ "ajax": true }' src="<?php echo base_url() ?>assets/vendors/pace-progress/js/pace.min.js"></script>
</head>
<body>
<div id="container" class="" style="background-color: #f5f5f5 !important;">
		<div class="cls-content">
			<div class="cls-content-sm panel widget" style="border: 1px solid #e8f0fe;">
				<div class="widget-header bg-primary">
					<center>
						<h2 class="text-thin">EBAKO COSTING</h2>
					</center>
				</div>
				<div class="widget-body">
					<img alt="Profile Picture" class="widget-img img-circle img-border-light" src="<?php echo base_url() ?>assets/img/av1.png">
					<p class="text-muted">
						<center><h4 style="color: #5fa2dd;">Login to your account</h4></center>
					</p>
					<br/>
					<form name="login-form" class="login-form" action="<?php echo base_url("home/login") ?>" method="post">
						<div class="form-group">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-user"></i></div>
									<input type="text" class="form-control" name="username" placeholder="Username">
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
									<input type="password" class="form-control"  name="password" value="" placeholder="Password">
								</div>
							</div>
						</div>
						<p class="text-muted">
							<?php 
								if( !empty( $this->session->userdata('msg') ) ){
							 ?>
									<span style="color: red">&nbsp;<?php echo $this->session->userdata('msg') ?></span>
							<?php } ?>
						</p>
						<div class="form-group text-right">
							<button class="btn btn-block btn-success text-uppercase" type="submit">Login</button>
						</div>
					</form>
					<br/>
					<br/>
				</div>
			</div>
			<div class="pad-ver">
				<div class="card-body text-center">
					<h4>PT. EBAKO NUSANTARA</h4>
					<p>&copy; 2019 All Rights Reserved. <br>Privacy and Terms</p>
				</div>
			</div>
		</div>
	</div>    
    <script src="<?php echo base_url() ?>assets/vendors/nifty/js/jquery-2.2.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/nifty/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/fast-click/fastclick.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/nifty/js/nifty.js"></script>
</body>
</html>
