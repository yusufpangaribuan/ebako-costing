        <table style="width: 100%">
            <tr>
                <td width="100" align="right"><span class="labelelement">Currency From :</span></td>
                <td>
                    <input type="hidden" id="id" value="<?php echo $rate->id ?>" />
                    <select id="currency_from">                        
                        <?php
                        foreach ($currency as $result) {
                            if ($rate->currency_from == $result->curr) {
                                echo "<option value='" . $result->curr . "' selected>" . $result->curr . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <td width="100" align="right"><span class="labelelement">Currency To :</span></td>
            <td>
                <select id="currency_to">
                    <?php
                    foreach ($currency as $result) {
                        if ($rate->currency_to == $result->curr) {
                            echo "<option value='" . $result->curr . "' selected>" . $result->curr . "</option>";
                        }
                    }
                    ?>
                </select>
            </td>
            <tr>
            <tr>
                <td align="right"><span class="labelelement">Value :</span></td>
                <td><input type="text" name="value" id="value" value="<?php echo $rate->value ?>"/></td>
            </tr>            
        </table>
