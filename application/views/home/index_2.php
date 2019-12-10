<!DOCTYPE html>
<html lang="en">
<head>
<title>Ebako Costing</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<link href="jquery-ui-1.9.2.custom/development-bundle/themes/custom-theme/jquery-ui.css" type="text/css" rel="stylesheet" />
<link href="assets/vendors/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
<link href="assets/vendors/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
<link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="assets/vendors/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
<link href="assets/vendors/pace-progress/css/pace.min.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<link href="assets/css/custom.css" rel="stylesheet">
<script type="text/javascript">var url = '<?php echo base_url() ?>';</script>
<script src="assets/vendors/jquery/js/jquery.min.js"></script>
<script src="assets/vendors/popper.js/js/popper.min.js"></script>
<style type="text/css">
	.modal:nth-of-type(even) { z-index: 1042 !important; } .modal-backdrop.in:nth-of-type(even) { z-index: 1041 !important; }
</style>
</head>
<body>

	<div class="app header-fixed sidebar-fixed aside-menu-fixed pace-done">
	    <div id="dialog" style="display: none"></div>
		<div id="dialog2" style="display: none"></div>
		<div id="dialog3" style="display: none"></div>
		<div id="dialog4" style="display: none"></div>
		<div id="dialog_temp" style="display: none"></div>
		<div id="form_dialog" style="display: none"></div>
			
		<?php require_once 'header.php';?>
	    <div class="app-body">
	      <?php require_once 'left_menu.php';?>
	      <main class="main">
	        <div class="container-fluid">
	          <div class="animated fadeIn">
	            <div class="row">
	              <ol></ol>
	              <div class="col-md-12" id="main_container">
	              	<?php //require_once 'conten.php';?>  
	              </div>
	            </div>
	          </div>
	        </div>
	      </main>
	      
	    </div>
	<?php require_once 'footer.php';?>
	
	</div>
	
    
	<script src="assets/vendors/pace-progress/js/pace.min.js"></script>
	<script src="assets/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
	<script src="assets/vendors/@coreui/coreui/js/coreui.min.js"></script>
	
<!-- 	<script type="text/javascript" src="jquery-ui-1.9.2.custom/js/jquery-1.8.3.js"></script> -->
	<script type="text/javascript" src="jquery/ajaxfileupload.js"></script>
	<script type="text/javascript" src="jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js"></script>
	<script type="text/javascript" src="jquery/jquery.scrollableFixedHeaderTable.js"></script>
	<script type="text/javascript" src="jquery/jquery.cookie.pack.js"></script>
	<script type="text/javascript" src="jquery/jquery.layout-latest.js"></script>
	<script type="text/javascript" src="jquery/jquery.validate.js"></script>

	<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
	
	<script src="assets/js/app.js"></script>
	
	<script type="text/javascript">
	    $(document).on('show.bs.modal', '.modal', function (event) {
	        var zIndex = 1040 + (10 * $('.modal:visible').length);
	        $(this).css('z-index', zIndex);
	        setTimeout(function() {
	            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
	        }, 0);
	    });
	</script>
</body>
</html>
