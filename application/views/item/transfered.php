<div style="width: 400px">        
    <?php
    foreach ($transfer as $result) {
        ?>
        <table width="100%" border="0" class="tablesorter">
            <?php
            echo "<tr>";
            echo "<td width='30%'>Code </td><td width='70%'>" . $result->partnumber . "</td>";
            echo "<tr/>";
            echo "<tr>";
            echo "<td>Description</td><td>" . $result->descriptions . "</td>";
            echo "<tr/>";
            echo "<tr>";
            echo "<td>To </td><td>" . $result->warehousename . "</td>";
            echo "<tr/>";
            echo "<tr>";
            echo "<td colspan=2>List :</td>";
            echo "<tr/>";
            $transfer_item_detail = $this->model_item->selectTransferItemDetail($result->id);
            ?>
            <tr>
                <td colspan="2">
                    <table class="tablesorter" width="100%">
                        <thead>
                            <tr>
                                <th>Unit</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <?php
                        foreach ($transfer_item_detail as $result2) {
                            ?>
                            <tr>
                                <td align="center"><?php echo $result2->codes ?></td>
                                <td align="center"><?php echo $result2->qty ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </td>
            </tr>
        </table>
        <?php
    }
    ?>
</table>
</div>