<div style="width: 400px">
    <form id="model_packing_edit_form">
        <table width="100%" class="table_form" border="0">
            <tr>
                <td align="right" width="25%"><span class="labelelement">Item :</span></td>
                <td width="75%">
                    <input type="hidden" value="<?php echo $packing->id ?>" id="id" name="id" />
                    <input type="hidden" id="type" name="type" style="text-transform: uppercase"/>
                    <input type="hidden" value="<?php echo $modelid ?>" id="modelid_" />             
                    <input type="text" name="description" id="description0" value="<?php echo $packing->descriptions ?>" style="width: 90%"/>
                    <input type="hidden" name="itemid" id="itemid0" value="<?php echo $packing->itemid ?>"/>
                    <img src="images/list.png" onclick="item_listSearch2(0)" class="miniaction"/>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Unit :</span></td>
                <td>
                    <select id="unitid0" name="unitid" style="width: 100px">          
                        <option value="<?php echo $packing->unitid ?>"><?php echo $packing->unitcode ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Width :</span></td>
                <td><input type="text" size="4" id="width" name="width" value="<?php echo $packing->width ?>" style="text-align: center" /></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Depth :</span></td>
                <td><input type="text" size="4" id="depth" name="depth" value="<?php echo $packing->depth ?>" style="text-align: center" /></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Height :</span></td>
                <td><input type="text" size="4" id="height" name="height" value="<?php echo $packing->height ?>" style="text-align: center" /></td>
            </tr>

            <tr>
                <td align="right"><span class="labelelement">Qty :</span></td>
                <td><input type="text" size="4" id="qty" name="qty" style="text-align: center" value="<?php echo $packing->qty ?>"  /></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Location :</span></td>
                <td><input type="text" id="location" name="location" style="width: 100%" value="<?php echo $packing->location ?>"  style=""/></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Specifications :</span></td>
                <td><input type="text" id="specifications" name="specifications"  value="<?php echo $packing->specifications ?>" style="width: 100%" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <button type="button" onclick="model_updatepacking(<?php echo $modelid ?>)">Save</button>
       			 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </td>
            </tr>
        </table>
    </form>
</div>