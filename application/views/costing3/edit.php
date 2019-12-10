<div class="row">
    <table class="" align="center" border="0">
            <tr>
                <td align="right"><label class="labelelement">Customer :</label></td>
                <td>
                    <input type="hidden" id="id" value="<?php echo $costing->id ?>" />
                    <select id="customerid" class="form-control-sm">
                        <option value="0"></option>
                        <?php
                        foreach ($customer as $result) {
                            if ($result->id == $costing->customerid) {
                                echo "<option value='" . $result->id . "' selected>" . $result->name . "</option>";
                            } else {
                                echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="labelelement">Model :</label></td>  
                <td>
                    <input type="hidden" id="modelid0" value="<?php echo $costing->modelid ?>" />
                    <input type="text" id="modelcode0" value="<?php echo $costing->code ?>" class="form-control-sm"/>
                    <img src="images/list.png" class="miniaction" onclick="costing_model_choose('model',0)"/>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="labelelement">Rate</label></td>
                <td>
                    <select id="rate" style="width: 120px">
                        <option value="0"></option>
                        <?php
                        foreach ($rate as $rate) {
                            if ($rate->id == $costing->rateid) {
                                echo "<option value='" . $rate->id . "-" . $rate->value . "' selected>" . $rate->currency_from . "->" . $rate->currency_to . "  " . $rate->value . "</option>";
                            } else {
                                echo "<option value='" . $rate->id . "-" . $rate->value . "'>" . $rate->currency_from . "->" . $rate->currency_to . "  " . $rate->value . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <input type="checkbox" id="newrate" style="vertical-align: middle"/><span style="color: green;font-size: 10px;"><i>Check to Use Current value</i></span>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="labelelement">Costing rate value :</label></td>
                <td><input type="text" size="10" name="ratevalue" id="ratevalue" value="<?php echo $costing->ratevalue ?>" style="text-align: left"/></td>
            </tr>
            <tr>
                <td align="right"><label class="labelelement">Fixed Cost :</label></td>
                <td><input type="text" size="3" name="fixed_cost" id="fixed_cost" value="<?php echo $costing->fixed_cost ?>" style="text-align: center"/>%</td>
            </tr>
            <tr>
                <td align="right"><label class="labelelement">Variable Cost :</label></td>
                <td><input type="text" size="3" name="variable_cost" id="variable_cost" value="<?php echo $costing->variable_cost ?>" style="text-align: center"/>%</td>
            </tr>
            <tr>
                <td align="right"><label class="labelelement">Profit Percentage :</label></td>
                <td><input type="text" size="3" name="profit_percentage" id="profit_percentage" value="<?php echo $costing->profit_percentage ?>" style="text-align: center"/></td>
            </tr>            
            <tr>
                <td align="right"><label class="labelelement">Port origin cost :</label></td>
                <td><input type="text" size="3" name="port_origin_cost" id="port_origin_cost" value="<?php echo $costing->port_origin_cost ?>" style="text-align: center"/>%</td>
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
                    <input type="text" size="10" name="date" id="date" value="<?php echo $costing->date ?>" style="text-align: center"/>
                </td>
            </tr>
            <tr>   
                <td>&nbsp;</td>
                <td>
                    <br/>
                    <button type="button" class="btn btn-md btn-success" onclick="costing_update()">Update</button>
                    <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">Cancel</button>
                </td> 
            </tr>
</table>
</div>
