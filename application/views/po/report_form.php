<div style="width: 900px;height: 500px;padding: 5px 15px 5px 5px;">
    <table width="100%">
        <tr>
            <td width="100%">
                <div class="panel">
                    <form id="po_rpt_form">
                        <table width="100%" border="0">
                            <tr valign="top">
                                <td width="40%" >
                                    <table width="100%" border="0">
                                        <tr>
                                            <td width="30%" align="right"><label class="labelelement" >Date :</label></td>
                                            <td width="70%">
                                                <script type="text/javascript" >
                                                    $(function () {
                                                        $("#po_rpt_date_start").datepicker({
                                                            dateFormat: "yy-mm-dd",
                                                            changeMonth: true,
                                                            changeYear: true,
                                                            showButtonPanel: true
                                                        }).focus(function () {
                                                            $("#po_rpt_date_start").datepicker("show");
                                                        });
                                                        $("#po_rpt_date_end").datepicker({
                                                            dateFormat: "yy-mm-dd",
                                                            changeMonth: true,
                                                            changeYear: true,
                                                            showButtonPanel: true
                                                        }).focus(function () {
                                                            $("#po_rpt_date_end").datepicker("show");
                                                        });
                                                    });
                                                </script>
                                                <input type="text" id="po_rpt_date_start" name="date_start" readonly="" size="9"/>
                                                <strong>To :</strong>
                                                <input type="text" id="po_rpt_date_end" name="date_end" readonly="" size="9" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label class="labelelement" >PO No. :</label></td>
                                            <td><input type="text" name="po_no" size="9" style="width: 70%"/></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label class="labelelement" >PR No. :</label></td>
                                            <td><input type="text" name="pr_no" size="9" style="width: 70%"/></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label class="labelelement" >MR No. :</label></td>
                                            <td><input type="text" name="mr_no" size="9" style="width: 70%"/></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label class="labelelement">Department :</label></td>
                                            <td>
                                                <select id="po_rpt_departmentid" name="departmentid">
                                                    <option value="0">--All--</option>
                                                    <?php
                                                    foreach ($department as $department) {
                                                        echo "<option value='" . $department->id . "'>" . $department->name . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label class="labelelement">Sub Department :</label></td>
                                            <td>
                                                <select id="po_rpt_sub_departmentid" name="sub_departmentid">
                                                    <option value="0">--All--</option>
                                                    <?php
                                                    foreach ($sub_department as $sub_department) {
                                                        echo "<option value='" . $sub_department->id . "'>" . $sub_department->name . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="60%">
                                    <table width="100%" border="0">
                                        <tr>
                                            <td align="right"><label class="labelelement">Vendor/Supplier :</label></td>
                                            <td>
                                                <select name="vendorid">
                                                    <option value="0">--All--</option>
                                                    <?php
                                                    foreach ($vendor as $vendor) {
                                                        echo "<option value='" . $vendor->id . "'>" . $vendor->name . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><span class="labelelement">Cost Center :</span></td>
                                            <td>
                                                <select id="cost_center_id" name="cost_center_id" onchange="cost_center_load_member(this, 'member_cost_center_id')" style="width: 150px">
                                                    <option value="0">----</option>
                                                    <?php
                                                    foreach ($costcenter as $result) {
                                                        echo "<option value='" . $result->id . "'>" . $result->code . "-" . $result->description . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <span class="labelelement">Member :</span>
                                                <select id="member_cost_center_id" name="member_cost_center_id" style="width: 120px">
                                                    <option value="0">None</option>
                                                    <option value='-1'>All</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><span class="labelelement">Item Group :</span></td>
                                            <td>
                                                <select name="groupid">
                                                    <option value="0">All</option>
                                                    <?php
                                                    foreach ($group as $result) {
                                                        echo "<option value='" . $result->id . "'>[" . $result->codes . "] " . $result->names . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label class="labelelement" >Item Code/Desc :</label></td>
                                            <td><input type="text" name="item_code_description" size="9" style="width: 70%"/></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" colspan="2"><br/>
                                    <button type="button" onclick="po_rpt_generate(1)">View</button>
                                    <button type="button" onclick="po_rpt_generate(2)">Print</button>
                                    <button type="button" onclick="po_rpt_generate(3)">Export to Excel</button>
                                    <br/><br/>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </td>
        </tr>
    </table>
    <div class="panel" style="overflow: auto;">
        <h4>Report Preview</h4>
        <div id="po_rpt_temp_preview" style="width: 100%;height: 400px;overflow-y: auto;overflow-x: scroll;">

        </div>
    </div>
</div>


