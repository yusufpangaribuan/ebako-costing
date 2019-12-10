<?php
foreach ($unit as $unit) {
    ?>
    <input type="hidden" name="id[]" value="<?php echo $unit->id ?>"/> 
    <input type="text" name="qty[]" size="6" value="<?php echo $unit->stock ?>" style="text-align: center;">&nbsp;&nbsp;&nbsp;<span class="labelelement"><?php echo $unit->codes ?></span><br/>
    <?php
}
?>
<br/>
<button onclick="item_savefirststock()" style="font-size: 11px;">SAVE</button>