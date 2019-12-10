<tr valign="top">
    <td>
        <input id="stockoutdetailid<?php echo $flag ?>" type="hidden" name="stockoutdetailid[]" value="0">
        <input id="itemid<?php echo $flag ?>" type="hidden" name="itemid[]" value="0">
        <input id="partnumber<?php echo $flag ?>" type="text" style="width: 80%" name="partnumber[]">
        <img class="miniaction" onclick="item_listSearch(<?php echo $flag ?>)" src="images/list.png">
        <input id="name0" type="hidden" style="width: 100%" name="name[]">
    </td>
    <td><textarea style="width: 100%; height: 70px;" name="desciption[]" id="description<?php echo $flag ?>" readonly="true"></textarea></td>
    <td id="tempstock<?php echo $flag ?>"></td>
    <td><input type="text" name="qty[]" id="qty<?php echo $flag ?>" value="0" size="5" style="text-align: center; width: 100%;" onblur="stockout_checkstock(<?php echo $flag ?>)"> </td>
    <td>
        <select name="unitid[]" id="unitid<?php echo $flag ?>" style="width: 100%" onchange="stockout_checkstock(<?php echo $flag ?>)">
            <option value="0">--Unit--</option>
        </select>
    </td>
    <td width="5"><img src="images/delete.png" style="cursor: pointer" onclick="pr_deleteitem(this)"/></td>
</tr>