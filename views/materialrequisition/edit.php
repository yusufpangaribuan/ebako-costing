<center>
    <div style="width: 800px;padding: 5px;">
        <div class="panel" style="width: 100%;">
            <table align="center" width="100%" border="0">            
                <tr>
                    <td width="100%">
                        <table width="100%" border="0">
                            <tr>
                                <td width="50%">
                                    <table width="100%">
                                        <tr>
                                            <td width="30%" align="right"><label class="labelelement">Date : </label></td>
                                            <td width="70%">
<!--                                                <script type="text/javascript" >
                                                    $(function () {
                                                        $("#mat_req_date").datepicker({
                                                            dateFormat: "yy-mm-dd"
                                                        }).focus(function () {
                                                            $("#mat_req_date").datepicker("show");
                                                        });
                                                    });
                                                </script>-->
                                                <input type="hidden" name="id" id="mat_req_id" value="<?php echo $mat_req->id ?>" />
                                                <input type="text" name="date" id="mat_req_date" readonly="" value="<?php echo $mat_req->date; ?>" size="20"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label class="labelelement">Request By : </label></td>
                                            <td><input type="text" id="mat_req_request_by" style="width: 100%" value="<?php echo $mat_req->employee_request_by; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label class="labelelement"> Department : </label></td>
                                            <td><input type="text" id="mat_req_department" value="<?php echo $mat_req->departmentname; ?>" style="width: 100%"></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><span class="labelelement">End User :</span></td>
                                            <td>
                                                <select id="dept_divisionid" name="dept_divisionid" style="width: 150px">
                                                    <option value="0">----</option>
                                                    <?php
                                                    foreach ($devision as $result) {
                                                        if ($result->id == $mat_req->dept_divisionid) {
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
                                                <select id="cost_center_id" name="cost_center_id" style="width: 150px">
                                                    <option value="0">----</option>
                                                    <?php
                                                    foreach ($costcenter as $result) {
                                                        if ($result->id == $mat_req->cost_center_id) {
                                                            echo "<option value='" . $result->id . "' selected>" . $result->code . "-" . $result->description . "</option>";
                                                        } else {
                                                            echo "<option value='" . $result->id . "'>" . $result->code . "-" . $result->description . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="50%" valign="top">
                                    <table width="100%">
                                        <tr>
                                            <td width="30%" align="right"><label class="labelelement">Must Receive At : </label></td>
                                            <td width="70%">
                                                <script type="text/javascript" >
                                                    $(function () {
                                                        $("#mat_req_must_receive_date").datepicker({
                                                            dateFormat: "yy-mm-dd"
                                                        }).focus(function () {
                                                            $("#mat_req_must_receive_date").datepicker("show");
                                                        });
                                                    });
                                                </script>
                                                <input type="text" name="must_receive_date" id="mat_req_must_receive_date" readonly="" value="<?php echo $mat_req->must_receive_date ?>" size="10" style="text-align: center"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label class="labelelement">Reason Of Requirement : </label></td>
                                            <td><textarea id="mat_req_reason_requirement" style="width: 100%;height: 40px"><?php echo $mat_req->reason_requirement ?></textarea></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>                   
                    </td>        
                </tr>
                <tr valign="top">
                    <td>
                        <br/>
                        <span class="title">Item List</span>                    
                    </td>        
                </tr>    
                <tr>
                    <td>
                        <table width="100%" class="tablesorter">
                            <thead>
                                <tr>
                                    <th width="20%">Code</th>                                
                                    <th width="30%">Description</th>                        
                                    <th width="10%">Qty</th>
                                    <th width="10%">Unit</th>
                                    <th width="30%">Remark</th>
                                    <th>Act</th>
                                </tr>
                            </thead>
                            <tbody id="mat_req_tablebody">
                                <?php
                                foreach ($mat_req_detail as $result) {
                                    ?>
                                    <tr valign="top">
                                        <td>
                                            <script>
                                                $(function () {
                                                    $("#partnumber<?php echo $result->id ?>").autocomplete({
                                                        source: url + 'item/search_autocomplete',
                                                        minLength: 2,
                                                        select: function (event, ui) {
                                                            $("#partnumber<?php echo $result->id ?>").val(ui.item.label);
                                                            $("#itemid<?php echo $result->id ?>").val(ui.item.id);
                                                            $("#description<?php echo $result->id ?>").val(ui.item.desc);
                                                            $('#unitid<?php echo $result->id ?>').empty();
                                                            $('#unitid<?php echo $result->id ?>').append(ui.item.all_unit);
                                                            $.get(url + 'item/getwarehouse/' + ui.item.id, function (content) {
                                                                $('#warehouseid<?php echo $result->id ?>').empty();
                                                                $('#warehouseid<?php echo $result->id ?>').append(content);
                                                            });
                                                        }
                                                    }).data("autocomplete")._renderItem = function (ul, item) {
                                                        return $("<li>")
                                                                .data("item.autocomplete", item)
                                                                .append("<a>" + item.label + "<br>" + item.desc + "</a>")
                                                                .appendTo(ul);
                                                    };
                                                });
                                            </script>
                                            <input type="hidden" name="mrdetailid[]" id="mrdetailid<?php echo $result->id ?>" value="<?php echo $result->id ?>"/>
                                            <input type="hidden" name="itemid[]" id="itemid<?php echo $result->id ?>" value="<?php echo $result->itemid ?>"/>
                                            <input type="text" name="partnumber[]" id="partnumber<?php echo $result->id ?>" style="width: 85%" value="<?php echo $result->item_code ?>">
                                            <img src="images/list.png" onclick="item_listSearch(<?php echo $result->id ?>)" class="miniaction"/>                                        
                                        </td>
                                        <td><textarea style="width: 100%; height: 40px;" name="desciption[]" id="description<?php echo $result->id ?>" readonly="true"><?php echo str_replace('<br />', '', $result->item_description) ?></textarea></td>                                
                                        <td><input type="text" name="qty[]" id="qty0" value="<?php echo $result->qty ?>" size="5" style="text-align: center; width: 100%;"  onblur=" var temp = $(this).val();
                                                    if ($(this).val() == '' || $(this).val() == '0' || isNaN($(this).val())) {
                                                        alert('Required NUMBER and Not Allow 0 or NULL');
                                                        $(this).val(temp)
                                                    }"> </td>
                                        <td>
                                            <select name="unitid[]" id="unitid<?php echo $result->id ?>" style="width: 100%">
                                                <?php
                                                $unit = $this->model_unit->selectAllUnitByItemId($result->itemid);
                                                foreach ($unit as $unit) {
                                                    if ($unit->id == $result->unitid) {
                                                        echo "<option value='" . $unit->id . "' selected>" . $unit->codes . "</option>";
                                                    } else {
                                                        echo "<option value='" . $unit->id . "'>" . $unit->codes . "</option>";
                                                    }
                                                }
                                                ?>                                            
                                            </select>
                                        </td>       
                                        <td><textarea style="width: 100%; height: 40px;" name="reason[]" id="reason<?php echo $result->id ?>"><?php echo $result->remark ?></textarea></td>
                                        <td width="5"><img src="images/delete.png" style="cursor: pointer" onclick="mat_req_deleteitem(this,<?php echo $result->id ?>)"/></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <button onclick="materialrequisition_additem2()" style="margin-top: 3px;">Add Item</button>
                    </td>        
                </tr>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td colspan="2" align="center"><span class="labelelement">Approval</span></td>
                            </tr>
                            <tr>
                                <td align="right"><span class="labelelement">Supervisor :</span></td>
                                <td>
                                    <input id="id1" type="hidden" name="idapproval[]" value="<?php echo (empty($mat_req->supervisorapproval) ? "" : $mat_req->supervisorapproval) ?>">
                                    <input id="name-apprvove1" type="text" readonly="" value="<?php echo (empty($mat_req->supervisor) ? "" : $mat_req->supervisor) ?>">
                                    <button onclick="pr_selectApproval(1)">Select</button>
                                    <button onclick="pr_clearApproval(1)">Clear</button>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><span class="labelelement">Manager :</span></td>
                                <td>
                                    <input id="id2" type="hidden" name="idapproval[]" value="<?php echo (empty($mat_req->managerapproval) ? "" : $mat_req->managerapproval) ?>">
                                    <input id="name-apprvove2" type="text" readonly="" value="<?php echo (empty($mat_req->manager) ? "" : $mat_req->manager) ?>">
                                    <button onclick="pr_selectApproval(2)">Select</button>
                                    <button onclick="pr_clearApproval(2)">Clear</button>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
<!--                <tr>
                    <td  align="center">
                        <br/>
                        <button onclick="materialrequisition_update()">Save</button>
                        <button onclick="$('#form_dialog').dialog('close');">Cancel</button>
                        <br/><br/>
                    </td>
                </tr>-->
            </table>
        </div>
    </div>
</center>