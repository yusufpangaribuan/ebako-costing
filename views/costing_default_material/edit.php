<form id="form_edit__costing_default_material">
        <table style="width: 100%">
            <tr>
                <td align="right">
                	<input type="hidden" name="id" value="<?php echo $costing_default_material->id;?>">
                	<span class="labelelement">Material Code :</span></td>
                <td><b><?php echo $costing_default_material->materialcode?></b> </td>
            </tr>            
            <tr>
                <td align="right"><span class="labelelement">Material Code :</span></td>
                <td><b><?php echo $costing_default_material->materialdescription?></b> </td>
            </tr>            
            <tr>
	            <td width="100" align="right"><span class="labelelement">UOM :</span></td>
	            <td>
	                <select id="form_edit__uom" name="uom" style="width: 100%">
	                    <option value="">--</option>
	                    <?php
			                foreach ($uoms as $uom) {
			                    echo "<option value='" . $uom->codes . "'>" . $uom->codes . " - " . $uom->names . "</option>";
			                }
		                ?>
	                </select>
	            </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Qty :</span></td>
                <td><input type="text" name="qty" id="qty" value="<?php echo $costing_default_material->qty;?>" onchange="calculateReqQty()" style="width: 70px"/></td>
            </tr>            
            <tr>
                <td align="right"><span class="labelelement">Yield :</span></td>
                <td><input type="text" name="yield" id="yield" value="<?php echo $costing_default_material->yield;?>" onchange="calculateReqQty()" style="width: 70px"/></td>
            </tr>            
            <tr>
                <td align="right"><span class="labelelement">Allowance :</span></td>
                <td><input type="text" name="allowance" id="allowance" value="<?php echo $costing_default_material->allowance;?>" onchange="calculateReqQty()" style="width: 70px"/></td>
            </tr>            
            <tr>
                <td align="right"><span class="labelelement">Req. Qty. :</span></td>
                <td><input type="text" name="req_qty" id="req_qty" value="<?php echo $costing_default_material->req_qty;?>" readonly="readonly" style="width: 70px;background-color: #c9eaa6;border: 1px solid #a5a5a5;"/></td>
            </tr>        
            
            <tr id="tr_unitprice" style="display: none;">
                <td align="right"><span class="labelelement">Item Price :</span></td>
                <td> &nbsp;&nbsp;
                	<input type="radio" id="curr_usd" name="curr" value="USD"> USD
                	<input type="radio" id="curr_rp" name="curr" value="Rp"> Rp &nbsp;&nbsp;	
                	<input type="text" name="price" id="price" style="width: 130px"/>
                </td>
            </tr>
                
        </table>
</form>

<script>
	function calculateReqQty(){
	   	var qty = parseFloat( $("#form_edit__costing_default_material #qty").val() || 0 ) ;
	   	var yield = parseFloat( $("#form_edit__costing_default_material #yield").val() || 0 ) ;
	   	var allowance = parseFloat( $("#form_edit__costing_default_material #allowance").val() || 0 ) ;
	   	
	   	var req_qty = 0 ;
	   	if( qty > 0 ){
			if( allowance > 0 ){
				req_qty = qty + ( allowance * qty );
			}else if( yield > 0 ){
				req_qty = qty / yield;
			}
	    }
	    
	   $("#form_edit__costing_default_material #req_qty").val( req_qty );
	}
	
	$(function () {
		$("#form_edit__uom").select2();
		$('#form_edit__uom').val( "<?php echo $costing_default_material->uom;?>" ).trigger('change.select2');

		$categoryid = "<?php echo @$costing_default_material->categoryid;?>";
		$curr = "<?php echo @$costing_default_material->curr;?>";
		$price = "<?php echo @$costing_default_material->price;?>";
		
		if( $categoryid == "6" ){
			$("#tr_unitprice").show();

			if( $curr == "USD" ){
				$("#curr_usd").prop("checked", true);
			}else{
				$("#curr_rp").prop("checked", true);
			}
			
			$("#price").val( $price );
		}
	});
</script>        