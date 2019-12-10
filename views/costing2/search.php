<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_s_costing_qzx').scrollableFixedHeaderTable('102%', '500',null,null,2,'tbl_s_costing_qzx');
    });
</script>
<table class="tablesorter scrollableFixedHeaderTable" id="tbl_s_costing_qzx">
    <thead>
        <tr>
            <th width="2%" rowspan="2">No</th>                        
            <th width="16%" colspan="2">Model</th>
            <th width="16%" rowspan="2">Description</th>
            <th width="13%" rowspan="2">Customer</th>
            <th width="5%" rowspan="2">Date</th>
            <th width="5%" rowspan="2">Rate</th>
            <th width="10%" colspan="3">Cost (%)</th>
            <th width="3%" rowspan="2">Prof(%).</th>
            <th width="10%" rowspan="2">FOB Price</th>                        
            <th width="10%" rowspan="2">Action</th>
            <th width="5%" rowspan="2">Status</th>
        </tr>
        <tr>
            <th width="10%">Code</th>
            <th width="6%">Cust. Code</th>
            <th width="3%">Fixed</th>
            <th width="4%">Var</th>
            <th width="3%">Port</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = $offset;
        foreach ($costing as $result) {
            $time1 = strtotime($result->date);
            $nextexpired = strtotime('+1 year', $time1);
            $time2 = strtotime(date('Y-m-d'));
            $msg = "";
            $bgcolor = "";
            if (($nextexpired - $time2) < 2592000 || ($time2 > $nextexpired )) {
                if (($time2 >= $nextexpired)) {
                    $msg = "<br/><span style='color:red;font-size:11px;'><i>Need To Review<br/>Costing Expired </i></span>";
                } else {
                    $days = (($nextexpired - $time2) / 86400);
                    $msg = "<br/><span style='color:red;font-size:11px;'><i>Need To Review<br/>Will be expired in $days days</i></span>";
                }
                $bgcolor = "bgcolor='#ffe1e4'";
            }
            if ($result->fob_price == '') {
                $bgcolor = "bgcolor='#ffffd7'";
                $msg = "";
            }if ($result->needmodify == 't') {
                $bgcolor = "bgcolor='#ffffd7'";
                $msg = "<br/><span style='color:red;font-size:11px;'><i>Need to modify because some items have been changed by the R & D</i></span>";
            }
            ?>
            <tr valign="top" <?php echo $bgcolor ?>>
                <td align="right"><?php echo $no++; ?></td>
                <td>
                    <?php
                    echo $result->code;
                    echo $msg;
                    ?>
                </td>
                <td><?php echo $result->custcode ?></td>
                <td><?php echo $result->description ?></td>
                <td><?php echo $result->customername ?></td>
                <td align="center"><?php echo (!empty($result->date)) ? date('d/m/Y', strtotime($result->date)) : ''; ?></td>
                <td align="right"><?php echo $result->ratevalue ?></td>
                <td align="center"><?php echo $result->fixed_cost ?></td>
                <td align="center"><?php echo $result->variable_cost ?></td>
                <td align="center"><?php echo $result->port_origin_cost ?></td>
                <td align="center"><?php echo $result->profit_percentage ?></td>
                <td align="right"><?php echo $result->fob_price ?></td>
                <td>
                    <?php
                    if ($this->session->userdata('department') == 9) {
                        if (empty($result->rateid)) {
                            if (in_array('add', $accessmenu)) {
                                echo "<button onclick='costing_createfromrequest($result->id)'>Create</button><br/>";
                            }
                        } else {
                            if ($result->locked == 'f') {
                                if (in_array('edit', $accessmenu)) {
                                    echo "<a href='javascript:costing_edit(" . $result->id . ")'><img src='images/bomedit.png'>&nbsp;Edit Header</a><br/>";
                                }
                            }
                            if (in_array('view_detail', $accessmenu)) {
                                echo "<a href='javascript:costing_build($result->id,1)'><img src='images/configuration.png'>&nbsp;View Detail</a><br/>";
                            }
                            echo "<a href='" . base_url() . "index.php/costing/prints/$result->id/print/0' target='blank'><img src='images/print.png'>&nbsp;Print</a><br/>";
                            echo "<a href='javascript:costing_history($result->id)'><img src='images/costinghistory.png'>&nbsp;History</a>";
                            if ($result->isreviewed == 'f' || $result->locked == 'f') {
                                if (in_array('delete', $accessmenu)) {
                                    echo "<br/><a href='javascript:costing_delete($result->id)'><img src='images/delete.png'>&nbsp;Delete</a><br/>";
                                }
                            }
                        }
                    }
                    if ($this->session->userdata('department') == 1) {
                        if ($result->locked == 't') {
                            echo "<span onclick = 'costing_unlock(" . $result->id . ")' class = 'miniaction' style = 'margin-right: 50px;'><img src = 'images/unlock.png'/>&nbsp;UnLock</span><br/>";
                        }
                        echo "<a href='javascript:costing_build($result->id,1)'><img src='images/configuration.png'>&nbsp;View Detail</a><br/>";
                        echo "<a href='" . base_url() . "index.php/costing/prints/$result->id/print/0' target='blank'><img src='images/print.png'>&nbsp;Print</a><br/>";
                    }
                    ?>
                </td>
                <td align="center">
                    <?php
                    if ($result->locked == 't') {
                        if ($result->approve == 'f') {
                            if ($this->session->userdata('department') == 9) {
                                echo "<button onclick='costing_approve($result->id)'>Approve</button>";
                            }
                        } else {
                            echo "Approved";
                        }
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>

    </tbody>
</table>
<div style="margin-bottom: 5px;margin-top: 5px;">
    <input type="hidden" id="offset" value="<?php echo ($offset - 1) ?>" />
    <img src="images/first.png" onclick="costing_search(<?php echo $first ?>)" class="miniaction"/>
    <img src="images/prev.png" onclick="costing_search(<?php echo $prev ?>)" class="miniaction"/>
    <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
    <img src="images/next.png" onclick="costing_search(<?php echo $next ?>)" class="miniaction"/>
    <img src="images/last.png" onclick="costing_search(<?php echo $last ?>)" class="miniaction"/>
    &nbsp;&nbsp;
    Total Page
    <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
    Total Rows
    <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
</div>
