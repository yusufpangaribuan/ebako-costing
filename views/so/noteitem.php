<div style="width:350px">
    <?php
    if ($this->session->userdata('department') == 1) {
        ?>
        <input type="hidden" id="notesid" name="notesid" value="0" />
        <input type="hidden" id="soid" name="soid" value="<?php echo $soid ?>" />
        <input type="hidden" id="modelid" name="modelid" value="<?php echo $modelid ?>" />
        <textarea style="width: 100%" id="notes"></textarea> 
        <button style="font-size: 10px;" onclick="so_save_noteitem()">SAVE</button>
        <button style="font-size: 10px;" onclick="so_note_so_item(<?php echo $soid . "," . $modelid ?>)">RESET</button>
        <br/>
        <?php
    }
    ?>
    <br/>    
    <?php
    foreach ($notes as $result) {
        ?>        
        <input type="hidden" value="<?php echo $result->notes ?>" id="notesid<?php echo $result->id ?>"/>
        <p>
            <?php
            echo $result->notes . "<br/><br/>";
            ?>
        </p>
            <?php
        if ($this->session->userdata('department') == 1) {
                ?>
            <a href="javascript:void(0)" onclick="so_edit_noteitem(<?php echo $result->id ?>)" style="text-decoration: none;">Edit</a>&nbsp;|
            <a href="javascript:void(0)" onclick="so_delete_noteitem(<?php echo $result->id . "," . $soid . "," . $modelid ?>)" style="text-decoration: none;"  >Delete</a>
            <?php } ?>
        <br/><br/>
        <?php
    }
    ?>
</div>
