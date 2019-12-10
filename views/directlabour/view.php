<script src="<?php echo base_url() ?>js/directlabour.js"></script>

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Direct Labor</h3>
    </div>

    <div class="panel-body" id="menu_directlabour">
        <div class="pad-btm form-inline">
            <div class="row">
                <div class="col-sm-6 table-toolbar-left">
                    <span class="labelelement">Description</span>
                    <input type="text" id="description_s" name="description" onkeypress="if(event.keyCode==13){directlabour_search(0)}" />
			        <button onclick="directlabour_search(0)">Search</button>
			        <?php
			        	if (in_array('add', $accessmenu)) {
			            	echo "<button onclick ='directlabour_add()'>Add</button>";
			        	}
			        ?>
	                </div>
	            </div>
	    </div>
	    
	    <?php if (in_array('edit', $accessmenu)) {?>
	    <div class="row" style="">
			<div class="col-sm-7">
                <div id="accordion" role="tablist">
                      <div class="">
                        <div class="" id="headingOne" role="tab">
                          <p>
                          <h4 class="mb-0">
                            <a data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsed" style="background-color: #f0a636;padding: 5px;">
                            	<i class="fa fa-plus"></i> Update Price Base On UMK
                            </a>
                          </h4>
                          </p>
                        </div>
                        <div class="card collapse" id="collapseOne" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" style="">
                          <div class="card-body">
		                    
		                    <div class="row">
		                    	<div class="col-sm-12 table-toolbar-left">
				                    <span class="labelelement">UMK</span>
				                    <input type="text" id="umk" name="umk" onchange="calculateLabour()"/>
				                    
				                    <span class="labelelement">/ (hour)</span>
				                    <input type="text" id="hour" name="hour" size="3" value="120" onchange="calculateLabour()"/>
				                    
				                    <span class="labelelement"> = </span>
				                    <input type="text" id="labour" name="labour" readonly="readonly" />
				                    
				                    <button class="btn btn-md btn-primary pull-right" onclick="updateLabour()">
				                      <i class="fa fa-search"></i> Update Labour
				                    </button>
		                        </div>
		                    </div>
		                  </div>
                            
                        </div>
                      </div>
                    </div>
              </div>
		
	    </div>
	    
	    <?php }?>
	    
        <div id="groupsdata" class="row">
				<?php $this->load->view('directlabour/search') ?>
	    </div>
		    
    </div>
</div>
			       
			       
<script type="text/javascript">
	function calculateLabour(){
    	var umk = parseFloat( $("#umk").val() || 0 );
		var hour = parseFloat( $("#hour").val() || 0 ) ;

        var labour = parseFloat( umk / hour).toFixed(3);
    	$("#labour").val( labour );
	}

	function updateLabour() {
	    Client.message.saving("Updating DirectLabour...");
	    
	    var labour = parseFloat( $("#labour").val() || 0 );
	    $.post(url + 'directlabour/updateLabourBaseOnUMK', {
	    	labour: labour,
	    }, function () {
	    	directlabour_view();
	    	Client.message.success("DirectLabour updated successfully ...");
	    })
	    
	}
</script> 

