<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_s_outstandingtostockout_qwe').scrollableFixedHeaderTable('102%', '490',null,null,null,'tbl_s_outstandingtostockout_qwe');
    });
</script>

<table class="tablesorter2 scrollableFixedHeaderTable" id="tbl_s_outstandingtostockout_qwe" width="100%">
    <thead>
        <tr>
            <th width="10">No</th>
            <th>M.W NO</th>
            <th>Date</th>
            <th>Request By</th>
            <th>Item Code</th>            
            <th>Item Description</th>
            <th>Qty Request</th>
            <th>Outstanding</th>
            <th>Remark</th>
            <th width="100">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($mritem)) {
            $no = $offset + 1;
            foreach ($mritem as $result) {
                ?>
                <tr>
                    <td align="right">&nbsp;<?php echo $no++ ?></td>
                    <td>&nbsp;<?php echo $result->mr_no ?></td>
                    <td>&nbsp;<?php echo $result->mr_date ?></td>
                    <td>&nbsp;<?php echo $result->employee_name_requested ?></td>
                    <td>&nbsp;<?php echo $result->item_code ?></td>
                    <td>&nbsp;<?php echo $result->item_description ?></td>
                    <td align="right">&nbsp;<?php echo $result->qty ?></td>
                    <td align="right">&nbsp;<?php echo $result->ots ?></td>
                    <td>&nbsp;<?php echo $result->reason ?></td>
                    <td align="center">
                        <?php
                        if ($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') != 0) {
                            echo "<button onclick='stockout_mrchoose(" . $result->mrid . ",0)' style='margin-top:3px;'>Stock Out</button>";
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
        } else {
            
        }
        ?>
    </tbody>
</table>
<center>
    <div style="margin-bottom: 5px;margin-top: 5px;">
        <input type="hidden" id="offset" value="<?php echo $offset ?>" />
        <img src="images/first.png" onclick="outstandingtostockout_search(<?php echo $first ?>)" class="miniaction"/>
        <img src="images/prev.png" onclick="outstandingtostockout_search(<?php echo $prev ?>)" class="miniaction"/>
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
        <img src="images/next.png" onclick="outstandingtostockout_search(<?php echo $next ?>)" class="miniaction"/>
        <img src="images/last.png" onclick="outstandingtostockout_search(<?php echo $last ?>)" class="miniaction"/>
        &nbsp;&nbsp;
        Total Page
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
        Total Rows
        <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
    </div>
</center>