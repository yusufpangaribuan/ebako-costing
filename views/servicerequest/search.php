<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_s_serv_req_qzx').scrollableFixedHeaderTable('102%', '500', null, null, null, 'tbl_s_serv_req_qzx');
    });
</script>

<table width="100%" class="tablesorter2 scrollableFixedHeaderTable" align="center" id="tbl_s_serv_req_qzx">
    <thead>
        <tr>
            <th width="2%">No</th>
            <th width="8%">SR NO</th>
            <th width="5%">Date</th>                        
            <th width="10%">Request By</th>                        
            <th width="10%">Department</th>
            <th width="8%">Must Receive At</th>
            <th width="15%">Reason Request</th>
            <th width="13%">Approval 1</th>
            <th width="14%">Approval 2</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($servicerequest)) {
            $no = $offset + 1;
            foreach ($servicerequest as $result) {
                $servicerequest_detail = $this->model_servicerequest->select_detail_by_service_request_id($result->id);
                $class = "";
                if (strtotime(date('Y-m-d')) == strtotime($result->must_receive_date) && $result->status == 1) {
                    $class = "bgcolor='#ffffcc'";
                } else if (strtotime(date('Y-m-d')) > strtotime($result->must_receive_date) && $result->status == 1) {
                    $class = "bgcolor='#ffb3b3'";
                }
                ?>
                <tr>
                    <td  width="2%" align="right" <?php echo $class ?>><?php echo $no++; ?></td>
                    <td  width="8%" <?php echo $class ?>>
                        <a href="javascript:void(0)" onclick="servicerequest_viewdetail(<?php echo $result->id ?>)" style="text-decoration: none;"><?php echo $result->number ?></a>                        
                    </td>
                    <td width="5%" align="center"><?php echo date('d/m/Y', strtotime($result->date)); ?></td>
                    <td width="10%"><?php echo $result->request_by . " - " . $result->employee_request_by; ?></td>                                
                    <td width="10%"><?php echo $result->department ?></td>
                    <td width="8%" align="center"><?php echo ($result->must_receive_date != "") ? date('d/m/Y', strtotime($result->must_receive_date)) : ""; ?></td>
                    <td width="15%"><?php echo $result->reason_requirement ?></td>                                
                    <td width="13%">
                        <?php
                        if ($result->approval1 != "") {
                            echo $result->approval1 . " - " . $result->name_approval1;

                            if ($result->approval1_status == 1) {
                                echo "<br/><font color='green'>Approve at: <br/>" . date('d/m/Y H:i:s', strtotime($result->approval1_time)) . "</font>";
                            } else if ($result->approval1_status == 2) {
                                echo "<br/><a href='javascript:void(0)' onclick=servicerequest_view_notes(" . $result->id . ",'" . $result->approval1 . "')><font color='#e7a75b'>Pending at: <br/>" . date('d/m/Y H:i:s', strtotime($result->approval1_time)) . "</font></a>";
                            } else if ($result->approval1_status == 3) {
                                echo "<br/><a href='javascript:void(0)' onclick=servicerequest_view_notes(" . $result->id . ",'" . $result->approval1 . "')><font color='red'>Reject at: <br/>" . date('d/m/Y H:i:s', strtotime($result->approval1_time)) . "</font></a>";
                            }
                            if ($result->status == 1) {
                                if ($result->approval1 == $this->session->userdata('id') && ($result->approval1_status == 0 || $result->approval1_status == 2)) {
                                    echo "<br/><button onclick=servicerequest_approve(" . $result->id . ",'" . $result->approval1 . "',1,1,0)>Approve</button>&nbsp;";
                                    echo "<button onclick=servicerequest_approve(" . $result->id . ",'" . $result->approval1 . "',2,1,0)>Pending</button>&nbsp;";
                                    echo "<button onclick=servicerequest_approve(" . $result->id . ",'" . $result->approval1 . "',3,1,0)>Reject</button>";
                                } else {
                                    if ($result->approval1_status == 0) {
                                        echo "<br/><font color='blue'>Outstanding</font>";
                                    }
                                }
                            } else {
                                if ($result->approval1_status == 0) {
                                    echo "<br/><font color='#966e02'>Waiting</font>";
                                }
                            }
                        }
                        ?>
                    </td>
                    <td width="14%">
                        <?php
                        if ($result->approval2 != "") {
                            echo $result->approval2 . " - " . $result->name_approval2;
                            if ($result->approval1 == "" || $result->approval1_status == 1) {
                                if ($result->approval2_status == 1) {
                                    echo "<br/><font color='green'>Approve at: <br/>" . date('d/m/Y H:i:s', strtotime($result->approval2_time)) . "</font>";
                                } else if ($result->approval2_status == 2) {
                                    echo "<br/><a href='javascript:void(0)' onclick=servicerequest_view_notes(" . $result->id . ",'" . $result->approval2_status . "')><font color='#e7a75b'>Pending at: <br/>" . date('d/m/Y H:i:s', strtotime($result->approval2_time)) . "</font></a>";
                                } else if ($result->approval2_status == 3) {
                                    echo "<br/><a href='javascript:void(0)' onclick=servicerequest_view_notes(" . $result->id . ",'" . $result->approval2_status . "')><font color='red'>Reject at: <br/>" . date('d/m/Y H:i:s', strtotime($result->approval2_time)) . "</font></a>";
                                }
                                if ($result->status == 1) {
                                    if ($result->approval2 == $this->session->userdata('id') && ($result->approval2_status == 0 || $result->approval2_status == 2)) {
                                        echo "<br/><button onclick=servicerequest_approve(" . $result->id . ",'" . $result->approval2 . "',1,2,0)>Approve</button>&nbsp;";
                                        echo "<button onclick=servicerequest_approve(" . $result->id . ",'" . $result->approval2 . "',2,2,0)>Pending</button>&nbsp;";
                                        echo "<button onclick=servicerequest_approve(" . $result->id . ",'" . $result->approval2 . "',3,2,0)>Reject</button>";
                                    } else {
                                        if ($result->approval2_status == 0) {
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
                        echo "<span style='display:inline-block;'><a href=" . base_url() . "index.php/servicerequest/prints/" . $result->id . "/prints target=blank><img class='miniaction' src='images/print.png'> Print</a>&nbsp;&nbsp;</span>";
                        if (($this->session->userdata('id') == $result->request_by && $result->status == 0) || ($this->session->userdata('id') == $result->request_by && (($result->approval1 == 2 || $result->approval2 == 2) || ($result->approval1 == 0 || $result->approval2 == 0)))) {
                            //if (in_array('edit', $accessmenu)) {
                            echo "<span style='display:inline-block;'><a href='javascript:void(0)' onclick='servicerequest_edit($result->id)'><img src='images/edit.png'/> Edit</a>&nbsp;</span>";
                            //}
                            //if (in_array('delete', $accessmenu)) {
                            if ($result->status == 0) {
                                echo "<span style='display:inline-block;'><a href='javascript:void(0)' onclick='servicerequest_delete($result->id)'><img src='images/delete.png'/> Delete</a></span>";
                            }
                            //}
                        }
                        ?>
                        <span style="display: inline-block;padding-top: 2px;">
                            <a href="javascript:void(0)" onclick="attachment_view(<?php echo $result->id ?>, 'SR')" style="text-decoration: none;margin-left: 1px;color: blue;"><img src="images/attachment.png" class="miniaction">&nbsp;Attachment (<?php echo $result->count_attchment ?>)</a>                         
                        </span><br/>
                        <span style="display: inline-block;padding-top: 2px;">
                            <a href="javascript:void(0)" onclick="comment_view(<?php echo $result->id ?>, 'SR')" style="text-decoration: none;margin-left: 1px;color: blue;"><img src="images/title.gif" class="miniaction"/>&nbsp;Comment (<?php echo $result->count_comment ?>)</a>
                        </span>
                    </td>                                 
                </tr>                
                <tr>
                    <td colspan="2" align="right">
                        Item Detail<br/>
                        <?php
                        if ($this->session->userdata('id') == $result->request_by && ($result->status == 0 || $result->status == -1)) {
                            ?>
                            <br/><button onclick="servicerequest_submit(<?php echo $result->id ?>)" style='margin-top:3px;'>Submit>></button>
                            <?php
                        }
                        if ($this->session->userdata('department') == 8 && $result->status == 2 && $result->count_ots > 0) {
                            ?>
                            <br/><button onclick="pr_create_from_servicerequest(<?php echo $result->id ?>)" style='margin-top:3px;'>Create PR</button>
                            <?php
                        }
                        ?>                        

                    </td>
                    <td colspan="8">
                        <table class="child" width="70%" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th width="30%">Item Source</th>                                
                                    <th width="30%">Item Target</th>
                                    <th width="25%">Service Description</th>
                                    <th width="5%">Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($servicerequest_detail as $result_detail) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo "<b>(" . $result_detail->source_item_code . " / " . $result_detail->source_unit_code . ") </b>" . nl2br($result_detail->source_item_description); ?><br/>
                                        </td>
                                        <td>
                                            <?php echo "<b>(" . $result_detail->target_item_code . " / " . $result_detail->target_unit_code . ") </b>" . nl2br($result_detail->target_item_description); ?><br/>                                            
                                        </td>
                                        <td><?php echo nl2br($result_detail->remark); ?></td>
                                        <td align="center"><?php echo $result_detail->qty; ?></td>
                                        </td>
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
            <a href="javascript:servicerequest_search(<?php echo $first ?>)"> << First </a>
            <a href="javascript:servicerequest_search(<?php echo $prev ?>)"> < Prev </a>
            |
            <?php echo "Page $page of $num_page "; ?>
            |
            <a href="javascript:servicerequest_search(<?php echo $next ?>)"> Next > </a>
            <a href="javascript:servicerequest_search(<?php echo $last ?>)"> Last >> </a>
        </td>
        <td width="50%" align="right">
            Row <?php echo ($offset + 1) . " - " . (($next + $offset) > $num_rows ? $num_rows : $next) . " of " . $num_rows ?>
        </td>
    </tr>
</table>
