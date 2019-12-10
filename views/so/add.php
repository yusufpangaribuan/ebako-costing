<br/>
<br/>
<center>
    <div style="width: 80%;" class="panel">           
        <h4>Add Sales Order</h4>           
        <button style="float: right;margin-top: 3px;margin-right: 3px;" onclick="so_choosequotation()">Choose Quotation</button>
        <br/>        
        <table width="100%" border="0">
            <tr valign="top">
                <td width="40%" align="left">
                    <table width="100%">
                        <tr>
                            <td width="40%" align="right"><span class="labelelement">Customer : </span></td>
                            <td width="60%">
                                <select id="billto" style="width: 100%;" onchange="so_changebillto(this);so_customergetAddress(this)">
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
                                <select id="shipto" style="width: 100%;" onchange="so_customergetAddress(this)">  
                                    <option value="0">--Ship To--</option>
                                    <?php
                                    foreach ($customer as $result) {
                                        echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>  
                        <tr valign="top">
                            <td align="right"><span class="labelelement">Shipping Address : </span></td>
                            <td><textarea id="shippingaddress" name="shippingaddres" style="width: 100%;"></textarea></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Shipment Schedule : </span></td>
                            <td><input type="text" name="shipmentschedule" id="shipmentschedule" size="10" style="text-align: center"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Shipment Via : </span></td>
                            <td>
                                <select name="shipvia" id="shipvia" style="width: 100%">
                                    <?php
                                    foreach ($shipmentvia as $shipmentvia) {
                                        echo "<option value='" . $shipmentvia . "'>" . $shipmentvia . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Payment Term : </span></td>
                            <td>
                                <select id="paymentterm" name="paymentterm" style="width: 100px;">
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
                <td width="10%">&nbsp;</td>
                <td width="60%" align="right">
                    <table width="100%" border="0">
                        <tr>
                            <td width="40%" align="right"><span class="labelelement">PO No : </span></td>
                            <td width="60%"><input type="text" name="ponumber" id="ponumber" /></td>
                        </tr>
                        <tr>
                            <td align="right" width="40%"><span class="labelelement">Order No : </span></td>
                            <td><input type="text" style="width: 45%" id="number" readonly="" value="<?php echo $this->model_so->getNextSoNumber() ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right" width="40%"><span class="labelelement">Date : </span></td>
                            <td>
                                <script type="text/javascript" >
                                    $(function() {
                                        $("#date").datepicker({
                                            dateFormat: "yy-mm-dd"
                                        }).focus(function() {
                                            $("#date").datepicker("show");
                                        });
                                        $("#shipdate").datepicker({
                                            dateFormat: "yy-mm-dd"
                                        }).focus(function() {
                                            $("#shipdate").datepicker("show");
                                        });
                                        $("#shipmentschedule").datepicker({
                                            dateFormat: "yy-mm-dd"
                                        }).focus(function() {
                                            $("#shipmentschedule").datepicker("show");
                                        });
                                    });
                                </script>
                                <input type="text" size="10" id="date" name="date" style="text-align: center" readonly="" value="<?php echo date('Y-m-d') ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Sales Person : </span></td>
                            <td><input type="text" name="salesperson" id="salesperson" /></td>
                        </tr>
                        <tr>
                            <td align="right" style="border-right: 1px #009999 solid;"><span class="labelelement">Testing : </span></td>
                            <td>
                                
                                <!--<table width="100%">-->
                                    <?php
                                    $i = 1;
                                    foreach ($testing as $testing) {
//                                        if ($i == 1) {
//                                            echo "<tr>";
//                                        }
                                        echo "<span style='display: inline-block;padding:5px;'><input type='checkbox' value='" . $testing->id . "' name='testing[]'>&nbsp;" . $testing->name . "</span>";
//                                        if ($i == 3) {
//                                            echo "</tr>";
//                                            $i = 0;
//                                        }
//                                        $i++;
                                    }
                                    ?>
                                <!--</table>-->
                            </td>
                        </tr>                        
                    </table>
                </td>                    
            </tr>            
            <tr>
                <td colspan="3"><br/>
                    <input type='hidden' id="input" value="0" />
                    <table width="100%" class="tablesorter">
                        <thead>
                            <tr>
                                <th width="20%">Code</th>                                    
                                <th width="35%">Description</th>
                                <th width="20%">Finishing Overview</th>
                                <th width="20%">Construction Overview</th>
                                <th width="5%">Qty</th>
                            </tr>
                        </thead>
                        <tbody id="itemso">
                            <tr>
                                <td>
                                    <input type="text" style="width: 80%" id="modelcode0" name="modelname[]"/>
                                    <input type="hidden" id="modelid0" name="modelid[]"/>
                                    <input type="hidden" id="rfqdetailid" name="rfqdetailid[]" value="0"/>
                                    <img src="images/list.png" class="miniaction" onclick="model_choose2('model',0)" />
                                </td>                                    
                                <td><textarea id="modeldescription0"style="width: 100%" readonly=""></textarea></td>                                
                                <td><textarea id="modelfinishing0" style="width: 100%" readonly=""></textarea></td>
                                <td><textarea id="modelfabrication0" style="width: 100%" readonly=""></textarea></td>
                                <td><input type="text" style="width: 100%;text-align: center" id="qty0" name="qty[]" value="1" onchange="if($(this).val()=='' || $(this).val()=='0' || isNaN($(this).val())){alert('Required NUMBER and Not Allow 0 or NULL');$(this).val(1)}"/></td>
                                <td align="center"><img src="images/delete.png" onclick="so_deleteitem(this)" style="cursor: pointer"/> </td>                                
                            </tr>
                        </tbody>                            
                    </table>                    
                    <button onclick="so_additem()" style="margin-top: 3px;">New Item</button>
                </td>
            </tr>     
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>      
        </table>
        <br/>
        <button onclick="so_insert()">Save</button>
        <button onclick="so_view()">Cancel</button>
        <button onclick="so_create()">Reset</button>
        <br/><br/>
    </div>
</center>