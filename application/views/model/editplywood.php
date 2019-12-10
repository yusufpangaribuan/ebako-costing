<div style="width: 400px">
    <form id="model_plywood_edit_form">
        <table width="100%">
            <tr>
                <td align="right"><span class="labelelement">Item :</span></td>
                <td>
                    <input type="hidden" value="<?php echo $plywood->id ?>" id="id" name="id"/> 
                    <input type="hidden" value="<?php echo $modelid ?>" id="modelid_" name="modelid"/>             
	                <input type="text" name="description" id="description0" style="width: 90%" value="<?php echo $plywood->descriptions ?>"/>
	                <input type="hidden" name="itemid" id="itemid0" value="<?php echo $plywood->itemid ?>"/>
	                <img src="images/list.png" onclick="item_listSearch(0)" class="miniaction"/>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Unit :</span></td>
                <td>
                    <select id="unitid77" name="unitid" style="width: 200px">  
                        <option value="<?php echo $plywood->unitid ?>"><?php echo $plywood->codes ?></option>
                    </select>
                </td>
            </tr>   
	        <tr>
	            <td align="right"><span class="labelelement">Yield :</span></td>
	            <td><input type="text" size="4" id="yield" name="yield" style="text-align: center" value="<?php echo $plywood->yield ?>" onchange="calculateRequirement()"/></td>
	        </tr>
	        <tr>
	            <td align="right"><span class="labelelement">Cutting List :</span></td>
	            <td><input type="text" size="4" id="cutting_list" name="cutting_list" style="text-align: center" value="<?php echo $plywood->cutting_list ?>"  onchange="calculateRequirement()"/></td>
	        </tr>
	        <tr>
	            <td align="right"><span class="labelelement">Requirement :</span></td>
	            <td><input type="text" size="4" id="qty" name="qty" style="text-align: center" value="<?php echo $plywood->qty ?>" /></td>
	        </tr>
	        <tr>
	            <td align="right"><span class="labelelement">Location :</span></td>
	            <td><input type="text" style="width: 90%" id="location" name="location" style="text-align: center" value="<?php echo $plywood->location ?>" /></td>
	        </tr>
	        <tr>
	            <td align="right"><span class="labelelement">Specification :</span></td>
	            <td><input type="text" style="width: 90%" id="specifications" name="specifications" style="text-align: center" value="<?php echo $plywood->specifications ?>" /></td>
	        </tr>
        </table>
    </form>
</div>
<script type="text/javascript">
	function calculateRequirement(){
    	var yield = parseFloat( $("#yield").val() || 0 ) ;
    	var cutting_list = parseFloat( $("#cutting_list").val() || 0 );
     	var requirement = parseFloat( cutting_list / yield || 0);//.toFixed(3);
     	console.log("requirement", requirement);
    	$("#qty").val( requirement );
	}
</script>