<tr valign="top">
    <td>
        <input id="pritemid<?php echo $flag ?>" type="hidden" value="0" name="pritemid[]">
        <input type="hidden" name="itemid[]" id="itemid<?php echo $flag ?>"/>
        <input type="text" name="partnumber[]" id="partnumber<?php echo $flag ?>"  style="width: 100%" readonly="">               
        <input type="hidden" id="name<?php echo $flag ?>" name="name[]" style="width: 100%"/>
        <button onclick="item_listSearch(<?php echo $flag ?>)" style="margin-top: 2px;"> Item List</button>
    </td>      
    <td><textarea style="width: 100%; height: 40px;" name="desciption[]" id="description<?php echo $flag ?>" readonly=""></textarea></td>
    <td><input type="text" style="width:100%;text-align: center" name="moq[]" id="moq<?php echo $flag ?>" readonly=""/></td>
    <td><input type="text" name="qty[]" size="5"  value="1" style="text-align: center;width: 100%" onblur="if($(this).val()=='' || $(this).val()=='0' || isNaN($(this).val())){alert('Required NUMBER and Not Allow 0 or NULL');$(this).val(1)}"></td>
    <td>
        <select name="unit[]" id="unitid<?php echo $flag ?>" style="width: 100%;">
            <option value="0">--Unit--</option>
        </select>
    </td> 
    <td width="5"><img src="images/delete.png" style="cursor: pointer" onclick="pr_deleteitem(this)"/></td>
</tr>