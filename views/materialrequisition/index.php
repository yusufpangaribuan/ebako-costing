<h4>Material Requisition</h4>
<div  style="width: 100%;padding: 1px;">
    <form id="mat_req_search_form" onsubmit="return false">
        <span class="labelelement">Search :</span>
        <input type="text" 
               id="number" 
               name="number" 
               size="8" 
               placeholder="MR NO"
               onkeypress="if (event.keyCode === 13) {
                           materialrequisition_search(0);
                       }"
               />
        <span class="labelelement">
            <input type="text" name="start_date"  
                   id="mat_req_start_date_s" size="8" 
                   onchange="materialrequisition_search(0)"
                   placeholder='Start date'/>
            <script type="text/javascript" >
                $(function () {
                    $("#mat_req_start_date_s").datepicker({
                        dateFormat: "yy-mm-dd"
                    }).focus(function () {
                        $("#mat_req_start_date_s").datepicker("show");
                    });
                });
            </script>
            <input type="text" name="end_date" 
                   id="mat_req_end_date_s" size="8" 
                   placeholder="End Date"
                   onchange="materialrequisition_search(0)"/>
            <script type="text/javascript" >
                $(function () {
                    $("#mat_req_end_date_s").datepicker({
                        dateFormat: "yy-mm-dd"
                    }).focus(function () {
                        $("#mat_req_end_date_s").datepicker("show");
                    });
                });
            </script>
        </span>
        <span class="labelelement">
            <select id="departmentid_s" 
                    name="departmentid" 
                    style="width: 150px;font-style: italic;" 
                    onchange="materialrequisition_search(0)"
                    >
                <option value="0" class="i26">Department</option>
                <?php
                foreach ($department as $result) {
                    echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                }
                ?>
            </select>
        </span>
        <span class="labelelement">
            <input type="text" 
                   name="item_code_description"
                   placeholder="Item Code / Item Description" 
                   size="12" 
                   style="width: 150px"
                   onkeypress="if (event.keyCode === 13) {
                               materialrequisition_search(0);
                           }"/>
        </span>
        <span class="labelelement">
            <input type="text" 
                   name="approval1"  
                   placeholder="Approval 1"
                   style="width: 80px"
                   onkeyup="if (event.keyCode === 13) {
                               materialrequisition_search(0);
                           }"
                   />
        </span>
        <span class="labelelement">
            <input type="text" 
                   name="approval2"  
                   placeholder="Approval 2"
                   style="width: 80px"
                   onkeyup="if (event.keyCode === 13) {
                               materialrequisition_search(0);
                           }"
                   />
        </span>
        <select name="status" onchange="materialrequisition_search(0)" 
                style="width: 100px;font-style: italic;">
            <option value="0">Status</option>
            <option value="-1">Outstanding Approve</option>
            <option value="1">Approve</option>
            <option value="2">Pending</option>
            <option value="3">Reject</option>
            <option value="4">Outstanding Create PR</option>
        </select>
        <button onclick="materialrequisition_search(0)">Search</button>
        <button onclick="materialrequisition_print()">Print</button>
        <?php
        //if (in_array('add', $accessmenu)) {
        echo "<button type='button' onclick='materialrequisition_add()'>Create</button>";
        //}
        ?>
    </form>
</div>
<div id="mat_req_n_data" style="width: 100%;padding: 1px;">
    <?php $materialrequisition->search(0); ?>
</div>
<div id="mat_req_n" style="display: none"></div>
<div id="mat_req_dialog" style="display: none"></div>