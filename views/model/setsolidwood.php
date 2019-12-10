<div style="width: 400px">
    <table width="100%" class="table_form">
        <tr>
            <td align="right" width="25%"><span class="labelelement">Item :</span></td>
            <td width="75%">
                <input type="hidden" value="<?php echo $modelid ?>" id="modelid_" />             
                <input type="text" name="description" id="description0" style="width: 90%"/>
                <input type="hidden" name="itemid" id="itemid0"/>
                <img src="images/list.png" onclick="item_listSearch(0)" class="miniaction"/>
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Unit :</span></td>
            <td>
                <select id="unitid0" name="unitid" style="width: 100px">                
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Yield :</span></td>
            <td><input type="text" size="4" id="yield" name="yield" style="text-align: center" onchange="calculateRequirement()"/></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Cutting List :</span></td>
            <td><input type="text" size="4" id="cutting_list" name="cutting_list" style="text-align: center"  onchange="calculateRequirement()"/></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Requirement :</span></td>
            <td><input type="text" size="4" id="qty" name="qty" style="text-align: center" /></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Location :</span></td>
            <td><input type="text" style="width: 90%" id="location" name="location" style="text-align: center" /></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Specification :</span></td>
            <td><input type="text" style="width: 90%" id="specifications" name="specifications" style="text-align: center" /></td>
        </tr>
    </table>
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