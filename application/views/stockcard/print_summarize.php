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
        <div style="min-width: 700px;">
            <table width="100%">
                <tr>
                    <td><strong>LAPORAN SUMMARIZE KARTU STOCK</strong></td>
                </tr>
                <tr>
                    <td><strong>PERIODE <?php echo date('d/m/Y', strtotime($start_date)) . ' s/d' . date('d/m/Y', strtotime($end_date)) ?></strong></td>
                </tr>
            </table>
            <table width="100%" style="border: 1px #000 solid;border-collapse: collapse;margin-top: 15px">
                <thead>
                    <tr>
                        <th style="border: 1px solid;font-weight: bold;width: 10px;" align="center">No</th>
                        <th style="border: 1px solid;font-weight: bold;width: 80px;" align="center">Item Code</th>
                        <th style="border: 1px solid;font-weight: bold;width: 200px;" align="center">Description</th>
                        <th style="border: 1px solid;font-weight: bold;width: 30px;" align="center">Unit</th>
                        <th style="border: 1px solid;font-weight: bold;width: 80px;" align="center">Beginning Balance</th>
                        <th style="border: 1px solid;font-weight: bold;width: 50px;" align="center">In</th>
                        <th style="border: 1px solid;font-weight: bold;width: 50px;" align="center">Out</th>
                        <th style="border: 1px solid;font-weight: bold;width: 50px;" align="center">Ending Balance</th>
                        <th style="border: 1px solid;font-weight: bold;width: 100px;" align="center">Beginning Value</th>
                        <th style="border: 1px solid;font-weight: bold;width: 100px;" align="center">Value In</th>
                        <th style="border: 1px solid;font-weight: bold;width: 100px;" align="center">Value Out</th>
                        <th style="border: 1px solid;font-weight: bold;width: 100px;" align="center">Ending Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 10;
                    $no = 1;
                    $bg_value = 0;
                    $value_in = 0;
                    $value_out = 0;
                    $ending_value = 0;
                    $t_bg_value = 0;
                    $t_value_in = 0;
                    $t_value_out = 0;
                    $t_ending_value = 0;
                    if (!empty($item)) {
                        foreach ($item as $result) {
                            ?>
                            <tr>
                                <td style="border: 1px solid;" align="right"><?php echo $no++; ?></td>
                                <td style="border: 1px solid;"><?php echo $result->item_code ?></td>
                                <td style="border: 1px solid;"><?php echo $result->item_description ?></td>
                                <td style="border: 1px solid;" align="center"><?php echo $this->model_item->get_small_unit($result->id) ?></td>
                                <td style="border: 1px solid;padding-right: 5px;" align="right"><?php echo round($result->last_stock,3) ?></td>
                                <td style="border: 1px solid;padding-right: 5px;" align="right"><?php echo round($result->st_in, 3); ?></td>
                                <td style="border: 1px solid;padding-right: 5px;" align="right"><?php echo round($result->st_out, 3); ?></td>
                                <td style="border: 1px solid;padding-right: 5px;" align="right"><?php echo round($result->balance, 3); ?></td>
                                <td style="border: 1px solid;padding-right: 5px;" align="right">
                                    <?php
                                    $bg_value = round($result->last_stock * $result->price_in_base_unit, 2);
                                    $t_bg_value += $bg_value;
                                    if (in_array('display_price', $accessmenu)) {
                                        echo number_format($bg_value, 2);
                                    }
                                    ?>
                                </td>
                                <td style="border: 1px solid;padding-right: 5px;" align="right">
                                    <?php
                                    $value_in = round($result->st_in * $result->price_in_base_unit, 2);
                                    $t_value_in += $value_in;
                                    if (in_array('display_price', $accessmenu)) {
                                        echo number_format($value_in, 2);
                                    }
                                    ?>
                                </td>
                                <td style="border: 1px solid;padding-right: 5px;" align="right">
                                    <?php
                                    $value_out = round($result->st_out * $result->price_in_base_unit, 2);
                                    $t_value_out += $value_out;
                                    if (in_array('display_price', $accessmenu)) {
                                        echo number_format($value_out, 2);
                                    }
                                    ?>
                                </td>
                                <td style="border: 1px solid;padding-right: 5px;" align="right">
                                    <?php
                                    $ending_value = round($result->balance * $result->price_in_base_unit, 2);
                                    $t_ending_value += $ending_value;
                                    if (in_array('display_price', $accessmenu)) {
                                        echo number_format($ending_value, 2);
                                    }
                                    ?>
                                </td>
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
                    <tr>
                        <td colspan="8" align="center"><strong>Total</strong></td>
                        <td style="border: 1px solid;" align="right">&nbsp;
                            <?php
                            if (in_array('display_price', $accessmenu)) {
                                echo number_format($t_bg_value, 2);
                            }
                            ?>
                        </td>
                        <td style="border: 1px solid;" align="right">&nbsp;
                            <?php
                            if (in_array('display_price', $accessmenu)) {
                                echo number_format($t_value_in, 2);
                            }
                            ?></td>
                        <td style="border: 1px solid;" align="right">&nbsp;<?php
                            if (in_array('display_price', $accessmenu)) {
                                echo number_format($t_value_out, 2);
                            }
                            ?>
                        </td>
                        <td style="border: 1px solid;" align="right">&nbsp;
                            <?php
                            if (in_array('display_price', $accessmenu)) {
                                echo number_format($t_ending_value, 2);
                            }
                            ?>
                        </td>
                    </tr>

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

