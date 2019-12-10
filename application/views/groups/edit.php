<div style="width: 330px;">
    <span id="messageaction"></span>
    <table>
        <tr>     
            <td width="30%" align="right"><span class="labelelement">Code :</span></td>
            <td width="70%">
                <input type="hidden" name="id" id="id" value="<?php echo $groups[0]->id ?>" />
                <input type="text" name="codes" id="codes" value="<?php echo $groups[0]->codes ?>"/>
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Name :</span></td>
            <td><input type="text" name="names" id="names" size="30" value="<?php echo $groups[0]->names ?>"/></td>
        </tr>    
        <tr>
            <td align="right" valign="top"><span class="labelelement">Description :</span></td>
            <td><textarea id="descriptions" cols="25" rows="3"><?php echo $groups[0]->descriptions ?></textarea></td>  
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>                
                <button onclick="groups_update()" style="font-size: 11px">Update</button>
                <button onclick="groups_edit(<?php echo $groups[0]->id ?>)" style="font-size: 11px">Reset</button>
                <button onclick="$('#dialog').dialog('close')" style="font-size: 11px">Cancel</button>
            </td>
        </tr>
    </table>
</div>

