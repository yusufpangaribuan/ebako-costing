<div style="width: 450px">
    <form id="model_hardware_form_edit">
        <table width="100%">
            <tr>
                <td style="width: 30%" align="right"><span class="labelelement"><span style="color: red;">*&nbsp;</span> Item</span></td>
                <td style="width: 2%;"></td>
                <td style="width: 69%">
                    <input type="hidden" value="<?php echo $hardware->id ?>" id="id" name="id"/> 
                    <input type="hidden" value="<?php echo $modelid ?>" id="modelid_" name="modelid"/>             
                    <input type="text" name="description" id="description77" style="width: 90%" value="<?php echo $hardware->description ?>"  readonly="readonly"/>
                    <input type="hidden" name="itemid" id="itemid77" value="<?php echo $hardware->itemid ?>"/>
                    <img src="images/list.png" onclick="item_listSearch(77)" class="miniaction"/>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement"><span style="color: red;">*&nbsp;</span> Unit</span></td>
                <td></td>
                <td>
                    <select id="unitid77" name="unitid" style="width: 200px">  
                        <option value="<?php echo $hardware->unitid ?>"><?php echo $hardware->unitcode ?></option>
                    </select>
                </td>
            </tr>   
            <tr>
                <td align="right"><span class="labelelement">Type</span></td>
                <td></td>
                <td>
                    <select id="hardwaretypeid" name="hardwaretypeid" style="width: 200px">
                        <?php
                        foreach ($hardwaretype as $hardwaretype) {
                            if ($hardwaretype->id != 3) {
                                if ($hardware->hardwaretypeid == $hardwaretype->id) {
                                    echo "<option value='" . $hardwaretype->id . "' selected>" . $hardwaretype->name . "</option>";
                                } else {
                                    echo "<option value='" . $hardwaretype->id . "'>" . $hardwaretype->name . "</option>";
                                }
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement"><span style="color: red;">*&nbsp;</span> Qty</span></td>
                <td></td>
                <td><input type="text" name="qty" id="itemqty" size="7" value="<?php echo $hardware->qty ?>" style="text-align: center;"/></td>
            </tr>    

            <tr>
                <td align="right"><span class="labelelement">Location</span></td>
                <td></td>
                <td><input type="text" id="location" name="location" style="width: 200px;"  value="<?php echo $hardware->location ?>"/></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Supllier</span></td>
                <td></td>
                <td><input type="text" id="supplier" name="supplier" style="width: 200px;"  value="<?php echo $hardware->supplier ?>"/></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Notes</span></td>
                <td></td>
                <td>
                    <textarea id="notes" name="notes" style="width: 90%;height: 40px;"><?php echo $hardware->notes ?></textarea>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement"><span style="color: red;">*&nbsp;</span> Is Picklist Item?</span></td>
                <td></td>
                <td>
                    <select name="is_picklist" id="is_picklist_item_id">
                        <option value=f <?php echo $hardware->is_picklist == 't' ? "selected" : ""; ?> >No</option>
                        <option value=t <?php echo $hardware->is_picklist == 'f' ? "selected" : ""; ?> >Yes</option>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</div>