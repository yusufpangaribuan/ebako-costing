<h4>Material Withdraw</h4>
<div style="width: 100%;padding: 0px">
    <table border="0" widt="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <span class="labelelement" style="">Search :
                    <input type="text" 
                           id="number" 
                           size="8" 
                           onkeypress="if (event.keyCode == 13) {
                                       mr_search(0);
                                   }" placeholder="MW NO"/>
                </span>
                <span class="labelelement">
                    <input type="text" placeholder="Date Start" id="start_date" size="8" onchange="mr_search(0)"/>
                    -
                    <input type="text" placeholder="Date End" id="end_date" size="8" onchange="mr_search(0)"/>
                    <script type="text/javascript" >
                        $(function () {
                            $("#start_date").datepicker({
                                dateFormat: "yy-mm-dd"
                            }).focus(function () {
                                $("#start_date").datepicker("show");
                            });

                            $("#end_date").datepicker({
                                dateFormat: "yy-mm-dd"
                            }).focus(function () {
                                $("#end_date").datepicker("show");
                            });
                        });
                    </script>
                </span>
                <span class="labelelement"> 
                    <select id="mr_departmentid_s78" style="width: 120px;font-style: italic;" onchange="mr_search(0)">
                        <option value="0">Department</option>
                        <?php
                        foreach ($department as $result) {
                            echo "<option value='" . $result->id . "'>" . $result->code . "</option>";
                        }
                        ?>
                    </select>
                </span>
                <span class="labelelement">
                    <input type="text" id="mr_s_12_item_code_description" 
                           placeholder="Item Code / Item Description" 
                           size="12" 
                           style="width: 150px"
                           onkeypress="if (event.keyCode === 13) {
                                       mr_search(0);
                                   }"/>
                </span>
                <span class="labelelement">
                    <input type="text" id="requestby" 
                           size="8" 
                           placeholder="Request By" 
                           onkeypress="if (event.keyCode === 13) {
                                       mr_search(0);
                                   }"/>
                </span>
                <span class="labelelement">
                    <input type="text" id="supervisorapproval" 
                           placeholder="Approval 1"
                           size="8" 
                           onkeypress="if (event.keyCode === 13) {
                                       mr_search(0);
                                   }"/>
                </span>
                <span class="labelelement">
                    <input type="text" id="managerapproval" 
                           size="8" 
                           placeholder="Approval 1"
                           onkeypress="if (event.keyCode === 13) {
                                       mr_search(0);
                                   }"/>            
                </span>
                <span class="labelelement">
                    <select id="status" style="width: 80px;font-style: italic;" onchange="mr_search(0)">
                        <option value="">--Status--</option>
                        <?php
                        foreach ($mrstatus as $x => $x_value) {
                            echo "<option value='" . $x . "'>" . $x_value . "</option>";
                        }
                        ?>
                    </select>
                </span>
                <button onclick="mr_search(0)">Search</button>
                <button onclick="mr_print()">Print</button>
                <?php
                if (in_array('add', $accessmenu)) {
                    echo "<button onclick=mr_add(1)>Create</button>";
                    if ($this->session->userdata('department') == 10) {
                        echo "<button onclick=mr_add(2)>Request Transfer Stock</button>";
                    }
                }
                ?>
            </td>
        </tr>
    </table>
</div>
<div id="mrdata" style="width: 100%;padding: 1px;">
    <?php $mr->search(0) ?>
</div>
<div id="mat_withdraw_n" style="display: none"></div>
<div id="mat_withdraw_dialog" style="display: none"></div>