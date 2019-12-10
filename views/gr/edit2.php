<div style="width: 800px;margin-right: 7px;padding: 2px" class="panel">
    <table width="100%" border="0">
        <tr valign="top">            
            <td width="60%">
                <table width="100%" border="0">
                    <tr>
                        <td width="30%"><span class="labelelement">Delivery Order No</span></td>
                        <td width="70%"><strong>:</strong> 
                            <input type="text" id="letternumber" name="letternumber" style="width: 80%" value="<?php echo $gr->letternumber?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="labelelement">Delivery Order Date</span></td>
                        <td><strong>:</strong> 
                            <script type="text/javascript" >
                                $(function () {
                                    $("#do_date").datepicker({
                                        dateFormat: "yy-mm-dd"
                                    }).focus(function () {
                                        $("#do_date").datepicker("show");
                                    });
                                });
                            </script>
                            <input type="text" id="do_date" name="do_date"  style="width: 50%" value="<?php echo $gr->do_date?>" size="12" readonly=""/></td>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="labelelement">Receive date</span></td>
                        <td><strong>:</strong>
                            <script type="text/javascript" >
                                $(function () {
                                    $("#receivedate").datepicker({
                                        dateFormat: "yy-mm-dd"
                                    }).focus(function () {
                                        $("#receivedate").datepicker("show");
                                    });
                                });
                            </script>
                            <input type="text" id="receivedate" name="receivedate"  style="width: 50%" value="<?php echo $gr->receivedate?>"/></td>
                    </tr>                        
                    <tr>
                        <td><span class="labelelement">Received By</span></td>
                        <td><strong>:</strong> <input type="text" id="receivedby" name="receivedby" readonly="true" value="<?php echo $gr->name_received ?>"  style="width: 80%"/></td>
                    </tr>
                </table>
            </td>
            <td width="40%">
                <b>SUPPLIER :<br/> <?php echo $gr->vendorname ?></b><br/> 
            </td>
        </tr>
    </table>
    <br/>
    <table border='0' width='100%' class="tablesorter">
        <thead>
            <tr>
                <th>No</th>
                <th>PO</th>
                <th>Item Description</th>            
                <th>Qty. Request</th>
                <th>OTS</th>
                <th>Qty. Receive</th>            
                <th>Qty. Reject</th>
                <th>Notes</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php
        $total = 0;
        if (!empty($gritem)) {
            $counter = 1;
            foreach ($gritem as $result) {
                $readonly = ($result->qccheck == 't') ? "readonly" : "";
                ?>
                <tr>
                    <td valign='top' class="border">
                        <input type="hidden" name="gritemid[]" value="<?php echo $result->id; ?>" /> 
                        <?php echo $counter++; ?>
                    </td>  
                    <td valign='top'><?php echo $result->ponumber; ?></td>
                    <td valign='top' class="border"><?php echo $result->itemdescription; ?></td>                
                    <td valign='top' align='center' class="border"><?php echo $result->qty; ?></td>
                    <td valign='top' align='center' class="border"><?php echo $result->outstanding; ?></td>
                    <td align="center"><input type="text" name="rqty[]" id="rqty" size="4" style="text-align: center" <?php echo $readonly ?> value="<?php echo $result->qty ?>"/></td>
                    <td align="center"><input type="text" name="rjqty[]" id="rjqty" size="4" style="text-align: center" <?php echo $readonly ?> value="<?php echo $result->rejectqty ?>"/></td>
                    <td><input type="text" name="note[]" id="note" value="<?php echo $result->note; ?>" style="width: 100%"/></td>
                    <td align="center"><img src="images/delete.png" class="miniaction" onclick="gr_deleteitem(this,<?php echo $result->id . "," . $gr->id ?>)"/></td>
                </tr>
                <?php
            }
        }
        ?>    
    </table>
    <!--    <br/>    
        <button onclick="gr_update()">Update</button>
        <button onclick="gr_edit(<?php echo $gr->id ?>)">Reset</button>
        <button onclick="gr_view()">Cancel</button>
        <br/>
        <br/>-->
</div>