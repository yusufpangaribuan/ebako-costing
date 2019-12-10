<h4>Item Request</h4>
<div style="width: 100%;margin-left: 3px">
    <div align="left" style="margin-top: 5px;margin-bottom: 5px;">
        <span class="labelelement">Group :</span>
        <select id="groupid_s" style="width: 80px">
            <option value="0"></option>
            <?php
            foreach ($group as $result) {
                echo "<option value='" . $result->id . "'>" . $result->codes . "</>";
            }
            ?>
        </select>        
        <span class="labelelement">Description :</span>
        <input type="text" size="10" id="description_s" name="description" onkeypress="if (event.keyCode == 13) {
                    itemrequest_search(0)
                }" />
        <span class="labelelement">Unit :</span>
        <select id="unitid_s" style="width: 80px">
            <option value="0"></option>
            <?php
            foreach ($unit as $result) {
                echo "<option value='" . $result->id . "'>" . $result->codes . "</>";
            }
            ?>
        </select>
        <button onclick="itemrequest_search(0)">Search</button>
        <button onclick="itemrequest_print()">Print</button>
        <?php
        if (in_array('add', $accessmenu)) {
            echo "<button onclick = 'itemrequest_add()'>Add</button>";
        }
        ?>
    </div>     
    <div id="itemrequestdata" style="width: 100%;">
        <?php $this->load->view('itemrequest/search') ?>
    </div>
</div>
