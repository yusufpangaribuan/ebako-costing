<center>
    <div class="panel" style="width: 900px">
        <script>
            function checkRow(elm) {
                console.log(elm);
                if ($(elm).is(':checked')) {
                    $(elm).closest('tr').attr("is_mr_checked", 'true');
                } else {
                    $(elm).closest('tr').attr("is_mr_checked", 'false');
                }
            }
        </script>
        <form id="create_from_requisition_form" onsubmit="return false;">
            <table align="center" width="100%" border="0">
                <tr>
                    <td width="100%">
                        <table width="100%" border="0">
                            <tr valign="top">
                                <td width="50%">
                                    <table width="100%">
                                        <tr>
                                            <td width="30%" align="right"><label class="labelelement">Request Date :</label></td>
                                            <td width="70%">
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
                                        </tr>
                                        <tr>
                                            <td align="right"><span class="labelelement">Req For Department :</span></td>
                                            <td>
                                                <select id="departmentid" name="departmentid">
                                                    <option value="0">--Department--</option>
                                                    <?php
                                                    foreach ($department as $result) {
                                                        if ($result->id == $mat_req->departmentid) {
                                                            echo "<option value='" . $result->id . "' selected>" . $result->code . "</option>";
                                                        } else {
                                                            echo "<option value='" . $result->id . "'>" . $result->code . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="50%">
                                    <table width="100%">
                                        <tr>
                                            <td width="30%" align="right"><label class="labelelement">MR No :</label></td>
                                            <td width="70%">
                                                <input type="hidden" name="mat_req_id" id="mat_req_id" value="<?php echo $mat_req->id ?>"/>
                                                <input type="text" name="mrnumber" id="mrnumber" value="<?php echo $mat_req->number ?>" style="width: 75%"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label class="labelelement">SO No :</label></td>
                                            <td><input type="text" name="sonumber" id="sonumber" value="" style="width: 75%"/></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>                   
                    </td>        
                </tr>

                <tr valign="top">
                    <td>
                        <br/><br/>
                        <!--                    <button onclick="pr_choose_from_order_recommendation()" style="float: right;margin-bottom: 3px;">Choose From Order Recommendation</button>-->
                        <table width="100%" class="tablesorter2">
                            <thead>
                                <tr>
                                    <th width="2%"><input type="checkbox" id="pr_check_813" onclick="pr_check_uncheck_all(this)"/></th>   
                                    <th width="20%">Code</th>                                
                                    <th width="38%">Description</th>
                                    <th width="10%">MoQ</th>
                                    <th width="10%">Qty</th>
                                    <th width="10%">Unit</th>
                                    <th width="2%">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody id="prtablebody">
                                <?php
                                foreach ($mat_req_detail as $result) {
                                    ?>
                                    <tr valign="top" is_mr_checked="false">
                                        <td>
                                            <input type="checkbox" onclick="checkRow(this);" name="mr_checked" value="<?php echo $result->id ?>"/>
                                        </td>
                                        <td>
                                            <input type="hidden" name="itemid" id="itemid<?php echo $result->id ?>" value="<?php echo $result->itemid ?>"/>
                                            <input type="text" name="partnumber" id="partnumber<?php echo $result->id ?>" style="width: 100%" readonly="" value="<?php echo $result->item_code ?>"><br/>                                        
                                        </td>
                                        <td><textarea style="width: 100%; height: 50px;" name="description" id="description<?php echo $result->id ?>" readonly=""><?php echo str_replace('<br />', '', $result->item_description) ?></textarea></td>
                                        <td><input type="text" style="width:100%;text-align: center" name="moq" id="moq<?php echo $result->id ?>" readonly="" value="<?php echo $result->moq ?>"/></td>
                                        <td><input type="text" name="qty" id="qty<?php echo $result->id ?>" value="<?php echo $result->ots_qty ?>" size="5" style="text-align: center; width: 100%;" onblur="if ($(this).val() == '' || $(this).val() == '0' || isNaN($(this).val())) {
                                                        alert('Required NUMBER and Not Allow 0 or NULL');
                                                        $(this).val(1)
                                                    }"></td>
                                        <td>
                                            <select name="unitid" id="unitid<?php echo $result->id ?>" style="width: 100%">
                                                <option value="<?php echo $result->unitid ?>"><?php echo $result->unit_code ?></option>
                                                <?php
//                                            $unit = $this->model_unit->selectAllUnitByItemId($result->itemid);
//                                            foreach ($unit as $unit) {
//                                                if ($unit->id == $result->unitid) {
//                                                    echo "<option value='" . $unit->id . "' selected>" . $unit->codes . "</option>";
//                                                } else {
//                                                    echo "<option value='" . $unit->id . "'>" . $unit->codes . "</option>";
//                                                }
//                                            }
                                                ?>                                            
                                            </select>
                                        </td>                                
                                        <td>&nbsp;</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>                    
                    </td>        
                </tr>
                <tr>
                    <td width="100%">
                        <table width="100%">
                            <tr>
                                <td width="100" align="right"><label class="labelelement">Remark : </label></td>
                                <td><textarea id="remark" name="remark" style="width: 100%"></textarea></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</center>
