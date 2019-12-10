<div style="width: 400px">
    <form id="form_edit_model_upholstry">
        <table width="100%" border="0" class="table_form">
            <tr>
                <td align="right" width="25%"><span class="labelelement">Item :</span></td>
                <td width="75%">
                    <input type="hidden" value="<?php echo $upholstery->id ?>" id="modelid_" name="id"/>       
                    <input type="hidden" value="<?php echo $modelid ?>" id="modelid_" />             
                    <input type="text" name="description" id="description0" style="width: 90%" value="<?php echo $upholstery->description ?>"/>
                    <input type="hidden" name="itemid" id="itemid0" value="<?php echo $upholstery->itemid ?>"/>
                    <img src="images/list.png" onclick="item_listSearch(0)" class="miniaction"/>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Unit :</span></td>
                <td>
                    <select id="unitid0" name="unitid" style="width: 150px">       
                        <option value="<?php echo $upholstery->unitid ?>"><?php echo $upholstery->unitcode ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Thickness :</span></td>
                <td><input type="text" size="4" id="thickness" name="thickness" style="text-align: center"  value="<?php echo $upholstery->thickness ?>"/></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Length :</span></td>
                <td><input type="text" size="4" id="length" name="length" style="text-align: center"  value="<?php echo $upholstery->length ?>"/></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Width :</span></td>
                <td><input type="text" size="4" id="width" name="width" style="text-align: center"  value="<?php echo $upholstery->width ?>"/></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Qty :</span></td>
                <td><input type="text" size="4" id="qty" name="qty" style="text-align: center"  value="<?php echo $upholstery->qty ?>" /></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Location :</span></td>
                <td><input type="text" id="location" name="location" style="width: 85%" value="<?php echo $upholstery->location ?>"/></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Specifications :</span></td>
                <td><input type="text" id="specifications" name="specifications" style="width: 85%" value="<?php echo $upholstery->specifications ?>"/></td>
            </tr>
<!--            <tr>
                <td>&nbsp;</td>
                <td><br/>
                    <button type="button" onclick="model_updateupholstry(<?php echo $modelid ?>)">Save</button>
                    <button type="button" onclick="$('#dialog2').dialog('close')">Cancel</button>
                </td>
            </tr>-->
        </table>
    </form>
</div>