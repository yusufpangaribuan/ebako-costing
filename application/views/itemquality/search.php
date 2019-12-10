<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_s_inspection_receive_gr_zxcs').scrollableFixedHeaderTable('105%', '300');
    });
</script>
<table class="tablesorter2 scrollableFixedHeaderTable" width="100%" id="tbl_s_inspection_receive_gr_zxcs">
    <thead>
        <tr>
            <th width="2%">No</th>
            <th width="8%">PO Number</th>
            <th width="10%">Date</th>
            <th width="20%">Item Code</th>
            <th>Item Description</th>
            <th width="8%">Unit</th>
            <th width="8%">Qty</th>
            <th width="8%">Status</th>
            <th width="8%">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($iteminspection as $result) {
            ?>
            <tr>
                <td align="right"><?php echo $no++; ?></td>
                <td align="center"><?php echo $result->ponumber ?></td>
                <td align="center"><?php echo date('d/m/Y', strtotime($result->date)) ?></td>
                <td align="center"><?php echo $result->itemcode ?></td>
                <td><?php echo $result->descriptions ?></td>
                <td align="center"><?php echo $result->unitcode ?></td>
                <td align="center"><?php echo $result->qty ?></td>
                <td>
                    <?php
                    if ($result->status == 'f') {
                        echo "Waiting to record";
                    } else {
                        echo "recorded";
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if ($result->status == 'f') {
                        ?>                        
                        <a href="javascript:itemquality_delete(<?php echo $result->id ?>)"><img src="images/delete.png" class="miniaction"/> Delete</a>
                        <?php
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
        <img src="images/first.png" onclick="itemquality_search(<?php echo $first ?>)" class="miniaction"/>
        <img src="images/prev.png" onclick="itemquality_search(<?php echo $prev ?>)" class="miniaction"/>
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
        <img src="images/next.png" onclick="itemquality_search(<?php echo $next ?>)" class="miniaction"/>
        <img src="images/last.png" onclick="itemquality_search(<?php echo $last ?>)" class="miniaction"/>
        &nbsp;&nbsp;
        Total Page
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
        Total Rows
        <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
    </div>
</center>