<table width="100%" class="tablesorter">
    <?php
    if (!empty($wood)) {
        $no = 1;
        foreach ($wood as $wood) {
            ?>                        
            <tr>
                <td width="10" align="right"><?php echo $no ?>.</td>
                <td><?php echo $wood->description ?></td>
                <td width="10"><img src="images/delete.png" style="cursor: pointer" onclick="model_deletewood(<?php echo $wood->id . "," . $wood->modelid; ?>)"/></td>
            </tr>
            <?php
            $no++;
        }
    }
    ?>
</table>