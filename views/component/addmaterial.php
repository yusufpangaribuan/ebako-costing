<center>
    <table width="100%" align="center">            
        <tr>
            <td><span class="labelelement">material</span></td>
            <td>
                <input type="hidden" id="componentid" value="<?php echo $componentid ?>" />            
                <input type="text" name="materialname" id="materialname" value="" />
                <input type="hidden" name="materialid" id="materialid" value="" />
                <img src="images/list.png" class="miniaction" onclick="component_itemlist('material')"/>
            </td>
        </tr>
        <tr>
            <td><span class="labelelement">Unit</span></td>
            <td>
                <select name="unitid" id="unitid">
                    <option value="0">--Unit--</option>                    
                </select>
            </td>  
        </tr>
        <tr>
            <td><span class="labelelement">Quantity</span></td>
            <td><input type="text" name="qty" id="qty" size="5" style="text-align: center" value="1" onblur="if($(this).val()=='' || $(this).val()=='0' || isNaN($(this).val())){alert('Required NUMBER and Not Allow 0 or NULL');$(this).val(1)}"/></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><button onclick="component_insertitem()" style="font-size: 10px;font-weight: bold;">Save</button></td>
        </tr>    
    </table>
    <br/>
</center>