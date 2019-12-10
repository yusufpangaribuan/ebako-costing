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
<link href="<?php echo $base_url ?>assets/vendors/data-table/3/datatables.min.css" rel="stylesheet">
<link href="<?php echo $base_url ?>assets/vendors/data-table/3/jquery.dataTables.min.css" rel="stylesheet">
<link href="<?php echo $base_url ?>assets/vendors/data-table/3/fixedColumns.dataTables.min.css" rel="stylesheet">
<link href="<?php echo $base_url ?>assets/vendors/select22/select2.min.css" rel="stylesheet">
<link href="<?php echo $base_url ?>assets/css/custom.css" rel="stylesheet">
<style type="text/css">
	div#top_bar_notification{position:fixed;text-align:center;width:100%;left: 0; right: 0;top:5px;z-index:9999;margin-left:auto;margin-right:auto;display:center}div#top_bar_notification #message{background-color:#D2D2D2;z-index:9999;width:300px;margin:auto;font-size:12px;text-align:center;vertical-align:middle;padding:2px;border:1px solid #FFF;border-radius:2px;-webkit-border-radius:2px;-webkit-box-shadow:0 2px 4px rgba(0,0,0,.2);box-shadow:0 2px 4px rgba(0,0,0,.2)}div#top_bar_notification #message.message-proggress{background-color:#f9edbe;border:1px solid #f0c36d}div#top_bar_notification #message.message-error{background-color:#ffc4c4;border:1px solid #f0c36d}div#top_bar_notification #message.message-info,div#top_bar_notification #message.message-warning{background-color:#f9edbe;border:1px solid #f0c36d}.error-message{font-size:12px}div#top_bar_notification #message.message-success{background-color:#B5F3C9;border:1px solid #17B54A} .m-row:hover { background-color: #cce9ff; border: 1px solid #bedcf3;}.input-editable{background-color:#f1ffee;border:1px solid #5b9252}
	.select2-container{font-size:9px;max-width:250px}.input-editable-pricelist{background-color:#bfffb1;border:1px solid #5b9252}.select2-container{font-size:11px;min-width:100%}.select2-results__option{padding-right:20px;vertical-align:middle}.select2-results__option:before{content:"";display:inline-block;position:relative;height:20px;width:20px;border:2px solid #e9e9e9;border-radius:4px;background-color:#fff;margin-right:20px;vertical-align:middle;float:left}.select2-results__option[aria-selected=true]:before{font-family:fontAwesome;content:"\f00c";color:#fff;background-color:#f77750;border:0;display:inline-block;padding-left:3px}.select2-container--default .select2-results__option[aria-selected=true]{background-color:#fff}.select2-container--default .select2-results__option--highlighted[aria-selected]{background-color:#eaeaeb;color:#272727}.select2-container--default .select2-selection--multiple{margin-bottom:10px}.select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple{border-radius:4px}.select2-container--default.select2-container--focus .select2-selection--multiple{border-color:#f77750;border-width:2px}.select2-container--default .select2-selection--multiple{border-width:2px}.select2-container--open .select2-dropdown--below{border-radius:6px;box-shadow:0 0 10px rgba(0,0,0,.5)}.select2-selection .select2-selection--multiple:after{content:'hhghgh'}.select-icon .select2-selection__placeholder .badge{display:none}.select-icon .placeholder{display:none}.select-icon .select2-results__option:before,.select-icon .select2-results__option[aria-selected=true]:before{display:none!important}.select-icon .select2-search--dropdown{display:none}.select2-container--default .select2-selection--multiple .select2-selection__rendered{overflow-x:auto;overflow-y:auto;max-height:200px;width:fit-content}.select2-container--default .select2-selection--multiple .select2-selection__clear{cursor:pointer;float:right;font-weight:700;margin-top:5px;margin-right:5px;width:25px;text-align:center;padding:3px;font-size:11px;background-color:#f77750}
</style>
<script src="<?php echo $base_url ?>assets/vendors/nifty/js/jquery-2.2.1.min.js"></script>
<script src="<?php echo base_url() ?>js/costing_pricelist.js"></script>

</head>
<body>
		<div id="top_bar_notification" style="display: none;"></div>
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Price List</h3>
				</div>
				<div class="row" style="width: 100%;" >
					<div class="col-sm-offset-1 col-sm-5" style="border-right: 2px solid #cac2c2;">
						<fieldset>
    						<legend style="margin-bottom: 0px; text-align: center;">Parameter Price</legend>
								<div class="form-horizontal">
									<div class="panel-body">
											<div class="col-sm-12">
												<div class="form-group" style="background-color: #bfffb1;padding: 5px;font-size: 13px;">
													<label class="col-sm-6 control-label" for="ratevalue"><b>Range Price List Base On</b></label>
													<div class="col-sm-4">
														<center>
															<input type="radio" name="price_list_base_on" id="pricelist__price_list_base_on_rate" checked="checked" value="rate" onclick="show_parameter_base_on_ratevalue()" style="width: 20px;height: 20px;vertical-align: bottom;"> 
																<b>Rate</b> &nbsp;&nbsp;&nbsp;
															<input type="radio" name="price_list_base_on" id="pricelist__price_list_base_on_profit" value="profit" style="width: 20px;height: 20px;vertical-align: bottom;" onclick="show_parameter_base_on_profit()"> 
																<b>Profit (%)</b>
														</center>
													</div>
												</div>
											</div>
											<div class="col-sm-12 group__rate_range" style="display: block;">
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-sm-7 control-label" for="ratevalue">From Rate</label>
															<div class="col-sm-4">
																<input type="text" name="start_ratevalue" class="form-control input-sm input-editable-pricelist" id="pricelist__start_ratevalue" value="10000" required="required">
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-sm-7 control-label" for="ratevalue">To Rate</label>
															<div class="col-sm-4">
																<input type="text" name="end_ratevalue" class="form-control input-sm input-editable-pricelist" id="pricelist__end_ratevalue" value="11000" required="required">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-sm-7 control-label" for="range_ratevalue">Range</label>
															<div class="col-sm-4">
																<input type="text" name="range_ratevalue" class="form-control input-sm input-editable-pricelist" id="pricelist__range_ratevalue" value="500" required="required">
															</div>
														</div>
													</div>
												</div>
											</div>
											
											<div class="col-sm-12 group__profit_range" style="display: none;">
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-sm-7 control-label" for="ratevalue">From Profit (%)</label>
															<div class="col-sm-4">
																<input type="text" name="start_profit" class="form-control input-sm input-editable-pricelist" id="pricelist__start_profit" value="21" required="required">
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-sm-7 control-label" for="ratevalue">To Profit (%)</label>
															<div class="col-sm-4">
																<input type="text" name="end_profit" class="form-control input-sm input-editable-pricelist" id="pricelist__end_profit" value="25" required="required">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-sm-7 control-label" for="range_ratevalue">Range</label>
															<div class="col-sm-4">
																<input type="text" name="range_profit" class="form-control input-sm input-editable-pricelist" id="pricelist__range_profit" value="1" required="required">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													
												</div>
											</div>
											
											<div class="col-sm-12">
												<div class="row">
													<div class="col-sm-6 group__profit_range" style="display: none;">
														<div class="form-group">
															<label class="col-sm-7 control-label" for="profit_percentage"><b style="color: #f0a636;">Rate Value</b></label>
															<div class="col-sm-4">
																<input type="text" name="ratevalue" class="form-control input-sm" id="pricelist__ratevalue" value="10000" required="required" style="background-color: #ffdeab;border: 1px solid #f7b046;">
															</div>
														</div>
													</div>
													
													<div class="col-sm-6 group__rate_range" style="display: block;">
														<div class="form-group">
															<label class="col-sm-7 control-label" for="profit_percentage"><b style="color: #f0a636;">Profit (%)</b></label>
															<div class="col-sm-4">
																<input type="text" name="profit_percentage" class="form-control input-sm" id="pricelist__profit_percentage" value="25" required="required" style="background-color: #ffdeab;border: 1px solid #f7b046;">
															</div>
														</div>
													</div>
													
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-sm-7 control-label" for="pricelist__picklist_mark_up">Picklist MarkUp</label>
															<div class="col-sm-4">
																<input type="text" name="picklist_mark_up" class="form-control input-sm" id="pricelist__picklist_mark_up" value="1.1">
															</div>
														</div>
													</div>
												</div>
											</div>	
											
											<div class="col-sm-12">
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-sm-7 control-label" for="port_origin_cost">Port Origin Cost (%)</label>
															<div class="col-sm-4">
																<input type="text" name="port_origin_cost" class="form-control input-sm" id="pricelist__port_origin_cost" value="1.45">
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-sm-7 control-label" for="fixed_cost">Fixed Cost (%)</label>
															<div class="col-sm-4">
																<input type="hidden" name="target_price" class="form-control input-sm input-editable-pricelist" 
																id="pricelist__target_price" value="" required="required" style="background-color: #b9deff;border: 1px solid #579ddb;">
																
																<input type="text" name="fixed_cost" class="form-control input-sm" id="pricelist__fixed_cost" value="9">
															</div>
														</div>
													</div>
												</div>	
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label class="col-sm-7 control-label" for="variable_cost">Variable Cost (%)</label>
															<div class="col-sm-4">
																<input type="text" name="variable_cost" class="form-control input-sm" id="pricelist__variable_cost" value="9">
															</div>
														</div>
													</div>
													<div class="col-sm-6">	
														<div class="form-group">
															<label class="col-sm-7 control-label" for=""picklist_ratevalue"">Picklist Rate</label>
															<div class="col-sm-4">
																<input type="text" name="picklist_ratevalue" class="form-control input-sm" id="pricelist__picklist_ratevalue" value="12000" required="required">
															</div>
														</div>
													</div>
												</div>
											</div>	
											
								
										</div>
								</div>
							</fieldset>
					</div>
					
					<div class="col-sm-5">
						<fieldset>
    						<legend style="margin-bottom: 0px;text-align: center;">Filter Data</legend>
								<div class="form-horizontal">
										<div class="panel-body">
											<div class="form-group">
												<label class="col-sm-3 control-label" for="demo-is-inputsmall">Specific Model</label>
												<div class="col-sm-9">
													
														<select id="model_codes" class="model-code" multiple="multiple" style="display: none;">
															<?php
																$base_url = base_url();
																$image_url = "";
																foreach ( $list_model as $result ) {
																	//$image_url = $base_url . "/files/" . $result->filename;
																	//$image_url = file_exists($image_url)? $image_url : "";
																	//echo "<option value='" . $result->modelcode . "' label='" .$result->modelcode. "' image='". $image_url ."'>" . $result->modelcode . "</option>";
																	echo "<option value='" . $result->modelcode . "' label='" .$result->modelcode. "' >" . $result->modelcode . "</option>";
																}
																//model.no as modelcode,
																//model.custcode,
																//model.description,
																//model.filename,
																//customer.name customername
															?>
														</select>
														
														<script type="text/javascript">
															$(document).ready(function() {
																function formatSelection(state) {
																    var label = $(state.element).attr("label");
																    if( label == ""){
																		return state.text;     
																	}   
																	return label;
																}
																function formatResult (state) {
																	  //return $('<span><img src="' + $(state.element).attr("image") + '" style="max-width: 30px;" /> ' + state.text + '</span>');
																	return $('<span>' + state.text + '</span>');
																};
																
																$("#model_codes").select2({
																	closeOnSelect : false,
																	placeholder : "select models...",
																	templateResult: formatResult,
																	templateSelection: formatSelection,
																	allowHtml: true,
																	allowClear: true,
																	//tags: true
																});

															});
														</script>
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-3 control-label" for="demo-is-inputsmall">Model Code</label>
												<div class="col-sm-9">
													<input class="form-control input-sm" id="code_search" type="text" onkeypress="if(event.keyCode==13){costing_pricelist_search(0)}" placeholder="separate by coma (ex: BS,DT)">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" for="demo-is-inputsmall">Customer Code</label>
												<div class="col-sm-9">
													<input class="form-control input-sm" type="text" name="custcode_search" id="custcode_search" onkeypress="if(event.keyCode==13){costing_pricelist_search(0)}" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" for="demo-is-inputsmall">Customer</label>
												<div class="col-sm-9">
													<select class="form-control input-sm" id="customerid_search" onchange="costing_pricelist_search(0)">
														<option value="0"></option>
										                <?php
															foreach ( $customer as $result ) {
																echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
															}
														?>
										            </select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" for="datefrom">Date From</label>
												<div class="col-sm-4">
													<input type="date" name="datefrom" id="datefrom" class="form-control input-sm" />
												</div>
												<label class="col-sm-1 control-label" for="dateto">To</label>
												<div class="col-sm-4">
													<input type="date" name="dateto" id="dateto" class="form-control input-sm" />
												</div>
											</div>
					                        <div class="form-group">
					                        	<label class="col-sm-3 control-label" for="datefrom">Due 1 Year</label>
												<div class="col-sm-4">
								                      <input type="checkbox" style="width: 20px;height: 25px;" id="is_over_due" name="is_over_due" value="true">
												</div>
					                        </div>
										</div>
								</div>
							</fieldset>	
					</div>
					
				</div>
				
				<div class="row" style="margin-top: 0px;width: 100%;">
					<div class="col-sm-offset-2 col-sm-8">
						<div class="panel-body">
							<div class="form-group col-sm-6" style="padding-right: 20px">
								<button class="btn btn-md btn-primary pull-right" onclick="costing_pricelist_search(0)">
									<i class="fa fa-search"></i> View Price List
								</button>
							</div>
							<div class="form-group col-sm-6" style="padding-left: 20px">
								<button class="btn btn-md btn-warning pull-left" onclick="costing_pricelist_search_then_print_summary(0)">
									<i class="fa fa-print"></i> Print Price List
								</button>
							</div>
						</div>
					</div>
				</div>
				
				<div id="datacosting_pricelist" class="row" style="width: 100%;padding: 20px;">
					<?php //$this->load->view('costing_pricelist/search'); ?>
			    </div>
			    
			    
			</div>
		</div>
	<script src="<?php echo $base_url ?>assets/vendors/nifty/js/bootstrap.min.js"></script>
	<script src="<?php echo $base_url ?>assets/vendors/fast-click/fastclick.min.js"></script>
	<script src="<?php echo $base_url ?>assets/vendors/nifty/js/nifty.min.js"></script>
	<script src="<?php echo $base_url ?>assets/vendors/morris-js/morris.min.js"></script>
	<script src="<?php echo $base_url ?>assets/vendors/morris-js/raphael-js/raphael.min.js"></script>
	<script src="<?php echo $base_url ?>assets/vendors/sparkline/jquery.sparkline.min.js"></script>
	<script src="<?php echo $base_url ?>assets/vendors/skycons/skycons.min.js"></script>
	<script src="<?php echo $base_url ?>assets/vendors/switchery/switchery.min.js"></script>
	<script src="<?php echo $base_url ?>assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="<?php echo $base_url ?>assets/vendors/bootbox/bootbox4.min.js"></script>
	<script src="<?php echo $base_url ?>assets/vendors/data-table/3/datatables.min.js"></script>
	<script src="<?php echo $base_url ?>assets/vendors/data-table/3/jquery.dataTables.min.js"></script>
	<script src="<?php echo $base_url ?>assets/vendors/data-table/3/dataTables.fixedColumns.js"></script>
	<script src="<?php echo $base_url ?>assets/vendors/select22/select2.js"></script>
	<script src="<?php echo $base_url ?>assets/vendors/parsley/parsley.min.js"></script>
	<script src="<?php echo $base_url ?>assets/js/app.js"></script>
	<script src="<?php echo $base_url ?>assets/js/Client.js"></script>
	<script src="<?php echo $base_url ?>js/global.js"></script>
</body>
</html>