<div style="width: 300px;">
    <form id="rates_add_form">
        <table width="100%">
            <tr valign="top">
                <td align="right"><span class="labelelement">Effective Date :</span></td>
                <td>
                    <input type="date" name="date" required="required"  value="<?php echo date('Y-m-d') ?>"/>
                </td>
            </tr>
            <tr valign="top">
                <td width="35" align="right"><span class="labelelement">Currency:</span></td>
                <td width="65%" >
                    <select name="currency" style="width: 100%" class="required">
                        <option></option>
                        <?php
                        foreach ($currency as $result) {
                            echo "<option value='" . $result->curr . "'>" . $result->curr . " = " . $result->desc . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <td align="right"><span class="labelelement">Exchange Rate :</span></td>
                <td><input type="text" name="exchange_rate" style="width: 100%;text-align: right" class="required"/></td>
            </tr>
        </table>
    </form>
</div>