<div style="height: 150px;width:250px;">
    <center>
        <table width="100%">
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
                    <script type="text/javascript" >
                        $(function() {
                            $("#date").datepicker({
                                dateFormat: "yy-mm-dd",
                                changeMonth: true,
                                changeYear:true
                            }).focus(function() {
                                $("#date").datepicker("show");
                            }); 
                        });
                    </script>
                    <input type="text" size="10" name="date" id="date" value="" readonly="" style="text-align: center"/>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><button onclick="costing_savefromrequest()">Save</button></td> 
            </tr>
    </center>
</table>
</div>
