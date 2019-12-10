<table width="100%" class="tablesorter">
    <?php
    if (!empty($finishing)) {
        $no = 1;
        foreach ($finishing as $finishing) {
            ?>                        
            <tr>
                <td width="10" align="right"><?php echo $no ?>.</td>
                <td><?php echo $finishing->description ?></td>
                <td width="10"><img src="images/delete.png" style="cursor: pointer" onclick="model_deletefinishing(<?php echo $finishing->id . "," . $finishing->modelid; ?>)"/></td>
            </tr>
            <?php
            $no++;
        }
    }
    ?>
</table>