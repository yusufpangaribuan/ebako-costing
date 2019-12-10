<br/>
<br/>
<center>
    <div style="width:75%;" class="panel">           
        <h4>Request For Quotation</h4>
        <br/>                        
        <table width="100%" border="0">
            <tr valign="top">
                <td width="40%" align="left">
                    <table width="100%">
                        <tr>
                            <td align="right" width="40%"><span class="labelelement">RFQ. No : </span></td>
                            <td width="60%"><input type="text" size="15" id="number" value="<?php echo $rfq->number ?>" style="font-weight: bold;"/></td>
                        </tr>
                        <tr>
                            <td width="35%" align="right"><span class="labelelement">Customer : </span></td>
                            <td width="65%">
                                <input type="hidden" id="id" value="<?php echo $rfq->id ?>" />
                                <select id="billto" style="width: 100px;" onchange="so_changebillto(this);
                                        so_customergetAddress(this)">
                                    <option value="0">--Customer--</option>
                                    <?php
                                    foreach ($customer as $result) {
                                        if ($result->id == $rfq->customerid) {
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
                                    <?php
                                    foreach ($customer as $result) {
                                        if ($result->id == $rfq->shiptoid) {
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
                            <td><textarea id="shippingaddress" name="shippingaddres" style="width: 100%;"><?php echo $rfq->shippingaddress ?></textarea></td>
                        </tr>
                        <tr valign="top">
                            <td align="right"><span class="labelelement">Payment Term: </span></td>
                            <td>
                                <select id="paymenttermid" style="width: 100px;">
                                    <option value="0"></option>
                                    <?php
                                    foreach ($paymentterm as $result) {
                                        if ($rfq->paymenttermid == $result->id) {
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
                                            changeYear: true
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
                                <input type="text" size="10" id="date" name="date" size="10" value="<?php echo $rfq->date ?>" style="text-align: center"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Promised Date : </span></td>
                            <td><input type="text" name="promiseddate" id="promiseddate" size="10" readonly="" style="text-align: center" value="<?php echo $rfq->promiseddate ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Shipment Via : </span></td>
                            <td>
                                <select name="shipvia" id="shipvia">
                                    <?php
                                    foreach ($shipmentvia as $shipmentvia) {
                                        if ($shipmentvia == $rfq->shipvia) {
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
                            <td width="40%" align="right"><span class="labelelement">Sales person : </span></td>
                            <td width="60%"><input type="text" name="salesperson" id="salesperson" style="text-transform: uppercase" value="<?php echo $rfq->salesperson ?>"/></td>
                        </tr>
                        <tr>
                            <td width="40%" align="right" style="border-right: 1px #009999 solid;"><span class="labelelement">Testing : </span></td>
                            <td width="60%">
                                    <?php
                                    $strarray = str_replace(array("{", "}"), "", $rfq->testing);
                                    $arrtesting = explode(',', $strarray);
                                    $i = 1;
                                    foreach ($testing as $testing) {
                                        $checked = "";
                                        if (in_array($testing->id, $arrtesting)) {
                                            $checked = "checked";
                                        }

                                        echo "<span style='display: inline-block;padding:5px;'><input type='checkbox' value='" . $testing->id . "' name='testing[]' $checked>&nbsp;" . $testing->name . "</span>";
                                    }
                                    ?>
                            </td>
                        </tr>                        
                    </table>
                </td>                    
            </tr>       
            <tr>
                <td colspan="2"><br/>
                    <table width="100%" class="tablesorter">
                        <thead>
                            <tr>
                                <th width="15%">Code</th>                                    
                                <th width="35%">Description</th>
                                <th width="20%">Finis Overview</th>
                                <th width="20%">Construction Overview</th>
                                <th width="5%">Qty</th>      
                                <?php
                                if ($this->session->userdata('department') == 1 && $rfq->quotationdate == '') {
                                    ?>
                                    <th width="5%">ACT</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>                            
                            <?php
                            foreach ($rfqdetail as $result) {
                                $bgcolor = "";
                                if ($result->modelid == 0) {
                                    $bgcolor = "bgcolor='#fff4f2'";
                                }
                                ?>
                                <tr <?php echo $bgcolor ?>>
                                    <td>
                                        <input type="text" style="width: 100%" value="<?php echo $result->no; ?>"/>
                                        <?php
                                        if (in_array($result->type, array(2, 3))) {
                                            echo "<br/>Cust Code : " . $result->custcode . "<br/>";
                                            echo "<a href='javascript:rfq_item_attachment($result->id,$rfq->id)'>Attachment";
                                        }
                                        ?>
                                    </td>                                    
                                    <td>
                                        <?php
                                        if ($result->type == 1 || $result->type == 2) {
                                            $strdesc = $result->modeldescription;
                                        } else {
                                            if ($result->modelid != $result->refmodelid) {
                                                $strdesc = $result->modeldescription;
                                            } else {
                                                $strdesc = $result->description;
                                            }
                                        }
                                        ?>
                                        <textarea style="width: 100%"><?php echo $strdesc; ?></textarea>
                                        <?php
                                        if ($result->type == 2) {
                                            echo "<a href='javascript:rfq_notes(" . $result->id . ")'>notes..</a>";
                                        } else if ($result->type == 3) {
                                            if ($result->modelid != 0) {
                                                echo "<a href='javascript:rfq_notes(" . $result->id . ")'>notes..</a>";
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td><textarea id="modelfinishing0" style="width: 100%" readonly=""><?php echo $result->finishoverview ?></textarea></td>
                                    <td><textarea id="modelfabrication0" style="width: 100%" readonly=""><?php echo $result->constructionoverview ?></textarea></td>
                                    <td><input type="text" style="width: 100%;text-align: center" id="qty0" name="qty[]" value="<?php echo $result->qty; ?>" onchange="if ($(this).val() == '' || $(this).val() == '0' || isNaN($(this).val())) {
                                                alert('Required NUMBER and Not Allow 0 or NULL');
                                                $(this).val(1)
                                            }"/></td>
    <?php
    if ($this->session->userdata('department') == 1 && $rfq->quotationdate == '') {
        ?>
                                        <td align="center">                                        
                                            <img src="images/edit.png" onclick="rfq_edititem(<?php echo $result->id . "," . $result->type ?>)" class="miniaction"/>
                                            <img src="images/delete.png" onclick="rfq_deleteitem(<?php echo $rfq->id . "," . $result->id ?>)" class="miniaction"/>
                                        </td>
                                <?php } ?>
                                </tr>
    <?php
}
?>
                        </tbody>                            
                    </table> 
                    <div style="margin-top: 4px">                        
                        <?php if (in_array('add_model', $accessmenu)) { ?>
                            <button onclick="rfq_adddetail(<?php echo $rfq->id . ",1"; ?>)">Add Existing Model</button>
                            <button onclick="rfq_adddetail(<?php echo $rfq->id . ",2"; ?>)">Add Customize Model</button>
                            <button onclick="rfq_adddetail(<?php echo $rfq->id . ",3"; ?>)">Add New Model</button>
    <?php
}
?>
                    </div>
                </td>
            </tr>
        </table>
        <br/>
        <br/>
        <?php
        if ($this->session->userdata('department') == 1) {
            if (in_array('edit', $accessmenu)) {
                ?>
                <button onclick="rfq_update()">Save</button>                            
                <?php
            }
        }
        ?>
        <button onclick="rfq_edit(<?php echo $rfq->id ?>)">Reset</button>
        <button onclick="rfq_view()">Cancel</button>
        <?php
        if ($rfq->isprocess == 'f') {
            if (in_array('delete', $accessmenu)) {
                echo "<button onclick='rfq_delete(" . $rfq->id . ")'>Delete</button>";
            }
        }
        if ($rfq->isprocess == 'f' && $this->model_rfq->isHaveDetail($rfq->id)) {
            ?>        
            <button onclick="rfq_process(<?php echo $rfq->id ?>)" style="float: right;margin-right: 3px;">Process >></button>
    <?php
}
?>

        <br/><br/>
    </div>
</center>
