<table width="100%" class="tablesorter">
    <?php
    if (!empty($marble)) {
        $no = 1;
        foreach ($marble as $marble) {
            ?>                        
            <tr>
                <td width="10" align="right"><?php echo $no ?>.</td>
                <td><?php echo $marble->description ?></td>
                <td width="10"><img src="images/delete.png" style="cursor: pointer" onclick="model_deletemarble(<?php echo $marble->id . "," . $marble->modelid; ?>)"/></td>
            </tr>
            <?php
            $no++;
        }
    }
    ?>
</table>