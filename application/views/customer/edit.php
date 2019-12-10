<div style="width: 600px">
    <form id="customer_edit_form" onsubmit="return false">
        <table width="100%" border="0">
            <tr valign="top">
                <td width="50%">
                    <table width="100%">
                        <tr>
                            <td WIDTH="30%" align="right"><span class="labelelement">Customer NO :</span></td>
                            <td WIDTH="70%">
                                <input type="hidden" name="id" value="<?php echo $customer[0]->id ?>" />
                                <input size='8' type='text' name='customernumber' id='customernumber' value="<?php echo $customer[0]->customernumber ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Name :</span></td>
                            <td><input size='25' type='text' name='name' value="<?php echo $customer[0]->name ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Curr :</span></td>
                            <td>
                                <select name="curr" style="width: 50px" required="true">
                                    <option value=""></option>
                                    <?php
                                    foreach ($currency as $result) {
                                        if ($customer[0]->curr == $result->curr) {
                                            echo "<option value='" . $result->curr . "' selected>" . $result->curr . "</option>";
                                        } else {
                                            echo "<option value='" . $result->curr . "'>" . $result->curr . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <select name="curr2"  style="width: 50px">
                                    <option value=""></option>
                                    <?php
                                    foreach ($currency as $result) {
                                        if ($customer[0]->curr2 == $result->curr) {
                                            echo "<option value='" . $result->curr . "' selected>" . $result->curr . "</option>";
                                        } else {
                                            echo "<option value='" . $result->curr . "'>" . $result->curr . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <select name="curr3"  style="width: 50px">
                                    <option value=""></option>
                                    <?php
                                    foreach ($currency as $result) {
                                        if ($customer[0]->curr3 == $result->curr) {
                                            echo "<option value='" . $result->curr . "' selected>" . $result->curr . "</option>";
                                        } else {
                                            echo "<option value='" . $result->curr . "'>" . $result->curr . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <img src="images/bomadd.png" title="Add Currenny" onclick="currency_add()" style="cursor: pointer"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Contact :</span></td>
                            <td><input  style="width: 100%" type='text' name='contact' value="<?php echo $customer[0]->contact ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Phone :</span></td>
                            <td><input  style="width: 100%" type='text' name='phone' value="<?php echo $customer[0]->phone ?>"  style="width: 100%"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Fax :</span></td>
                            <td><input style="width: 100%" type='text' name='fax' value="<?php echo $customer[0]->fax ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Email : </span></td>
                            <td><input  style="width: 100%" type='text' name='email' value="<?php echo $customer[0]->email ?>"/></td>
                        </tr>
                        <tr valign="top">
                            <td align="right"><span class="labelelement">Address 1 :</span></td>
                            <td><textarea  style="width: 100%;height: 40px"  name='address1'><?php echo $customer[0]->address1 ?></textarea></td>
                        </tr>
                        <tr valign="top">
                            <td align="right"><span class="labelelement">Address 2 :</span></td>
                            <td><textarea style="width: 100%;height: 40px"  name='address2' id="address2"><?php echo $customer[0]->address2 ?></textarea></td>
                        </tr>
                    </table>
                </td>
                <td width="50%">
                    <table width="100%">
                        <tr>
                            <td width="30%" align="right"><span class="labelelement">City :</span></span></td>
                            <td width="70%"><input type='text' style="width: 100%" name='city' value="<?php echo $customer[0]->city ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">State :</span></td>
                            <td><input type='text' name='state'  style="width: 100%" value="<?php echo $customer[0]->state ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Zip Code :</span></td>
                            <td><input type='text' name='zipcode'  style="width: 100%" value="<?php echo $customer[0]->zipcode ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Country</span></td>
                            <td><input type='country' name='country'  style="width: 100%" value="<?php echo $customer[0]->country ?>"/></td>
                        </tr>							
                        <tr>
                            <td align="right"><span class="labelelement">Service :</span></td>
                            <td><textarea style="width: 100%;height: 40px" name='service'><?php echo $customer[0]->service ?></textarea></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Tax :</span></td>
                            <td><input type='text' name='taxnumber' style="width: 100%" value="<?php echo $customer[0]->taxnumber ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Join Date :</span></td>
                            <td>
                                <input type='text' name='startdate' value="<?php echo $customer[0]->startdate ?>"/>
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#customer_edit_form input[name='startdate']").datepicker({
                                            dateFormat: "yy-mm-dd"
                                        }).focus(function () {
                                            $("#customer_edit_form input[name='startdate']").datepicker("show");
                                        });
                                    });
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">End Date :</span></td>
                            <td>
                                <input type='text' name='enddate' value="<?php echo $customer[0]->enddate ?>"/>
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#customer_edit_form input[name='enddate']").datepicker({
                                            dateFormat: "yy-mm-dd"
                                        }).focus(function () {
                                            $("#customer_edit_form input[name='enddate']").datepicker("show");
                                        });
                                    });
                                </script>
                            </td>
                        </tr>                        
                    </table>
                </td>
            </tr>
        </table>
</div>