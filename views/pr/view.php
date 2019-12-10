<h4>Purchase Requisition</h4>
<div align="left" style="margin: 1px" >
    <form id="pr_search_form" onsubmit="return false">
        <span class="labelelement">Search :
            <input type="text" id="requestnumber_s" name="requestnumber" size="8" placeholder="PR No" onkeypress="if (event.keyCode == 13) {
                        pr_search(0);
                    }"/>
        </span>
        <input type="text" id="pr_mr_no_s" name="mr_no" placeholder="MR/SR No" size="8" onkeypress="if (event.keyCode == 13) {
                    pr_search(0);
                }"/>
        <script type="text/javascript" >
            $(function () {
                $("#requestdatestart").datepicker({
                    dateFormat: "yy-mm-dd"
                }).focus(function () {
                    $("#requestdatestart").datepicker("show");
                });
                $("#requestdateend").datepicker({
                    dateFormat: "yy-mm-dd"
                }).focus(function () {
                    $("#requestdateend").datepicker("show");
                });
            });
        </script>
        <input type="text" id="requestdatestart" name="requestdatestart" placeholder="Start Date" size="10" onchange="pr_search(0)"/>
        <span class="labelelement">-</span>
        <input type="text" id="requestdateend" name="requestdateend" size="10" placeholder="End Date" onchange="pr_search(0)"/>
        <select id="departmentid_s" onchange="pr_search(0)" name="departmentid">
            <option value="0">--Department--</option>
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
                               pr_search(0);
                           }"/>
        </span>
        <select id="state_s" name="state" onchange="pr_search(0)">
            <option value="0">--Status--</option>
            <option value=true>Finish</option>
            <option value=false>Not Finish</option>
        </select>
        <button type="button" onclick="pr_search(0)">Search</button>
        <?php
        if (in_array('configure_approval', $accessmenu)) {
            echo "<button type='button' onclick='pr_configapproval()'>Configure Approval</button>";
        }
        ?>
    </form>
</div>
<div id="prdata" style="margin: 1px;">
    <?php $pr->search(0); ?>
</div>