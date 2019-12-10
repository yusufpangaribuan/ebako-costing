<br/>
<br/>
<center>
    <div style="width: 80%;" class="panel">           
        <h4 style="margin-bottom: 3px;">Edit Sales Order</h4>
        <table width="100%" border="0">
            <tr valign="top">
                <td width="40%" align="left">
                    <table width="100%">
                        <tr>
                            <td width="40%" align="right"><span class="labelelement">Customer : </span></td>
                            <td width="60%">
                                <input type="hidden" value="<?php echo $soid ?>" id="soid" name="soid"/>
                                <select id="billto" style="width: 100%;" onchange="so_changebillto(this);
                                        so_customergetAddress(this)" disabled="true">
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
                                <select id="shipto" style="width: 100%;" onchange="so_customergetAddress(this)">  
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
                            <td><input type="text" name="shipmentschedule" id="shipmentschedule" size="12" value="<?php echo $so->shipmentschedule ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Shipment Via : </span></td>
                            <td>
                                <select name="shipvia" id="shipvia" style="width: 50%">
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
                                <select id="paymentterm" name="paymentterm" style="width: 100%;">
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
                            <td width="40%" align="right"><span class="labelelement">PO No : </span></td>
                            <td width="60%"><input type="text" name="ponumber" id="ponumber" value="<?php echo $so->ponumber ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right" width="40%"><span class="labelelement">Order No : </span></td>
                            <td><input type="text" style="width: 45%" id="number" readonly="" value="<?php echo $so->number ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right" width="40%"><span class="labelelement">Date : </span></td>
                            <td>
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#date").datepicker({
                                            dateFormat: "yy-mm-dd"
                                        }).focus(function () {
                                            $("#date").datepicker("show");
                                        });
                                        $("#shipdate").datepicker({
                                            dateFormat: "yy-mm-dd"
                                        }).focus(function () {
                                            $("#shipdate").datepicker("show");
                                        });
                                        $("#shipmentschedule").datepicker({
                                            dateFormat: "yy-mm-dd"
                                        }).focus(function () {
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
                                    foreach ($testing as $testing) {
                                        $checked = "";
                                        if (in_array($testing->id, $arrtesting)) {
                                            $checked = "checked";
                                        }
                                        echo "<span style='display: inline-block;padding:5px;'><input type='checkbox' value='" . $testing->id . "' name='testing[]' $checked>&nbsp;" . $testing->name . "</span>";
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
                                <th>Act</th>
                            </tr>
                        </thead>
                        <tbody id="itemso">
                            <?php
                            foreach ($sodetail as $result) {
                                ?>
                                <tr>
                                    <td>
                                        <input type="hidden" id="id<?php echo $result->id ?>" name="id[]" value="<?php echo $result->id ?>" />
                                        <input type="hidden" id="modelid<?php echo $result->id ?>" name="modelid[]" value="<?php echo $result->modelid ?>" />
                                        <input type="text" style="width: 100%" id="modelcode0" name="modelcode[]" value="<?php echo $result->no ?>"/>                                        
                                    </td>                                    
                                    <td><textarea id="modeldescription0"style="width: 100%" readonly=""><?php echo $result->modeldescription ?></textarea></td>                                
                                    <td><textarea id="modelfinishing0" style="width: 100%" readonly=""><?php echo $result->finishoverview ?></textarea></td>
                                    <td><textarea id="modelfabrication0" style="width: 100%" readonly=""><?php echo $result->constructionoverview ?></textarea></td>
                                    <td><input type="text" style="width: 100%;text-align: center" id="qty0" name="qty[]" value="<?php echo $result->qty ?>" onchange="if ($(this).val() == '' || $(this).val() == '0' || isNaN($(this).val())) {
                                                alert('Required NUMBER and Not Allow 0 or NULL');
                                                $(this).val(1)
                                            }"/></td>
                                    <td align="center">
                                        <?php
                                        if ($so->finishbyrnd == 'f') {
                                            ?>
                                            <img src="images/delete.png" onclick="so_deleteitem2(<?php echo $result->id ?>, this)" style="cursor: pointer"/>
        <?php
    }
    ?>

                                    </td>
                                </tr>
    <?php
}
?>

                        </tbody>                            
                    </table>
                    <?php
                    if ($so->finishbyrnd == 'f') {
                        echo "<button onclick='so_additem2()' style='margin-top:3px;'>Add new item</button>";
                    }
                    ?>

                </td>
            </tr>                 
        </table>
        <br/>
        <br/>
        <?php
        if (in_array('edit', $accessmenu)) {
            echo "<button onclick='so_update()'>Update</button>";
        }
        ?>
        <button onclick="so_view()">Cancel</button>
        <button onclick="so_edit(<?php echo $soid ?>)">Reset</button>
        <?php
        if ($so->finishbymarketing == 'f') {
            echo "<button onclick='so_finishbymarketing($soid)' style='margin-right: 5px;float: right;'><< Finish >></button>";
        }
        ?>
        <br/><br/>
    </div>
</center>