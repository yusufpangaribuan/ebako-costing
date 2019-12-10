<div style="width: 300px;height: 100px;">
    <?php
    //print_r($warehouse_available);
    $disabled = "";
    if (count($warehouse_available) == 1) {
        $disabled = "disabled";
    }
    foreach ($all_warehouse as $result) {
        if (in_array($result->id, $warehouse_available)) {
            echo "<input type='checkbox' value='" . $result->id . "' checked='true' onclick='item_warehouse_action(this," . $itemid . ")' $disabled/> " . $result->name . "<br/>";
        } else {
            echo "<input type='checkbox' value='" . $result->id . "' onclick='item_warehouse_action(this," . $itemid . ")'/> " . $result->name . "<br/>";
        }
    }
    ?>
    Click Check Box to Set or Unset Item to / from Warehouse<br/>
    <?php
//    if (!empty($whs)) {
        ?>
<!--        <label class="labelelement">Shared To :</label><br/>
        <input type="hidden" id="itemid" value="<?php echo $itemid ?>" />
        <?php
        foreach ($whs as $result) {
            echo "<input type='checkbox' value='" . $result->id . "' name='whs[]'> " . $result->name . "<br/>";
        }
        ?>
        <br/>
        <button style="font-size: 11px;" onclick="item_doshare()">Ok</button>-->
        <?php //
   // } else {
//        echo "This item available in all warehouse";
   // }
    ?>
</div>