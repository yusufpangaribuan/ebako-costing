<div style="width: 300px">
    <table width="100%">
        <tr>
            <td width="30%" align="right"><span class="labelelement">Code :</span></td>
            <td>
                <input type="hidden" name="id" id="id" value="<?php echo $unit[0]->id ?>"/>
                <input type="text" name="codes" id="codes" value="<?php echo $unit[0]->codes ?>"/>
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Name :</span></td>
            <td><input type="text" name="names" id="names" size="30" value="<?php echo $unit[0]->names ?>"/></td>
        </tr>    
        <tr>
            <td align="right" valign="top"><span class="labelelement">Remark :</span></td>
            <td><textarea id="remark" cols="25" rows="3"><?php echo $unit[0]->remark ?></textarea></td>  
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <button onclick="unit_update()" style="font-size: 11px">Update</button>
                <button onclick="unit_edit(<?php echo $unit[0]->id ?>)" style="font-size: 11px">Reset</button>
                <button onclick="$('#dialog').dialog('close')" style="font-size: 11px">Cancel</button>
            </td>
        </tr>
    </table>
</div>
