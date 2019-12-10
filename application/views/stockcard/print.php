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
        ?>
        <div style="max-width: 700px;padding: 5px;">
            <table width="100%">
                <tr>
                    <td colspan="3" width="100%" align="center"><strong style="font-size: 16px">KARTU STOCK BARANG</strong></td>
                </tr>
                <tr>
                    <td width="20%"><strong>Item Code</strong></td>
                    <td width="80%">: <?php echo $item_detail->partnumber ?>&nbsp;</td>
                </tr>
                <tr>
                    <td width="20%"><strong>Item Description</strong></td>
                    <td width="80%">: <?php echo $item_detail->descriptions ?>&nbsp;</td>
                </tr>
                <tr>
                    <td width="20%"><strong>UoM</strong></td>
                    <td width="80%">: <?php echo $this->model_item->get_small_unit($item_detail->id) ?>&nbsp;</td>
                </tr>
                <?php
                if (in_array('display_price', $accessmenu)) {
                    ?>
                    <tr>
                        <td><strong>Price</strong></td>
                        <td>: <?php echo number_format($item_detail->price_in_base_unit, 2) ?></td>
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
                    $count = 10;
                    $total_value_in = 0;
                    $total_value_out = 0;
                    if (!empty($item)) {
                        foreach ($item as $result) {
                            ?>
                            <tr>
                                <td style="border: 1px solid;text-align: center;">
                                    <?php
                                    if (empty($result->trans_time)) {
                                        echo date('d/m/Y', strtotime($result->date));
                                    } else {
                                        echo date('d/m/Y', strtotime($result->trans_time));
                                    }
                                    ?>
                                </td>
                                <td style="border: 1px solid;"><?php echo $result->reff ?></td>
                                <td style="border: 1px solid;text-align: center">
                                    <?php
                                    if ($result->status == 1) {
                                        echo $result->qty_in_small_unit;
                                        $last_balance = $last_balance + $result->qty_in_small_unit;
                                    }
                                    ?>&nbsp;
                                </td>
                                <td style="border: 1px solid;" align="right">
                                    <?php
                                    if ($result->status == 1) {
                                        if (in_array('display_price', $accessmenu)) {
                                            echo $item_detail->price_in_base_unit;
                                        }
                                    }
                                    ?>
                                </td>&nbsp;
                                <td style="border: 1px solid;" align="right">
                                    <?php
                                    if ($result->status == 1) {
                                        if (in_array('display_price', $accessmenu)) {
                                            echo ($item_detail->price_in_base_unit * $result->qty_in_small_unit);
                                        }
                                        $total_value_in += ($item_detail->price_in_base_unit * $result->qty_in_small_unit);
                                    }
                                    ?>&nbsp;
                                </td>
                                <td style="border: 1px solid;" align="center">
                                    <?php
                                    if ($result->status == 0) {
                                        echo $result->qty_in_small_unit;
                                        $last_balance = $last_balance - $result->qty_in_small_unit;
                                    }
                                    ?>&nbsp;
                                </td>
                                <td style="border: 1px solid;" align="right">
                                    <?php
                                    if ($result->status == 0) {
                                        if (in_array('display_price', $accessmenu)) {
                                            echo $item_detail->price_in_base_unit;
                                        }
                                    }
                                    ?>
                                </td>
                                <td style="border: 1px solid;" align="right">
                                    <?php
                                    if ($result->status == 0) {
                                        if (in_array('display_price', $accessmenu)) {
                                            echo ($item_detail->price_in_base_unit * $result->qty_in_small_unit);
                                        }
                                        $total_value_out += ($item_detail->price_in_base_unit * $result->qty_in_small_unit);
                                    }
                                    ?>
                                </td>
                                <td style="border: 1px solid;" align="right">
                                    <?php echo $last_balance; ?>&nbsp;</td>
                                <td style="border: 1px solid;" align="right"><?php echo $item_detail->price_in_base_unit; ?></td>
                                <td style="border: 1px solid;" align="right">
                                    <?php
                                    echo ($last_balance * $item_detail->price_in_base_unit);
                                    ?>&nbsp;</td>
                                <td style="border: 1px solid;"><?php echo $result->remark ?>&nbsp;</td>
                            </tr>
                            <?php
                            $count--;
                        }
                        for ($i = 0; $i < $count; $i++) {
                            ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        if ($flag) {
            ?>
        </body>
    </html>
    <?php
}
?>

