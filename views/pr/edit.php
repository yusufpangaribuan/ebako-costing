<center>
    <div class="panel" style="width: 900px">
        <form id="pr_edit_form" name="pr_edit_form" onsubmit="return false">
            <table align="center" width="100%" border="0">            
                <tr>
                    <td colspan="5" align="center">&nbsp;</td>
                </tr>    
                <tr>
                    <td width="15%" align="right"><span class="labelelement">Request Number :</span></td>
                    <td width="20%">
                        <input type="hidden" name="id" id="id" readonly="true" value="<?php echo $pr->id ?>"/>
                        <input type="text" name="requstnumber" id="requestnumber" readonly="true" value="<?php echo $pr->requestnumber ?>"/>
                    </td>
                    <td width="30%">&nbsp;</td>
                    <td width="15%" align="right"><label class="labelelement">SO Number</label></td>
                    <td width="20%"><input type="text" name="sonumber" id="sonumber" value="<?php echo $pr->sonumber ?>"/></td>
                </tr>
                <tr>
                    <td align="right"><span class="labelelement">Request Date :</span></td>
                    <td>
                        <input type="text" name="requestdate" id="requestdate" value="<?php echo $pr->requestdate ?>"/>
                        <script type="text/javascript" >
                            $(function () {
                                $("#requestdate").datepicker();
                            });
                        </script>
                    </td>
                    <td>&nbsp;</td>
                    <td align="right"><label class="labelelement">MR Number :</label></td>
                    <td><input type="text" name="mrnumber" id="mrnumber" value="<?php echo $pr->mrnumber ?>" size="10" readonly=""/>&nbsp;<img src="images/list.png" class="miniaction" onclick="pr_dialogsearchpr('mrnumber')"/></td>
                </tr>
                <tr>
                    <td align="right"><span class="labelelement">Dept. (Request By) :</span></td>
                    <td>
                        <select id="departmentid" name="departmentid">
                            <option value="0">--Department--</option>
                            <?php
                            foreach ($department as $result) {
                                if ($result->id == $pr->departmentid) {
                                    echo "<option value='" . $result->id . "' selected>" . $result->code . "</option>";
                                } else {
                                    echo "<option value='" . $result->id . "'>" . $result->code . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td>&nbsp;</td>         
                    <td align="right"><span class="labelelement">Remark :</span></td>
                    <td rowspan="2"><textarea cols="20" id="remark"><?php echo $pr->remark ?></textarea></td>                
                </tr>
                <tr>
                    <td align="right"><span class="labelelement">End User :</span></td>
                    <td>
                        <select id="enduser" name="enduser">
                            <option value="0">--Department--</option>
                            <?php
                            foreach ($department as $result) {
                                if ($result->id == $pr->enduser) {
                                    echo "<option value='" . $result->id . "' selected>" . $result->code . "</option>";
                                } else {
                                    echo "<option value='" . $result->id . "'>" . $result->code . "</option>";
                                }
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
                        <table width="100%" class="tablesorter">
                            <thead>
                                <tr>
                                    <th width="20%">Code</th>                                
                                    <th width="30%">Description</th>
                                    <th width="10%">MOQ</th>
                                    <th width="10%">Qty</th>
                                    <th width="10%">Unit</th>
                                    <th width="10%">Action</th>    
                                </tr>
                            </thead>
                            <tbody id="prtablebody">
                                <?php
                                if (!empty($pritem)) {
                                    $counter = 0;
                                    foreach ($pritem as $resultpritem) {
                                        ?>
                                        <tr valign="top">
                                            <td>
                                                <input type="hidden" name="pritemid[]" id="pritemid<?php echo $resultpritem->id; ?>" value="<?php echo $resultpritem->id; ?>"/>
                                                <input type="hidden" name="itemid[]" id="itemid<?php echo $resultpritem->id; ?>" value="<?php echo $resultpritem->itemid; ?>"/>
                                                <input type="text" name="partnumber[]" id="partnumber<?php echo $resultpritem->id; ?>"  style="width: 90%" readonly="" value="<?php echo $resultpritem->itempartnumber; ?>"> 
                                                <!--<img src="images/list.png" onclick="item_listSearch(<?php echo $resultpritem->id; ?>)" class="miniaction"/>-->                                            
                                            </td>
                                            <td><textarea style="width: 100%; height: 40px;" readonly="" name="desciption[]" id="description<?php echo $resultpritem->id; ?>"><?php echo strip_tags($resultpritem->itemdescription); ?></textarea></td>
                                            <td><input type="text" style="width:100%;text-align: center" name="moq[]" id="moq<?php echo $resultpritem->id; ?>" value="<?php echo $resultpritem->moq; ?>" readonly=""/></td>
                                            <td><input type="text" name="qty[]" id="qty<?php echo $resultpritem->id; ?>" value="<?php echo $resultpritem->qty; ?>" size="5" style="text-align: center;width: 100%"> </td>
                                            <td>                                            
                                                <select name="unit[]" id="unitid<?php echo $resultpritem->id; ?>" style="width: 100%">
                                                    <?php
                                                    echo $this->model_item->getUnitSelected($resultpritem->itemid, $resultpritem->unitid);
                                                    ?>                                        
                                                </select>
                                            </td>                                        
                                            <td width="5">
                                                <a href="javascript:void(0)" onclick="pr_deleteitem2(this,<?php echo $resultpritem->id; ?>)">
                                                    <img src="images/delete.png" style="cursor: pointer"/> Delete
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        $counter++;
                                    }
                                } else {
                                    
                                }
                                ?>
                            </tbody>
                        </table>
                        <!--<button onclick="pr_additem2()" style="margin-top: 5px;">Add Item</button>-->
                    </td>        
                </tr>        
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>            
<!--                <tr>
                    <td colspan="5" align="center">
                        <br/>
                        <button onclick="pr_update()">Update</button>
                        <button onclick="pr_edit(<?php echo $pr->id ?>)">Reset</button>
                        <button onclick="$('#dialog_temp').dialog('close')">Cancel</button>
                        <br/>
                    </td>
                </tr>-->
            </table>
        </form>
    </div>
</center>