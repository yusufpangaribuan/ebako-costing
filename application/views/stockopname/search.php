<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_stockopname').scrollableFixedHeaderTable('100%', '450', null, null, null, 'tbl_stockopname');
    });
</script>
<table class="tablesorter scrollableFixedHeaderTable" id="tbl_stockopname" width="100%">
    <thead>
        <tr>
            <th width="2%">No</th>
            <th width="15%">ID</th>
            <th width="8%">Date</th>
            <th width="10%">Warehouse</th>
            <th width="20%">Description</th>
            <th width="5%">Status</th>
            <th width="15%">Posting Time</th>
            <th width="22%">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $number = $offset + 1;
        foreach ($stockopname as $result) {
            ?>
            <tr>
                <td align="right"><?php echo $number++ ?></td>
                <td align="center">
                    <a href="javascript:stockopname_print(<?php echo $result->id ?>,'v')"><?php echo $result->stockopname_no ?></a>
                </td>
                <td align="center"><?php echo date('d-m-Y', strtotime($result->date)) ?></td>
                <td><?php echo $result->warehouse_name ?>&nbsp;</td>
                <td><?php echo $result->description; ?></td>
                <td>
                    <?php
                    if ($result->status == 2) {
                        echo 'Posted';
                    } else {
                        echo 'Draft';
                    }
                    ?>
                </td>
                <td align='center'>
                    <?php
                    if (!empty($result->posting_time)) {
                        echo date('d/m/Y H:i', strtotime($result->posting_time));
                    }
                    ?>
                    &nbsp;
                </td>
                <td>
                    <?php
                    //if (in_array('edit', $accessmenu)) {
                    echo "<a href=javascript:stockopname_print($result->id,'p')><img class='miniaction' src='images/print.png'>&nbsp;Print&nbsp;&nbsp;&nbsp;</a>";
                    echo "<a href='javascript:stockopname_excel($result->id)'><img class='miniaction' src='images/excel.png'>&nbsp;Excel&nbsp;&nbsp;&nbsp;</a>";
                    if ($result->status != 2) {
                        echo "<a href='javascript:stockopname_posting($result->id)'><img class='miniaction' src='images/posting.png'>&nbsp;Posting&nbsp;&nbsp;&nbsp;</a>";
                        echo "<a href='javascript:stockopname_edit($result->id)'><img class='miniaction' src='images/edit.png'>&nbsp;Edit&nbsp;&nbsp;&nbsp;</a>";
                        //}if (in_array('delete', $accessmenu)) {
                        echo "<a href='javascript:stockopname_delete($result->id)'><img class='miniaction' src='images/delete.png'>&nbsp;Delete&nbsp;</a>";
                    }
                    //}
                    ?>                            
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<table width="100%">
    <tr>
        <td width="50%">
            <input type="hidden" id="offset" value="<?php echo $offset ?>" />
            <a href="javascript:stockopname_search(<?php echo $first ?>)"> << First </a>
            <a href="javascript:stockopname_search(<?php echo $prev ?>)"> < Prev </a>
            |
            <?php echo "Page $page of $num_page "; ?>
            |
            <a href="javascript:stockopname_search(<?php echo $next ?>)"> Next > </a>
            <a href="javascript:stockopname_search(<?php echo $last ?>)"> Last >> </a>
        </td>
        <td width="50%" align="right">
            Row <?php echo $offset . " - " . ($next) . " of " . $num_rows ?>
        </td>
    </tr>
</table>