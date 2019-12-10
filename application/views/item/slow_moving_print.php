<html>
    <head>
        <title>Slow Moving Item</title>        
        <STYLE>
            <!-- 
            BODY,table{ font-family:"Arial"; font-size:10px; }
            table
            {
                border-collapse:collapse;
            }
            table, td, th
            {
                border:1px solid black;
                padding: 2px;
            }
            -->
        </STYLE>
    </style>
</head>
<body>
    <h3>Item Slow Moving / Immovable</h3>
    <table width="100%">
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
            $no = 1;
            foreach ($item_list as $result) {
                $allunit = $this->model_item->selectAllUnit2($result->id);
                ?>
                <tr>
                    <td align="right"><?php echo $no++; ?></td>
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
            ?>
        </tbody>
    </table>
</body>
</html>