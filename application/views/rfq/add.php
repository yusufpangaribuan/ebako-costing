<br/>
<br/>
<center>
    <div style="width:75%;" class="panel">           
        <h4>Create Request For Quotation</h4>
        <br/>                        
        <table width="100%" border="0">
            <tr valign="top">
                <td width="40%" align="left">
                    <table width="100%">
                        <tr>
                            <td align="right" width="40%"><span class="labelelement">RFQ. No : </span></td>
                            <td width="60%"><input type="text" size="15" id="number" value="<?php echo $this->model_rfq->nextNumber() ?>" style="font-weight:bold;"/></td>
                        </tr>
                        <tr>
                            <td width="35%" align="right"><span class="labelelement">Customer : </span></td>
                            <td width="65%">
                                <select id="billto" style="width: 100px;" onchange="so_changebillto(this);
                                        so_customergetAddress(this)">
                                    <option value="0">--Customer--</option>
                                    <?php
                                    foreach ($customer as $result) {
                                        echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Ship To : </span></td>
                            <td>
                                <select id="shipto" style="width: 100px;" onchange="so_customergetAddress(this)">
                                </select>
                            </td>
                        </tr>  
                        <tr valign="top">
                            <td align="right"><span class="labelelement">Shipping Address : </span></td>
                            <td><textarea id="shippingaddress" name="shippingaddres" style="width: 100%;"></textarea></td>
                        </tr>                        
                        <tr valign="top">
                            <td align="right"><span class="labelelement">Payment Term: </span></td>
                            <td>
                                <select id="paymenttermid" style="width: 100px;">
                                    <option value="0"></option>
                                    <?php
                                    foreach ($paymentterm as $result) {
                                        echo "<option value='" . $result->id . "'>" . $result->description . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="60%" align="right">
                    <table width="100%" border="0">                        

                        <tr>
                            <td align="right" width="40%"><span class="labelelement">Date : </span></td>
                            <td width="60%">
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#date").datepicker({
                                            dateFormat: "yy-mm-dd",
                                            changeMonth: true,
                                            changeYear: true,
                                            minDate: 0
                                        }).focus(function () {
                                            $("#date").datepicker("show");
                                        });
                                        $("#promiseddate").datepicker({
                                            dateFormat: "yy-mm-dd",
                                            changeMonth: true,
                                            changeYear: true
                                        }).focus(function () {
                                            $("#promiseddate").datepicker("show");
                                        });
                                    });
                                </script>
                                <input type="text" size="10" id="date" name="date" size="10" value="<?php echo date('Y-m-d') ?>" style="text-align: center"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Promised Date : </span></td>
                            <td><input type="text" name="promiseddate" id="promiseddate" size="12" readonly="" style="text-align: center"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Shipment Via : </span></td>
                            <td>
                                <select name="shipvia" id="shipvia">
                                    <?php
                                    foreach ($shipmentvia as $shipmentvia) {
                                        echo "<option value='" . $shipmentvia . "'>" . $shipmentvia . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="40%" align="right"><span class="labelelement">Sales Person : </span></td>
                            <td width="60%"><input type="text" name="salesperson" id="salesperson" style="text-transform: uppercase"/></td>
                        </tr>
                        <tr>
                            <td width="40%" align="right"  style="border-right: 1px #009999 solid;"><span class="labelelement">Testing : </span></td>
                            <td width="60%">
                                <?php
                                foreach ($testing as $testing) {
                                    echo "<span style='display: inline-block;padding:5px;'><input type='checkbox' value='" . $testing->id . "' name='testing[]'>&nbsp;" . $testing->name . "</span>";
                                }
                                ?>
                            </td>
                        </tr>                        
                    </table>
                </td>                    
            </tr>                        
        </table>
        <br/>
        <br/>
        <button onclick="rfq_insert()">Save</button>
        <button onclick="rfq_view()">Cancel</button>
        <button onclick="rfq_add()">Reset</button>
        <br/><br/>
    </div>
</center>