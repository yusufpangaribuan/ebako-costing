<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_item_slow_moving').scrollableFixedHeaderTable('102%', '460', null, null, null, 'tbl_rates');
    });
</script>
<table class="tablesorter scrollableFixedHeaderTable" id="tbl_item_slow_moving" width="100%">
    <thead>
        <tr>
            <th width="2%">No</th>
            <th width="10%">Item Group</th>
            <th width="20%">Item Code</th>
            <th width="40%">Item Description</th>
            <th width="10%">Stock</th>
            <th width="10%">Last Move</th>
            <th width="8%">DoI</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($item_list)) {
            $number = $offset;
            foreach ($item_list as $result) {
                $allunit = $this->model_item->selectAllUnit2($result->id);
                ?>
                <tr>
                    <td align="right"><?php echo $number++; ?></td>
                    <td><?php echo $result->group_code ?></td>
                    <td><?php echo $result->item_code ?></td>
                    <td><?php echo nl2br($result->item_description) ?></td>
                    <td align="center">
                        <table width="100%" cellspacing="0" cellpadding="0" class="child">
                            <thead>
                                <tr>
                                    <?php
                                    $colspan = 1;
                                    echo "<th width='50'>Unit</th>";
                                    $whs = $this->model_warehouse->selectAllByItem($result->id);
                                    foreach ($whs as $rstwhs) {
                                        echo "<th>" . $rstwhs->warehousename . "</th>";
                                        $colspan++;
                                    }

                                    if (($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') == 0) ||
                                            $this->session->userdata('department') != 10) {
                                        echo "<th>TTL</th>";
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $lastunit = 0;
                                $tempstock = 0;
                                $tempallstock = 0;
                                if (!empty($allunit)) {
                                    $tempallstock = 0;
                                    foreach ($allunit as $allunit) {
                                        if ($lastunit == 0) {
                                            $lastunit = $allunit->unitfrom;
                                        }
                                        echo "<tr>"; //print_r($allunit);
                                        echo "<td align=center>" . $allunit->codes . "</td>";
                                        $whs = $this->model_warehouse->selectAllByItem($result->id);
                                        $tempstock = 0;
                                        if (empty($whs)) {
                                            echo "<td align=right>0&nbsp;</td>";
                                        } else {
                                            foreach ($whs as $rstwhs) {
                                                $stock = $this->model_stock->getStockByItemAndUnitAndWarehouse($result->id, $allunit->unitfrom, $rstwhs->id);
                                                echo "<td align=right>" . $stock->stock . "&nbsp;</td>";
                                                $tempstock += $stock->stock;
                                            }
                                            $tempallstock = ($tempallstock + $tempstock) * $stock->conversionvalue;
                                            if (($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') == 0) ||
                                                    $this->session->userdata('department') != 10) {
                                                echo "<td align=right>" . $tempstock . "&nbsp;</td>";
                                            }
                                        }
                                        echo "</tr>";
                                    }
                                }
                                ?>                                         
                                <tr>
                                    <td align=center>TTL (<?php echo (!empty($allunit) ? $allunit->codes : "") ?>)</td>
                                    <td align="right" colspan="<?php echo $colspan + 1 ?>"><?php echo $tempallstock ?>&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>       
                    </td>
                    <td align="center">
                        <?php
                        echo (!empty($result->last_transaction_date)) ? date('d/m/Y', strtotime($result->last_transaction_date)) : "";
                        ?>
                    </td>
                    <td align="center"><?php echo $result->doi ?></td>
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
            <a href="javascript:item_slowmoving_search(<?php echo $first ?>)"> << First </a>
            <a href="javascript:item_slowmoving_search(<?php echo $prev ?>)"> < Prev </a>
            |
            <?php echo "Page $page of $num_page "; ?>
            |
            <a href="javascript:item_slowmoving_search(<?php echo $next ?>)"> Next > </a>
            <a href="javascript:item_slowmoving_search(<?php echo $last ?>)"> Last >> </a>
        </td>
        <td width="50%" align="right">
            Row <?php echo $offset . " - " . ($next) . " of " . $num_rows ?>
        </td>
    </tr>
</table>