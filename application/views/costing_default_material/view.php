<script src="<?php echo base_url() ?>js/costing_default_material.js"></script>

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Costing Default Material</h3>
    </div>

    <div class="panel-body" id="menu_content_costing">
        <div class="pad-btm form-inline">
            <div class="row">
                <div class="col-sm-12 table-toolbar-left">
                    <span class="labelelement">Material Code </span>&nbsp;&nbsp; 
                    <input type="text" id="costing_default_material__materialcode" name="materialcode" onkeypress="if(event.keyCode==13){costing_default_material_search(0)}"/>                    
                    
                    <span class="labelelement">Material Description </span>&nbsp;&nbsp; 
                    <input type="text" id="costing_default_material__materialdescription" name="materialdescription" onkeypress="if(event.keyCode==13){costing_default_material_search(0)}"/>                    
                    
                    <span class="labelelement">Category </span>&nbsp;&nbsp;
                    <select name="categoryid" id="costing_default_material__categoryid" style="width: 100px" onchange="costing_default_material_search(0)">
		                <option value=""></option>
		                <?php
			                foreach ($listCostingCategory as $category) {
			                    echo "<option value='" . $category->id . "'>" . $category->name . "</option>";
			                }
		                ?>
		            </select>
                    
			        <button onclick="costing_default_material_search(0)">Search</button>
			        <?php
				        //if (in_array('add', $accessmenu)) {
				            echo "<button onclick = 'costing_default_material_add()'>Add</button>";
				        //}
			        ?>
                </div>
	                
	            </div>
	        </div>
        	<div id="groupsdata" class="row">
				<table id="table_costing_default_material" class="table table-striped table-bordered " cellspacing="0" width="100%">
		            <thead>
		                <tr>
		                    <th width="10">No</th>
		                    <th>Category</th>
		                    <th>Material Code</th>
		                    <th>Material Description</th>            
		                    <th>UOM</th>
		                    <th>Qty</th>
		                    <th>Yield</th>
		                    <th>Allowance</th>
		                    <th>Req. Qty</th>
		                    <th>Currency</th>
		                    <th>Price</th>
		                    <th style="width: 200px;text-align: center;">Action</th>
		                </tr>
		            </thead>
		            <tbody>
		                <?php
		                $number = 1;
		                foreach ($costing_default_material as $result) {
		                    ?>
		                    <tr>
		                        <td>&nbsp;<?php echo $number++ ?></td>
		                        <td>&nbsp;<?php echo $result->category_name ?></td>
		                        <td>&nbsp;<?php echo $result->materialcode ?></td>
		                        <td>&nbsp;<?php echo $result->materialdescription ?></td>
		                        <td>&nbsp;<?php echo $result->uom ?></td>
		                        <td align="right">&nbsp;<?php echo number_format($result->qty, 3, '.', ',') ?></td>
		                        <td align="right">&nbsp;<?php echo number_format($result->yield, 3, '.', ',') ?></td>
		                        <td align="right">&nbsp;<?php echo number_format($result->allowance, 3, '.', ',') ?></td>
		                        <td align="right">&nbsp;<?php echo number_format($result->req_qty, 3, '.', ',') ?></td>
		                        
		                        <td>&nbsp;<?php echo $result->curr ?></td>
		                        <td>&nbsp;<?php echo $result->price ?></td>
		                        
		                        <td align="center">
		                            <?php
		                            //if (in_array('edit', $accessmenu)) {
		                                echo "<a href='javascript:costing_default_material_edit($result->id)'><img class='miniaction' src='images/edit.png'>&nbsp;Edit&nbsp;</a>";
		                            //}if (in_array('delete', $accessmenu)) {
		                                echo "<a href='javascript:costing_default_material_delete($result->id)'><img class='miniaction' src='images/delete.png'>&nbsp;Delete&nbsp;</a>";
		                            //}
		                            ?>                            
		                        </td>
		                    </tr>
		                    <?php
		                }
		                ?>
		            </tbody>
		        </table> 
		        
		        <script type="text/javascript">
					$(document).ready(function() {
					    var table = $('#table_costing_default_material').DataTable( {
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
				
		    </div>
		    
    </div>
</div>
