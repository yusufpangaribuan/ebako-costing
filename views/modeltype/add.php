<div style="width: 330px;">    
    <table width="100%">
        <tr>
            <td width="30%" align="right"><span class="labelelement">Code :</span></td>
            <td><input type="text" name="input_code" id="input_code"/></td>
        </tr>        
        <tr>
            <td align="right"><span class="labelelement">Description</span></td>
            <td><textarea id="input_description" cols="25" rows="3"></textarea></td>  
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <button style="font-size: 11px" onclick="modeltype_insert()">Save</button>
                <button style="font-size: 11px" onclick="modeltype_add()">Reset</button>
                <button style="font-size: 11px" onclick="$('#dialog').dialog('close')">Cancel</button>
            </td>
        </tr>
    </table>        
</div>