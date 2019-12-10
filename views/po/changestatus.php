<table>
    <tr valign="top">
        <td>
            <input type="hidden" name="poid" id="poid" value="<?php echo $poid ?>" />
            <input type="hidden" name="status_c" id="status_c" value="<?php echo $status ?>" />
            <textarea id="notes" name="notes" cols="30" rows="10"></textarea>
        </td>     
    </tr>
    <tr>
        <td>
            <button onclick="po_savepostatus()">Submit</button>
            <button onclick="javascript:$('#dialog').dialog('close');po_view();">Cancel</button>
        </td>
    </tr>
</table>