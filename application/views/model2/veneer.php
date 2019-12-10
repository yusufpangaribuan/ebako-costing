<table width="100%" class="tablesorter">
    <?php
    if (!empty($veneer)) {
        $no = 1;
        foreach ($veneer as $veneer) {
            ?>                        
            <tr>
                <td width="10" align="right"><?php echo $no ?>.</td>
                <td><?php echo $veneer->description ?></td>
                <td width="10"><img src="images/delete.png" style="cursor: pointer" onclick="model_deleteveneer(<?php echo $veneer->id . "," . $veneer->modelid; ?>)"/></td>
            </tr>
            <?php
            $no++;
        }
    }
    ?>
</table>