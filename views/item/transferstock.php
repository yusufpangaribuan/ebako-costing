<div style="width: 400px">
    <?php
    $counter = 0;
    foreach ($unit as $unit) {
        if ($unit->stock > 0) {
            ?>
            <input type="hidden" name="unitid[]" value="<?php echo $unit->unitfrom ?>"/> 
            Stock : <input type="text" id="itemid<?php echo $unit->id ?>" size="6" value="<?php echo $unit->stock ?>" style="text-align: center;" readonly="">
            Qty Transfer : <input type="text" size="6" name="qty[]" value="0" onchange="if(isNaN($(this).val()) || $(this).val() == ''){alert('Required Number');$(this).val(0)}if(parseFloat($(this).val()) > parseFloat($('#itemid<?php echo $unit->id ?>').val())){alert('Out of Stock');$(this).val(0)}" style="text-align: center;">&nbsp;<?php echo $unit->codes ?>
            <br/>
            <?php
            $counter++;
        }
    }
    if ($counter > 0) {
        if (!empty($whs)) {
            ?>
            <input type="hidden" id="itemid" value="<?php echo $itemid ?>" />
            <label class="labelelement">Transfer To :</label><br/> 
            <select id="warehouseid">
                <?php
                foreach ($whs as $result) {
                    echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                }
                ?>
            </select><br/><br/>
            <button style="font-size: 11px" onclick="item_dotransfer()">Ok</button>
            <?php
        } else {
            echo "<br/>No Warehouse Receiver";
        }
    } else {
        echo "No stock to transfer";
    }
    ?>
</div>
