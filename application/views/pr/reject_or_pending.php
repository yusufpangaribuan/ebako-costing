<table>
    <tr valign="top">
        <td><span class="labelelement">Notes</span></td>
        <td>
            <input type="hidden" name="prid" id="prid" value="<?php echo $prid?>"/>
            <input type="hidden" name="approvalid" id="approvalid" value="<?php echo $approvalid?>"/>
            <input type="hidden" name="status" id="status" value="<?php echo $status?>"/>
            <input type="hidden" name="flag" id="flag" value="<?php echo $flag?>"/>
            <textarea id="notes" name="notes" style="width: 270px; height: 141px;"></textarea>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <button onclick="pr_do_reject_or_pending()">Submit</button>
            <button onclick="$('#dialog2').dialog('close');">Cancel</button>
        </td>
    </tr>
    </tr>
</table>