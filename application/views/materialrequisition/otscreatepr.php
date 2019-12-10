<h4>Outstanding Create P.R</h4>
<div style="width: 100%;">
    <center>
        <div align="left" style="margin-bottom: 5px;margin-top: 5px;">
            <form id="mat_req_ots_search_form" onsubmit="return false">
                <span class="labelelement">Search :
                    <input type="tex" 
                           name="item_code_description"  
                           placeholder="Item Code / Description"
                           style="width: 150px"
                           onkeyup="if (event.keyCode === 13) {
                                       mat_req_ots_search(0)
                                   }"
                           />
                </span>
                <span class="labelelement">
                    <input type="text" id="number" 
                           name="number" 
                           size="8" 
                           placeholder="MR NO"
                           onkeypress="if (event.keyCode === 13) {
                                       mat_req_ots_search(0);
                                   }"/>
                </span>
                <span class="labelelement">
                    <input type="text" name="start_date" 
                           placeholder="Date From"
                           id="mat_req_start_date_s" size="8" onchange="mat_req_ots_search(0)"/>
                    <script type="text/javascript" >
                        $(function () {
                            $("#mat_req_start_date_s").datepicker({
                                dateFormat: "yy-mm-dd"
                            }).focus(function () {
                                $("#mat_req_start_date_s").datepicker("show");
                            });
                        });
                    </script>
                    -
                    <input type="text" name="end_date" 
                           placeholder="Date To"
                           id="mat_req_end_date_s" size="8" onchange="mat_req_ots_search(0)"/>
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
                    <select name="departmentid" 
                            style="width: 100px" 
                            onchange="mat_req_ots_search(0)">
                        <option value="0">Department</option>
                        <?php
                        foreach ($department as $result) {
                            echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                        }
                        ?>
                    </select>
                </span>
                <span class="labelelement">
                    <input type="text" 
                           name="approval1"  
                           placeholder="Approval 1"
                           style="width: 80px"
                           onkeyup="if (event.keyCode === 13) {
                                       mat_req_ots_search(0)
                                   }"
                           />
                </span>
                <span class="labelelement">
                    <input type="text" 
                           name="approval2"  
                           placeholder="Approval 2"
                           style="width: 80px"
                           onkeyup="if (event.keyCode === 13) {
                                       mat_req_ots_search(0);
                                   }"
                           />
                </span>
                <button onclick="mat_req_ots_search(0)">Search</button>
                <button onclick="mat_req_ots_print()">Print</button>
                <button onclick="mat_req_ots_excel()">Excel</button>
            </form>
        </div>
        <div id="mat_req_ots_n_data" style="width: 100%;overflow-x: hidden">
            <?php $materialrequisition->search_ots(0); ?>
        </div>
    </center>
</div>