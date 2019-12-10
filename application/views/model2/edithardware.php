<div style="width: 400px">
    <form id="model_hardware_form_edit">
        <table width="100%">
            <tr>
                <td align="right"><span class="labelelement">Item :</span></td>
                <td>
                    <input type="hidden" value="<?php echo $hardware->id ?>" id="id" name="id"/> 
                    <input type="hidden" value="<?php echo $modelid ?>" id="modelid_" name="modelid"/>             
                    <input type="text" name="description" id="description77" style="width: 90%" value="<?php echo $hardware->description ?>"/>
                    <input type="hidden" name="itemid" id="itemid77" value="<?php echo $hardware->itemid ?>"/>
                    <img src="images/list.png" onclick="item_listSearch(77)" class="miniaction"/>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Unit :</span></td>
                <td>
                    <select id="unitid77" name="unitid" style="width: 200px">  
                        <option value="<?php echo $hardware->unitid ?>"><?php echo $hardware->unitcode ?></option>
                    </select>
                </td>
            </tr>   
            <tr>
                <td align="right"><span class="labelelement">Type :</span></td>
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
                <td align="right"><span class="labelelement">Qty :</span></td>
                <td><input type="text" name="qty" id="itemqty" size="7" value="<?php echo $hardware->qty ?>" style="text-align: center;"/></td>
            </tr>    

            <tr>
                <td align="right"><span class="labelelement">Location :</span></td>
                <td><input type="text" id="location" name="location" style="text-transform: uppercase;width: 200px;"  value="<?php echo $hardware->location ?>"/></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Remark :</span></td>
                <td>
                    <textarea id="supplier" name="supplier" style="text-transform: uppercase;width: 90%;height: 40px;"><?php echo $hardware->supplier ?></textarea>
                </td>
            </tr>
<!--            <tr>
                <td>&nbsp;</td>
                <td>
                    <button type="button" onclick="model_updatehardware()" style="font-size: 10px;font-weight: bold;">Save</button>
                    <button type="button" onclick="$('#dialog2').dialog('close')" style="font-size: 10px;font-weight: bold;">Cancel</button>
                </td>
            </tr>-->
        </table>
    </form>
</div>