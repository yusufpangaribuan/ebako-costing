<div style="width: 300px;">
    <form id="currency_add_form">
        <table width="100%">            
            <tr valign="top">
                <td width="30%" align="right"><span class="labelelement">Code:</span></td>
                <td width="70%" >
                    <input type="text" name="curr" style="width: 100%;" class="required"/>
                </td>
            </tr>
            <tr valign="top">
                <td align="right"><span class="labelelement">Description :</span></td>
                <td>
                    <textarea style="width: 100%;height: 40px" name="desc"></textarea>
                </td>
            </tr>
        </table>
    </form>
</div>
<script>
// just for the demos, avoids form submit
    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });
    $("#currency_add_form").validate({
        rules: {
            curr: {
                required: true
            }
        }
    });
</script>