<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_employee').scrollableFixedHeaderTable('100%', '500', null, null, null, 'tbl_rates');
    });
</script>
<table class="tablesorter scrollableFixedHeaderTable" id="tbl_employee" width="100%">
    <thead>
        <tr>
            <th width="2%">NO</th>            
            <th width="10%">ID</th>
            <th width="10%">Name</th>
            <th width="10%">Area</th>            
            <th width="10%">Department</th>
            <th width="10%">Sub Department</th>
            <th width="10%">Cost Center</th>
            <th width="10%">Position</th>
            <th width="5%">Start date</th>
            <th width="5%">End date</th>  
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($employee)) {
            $number = $offset;
            foreach ($employee as $result) {
                ?>
                <tr>
                    <td align="right"><?php echo $number++; ?></td>            
                    <td><?php echo $result->id ?></td>
                    <td><?php echo $result->name ?></td>
                    <td><?php echo $result->area ?></td>
                    <td><?php echo $result->department ?></td>
                    <td><?php echo $result->subdepartment ?></td>
                    <td><?php echo $result->costcenter ?></td>
                    <td><?php echo $result->position ?></td>
                    <td><?php echo!empty($employee->startdate) ? date('d/m/Y', strtotime($result->startdate)) : ""; ?></td>
                    <td><?php echo $result->enddate ?></td>                   
                    <td>
                        <?php
                        if (in_array('edit', $accessmenu)) {
                            echo "<a href=javascript:employee_edit('" . $result->id . "')><img class='miniaction' src='images/edit.png'>&nbsp;Edit&nbsp;</a>";
                        }if (in_array('delete', $accessmenu)) {
                            echo "<a href=javascript:employee_delete('" . $result->id . "')><img class='miniaction' src='images/delete.png'>&nbsp;Delete&nbsp;</a>";
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="18">No Data.....</td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<center>
    <div style="margin-bottom: 5px;margin-top: 5px;">
        <input type="hidden" id="offset" value="<?php echo $offset ?>" />
        <img src="images/first.png" onclick="employee_search(<?php echo $first ?>)" class="miniaction"/>
        <img src="images/prev.png" onclick="employee_search(<?php echo $prev ?>)" class="miniaction"/>
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
        <img src="images/next.png" onclick="employee_search(<?php echo $next ?>)" class="miniaction"/>
        <img src="images/last.png" onclick="employee_search(<?php echo $last ?>)" class="miniaction"/>
        &nbsp;&nbsp;
        Total Page
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
        Total Rows
        <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
    </div>
</center>