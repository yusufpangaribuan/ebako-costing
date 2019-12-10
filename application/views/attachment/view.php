<table>
    <tr>
        <td align="right"><span class="labelelement">Title :</span></td>
        <td><input type="text" name="title" id="title"/></td>
    </tr>
    <tr>
        <td align="right"><span class="labelelement">File :</span></td>
        <td><input type="file" name="fileupload" id="fileupload" size="30"/></td>
    </tr>    
    <tr>
        <td>&nbsp;</td>
        <td><button onclick="attachment_save(<?php echo $id . ",'" . $reference . "'" ?>)">Save</button></td>
    </tr>
</table>
<a href=""></a>
Attachment
<div id="listattachment">
    <?php
    
    if (!empty($files)) {
        $no = 1;
        foreach ($files as $result) {
            ?>
            <span class="title"><?php echo $no++ . ". " . $result->title ?></span><br/>
            Uploaded at : <?php echo $result->timeupload ?> |
            <a href="files/<?php echo $result->filename ?>" target='_blank' style="text-decoration: none;color: #ff993F">Download</a> | 
            <a href="javascript:void(0)" style="text-decoration: none;color: #ff993F" onclick="attachment_delete(<?php echo $id.",".$result->id . ",'" . $reference . "','" . $result->filename . "'" ?>)">Delete</a>
            <hr/>
            <?php
        }
    }else{
        echo "No Attachment..!";
    }
    ?>
</div>