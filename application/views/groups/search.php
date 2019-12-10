<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_s_item_group9365_qzx').scrollableFixedHeaderTable('100%', '500');
    });
</script>

<table class="tablesorter2 scrollableFixedHeaderTable" width="100%" id='tbl_s_item_group9365_qzx'>
    <thead>
        <tr>
            <th width="10">NO</th>
            <th width='100'>Code</th>
            <th width='150'>Name</th>            
            <th>Description</th>
            <th width="100">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $number = $offset + 1;
        foreach ($groups as $result) {
            ?>
            <tr>
                <td>&nbsp;<?php echo $number++ ?></td>
                <td>&nbsp;<?php echo $result->codes ?></td>
                <td>&nbsp;<?php echo $result->names ?></td>
                <td>&nbsp;<?php echo $result->descriptions ?></td>                                                            
                <td>
                    <?php
                    if (in_array('edit', $accessmenu)) {
                        echo "<a href='javascript:groups_edit(" . $result->id . ")'><img src='images/edit.png' class='miniaction'/>&nbsp;Edit&nbsp;</a>";
                    }
                    if (in_array('delete', $accessmenu)) {
                        if (!in_array($result->id, array(3, 4, 5, 6, 7))) {
                            echo "<a href='javascript:groups_delete(" . $result->id . ")'><img src='images/delete.png' class='miniaction'/>&nbsp;Delete&nbsp;</a>";
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
<center>
    <div style="margin-bottom: 5px;margin-top: 5px;">
        <input type="hidden" id="offset" value="<?php echo $offset ?>" />
        <img src="images/first.png" onclick="groups_search(<?php echo $first ?>)" class="miniaction"/>
        <img src="images/prev.png" onclick="groups_search(<?php echo $prev ?>)" class="miniaction"/>
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
        <img src="images/next.png" onclick="groups_search(<?php echo $next ?>)" class="miniaction"/>
        <img src="images/last.png" onclick="groups_search(<?php echo $last ?>)" class="miniaction"/>
        &nbsp;&nbsp;
        Total Page
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
        Total Rows
        <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
    </div>
</center>