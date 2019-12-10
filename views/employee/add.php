<div style="width: 600px;margin-right: 10px">
    <form id="employee_add_form" onsubmit="return false">
        <table width="100%" border="0">
            <tr valign="top">
                <td width="50%" valign="top">
                    <table width="100%" border="0">
                        <tr valign="top">
                            <td width="30%" align="right"><span class="labelelement">ID :</span></td>
                            <td width="70%"><input style="width: 100%" type='text' name='id' id='id' required="true"/></td>
                        </tr>
                        <tr valign="top">
                            <td align="right"><span class="labelelement">Name :</span></td>
                            <td><input size='25' type='text' name='name' id='name' required="true" style="width: 100%" /></td>
                        </tr>
                        <tr valign="top">
                            <td align="right"><span class="labelelement">Department :</span></td>
                            <td>
                                <select id="departmentid" name="departmentid" required="true"  style="width: 100%"  onchange="user_departmentchange(this)">
                                    <option value=""></option>
                                    <?php
                                    foreach ($department as $department) {
                                        echo "<option value='" . $department->id . "'>" . $department->code . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr style="display: none;" id="adminforwarehouse" valign="top">
                            <td align="right"><span class="labelelement">Allow For : </span></td>
                            <td>
                                <select id="adminwhsfor"  style="width: 100%" >
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
                            <td align="right"><span class="labelelement">Purchasing Group : </span></td>
                            <td>
                                <select id="purchasinggroup" name="optiongroup"  style="width: 100%" >
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
                            <td align="right"><span class="labelelement">Position :</span></td>
                            <td>
                                <select id="positionid" name="positionid" style="width: 100%" >
                                    <option value="0"></option>
                                    <?php
                                    foreach ($position as $result) {
                                        echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
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
                                <input type='text' name='startdate' id='startdate' />
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
                                <input type='text' name='enddate' id='enddate' />
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">DOB :</span></td>
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
                                <input type='text' name='dob' id='dob' />
                            </td>
                        </tr>
                        <tr valign="top">
                            <td align="right"><span class="labelelement">Address :</span></td>
                            <td><textarea style="width: 100%;height: 40px;" name='address' id="address"></textarea></td>
                        </tr>                        
                    </table>
                </td>
                <td width="50%">
                    <table width="100%" border="0">
                        <tr>
                            <td width="30%" align="right"><span class="labelelement">Work phone :</span></span></td>
                            <td width="70%"><input type='text' name='workphone' id='workphone' style="width: 100%" /></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Home phone :</span></td>
                            <td><input type='text' name='homephone' id='homephone' style="width: 100%"/></td>
                        </tr>


                        <tr>
                            <td align="right"><span class="labelelement">E-mail :</span></td>
                            <td><input type='country' name='email' id='email' style="width: 100%"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">City :</span></td>
                            <td><input size='25' type='text' name='city' id='city' style="width: 100%"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">State :</span></td>
                            <td><input type='text' name='state' id='state' style="width: 100%"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Zip code :</span></td>
                            <td><input type='text' name='zipcode' id='zipcode' style="width: 100%"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Country :</span></td>
                            <td><input type='text' name='country' id='country' style="width: 100%"/></td>
                        </tr>                        
                    </table>
                </td>
            </tr>
        </table>
    </form>
</div>