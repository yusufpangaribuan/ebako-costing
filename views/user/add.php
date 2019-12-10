<div style="width: 550px;">
    <table style="width: 100%">
        <tr>
            <td width="25%" align="right"><span class="labelelement"><span style="color: red;">*&nbsp;</span> ID : </span></td>
            <td>
                <select id="id" style="max-width: 200px;">
                    <option value="0"></option>
                    <?php
                    foreach ($employee as $employee) {
                        echo "<option value='" . $employee->id . "'>" . $employee->id . " [" . $employee->name . "]</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement"><span style="color: red;">*&nbsp;</span> Department :</span></td>
            <td>
                <select id="departmentid" style="width: 120px" onchange="user_departmentchange(this)">
                    <option value="0">--</option>
                    <?php
                    foreach ($department as $department) {
                        echo "<option value='" . $department->id . "'>" . $department->code . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr style="display: none;" id="adminforwarehouse">
            <td align="right"><span class="labelelement"><span style="color: red;">*&nbsp;</span> Allow For : </span></td>
            <td>
                <select id="adminwhsfor" style="width: 100px" >
                    <option value="0">ALL</option>
                    <?php
                    foreach ($warehouse as $result) {
                        echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                    }
                    ?>
                </select> <span style="font-size: 11px;font-style: italic;">Option 'All' just allow to view data</span>

            </td>
        </tr>    
        <tr style="display: none;" id="adminforpurchasing">
            <td align="right"><span class="labelelement"><span style="color: red;">*&nbsp;</span> Purchasing Group : </span></td>
            <td>
                <select id="purchasinggroup" style="width: 100px" >
                    <option value="0">ALL</option>
                    <?php
                    foreach ($purchasing as $result) {
                        echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                    }
                    ?>
                </select> <span style="font-size: 11px;font-style: italic;">Option 'All' allow for all item</span>                    
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement"><span style="color: red;">*&nbsp;</span> Password : </span></td>
            <td><input type="password" name="password" autocomplete="off" value="" id="password"/></td>
        </tr>    
        <tr>
            <td align="right"><span class="labelelement"><span style="color: red;">*&nbsp;</span> Retype Password : </span></td>
            <td><input type="password" name="repassword" id="repassword"/></td>
        </tr>
    </table>
</div>
