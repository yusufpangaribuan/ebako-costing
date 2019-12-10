<br/>
<center>
    <div class="panel" style="width: 800px">
        <form id="mr_input_form" onsubmit="return false">
            <table align="center" width="100%" border="0">            
                <tr>
                    <td width="100%">
                        <table width="100%" border="0">
                            <tr valign="top">
                                <td width="50%">
                                    <table width="100%">
                                        <tr>
                                            <td width="30%" align="right"><label class="labelelement">Date : </label></td>
                                            <td width="70%">
    <!--                                            <script type="text/javascript" >
                                                    $(function () {
                                                        $("#date").datepicker({
                                                            dateFormat: "yy-mm-dd"
                                                        }).focus(function () {
                                                            $("#date").datepicker("show");
                                                        });
                                                    });
                                                </script>-->
                                                <input type="text" name="date" id="date" value="<?php echo date('Y-m-d') ?>" size="10" readonly="" style="text-align: center"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label class="labelelement">Request By : </label></td>
                                            <td><input type="text" id="mat_req_request_by" style="width: 90%" readonly="" value="<?php echo $this->model_employee->getNameById($this->session->userdata('id')) ?>"></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label class="labelelement"> Department : </label></td>
                                            <td><input type="text" id="mat_req_department" style="width: 90%" readonly="" value="<?php echo $this->model_department->getNameById($this->session->userdata('department')) ?>"></td>
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
                                <td width="50%">
                                    <table width="100%">
                                        <tr>
                                            <td width="40%" align="right"><label class="labelelement">Must be received on : </label></td>
                                            <td width="60%">
                                                <input type="hidden" id="request_type" value="<?php echo $request_type ?>"/>
                                                <input type="hidden" id="reasonrequirementid" value="<?php echo $request_type ?>"/>
                                                <script type="text/javascript" >
                                                    $(function () {
                                                        $("#datemustreceive").datepicker({
                                                            dateFormat: "yy-mm-dd"
                                                        }).focus(function () {
                                                            $("#datemustreceive").datepicker("show");
                                                        });
                                                    });
                                                </script>
                                                <input type="text" name="datemustreceive" id="datemustreceive" readonly="" value="<?php echo date('Y-m-d') ?>" size="10" style="text-align: center"/>

                                            </td>
                                        </tr>
<!--                                        <tr>
                                            <td align="right"><label class="labelelement">Reason Of Requirement : </label></td>
                                            <td>
                                                <select id="reasonrequirementid" style="width: 70%;">
                                                    <?php
//                                                    foreach ($reasonrequirement as $result) {
//                                                        if ($request_type == 2) {
//                                                            if ($result->id == 2) {
//                                                                echo "<option value='" . $result->id . "'>" . $result->description . "</option>";
//                                                            }
//                                                        } else {
//                                                            if ($result->id != 2) {
//                                                                echo "<option value='" . $result->id . "'>" . $result->description . "</option>";
//                                                            }
//                                                        }
//                                                    }
                                                    ?>
                                                </select>
                                                <input type="hidden" id="request_type" value="<?php echo $request_type ?>"/>
                                            </td>
                                        </tr>-->
                                        <tr valign="top">
                                            <?php
                                            if ($this->session->userdata('department') == 3) {
                                                ?>
                                                <td align="right"><span class="labelelement">SO No. :</span></td>
                                                <td>
                                                    <input type="hidden" id="soid" value="0"/>
                                                    <input type="text" id="sonumber" readonly="true" style="text-align: center"/>&nbsp;
                                                    <img src="images/list.png" class="miniaction" onclick="so_viewonproduction()"/>
                                                </td>       
                                                <?php
                                            } else {
                                                ?>
                                                <td align="right"><span class="labelelement"></span></td>
                                                <td>
                                                    <input type="hidden" id="soid" value="0"/>                        
                                                </td>
                                                <?php
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <td align="right"><label class="labelelement">Withdraw Time : </label></td>
                                            <td>
                                                <select id="batch_time" style="width: 100px">
                                                    <option value="08-10">08-10</option>
                                                    <option value="13-15">13-15</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>                   
                    </td>        
                </tr>
                <tr>
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
                                    <th width="10%">Request To</th>
                                    <th width="20%">Remark</th>
                                    <th>Act</th>
                                </tr>
                            </thead>
                            <tbody id="mrtablebody">
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
                                                        $.get(url + 'item/getwarehouse/' + ui.item.id, function (content) {
                                                            $('#warehouseid0').empty();
                                                            $('#warehouseid0').append(content);
                                                        });
                                                        $('#stock0').load(url + 'item/gettotalstock/' + ui.item.id);
                                                    }
                                                }).data("autocomplete")._renderItem = function (ul, item) {
                                                    return $("<li>")
                                                            .data("item.autocomplete", item)
                                                            .append("<a>" + item.label + "<br>" + item.desc + "</a>")
                                                            .appendTo(ul);
                                                };
                                            });
                                        </script>
                                        <input type="hidden" name="itemid" id="itemid0" value="0"/>
                                        <input type="text" name="partnumber" id="partnumber0" style="width: 85%" >
                                        <img src="images/list.png" onclick="item_listSearch(0)" class="miniaction"/>
                                        <input type="hidden" name="name" id="name0" style="width: 100%"/>
                                    </td>
                                    <td><textarea style="width: 100%; height: 40px;" name="desciption" id="description0" readonly="true"></textarea></td>                                
                                    <td>
                                        <input type="text" name="qty" id="qty0" value="1" size="5" style="text-align: center; width: 100%;" onblur="if ($(this).val() == '' || $(this).val() == '0' || isNaN($(this).val())) {
                                                    alert('Required NUMBER and Not Allow 0 or NULL');
                                                    $(this).val(1)
                                                }">                                     

                                    </td>
                                    <td>
                                        <select name="unitid" id="unitid0" style="width: 100%">
                                            <option value="0">--Unit--</option>
                                        </select>
                                        Stock : <span id="stock0">0</span>
                                    </td>
                                    <td>
                                        <select name="warehouseid" id="warehouseid0" style="width: 100%">
                                            <option value="0"></option>
                                        </select>                                    
                                    </td>
                                    <td><textarea style="width: 100%; height: 40px;" name="reason" id="reason0"></textarea></td>
                                    <td width="5"><img src="images/delete.png" style="cursor: pointer" onclick="pr_deleteitem(this)"/></td>
                                </tr>
                            </tbody>
                        </table>
                        <button onclick="mr_additem()" style="margin-top: 3px;">Add Item</button>
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
                                    <button onclick="pr_selectApproval(1)" type="button">Select</button>
                                    <button onclick="pr_clearApproval(1)" type="button">Clear</button>
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
                                    <button onclick="pr_selectApproval(2)" type="button">Select</button>
                                    <button onclick="pr_clearApproval(2)" type="button">Clear</button>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>   
    <!--            <tr>
                    <td align="center">
                        <br/>
                        <button onclick="mr_save()">Save</button>
                        <button onclick="mr_add()">Reset</button>
                        <button onclick="$('#form_dialog').dialog('close')">Cancel</button>
                        <br/><br/>
                    </td>
                </tr>-->
            </table>
        </form>
    </div>

    <br/>
    <br/>
</center>