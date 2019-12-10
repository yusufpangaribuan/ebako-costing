<div style="width: 400px">
    <form id="model_glass_edit_form">
        <table width="100%" class="table_form">
            <tr>
                <td align="right" width="25%"><span class="labelelement">Item :</span></td>
                <td width="75%">
                    <input type="hidden" value="<?php echo $glass->id ?>" id="id" name="id" />
                    <input type="hidden" value="<?php echo $modelid ?>" id="modelid_" />             
                    <input type="text" name="description" id="description0" value="<?php echo $glass->descriptions ?>" style="width: 90%"/>
                    <input type="hidden" name="itemid" id="itemid0" value="<?php echo $glass->itemid ?>"/>
                    <img src="images/list.png" onclick="item_listSearch2(0)" class="miniaction"/>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Unit :</span></td>
                <td>
                    <select id="unitid0" name="unitid" style="width: 100px">          
                        <option value="<?php echo $glass->unitid ?>"><?php echo $glass->codes ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Thickness :</span></td>
                <td><input type="text" size="4" id="thickness" value="<?php echo $glass->thickness ?>" name="thickness" style="text-align: center" /></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Length :</span></td>
                <td><input type="text" size="4" id="length" value="<?php echo $glass->length ?>" name="length" style="text-align: center" /></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Width :</span></td>
                <td><input type="text" size="4" id="width" value="<?php echo $glass->width ?>" name="width" style="text-align: center" /></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Qty :</span></td>
                <td><input type="text" size="4" id="qty" value="<?php echo $glass->qty ?>"  name="qty" style="text-align: center" /></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Location</span></td>
                <td><input type="text" id="location" value="<?php echo $glass->location ?>" name="location" style="text-transform: uppercase;width: 90%"/></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Specifications</span></td>
                <td><input type="text" id="specifications" value="<?php echo $glass->specifications ?>" name="specifications" style="text-transform: uppercase;width: 90%"/></td>
            </tr>
           <tr>
                <td>&nbsp;</td>
                <td>
                    <button type="button" onclick="model_updateglass(<?php echo $modelid ?>)">Save</button>
       			 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </td>
            </tr>
        </table>
    </form>
</div>