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
} else {
    echo "No Attachment..!";
}
?>