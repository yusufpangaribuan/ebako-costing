<table width="100%" class="tablesorter">
    <?php
    if (!empty($latherinlay)) {
        $no = 1;
        foreach ($latherinlay as $latherinlay) {
            ?>                        
            <tr>
                <td width="10" align="right"><?php echo $no ?>.</td>
                <td><?php echo $latherinlay->description ?></td>
                <td width="10"><img src="images/delete.png" style="cursor: pointer" onclick="model_deletelatherinlay(<?php echo $latherinlay->id . "," . $latherinlay->modelid; ?>)"/></td>
            </tr>
            <?php
            $no++;
        }
    }
    ?>
</table>