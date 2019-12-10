<div style="width: 600px">
    <form id="vendor_add_form" onsubmit="return false">
        <table width="100%" border="0">
            <tr valign="top">
                <td width="50%">
                    <table WIDTH="100%">
                        <tr>
                            <td WIDTH="30%" align="right"><span class="labelelement">ID :</span></td>
                            <td WIDTH="30%"><input  style="width: 100%" type='text' name='vendornumber' id='vendornumber' value="<?php echo $vendornumber ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Name :</span></td>
                            <td><input type='text' name='name' style="width: 100%" required="true"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Currency :</span></td>
                            <td>
                                <select name="curr" required="true" style="width: 50px">
                                    <option value=""></option>
                                    <?php
                                    foreach ($currency as $result) {
                                        echo "<option value='" . $result->curr . "'>" . $result->curr . "</option>";
                                    }
                                    ?>
                                </select>
                                <select name="curr2" style="width: 50px">
                                    <option value=""></option>
                                    <?php
                                    foreach ($currency as $result) {
                                        echo "<option value='" . $result->curr . "'>" . $result->curr . "</option>";
                                    }
                                    ?>
                                </select>
                                <select name="curr3" style="width: 50px">
                                    <option value=""></option>
                                    <?php
                                    foreach ($currency as $result) {
                                        echo "<option value='" . $result->curr . "'>" . $result->curr . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Contact :</span></td>
                            <td><input  style="width: 100%" type='text' name='contact' /></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Phone :</span></td>
                            <td><input type='text' name='phone'  style="width: 100%" /></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Fax :</span></td>
                            <td><input type='text' name='fax'  style="width: 100%" /></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Email :</span></td>
                            <td><input size='25' type='text' name='email' id='email' /></td>
                        </tr>
                        <tr valign="top">
                            <td align="right"><span class="labelelement">Address 1 :</span></td>
                            <td><textarea  style="width: 100%;height: 40px" name='address1'></textarea></td>
                        </tr>
                        <tr valign="top">
                            <td align="right"><span class="labelelement">Address 2 :</span></td>
                            <td><textarea  style="width: 100%;height: 40px" name='address2'></textarea></td>
                        </tr>
                    </table>
                </td>
                <td width="50%">
                    <table width="100%">
                        <tr>
                            <td width="40%" align="right"><span class="labelelement">City :</span></span></td>
                            <td><input type='text' name='city' style="width: 100%" /></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">State :</span></td>
                            <td><input type='text' name='state' style="width: 100%" /></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Zip code :</span></td>
                            <td><input type='text' name='zipcode' style="width: 100%" /></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Country :</span></td>
                            <td><input type='country' name='country' id='country' /></td>
                        </tr>							
                        <tr valign="top">
                            <td align="right"><span class="labelelement">Service :</span></td>
                            <td><textarea style="width: 100%;height: 40px" name='service'></textarea></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Tax :</span></td>
                            <td><input type='text' name='taxnumber' style="width: 100%" /></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Join Date :</span></td>
                            <td>
                                <input type='text' name='startdate' style="width: 100%"/>
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#vendor_add_form input[name='startdate']").datepicker({
                                            dateFormat: "yy-mm-dd"
                                        }).focus(function () {
                                            $("#vendor_add_form input[name='startdate']").datepicker("show");
                                        });
                                    });
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">End Date :</span></td>
                            <td>
                                <input type='text' name='enddate' style="width: 100%"/>
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#vendor_add_form input[name='enddate']").datepicker({
                                            dateFormat: "yy-mm-dd"
                                        }).focus(function () {
                                            $("#vendor_add_form input[name='enddate']").datepicker("show");
                                        });
                                    });
                                </script>
                            </td>
                        </tr>                        
                    </table>
                </td>
            </tr>
        </table>
    </form>
</div>