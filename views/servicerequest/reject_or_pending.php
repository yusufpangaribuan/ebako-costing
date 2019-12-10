<form id="sr_reject_or_pending_form" onsubmit="return false;" style="width: 350px">
    <table width="100%">
        <tr valign="top">
            <td><span class="labelelement">Notes</span></td>
            <td>
                <input type="hidden" name="servicerequestid" id="servicerequestid" value="<?php echo $servicerequestid ?>"/>
                <input type="hidden" name="approvalid" id="approvalid" value="<?php echo $approvalid ?>"/>
                <input type="hidden" name="status" id="mat_req_status" value="<?php echo $status ?>"/>
                <input type="hidden" name="who" id="who" value="<?php echo $who ?>"/>
                <input type="hidden" name="flag" id="flag" value="<?php echo $flag ?>"/>
                <textarea name="notes" style="width: 100%; height: 40px;" required="true"></textarea>
            </td>
        </tr>
        </tr>
    </table>
</form>