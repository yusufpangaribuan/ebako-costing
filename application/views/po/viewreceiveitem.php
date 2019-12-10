<div style="width: 500px">
    <table class="tablesorter" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Code</th>
                <th>Description</th>
                <th>Request</th>
                <th>Outstanding</th>
                <th>Receive</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($item as $result) {
                ?>
                <tr>
                    <td align="right"><?php echo $no++; ?></td>
                    <td align="left"><?php echo $result->itempartnumber; ?></td>
                    <td><?php echo nl2br($result->itemdescription); ?></td>
                    <td align="center"><?php echo $result->qty; ?></td>
                    <td align="center"><?php echo $result->outstanding; ?></td>
                    <td align="center"><?php echo $result->qtyreceive == '' ? 0 : $result->qtyreceive; ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>