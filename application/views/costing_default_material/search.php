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