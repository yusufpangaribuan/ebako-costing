<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_s_po_qzx').scrollableFixedHeaderTable('102%', '450', null, null, null, 'tbl_s_po_qzx');
    });
</script>
<table class="tablesorter2 scrollableFixedHeaderTable" width='100%' id="tbl_s_po_qzx">
    <thead>
        <tr>
            <th width="2%">No</th>
            <th width="6%">PO</th>
            <th width="6%">PR</th>
            <th width="6%">Date</th>
            <th width="8%">Department</th>                            
            <th width="12%">Amount</th>
            <th width="4%">Curr</th>
            <th>Vendor</th>
            <th width="8%">Payment Term</th>
            <th width="8%">Delivery Term</th>
            <th width="8%">Status</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $counter = $offset + 1;
        foreach ($po as $po) {
            $bgcolor = "";
            if ($po->status == 2) {
                $bgcolor = "bgcolor='#fff8e8'";
            } else if ($po->status == 0) {
                $bgcolor = "bgcolor='#eff0f3'";
            }
            $bgcolor_printed = "";
            if ($po->printed != 0) {
                $bgcolor_printed = "bgcolor='#80dcaf'";
            }
            ?>
            <tr>
                <td align="right" <?php echo $bgcolor ?>><?php echo $counter++; ?></td>
                <td align="center" <?php echo $bgcolor ?>><a href="javascript:void(0)" style="text-decoration: none" onclick="po_viewreceiveitem(<?php echo $po->id ?>)"> <?php echo $po->ponumber; ?></a></td>
                <td align="center" <?php echo $bgcolor ?>><?php echo $po->requestnumber; ?></td>
                <td align="center"><?php echo date('d/m/Y', strtotime($po->dates)); ?></td>
                <td><?php echo $po->departmentcode; ?></td>                                                                
                <td align="right">
                    <?php
                    if (in_array('hide_price', $accessmenu)) {
                        echo '-';
                    } else {
                        echo number_format($po->all_total_price, 2, '.', ',');
                    }
                    ?>
                </td>            
                <td align="center"><?php echo (in_array('hide_price', $accessmenu) ? "-" : $po->currency); ?></td>
                <td><?php echo "[" . $po->vendornumber . "]&nbsp;" . $po->vendorname; ?></td>
                <td align="center"><?php echo $po->payterm; ?></td>
                <td align="center"><?php echo $po->deliveryterm; ?></td>
                <td>                                    
                    <select id="status" onchange="po_changestatus(<?php echo $po->id ?>, this)" style="width: 100%;">
                        <?php
                        foreach ($postatus as $x => $x_value) {
                            if ($x == $po->status) {
                                echo "<option value=" . $x . " selected>" . $x_value . "</option>";
                            } else {
                                if ($po->status == 0) {
                                    if ($x == 1) {
                                        echo "<option value=" . $x . " disabled>" . $x_value . "</option>";
                                    } else {
                                        echo "<option value=" . $x . ">" . $x_value . "</option>";
                                    }
                                } else if ($po->status == 1) {
                                    echo "<option value=" . $x . " disabled>" . $x_value . "</option>";
                                } else if ($po->status == 2) {
                                    if ($x == 1) {
                                        echo "<option value=" . $x . " disabled>" . $x_value . "</option>";
                                    } else {
                                        echo "<option value=" . $x . ">" . $x_value . "</option>";
                                    }
                                }
                            }
                        }
                        ?>                                                      
                    </select>                    
                </td>
                <td <?php echo $bgcolor_printed; ?> id="po_s_td_action<?php echo $po->id ?>">
                    <a href="<?php base_url() ?>index.php/po/printpo/<?php echo $po->id ?>/3" onclick="$(this).parent().attr('bgcolor', '#80dcaf')" target="_blank"> <img src="images/print.png" class="miniaction"/>&nbsp;Print</a>&nbsp;
    <!--                    <a href="javascript:void(0)" style="text-decoration: none" onclick="po_viewstatus(<?php echo $po->id ?>)" class="miniaction"><img src="images/comment.png" class="miniaction" />&nbsp;Comment</a>-->
                    <?php
                    //echo "<a href='javascript:po_view_detail($po->id)'><img src='images/list.png' style='cursor: pointer'/>&nbsp;Detail</a>&nbsp;";
                    echo "<a href='javascript:po_view_detail_new($po->id)'><img src='images/list.png' style='cursor: pointer'/>&nbsp;Detail</a>&nbsp;";
                    if ($po->status != 1 && $this->session->userdata('department') == 8) {
                        if (in_array('edit', $accessmenu)) {
                            echo "<a href='javascript:po_edit($po->id)'><img src='images/edit.png' style='cursor: pointer'/>&nbsp;Edit</a>&nbsp;";
                        }
                    }
                    ?>                    
                </td>
            </tr>    
            <?php
            if ($po->status == 2) {
                ?>
                <tr <?php echo $bgcolor ?>>
                    <td colspan="3" align="right"><span class="labelelement">PO Close Approval</span></td>
                    <td colspan="9">
                        <table cellpaddinf="0" cellspacing="0">                            
                            <tr style="background: transparent">                                            
                                <td style="border:none;width: 150px;">
                                    <input type="hidden" id="approvallevel2<?php echo $po->id ?>" value="<?php echo $po->closeapprovallevel2 ?>" />
                                    <?php
                                    echo "<span style='color:#183837;font-weight:bold;'>" . $this->model_employee->getNameById($po->closeapprovallevel1) . "</span><br/>";
                                    echo (($po->approvallevel1status) == 0 ? "<font color='blue'>Outstanding</font>" : (($po->approvallevel1status == 1) ? "<font color='green'>Approve at:<br/>" . date('d/m/Y H:i:s', strtotime($po->approvetimelevel1)) : "</font><font color='red'>Cancel At: <br/>" . date('d/m/Y H:i:s', strtotime($po->approvetimelevel1)))) . "</font><br/>";
                                    if ($po->closeapprovallevel1 == $this->session->userdata('id') && ($po->approvallevel1status == 0 || $po->approvallevel1status == 2)) {
                                        echo "<button onclick=po_approveclose(" . $po->id . ",1,1)>Approve</button>&nbsp;";
                                        echo "<button onclick=po_approveclose(" . $po->id . ",2,1)>Cancel</button>";
                                    }
                                    ?>
                                </td>
                                <?php
                                if ($po->closeapprovallevel2 != "") {
                                    echo "<td style='border:none;width: 150px;'>";
                                    echo "<span style='color:#183837;font-weight:bold;'>" . $this->model_employee->getNameById($po->closeapprovallevel2) . "</span><br/>";
                                    if ($po->approvallevel1status != 1) {
                                        echo "<font color='#966e02'>Waiting</font>";
                                    } else {
                                        echo (($po->approvallevel2status) == 0 ? "<font color='blue'>Outstanding</font>" : (($po->approvallevel2status == 1) ? "Approve at:<br/>" . date('d/m/Y H:i:s', strtotime($po->approvaltimelevel2)) : "Cancel At: <br/>" . date('d/m/Y H:i:s', strtotime($po->approvaltimelevel2)))) . "<br/>";
                                        if ($po->closeapprovallevel2 == $this->session->userdata('id')) {
                                            if ($po->approvallevel2status != 1) {
                                                echo "<button onclick=po_approveclose('" . $po->id . "',1,2)>Approve</button>&nbsp;";
                                                echo "<button onclick=po_approveclose('" . $po->id . "',2,2)>Cancel</button>";
                                            }
                                        }
                                    }
                                    echo "</td>";
                                }
                                ?>
                                <td style="width: 400px;border:none;">
                                    <strong>Close Notes :</strong><br/>
                                    <p>
                                        <?php
                                        echo $po->statusdescription;
                                        ?>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php
            }

            if ($item_view == 1) {
                $podetail = $this->model_po->selectItemByPoId($po->id);
                ?>
                <tr>
                    <td colspan="3" align="right"><span class="labelelement">Detail Item</span></td>
                    <td colspan="9">
                        <table class="child" width="70%" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">MR / SR</th>
                                    <th width="20%">Item Code</th>
                                    <th width="35%">Item Description</th>
                                    <th width="10%">Unit</th>
                                    <th width="10%">Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($podetail as $result_po_detail) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $result_po_detail->mat_req_number . $result_po_detail->sr_number ?></td>
                                        <td><?php echo $result_po_detail->itempartnumber; ?></td>
                                        <td><?php echo $result_po_detail->itemdescription; ?></td>
                                        <td><?php echo $result_po_detail->unitcode; ?></td>
                                        <td align="right"><?php echo $result_po_detail->qty; ?>&nbsp;</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
<table width="100%">
    <tr>
        <td width="50%">
            <input type="hidden" id="offset" value="<?php echo $offset ?>" />
            <a href="javascript:po_search(<?php echo $first ?>)"> << First </a>
            <a href="javascript:po_search(<?php echo $prev ?>)"> < Prev </a>
            |
            <?php echo "Page $page of $num_page "; ?>
            |
            <a href="javascript:po_search(<?php echo $next ?>)"> Next > </a>
            <a href="javascript:po_search(<?php echo $last ?>)"> Last >> </a>
        </td>
        <td width="50%" align="right">
            Row <?php echo ($offset + 1) . " - " . ($next) . " of " . $num_rows ?>
        </td>
    </tr>
</table>
