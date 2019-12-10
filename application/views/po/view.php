<h4>Purchase Order</h4>
<div  style="width: 100%;padding: 2px 1px 2px 1px;">
    <form id="po_search_form" onsubmit="return false">
        <span class="labelelement">Search :</span>
        <input type="text" 
               id="ponumber" 
               name='ponumber'
               size="10" 
               placeholder="PO NUMBER"
               onkeypress="if (event.keyCode === 13) {
                           po_search(0);
                       }"/>

        <input type="text" 
               id="prnumber" 
               name='prnumber'
               placeholder="PR NUMBER"
               size="10" onkeypress="if (event.keyCode == 13) {
                           po_search(0)
                       }"/>
        <script type="text/javascript" >
            $(function () {
                $("#date_start").datepicker({
                    dateFormat: "yy-mm-dd"
                }).focus(function () {
                    $("#date_start").datepicker("show");
                });
                $("#date_end").datepicker({
                    dateFormat: "yy-mm-dd"
                }).focus(function () {
                    $("#date_end").datepicker("show");
                });
            });
        </script>
        <span class="labelelement">
            <input type="text" name="date_start" id="date_start" size="8" placeholder="Start Date"/>
            -
            <input type="text" name="date_end" id="date_end" size="8" placeholder="End Date"/>
        </span>
        <select id="departmentid" name="departmentid" style="width: 100px;font-style: italic;" onchange="po_search(0)">
            <option value="0">Department</option>
            <?php
            foreach ($department as $department) {
                echo "<option value='" . $department->id . "'>" . $department->name . "</option>";
            }
            ?>
        </select>  
        <span class="labelelement">
            <input type="text" 
                   name="item_code_description"
                   placeholder="Item Code / Item Description" 
                   size="12" 
                   style="width: 150px"
                   onkeypress="if (event.keyCode === 13) {
                               po_search(0);
                           }"/>
        </span>
        <span class="labelelement">
            <select id="vendorid" name="vendorid" style="width: 100px;font-style: italic;" onchange="po_search(0)">
                <option value="0">Vendor</option>
                <?php
                foreach ($vendor as $vendor) {
                    echo "<option value='$vendor->id'>" . $vendor->name . "</option>";
                }
                ?>
            </select>
        </span>
        <select id="status" name="status" style="width: 100px;font-style: italic;" onchange="po_search(0)">
            <option value="">Status</option>
            <option value="0">Open</option>
            <option value="1">Finish</option>
            <option value="2">Close</option>
        </select>
        <button type="button" onclick="po_search(0)">Search</button>
        <?php
        if ($this->session->userdata('department') == 8) {
            if (in_array('configure_approval', $accessmenu)) {
                echo "<button type='button' onclick='po_configure_close_approval()'>Configure Approval</button>";
            }
        }
        ?>
        <button onclick="po_report()" type="button">Report</button>
    </form>
</div>
<div id="podata" style="width: 100%;padding: 1px;">
    <?php $po->search(0) ?>
</div>