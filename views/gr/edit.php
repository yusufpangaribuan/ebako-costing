
<div style="width: 700px;">
    <table width="95%" border="0">
        <tr valign="top">
            <td width="30%">
                <input type="hidden" name="id" id="id" value="<?php echo $gr->id ?>" />
                <b>SUPPLIER :<br/><?php echo $gr->vendorname ?> </b><br/>                
            </td>            
            <td width="30%">
                <table>
                    <tr>
                        <td><span class="labelelement">PO NUMBER</span></td>
                        <td>                            
                            <b>: <?php echo $gr->ponumber ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="labelelement">PO DATE</span></td>
                        <td>                            
                            <b>: <?php echo $gr->podate ?></b>
                        </td>

                    </tr>
                </table>
            </td>
            <td width="40%">
                <table>
                    <tr>
                        <td align="right"><span class="labelelement">Letter Number :</span></td>
                        <td><input type="text" id="letternumber" name="letternumber" size="15" value="<?php echo $gr->letternumber ?>"/></td>
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
                            <input type="text" id="receivedate" name="receivedate" value="<?php echo $gr->date ?>" style="text-align: center" size="10"/></td>
                    </tr>   
                    <tr>
                        <td align="right"><span class="labelelement">Received By :</span></td>
                        <td><input type="text" id="receivedby" name="receivedby" size="15" value="<?php echo $gr->receivedby ?>"/></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br/>
    <table border='0' width='100%' class="tablesorter">
        <thead>
            <tr>
                <th>No</th>
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
                    <td valign='top' class="border"><?php echo $result->itemdescription; ?></td>                
                    <td valign='top' align='center' class="border"><?php echo $result->qty; ?></td>
                    <td valign='top' align='center' class="border"><?php echo $result->outstanding; ?></td>
                    <td align="center"><input type="text" name="rqty[]" id="rqty" size="4" style="text-align: center" <?php echo $readonly ?> value="<?php echo $result->qty ?>"/></td>
                    <td align="center"><input type="text" name="rjqty[]" id="rjqty" size="4" style="text-align: center" <?php echo $readonly ?> value="<?php echo $result->rejectqty ?>"/></td>
                    <td><textarea name="note[]" id="note"><?php echo $result->note; ?></textarea></td>
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