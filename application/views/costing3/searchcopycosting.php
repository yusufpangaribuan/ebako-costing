<?php
$no = 1;
foreach ($costing as $result) {
    if ($result->id != $id) {
        ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $result->code ?></td>
            <td><?php echo $result->custcode ?></td>
            <td><?php echo $result->description ?></td>
            <td><?php echo $result->customername ?></td>
            <td><?php echo date('d/m/Y', strtotime($result->date)); ?></td>                        
            <td align="center"><img src="files/<?php echo $result->filename ?>" style="max-height: 70px;max-widtd: 70px"/></td>                        
            <td align="center"><img src="images/check.png" style="cursor: pointer" onclick="costing_docopy(<?php echo $id . "," . $result->id ?>)"/></td>
        </tr>
        <?php
    }
}
?>