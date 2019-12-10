<div style="width: 500px">
    <?php
    if (in_array('add_review_notes', $accessmenu)) {
        ?>
        <button style="font-size: 11px;" onclick="model_addreviewnotesandhistory()">Add</button>
        <?php
    }
    ?>

    <table width="100%" class="tablesorter">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Date</th>
                <th width="20%">Reviewed By</th>
                <th width="50%">Notes</th>
                <th width="20%">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($reviewnotes as $result) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td align="center"><?php echo $result->date; ?></td>
                    <td align=center><?php echo $result->reviewedby; ?></td>
                    <td><?php echo nl2br($result->notes); ?></td>
                    <td align="center">
                        <img src="images/edit.png" class="miniaction" onclick="model_editreviewnotesandhistory(<?php echo $result->id ?>)"/>
                        <img src="images/delete.png" class="miniaction" onclick="model_deletereviewnotesandhistory(<?php echo $result->id ?>)"/>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

