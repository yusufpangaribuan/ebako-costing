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
                        <td colspan="3" width="100%" align="center"><strong style="font-size: 16px">KARTU STOCK BARANG</strong></td>
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
                            <th width="10%" style="border: 1px solid;font-weight: bold;" align="center">Date</th>
                            <th width="30%" style="border: 1px solid;font-weight: bold;" align="center">Description</th>
                            <th width="10%" style="border: 1px solid;font-weight: bold;" align="center">In</th>
                            <th width="10%" style="border: 1px solid;font-weight: bold;" align="center">Out</th>
                            <th width="10%" style="border: 1px solid;font-weight: bold;" align="center">Balance</th>
                            <th width="30%" style="border: 1px solid;font-weight: bold;" align="center">Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "
                                select * 
                                from
                                v_stock_transaction
                                where itemid=" . $result->id . " and date between '$start_date' and '$end_date'   
                                and warehouseid=$warehouseid
                                order by transactionid asc";
                        $transaction = $this->db->query($query)->result();
                        $last_balance = $this->model_stock->get_last_balance_before_param_date($result->id, $warehouseid, $start_date);
                        $count = 10;
                        ?>
    <!--                        <tr><td colspan="6"><?php //echo $query  ?></td></tr>-->
                        <?php
                        if (!empty($transaction)) {
                            ?>
                            <tr>
                                <td colspan="2" style="border: 1px solid;">Last Balance&nbsp;</td>
                                <td style="border: 1px solid;">&nbsp;</td>
                                <td style="border: 1px solid;">&nbsp;</td>
                                <td style="border: 1px solid;" align="right"><?php echo $last_balance; ?>&nbsp;</td>
                                <td style="border: 1px solid;">&nbsp;</td>
                            </tr>
                            <?php
                            foreach ($transaction as $result2) {
                                ?>
                                <tr>
                                    <td style="border: 1px solid;"><?php echo date('d/m/Y', strtotime($result2->date)) ?></td>
                                    <td style="border: 1px solid;"><?php echo $result2->reff ?></td>
                                    <td style="border: 1px solid;" align="right">
                                        <?php
                                        if ($result2->status == 1) {
                                            echo $result2->qty_in_small_unit;
                                            $last_balance = $last_balance + $result2->qty_in_small_unit;
                                        }
                                        ?>&nbsp;
                                    </td>
                                    <td style="border: 1px solid;" align="right">
                                        <?php
                                        if ($result2->status == 0) {
                                            echo $result2->qty_in_small_unit;
                                            $last_balance = $last_balance - $result2->qty_in_small_unit;
                                        }
                                        ?>&nbsp;
                                    </td>
                                    <td style="border: 1px solid;" align="right"><?php echo $last_balance; ?>&nbsp;</td>
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

