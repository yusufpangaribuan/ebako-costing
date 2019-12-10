<!--<button onclick="po_edit(<?php echo $po->id ?>)">Edit</button>-->
<center>
    <div class="panel" style="width: 800px;margin-right: 5px;">
        <form id="po_edit_form" onsubmit="return flase">
            <table align="center" border="0" width="100%">
                <tr>
                    <td colspan="5" align="center">&nbsp;</td>
                </tr>    
                <tr>
                    <td width="15%" align="right"><span class="labelelement">To :</span></td>
                    <td width="25%">
                        <input type="hidden" name="id" id="id" value="<?php echo $po->id ?>" />
                        <select style="width: 150px">
                            <?php
                            foreach ($vendor as $vendor) {
                                if ($vendor->id == $po->vendorid) {
                                    echo "<option value = '" . $vendor->id . "' selected>" . $vendor->name . "</option>";
                                } else {
                                    echo "<option value = '" . $vendor->id . "'>" . $vendor->name . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td width="20%">&nbsp;</td>
                    <td width="15%" align="right"><span class="labelelement">Currency :</span></td>
                    <td width="25%"><input type="text" name="curr" id="curr" size="10" value="<?php echo $po->currency ?>" readonly=""/></td>
                </tr>
                <tr>
                    <td align="right"><span class="labelelement">PO No :</span></td>
                    <td><input type="text" name="pono" readonly="" id="pono" value="<?php echo $po->ponumber ?>"/></td>
                    <td>&nbsp;</td>
                    <td align="right"><span class="labelelement">Payment Term :</span></td>
                    <td><input type="text" name="payterm" id="payterm" value="<?php echo $po->payterm ?>"/></td>

                </tr>
                <tr>
                    <td align="right"><span class="labelelement">PR No :</span></td>
                    <td><input type="text" name="prno" id="prno" readonly="" value="<?php echo $po->requestnumber ?>"/></td>
                    <td>&nbsp;</td>
                    <td align="right"><span class="labelelement">Delivery Date :</span></td>
                    <td>
                        <script type="text/javascript" >
                            $(function () {
                                $("#deliveryterm").datepicker({
                                    dateFormat: "yy-mm-dd"
                                }).focus(function () {
                                    $("#deliveryterm").datepicker("show");
                                });
                            });
                        </script>
                        <input type="text" name="deliveryterm" id="deliveryterm" value="<?php echo $po->deliveryterm ?>"/>
                    </td>            
                </tr>
                <tr>
                    <td align="right"><span class="labelelement">Date :</span></td>
                    <td><input type="text" name="date" readonly="" id="date" value="<?php echo $po->dates ?>"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>            
                </tr>
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="5">
                        <!--<div style="float: right;margin-bottom: 3px;font-style: italic;">Click <img src="images/check.png"/> To Set As Costing Price</div>-->
                        <table width="100%" class="tablesorter">
                            <thead>
                                <tr>
                                    <th width="20%">Code</th>
                                    <th width="35%">Description</th> 
                                    <th width="5%">Unit</th>
                                    <th width="15%">Price/Unit</th>
                                    <th width="5%">Qty</th>
                                    <th width="20%">Total</th>
                                    <!--<th width="5%">Action</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_item_price = 0;
                                $total_qty = 0;
                                $total_matras_price = 0;
                                $total_ppn = 0;
                                $total_discount_a = 0;
                                $total_amount = 0;
                                $price_total_actual = 0;
                                foreach ($podetail as $podetail) {
                                    $total_item_price = ($podetail->qty * $podetail->price);
                                    $total_qty += $podetail->qty;
                                    $total_matras_price += $podetail->matras_price;
                                    $total_ppn += $podetail->ppn;
                                    $total_discount_a += $podetail->discount;
                                    $item_amount = ($total_item_price + $podetail->matras_price + $podetail->ppn) - ($podetail->discount);

                                    $total_amount += $item_amount;
                                    $price_total_actual += $total_item_price;
                                    ?>
                                    <tr valign="top">
                                        <td>
                                            <input type="hidden" name="pr_item_id[]" id="pritem_id" value="<?php echo $podetail->id ?>" />
                                            <input type="text" name="name[]" value="<?php echo $podetail->itempartnumber ?>" style="width: 100%;">
                                        </td>
                                        <td><textarea name="desciption[]" style="width: 100%;height: 30px;"><?php echo strip_tags($podetail->itemdescription); ?></textarea></td>
                                        <td><input type="text" name="unit" id="unit" value="<?php echo $podetail->unitcode; ?>" style="text-align: center;width: 100%;"/></td>
                                        <td><input type="text" value="<?php echo $podetail->price ?>" style="text-align: right;width: 100%;" name="price[]"></td>
                                        <td><input type="text" style="text-align: center;width: 100%; " value="<?php echo $podetail->qty; ?>" name="qty[]" id="qty<?php echo $podetail->itemid ?>" ></td>
                                        <td><input type="text" value="<?php echo ($podetail->price * $podetail->qty) ?>" style="text-align: right;width: 100%;" name="total_price_item[]"></td>
                                        <!--<td align="center"><img src="images/check.png" class="miniaction" title="Make As Costing Price" onclick="po_set_as_costing_price(<?php echo $podetail->itemid ?>)"/></td>-->
                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="4" align="right" style="font-size: 12px" ><b>Amount</b></td>
                                    <!--<td><input type="text" value="<?php echo $price_total_actual ?>" style="width: 100%;text-align: right;"/></td>-->
                                    <td><input type="text" value="<?php echo $total_qty ?>" style="width: 100%;text-align: center;" id="qty_total"/></td>
                                    <!--<td><input type="text" value="<?php echo $total_matras_price ?>" style="width: 100%;text-align: right;"/></td>-->
    <!--                                <td><input type="text" value="<?php echo $total_ppn ?>" style="width: 100%;text-align: right;"/></td>-->
    <!--                                <td><input type="text" value="<?php echo $total_discount_a ?>" style="width: 100%;text-align: right;"/></td>-->
                                    <td><input type="text" id="total_amount" value="<?php echo $total_amount ?>" style="width: 100%;text-align: right;"/></td>
                                    <!--<td>&nbsp;</td>-->
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="5" align="right" width="100%">
                        <table width="50%" border="0">
                            <tr>
                                <td align="right" width="30%"><strong>Disc <?php echo $po->discount_percentage ?> % : </strong></td>
                                <td width="30%">
                                    <input type="text" style="width: 100%;text-align: right;" name="discount" readonly="" value="<?php echo $po->discount ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><strong>Amount - Discount : </strong></td>
                                <td>
                                    <input type="text" style="width: 100%;text-align: right;" name="grandtotal" value="<?php echo $po->grandtotal ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><strong>Ppn <?php echo $po->ppn_percentage ?> %: </strong></td>
                                <td>
                                    <input type="text" style="width: 100%;text-align: right;" name="ppn" readonly="" value="<?php echo $po->ppn ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><strong>Grand Total : </strong></td>
                                <td><input type="text" style="width: 100%;text-align: right;" name="all_total_price" value="<?php echo $po->all_total_price ?>"/></td>
                            </tr>
                        </table>
                    </td>
                </tr>
    
                <tr>                
                    <td align="right" valign="top"><span class="labelelement">Sum Of :</span></td>
                    <td colspan="4" align="left">
                        <input type="text" id="sumof" name="sumof" style="width: 100%;" value="<?php echo $this->component->convert_number_to_words($po->all_total_price); ?>"/>
                        <!--<input type="text" id="sumof" name="sumof" style="width: 100%" value="" />-->
                    </td>                
                </tr>                        
            </table>
            <!--        <br/>
                    <button onclick="po_update()">Update</button>
                    <button onclick="$('#dialog_temp').dialog('close');">Cancel</button>
                    <button onclick="po_edit(<?php echo $po->id ?>)">Reset</button>
                    <br/>
                    <br/>-->
        </form>
    </div>

</center>