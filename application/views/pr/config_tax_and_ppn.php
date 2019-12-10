<center>
    <div class="panel" style="width: 800px">
        <form id="pr_prepare_po" onsubmit="return false;">
            <table align="center" width="100%" border="0"> 
                <tr>
                    <td>
                        <?php
                        foreach ($po_temp as $result) {
                            $query = "
                            select 
                            pritem.*,
                            unit.names unitname
                            from pritem
                            join unit on pritem.unitid=unit.id
                            where pritem.prid=" . $result->prid . " 
                            and pritem.vendorid=" . $result->vendorid . " 
                            and pritem.currency='" . $result->currency . "'
                        ";
                            $pritem = $this->db->query($query)->result();
                            ?><br/>
                            <span style="color:#032550;font-weight:bold;">
                                <?php echo strtoupper($result->vendor) . " (" . $result->currency . ")" ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                PR NO: 
                                <a onclick="pr_preview(<?php echo $result->prid ?>, 0)" href="javascript:void(0)">
                                    <?php echo $result->pr_no ?>
                                </a>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                MR NO: 
                                <a style="color:#800000;" href="javascript:materialrequisition_viewdetail(<?php echo $result->materialrequisitionid ?>)"><?php echo $result->mr_no ?></a>

                            </span>
                            <table class="tablesorter2" width="100%">
                                <thead>
                                    <tr>
                                        <th width="50%">Item Description</th>
                                        <th width="8%">Qty</th>
                                        <th width="18%">U/Price</th>
                                        <th width="24%">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($pritem as $rst) {
                                        ?>
                                        <tr valign="top">
                                            <td><?php echo "Code: " . $rst->itempartnumber . "<br/> Description: " . $rst->itemdescription . "<br/> Unit: " . $rst->unitname; ?></td>
                                            <td><input type="text" value="<?php echo $rst->qty ?>" style="width: 100%;text-align: center;" readonly=""/></td>
                                            <td><input type="text" value="<?php echo $rst->price ?>" style="width: 100%;text-align: right;" readonly=""/></td>
                                            <td><input type="text" value="<?php echo $rst->total ?>" style="width: 100%;text-align: right;" readonly=""/></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="4" align="right"> 
                                            <input type="hidden" name="po_temp_id[]" value="<?php echo $result->id ?>" />
                                            <label class="labelelement">Amount : </label>
                                            <input type="text" style="width: 100px;text-align: right;" name="pr_total_amount[]" id="pr_total_amount<?php echo $result->id ?>" readonly="" value="<?php echo $result->amount ?>"/><br/>
                                            <label class="labelelement">Disc : </label>
                                            <input type="tex" style="width: 25px;text-align: center;" name="pr_disc_percent[]" id="pr_disc_percent<?php echo $result->id ?>" value="<?php echo $result->discount_percent ?>" onkeyup="pr_calculate_discount(<?php echo $result->id ?>)"/> % =
                                            <input type="text" style="width: 100px;text-align: right;" name="pr_discount[]" id="pr_discount<?php echo $result->id ?>" readonly="" value="<?php echo $result->discount ?>"/><br/>
                                            <label class="labelelement">Amount - Discount : </label>
                                            <input type="tex" style="width: 150px;text-align: right;" name="pr_sub_total[]" readonly="" id="pr_sub_total<?php echo $result->id ?>" value="<?php echo $result->sub_total ?>"/><br/>
                                            <label class="labelelement">Ppn : </label>
                                            <input type="checkbox"  name="pr_ppn_check[]" id="pr_ppn_check<?php echo $result->id ?>" onclick="pr_ppn_check(<?php echo $result->id ?>)" <?php echo ($result->tax_percent != 0 ) ? 'checked' : ''; ?>/>&nbsp;&nbsp;
                                            <input type="tex" style="width: 25px;text-align: center;" name="pr_ppn_percent[]" id="pr_ppn_percent<?php echo $result->id ?>" value="<?php echo $result->tax_percent ?>" readonly=""/> % = 
                                            <input type="text" style="width: 100px;text-align: right;" name="pr_ppn[]" id="pr_ppn<?php echo $result->id ?>" value="<?php echo $result->tax ?>"/><br/>
                                            <label class="labelelement">Grand Total : </label>
                                            <input type="tex" style="width: 150px;text-align: right;" name="pr_grand_total[]" id="pr_grand_total<?php echo $result->id ?>" value="<?php echo $result->total_amount ?>"/><br/>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td align="center"><br/>
                        <button type="button" onclick="pr_save_prepare_po()">Save</button>&nbsp;
                        <button type="button" onclick="$('#config_tax_and_ppn_dialog').dialog('close')">Cancel</button>&nbsp;
                        <br/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</center>

