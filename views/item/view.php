<h4>Item</h4>
<div style="padding: 2px 1px 2px 1px;width: 100%">
    <span class="labelelement">Search:</span>
    <input type="text" id="code_s" placeholder="Code / Description" name="code_s" size="15" onkeypress="if (event.keyCode == 13) {
                item_search(0)
            }"/>          
    <select id="group_s" onchange="item_search(0)" style="width: 100px">
        <option value="0">--Group--</option>
        <?php
        foreach ($itemgroup as $itemgroup) {
            echo "<option value='" . $itemgroup->id . "'>" . $itemgroup->codes . " - " . $itemgroup->names . "</option>";
        }
        ?>
    </select>
    <select id="isstock_s" onchange="item_search(0)" style="width: 100px">
        <option value="">--Class--</option>
        <option value="false">NON STOCK</option>
        <option value="true">STOCK</option>                            
    </select>
    <input type="text" id="rack_s" name="rack_s" placeholder="Rack" size="10" onkeypress="if (event.keyCode == 13) {
                item_search(0)
            }"/>
    <button onclick="item_search(0)">Search</button>
    <?php
    if (in_array('add', $accessmenu)) {
        echo "<button onclick = item_add()>Add</button>";
    }
    ?>
</div>
<div id="itemdata" style="width: 100%;margin: 1px">
<?php echo $this->load->view('item/search'); ?>
</div>