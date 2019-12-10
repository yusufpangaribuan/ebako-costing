<div style="width: 400px">
    <form id="model_marble_form_edit">
        <table width="100%" class="table_form">
            <tr>
                <td align="right" width="25%"><span class="labelelement">Type :</span></td>
                <td width="75%"><input type="text" id="type" name="type" style="text-transform: uppercase;width: 100%;" value="<?php echo $marble->type ?>"/></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Item :</span></td>
                <td>
                    <input type="hidden" value="<?php echo $marble->id ?>" name="id" />    
                    <input type="hidden" value="<?php echo $modelid ?>" id="modelid_" />             
                    <input type="text" name="description" id="description0"  value="<?php echo $marble->descriptions ?>" style="width: 80%;"/>
                    <input type="hidden" name="itemid" id="itemid0" value="<?php echo $marble->itemid ?>"/>
                    <img src="images/list.png" onclick="item_listSearch2(0)" class="miniaction"/>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Unit :</span></td>
                <td>
                    <select id="unitid0" name="unitid" style="width: 100px">            
                        <option value="<?php echo $marble->unitid ?>"><?php echo $marble->codes ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Thickness :</span></td>
                <td><input type="text" size="4" id="thickness" name="thickness" value="<?php echo $marble->thickness ?>" style="text-align: center;width: 100px" /></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Length :</span></td>
                <td><input type="text" size="4" id="length" name="length" value="<?php echo $marble->length ?>" style="text-align: center;width: 100px" /></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Width :</span></td>
                <td><input type="text" size="4" id="width" name="width" value="<?php echo $marble->width ?>" style="text-align: center;width: 100px" /></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Qty :</span></td>
                <td><input type="text" size="4" id="qty" name="qty" value="<?php echo $marble->qty ?>" style="text-align: center;width: 100px" /></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Location :</span></td>
                <td><input type="text" id="location" name="location" value="<?php echo $marble->location ?>"  style="text-transform: uppercase;width: 80%;"/></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Specifications :</span></td>
                <td><input type="text" id="specifications" name="specifications" value="<?php echo $marble->specifications ?>" style="text-transform: uppercase;width: 80%;"/></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><br/>
                    <button type="button" onclick="model_updatemarble(<?php echo $modelid ?>)">Save</button>
       			 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </td>
            </tr>
        </table>
    </form>
</div>