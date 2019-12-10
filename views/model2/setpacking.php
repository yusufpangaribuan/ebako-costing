<div style="width: 400px">
    <table width="100%">
        <tr>
            <td align="right" width="25%"><span class="labelelement">Item :</span></td>
            <td width="75%">
                <input type="hidden" id="type" style="text-transform: uppercase"/>
                <input type="hidden" value="<?php echo $modelid ?>" id="modelid_" />             
                <input type="text" name="description0" id="description0" style="width: 90%"/>
                <input type="hidden" name="itemid" id="itemid0"/>
                <img src="images/list.png" onclick="item_listSearch(0)" class="miniaction"/>
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Unit :</span></td>
            <td>
                <select id="unitid0" style="width: 100px">                
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Width :</span></td>
            <td><input type="text" size="4" id="width" style="text-align: center;width: 100px;" /></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Depth :</span></td>
            <td><input type="text" size="4" id="depth" style="text-align: center;width: 100px;" /></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Height :</span></td>
            <td><input type="text" size="4" id="height" style="text-align: center;width: 100px;" /></td>
        </tr>

        <tr>
            <td align="right"><span class="labelelement">Qty :</span></td>
            <td><input type="text" size="4" id="qty" style="text-align: center;width: 100px;" /></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Location :</span></td>
            <td><input type="text" id="location" style="width: 100%"/></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Specifications :</span></td>
            <td><input type="text" id="specifications" style="width: 100%"/></td>
        </tr>
<!--        <tr>
            <td>&nbsp;</td>
            <td><button onclick="model_savepacking()">Save</button></td>
        </tr>-->
    </table>
</div>