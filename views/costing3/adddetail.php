<div class="col-sm-12">
		<input id="costingid" type="hidden" value="<?php echo $costingid ?>" />
    	<input id="categoryid" type="hidden" value="<?php echo $category ?>" />
		<table class="table table-responsive-sm table-bordered table-striped table-hover table-outline mb-0">
		    <thead class="thead-light" style="background: #f9f9f9 !important;">
		        <tr style="border-top: 4px solid #ec9821;">
		            <th width="10%">Material Code</th>
                	<th width="20%">Material Description</th>
	                <th width="5%">UOM</th>
	                <th width="10%">QTY<br/>based on BOM</th>
	                <th width="5%">Yield</th>
	                <th width="10%">Allowance</th>
	                <th width="10%">REQ'D<br/>QTY</th> 
	                <th width="15%">UNIT PRICE<br/>(RP)</th>
	                <th width="15%">UNIT PRICE<br/>(US$)</th>
		        </tr>
			</thead>
			<tbody>
	            <tr>
	                <td>
	                    <input type="text" style="width: 100%" id="materialcode" autofocus="autofocus" onkeypress="if(event.keyCode==13){costing_savedetail()}"/> 
	                    <script type="text/javascript" language="JavaScript">
	                        $('#materialcode').focus();
	                    </script>
	                </td>
	                <td><textarea style="width: 100%" id="materialdescription" onkeypress="if(event.keyCode==13){costing_savedetail()}"></textarea></td>
	                <td>
	                    <select type="text" style="width: 100%;"id="uom">
	                        <option value=""></option>
	                        <?php
	                        foreach ($unit as $result) {
	                            echo "<option value='" . $result->codes . "'>" . $result->codes . "</option>";
	                        }
	                        ?>
	                    </select>
	                </td>
	                <td><input type="text" style="width: 100%;text-align: center;" id="qty" onkeypress="if(event.keyCode==13){costing_savedetail()}"/></td>
	                <td><input type="text" style="width: 100%;text-align: center;" id="yield" onkeypress="if(event.keyCode==13){costing_savedetail()}"/></td>
	                <td><input type="text" style="width: 100%;text-align: center;" id="allowance" onkeypress="if(event.keyCode==13){costing_savedetail()}"/></td>
	                <td><input type="text" style="width: 100%;text-align: center;" id="req_qty" onkeypress="if(event.keyCode==13){costing_savedetail()}"/></td>
	                <td><input type="text" style="width: 100%;text-align: right;" id="unitpricerp" onkeypress="if(event.keyCode==13){costing_savedetail()}"/></td>  
	                <td><input type="text" style="width: 100%;text-align: right;" id="unitpriceusd" onkeypress="if(event.keyCode==13){costing_savedetail()}"/><input type="hidden" style="width: 100%;text-align: right;" id="totalamount"/></td>
	                
	                
	            </tr>        
        </tbody>
    </table>
    <br/>
    <center>
        <button type="button" class="btn btn-md btn-success" onclick="costing_savedetail()">Save</button>
        <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">Cancel</button>
    </center>
    <br/>
</div>