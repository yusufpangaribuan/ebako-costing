<div style="width: 400px">
    <form id="model_latherinlay_edit_form">
        <table width="100%" class="table_form">
            <tr>
                <td align="right" width="25%"><span class="labelelement">Item :</span></td>
                <td width="75%">                    
                    <input type="hidden" value="<?php echo $latherinlay->id ?>" id="id" name="id" />
                    <input type="hidden" value="<?php echo $modelid ?>" id="modelid_" />             
                    <input type="text" name="description" id="description0" value="<?php echo $latherinlay->descriptions ?>" style="width: 90%"/>
                    <input type="hidden" name="itemid" id="itemid0" value="<?php echo $latherinlay->itemid ?>"/>
                    <img src="images/list.png" onclick="item_listSearch2(0)" class="miniaction"/>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Unit :</span></td>
                <td>
                    <select id="unitid0" name="unitid" style="width: 100px">          
                        <option value="<?php echo $latherinlay->unitid ?>"><?php echo $latherinlay->codes ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Thickness :</span></td>
                <td><input type="text" size="4" id="thickness" name="thickness" style="text-align: center;width: 100px;"  value="<?php echo $latherinlay->thickness ?>"/></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Length :</span></td>
                <td><input type="text" size="4" id="length" name="length" style="text-align: center;width: 100px;"  value="<?php echo $latherinlay->length ?>"/></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Width :</span></td>
                <td><input type="text" size="4" id="width" name="width" style="text-align: center;width: 100px"  value="<?php echo $latherinlay->width ?>"/></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Qty :</span></td>
                <td><input type="text" size="4" id="qty" name="qty" style="text-align: center;width: 100px" value="<?php echo $latherinlay->qty ?>"/></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Location :</span></td>
                <td><input type="text" id="location" name="location" value="<?php echo $latherinlay->location ?>" style="width: 100%"/></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Specifications :</span></td>
                <td><input type="text" id="specifications" name="specifications" value="<?php echo $latherinlay->specifications ?>" style="width: 100%"/></td>
            </tr>
        </table>
        </table>
    </form>
</div>