<div style="width: 300px;">
    <form id="currency_edit_form">
        <table width="100%">            
            <tr valign="top">
                <td width="35" align="right"><span class="labelelement">Code:</span></td>
                <td width="65%" >
                    <input type="hidden" name="id" value="<?php echo $currency->id?>"/>
                    <input type="text" name="curr" value="<?php echo $currency->curr?>" style="width: 100%;" class="required"/>
                </td>
            </tr>
            <tr valign="top">
                <td align="right"><span class="labelelement">Description :</span></td>
                <td>
                    <textarea style="width: 100%;height: 40px" name="desc"><?php echo $currency->desc?></textarea>
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
    $("#currency_edit_form").validate({
        rules: {
            curr: {
                required: true
            }
        }
    });
</script>