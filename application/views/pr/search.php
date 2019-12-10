<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_s_pr_qzx').scrollableFixedHeaderTable('102%', '500', null, null, null, 'tbl_s_pr_qzx');
    });
</script>
<table class="tablesorter2 scrollableFixedHeaderTable" width="100%" id="tbl_s_pr_qzx">
    <thead>
        <tr>
            <th width="1%">No</th>
            <th width="10%">PR</th>
            <th width="10%">Date</th>
            <th width="8%">Department</th>
            <th width="15%">MR/SR</th>
            <th width="12%">Amount</th>                       
            <th width="19%">Remark</th>
            <th width="5%">Status</th>
            <th width="20%">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $number = $offset + 1;
        foreach ($pr as $result) {
            $bgcolor = "";
            if (!$this->model_pr->iscompletepricecomparison($result->id)) {
                $bgcolor = "bgcolor='#fff984'";
            } else {
                if (!$this->model_approval->isComplete($result->id)) {
                    $bgcolor = "bgcolor='#ffe1a8'";
                } else {
                    if (!$this->model_pr->isHadPo($result->id)) {
                        $bgcolor = "bgcolor='#dcf9ef'";
                    }
                }
            }
            ?>
            <tr>
                <td width="1%" align="right" <?php echo $bgcolor ?>><?php echo $number++ ?></td>
                <td width="10%" align="center" <?php echo $bgcolor ?>>
                    <a href="javascript:void(0)" onclick="pr_preview(<?php echo $result->id . ",0" ?>)">
                        <?php echo $result->requestnumber ?>
                    </a>
                </td>
                <td width="10%" align="center"><?php echo date('d/m/Y', strtotime($result->requestdate)) ?></td>                            
                <td width="8%"><?php echo $this->model_pr->get_all_department_by_id($result->id); ?></td>
                <td width="15%">
                    <?php
                    if (!empty($result->mr_number)) {
                        $_mr = explode(',', $result->mr_number);
                        if (count($_mr) > 0) {
                            for ($i = 0; $i < count($_mr); $i++) {
                                $temp = explode('#', $_mr[$i]);
                                if ($i > 0) {
                                    echo ", ";
                                }
                                if (substr($temp[1], 0, 2) == 'MR') {
                                    echo "<a href='javascript:materialrequisition_viewdetail(" . $temp[0] . ")' style='color:#800000;'>" . $temp[1] . "</a>";
                                } else {
                                    echo "<a href='javascript:servicerequest_viewdetail(" . $temp[0] . ")' style='color:#800000;'>" . $temp[1] . "</a>";
                                }
                            }
                        }
                    }
                    ?>
                </td>
                <td width="12%" align="right">
                    <?php
                    $alltotal = $this->model_pricecomp->selectTotalPriceByPrId($result->id);
                    if (empty($alltotal)) {
                        echo "0";
                    } else {
                        foreach ($alltotal as $alltotal) {
                            echo number_format($alltotal->totalprice, 2, '.', ',') . " " . $alltotal->currency . "<br/>";
                        }
                    }
                    ?>
                </td>             
                <!--<td>&nbsp;</td>-->                                
                <td width="19%"><?php echo $result->remark ?></td>
                <td width="5%" align="center">
                    <?php
                    echo ($result->isclose == 'f') ? '' : 'FINISH';
                    ?>
                </td> 
                <td width="20%" align="left">                    
                    <?php
                    if ($this->session->userdata('department') == 8) {
                        if (!$this->model_pr->isHadPo($result->id)) {
                            if (in_array('add', $accessmenu)) {
                                ?>
                                <a href="javascript:void(0)" onclick="pr_add_item(<?php echo $result->id . ',0' ?>)" style="display: inline-block;padding-bottom: 3px"><img src='images/add.png' title='Edit'/> Add Item</a>&nbsp;|&nbsp;
                                <a href="javascript:void(0)" onclick="pr_add_service_item(<?php echo $result->id . ',0' ?>)" style="display: inline-block;padding-bottom: 3px;"><img src='images/add.png' title='Edit'/> Add Service</a>&nbsp;|&nbsp;
                                <?php
                            }
                            if (in_array('edit', $accessmenu)) {
                                echo "<a href = 'javascript:void(0)' onclick='pr_edit(" . $result->id . ")' style='display: inline-block;padding-bottom: 3px;'><img src='images/edit.png' title='Edit'/> Edit </a>&nbsp;|&nbsp;";
                            }
                            if (in_array('delete', $accessmenu)) {
                                echo "<a href = 'javascript:void(0)' onclick='pr_delete(" . $result->id . ")' style='display: inline-block;padding-bottom: 3px;'><img src='images/delete.png'  title='Delete'/> Delete &nbsp;</a><br/>";
                            }
                        }
                    }
                    ?>&nbsp;                   
                </td>
            </tr>
            <tr valign='top'>
                <td width="11%" colspan="2" align="right" <?php echo $bgcolor ?>>
                    <label class="labelelement">Approval : </label>
                    <?php
                    if (!$this->model_pr->isHadPo($result->id) && $this->model_approval->isHaveApproval($result->id)) {
                        if ($this->model_approval->isComplete($result->id) && ($this->session->userdata('department') == 8)) {
                            echo "<br/><button onclick='po_create(" . $result->id . ")' style='width:100px;'>Create PO</button>";
                        }
                    }

                    if ($this->model_pr->iscompletepricecomparison($result->id)) {
                        echo "<br/><a href='javascript:pr_view_po_plan(" . $result->id . ")' style='text-decoration: none;margin-left: 1px;color:red;' class='button'>View PO Plan</a>";
                    }
                    ?>

                </td>
                <td width="69%" colspan="6">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr style="background: transparent">
                            <?php
                            $approval = $this->model_approval->selectApprovalPr($result->id);
                            foreach ($approval as $resultapproval) {
                                if ($resultapproval->employeeid != "") {
                                    ?>
                                    <td style="border:none;padding-right: 5px;width: 180px;">
                                        <?php
                                        echo "<span style='color:#032550;font-weight:bold;'>" . $resultapproval->name . "</span><br/>";
                                        if ($resultapproval->outstanding == 't') {
                                            if ($resultapproval->status == 2) {
                                                echo "<a href='javascript:void(0)' onclick='pr_view_notes(" . $resultapproval->id . ")' style='text-decoration:none'><font color='#e7a75b'>Pending at: <br/>" . date('d/m/Y H:i:s', strtotime($resultapproval->timeapprove)) . "</font></a><br/>";
                                            } else if ($resultapproval->status == 3) {
                                                echo "<a href='javascript:void(0)' onclick='pr_view_notes(" . $resultapproval->id . ")' style='text-decoration:none'><font color='red'>Reject at: <br/>" . date('d/m/Y H:i:s', strtotime($resultapproval->timeapprove)) . "</font></a><br/>";
                                            }
                                            if ($resultapproval->employeeid == $this->session->userdata('id') && ($resultapproval->status != 3)) {
                                                echo "<button onclick='pr_approve(" . $result->id . "," . $resultapproval->id . ",1,1)'>Approve</button>";
                                                echo "<button onclick='pr_approve(" . $result->id . "," . $resultapproval->id . ",2,1)'>Pending</button>";
                                                echo "<button onclick='pr_approve(" . $result->id . "," . $resultapproval->id . ",3,1)'>Reject</button><br/>";
                                            } else {
                                                if ($resultapproval->status == 0) {
                                                    echo "<font color='blue'>Outstanding<br/></font>";
                                                }
                                            }
                                        } else {
                                            if ($resultapproval->status == 0) {
                                                echo "<font color='#966e02'>Waiting</font>";
                                            } else if ($resultapproval->status == 1) {
                                                echo "<font color='green'>Approve at: <br/>" . date('d/m/Y H:i:s', strtotime($resultapproval->timeapprove)) . "</font>";
                                            } else if ($resultapproval->status == 2) {
                                                echo "<font color='#e7a75b'>Pending at: <br/>" . date('d/m/Y H:i:s', strtotime($resultapproval->timeapprove)) . "</font>";
                                            } else if ($resultapproval->status == 3) {
                                                echo "<font color='red'>Reject at: <br/>" . date('d/m/Y H:i:s', strtotime($resultapproval->timeapprove)) . "</font>";
                                            }
                                        }
                                        ?>
                                    </td>
                                    <?php
                                }
                            }
                            ?>
                        </tr>
                    </table>
                </td>
                <td width="20%">
                    <a href="javascript:void(0)" onclick="comment_view(<?php echo $result->id ?>, 'PR')" style="text-decoration: none;margin-left: 1px;color: blue;"><img src="images/title.gif" class="miniaction"/>&nbsp;Comment (<?php echo $this->model_comment->getCount($result->id, 'PR') ?>)</a>&nbsp;|&nbsp;
                    <a href="javascript:void(0)" onclick="attachment_view(<?php echo $result->id ?>, 'PR')" style="text-decoration: none;margin-left: 1px;color: blue;"><img src="images/title.gif" class="miniaction"/>&nbsp;Attachment (<?php echo $this->model_attachment->getCount($result->id, 'PR') ?>)</a><br/>
                    <a href="javascript:void(0)" onclick="pricecomp_print(<?php echo $result->id ?>)" style="text-decoration: none;margin-left: 1px;color:blue;"><img src="images/dollar.png" class="miniaction"/>&nbsp;Price Comparison</a>                    
                    <?php
                    if ($this->session->userdata('department') == 8) {
                        if (in_array('edit_price_comparison', $accessmenu) && !$this->model_pr->isHadPo($result->id)) {
                            echo "<a href = 'javascript:void(0)' onclick = 'pricecomp_view(" . $result->id . ")' style = 'text-decoration: none;margin-left: 1px;color:red;'>=>Edit</a>";
                        }
                    }
                    if (!$this->model_pr->isHadPo($result->id)) {
                        if ($this->session->userdata('department') == 8) {
                            if ($this->model_approval->isHaveApproval($result->id)) {
                                if (!$this->model_approval->isComplete($result->id)) {
                                    if (in_array('edit_approval', $accessmenu)) {
                                        ?>
                                        <br/><a href="javascript:void(0)" onclick='pr_editprapproval(<?php echo $result->id ?>)'><img src='images/user_group.png'>&nbsp;Change Approval</a>
                                        <?php
                                    }
                                }
                            } else {
                                if ($this->model_pr->iscompletepricecomparison($result->id)) {
                                    echo "<br/><a href='javascript:pr_config_tax_and_ppn(" . $result->id . ")' style='text-decoration: none;margin-left: 1px;color:red;' class='button'>=>Prepare PO</a>";
                                    if (in_array('set_approval', $accessmenu)) {
                                        echo "<br/>&nbsp;&nbsp;<span onclick=pr_setprapproval(" . $result->id . ") style='color:#2bb5a0;font-weight: bold;cursor: pointer;'>Set Approval</span>";
                                    }
                                }
                            }
                        }
                    } else {
                        if ($this->session->userdata('id') == 'admin') {
                            echo "<br/><a href='javascript:pr_config_tax_and_ppn(" . $result->id . ")' style='text-decoration: none;margin-left: 1px;color:red;' class='button'>=>Prepare PO</a>";
                        }
                    }
                    ?><br/>                    
                </td>
            </tr>
            <?php
            if ($item_view == 1) {
                $pritem = $this->model_pritem->selectByPrId($result->id);
                ?>
                <tr valign='top'>
                    <td width="11%" colspan="2" align="right">Detail Item</td>
                    <td width="69%" colspan="7">
                        <table class="child" width="70%" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th width="2%" style="border: 1px solid black;">No</th>
                                    <th width="10%" style="border: 1px solid black;">Code</th>                            
                                    <th width="15%" style="border: 1px solid black;">Description</th>            
                                    <th width="10%" style="border: 1px solid black;">Qty</th>
                                    <th width="10%" style="border: 1px solid black;">Price</th>
                                    <th width="15%" style="border: 1px solid black;">Amount</th>										
                                    <th width="25%" style="border: 1px solid black;">Vendor</th>
                                    <th width="10%" style="border: 1px solid black;">MR NO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $counter = 1;
                                foreach ($pritem as $pritem) {
                                    ?>
                                    <tr>
                                        <td valign='top' align="right" style="border: 1px solid black;padding: 1px;"><?php echo $counter++; ?>&nbsp;</td>
                                        <td valign='top' style="border: 1px solid black;padding: 1px;"><?php echo $pritem->itempartnumber; ?>&nbsp;</td>                                
                                        <td valign='top' style="border: 1px solid black;padding: 1px;"><?php echo $pritem->itemdescription; ?>&nbsp;</td>
                                        <td valign='top' align='right' style="border: 1px solid black;padding: 1px;"><?php echo $pritem->qty . " / " . $pritem->unitname; ?>&nbsp;</td>
                                        <td valign='top' align='right' style="border: 1px solid black;padding: 1px;"><?php echo $pritem->currency . " " . number_format($pritem->price, 2, '.', ','); ?>&nbsp;</td>
                                        <td valign='top' align='right' style="border: 1px solid black;padding: 1px;"><?php echo number_format(($pritem->price * $pritem->qty), 2, '.', ','); ?>&nbsp;</td>												
                                        <td valign='top' style="border: 1px solid black;padding: 1px;"><?php echo ($pritem->vendorname == "") ? "-" : $pritem->vendorname; ?>&nbsp;</td>
                                        <td valign='top' style="border: 1px solid black;padding: 1px;"><?php echo $pritem->mr_number; ?>&nbsp;</td>
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
            <a href="javascript:pr_search(<?php echo $first ?>)"> << First </a>
            <a href="javascript:pr_search(<?php echo $prev ?>)"> < Prev </a>
            |
            <?php echo "Page $page of $num_page "; ?>
            |
            <a href="javascript:pr_search(<?php echo $next ?>)"> Next > </a>
            <a href="javascript:pr_search(<?php echo $last ?>)"> Last >> </a>
        </td>
        <td width="50%" align="right">
            Row <?php echo ($offset + 1) . " - " . (($next + $offset) > $num_rows ? $num_rows : $next) . " of " . $num_rows ?>
        </td>
    </tr>
</table>