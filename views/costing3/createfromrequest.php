<div class="row">
    <table class="" align="center" border="0">
            <tr>
                <td align="right"><label class="labelelement">Rate :</label></td>
                <td>
                    <input type="hidden" id ="id" value="<?php echo $id ?>"/>
                    <select id="rate" style="width: 120px">
                        <option value="0"></option>
                        <?php
                        foreach ($rate as $rate) {
                            echo "<option value='" . $rate->id . "-" . $rate->value . "'>" . $rate->currency_from . "->" . $rate->currency_to . "  " . $rate->value . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="labelelement">Fixed Cost :</label></td>
                <td><input type="text" size="3" name="fixed_cost" id="fixed_cost" value="9" style="text-align: center"/>%</td>
            </tr>
            <tr>
                <td align="right"><label class="labelelement">Variable Cost :</label></td>
                <td><input type="text" size="3" name="variable_cost" id="variable_cost" value="9" style="text-align: center"/>%</td>
            </tr>
            <tr>
                <td align="right"><label class="labelelement">Profit Percentage :</label></td>
                <td><input type="text" size="3" name="profit_percentage" id="profit_percentage" value="20" style="text-align: center"/></td>
            </tr>            
            <tr>
                <td align="right"><label class="labelelement">Port origin cost :</label></td>
                <td><input type="text" size="3" name="port_origin_cost" id="port_origin_cost" value="1.45" style="text-align: center"/>%</td>
            </tr>
            <tr>
                <td align="right"><label class="labelelement">Date :</label></td>
                <td>
                    <input type="date" size="10" name="date" id="date" style="text-align: center"/>
                </td>
            </tr>
            <tr>
                <td><button type="button" class="btn btn-md btn-success" onclick="costing_savefromrequest()">Save</button></td> 
            </tr>
		</table>
	</div>
