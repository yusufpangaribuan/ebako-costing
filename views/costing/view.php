<style>
	.DTFC_LeftBodyWrapper table.dataTable.stripe tbody tr {
	    background-color: #fbfafa;
	}
	
	.DTFC_LeftBodyWrapper table.dataTable.stripe tbody tr.odd {
	    background-color: #efecec;
	}
	
	.DTFC_RightBodyWrapper table.dataTable.stripe tbody tr {
	    background-color: #fbfafa;
	}
	
	.DTFC_RightBodyWrapper table.dataTable.stripe tbody tr.odd {
	    background-color: #efecec;
	}
</style>

<script src="<?php echo base_url() ?>js/costing.js"></script>
<script src="<?php echo base_url() ?>js/model.js"></script>

					<div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title">List Costing</h3>
					    </div>
					
					    <div class="panel-body" id="menu_content_costing">
					        
					        <?php if( $total_over_due >= 0 ){
					        		if (in_array('view_over_due_alert', $accessmenu)) {	
					        	?>
					        <div class="row" style="padding-bottom: 20px;">
							    <div class="col-sm-6 col-lg-3">
									<div class="panel media pad-all" style="background-color: #ff990029;cursor: pointer;" onclick="costing_search_over_due()">
							            <div class="media-left">
							                <span class="icon-wrap icon-wrap-sm icon-circle bg-warning">
							                <i class="fa fa-picture-o"></i>
							                </span>
							            </div>
							            <div class="media-body">
							                <p class="text-2x mar-no text-thin" style="font-weight: bold;">
							                	<?php echo @$total_over_due; ?> <span style="font-size: 0.8em; font-weight: normal;"> Costing </span> 
							                </p>
							                <p class="text-muted mar-no" style="color: #000;">Due in 1 Year</p>
							            </div>
							            <br>
							            <div class="progress progress-striped active" style="margin-bottom: 0;"><div style="width: 100%;" class="progress-bar progress-bar-warning"></div></div>
							        </div>
							    </div>
							</div>
							<?php }
					        }?>
					        
				            <div class="row">
				                <div class="col-sm-6 table-toolbar-left">
				                    <?php
						                if (in_array('add', $accessmenu)) {
						                	echo '<button class="btn btn-labeled fa fa-plus btn-success" onclick="costing_createnew()" id="demo-btn-addrow">Create New</button>';
						                }
						            ?>
				                </div>
				                
				                <div class="col-sm-6 table-toolbar-right">
				                    <?php
						                if (in_array('view_price_list', $accessmenu)) {
						                	echo '<a href="costing_pricelist/view_pricelist" target="blank"><button class="btn btn-labeled fa fa-search btn-primary"> View Price List</button> </a>';
											echo '<a href="costing_pricereview/view_pricereview" target="blank"><button class="btn btn-labeled fa fa-search btn-primary"> Costing Price Review</button> </a><br/>';
											echo '<a href="costing_review/show_list" target="blank"><button class="btn btn-labeled fa fa-search btn-primary"> View Price Review</button> </a><br/>';
						                }
						            ?>
				                </div>
				                
				            </div>
					        
					        <div class="row" style="">
								<div class="col-sm-12">
					                <div id="costing_filter" role="tablist">
					                      <div class="">
					                        <div class="" id="headingOne" role="tab">
					                          <p>
						                          <h4>
						                            <i class="fa fa-search"></i> Filter</a>
						                          </h4>
					                          </p>
					                        </div>
					                        <div class="card" id="collapseOne" style="background-color: #fff;">
					                          <div class="card-body">
							                    <div class="row">
							                      <div class="form-group col-sm-2">
							                        <div class="form-group">
							                          <label for="code_search">Model Code</label>
							                          <input class="form-control" id="code_search" style="background-color: #f5faff; border: 1px solid #579ddb;" type="text" size="10" onkeypress="if(event.keyCode==13){costing_search(0)}">
							                        </div>
							                      </div>
							                      <div class="form-group col-sm-2">
							                      	<label for="custcode_search">Cust. Code</label>
							                        <input class="form-control" type="text" size="10" name="custcode_search" id="custcode_search" style="background-color: #f5faff; border: 1px solid #579ddb;" onkeypress="if(event.keyCode==13){costing_search(0)}"/>
							                      </div>
							                      
							                      <div class="form-group col-sm-3">
							                        <label for="customerid_search">Customer</label>
							                        <select class="form-control" id="customerid_search" onchange="costing_search(0)" style="background-color: #f5faff; border: 1px solid #579ddb;">
										                <option value="0"></option>
										                <?php
										                foreach ($customer as $result) {
										                    echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
										                }
										                ?>
										            </select>
							                      </div>
							                      <div class="form-group col-sm-2">
							                        <label for="ccmonth">Date From</label>
							                        <input type="date" name="datefrom" id="datefrom" class="form-control" style="background-color: #f5faff; border: 1px solid #579ddb;"/>
							                      </div>
							                      <div class="form-group col-sm-2">
							                        <label for="dateto">To</label>
							                        <input type="date" name="dateto" id="dateto" class="form-control" style="background-color: #f5faff; border: 1px solid #579ddb;"/>
							                      </div>
							                      <div class="form-group col-sm-1">
							                          <label for="code_search" style="width: 100%;">Due 1 Year</label>
								                      <input type="checkbox" style="width: 20px;height: 25px;" id="is_over_due" name="is_over_due" value="true">
							                      </div>
							                    </div>
							                    
							                    <div class="row">
								                    <div class=" col-sm-6">
								                    	<button style="margin-right: 20px;" class="btn btn-sm btn-primary pull-left" onclick="costing_search(0)">
									                      <i class="fa fa-search"></i> Search
									                    </button>
									                    <button class="btn btn-sm btn-warning pull-left" onclick="costing_search_then_print_summary(0)">
									                      <i class="fa fa-print"></i> Print Summary
									                    </button>
								                    </div>
							                    </div>
							                    
							                  </div>
					                            
					                        </div>
					                      </div>
					                    </div>
					              </div>
							
						    </div>
					        
					        <br/>
					        
				        	<div id="datacosting" class="row">
								<?php $this->load->view('costing/search'); ?>
						    </div>
							    
					    </div>
					</div>
