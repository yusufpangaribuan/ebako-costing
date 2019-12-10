<div style="width: 600px">
    <form id="vendor_edit_form" onsubmit="return false">
        <table width="100%" border="0">
            <tr valign="top">
                <td width="50%">
                    <table WIDTH="100%">
                        <tr>
                            <td WIDTH="40%" align="right"><span class="labelelement">Vendor Number</span></td>
                            <td>
                                <input type="hidden" name="id" value="<?php echo $vendor[0]->id ?>" />
                                <input style="width: 100%" type='text' name='vendornumber' value="<?php echo $vendor[0]->vendornumber ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Vendor Name</span></td>
                            <td><input style="width: 100%" type='text' name='name' value="<?php echo $vendor[0]->name ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Currency</span></td>
                            <td>
                                <select name="curr" required="true" style="width: 50px">
                                    <option value=""></option>
                                    <?php
                                    foreach ($currency as $result) {
                                        if ($vendor[0]->curr == $result->curr) {
                                            echo "<option value='" . $result->curr . "' selected>" . $result->curr . "</option>";
                                        } else {
                                            echo "<option value='" . $result->curr . "'>" . $result->curr . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <select name="curr2" style="width: 50px">                                    
                                    <option value=""></option>
                                    <?php
                                    echo $vendor[0]->curr2;
                                    foreach ($currency as $result) {
                                        if ($vendor[0]->curr2 == $result->curr) {
                                            echo "<option value='" . $result->curr . "' selected>" . $result->curr . "</option>";
                                        } else {
                                            echo "<option value='" . $result->curr . "'>" . $result->curr . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <select name="curr3" style="width: 50px">
                                    <option value=""></option>
                                    <?php
                                    foreach ($currency as $result) {
                                        if ($vendor[0]->curr3 == $result->curr) {
                                            echo "<option value='" . $result->curr . "' selected>" . $result->curr . "</option>";
                                        } else {
                                            echo "<option value='" . $result->curr . "'>" . $result->curr . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Contact</span></td>
                            <td><input style="width: 100%" type='text' name='contact' value="<?php echo $vendor[0]->contact ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Phone</span></td>
                            <td><input type='text' name='phone' style="width: 100%" value="<?php echo $vendor[0]->phone ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Fax</span></td>
                            <td><input type='text' name='fax' style="width: 100%" value="<?php echo $vendor[0]->fax ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Email</span></td>
                            <td><input size='25' type='text' name='email' style="width: 100%" value="<?php echo $vendor[0]->email ?>"/></td>
                        </tr>
                        <tr valign="top">
                            <td align="right"><span class="labelelement">Address 1</span></td>
                            <td><textarea style="width: 100%;height: 40px" name='address1'><?php echo $vendor[0]->address1 ?></textarea></td>
                        </tr>
                        <tr valign="top">
                            <td align="right"><span class="labelelement">Address 2</span></td>
                            <td><textarea style="width: 100%;height: 40px" name='address2'><?php echo $vendor[0]->address2 ?></textarea></td>
                        </tr>
                    </table>
                </td>
                <td width="50%">
                    <table width="100%">
                        <tr>
                            <td width="40%" align="right"><span class="labelelement">City</span></span></td>
                            <td><input type='text' name='city' style="width: 100%" value="<?php echo $vendor[0]->city ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">State</span></td>
                            <td><input type='text' name='state' style="width: 100%" value="<?php echo $vendor[0]->state ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Zip Code</span></td>
                            <td><input type='text' name='zipcode' style="width: 100%" value="<?php echo $vendor[0]->zipcode ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Country</span></td>
                            <td><input type='country' name='country' style="width: 100%" value="<?php echo $vendor[0]->country ?>"/></td>
                        </tr>							
                        <tr>
                            <td align="right"><span class="labelelement">Service</span></td>
                            <td><textarea  style="width: 100%;height: 40px" name='service'><?php echo $vendor[0]->service ?></textarea></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Tax</span></td>
                            <td><input type='text' name='taxnumber' style="width: 100%" value="<?php echo $vendor[0]->taxnumber ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Join Date</span></td>
                            <td><input type='text' name='startdate' style="width: 100%" value="<?php echo $vendor[0]->startdate ?>"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">End Date</span></td>
                            <td><input type='text' name='enddate' style="width: 100%" value="<?php echo $vendor[0]->enddate ?>"/></td>
                        </tr>                        
                    </table>
                </td>
            </tr>
        </table>
    </form>
</div>


