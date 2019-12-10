<span id="messageaction"></span>
<br/>
<table width="100%" align="center" class="form">    
    <tbody>
        <tr>
            <td colspan="2" align="center"><span class="title">Add Material</span><hr/></td>
        </tr>
        <tr>
            <td><span class="labelelement">Name</span></td>
            <td>
                <input type="hidden" id="modelid" value="<?php echo $modelid ?>" />
                <input type="hidden" id="parentid" value="<?php echo $parentid ?>" />
                <input type="hidden" name="itemid" id="itemid"/>
                <input type="text" name="itemname" id="itemname" size="20"/>
                <button onclick="model_chooseitem('item')">Select</button>
            </td>
        </tr>    
        <tr>
            <td><span class="labelelement">Description</span></td>
            <td><textarea id="itemdescription" cols="25" rows="5"></textarea></td>  
        </tr>
        <tr>
            <td><span class="labelelement">Description</span></td>
            <td>
                <select name="unitid" id="unitid">
                    <option value="0">--Unit--</option>
                    <?php
                    foreach ($unit as $result) {
                        echo "<option value='" . $result->id . "' title='" . $result->names . "'>" . $result->codes . "</option>";
                    }
                    ?>
                </select>
            </td>  
        </tr>
        <tr>
            <td><span class="labelelement">Quantity</span></td>
            <td><input type="text" name="qty" id="qty" size="5" style="text-align: center"/></td>
        </tr>
        <tr>
            <td><span class="labelelement">Standard Cost</span></td>
            <td><input type="text" name="standardcost" id="standardcost" size="20" style="text-align: right"/></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><button onclick="model_insertitem()">Save</button></td>
        </tr>    
    </tbody>
</table>
