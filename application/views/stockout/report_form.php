<div style="width: 900px;height: 500px;padding-right: 5px;">
    <table width="100%">
        <tr>
            <td width="100%">
                <div class="panel">
                    <form id="sto_rpt_form">
                        <table width="50%" border="0">
                            <tr>
                                <td width="25%"align="right"><label class="labelelement" >Date :</label></td>
                                <td width="75%">
                                    <script type="text/javascript" >
                                        $(function () {
                                            $("#sto_rpt_date_start").datepicker({
                                                dateFormat: "yy-mm-dd",
                                                changeMonth: true,
                                                changeYear: true,
                                                showButtonPanel: true
                                            }).focus(function () {
                                                $("#sto_rpt_date_start").datepicker("show");
                                            });
                                            $("#sto_rpt_date_end").datepicker({
                                                dateFormat: "yy-mm-dd",
                                                changeMonth: true,
                                                changeYear: true,
                                                showButtonPanel: true
                                            }).focus(function () {
                                                $("#sto_rpt_date_end").datepicker("show");
                                            });
                                        });
                                    </script>
                                    <input type="text" id="sto_rpt_date_start" name="date_start" size="9"/>
                                    To :
                                    <input type="text" id="sto_rpt_date_end" name="date_end" size="9" />
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><label class="labelelement" >Stock Out No :</label></td>
                                <td><input type="text" id="stock_out_no" name="stock_out_no" size="9" style="width: 70%"/></td>
                            </tr>
                            <tr>
                                <td align="right"><label class="labelelement">Department :</label></td>
                                <td>
                                    <select id="sto_rpt_departmentid" name="departmentid">
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
                                    <select id="sto_rpt_sub_departmentid" name="sto_rpt_sub_departmentid">
                                        <option value="0">--All--</option>
                                        <?php
                                        foreach ($sub_department as $sub_department) {
                                            echo "<option value='" . $sub_department->id . "'>" . $sub_department->name . "</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><span class="labelelement">Cost Center :</span></td>
                                <td>
                                    <select id="cost_center_id" name="cost_center_id" onchange="cost_center_load_member(this, 'sto_member_cost_center_id')" style="width: 150px">
                                        <option value="0">----</option>
                                        <?php
                                        foreach ($costcenter as $result) {
                                            echo "<option value='" . $result->id . "'>" . $result->code . "-" . $result->description . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <span class="labelelement">Member :</span>
                                    <select id="sto_member_cost_center_id" name="member_cost_center_id" style="width: 120px">
                                        <option value="0">None</option>
                                        <option value='-1'>All</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><label class="labelelement" >Item Code/Desc :</label></td>
                                <td><input type="text" name="item_code_description" size="9" style="width: 70%"/></td>
                            </tr>
                            <tr>
                                <td align="right"><span class="labelelement">Item Group :</span></td>
                                <td>
                                    <select name="groupid" style="width: 200px">
                                        <option value="">All</option>
                                        <?php
                                        foreach ($group as $result) {
                                            echo "<option value='" . $result->id . "'>[" . $result->codes . "] " . $result->names . "</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><br/>
                                    <button type="button" onclick="stockout_rpt_gennerate(1)">View</button>
                                    <button type="button" onclick="stockout_rpt_gennerate(2)">Print</button>
                                    <button type="button" onclick="stockout_rpt_gennerate(3)">Export to Excel</button>
                                    <br/><br/>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="panel">
                    <h4>Report Preview</h4>
                    <div id="sto_rpt_temp_preview" style="min-width: 100%;height: 400px;overflow: auto">

                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>

