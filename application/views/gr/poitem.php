<center>    
    <div style="width: 700px;">
        <table width="100%" border="0">
            <tr valign="top">
                <td width="20%">
                    <b>SUPPLIER :<br/><?php echo $po->vendorname ?> </b><br/>                
                </td>            
                <td width="40%">
                    <table>
                        <tr>
                            <td><span class="labelelement">PO NUMBER</span></td>
                            <td>
                                <input type="hidden" id="poid" value="<?php echo $po->id ?>" />
                                <b>: <?php echo $po->ponumber ?></b>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="labelelement">PO DATE</span></td>
                            <td>
                                <b>: <?php echo date('d/m/Y', strtotime($po->dates)); ?></b>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="labelelement">Delivery Order Date</span></td>
                            <td><b>: 
                                    <script type="text/javascript" >
                                        $(function () {
                                            $("#do_date").datepicker({
                                                dateFormat: "yy-mm-dd"
                                            }).focus(function () {
                                                $("#do_date").datepicker("show");
                                            });
                                        });
                                    </script>
                                <input type="text" id="do_date" name="do_date" style="text-align: center" size="12" readonly=""/></td>
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="40%">
                    <table>
                        <tr>
                            <td align="right"><span class="labelelement">Delivery Order No : </span></td>
                            <td><input type="text" id="letternumber" name="letternumber"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Receive date :</span></td>
                            <td>
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#receivedate").datepicker({
                                            dateFormat: "yy-mm-dd"
                                        }).focus(function () {
                                            $("#receivedate").datepicker("show");
                                        });
                                    });
                                </script>
                                <input type="text" id="receivedate" name="receivedate" value="<?php echo date('Y-m-d') ?>" style="text-align: center" size="10"/></td>
                        </tr>                        
                        <tr>
                            <td align="right"><span class="labelelement">Received By :</span></td>
                            <td><input type="text" id="receivedby" name="receivedby" readonly="true" value="<?php echo $this->model_employee->getNameById($this->session->userdata('id')) ?>"/></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br/>
        <table border='0' width='100%' class="tablesorter2">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="10%">Code</th>
                    <th width="30%">Description</th>
                    <th width="5%">Unit</th>
                    <th width="5%">Request</th>
                    <th width="15%">Ots</th>
                    <th width="10%">Receive</th>            
                    <th width="10%">Reject</th>
                    <th width="10%">Notes</th>
                </tr>
            </thead>
            <?php
            $total = 0;
            if (!empty($poitem)) {
                $counter = 1;
                foreach ($poitem as $poitem) {
                    $allow = false;
//                    echo $allow;
                    if ($poitem->qccheck == 'f') {
                        ?>
                        <tr>
                            <td valign='top' align="right">
                                <input type="hidden" name="poitemid[]" value="<?php echo $poitem->id; ?>" /> 
                                <?php echo $counter++; ?>
                            </td>  
                            <td valign='top'><?php echo $poitem->itempartnumber; ?></td>
                            <td valign='top'>
                                <?php echo $poitem->itemdescription ?>
                            </td>
                            <td valign='top' align="center"><?php echo $poitem->unitcode; ?></td>                        
                            <td valign='top' align='center'><?php echo $poitem->qty; ?></td>
                            <td valign='top' align='center'><input type="text" name="ots[]" value="<?php echo $poitem->outstanding; ?>" id="rcv_qty_ots<?php echo $poitem->id; ?>" readonly="true" size="4" style="text-align: center;"/></td>
                            <td align="center">
                                <input type="text" name="rqty[]" id="rqty" size="4" style="text-align: center;width: 100%" value="0" onblur="
                                        if ($(this).val() === '' || parseFloat($(this).val()) < 0 || isNaN($(this).val())) {
                                            alert('Required NUMBER not Allow Negative Number');
                                            $(this).val(0);
                                        } else {
                                            if ((parseFloat($(this).val())) > (parseFloat($('#rcv_qty_ots<?php echo $poitem->id ?>').val()))) {
                                                alert('Out of outstanding qty');
                                                $(this).val(0);
                                            }
                                        }"/>
                            </td>
                            <td align="center">
                                <input type="text" name="rjqty[]" id="rjqty" size="4" style="text-align: center" value="0" onblur="if ($(this).val() == '' || parseFloat($(this).val()) < 0 || isNaN($(this).val())) {
                                            alert('Required NUMBER not Allow Negative Number');
                                            $(this).val(0)
                                        }"/>
                            </td>
                            <td><textarea name="note[]" id="note"></textarea></td>
                        </tr>
                        <?php
                    } else {
                        if ($this->model_po->isAllowItem($poitem->id)) {
                            $query = "select * from gritemcheck where poitemid=" . $poitem->id . " and status=false";
                            $data_inpection = $this->db->query($query)->result();
                            foreach ($data_inpection as $inspection_result) {
                                ?>
                                <tr>
                                    <td valign='top' align="right">
                                        <input type="hidden" name="poitemid[]" value="<?php echo $poitem->id; ?>" /> 
                                        <?php echo $counter++; ?>
                                    </td>  
                                    <td valign='top'><?php echo $poitem->itempartnumber; ?></td>
                                    <td valign='top'>
                                        <?php echo $poitem->itemdescription ?>
                                    </td>
                                    <td valign='top' align="center"><?php echo $poitem->unitcode; ?></td>                        
                                    <td valign='top' align='center'><?php echo $poitem->qty; ?></td>
                                    <td valign='top' align='center'><input type="text" name="ots[]" value="<?php echo $poitem->outstanding; ?>" id="rcv_qty_ots<?php echo $poitem->id; ?>" readonly="true" size="4" style="text-align: center;"/></td>
                                    <td align="center">
                                        <input type="hidden" name="qltid[]" value="<?php echo $inspection_result->id ?>" />
                                        <input type="text" name="rqty[]" id="rqty" size="4" style="text-align: center;width: 100%" value="0" onblur="gr_isvalid(this,<?php echo $inspection_result->id ?>)"/>
                                        <input type="hidden" id="qltyqty<?php echo $inspection_result->id ?>" value="<?php echo $this->model_po->getQtyReceiveQuality2($inspection_result->id) ?>" />
                                        <span style="float: right"><?php echo "Q. In : " . $this->model_po->getQtyReceiveQuality2($inspection_result->id) ?></span>
                                    </td>
                                    <td align="center">
                                        <input type="text" 
                                               name="rjqty[]" 
                                               id="rjqty" 
                                               size="4" 
                                               readonly="" 
                                               style="text-align: center" value="0" 
                                               onblur="
                                                       if ($(this).val() === '' || parseFloat($(this).val()) < 0 || isNaN($(this).val())) {
                                                           alert('Required NUMBER not Allow Negative Number');
                                                           $(this).val(0)
                                                       }"
                                               />
                                    </td>
                                    <td><textarea name="note[]" id="note"></textarea></td>
                                </tr>
                                <?php
                            }
                        }
                    }
                }
            }
            ?>    
        </table>
        <!--        <br/>    
                <button onclick="gr_receiveitem()">Save</button>
                <button onclick="$('#form_dialog').dialog('close')">Cancel</button>
                <br/>
                <br/>-->
    </div>
</center>