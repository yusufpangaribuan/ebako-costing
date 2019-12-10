<script src="<?php echo base_url() ?>js/rate.js"></script>

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Rate</h3>
    </div>

    <div class="panel-body" id="menu_content_costing">
        <div class="pad-btm form-inline">
            <div class="row">
                <div class="col-sm-6 table-toolbar-left">
                    <span class="labelelement">Currency Code </span>&nbsp;&nbsp; <input type="text" id="currency" name="currency" onkeypress="if(event.keyCode==13){rate_search(0)}"/>                    
			        <button onclick="rate_search(0)">Search</button>
			        <?php
				        //if (in_array('add', $accessmenu)) {
				            echo "<button onclick = 'rate_add()'>Add</button>";
				        //}
			        ?>
                </div>
	                
	            </div>
	        </div>
        	<div id="groupsdata" class="row">
				<table id="table_rate" class="table table-striped table-bordered " cellspacing="0" width="100%">
		            <thead>
		                <tr>
		                    <th width="10">No</th>
		                    <th>Currency From</th>
		                    <th>Currency To</th>            
		                    <th>Value</th>
		                    <th style="width: 200px;text-align: center;">Action</th>
		                </tr>
		            </thead>
		            <tbody>
		                <?php
		                $number = 1;
		                foreach ($rate as $result) {
		                    ?>
		                    <tr>
		                        <td>&nbsp;<?php echo $number++ ?></td>
		                        <td>&nbsp;<?php echo $result->currency_from ?></td>
		                        <td>&nbsp;<?php echo $result->currency_to ?></td>
		                        <td align="right">&nbsp;<?php echo number_format($result->value, 2, '.', ',') ?></td>
		                        <td align="center">
		                            <?php
		                            //if (in_array('edit', $accessmenu)) {
		                                echo "<a href='javascript:rate_edit($result->id)'><img class='miniaction' src='images/edit.png'>&nbsp;Edit&nbsp;</a>";
		                            //}if (in_array('delete', $accessmenu)) {
		                                echo "<a href='javascript:rate_delete($result->id)'><img class='miniaction' src='images/delete.png'>&nbsp;Delete&nbsp;</a>";
		                            //}
		                            ?>                            
		                        </td>
		                    </tr>
		                    <?php
		                }
		                ?>
		            </tbody>
		        </table> 
		    </div>
		    
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
	    var table = $('#table_rate').DataTable( {
	        scrollY: "500px",
	        scrollX: true,
	        scrollCollapse: true,
	        paging: false,
	        ordering: false,
	        info: false,
	        searching: false,
	        autoWidth: true,
	    } );
	} );
</script>