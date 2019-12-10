<div style="width: 450px">
    <table width="100%" border="0" class="table_form">
        <tr>
            <td align="right" width="30%"><span class="labelelement"><span style="color: red;">*&nbsp;</span> Item</span></td>
            <td style="width: 2%;"></td>
            <td width="70%">
                <input type="hidden" value="<?php echo $modelid ?>" id="modelid_" />             
                <input type="text" name="description" id="description0" style="width: 90%"  readonly="readonly"/>
                <input type="hidden" name="itemid" id="itemid0"/>
                <img src="images/list.png" onclick="item_listSearch(0)" class="miniaction"/>
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement"><span style="color: red;">*&nbsp;</span> Unit</span></td>
            <td></td>
            <td>
                <select id="unitid0" name="unitid" style="width: 150px">                
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Thickness</span></td>
            <td></td>
            <td><input type="text" size="4" id="thickness" name="thickness" style="text-align: center" /></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Length</span></td>
            <td></td>
            <td><input type="text" size="4" id="length" name="length" style="text-align: center" /></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Width</span></td>
            <td></td>
            <td><input type="text" size="4" id="width" name="width" style="text-align: center" /></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement"><span style="color: red;">*&nbsp;</span> Qty</span></td>
            <td></td>
            <td><input type="text" size="4" id="qty" name="qty" style="text-align: center" /></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Location</span></td>
            <td></td>
            <td><input type="text" id="location" name="location" style="width: 85%"/></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Specifications</span></td>
            <td></td>
            <td><input type="text" id="specifications" name="specifications" style="width: 85%"/></td>
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
    </table>
</div>