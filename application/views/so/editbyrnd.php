<br/>
<br/>
<center>
    <div style="width: 80%;" class="panel">           
        <h4 style="margin-bottom: 3px;">Detail Sales Order</h4>
        <?php
        if ($so->isfinalbom == 'f') {
            ?>
            <button style="float: left;margin-left: 3px;" <?php echo (($iscompletestatus) ? "" : "disabled='true'"); ?> onclick="so_createfinalbom(<?php echo $soid ?>)">Create Final BOM</button>
            <?php
        }        
        ?>                
        <table width="100%" border="0">
            <tr valign="top">
                <td width="40%" align="left">
                    <table width="100%">
                        <tr>
                            <td width="40%" align="right"><span class="labelelement">Customer : </span></td>
                            <td width="60%">
                                <input type="hidden" value="<?php echo $soid ?>" id="soid" name="soid"/>
                                <select id="billto" style="width: 100px;" onchange="so_changebillto(this);so_customergetAddress(this)" disabled="true">
                                    <option value="0">--Customer--</option>
                                    <?php
                                    foreach ($customer as $result) {
                                        if ($result->id == $so->customerid) {
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
                            <td align="right"><span class="labelelement">Ship To : </span></td>
                            <td>
                                <select id="shipto" style="width: 100px;" onchange="so_customergetAddress(this)">  
                                    <option value="0">--Ship To--</option>
                                    <?php
                                    foreach ($customer as $result) {
                                        if ($result->id == $so->shiptoid) {
                                            echo "<option value='" . $result->id . "' selected>" . $result->name . "</option>";
                                        } else {
                                            echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>  
                        <tr valign="top">
                            <td align="right"><span class="labelelement">Shipping Address : </span></td>
                            <td><textarea id="shippingaddress" name="shippingaddres" style="width: 100%;"><?php echo $so->shippingaddress ?></textarea></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Shipment Schedule : </span></td>
                            <td><input type="text" name="shipmentschedule" id="shipmentschedule" size="9" value="<?php echo $so->shipmentschedule ?>" style="text-align: center"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Shipment Via : </span></td>
                            <td>
                                <select name="shipvia" id="shipvia">
                                    <?php
                                    foreach ($shipmentvia as $shipmentvia) {
                                        if ($shipmentvia == $so->shipvia) {
                                            echo "<option value='" . $shipmentvia . "' selected>" . $shipmentvia . "</option>";
                                        } else {
                                            echo "<option value='" . $shipmentvia . "'>" . $shipmentvia . "</option>";
                                        }
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
                                        if ($result->id == $so->paymenttermid) {
                                            echo "<option value='" . $result->id . "' selected>" . $result->description . "</option>";
                                        } else {
                                            echo "<option value='" . $result->id . "'>" . $result->description . "</option>";
                                        }
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
                            <td width="40%" align="right"><span class="labelelement">PO No. : </span></td>
                            <td width="60%"><input type="text" name="ponumber" id="ponumber" value="<?php echo $so->ponumber ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right" width="40%"><span class="labelelement">Order No. : </span></td>
                            <td><input type="text" style="width: 45%" id="number" readonly="" value="<?php echo $so->number ?>"/></td>
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
                                <input type="text" size="9" id="date" name="date" style="text-align: center" readonly="" value="<?php echo date('Y-m-d') ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Sales Person : </span></td>
                            <td><input type="text" name="salesperson" id="salesperson" value="<?php echo $so->salesperson ?>"/></td>
                        </tr>
                        <tr valign="top">
                            <td align="right"><span class="labelelement">Testing : </span></td>
                            <td>
                                <table width="100%">
                                    <?php
                                    $strarray = str_replace(array("{", "}"), "", $so->testing);
                                    $arrtesting = explode(',', $strarray);
                                    $i = 1;
                                    foreach ($testing as $testing) {
                                        $checked = "";
                                        if (in_array($testing->id, $arrtesting)) {
                                            $checked = "checked";
                                        }
                                        if ($i == 1) {
                                            echo "<tr>";
                                        }
                                        echo "<td><input type='checkbox' value='" . $testing->id . "' name='testing[]' $checked>&nbsp;" . $testing->name . "</td>";
                                        if ($i == 3) {
                                            echo "</tr>";
                                            $i = 0;
                                        }
                                        $i++;
                                    }
                                    ?>
                                </table>
                            </td>
                        </tr>                        
                    </table>
                </td>                    
            </tr>            
            <tr>
                <td colspan="3"><br/>
                    <table width="100%" class="tablesorter">
                        <thead>
                            <tr>
                                <th width="15%">Code</th>                                    
                                <th width="35%">Description</th>
                                <th width="20%">Finishing Overview</th>
                                <th width="20%">Construction Overview</th>
                                <th width="5%">Qty</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="itemso">
                            <?php
                            foreach ($sodetail as $result) {
                                ?>
                                <tr>
                                    <td>
                                        <input type="text" style="width: 100%" id="modelcode0" name="modelcode[]" value="<?php echo $result->no ?>"/>                                        
                                    </td>                                    
                                    <td><textarea id="modeldescription0"style="width: 100%" readonly=""><?php echo $result->modeldescription ?></textarea></td>                                
                                    <td><textarea id="modelfinishing0" style="width: 100%" readonly=""><?php echo $result->finishoverview ?></textarea></td>
                                    <td><textarea id="modelfabrication0" style="width: 100%" readonly=""><?php echo $result->constructionoverview ?></textarea></td>
                                    <td><input type="text" style="width: 100%;text-align: center" id="qty0" readonly="" name="qty[]" value="<?php echo $result->qty ?>" onchange="if($(this).val()=='' || $(this).val()=='0' || isNaN($(this).val())){alert('Required NUMBER and Not Allow 0 or NULL');$(this).val(1)}"/></td>
                                    <td align="center">
                                        <select style="width: 100%" onchange="so_updatedetailstatus(<?php echo $soid . "," . $result->id.",".$result->modelid ?>,this)">
                                            <?php
                                            foreach ($sodetailstatus as $key => $value) {
                                                if ($key == $result->status) {
                                                    echo "<option value='$key' selected>" . $value . "</option>";
                                                } else {
                                                    if ($so->isfinalbom == 't') {
                                                        echo "<option value='$key' disabled='true'>" . $value . "</option>";
                                                    } else {
                                                        echo "<option value='$key'>" . $value . "</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>                                
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>                            
                    </table>
                </td>
            </tr>         
        </table>
        <br/>        
        <button onclick="so_view()">Cancel</button>
        <button onclick="so_edit(<?php echo $soid ?>)">Reset</button>
        <?php
        if ($so->finishbyrnd == 'f' && $so->isfinalbom == 't') {
            echo "<button onclick='so_finishbyRnd($soid)' style='float: right;margin-right: 5px;'><< Finish >></button>";
        }
        ?>
        <br/><br/>
    </div>
</center>