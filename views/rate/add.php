        <table style="width: 100%">
            <tr>
                <td width="100" align="right"><span class="labelelement">Currency From :</span></td>
                <td>
                    <select id="currency_from">
                        <option value=""></option>
                        <?php
                        foreach ($currency as $result) {
                            echo "<option value='" . $result->curr . "'>" . $result->curr . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <td width="100" align="right"><span class="labelelement">Currency To :</span></td>
            <td>
                <select id="currency_to">
                    <option value=""></option>
                    <?php
                    foreach ($currency as $result) {
                        echo "<option value='" . $result->curr . "'>" . $result->curr . "</option>";
                    }
                    ?>
                </select>
            </td>
            <tr>
            <tr>
                <td align="right"><span class="labelelement">Value :</span></td>
                <td><input type="text" name="value" id="value" /></td>
            </tr>            
        </table>
