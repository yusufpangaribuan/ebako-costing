<script src="js/costing.js"></script>

<div class="card" id="menu_content_costing">
    <div class="card-body">
		<div class="row" style="margin-bottom: 40px">
			<div class="col-sm-5">
				<h4 class="card-title mb-0"><i class="nav-icon fa fa-money"></i> Costing</h4>
				<div class="small text-muted">Calculations</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-3">
			<?php
	            if ($this->session->userdata('department') == 9) {
	                if (in_array('add', $accessmenu)) {
	                	echo '<button class="btn btn-primary btn-md" onclick="costing_createnew()">Create New</button>';
	                }
	            }
	            ?>
			</div>
		</div>
		<div class="row" style="">
			<div class="col-sm-6">
                <div id="accordion" role="tablist">
                      <div class="">
                        <div class="" id="headingOne" role="tab">
                          <p>
                          <h5 class="mb-0">
                            <a data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                            <i class="fa fa-search"></i> Filter +</a>
                          </h5>
                          </p>
                        </div>
                        <div class="card collapse" id="collapseOne" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" style="">
                          <div class="card-body">
		                    <div class="row">
		                      <div class="col-sm-12">
		                        <div class="form-group">
		                          <label for="name">Name</label>
		                          <input class="form-control" id="code_search" type="text" size="10" onkeypress="if(event.keyCode==13){costing_search(0)}">
		                        </div>
		                      </div>
		                    </div>
		                    
		                    <div class="row">
		                      <div class="form-group col-sm-4">
		                        <label for="ccmonth">Cust.Code</label>
		                        <input class="form-control" type="text" size="10" name="custcode_search" id="custcode_search" onkeypress="if(event.keyCode==13){costing_search(0)}"/>
		                      </div>
		                      <div class="form-group col-sm-8">
		                        <label for="ccmonth">Customer</label>
		                        <select class="form-control" id="customerid_search" onchange="costing_search(0)">
					                <option value="0"></option>
					                <?php
					                foreach ($customer as $result) {
					                    echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
					                }
					                ?>
					            </select>
		                      </div>
		                    </div>
		                    
		                    <div class="row">
		                      <div class="form-group col-sm-6">
		                        <label for="ccmonth">Date From</label>
		                        <input type="date" size="10" name="datefrom" id="datefrom" class="form-control"/>
		                      </div>
		                      <div class="form-group col-sm-6">
		                        <label for="ccmonth">Date To</label>
		                        <input type="date" size="10" name="dateto" id="dateto" class="form-control"/>
		                      </div>
			                    <script type="text/javascript" >
// 					                $(function() {
// 					                    $("#datefrom").datepicker({
// 					                        dateFormat: "yy-mm-dd",
// 					                        changeMonth: true,
// 					                        changeYear:true
// 					                    }).focus(function() {
// 					                        $("#datefrom").datepicker("show");
// 					                    }); 
// 					                    $("#dateto").datepicker({
// 					                        dateFormat: "yy-mm-dd",
// 					                        changeMonth: true,
// 					                        changeYear:true
// 					                    }).focus(function() {
// 					                        $("#dateto").datepicker("show");
// 					                    });
// 					                });
					            </script>
		                    </div>
		                    
		                    <div class="row">
		                    	<div class="form-group col-sm-12">
			                    	<button class="btn btn-md btn-primary pull-right" onclick="costing_search(0)">
				                      <i class="fa fa-search"></i> Search
				                    </button>
			                    </div>
		                    </div>
		                    
		                  </div>
                            
                        </div>
                      </div>
                    </div>
              </div>
		
	    </div>
	    
	    <div id="datacosting" class="row">
			<?php $this->load->view('costing/search'); ?>
	    </div>
   	</div>	
</div>
