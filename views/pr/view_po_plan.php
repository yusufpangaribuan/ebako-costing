<center>
    <div class="panel" style="width: 800px;margin: 10px;">
        <table align="center" width="100%" border="0"> 
            <tr>
                <td>
                    <?php
                    foreach ($po_temp as $result) {
                        $query = "
                            select 
                            pritem.*,
                            item.partnumber item_code,
                            item.descriptions item_description,
                            unit.names unitname
                            from pritem
                            join unit on pritem.unitid=unit.id
                            join item on pritem.itemid=item.id
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
                                        <td><?php echo "Code: " . $rst->item_code . "<br/> Description: " . $rst->item_description . "<br/> Unit: " . $rst->unitname; ?></td>
                                        <td align="center"><?php echo $rst->qty ?></td>
                                        <td align="right"><?php echo number_format($rst->price, 2) ?></td>
                                        <td align="right"><?php echo number_format($rst->total, 2) ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="4" align="right"> 
                                        <table width="250" cellpadding="0" cellspacing="0" class="tablesorter">
                                            <tr style="background: #ffffff;">
                                                <td align = "right" width = "150" style = "border: none"><strong>Amount : </strong></td>
                                                <td width = "100" align = "right" style = "border: none"><?php echo number_format($result->amount, 2)
                                ?></td>
                                            </tr>
                                            <tr style="background: #ffffff;">
                                                <td align="right" style="border: none"><strong>Disc <?php echo $result->discount_percent ?> % : </strong></td>
                                                <td align="right" style="border: none"><?php echo number_format($result->discount, 2) ?></td>
                                            </tr>
                                            <tr style="background: #ffffff;">
                                                <td align="right" style="border: none"><strong>Amount - Discount : </strong></td>
                                                <td align="right" style="border: none"><?php echo number_format($result->sub_total, 2) ?></td>
                                            </tr>
                                            <tr style="background: #ffffff;">
                                                <td align="right" style="border: none"><strong>PPn <?php echo $result->tax_percent ?> % : </strong></td>
                                                <td align="right" style="border: none"><?php echo number_format($result->tax, 2) ?></td>
                                            </tr>
                                            <tr style="background: #ffffff;">
                                                <td align="right" style="border: none"><strong>Grand Total : </strong></td>
                                                <td align="right" style="border: none"><?php echo number_format($result->total_amount, 2) ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                    }
                    ?>
                </td>
            </tr>
        </table>
    </div>
</center>

