<div style="width: 1000px;padding: 4px" class="panel">
    <center>
        <div align="left" style="margin-bottom: 5px;margin-top: 5px;">
            <form id="serv_req_ots_create_pr_search_form" onsubmit="return false">
                <span class="labelelement">Search :
                    <input type="tex" 
                           name="item_code_description"  
                           placeholder="Item Code / Description"
                           style="width: 150px"
                           onkeyup="if (event.keyCode === 13) {
                                       serv_req_ots_create_pr_search(0)
                                   }"
                           />
                </span>
                <span class="labelelement">
                    <input type="text" id="number" 
                           name="number" 
                           size="8" 
                           placeholder="MR NO"
                           onkeypress="if (event.keyCode === 13) {
                                       serv_req_ots_create_pr_search(0);
                                   }"/>
                </span>
                <span class="labelelement">
                    <input type="text" name="start_date" 
                           placeholder="Date From"
                           id="serv_req_start_date_s" size="8" onchange="serv_req_ots_create_pr_search(0)"/>
                    <script type="text/javascript" >
                        $(function () {
                            $("#serv_req_start_date_s").datepicker({
                                dateFormat: "yy-mm-dd"
                            }).focus(function () {
                                $("#serv_req_start_date_s").datepicker("show");
                            });
                        });
                    </script>
                    -
                    <input type="text" name="end_date" 
                           placeholder="Date To"
                           id="serv_req_end_date_s" size="8" onchange="serv_req_ots_create_pr_search(0)"/>
                    <script type="text/javascript" >
                        $(function () {
                            $("#serv_req_end_date_s").datepicker({
                                dateFormat: "yy-mm-dd"
                            }).focus(function () {
                                $("#serv_req_end_date_s").datepicker("show");
                            });
                        });
                    </script>
                </span>
                <span class="labelelement">
                    <select name="departmentid" 
                            style="width: 100px" 
                            onchange="serv_req_ots_create_pr_search(0)">
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
                                       serv_req_ots_create_pr_search(0)
                                   }"
                           />
                </span>
                <span class="labelelement">
                    <input type="text" 
                           name="approval2"  
                           placeholder="Approval 2"
                           style="width: 80px"
                           onkeyup="if (event.keyCode === 13) {
                                       serv_req_ots_create_pr_search(0);
                                   }"
                           />
                </span>

                <button onclick="serv_req_ots_create_pr_search(0)">Search</button>
            </form>
        </div>
        <div id="serv_req_ots_create_pr_n_data" style="width: 100%;overflow-x: hidden">
            <?php $pr->search_sr_item_available(0); ?>
        </div>
    </center>
</div>