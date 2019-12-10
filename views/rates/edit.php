<div style="width: 300px;">
    <form id="rates_edit_form">
        <table width="100%">
            <tr valign="top">
                <td align="right"><span class="labelelement">Effective Date :</span></td>
                <td>
                    <input type="hidden" name="id" value="<?php echo $rates->id ?>" />
                    <input type="date" name="date" required="required" value="<?php echo $rates->date ?>"/>
                </td>
            </tr>
            <tr valign="top">
                <td width="35" align="right"><span class="labelelement">Currency:</span></td>
                <td width="65%" >
                    <select name="currency" style="width: 100%" class="required">
                        <option></option>
                        <?php
                        foreach ($currency as $result) {
                            if ($rates->currency == $result->curr) {
                                echo "<option value='" . $result->curr . "' selected>" . $result->curr . " = " . $result->desc . "</option>";
                            } else {
                                echo "<option value='" . $result->curr . "'>" . $result->curr . " = " . $result->desc . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <td align="right"><span class="labelelement">Exchange Rate :</span></td>
                <td><input type="text" name="exchange_rate" style="width: 100%;text-align: right" class="required" value="<?php echo $rates->exchange_rate ?>"/></td>
            </tr>
        </table>
    </form>
</div>
