<style>
    html { 
        margin:20px;
    }    
</style>
<div>
    <span style="font-size: 16px;font-weight: bold;">Price Comparison List</span><br/>
    <span style="font-size: 14px;font-weight: bold;">PR No : <?php echo $pr->requestnumber ?></span>
</div>
<table border='0' width='550' style="font-size: 8pt;">
    <thead>
        <tr>
            <th width="2%" style="border-bottom: 1px black solid;">No</th>
            <th width="28%" style="border-bottom: 1px black solid;" align="left">Item</th>
            <th width="70%" style="border-bottom: 1px black solid;">Supplier</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($pritem)) {
            $counter = 1;
            foreach ($pritem as $pritem) {
                ?>
                <tr valign='top' >
                    <td align="right" width="2%" style="border-bottom: 1px black solid;color: black"><?php echo $counter++; ?></td>
                    <td align="left" width="28%" style="border-bottom: 1px black solid;color: black">
                        <?php
                        echo "CODE: " . $pritem->itempartnumber . "<br/>";
                        echo "DESC: " . nl2br($pritem->itemdescription) . "<br/>";
                        echo "<b>Qty : " . $pritem->qty . "</b><br/><br/>";
                        echo "LAST PO : " . $this->model_item->getLastPoPurchase($pritem->itemid) . "<br/>";
                        echo "DATE : " . $this->model_item->getLastDatePurchase($pritem->itemid) . "<br/>";
                        echo "Price : " . number_format($this->model_item->getLastPricePurchase($pritem->itemid), 2, '.', ',') . " ";
                        echo $this->model_item->getLastCurrencyPurchase($pritem->itemid);
                        ?>
                    </td>  
                    <td style="border-bottom: 1px black solid;color: black" width="70%">
                        <table border="0" width="100%" style="font-size: 8pt;">
                            <tr>
                                <?php
                                $pritemvendor = $this->model_pricecomp->selectAllVendorByPrItemId($pritem->id);
                                foreach ($pritemvendor as $result) {
                                    $bgcolor = "";
                                    if ($result->used == 1) {
                                        $bgcolor = "bgcolor='#d7d7d7'";
                                    }
                                    ?>
                                    <td align=left width="100" <?php echo $bgcolor ?> style="color: black">
                                        <?php
                                        echo $result->vendornumber . "<br/>";
                                        echo $result->name . "<br/>";
                                        echo $result->currency . " " . number_format($result->price, 2, '.', ',') . "<br/>";
                                        echo "Total : " . number_format(($result->price * $pritem->qty), 2, '.', ',');
                                        ?>
                                    </td>
                                <?php }
                                ?>
                            </tr>
                        </table>
                    </td>                    
                </tr>                
                <?php
            }
        }
        ?>
        <tr>
            <td style="border-bottom: 1px black solid;color: black;font-weight: bold;" colspan="2">
                TOTAL
            </td>
            <td style="border-bottom: 1px black solid;color: black;font-weight: bold;">
                <?php
                if (!empty($pricetotal)) {
                    echo "<table>";
                    foreach ($pricetotal as $result) {
                        echo "<tr>";
                        echo "<td style='color:black;font-weight:bold' align=right>" . number_format($result->totalprice, 2, '.', ',') . "</td><td style='color:black;font-weight:bold'>" . $result->currency . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0";
                }
                ?>
            </td>
        </tr>
    </tbody>
</table>