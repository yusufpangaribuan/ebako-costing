<table width="500" class="tablesorter">
    <thead>
        <tr>
            <th>No</th>
            <th>RFQ No.</th>
            <th>Quotation No.</th>
            <th>Date</th>
            <th>Customer</th>        
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($rfq as $result) {
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $result->number ?></td>
                <td><?php echo $result->quotationnumber ?></td>
                <td><?php echo date('d/m/y', strtotime($result->date)) ?></td>
                <td><?php echo $result->customer ?></td> 
                <td align="center"><img src="images/check.png" class="miniaction" onclick="so_setquotation(<?php echo $result->id ?>)"/></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>