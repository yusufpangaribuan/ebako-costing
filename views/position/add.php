<div style="width: 330px;">    
    <table width="100%">
        <tr>
            <td width="30%" align="right"><span class="labelelement">Code :</span></td>
            <td><input type="text" name="codes" id="code"/></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Name</span></td>
            <td><input type="text" name="names" id="name" size="30"/></td>
        </tr>    
        <tr>
            <td align="right"><span class="labelelement">Description</span></td>
            <td><textarea id="description" cols="25" rows="3"></textarea></td>  
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <button style="font-size: 11px" onclick="position_insert()">Save</button>
                <button style="font-size: 11px" onclick="position_add()">Reset</button>
                <button style="font-size: 11px" onclick="$('#dialog').dialog('close')">Cancel</button>
            </td>
        </tr>
    </table>        
</div>