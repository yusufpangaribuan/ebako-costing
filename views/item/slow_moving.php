<h4>Item Slow Moving / Immovable</h4>
<div align="left" style="margin: 1px" >
    <form id="item_slowmoving_search_form" onsubmit="return false">
        <span class="labelelement">
            <select name="groupid" onchange="item_slowmoving_search(0)" style="width: 100px">
                <option value="0">--Group--</option>
                <?php
                foreach ($itemgroup as $itemgroup) {
                    echo "<option value='" . $itemgroup->id . "'>" . $itemgroup->codes . " - " . $itemgroup->names . "</option>";
                }
                ?>
            </select>
        </span>
        <span class="labelelement">
            <input type="text" size="15" placeholder="Item Code / Description" name="item_code_description" onkeypress="if (event.keyCode === 13) {
                        item_slowmoving_search(0);
                    }"/>
        </span>
        <span class="labelelement">
            <select name="options" onchange="item_slowmoving_search(0)" style="width: 100px">
                <option value="0">Slow Moving</option>
                <option value="1">Immovable</option>
            </select>
            <button onclick="item_slowmoving_search(0)" type="button">Find</button>
            <button onclick="item_slowmoving_print()">Print</button>
            <button onclick="item_slowmoving_excel()">Excel</button>
        </span>
    </form>
</div>
<div id="item_slowmoving_data" style="margin: 1px;">
    <?php $item->slowmoving_search(0); ?>
</div>



