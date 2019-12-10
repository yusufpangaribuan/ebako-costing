<?php
if ($flag === "print") {
    ?>
    <html>
        <head>
            <title>KARTU STOCK</title>
            <style>
                *{
                    font-size: 8pt;
                    font-family: Tahoma;
                }
            </style>
        </head>
        <body>
            <?php
        }
        foreach ($item as $result) {
            $query = "select bg.* from begining_balance bg where bg.itemid={$result->id} and bg.warehouseid=$warehouseid";
            $bg_rst = $this->db->query($query)->row();
            $bg = empty($bg_rst) ? 0 : $bg_rst->stock;

            $query = "select coalesce(sum(vst.qty_in_small_unit),0) total 
                    from v_stock_transaction_time vst 
                    where vst.trans_time >= '2016-01-01' and vst.trans_time < '$start_date' 
                    and  vst.itemid={$result->id} 
                    and vst.warehouseid=$warehouseid
                    and vst.status=1
                    and vst.qty_in_small_unit is not null";

            $total_in = $this->db->query($query)->row()->total;

            $query = "select coalesce(sum(vst.qty_in_small_unit),0) total 
                    from v_stock_transaction_time vst 
                    where vst.trans_time >= '2016-01-01' and vst.trans_time < '$start_date' 
                    and  vst.itemid={$result->id} 
                    and vst.warehouseid=$warehouseid
                    and vst.status=0
                    and vst.qty_in_small_unit is not null";

            $total_out = $this->db->query($query)->row()->total;

            $last_balance = ($bg + $total_in) - $total_out;
            ?>
            <div style="width: 600px">
                <table width="100%">
                    <tr>
                        <td colspan="3" width="100%" align="center">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3" width="100%" align="center">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3" width="100%"><strong style="font-size: 16px">KARTU STOCK BARANG</strong></td>
                    </tr>
                    <tr>
                        <td width="20%"><strong>Item Code</strong></td>
                        <td width="80%">: <?php echo $result->item_code ?>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="20%"><strong>Item Description</strong></td>
                        <td width="80%">: <?php echo $result->item_description ?>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="20%"><strong>UoM</strong></td>
                        <td width="80%">: <?php echo $this->model_item->get_small_unit($result->id) ?>&nbsp;</td>
                    </tr>
                    <?php
                    if (in_array('display_price', $accessmenu)) {
                        ?>
                        <tr>
                            <td><strong>Price</strong></td>
                            <td>: <?php echo number_format($result->price_in_base_unit, 2) ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <table width="100%" style="border: 1px #000 solid;border-collapse: collapse;margin-top: 15px">
                    <thead>
                        <tr>
                            <th style="border: 1px solid;font-weight: bold;min-width: 80px;" align="center" rowspan="2">Date</th>
                            <th style="border: 1px solid;font-weight: bold;min-width: 180px;" align="center" rowspan="2">Description</th>
                            <th colspan="3" style="border: 1px solid;font-weight: bold;" align="center">In</th>
                            <th colspan="3" style="border: 1px solid;font-weight: bold;" align="center">Out</th>
                            <th colspan="3" style="border: 1px solid;font-weight: bold;" align="center">Balance</th>
                            <th style="border: 1px solid;font-weight: bold;min-width: 150px;" align="center" rowspan="2">Remark</th>
                        </tr>
                        <tr>
                            <th style="border: 1px solid;font-weight: bold;min-width: 50px;">Qty</th>
                            <th style="border: 1px solid;font-weight: bold;min-width: 100px;">Cost</th>
                            <th style="border: 1px solid;font-weight: bold;min-width: 100px;">Value</th>
                            <th style="border: 1px solid;font-weight: bold;min-width: 50px;">Qty</th>
                            <th style="border: 1px solid;font-weight: bold;min-width: 100px;">Cost</th>
                            <th style="border: 1px solid;font-weight: bold;min-width: 100px;">Value</th>
                            <th style="border: 1px solid;font-weight: bold;min-width: 50px;">Qty</th>
                            <th style="border: 1px solid;font-weight: bold;min-width: 100px;">Cost</th>
                            <th style="border: 1px solid;font-weight: bold;min-width: 100px;">Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: 1px solid;text-align: center;"><?php echo date('d/m/Y', strtotime($start_date)) ?></td>
                            <td style="border: 1px solid;">Beginning Balance&nbsp;</td>
                            <td style="border: 1px solid;">&nbsp;</td>
                            <td style="border: 1px solid;">&nbsp;</td>
                            <td style="border: 1px solid;">&nbsp;</td>
                            <td style="border: 1px solid;">&nbsp;</td>
                            <td style="border: 1px solid;">&nbsp;</td>
                            <td style="border: 1px solid;">&nbsp;</td>
                            <td style="border: 1px solid;" align="right"><?php echo $last_balance; ?>&nbsp;</td>
                            <td style="border: 1px solid;">&nbsp;</td>
                            <td style="border: 1px solid;">&nbsp;</td>
                            <td style="border: 1px solid;">&nbsp;</td>
                        </tr>

                        <?php
                        $query = " select * from
                    v_stock_transaction_time vst
                    where vst.itemid={$result->id} and vst.trans_time between '$start_date' and '$end_date'   
                    and vst.warehouseid=$warehouseid
                    order by vst.trans_time asc";

                        $transaction = $this->db->query($query)->result();
                        $count = 10;
                        $total_value_in = 0;
                        $total_value_out = 0;
                        if (!empty($transaction)) {
                            ?>

                            <?php
                            foreach ($transaction as $result2) {
                                ?>
                                <tr>
                                    <td style="border: 1px solid;text-align: center;">
                                        <?php
                                        if (empty($result2->trans_time)) {
                                            echo date('d/m/Y', strtotime($result2->date));
                                        } else {
                                            echo date('d/m/Y', strtotime($result2->trans_time));
                                        }
                                        ?>
                                    </td>
                                    <td style="border: 1px solid;"><?php echo $result2->reff ?></td>
                                    <td style="border: 1px solid;text-align: center">
                                        <?php
                                        if ($result2->status == 1) {
                                            echo round($result2->qty_in_small_unit, 2);
                                            $last_balance = $last_balance + $result2->qty_in_small_unit;
                                        }
                                        ?>&nbsp;
                                    </td>
                                    <td style="border: 1px solid;" align="right">
                                        <?php
                                        if ($result2->status == 1) {
                                            if (in_array('display_price', $accessmenu)) {
                                            echo $result->price_in_base_unit;
                                            }
                                        }
                                        ?>
                                    </td>&nbsp;
                                    <td style="border: 1px solid;" align="right">
                                        <?php
                                        if ($result2->status == 1) {
                                            if (in_array('display_price', $accessmenu)) {
                                                echo number_format(($result->price_in_base_unit * $result2->qty_in_small_unit), 2);
                                            }
                                            $total_value_in += ($result->price_in_base_unit * $result2->qty_in_small_unit);
                                        }
                                        ?>&nbsp;
                                    </td>
                                    <td style="border: 1px solid;" align="center">
                                        <?php
                                        if ($result2->status == 0) {
                                            echo round($result2->qty_in_small_unit, 3);
                                            $last_balance = $last_balance - $result2->qty_in_small_unit;
                                        }
                                        ?>&nbsp;
                                    </td>
                                    <td style="border: 1px solid;" align="right">
                                        <?php
                                        if ($result2->status == 0) {
                                            if (in_array('display_price', $accessmenu)) {
                                                echo round($result->price_in_base_unit, 3);
                                            }
                                        }
                                        ?>&nbsp;
                                    </td>
                                    <td style="border: 1px solid;" align="right">
                                        <?php
                                        if ($result2->status == 0) {
                                            if (in_array('display_price', $accessmenu)) {
                                                echo number_format(($result->price_in_base_unit * $result2->qty_in_small_unit), 2);
                                            }
                                            $total_value_out += ($result->price_in_base_unit * $result2->qty_in_small_unit);
                                        }
                                        ?>
                                    </td>
                                    <td style="border: 1px solid;" align="right">
                                        <?php echo round($last_balance, 3); ?>&nbsp;</td>
                                    <td style="border: 1px solid;" align="right">
                                        <?php
                                        if (in_array('display_price', $accessmenu)) {
                                            echo $result->price_in_base_unit;
                                        }
                                        ?>&nbsp;
                                    </td>
                                    <td style="border: 1px solid;" align="right">
                                        <?php
                                        if (in_array('display_price', $accessmenu)) {
                                            echo number_format(($last_balance * $result->price_in_base_unit), 2);
                                        }
                                        ?>&nbsp;
                                    </td>
                                    <td style="border: 1px solid;"><?php echo $result2->remark ?>&nbsp;</td>
                                </tr>
                                <?php
                                $count--;
                            }
                            for ($i = 0; $i < $count; $i++) {
                                ?>
                                <tr>
                                    <td style="border: 1px solid;">&nbsp;</td>
                                    <td style="border: 1px solid;">&nbsp;</td>
                                    <td style="border: 1px solid;">&nbsp;</td>
                                    <td style="border: 1px solid;">&nbsp;</td>
                                    <td style="border: 1px solid;">&nbsp;</td>
                                    <td style="border: 1px solid;">&nbsp;</td>
                                    <td style="border: 1px solid;">&nbsp;</td>
                                    <td style="border: 1px solid;">&nbsp;</td>
                                    <td style="border: 1px solid;">&nbsp;</td>
                                    <td style="border: 1px solid;">&nbsp;</td>
                                    <td style="border: 1px solid;">&nbsp;</td>
                                    <td style="border: 1px solid;">&nbsp;</td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
        }
        if ($flag) {
            ?>
        </body>
    </html>
    <?php
}
?>

