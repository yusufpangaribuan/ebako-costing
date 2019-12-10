<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ebako Costing</title>
    
    <?php $base_url = base_url();?>
    
    <script type="text/javascript">var url = '<?php echo $base_url ?>'; var container__ = "";</script>
    <link href="<?php echo $base_url ?>assets/vendors/nifty/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>assets/vendors/nifty/css/nifty.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>assets/vendors/nifty/css/demo/nifty-demo-icons.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>assets/vendors/animate-css/animate.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>assets/vendors/morris-js/morris.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>assets/vendors/switchery/switchery.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>assets/vendors/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>assets/vendors/nifty/css/demo/nifty-demo.min.css" rel="stylesheet">
    
    <link href="<?php echo $base_url ?>assets/vendors/nifty/css/themes/type-a/theme-ocean.css" rel="stylesheet">

    <link href="<?php echo $base_url ?>assets/vendors/pace-progress/css/pace.min.css" rel="stylesheet">
    <script data-pace-options='{ "ajax": true }' src="<?php echo $base_url ?>assets/vendors/pace-progress/js/pace.min.js"></script>
    
    <link href="<?php echo $base_url ?>assets/vendors/data-table/1/datatables.min.css" rel="stylesheet">
	
	<link href="<?php echo $base_url ?>assets/vendors/select22/select2.min.css" rel="stylesheet">
	
    <link href="<?php echo $base_url ?>assets/css/custom.css" rel="stylesheet">
    <style type="text/css">
		div#top_bar_notification{position:fixed;text-align:center;width:100%;left: 0; right: 0;top:5px;z-index:9999;margin-left:auto;margin-right:auto;display:center}div#top_bar_notification #message{background-color:#D2D2D2;z-index:9999;width:300px;margin:auto;font-size:12px;text-align:center;vertical-align:middle;padding:2px;border:1px solid #FFF;border-radius:2px;-webkit-border-radius:2px;-webkit-box-shadow:0 2px 4px rgba(0,0,0,.2);box-shadow:0 2px 4px rgba(0,0,0,.2)}div#top_bar_notification #message.message-proggress{background-color:#f9edbe;border:1px solid #f0c36d}div#top_bar_notification #message.message-error{background-color:#ffc4c4;border:1px solid #f0c36d}div#top_bar_notification #message.message-info,div#top_bar_notification #message.message-warning{background-color:#f9edbe;border:1px solid #f0c36d}.error-message{font-size:12px}div#top_bar_notification #message.message-success{background-color:#B5F3C9;border:1px solid #17B54A} .m-row:hover { background-color: #cce9ff; border: 1px solid #bedcf3;}.input-editable{background-color:#f1ffee;border:1px solid #5b9252}
	.select2-container {
	    font-size: 9px;
	    max-width: 250px;
	}
	</style>
	
	<script src="<?php echo $base_url ?>assets/vendors/nifty/js/jquery-2.2.1.min.js"></script>
</head>

<body>
	<div id="top_bar_notification" style="display: none;"></div>
    <div id="container" class="effect slide mainnav-out">
        
        <?php require_once 'header.php';?>

        <div class="boxed">
            
            <?php require_once 'left_menu.php';?>
            <div id="sidenav-overlay" onclick="closeNiftyNav()"></div>
            
            <div id="content-container">
                <div id="page-content"> </div>
           </div>

        </div>

        <footer id="footer">
            <p class="pad-lft">&copy; 2018 Ebako</p>
        </footer>
        <button id="scroll-top" class="btn"><i class="fa fa-chevron-up"></i></button>

    </div>
    
    <script src="<?php echo $base_url ?>assets/vendors/nifty/js/bootstrap.min.js"></script>
    <script src="<?php echo $base_url ?>assets/vendors/fast-click/fastclick.min.js"></script>
    <script src="<?php echo $base_url ?>assets/vendors/nifty/js/nifty.js"></script>
    <script src="<?php echo $base_url ?>assets/vendors/morris-js/morris.min.js"></script>
	<script src="<?php echo $base_url ?>assets/vendors/morris-js/raphael-js/raphael.min.js"></script>
    <script src="<?php echo $base_url ?>assets/vendors/sparkline/jquery.sparkline.min.js"></script>
    <script src="<?php echo $base_url ?>assets/vendors/skycons/skycons.min.js"></script>
    <script src="<?php echo $base_url ?>assets/vendors/switchery/switchery.min.js"></script>
    <script src="<?php echo $base_url ?>assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="<?php echo $base_url ?>assets/vendors/bootbox/bootbox4.min.js"></script>
    
    <script src="<?php echo $base_url ?>assets/vendors/data-table/1/datatables.min.js"></script>
    
    <script src="<?php echo $base_url ?>assets/vendors/select22/select2.js"></script>
    
    <script src="<?php echo $base_url ?>assets/vendors/parsley/parsley.min.js"></script>
    
    <script src="<?php echo $base_url ?>assets/js/app.js"></script>
    <script src="<?php echo $base_url ?>assets/js/Client.js"></script>
    <script src="<?php echo $base_url ?>js/global.js"></script>

	<script type="text/javascript"> function closeNiftyNav(){ $.niftyNav('slideOut'); } </script>
</body>
</html>
