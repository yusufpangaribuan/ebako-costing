<div style="width: 600px"margin-right: 10px">
     <form id="employee_edit_form" onsubmit="return false">
        <table width="100%" border="0">
            <tr valign="top">
                <td width="50%">
                    <table>
                        <tr WIDTH="100%">
                            <td WIDTH="35%" align="right"><span class="labelelement">ID :</span></td>
                            <td width="65%"><input style="width: 100%" type='text' name='id' id='id' value="<?php echo $employee->id ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Name :</span></td>
                            <td><input style="width: 100%" type='text' name='name' id='name' value="<?php echo $employee->name ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Area :</span></td>
                            <td>
                                <select id="area_id"name="area_id" style="width: 100%" required="true">
                                    <option></option>
                                    <?php
                                    foreach ($area as $result) {
                                        if ($employee->area_id == $result->id) {
                                            echo "<option value='" . $result->id . "' selected>" . $result->name . "</option>";
                                        } else {
                                            echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Department :</span></td>
                            <td>
                                <select id="departmentid" style="width: 100%" name="departmentid"  required="true" onchange="user_departmentchange(this)">
                                    <option value="0">--</option>
                                    <?php
                                    foreach ($department as $department) {
                                        if ($employee->departmentid == $department->id) {
                                            echo "<option value='" . $department->id . "' selected>" . $department->name . "</option>";
                                        } else {
                                            echo "<option value='" . $department->id . "'>" . $department->name . "</option>";
                                        }
                                    }
                                    $option_warehouse = "style='display:none;'";
                                    $option_purchasing = "style='display:none;'";
                                    if ($employee->departmentid == 10) {
                                        $option_warehouse = "";
                                    }
                                    if ($employee->departmentid == 8) {
                                        $option_purchasing = "";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr <?php echo $option_warehouse ?> id="adminforwarehouse" valign="top">
                            <td align="right"><span class="labelelement">Allow For : </span></td>
                            <td>
                                <select id="adminwhsfor" style="width: 100%" >
                                    <option value="0">ALL</option>
                                    <?php
                                    foreach ($warehouse as $result) {
                                        if ($employee->optiongroup == $result->id) {
                                            echo "<option value='" . $result->id . "' selected>" . $result->name . "</option>";
                                        } else {
                                            echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                                        }
                                    }
                                    ?>
                                </select> <span style="font-size: 11px;font-style: italic;">Option 'All' just allow to view data</span>

                            </td>
                        </tr>
                        <tr <?php echo $option_purchasing ?> id="adminforpurchasing" valign="top">
                            <td align="right"><span class="labelelement">Purchasing Group : </span></td>
                            <td>
                                <select id="purchasinggroup" style="width: 100%" >
                                    <option value="0">ALL</option>
                                    <?php
                                    foreach ($purchasing as $result) {
                                        if ($employee->optiongroup == $result->id) {
                                            echo "<option value='" . $result->id . "' selected>" . $result->name . "</option>";
                                        } else {
                                            echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                                        }
                                    }
                                    ?>
                                </select> <span style="font-size: 11px;font-style: italic;">Option 'All' allow for all item</span>                    
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Sub Department :</span></td>
                            <td>
                                <select id="sub_department_id" name="sub_department_id" style="width: 100%" required="true">
                                    <option value="0"></option>
                                    <?php
                                    foreach ($sub_department as $result) {
                                        if ($employee->sub_department_id == $result->id) {
                                            echo "<option value='" . $result->id . "' selected>" . $result->name . "</option>";
                                        } else {
                                            echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Cost Center :</span></td>
                            <td>
                                <select id="cost_center_id" name="cost_center_id" style="width: 100%" required="true">
                                    <option></option>
                                    <?php
                                    foreach ($cost_center as $result) {
                                        if ($employee->cost_center_id == $result->id) {
                                            echo "<option value='" . $result->id . "' selected>" . $result->code . "-".$result->description."</option>";
                                        } else {
                                            echo "<option value='" . $result->id . "'>" . $result->code . "-".$result->description."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Position :</span></td>
                            <td>
                                <select id="positionid" name="positionid" style="width: 100%">
                                    <option value="0"></option>
                                    <?php
                                    foreach ($position as $result) {
                                        if ($employee->positionid == $result->id) {
                                            echo "<option value='" . $result->id . "' selected>" . $result->name . "</option>";
                                        } else {
                                            echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Start date :</span></td>
                            <td>
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#startdate").datepicker({
                                            dateFormat: "yy-mm-dd",
                                            changeYear: true
                                        }).focus(function () {
                                            $("#startdate").datepicker("show");
                                        });
                                    });
                                </script>
                                <input type='text' name='startdate' id='startdate' value="<?php echo $employee->startdate ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">End date :</span></td>
                            <td>
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#enddate").datepicker({
                                            dateFormat: "yy-mm-dd",
                                            changeYear: true
                                        }).focus(function () {
                                            $("#enddate").datepicker("show");
                                        });
                                    });
                                </script>
                                <input type='country' name='enddate' id='enddate' value="<?php echo $employee->enddate ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">DoB :</span></td>
                            <td>
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#dob").datepicker({
                                            dateFormat: "yy-mm-dd",
                                            changeYear: true
                                        }).focus(function () {
                                            $("#dob").datepicker("show");
                                        });
                                    });
                                </script>
                                <input type='text' name='dob' id='dob' value="<?php echo $employee->dob ?>"/>
                            </td>
                        </tr>

                    </table>
                </td>
                <td width="50%">
                    <table width="100%">
                        <tr>
                            <td align="right"><span class="labelelement">Address :</span></td>
                            <td><textarea style="width: 100%;height: 55px;" name='address' id="address"><?php echo $employee->address ?></textarea></td>
                        </tr>
                        <tr>
                            <td width="35%" align="right"><span class="labelelement">Work phone :</span></td>
                            <td width="65%"><input type='text' name='workphone' style="width: 100%" id='workphone' value="<?php echo $employee->workphone ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Home phone :</span></td>
                            <td><input type='text' name='homephone' id='homephone' style="width: 100%" value="<?php echo $employee->homephone ?>"/></td>
                        </tr>                        							
                        <tr>
                            <td align="right"><span class="labelelement">Email :</span></td>
                            <td><input type='country' name='email' id='email' style="width: 100%" value="<?php echo $employee->email ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">City :</span></td>
                            <td><input size='25' type='text' name='city' id='city' style="width: 100%" value="<?php echo $employee->city ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">State :</span></td>
                            <td><input type='text' name='state' id='state' style="width: 100%" value="<?php echo $employee->state ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Zip code :</span></td>
                            <td><input type='text' name='zipcode' id='zipcode' style="width: 100%" value="<?php echo $employee->zipcode ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Country :</span></td>
                            <td><input type='text' name='country' id='country' style="width: 100%" value="<?php echo $employee->country ?>"/></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
</div>