<div class="panel" style="min-height: 150px;">
    <h4>Purchasing Group</h4>    
    <table class="tablesorter" width="99%" style="margin: 4px;" align="center">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Allow Request for group Item</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($purchasing as $result) {
                ?>
                <tr>
                    <td align="right"><?php echo $no++ ?></td>
                    <td><?php echo $result->name ?></td>
                    <td>
                        <?php
                        $strarray = str_replace(array("{", "}"), "", $result->itemgroup);
                        $arritemgroup = explode(',', $strarray);
                        foreach ($itemgroup as $result2) {
                            if (in_array($result2->id, $arritemgroup)) {
                                echo "&nbsp;" . $result2->names . ", ";
                            }
                        }
                        ?>                    
                    </td>
                    <td align="center">
                        <img src="images/edit.png" class="miniaction" onclick="setup_editpurchasinggroup(<?php echo $result->id ?>)"/>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>