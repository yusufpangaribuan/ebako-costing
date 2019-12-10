<center>
    <div class="panel" style="width: 900px">
        <table align="center" width="100%" border="0">            
            <tr>
                <td colspan="5" align="center">&nbsp;</td>
            </tr>    
            <tr valign="top">
                <td width="15%" align="right"><span class="labelelement">Request Number :</span></td>
                <td width="20%"><input type="text" name="requstnumber" id="requestnumber" value="<?php echo $nextpr; ?>" readonly="" size="10" style="text-align: center;"/></td>
                <td width="30%">&nbsp;</td>
                <td width="15%" align="right"><label class="labelelement">SO No :</label></td>
                <td width="20%"><input type="text" name="sonumber" id="sonumber" value="" size="15"/></td>
            </tr>
            <tr valign="top">
                <td align="right"><label class="labelelement">Request Date :</label></td>
                <td>
                    <script type="text/javascript" >
                        $(function () {
                            $("#requestdate").datepicker({
                                dateFormat: "yy-mm-dd"
                            }).focus(function () {
                                $("#requestdate").datepicker("show");
                            });
                        });
                    </script>
                    <input type="text" size="10" name="requestdate" id="requestdate" readonly="" value="<?php echo date('Y-m-d') ?>" style="text-align: center"/>
                </td>
                <td>&nbsp;</td>
                <td align="right"><label class="labelelement">MR No :</label></td>
                <td><input type="text" name="mrnumber" id="mrnumber" value="" size="10" readonly=""/>&nbsp;<img src="images/list.png" class="miniaction" onclick="pr_dialogsearchpr('mrnumber')"/></td>                
            </tr>
            <tr valign="top">
                <td align="right"><span class="labelelement">Dept. (Request By) :</span></td>
                <td>
                    <select id="departmentid" name="departmentid">
                        <option value="0">--Department--</option>
                        <?php
                        foreach ($department as $result) {
                            echo "<option value='" . $result->id . "'>" . $result->code . "</option>";
                        }
                        ?>
                    </select>
                </td>
                <td>&nbsp;</td>
                <td align="right"><span class="labelelement">Remark :</span></td>
                <td rowspan="2"><textarea cols="20" id="remark"></textarea></td>
            </tr>
            <tr valign="top">
                <td align="right"><span class="labelelement">End User :</span></td>
                <td>
                    <select id="enduser" name="enduser">
                        <option value="0">--Department--</option>
                        <?php
                        foreach ($department as $result) {
                            echo "<option value='" . $result->id . "'>" . $result->code . "</option>";
                        }
                        ?>
                    </select>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>                        
            <tr valign="top">
                <td colspan="5">
                    <br/><br/>
                    <!--                    <button onclick="pr_choose_from_order_recommendation()" style="float: right;margin-bottom: 3px;">Choose From Order Recommendation</button>-->
                    <table width="100%" class="tablesorter">
                        <thead>
                            <tr>
                                <th width="20%">Code</th>                                
                                <th width="38%">Description</th>
                                <th width="10%">MOQ</th>
                                <th width="10%">Qty</th>
                                <th width="10%">Unit</th>
                                <th width="2%">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody id="prtablebody">
                            <tr valign="top">
                                <td>
                                    <input type="hidden" name="itemid[]" id="itemid0" value="0"/>
                                    <input type="text" name="partnumber[]" id="partnumber0" style="width: 100%" readonly=""><br/>
                                    <button onclick="item_listSearch(0)" style="margin-top: 2px;"> Item List</button>
                                </td>
                                <td><textarea style="width: 100%; height: 50px;" name="desciption[]" id="description0" readonly=""></textarea></td>
                                <td><input type="text" style="width:100%;text-align: center" name="moq[]" id="moq0" readonly="" /></td>
                                <td><input type="text" name="qty[]" id="qty0" value="1" size="5" style="text-align: center; width: 100%;" onblur="if ($(this).val() == '' || $(this).val() == '0' || isNaN($(this).val())) {
                                            alert('Required NUMBER and Not Allow 0 or NULL');
                                            $(this).val(1);
                                        }"></td>
                                <td>
                                    <select name="unit[]" id="unitid0" style="width: 100%">
                                        <option value="0">--Unit--</option>
                                    </select>
                                </td>                                
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                    <button onclick="pr_additem()" style="margin-top: 5px;">Add Item</button>
                </td>        
            </tr>        
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5" align="center"><br/>
                    <button onclick="pr_save()">Save</button>&nbsp;
                    <button onclick="pr_create()">Reset</button>&nbsp;
                    <button onclick="$('#dialog_temp').dialog('close')">Cancel</button>&nbsp;
                    <br/><br/>
                </td>
            </tr>
        </table>
    </div>

    <br/>
    <br/>
    <br/>
</center>