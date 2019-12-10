<table>
    <tr>
        <td><span class="labelelement">Price</span></td>
        <td>
            <input type="hidden" name="itemid" id="itemid" value="<?php echo $modelid ?>" />
            <input type="text" name="price" id="price" value="<?php echo $model->price ?>" style="text-align: right"/>
            <select id="curr">
                <?php
                foreach ($currency as $currency) {
                    if ($currency->curr == $model->curr) {
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
            <button onclick="model_dosetprice()">Save</button>
       			 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </td>
    </tr>
</table>
