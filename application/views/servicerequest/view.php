<h4>Service Request</h4>
<div style="width: 100%;margin-left: 3px">
    <div align="left" style="margin-top: 5px;margin-bottom: 5px;">
        <span class="labelelement">SR NO :</span>
        <input type="text" size="10" id="srno_s" name="srno_s" onkeypress="if(event.keyCode==13){servicerequest_search(0)}"/>
        <script type="text/javascript" >
            $(function() {
                $("#date_from_s").datepicker({
                    dateFormat: "yy-mm-dd"
                }).focus(function() {
                    $("#date_from_s").datepicker("show");
                });
                $("#date_to_s").datepicker({
                    dateFormat: "yy-mm-dd"
                }).focus(function() {
                    $("#date_to_s").datepicker("show");
                });
                $("#due_date_s").datepicker({
                    dateFormat: "yy-mm-dd"
                }).focus(function() {
                    $("#due_date_s").datepicker("show");
                });
            });
        </script>
        <span class="labelelement">Date From :</span>
        <input type="text" size="10" id="date_from_s" name="date_from_s" readonly="" />
        <span class="labelelement">To :</span>
        <input type="text" size="10" id="date_to_s" name="date_to_s" readonly="" />
        <span class="labelelement">Due Date :</span>
        <input type="text" size="10" id="due_date_s" name="due_date_s" readonly="" />
        <span class="labelelement">Vendor :</span>
        <select id="vendorid_s" style="width: 120px">
            <option value="0"></option>
            <?php
            foreach ($vendor as $result) {
                echo "<option value='" . $result->id . "'>[" . $result->vendornumber . "]" . $result->name . "</option>";
            }
            ?>
        </select>
        <button onclick="servicerequest_search(0)">Search</button>
        <button onclick="servicerequest_print()">Print</button>
        <?php
        //print_r($accessmenu);
        if (in_array('add', $accessmenu)) {
            echo "<button onclick = 'servicerequest_add()'>Add</button>";
        }
        ?>
    </div>     
    <div id="servicerequestdata" style="width: 100%;">
        <?php $this->load->view('servicerequest/search') ?>
    </div>
</div>
