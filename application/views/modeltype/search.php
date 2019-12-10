<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_s_model_type_qzx').scrollableFixedHeaderTable('100%', '500');
    });
</script>
<table class="tablesorter2 scrollableFixedHeaderTable" width="100%" id="tbl_s_model_type_qzx">
    <thead>
        <tr>
            <th width="10">No</th>
            <th width="100">Code</th>                   
            <th>Description</th>
            <th width="100">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $number = $offset + 1;
        foreach ($modeltype as $result) {
            ?>
            <tr>
                <td align="right">&nbsp;<?php echo $number++ ?></td>                
                <td>&nbsp;<?php echo $result->name ?></td>
                <td>&nbsp;<?php echo $result->description ?></td>                                                            
                <td align="center">
                    <?php
                    if (in_array('edit', $accessmenu)) {
                        echo "<a href='javascript:modeltype_edit(" . $result->id . ")'><img src='images/edit.png' class='miniaction'/>&nbsp;Edit&nbsp;</a>";
                    }
                    if (in_array('delete', $accessmenu)) {
                        echo "<a href='javascript:modeltype_delete(" . $result->id . ")'><img src='images/delete.png' class='miniaction'/>&nbsp;Delete&nbsp;</a>";
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
        <img src="images/first.png" onclick="modeltype_search(<?php echo $first ?>)" class="miniaction"/>
        <img src="images/prev.png" onclick="modeltype_search(<?php echo $prev ?>)" class="miniaction"/>
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
        <img src="images/next.png" onclick="modeltype_search(<?php echo $next ?>)" class="miniaction"/>
        <img src="images/last.png" onclick="modeltype_search(<?php echo $last ?>)" class="miniaction"/>
        &nbsp;&nbsp;
        Total Page
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
        Total Rows
        <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
    </div>
</center>
