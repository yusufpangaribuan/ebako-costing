<h4>Service Request</h4>
<div style="width: 100%;margin-left: 3px">
    <div align="left" style="margin-top: 5px;margin-bottom: 5px;">
        <form id="servicerequest_search_form">
            <span class="labelelement">Search :</span>
            <input type="text" size="10" name="number" placeholder="SR NO" onkeypress="if (event.keyCode === 13) {
                        servicerequest_search(0);
                    }"/>
            <script type="text/javascript" >
                $(function () {
                    $("#sr_start_date").datepicker({
                        dateFormat: "yy-mm-dd"
                    }).focus(function () {
                        $("#date_from_s").datepicker("show");
                    });
                    $("#sr_end_date").datepicker({
                        dateFormat: "yy-mm-dd"
                    }).focus(function () {
                        $("#date_to_s").datepicker("show");
                    });
                });
            </script>
            <input type="text" size="10" id="sr_start_date" placeholder="Start Date" name="start_date" readonly="" />
            <input type="text" size="10" id="sr_end_date" placeholder="End Date"name="stop_date" readonly="" />
            <span class="labelelement">
                <select id="departmentid_s" 
                        name="departmentid" 
                        style="width: 150px;font-style: italic;" 
                        onchange="servicerequest_search(0)"
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
                                   servicerequest_search(0);
                               }"/>
            </span>
            <span class="labelelement">
                <input type="text" 
                       name="approval1"  
                       placeholder="Approval 1"
                       style="width: 80px"
                       onkeyup="if (event.keyCode === 13) {
                                   servicerequest_search(0);
                               }"
                       />
            </span>
            <span class="labelelement">
                <input type="text" 
                       name="approval2"  
                       placeholder="Approval 2"
                       style="width: 80px"
                       onkeyup="if (event.keyCode === 13) {
                                   servicerequest_search(0);
                               }"
                       />
            </span>
            <select name="status" onchange="servicerequest_search(0)" 
                    style="width: 100px;font-style: italic;">
                <option value="0">Status</option>
                <option value="-1">Outstanding Approve</option>
                <option value="1">Approve</option>
                <option value="2">Pending</option>
                <option value="3">Reject</option>
                <option value="4">Outstanding Create PR</option>
            </select>
            <button type="button" onclick="servicerequest_search(0)">Search</button>
            <?php
            //print_r($accessmenu);
            //if (in_array('add', $accessmenu)) {
            ?>
            <button type="button" onclick = 'servicerequest_add()'>Add</button>
            <?php
            //}
            ?>
        </form>

    </div>     
    <div id="servicerequestdata" style="width: 100%;">
        <?php $servicerequest->search(0) ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url("js/servicerequest.js") ?>"></script>
