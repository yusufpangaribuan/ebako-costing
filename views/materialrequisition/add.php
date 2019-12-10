<center>
    <div class="panel" style="width: 800px">
        <table align="center" width="100%" border="0">            
            <tr>
                <td width="100%" valign="top">
                    <table width="100%" border="0">
                        <tr>
                            <td width="50%">
                                <table width="100%">
                                    <tr>
                                        <td width="30%" align="right"><label class="labelelement">Date : </label></td>
                                        <td width="70%">
                                            <input type="text" name="date" id="mat_req_date" readonly="" value="<?php echo date('Y-m-d') ?>" size="20"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right"><label class="labelelement">Request By : </label></td>
                                        <td><input type="text" id="mat_req_request_by" style="width: 100%" readonly="" value="<?php echo $this->model_employee->getNameById($this->session->userdata('id')) ?>"></td>
                                    </tr>
                                    <tr>
                                        <td align="right"><label class="labelelement"> Department : </label></td>
                                        <td><input type="text" id="mat_req_department" style="width: 100%" readonly="" value="<?php echo $this->model_department->getNameById($this->session->userdata('department')) ?>"></td>
                                    </tr>
                                    <tr>
                                        <td align="right"><span class="labelelement">End User :</span></td>
                                        <td>
                                            <select id="dept_divisionid" name="dept_divisionid" style="width: 150px">
                                                <option value="0">----</option>
                                                <?php
                                                foreach ($devision as $result) {
                                                    if ($result->id == $this->session->userdata('subdepartmentid')) {
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
                                                    if ($result->id == $this->session->userdata('costcenterid')) {
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
                                            <input type="text" name="must_receive_date" id="mat_req_must_receive_date" readonly="" value="<?php echo date('Y-m-d') ?>" size="10" style="text-align: center"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right"><label class="labelelement">Reason Of Requirement : </label></td>
                                        <td><textarea id="mat_req_reason_requirement" style="width: 100%;height: 40px"></textarea></td>
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
                                <th width="20%">Item Code</th>                                
                                <th width="30%">Item Description</th>                        
                                <th width="10%">Qty</th>
                                <th width="10%">Unit</th>
                                <th width="30%">Remark</th>      
                                <th>Act</th>
                            </tr>
                        </thead>
                        <tbody id="mat_req_tablebody">
                            <tr valign="top">
                                <td>
                                    <script>
                                        $(function () {
                                            $("#partnumber0").autocomplete({
                                                source: url + 'item/search_autocomplete',
                                                minLength: 2,
                                                select: function (event, ui) {
                                                    $("#partnumber0").val(ui.item.label);
                                                    $("#itemid0").val(ui.item.id);
                                                    $("#description0").val(ui.item.desc);
                                                    $('#unitid0').empty();
                                                    $('#unitid0').append(ui.item.all_unit);
                                                }
                                            }).data("autocomplete")._renderItem = function (ul, item) {
                                                return $("<li>")
                                                        .data("item.autocomplete", item)
                                                        .append("<a>" + item.label + "<br>" + item.desc + "</a>")
                                                        .appendTo(ul);
                                            };
                                        });
                                    </script>
                                    <input type="hidden" name="itemid[]" id="itemid0" value="0"/>
                                    <input type="text" name="partnumber[]" id="partnumber0" style="width: 85%" >
                                    <img src="images/list.png" onclick="item_listSearch(0)" class="miniaction"/>
                                    <input type="hidden" name="name[]" id="name0" style="width: 100%"/>
                                </td>
                                <td><textarea style="width: 100%; height: 40px;" name="desciption[]" id="description0" readonly="true"></textarea></td>                                
                                <td>
                                    <input type="text" name="qty[]" id="qty0" value="1" size="5" style="text-align: center; width: 100%;" onblur="if ($(this).val() == '' || $(this).val() == '0' || isNaN($(this).val())) {
                                                alert('Required NUMBER and Not Allow 0 or NULL');
                                                $(this).val(1)
                                            }">                                     

                                </td>
                                <td>
                                    <select name="unitid[]" id="unitid0" style="width: 100%">
                                        <option value="0">--Unit--</option>
                                    </select>                                    
                                </td>
                                <td><textarea style="width: 100%; height: 40px;" name="reason[]" id="reason0"></textarea></td>
                                <td width="5"><img src="images/delete.png" style="cursor: pointer" onclick="pr_deleteitem(this)"/></td>
                            </tr>
                        </tbody>
                    </table>
                    <button onclick="materialrequisition_additem()" style="margin-top: 3px;">Add Item</button>
                </td>        
            </tr>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td colspan="2" align="center"><span class="labelelement">Approval</span></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Approval 1 :</span></td>
                            <td>
                                <script>
                                    $(function () {
                                        $("#name-apprvove1").autocomplete({
                                            source: url + 'employee/search_autocomplete',
                                            minLength: 2,
                                            select: function (event, ui) {
                                                $("#name-apprvove1").val(ui.item.label);
                                                $("#id1").val(ui.item.id);

                                            }
                                        }).data("autocomplete")._renderItem = function (ul, item) {
                                            return $("<li>")
                                                    .data("item.autocomplete", item)
                                                    .append("<a>" + item.label + "<br>" + item.desc + "</a>")
                                                    .appendTo(ul);
                                        };
                                    });
                                </script>

                                <input id="id1" type="hidden" name="idapproval[]" value="<?php echo (empty($approval) ? "" : $approval->supervisorapproval) ?>">
                                <input id="name-apprvove1" type="text" value="<?php echo (empty($approval) ? "" : $approval->supervisorname) ?>">
                                <button onclick="pr_selectApproval(1)">Select</button>
                                <button onclick="pr_clearApproval(1)">Clear</button>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Approval 2 :</span></td>
                            <td>
                                <script>
                                    $(function () {
                                        $("#name-apprvove2").autocomplete({
                                            source: url + 'employee/search_autocomplete',
                                            minLength: 2,
                                            select: function (event, ui) {
                                                $("#name-apprvove2").val(ui.item.label);
                                                $("#id2").val(ui.item.id);

                                            }
                                        }).data("autocomplete")._renderItem = function (ul, item) {
                                            return $("<li>")
                                                    .data("item.autocomplete", item)
                                                    .append("<a>" + item.label + "<br>" + item.desc + "</a>")
                                                    .appendTo(ul);
                                        };
                                    });
                                </script>
                                <input id="id2" type="hidden" name="idapproval[]" value="<?php echo (empty($approval) ? "" : $approval->managerapproval) ?>">
                                <input id="name-apprvove2" type="text" value="<?php echo (empty($approval) ? "" : $approval->managername) ?>">
                                <button onclick="pr_selectApproval(2)">Select</button>
                                <button onclick="pr_clearApproval(2)">Clear</button>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
<!--            <tr>
                <td  align="center">
                    <br/>
                    <button onclick="materialrequisition_save()">Save</button>
                    <button onclick="$('#form_dialog').dialog('close');">Cancel</button>
                    <br/><br/>
                </td>
            </tr>-->
        </table>
    </div>

</center>