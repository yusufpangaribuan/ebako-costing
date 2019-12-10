<table width="100%" class="nostyle">
    <tr>
        <td><span class="labelelement">Item</span></td>
        <td>
            <input type="hidden" value="<?php echo $modelid?>" id="modelid_" /> 
            <input type="hidden" value="<?php echo $type?>" id="type_" />
            <input type="hidden" value="<?php echo $class?>" id="class_" />
            <input type="text" name="itemname" id="itemname"/>
            <input type="hidden" name="itemid" id="itemid"/>
            <button onclick="model_choosecomponent('item')" style="font-size: 10px;font-weight: bold;">Choose</button>
        </td>
    </tr>
    <tr>
        <td><span class="labelelement">TYPE</span></td>
        <td>
            <select id="hardwaretypeid">
                <?php 
                foreach ($hardwaretype as $hardwaretype){
                    echo "<option value='".$hardwaretype->id."'>".$hardwaretype->name."</option>";
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td><span class="labelelement">Qty</span></td>
        <td><input type="text" name="itemqty" id="itemqty" size="10" style="text-align: center;"/></td>
    </tr>    
    <tr>
        <td>&nbsp;</td>
        <td><button onclick="model_insertcomponent()" style="font-size: 10px;font-weight: bold;">Save</button></td>
    </tr>
</table>
