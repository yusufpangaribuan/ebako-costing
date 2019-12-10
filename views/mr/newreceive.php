<div style="width: 500px; min-height: 100px;">
    <?php
    foreach ($stockout as $result) {
        ?>
        <table width="100%" class="tablesorter">
            <thead>
                <tr>
                    <th rowspan="2" style="text-align: left;">&nbsp;NO : <?php echo $result->number ?></th>
                </tr>
            </thead>
            <tbody>
                <tr style="border: none;">
                    <td style="border: none;">
                        <table width="100%" class="tablesorter">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th width="30%">Code</th>
                                    <th width="40%">Description</th>
                                    <th width="10%">Unit</th>
                                    <th width="10%">Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $stockoutdetail = $this->model_stockoutdetail->selectByStockoutId($result->id);
                                foreach ($stockoutdetail as $result2) {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $no++ ?></td>
                                        <td align="center"><?php echo $result2->code ?></td>
                                        <td><?php echo $result2->descriptions ?></td>                        
                                        <td align="center"><?php echo $result2->unitcode ?></td>                                   
                                        <td align="center"><?php echo $result2->qty ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr style="border: none">
                                    <td colspan="5" style="border: none" align="right"><button onclick="stockout_receive(<?php echo $mrid . "," . $result->id ?>)">Receive</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php
    }
    ?>    
</div>