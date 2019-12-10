<table>
    <tr valign="top">
        <td><span class="labelelement">Notes</span></td>
        <td>
            <input type="hidden" name="mrid" id="mrid_drp" value="<?php echo $mrid ?>"/>
            <input type="hidden" name="approvalid" id="approvalid_drp" value="<?php echo $approvalid ?>"/>
            <input type="hidden" name="status" id="mr_status_drp" value="<?php echo $status ?>"/>
            <input type="hidden" name="who" id="who_drp" value="<?php echo $who ?>"/>
            <input type="hidden" name="flag" id="flag_drp" value="<?php echo $flag ?>"/>
            <textarea id="notes_drp" name="notes" style="width: 270px; height: 141px;"></textarea>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <button onclick="mr_do_reject_or_pending()">Submit</button>
            <button onclick="$('#dialog2').dialog('close');">Cancel</button>
        </td>
    </tr>
</tr>
</table>