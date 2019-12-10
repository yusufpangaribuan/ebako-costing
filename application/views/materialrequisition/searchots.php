<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_ots_create_pr').scrollableFixedHeaderTable('100%', '520', null, null, null, 'tbl_ots_create_pr');
    });
</script>
<table class="tablesorter2 scrollableFixedHeaderTable" id="tbl_ots_create_pr" width="100%">
    <thead>
        <tr>
            <th width="2%">No</th>
            <th width="5%">Item Code</th>
            <th width="20%">Item Description</th>
            <th width="5%">Request</th>
            <th width="5%">Ots</th>
            <th width="5%">Unit</th>
            <th width="8%">MR NO</th>
            <th width="5%">Date</th>                        
            <th width="10%">Request By</th>                        
            <th width="10%">Department</th>
            <th width="15%">Approval</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = $offset;
        foreach ($otscreatepr as $result) {
            ?>
            <tr>
                <td align="right"><?php echo ++$no; ?></td>
                <td><?php echo $result->item_code ?></td>
                <td><?php echo $result->item_description ?></td>
                <td align="center"><?php echo $result->qty ?></td>
                <td align="center"><?php echo $result->ots_qty ?></td>
                <td align="center"><?php echo $result->unit_code ?></td>
                <td align="center"><?php echo $result->mr_number ?></td>
                <td><?php echo $result->date_f ?></td>                        
                <td><?php echo $result->employee_request_by ?></td>                        
                <td><?php echo $result->departmentname ?></td>                
                <td><?php echo "App 1: <br/>" . $result->approval1_name . "<br/>App 2: <br/>" . $result->approval2_name ?></td>
                <td>
                    <button onclick="pr_create_from_requisition(<?php echo $result->materialrequisitionid ?>)" style='margin-top:3px;'>Create PR</button><br/>
                    <!--<button onclick="pr_add_mr_item_to_pr(<?php echo $result->id ?>)" style='margin-top:3px;'>Add to PR</button>-->
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<center>
    <div style="margin-bottom: 5px;margin-top: 5px;">
        <input type="hidden" id="offset" value="<?php echo $offset ?>" />
        <img src="images/first.png" onclick="mat_req_ots_search(<?php echo $first ?>)" class="miniaction"/>
        <img src="images/prev.png" onclick="mat_req_ots_search(<?php echo $prev ?>)" class="miniaction"/>
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
        <img src="images/next.png" onclick="mat_req_ots_search(<?php echo $next ?>)" class="miniaction"/>
        <img src="images/last.png" onclick="mat_req_ots_search(<?php echo $last ?>)" class="miniaction"/>
        &nbsp;&nbsp;
        Total Page
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
        Total Rows
        <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
    </div>
</center>