<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_stock_card').scrollableFixedHeaderTable('102%', '500', null, null, null, 'tbl_stock_card');
    });
</script>
<table class="tablesorter2 scrollableFixedHeaderTable" id="tbl_stock_card" width="100%">
    <thead>
        <tr>
            <th width="10%">Date</th>            
            <th width="30%">Description</th>
            <th width="10%">In</th>
            <th width="10%">Out</th>
            <th width="10%">Balance</th>
            <th width="30%">Remark</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($item)) {
            ?>
            <tr>
                <td colspan="2">Last Balance&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="right"><?php echo $last_balance; ?>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <?php
            foreach ($item as $result) {
                ?>
                <tr>
                    <td><?php echo date('d/m/Y', strtotime($result->date)) ?></td>
                    <td><?php echo $result->reff ?></td>
                    <td align="right">
                        <?php
                        if ($result->status == 1) {
                            echo $result->qty_in_small_unit;
                            $last_balance = $last_balance + $result->qty_in_small_unit;
                        }
                        ?>&nbsp;
                    </td>
                    <td align="right">
                        <?php
                        if ($result->status == 0) {
                            echo $result->qty_in_small_unit;
                            $last_balance = $last_balance - $result->qty_in_small_unit;
                        }
                        ?>&nbsp;
                    </td>
                    <td align="right"><?php echo $last_balance; ?>&nbsp;</td>
                    <td><?php echo $result->remark ?>&nbsp;</td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        <?php } ?>
    </tbody>
</table>