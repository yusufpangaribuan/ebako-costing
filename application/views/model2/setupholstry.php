<div style="width: 400px">
    <table width="100%" border="0" class="table_form">
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
                <select id="unitid0" name="unitid" style="width: 150px">                
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Thickness :</span></td>
            <td><input type="text" size="4" id="thickness" name="thickness" style="text-align: center" /></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Length :</span></td>
            <td><input type="text" size="4" id="length" name="length" style="text-align: center" /></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Width :</span></td>
            <td><input type="text" size="4" id="width" name="width" style="text-align: center" /></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Qty :</span></td>
            <td><input type="text" size="4" id="qty" name="qty" style="text-align: center" /></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Location :</span></td>
            <td><input type="text" id="location" name="location" style="width: 85%"/></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Specifications :</span></td>
            <td><input type="text" id="specifications" name="specifications" style="width: 85%"/></td>
        </tr>
<!--        <tr>
            <td>&nbsp;</td>
            <td><br/>
                <button onclick="model_saveupholstry()">Save</button>
                <button onclick="$('#dialog2').dialog('close')">Cancel</button>
            </td>
        </tr>-->
    </table>
</div>