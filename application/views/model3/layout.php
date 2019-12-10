<div style="width: 600px;max-height: 600px;">
    <label>Image : </label>
    <input type="file" size="30" id="fileupload" name="fileupload" style="width: 100px"/>
    <?php
    if (in_array('upload_layout', $accessmenu)) {
        ?>
        <button style="font-size: 11px;" onclick="model_uploadlayout()">Upload</button>
        <?php
    }
    ?>

    <br/><br/>
    <table class="tablesorter" width="100%">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th width="80%">Image</th>
                <th width="10%">Action</th>
            </tr>        
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($layout as $result) {
                ?>
                <tr>
                    <td align="right"><?php echo $no++ ?></td>
                    <td align="center"><img src="files/<?php echo $result->filename ?>" style="max-width: 100px;max-height: 100px"/></td>
                    <td align="center">
                        <img src="images/delete.png" class="miniaction" onclick="model_deletelayout(<?php echo $result->id . ",'" . $result->filename . "'" ?>)"/>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>