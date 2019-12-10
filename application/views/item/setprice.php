<table>
    <tr>
        <td><span class="labelelement">Price</span></td>
        <td>
            <input type="hidden" name="itemid" id="itemid" value="<?php echo $itemid ?>" />
            <input type="text" name="price" id="price" value="<?php echo $item->price ?>" style="text-align: right"/>
            <select id="curr">
                <option value=""></option>
                <?php
                foreach ($currency as $currency) {
                    if ($item->curr == $currency->curr) {
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
            <button onclick="item_dosetprice()">Save</button>
            <button onclick="$('#dialog').dialog('close')">Cancel</button>
        </td>
    </tr>
</table>
