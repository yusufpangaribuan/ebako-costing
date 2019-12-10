<div style="width: 400px">
    <table width="100%">
        <tr>
            <td align="right"><span class="labelelement">Item :</span></td>
            <td>
                <input type="hidden" value="<?php echo $modelid ?>" id="modelid_" />             
                <input type="text" name="description0" id="description77" style="width: 90%"/>
                <input type="hidden" name="itemid" id="itemid77"/>
                <img src="images/list.png" onclick="item_listSearch2(77)" class="miniaction"/>
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Unit :</span></td>
            <td>
                <select id="unitid77" style="width: 200px">                
                </select>
            </td>
        </tr>   
        <tr>
            <td align="right"><span class="labelelement">Type :</span></td>
            <td>
                <select id="hardwaretypeid" style="width: ">
                    <?php
                    foreach ($hardwaretype as $hardwaretype) {
                        if ($hardwaretype->id != 3) {
                            echo "<option value='" . $hardwaretype->id . "'>" . $hardwaretype->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Qty :</span></td>
            <td><input type="text" name="itemqty" id="itemqty" size="7" style="text-align: center;"/></td>
        </tr>    

        <tr>
            <td align="right"><span class="labelelement">Location :</span></td>
            <td><input type="text" id="location" style="text-transform: uppercase;width: 200px;"/></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Supplier :</span></td>
            <td>
                <textarea id="supplier" name="supplier" style="text-transform: uppercase;width: 90%;height: 40px;"></textarea>
            </td>
        </tr>
      <tr>
            <td>&nbsp;</td>
            <td><br/>
                <button type="button" onclick="model_inserthardware()" style="font-size: 10px;font-weight: bold;">Save</button>
       			 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </td>
        </tr>
    </table>

</div>