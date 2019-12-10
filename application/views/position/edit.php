<div style="width: 330px;">
    <span id="messageaction"></span>
    <table>
        <tr>     
            <td width="30%" align="right"><span class="labelelement">Code :</span></td>
            <td width="70%">
                <input type="hidden" name="id" id="id" value="<?php echo $position->id ?>" />
                <input type="text" name="codes" id="code" value="<?php echo $position->code ?>"/>
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Name :</span></td>
            <td><input type="text" name="names" id="name" size="30" value="<?php echo $position->name ?>"/></td>
        </tr>    
        <tr>
            <td align="right" valign="top"><span class="labelelement">Description :</span></td>
            <td><textarea id="description" cols="25" rows="3"><?php echo $position->description ?></textarea></td>  
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>                
                <button onclick="position_update()" style="font-size: 11px">Update</button>
                <button onclick="position_edit(<?php echo $position->id ?>)" style="font-size: 11px">Reset</button>
                <button onclick="$('#dialog').dialog('close')" style="font-size: 11px">Cancel</button>
            </td>
        </tr>
    </table>
</div>

