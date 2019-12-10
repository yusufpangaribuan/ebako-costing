<div style="width: 300px">
<table width="100%">
    <tr>
        <td width="30%" align="right"><span class="labelelement">Code :</span></td>
        <td><input type="text" name="codes" id="codes"/></td>
    </tr>
    <tr>
        <td align="right"><span class="labelelement">Name :</span></td>
        <td><input type="text" name="names" id="names" size="30"/></td>
    </tr>    
    <tr>
        <td align="right" valign="top"><span class="labelelement">Remark :</span></td>
        <td><textarea id="remark" cols="25" rows="3"></textarea></td>  
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <button onclick="unit_save()" style="font-size: 11px">Save</button>
            <button onclick="unit_add()" style="font-size: 11px">Reset</button>
            <button onclick="$('#dialog').dialog('close')" style="font-size: 11px">Cancel</button>
        </td>
    </tr>
</table>
</div>
