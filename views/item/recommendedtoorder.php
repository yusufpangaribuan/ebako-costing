<div style="width: 800px;height: 500px;">
    <table class="tablesorter" width="100%">
        <thead>
            <tr>
                <th width="2%">NO</th>
                <th width="10%">Code</th>
                <th width="40%">Description</th>
                <th width="8%">Unit</th>
                <th width="20%">Reorder Point</th>
                <th width="20%">Stock</th>
            </tr>                                                            
        </thead>
        <tbody>
            <?php
            if (!empty($item)) {
                $no = 1;
                foreach ($item as $result) {
                    ?>
                    <tr>
                        <td align="right"><?php echo $no++ ?></td>
                        <td><?php echo $result->partnumber ?></td>
                        <td><?php echo nl2br($result->descriptions) ?></td>
                        <td align="center"><?php echo $result->unitcode ?></td>
                        <td align="center"><?php echo $result->reorderpoint ?></td>
                        <td align="center"><?php echo $result->totalstock ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>