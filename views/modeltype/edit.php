<div style="width: 330px;">
    <table>
        <tr>     
            <td width="30%" align="right"><span class="labelelement">Code :</span></td>
            <td width="70%">
                <input type="hidden" name="id" id="id" value="<?php echo $modeltype->id ?>" />
                <input type="text" name="input_code" id="input_code" value="<?php echo $modeltype->name ?>"/>
            </td>
        </tr>        
        <tr>
            <td align="right" valign="top"><span class="labelelement">Description :</span></td>
            <td><textarea id="input_description" cols="25" rows="3"><?php echo $modeltype->description ?></textarea></td>  
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>                
                <button onclick="modeltype_update()" style="font-size: 11px">Update</button>
                <button onclick="modeltype_edit(<?php echo $modeltype->id ?>)" style="font-size: 11px">Reset</button>
                <button onclick="$('#dialog').dialog('close')" style="font-size: 11px">Cancel</button>
            </td>
        </tr>
    </table>
</div>

