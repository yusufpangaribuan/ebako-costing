<div style="width: 400px;max-height: 400px;">
    <label>Title : </label>
    <input type="text" size="15" id="title_upload" name="title" />&nbsp;
    <label>File : </label>
    <input type="file" size="10" id="fileupload" name="fileupload" style="width: 80px" id="fileupload"/>
    <input type="hidden" id="rfqdetailid_upload" value="<?php echo $rfqdetailid ?>"/>
    <input type="hidden" id="rfqid_upload" value="<?php echo $rfqid ?>" />    
    <button style="font-size: 11px;" onclick="rfq_upload_detail_attachment()">Upload</button>
    <br/><br/>
    <table class="tablesorter" width="100%">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th width="80%">Title</th>
                <th width="10%">Action</th>
            </tr>        
        </thead>
        <tbody>
            <?php
            $no = 1;

            foreach ($rfqitemattachment as $result) {
                ?>
                <tr>
                    <td align="right"><?php echo $no++ ?></td>
                    <td align="left">
                        <a href="<?php echo base_url() . 'files/' . $result->filename ?>" target="blank" style="color: blue;">
                            <?php echo $result->title ?>
                        </a>
                    </td>
                    <td align="center">
                        <img src="images/delete.png" class="miniaction" title="Delete" onclick="rfq_delete_detail_attachment(<?php echo $result->id . "," . $result->rfqdetailid . "," . $rfqid . ",'" . $result->filename . "'" ?>)"/>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>