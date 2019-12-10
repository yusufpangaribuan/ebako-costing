<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_s_mw76d_qzx').scrollableFixedHeaderTable('102%', '500', null, null, null, 'tbl_s_mw76d_qzx');
    });
</script>
<table class="tablesorter scrollableFixedHeaderTable" width="100%"  align="center" id='tbl_s_mw76d_qzx'>
    <thead>
        <tr>
            <th width="2%">No</th>
            <th width="7%">MW NO</th>
            <th width="5%">Date</th>                        
            <th width="12%">Request By</th>                        
            <th width="7%">Dept.</th>
            <th width="7%">End User</th>
            <th width="7%">Must Receive At</th>
            <th width="7%">Batch Time</th>
            <th width="15%">Approval 1</th>
            <th width="15%">Approval 2</th>
            <th width="6%">Status</th>
            <th width="10%">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($mr)) {
            $no = $offset + 1;
            foreach ($mr as $mr) {
                $class = "";
                if (strtotime(date('Y-m-d')) == strtotime($mr->datemustreceive) && $mr->status == 1) {
                    $class = "bgcolor='#ffffcc'";
                } else if (strtotime(date('Y-m-d')) > strtotime($mr->datemustreceive) && $mr->status == 1) {
                    $class = "bgcolor='#ffb3b3'";
                }
                ?>
                <tr>
                    <td width="2%" align="right" <?php echo $class ?>><?php echo $no++; ?></td>
                    <td width="7%" align="center" <?php echo $class ?>>
                        <a href="javascript:void(0)" onclick="mr_viewdetail(<?php echo $mr->id ?>)" style="text-decoration: none;"><?php echo $mr->number ?></a>                                    
                    </td>
                    <td width="5%" align="center"><?php echo date('d/m/Y', strtotime($mr->date)); ?></td>
                    <td width="12%"><?php echo $mr->requestby . " - " . $mr->namerequestby; ?></td>                                
                    <td width="7%"><?php echo $mr->departmentcode . " - " . $mr->departmentname ?></td>
                    <td width="7%"><?php echo $mr->dev_code . " - " . $mr->dev_name ?></td>
                    <td width="7%" align="center"><?php echo ($mr->datemustreceive != "") ? date('d/m/Y', strtotime($mr->datemustreceive)) : ""; ?></td>
                    <td width="7%" align="center"><?php echo str_replace('|', " - ", $mr->batch_time) ?></td>                                
                    <td width="15%">
                        <?php
                        if ($mr->supervisorapproval != "") {
                            echo $mr->supervisorapproval . " - " . $mr->supervisor;
                            if ($mr->supervisorstatusapproval == 1) {
                                echo "<br/><font color='green'>Approve at: <br/>" . date('d/m/Y H:i:s', strtotime($mr->supervisortimeapproved)) . "</font>";
                            } else if ($mr->supervisorstatusapproval == 2) {
                                echo "<br/><a href='javascript:void(0)' onclick=mr_view_notes(" . $mr->id . ",'" . $mr->supervisorapproval . "')><font color='#e7a75b'>Pending at: <br/>" . date('d/m/Y H:i:s', strtotime($mr->supervisortimeapproved)) . "</font></a>";
                            } else if ($mr->supervisorstatusapproval == 3) {
                                echo "<br/><a href='javascript:void(0)' onclick=mr_view_notes(" . $mr->id . ",'" . $mr->supervisorapproval . "')><font color='red'>Reject at: <br/>" . date('d/m/Y H:i:s', strtotime($mr->supervisortimeapproved)) . "</font></a>";
                            }
                            if ($mr->supervisorapproval == $this->session->userdata('id') && ($mr->supervisorstatusapproval == 0 || $mr->supervisorstatusapproval == 2)) {
                                echo "<br/><button onclick=mr_approve(" . $mr->id . ",'" . $mr->supervisorapproval . "',1,1,0) style='margin-top:2px;'>Approve</button>&nbsp;";
                                echo "<button onclick=mr_approve(" . $mr->id . ",'" . $mr->supervisorapproval . "',2,1,0) style='margin-top:2px;'>Pending</button>&nbsp;";
                                echo "<button onclick=mr_approve(" . $mr->id . ",'" . $mr->supervisorapproval . "',3,1,0) style='margin-top:2px;'>Reject</button>";
                            } else {
                                if ($mr->supervisorstatusapproval == 0) {
                                    echo "<br/><font color='blue'>Outstanding</font>";
                                }
                            }
                        }
                        ?>
                    </td>
                    <td width="15%">
                        <?php
                        if ($mr->managerapproval != "") {
                            echo $mr->managerapproval . " - " . $mr->manager;
                            if ($mr->supervisorapproval == "" || $mr->supervisorstatusapproval == 1) {
                                if ($mr->managerstatusapproval == 1) {
                                    echo "<br/><font color='green'>Approve at: <br/>" . date('d/m/Y H:i:s', strtotime($mr->managertimeapproved)) . "</font>";
                                } else if ($mr->managerstatusapproval == 2) {
                                    echo "<br/><a href='javascript:void(0)' onclick=mr_view_notes(" . $mr->id . ",'" . $mr->managerapproval . "')><font color='#e7a75b'>Pending at: <br/>" . date('d/m/Y H:i:s', strtotime($mr->managertimeapproved)) . "</font></a>";
                                } else if ($mr->managerstatusapproval == 3) {
                                    echo "<br/><a href='javascript:void(0)' onclick=mr_view_notes(" . $mr->id . ",'" . $mr->managerapproval . "')><font color='red'>Reject at: <br/>" . date('d/m/Y H:i:s', strtotime($mr->managertimeapproved)) . "</font></a>";
                                }
                                if ($mr->managerapproval == $this->session->userdata('id') && ($mr->managerstatusapproval == 0 || $mr->managerstatusapproval == 2)) {
                                    echo "<br/><button onclick=mr_approve(" . $mr->id . ",'" . $mr->managerapproval . "',1,2,0) style='margin-top:2px;'>Approve</button>&nbsp;";
                                    echo "<button onclick=mr_approve(" . $mr->id . ",'" . $mr->managerapproval . "',2,2,0) style='margin-top:2px;'>Pending</button>&nbsp;";
                                    echo "<button onclick=mr_approve(" . $mr->id . ",'" . $mr->managerapproval . "',3,2,0) style='margin-top:2px;'>Reject</button>";
                                } else {
                                    if ($mr->managerstatusapproval == 0) {
                                        echo "<br/><font color='blue'>Outstanding</font>";
                                    }
                                }
                            } else {
                                echo "<br/><font color='#966e02'>Waiting</font>";
                            }
                        }
                        ?>
                    </td>
                    <td width="6%">
                        <?php
                        $disabled = "disabled";
                        if ($mr->status == 1) {
                            $disabled = "";
                        }
                        ?>
                        <select style="width:100%;" id="mrstatus<?php echo $mr->id ?>" onchange="mr_changestatus(this,<?php echo $mr->id ?>)" <?php echo $disabled; ?>>
                            <?php
                            foreach ($mrstatus as $x => $x_value) {
                                $selected = '';
                                if ($mr->status == $x) {
                                    $selected = 'selected';
                                }
                                if ($this->session->userdata('id') == $mr->requestby && $x == 3) {
                                    echo "<option value='" . $x . "' $selected >" . $x_value . "</option>";
                                } else {
                                    echo "<option value='" . $x . "' $selected disabled>" . $x_value . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <?php
                        $complete_receive = $this->model_mr->complete_receive($mr->id);
//                        echo $complete_receive;
                        if ($complete_receive === 't') {
                            echo "<span style='color:#c98000;font-weight:bold;'>=>Received</span>";
                        }
                        ?>
                    </td>
                    <td  width="10%">
                        <?php
                        echo "<span style='display:inline-block;padding:2px;'><a href=" . base_url() . "index.php/mr/prints/" . $mr->id . "/prints target=_blank><img class='miniaction' src='images/print.png'> Print</a>&nbsp;&nbsp;</span>";
                        //echo "<span style='display:inline-block;padding:2px;'><a href='javascript:void(0)' onclick=open_window_popup('" . base_url() . "index.php/mr/prints/" . $mr->id . "/view','" . $mr->number . "')><img class='miniaction' src='images/print.png'> Print</a>&nbsp;&nbsp;</span>";
                        if (($mr->supervisorstatusapproval == 2 || $mr->supervisorstatusapproval == 0) || ($mr->managerstatusapproval == 2 && $mr->supervisorstatusapproval == 1)) {
                            if ($this->session->userdata('id') == $mr->requestby) {
                                if (in_array('edit', $accessmenu)) {
                                    echo "<span style='display:inline-block;padding:2px;'><a href='javascript:void(0)' onclick='mr_edit($mr->id)'><img src='images/edit.png'/> Edit</a>&nbsp;</span>";
                                }
                                if ($mr->supervisorstatusapproval == 0) {
                                    if (in_array('delete', $accessmenu)) {
                                        echo "<span style='display:inline-block;padding:2px;'><a href='javascript:void(0)' onclick='mr_delete($mr->id)'><img src='images/delete.png'/> Delete</a>&nbsp;</span>";
                                    }
                                }
                            }
                        } else {
                            if (in_array($mr->status, array(1)) && $this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') != 0) {
                                if ($mr->request_type == 1) {
                                    echo "<br/><button onclick='stockout_mrchoose(" . $mr->id . ",0)' style='margin-top:3px;'>Stock Out</button>";
                                } else {
                                    if ($this->session->userdata('optiongroup') != $this->model_user->getGroupById($mr->requestby)) {
                                        echo "<br/><button onclick='stockout_mrchoose(" . $mr->id . ",0)' style='margin-top:3px;'>Stock Out</button>";
                                    }
                                }
                            }
                        }
                        ?>
                    </td>                                 
                </tr>
                <tr>
                    <td colspan="2" align="right" <?php echo $class ?>><strong>Item Detail</strong></td>
                    <td colspan="7">
                        <table width="100%" cellpadding="0" cellspacing="0" class="child">
                            <thead>
                                <tr>
                                    <th align="center" width="15%">Code</th>
                                    <th align="center" width="30%">Description</th>                                    
                                    <th align="center" width="5%">Unit</th>
                                    <th align="center" width="10%">Req</th>
                                    <th align="center" width="10%">Recv</th>
                                    <th align="center" width="10%">Ots</th>                                    
                                    <th align="center" width="15%">Request To</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $mrdetail = $this->model_mrdetail->selectByMrId_2($mr->id, $mr->request_type);
                                foreach ($mrdetail as $result) {
//                                    print_r($mrdetail);
                                    ?>  
                                    <tr>
                                        <td align="center"><?php echo $result->code; ?></td>
                                        <td align="left"><?php echo (strlen($result->descriptions) > 40) ? substr($result->descriptions, 0, 40) : $result->descriptions; ?></td>
                                        <td align="center"><?php echo $result->unitcode; ?></td>
                                        <td align="center"><?php echo $result->qty; ?></td>
                                        <td align="center"><?php echo $result->qtyreceived; ?></td>
                                        <td align="center"><?php echo $result->ots; ?></td>
                                        <td><?php echo $result->request_to; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
        <!--                            <tr style="border: none">
                                <td align="left" style="border: none;" colspan="5">
                                    <a href="javascript:void(0)" style="float: left;font-size: 10px" onclick="mr_detailreceive(<?php echo $mr->id; ?>)">Detail Received</a>
                            <?php
                            if ($this->model_mr->getCountNewReceiveMr($mr->id) > 0 && $this->session->userdata('id') == $mr->requestby) {
                                ?>
                                                                                                                                                                                                                    <a href="javascript:void(0)" style="float: right;font-size:10px" onclick="mr_newreceive(<?php echo $mr->id ?>)">New Receive </a></td>
                            <?php }
                            ?>

                                </td>
                            </tr>-->
                        </table>
                    </td>
                    <td colspan="3">&nbsp;</td>
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
            <a href="javascript:mr_search(<?php echo $first ?>)"> << First </a>
            <a href="javascript:mr_search(<?php echo $prev ?>)"> < Prev </a>
            |
            <?php echo "Page $page of $num_page "; ?>
            |
            <a href="javascript:mr_search(<?php echo $next ?>)"> Next > </a>
            <a href="javascript:mr_search(<?php echo $last ?>)"> Last >> </a>
        </td>
        <td width="50%" align="right">
            Row <?php echo ($offset + 1) . " - " . (($next + $offset) > $num_rows ? $num_rows : $next) . " of " . $num_rows ?>
        </td>
    </tr>
</table>

<!--
<center>
    <div style="margin-bottom: 5px;margin-top: 5px;">
        <input type="hidden" id="offset" value="<?php echo $offset ?>" />
        <img src="images/first.png" onclick="mr_search(<?php echo $first ?>)" class="miniaction"/>
        <img src="images/prev.png" onclick="mr_search(<?php echo $prev ?>)" class="miniaction"/>
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
        <img src="images/next.png" onclick="mr_search(<?php echo $next ?>)"   class="miniaction"/>
        <img src="images/last.png" onclick="mr_search(<?php echo $last ?>)"   class="miniaction"/><input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" /> &nbsp;Pages                
        <input type="text" size="5" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/> &nbsp;Rows                    
    </div>
</center>-->