<div class="row">
    <table class="" align="center" border="0">
        <tr>
            <td align="right"><span class="labelelement">Customer :</span></td>
            <td>
                <select id="customerid" class="form-control-sm">
                    <option value="0"></option>
                    <?php
                    foreach ($customer as $result) {
                        echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement">Model :</label></td>  
            <td>
                <input type="hidden" id="modelid0" value="0" />
                <input type="text" id="modelcode0" value=""  style="width: 150px"  class="form-control-sm"/>
                <img src="images/list.png" class="miniaction" onclick="costing_model_choose()"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement">Rate :</label></td>
            <td>                    
                <select id="rate" style="width: 120px"  class="form-control-sm">
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
//                     $(function() {
//                         $("#date").datepicker({
//                             dateFormat: "yy-mm-dd",
//                             changeMonth: true,
//                             changeYear:true
//                         }).focus(function() {
//                             $("#date").datepicker("show");
//                         }); 
//                     });
                </script>
                <input type="date" size="10" name="date" id="date" value=""/>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center"><br/>
                <button type="button" class="btn btn-md btn-success" onclick="costing_savenew()">Save</button>
                <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">Cancel</button>
            </td> 
        </tr>
    </table>
</div>
