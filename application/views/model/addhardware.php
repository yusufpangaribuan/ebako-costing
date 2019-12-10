<div style="width: 450px">
    <table width="100%">
        <tr>
            <td style="width: 30%" align="right"><span class="labelelement"><span style="color: red;">*&nbsp;</span> Item</span></td>
            <td style="width: 2%;"></td>
            <td style="width: 69%">
                <input type="hidden" value="<?php echo $modelid ?>" id="modelid_" />             
                <input type="text" name="description0" id="description77" style="width: 90%" readonly="readonly"/>
                <input type="hidden" name="itemid" id="itemid77"/>
                <img src="images/list.png" onclick="item_listSearch(77)" class="miniaction"/>
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement"><span style="color: red;">*&nbsp;</span> Unit</span></td>
            <td></td>
            <td>
                <select id="unitid77" style="width: 200px">                
                </select>
            </td>
        </tr>   
        <tr>
            <td align="right"><span class="labelelement">Type</span></td>
            <td></td>
            <td>
                <select id="hardwaretypeid" style="width: ">
                    <?php
                    foreach ($hardwaretype as $hardwaretype) {
                        if ($hardwaretype->id != 3) {
                            echo "<option value='" . $hardwaretype->id . "'>" . $hardwaretype->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement"><span style="color: red;">*&nbsp;</span> Qty</span></td>
            <td></td>
            <td><input type="text" name="itemqty" id="itemqty" size="7" style="text-align: center;"/></td>
        </tr>    

        <tr>
            <td align="right"><span class="labelelement">Location</span></td>
            <td></td>
            <td><input type="text" id="location" style="width: 200px;"/></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Supplier</span></td>
            <td></td>
            <td><input type="text" id="supplier" name="supplier" style="width: 200px;"/></td>
        </tr>
        <tr>
        	<td align="right"><span class="labelelement">Notes</span></td>
        	<td></td>
            <td>
            	<textarea id="notes" name="notes" style="width: 90%;height: 40px;"></textarea>
            </td>
        </tr>
        
       <tr>
	        <td align="right"><span class="labelelement"><span style="color: red;">*&nbsp;</span> Is Picklist Item?</span></td>
	        <td></td>
            <td>
                <select name="is_picklist" id="is_picklist_item_id">
                    <option value=f>No</option>
                    <option value=t>Yes</option>
                </select>
            </td>
        </tr>
        
      <tr>
            <td colspan="3">
            	<br/>
            	<center>
	                 <button type="button" onclick="model_inserthardware()" class="btn btn-success">Save</button>
	       			 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
       			 </center>
            </td>
        </tr>
    </table>

</div>