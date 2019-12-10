<script src="js/model.js"></script>

<div class="card" id="menu_content_model">
    <div class="card-body">
		<div class="row" style="margin-bottom: 40px">
			<div class="col-sm-5">
				<h4 class="card-title mb-0"><i class="nav-icon fa fa-abstract"></i> Model</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
                    <?php
                    if ($this->session->userdata('department') == 4) {
                        if (in_array('add', $accessmenu)) {
                            echo "<button onclick = 'model_create()'>Add</button>";
                        }
                        if (in_array('copy', $accessmenu)) {
                            echo "<button onclick = 'model_copy()'>Copy</button>";
                        }
                        if (in_array('view_cdss', $accessmenu)) {
                            echo "<button onclick = 'model_cdsprint()'>Cdss</button>";
                        }
                        if (in_array('view_cutting_list', $accessmenu)) {
                            echo "<button onclick = 'model_bom()'>Cutting List</button>";
                        }
                    }
                    ?>
			</div>
			<div class="col-sm-6">
				<?php
                if ($numberrequest > 0 && $this->session->userdata('department') == 4) {
                    ?>
                    <div style="font-size: 12px;margin: 5px;">
                        <a href="javascript:void(0)" style="color: #fa0202;" onclick="model_viewrequest()"><?php echo $numberrequest ?> Request for New Model</a>
                    </div>
                <?php } ?>
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
		                      <div class="form-group col-sm-4">
		                        <label for="ccmonth">Code</label>
		                        <input type="text" name="code_s" placeholder="Code" id="code_s" size="10" 
                    				onkeypress="if (event.keyCode == 13) {model_search(0); }"/>
		                      </div>
		                      <div class="form-group col-sm-8">
		                        <label for="ccmonth">Customer Code</label>
		                        <input type="text" name="custcode_s" placeholder="Customer Code" id="custcode_s" size="15" 
                    				onkeypress="if (event.keyCode == 13) { model_search(0)}"/>
		                      </div>
		                    </div>
		                    <div class="row">
		                      <div class="form-group col-sm-4">
		                        <label for="ccmonth">Description</label>
		                        <input type="text" placeholder="Description" name="description_s" id="description_s" size="15" 
                    				onkeypress="if (event.keyCode == 13) { model_search(0) }"/>
		                      </div>
		                      <div class="form-group col-sm-8">
		                        <label for="ccmonth">Type</label>
		                        <select id="modeltypeid_s" onchange="model_search(0)" style="width: 80px">
			                        <option value="0">Type</option>
			                        <?php
			                        foreach ($modeltype as $modeltype) {
			                            echo "<option value='" . $modeltype->id . "'>" . $modeltype->name . "</option>";
			                        }
			                        ?>
			                    </select>
		                      </div>
		                    </div>
		                    
		                    <div class="row">
		                    	<div class="form-group col-sm-12">
			                    	<button class="btn btn-md btn-primary pull-right" onclick="model_search(0)">
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
	    
	    <div id="modeldata" class="row">
			<?php $data['offset'] = $offset;
                 $this->load->view('model/search', $data);
            ?>
	    </div>
   	</div>	
</div>

<div style="height:50%;width: 100%;" id="modeldetail">

</div>