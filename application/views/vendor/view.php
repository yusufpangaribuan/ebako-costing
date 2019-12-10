<h4>Vendor</h4>
<center>
    <div style="width: 99.5%;">
        <div align="left" style="margin-bottom: 5px;margin-top: 5px;">                
            <span class="labelelement">Name :</span><input type="text" id="name_s" name="name_s" onkeypress="if (event.keyCode == 13) {
                        vendor_search(0)
                    }"/>               
            <button onclick="vendor_search(0)">Search</button>
            <button onclick="vendor_print()">Print</button>
            <?php
            if (in_array('add', $accessmenu)) {
                echo "<button onclick = 'vendor_add()'>Add</button>";
            }
            ?>
        </div>
        <div id="vendordata">
            <?php $vendor->search(0) ?>
        </div>
    </div>
</center>


