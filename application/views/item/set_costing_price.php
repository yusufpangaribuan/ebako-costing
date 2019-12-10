<table>
    <tr>
        <td><span class="labelelement">Price</span></td>
        <td>
            <input type="hidden" name="itemid" id="itemid" value="<?php echo $itemid ?>" />
            <input type="text" name="costing_price" id="costing_price" value="<?php echo $item->costing_price ?>" style="text-align: right"/>
            <select id="curr">
                <?php
                foreach ($currency as $currency) {
                    if ($item->curr_costing_price == $currency->curr) {
                        echo "<option value='" . $currency->curr . "' selected>" . $currency->curr . "</option>";
                    } else {
                        echo "<option value='" . $currency->curr . "'>" . $currency->curr . "</option>";
                    }
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <button onclick="item_do_set_costing_price()">Save</button>
            <button onclick="$('#dialog').dialog('close')">Cancel</button>
        </td>
    </tr>
</table>
