<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_po_critical').scrollableFixedHeaderTable('102%', '460', null, null, null, 'tbl_rates');
    });
</script>
<table class="tablesorter scrollableFixedHeaderTable" id="tbl_po_critical" width="100%">
    <thead>
        <tr>
            <th width="2%">No</th>            
            <th width="6%">P.O No</th>
            <th width="5%">P.O Date</th>
            <th width="15%">Vendor/Supplier</th>
            <th width="8%">Delivery Term</th>
            <th width="10%">Item Code</th>            
            <th width="36%">Item Description</th>
            <th width="5%">Qty Request</th>
            <th width="5%">Qty Outstanding</th>
            <th width="5%">Unit</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($po_critical)) {
            $number = $offset;
            foreach ($po_critical as $result) {
                ?>
                <tr>
                    <td align="right"><?php echo $number++; ?></td>            
                    <td><?php echo $result->po_number ?></td>
                    <td><?php echo date('d/m/Y', strtotime($result->po_date)) ?></td>
                    <td><?php echo $result->vendor_name ?></td>
                    <td><?php echo ($result->delivery_date_valid == 't') ? date('d/m/Y',  strtotime($result->deliveryterm)) :  $result->deliveryterm?></td>
                    <td><?php echo $result->item_code ?></td>
                    <td><?php echo nl2br($result->item_description) ?></td>
                    <td align="right"><?php echo $result->qty ?></td>
                    <td align="right"><?php echo $result->outstanding ?></td>
                    <td align="center"><?php echo $result->unit_code ?></td>
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
<table width="100%">
    <tr>
        <td width="50%">
            <input type="hidden" id="offset" value="<?php echo $offset ?>" />
            <a href="javascript:po_critical_search(<?php echo $first ?>)"> << First </a>
            <a href="javascript:po_critical_search(<?php echo $prev ?>)"> < Prev </a>
            |
            <?php echo "Page $page of $num_page "; ?>
            |
            <a href="javascript:po_critical_search(<?php echo $next ?>)"> Next > </a>
            <a href="javascript:po_critical_search(<?php echo $last ?>)"> Last >> </a>
        </td>
        <td width="50%" align="right">
            Row <?php echo $offset . " - " . ($next) . " of " . $num_rows ?>
        </td>
    </tr>
</table>