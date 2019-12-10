<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_s_mat_req_qzx').scrollableFixedHeaderTable('102%', '500', null, null, null, 'tbl_s_mat_req_qzx');
    });
</script>

<table width="100%" class="tablesorter2 scrollableFixedHeaderTable" align="center" id="tbl_s_mat_req_qzx">
    <thead>
        <tr>
            <th width="2%">No</th>
            <th width="10%">MR NO</th>
            <th width="5%">Date</th>                        
            <th width="13%">Request By</th>                        
            <th width="10%">Department</th>
            <th width="10%">Must Receive At</th>
            <th width="15%">Reason Request</th>
            <th width="10%">Approval 1</th>
            <th width="10%">Approval 2</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($mat_req)) {
            $no = $offset + 1;
            foreach ($mat_req as $mr) {
                $class = "";
                if ($mr->status == 0) {
                    $class = "bgcolor='#ff7878'";
                } else if ($mr->status == 1) {
                    if ($mr->total_qty == $mr->count_ots) {
                        $class = "bgcolor='#fff71d'";
                    } else if ($mr->count_ots > 0) {
                        $class = "bgcolor='#e2ff1d'";
                    }
                }
                ?>
                <tr>
                    <td  width="2%" align="right" <?php echo $class ?>><?php echo $no++; ?></td>
                    <td  width="10%" <?php echo $class ?>>
                        <a href="javascript:void(0)" onclick="materialrequisition_viewdetail(<?php echo $mr->id ?>)" style="text-decoration: none;"><?php echo $mr->number ?></a>                                    
                        <br/>
                        <span style="display: inline-block;padding-top: 2px;">
                            <a href="javascript:void(0)" onclick="attachment_view(<?php echo $mr->id ?>, 'MR')" style="text-decoration: none;margin-left: 1px;color: blue;"><img src="images/attachment.png" class="miniaction">&nbsp;Attachment (<?php echo $mr->count_attchment ?>)</a>                         
                        </span><br/>
                        <span style="display: inline-block;padding-top: 2px;">
                            <a href="javascript:void(0)" onclick="comment_view(<?php echo $mr->id ?>, 'MR')" style="text-decoration: none;margin-left: 1px;color: blue;"><img src="images/title.gif" class="miniaction"/>&nbsp;Comment (<?php echo $mr->count_comment ?>)</a>
                        </span>
                    </td>
                    <td width="5%" align="center"><?php echo date('d/m/Y', strtotime($mr->date)); ?></td>
                    <td width="13%"><?php echo $mr->request_by . " - " . $mr->employee_request_by; ?></td>                                
                    <td width="10%"><?php echo $mr->department ?></td>
                    <td width="10%" align="center"><?php echo ($mr->must_receive_date != "") ? date('d/m/Y', strtotime($mr->must_receive_date)) : ""; ?></td>
                    <td width="15%"><?php echo $mr->reason_requirement ?></td>                                
                    <td width="10%">
                        <?php
                        if ($mr->supervisorapproval != "") {
                            echo $mr->supervisorapproval . " - " . $mr->supervisor;

                            if ($mr->supervisorstatusapproval == 1) {
                                echo "<br/><font color='green'>Approve at: <br/>" . date('d/m/Y H:i:s', strtotime($mr->supervisortimeapproved)) . "</font>";
                            } else if ($mr->supervisorstatusapproval == 2) {
                                echo "<br/><a href='javascript:void(0)' onclick=materialrequisition_view_notes(" . $mr->id . ",'" . $mr->supervisorapproval . "')><font color='#e7a75b'>Pending at: <br/>" . date('d/m/Y H:i:s', strtotime($mr->supervisortimeapproved)) . "</font></a>";
                            } else if ($mr->supervisorstatusapproval == 3) {
                                echo "<br/><a href='javascript:void(0)' onclick=materialrequisition_view_notes(" . $mr->id . ",'" . $mr->supervisorapproval . "')><font color='red'>Reject at: <br/>" . date('d/m/Y H:i:s', strtotime($mr->supervisortimeapproved)) . "</font></a>";
                            }
                            if ($mr->status == 0) {
                                if ($mr->supervisorapproval == $this->session->userdata('id') && ($mr->supervisorstatusapproval == 0 || $mr->supervisorstatusapproval == 2)) {
                                    echo "<br/><button onclick=materialrequisition_approve(" . $mr->id . ",'" . $mr->supervisorapproval . "',1,1,0)>Approve</button>&nbsp;";
                                    echo "<button onclick=materialrequisition_approve(" . $mr->id . ",'" . $mr->supervisorapproval . "',2,1,0)>Pending</button>&nbsp;";
                                    echo "<button onclick=materialrequisition_approve(" . $mr->id . ",'" . $mr->supervisorapproval . "',3,1,0)>Reject</button>";
                                } else {
                                    if ($mr->supervisorstatusapproval == 0) {
                                        echo "<br/><font color='blue'>Outstanding</font>";
                                    }
                                }
                            } else {
                                if ($mr->supervisorstatusapproval == 0) {
                                    echo "<br/><font color='#966e02'>Waiting</font>";
                                }
                            }
                        }
                        ?>
                    </td>
                    <td width="10%">
                        <?php
                        if ($mr->managerapproval != "") {
                            echo $mr->managerapproval . " - " . $mr->manager;
                            if ($mr->supervisorapproval == "" || $mr->supervisorstatusapproval == 1) {
                                if ($mr->managerstatusapproval == 1) {
                                    echo "<br/><font color='green'>Approve at: <br/>" . date('d/m/Y H:i:s', strtotime($mr->managertimeapproved)) . "</font>";
                                } else if ($mr->managerstatusapproval == 2) {
                                    echo "<br/><a href='javascript:void(0)' onclick=materialrequisition_view_notes(" . $mr->id . ",'" . $mr->managerapproval . "')><font color='#e7a75b'>Pending at: <br/>" . date('d/m/Y H:i:s', strtotime($mr->managertimeapproved)) . "</font></a>";
                                } else if ($mr->managerstatusapproval == 3) {
                                    echo "<br/><a href='javascript:void(0)' onclick=materialrequisition_view_notes(" . $mr->id . ",'" . $mr->managerapproval . "')><font color='red'>Reject at: <br/>" . date('d/m/Y H:i:s', strtotime($mr->managertimeapproved)) . "</font></a>";
                                }
                                if ($mr->status == 0) {
                                    if ($mr->managerapproval == $this->session->userdata('id') && ($mr->managerstatusapproval == 0 || $mr->managerstatusapproval == 2)) {
                                        echo "<br/><button onclick=materialrequisition_approve(" . $mr->id . ",'" . $mr->managerapproval . "',1,2,0)>Approve</button>&nbsp;";
                                        echo "<button onclick=materialrequisition_approve(" . $mr->id . ",'" . $mr->managerapproval . "',2,2,0)>Pending</button>&nbsp;";
                                        echo "<button onclick=materialrequisition_approve(" . $mr->id . ",'" . $mr->managerapproval . "',3,2,0)>Reject</button>";
                                    } else {
                                        if ($mr->managerstatusapproval == 0) {
                                            echo "<br/><font color='blue'>Outstanding</font>";
                                        }
                                    }
                                }
                            } else {
                                echo "<br/><font color='#966e02'>Waiting</font>";
                            }
                        }
                        ?>
                    </td>
                    <td width="15%" align="left">
                        <?php
                        echo "<span style='display:inline-block;'><a href=" . base_url() . "index.php/materialrequisition/prints/" . $mr->id . "/prints target=blank><img class='miniaction' src='images/print.png'> Print</a>&nbsp;&nbsp;</span>";
                        if (($this->session->userdata('id') == $mr->request_by && $mr->status == 99) || ($this->session->userdata('id') == $mr->request_by && (($mr->supervisorstatusapproval == 2 || $mr->managerstatusapproval == 2) || ($mr->supervisorstatusapproval == 0 || $mr->managerstatusapproval == 0)))) {
                            //if (in_array('edit', $accessmenu)) {
                            echo "<span style='display:inline-block;'><a href='javascript:void(0)' onclick='materialrequisition_edit($mr->id)'><img src='images/edit.png'/> Edit</a>&nbsp;</span>";
                            //}
                            //if (in_array('delete', $accessmenu)) {
                            if ($mr->status == 99) {
                                echo "<span style='display:inline-block;'><a href='javascript:void(0)' onclick='materialrequisition_delete($mr->id)'><img src='images/delete.png'/> Delete</a></span>";
                            }
                            //}
                            if ($this->session->userdata('id') == $mr->request_by && ($mr->status == 99 || $mr->status == -1)) {
                                ?>
                                <br/><button onclick="materialrequisition_submit(<?php echo $mr->id ?>)" style='margin-top:3px;'>Submit>></button>
                                <?php
                            }
                        }
                        if ($this->session->userdata('department') == 8 && $mr->status == 1 && $mr->count_ots > 0) {
                            ?>
                            <br/><button onclick="pr_create_from_requisition(<?php echo $mr->id ?>)" style='margin-top:3px;'>Create PR</button>
                            <?php
                        }
                        ?>
                    </td>                                 
                </tr>                
                <?php
                if ($item_view == 1) {
                    $mrdetail = $this->model_materialrequisition->select_detail_by_mat_req_id($mr->id);
                    ?>
                    <tr>
                        <td colspan="2" align="right">Item Detail</td>
                        <td colspan="8">
                            <table class="child" width="70%" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th width="15%">Item Code</th>
                                        <th width="20%">Item Description</th>
                                        <th width="5%">Unit</th>
                                        <th width="15%">Request</th>
                                        <th width="15%">Outstanding</th>
                                        <th width="30%">Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($mrdetail as $result_mr) {
                                        ?>
                                        <tr>
                                            <td><?php echo $result_mr->item_code ?></td>
                                            <td><?php echo $result_mr->item_description ?></td>
                                            <td align="center"><?php echo $result_mr->unit_code ?></td>
                                            <td align="center"><?php echo $result_mr->qty ?></td>
                                            <td align="center"><?php echo $result_mr->ots_qty ?></td>
                                            <td><?php echo $result_mr->remark ?></td>
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
        }
        ?>
    </tbody>
</table>

<table width="100%">
    <tr>
        <td width="50%">
            <input type="hidden" id="offset" value="<?php echo $offset ?>" />
            <a href="javascript:materialrequisition_search(<?php echo $first ?>)"> << First </a>
            <a href="javascript:materialrequisition_search(<?php echo $prev ?>)"> < Prev </a>
            |
            <?php echo "Page $page of $num_page "; ?>
            |
            <a href="javascript:materialrequisition_search(<?php echo $next ?>)"> Next > </a>
            <a href="javascript:materialrequisition_search(<?php echo $last ?>)"> Last >> </a>
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
        <img src="images/first.png" onclick="materialrequisition_search(<?php echo $first ?>)" class="miniaction"/>
        <img src="images/prev.png" onclick="materialrequisition_search(<?php echo $prev ?>)" class="miniaction"/>
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
        <img src="images/next.png" onclick="materialrequisition_search(<?php echo $next ?>)"   class="miniaction"/>
        <img src="images/last.png" onclick="materialrequisition_search(<?php echo $last ?>)"   class="miniaction"/><input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" /> &nbsp;Pages                
        <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/> &nbsp;Rows                    
    </div>
</center>-->