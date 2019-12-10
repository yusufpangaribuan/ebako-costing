<div style="width: 300px">
    <div id="qvform">
        <table width="50%">
            <tr>
                <td><label class="labelelement">DESCRIPTION</label></td>
                <td>
                    <input type="hidden" id="flag" value="<?php echo $flag ?>" />
                    <input type="text" id="qv_desc"/>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><button onclick="so_save_loadability()">SAVE</button></td>
            </tr>
        </table>
    </div>
    <br/>
    <table class="tablesorter" width="99%">
        <thead>
            <tr>
                <th>NO</th>
                <th>description</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($qv as $result) {
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $result->description ?></td>
                    <td align="center">
                        <img src="images/edit.png" class="miniaction" onclick="so_editloadability(<?php echo $result->id . "," . $flag ?>)"/>
                        <img src="images/delete.png" class="miniaction" onclick="so_deleteloadability(<?php echo $result->id . "," . $flag ?>)"/>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
