<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_s_inspection_gr_zxcs').scrollableFixedHeaderTable('105%', '200');
    });
</script>
<table class="tablesorter2 scrollableFixedHeaderTable" width="100%" id="tbl_s_inspection_gr_zxcs">
    <thead>
        <tr>
            <th width="10">No</th>
            <th>PO Number</th>
            <th>Item Code</th>
            <th>Item Description</th>
            <th>Unit</th>
            <th>Request</th>
            <th>Outstanding</th>            
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($item as $result) {
            ?>
            <tr>
                <td align="right"><?php echo $no++; ?></td>
                <td align="center"><?php echo $result->ponumber ?></td>
                <td align="center"><?php echo $result->itempartnumber ?></td>
                <td align="left"><?php echo $result->itemdescription ?></td>
                <td align="center"><?php echo $result->unitcode ?></td>            
                <td align="center"><?php echo $result->qty ?></td>
                <td align="center"><?php echo $result->outstanding ?></td>                
                <td align="center"><button onclick="itemquality_set(<?php echo $result->id ?>)">Set</button></td>                
            </tr>
            <?php
        }
        ?>
    </tbody>
</table> 