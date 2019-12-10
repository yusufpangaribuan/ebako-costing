<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_costcenter').scrollableFixedHeaderTable('100%', '500', null, null, null, 'tbl_costcenter');
    });
</script>
<table class="tablesorter scrollableFixedHeaderTable" id="tbl_costcenter" width="100%">
    <thead>
        <tr>
            <th width="1%">No</th>
            <th width="10%">Code</th>
            <th width="40%">Description</th>
            <th width="29%">Member</th>
            <th width="20%">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $number = 1;
        foreach ($costcenter as $result) {
            ?>
            <tr>
                <td align="right"><?php echo $number++ ?></td>
                <td><?php echo $result->code ?>&nbsp;</td>
                <td><?php echo $result->description ?></td>
                <td><?php echo $result->member_list ?></td>
                <td>
                    <?php
                    if (in_array('edit', $accessmenu)) {
                        echo "<a href='javascript:costcenter_edit($result->id)'><img class='miniaction' src='images/edit.png'>Edit&nbsp;&nbsp;&nbsp;</a>";
                    }if (in_array('set_member', $accessmenu)) {
                        echo "<a href='javascript:costcenter_set_member($result->id)'><img class='miniaction' src='images/set.png'>Set Member&nbsp;</a>";
                    }if (in_array('delete', $accessmenu)) {
                        echo "<a href='javascript:costcenter_delete($result->id)'><img class='miniaction' src='images/delete.png'>Delete&nbsp;</a>";
                    }
                    ?>                            
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
        <img src="images/first.png" onclick="costcenter_search(<?php echo $first ?>)" class="miniaction"/>
        <img src="images/prev.png" onclick="costcenter_search(<?php echo $prev ?>)" class="miniaction"/>
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
        <img src="images/next.png" onclick="costcenter_search(<?php echo $next ?>)" class="miniaction"/>
        <img src="images/last.png" onclick="costcenter_search(<?php echo $last ?>)" class="miniaction"/>
        &nbsp;&nbsp;
        Total Page
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
        Total Rows
        <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
    </div>
</center>