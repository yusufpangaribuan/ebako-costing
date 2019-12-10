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
        <div style="min-width: 600px">
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
                        <th width="10%" style="border: 1px solid;font-weight: bold;" align="center" rowspan="2">Date</th>
                        <th width="30%" style="border: 1px solid;font-weight: bold;" align="center" rowspan="2">Description</th>
                        <th width="10%" colspan="3" style="border: 1px solid;font-weight: bold;" align="center">In</th>
                        <th width="10%" colspan="3" style="border: 1px solid;font-weight: bold;" align="center">Out</th>
                        <th width="10%" colspan="3" style="border: 1px solid;font-weight: bold;" align="center">Balance</th>
                        <th width="30%" style="border: 1px solid;font-weight: bold;" align="center" rowspan="2">Remark</th>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>

                    <tr>
                        <td style="border: 1px solid;"><?php echo date('d/m/Y',  strtotime($start_date))?></td>
                        <td style="border: 1px solid;">Beginning Balance&nbsp;</td>
                        <td style="border: 1px solid;">&nbsp;</td>
                        <td style="border: 1px solid;">&nbsp;</td>
                        <td style="border: 1px solid;" align="right"><?php echo $last_balance; ?>&nbsp;</td>
                        <td style="border: 1px solid;">&nbsp;</td>
                    </tr>
                    <?php
                    $count = 10;
                    if (!empty($item)) {
                        foreach ($item as $result) {
                            ?>
                            <tr>
                                <td style="border: 1px solid;">
                                    <?php
                                    if (empty($result->trans_time)) {
                                        echo date('d/m/Y', strtotime($result->date));
                                    } else {
                                        echo date('d/m/Y', strtotime($result->trans_time));
                                    }
                                    ?>
                                </td>
                                <td style="border: 1px solid;"><?php echo $result->reff ?></td>
                                <td style="border: 1px solid;" align="right">
                                    <?php
                                    if ($result->status == 1) {
                                        echo $result->qty_in_small_unit;
                                        $last_balance = $last_balance + $result->qty_in_small_unit;
                                    }
                                    ?>&nbsp;
                                </td>
                                <td style="border: 1px solid;" align="right">
                                    <?php
                                    if ($result->status == 0) {
                                        echo $result->qty_in_small_unit;
                                        $last_balance = $last_balance - $result->qty_in_small_unit;
                                    }
                                    ?>&nbsp;
                                </td>
                                <td style="border: 1px solid;" align="right"><?php echo $last_balance; ?>&nbsp;</td>
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

