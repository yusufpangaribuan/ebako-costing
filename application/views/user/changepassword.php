<div style="width: 300px;">
    <table width="96%">        
        <tr>
            <td align="right"><span class="labelelement">New password :</span></td>
            <td>
                <input type="hidden" value="<?php echo $userid ?>" id="userid" /> 
                <input type="password" id="newpasswrod" size="18" />
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Re-type new password :</span></td>
            <td><input type="password" id="renewpasswrod" size="18"/></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><br/>
                <button onclick="user_dochangepassword()">Ok</button>
                <button onclick="$('#dialog_temp').dialog('close')">Cancel</button>
            </td>
        </tr>
    </table>
</div>