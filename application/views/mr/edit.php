<br/>
<center>
    <div class="panel" style="width: 800px">
        <form id="mr_edit_form" onsubmit="return false">
            <table align="center" width="100%" border="0">            
                <tr>
                    <td width="100%">
                        <table width="100%" border="0">
                            <tr valign="top">
                                <td width="50%">
                                    <table width="100%">
                                        <tr>
                                            <td width="30%" align="right"><span class="labelelement">MR NO : </span></td>
                                            <td width="70%">
                                                <input type="hidden" name="id" id="id" value="<?php echo $mr->id ?>" />
                                                <input type="text" name="number" id="number" value="<?php echo $mr->number; ?>" size="25" readonly=""/>
                                            </td>
                                        </tr>
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
                                                <input type="text" name="date" id="date" value="<?php echo $mr->date ?>" size="12" readonly=""/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label class="labelelement">Request By : </label></td>
                                            <td><input type="text" id="mat_req_request_by" style="width: 50%" readonly="" value="<?php echo $this->model_employee->getNameById($this->session->userdata('id')) ?>"></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label class="labelelement"> Department : </label></td>
                                            <td><input type="text" id="mat_req_department" style="width: 60%" readonly="" value="<?php echo $this->model_department->getNameById($this->session->userdata('department')) ?>"></td>
                                        </tr>                                    
                                        <tr>
                                            <td align="right"><span class="labelelement">End User :</span></td>
                                            <td>
                                                <select id="dept_divisionid" name="dept_divisionid" style="width: 150px">
                                                    <option value="0">----</option>
                                                    <?php
                                                    foreach ($devision as $result) {
                                                        if ($result->id == $mr->dept_divisionid) {
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
                                                        if ($result->id == $mr->cost_center_id) {
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
                                                <script type="text/javascript" >
                                                    $(function () {
                                                        $("#datemustreceive").datepicker({
                                                            dateFormat: "yy-mm-dd"
                                                        }).focus(function () {
                                                            $("#datemustreceive").datepicker("show");
                                                        });
                                                    });
                                                </script>
                                                <input type="text" name="datemustreceive" id="datemustreceive" readonly="" value="<?php echo date('Y-m-d') ?>" size="10"/>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label class="labelelement">Reason Of Requirement : </label></td>
                                            <td>
                                                <select id="reasonrequirementid" style="width: 150px;">
                                                    <?php
                                                    foreach ($reasonrequirement as $result) {
                                                        if ($result->id == $mr->reasonrequirementid) {
                                                            echo "<option value='" . $result->id . "' selected>" . $result->description . "</option>";
                                                        } else {
                                                            if ($mr->reasonrequirementid != 2) {
                                                                echo "<option value='" . $result->id . "'>" . $result->description . "</option>";
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <input type="hidden" id="request_type" value="<?php echo $mr->request_type ?>"/>
                                            </td>
                                        </tr>
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
                                            <td align="right"><label class="labelelement"> Withdraw Time : </label></td>
                                            <td>
                                                <select id="batch_time">
                                                    <?php
                                                    if ($mr->batch_time == '08-10') {
                                                        ?>
                                                        <option value="08-10">08-10</option>
                                                        <option value="13-15">13-15</option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <option value="13-15">13-15</option>
                                                        <option value="08-10">08-10</option>                     
                                                        <?php
                                                    }
                                                    ?>
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
                                    <th width="20%">code</th>                                
                                    <th width="30%">Description</th>                        
                                    <th width="10%">Qty</th>
                                    <th width="10%">Unit</th>
                                    <th width="10%">Request To</th>
                                    <th width="20%">Reason of Requirement</th> 
                                    <th>Act</th>
                                </tr>
                            </thead>
                            <tbody id="mrtablebody">
                                <?php
                                foreach ($mrdetail as $result) {
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
                                                            $('#stock<?php echo $result->id ?>').load(url + 'item/gettotalstock/' + ui.item.id);
                                                        }
                                                    }).data("autocomplete")._renderItem = function (ul, item) {
                                                        return $("<li>")
                                                                .data("item.autocomplete", item)
                                                                .append("<a>" + item.label + "<br>" + item.desc + "</a>")
                                                                .appendTo(ul);
                                                    };
                                                });
                                            </script>
                                            <input type="hidden" name="mrdetailid" id="mrdetailid<?php echo $result->id ?>" value="<?php echo $result->id ?>"/>
                                            <input type="hidden" name="itemid" id="itemid<?php echo $result->id ?>" value="<?php echo $result->itemid ?>"/>
                                            <input type="text" name="partnumber" id="partnumber<?php echo $result->id ?>" style="width: 85%" value="<?php echo $result->code ?>">
                                            <img src="images/list.png" onclick="item_listSearch(<?php echo $result->id ?>)" class="miniaction"/>                                        
                                        </td>
                                        <td><textarea style="width: 100%; height: 40px;" name="desciption" id="description<?php echo $result->id ?>" readonly="true"><?php echo $result->descriptions ?></textarea></td>                                
                                        <td><input type="text" name="qty" id="qty0" value="<?php echo $result->qty ?>" size="5" style="text-align: center; width: 100%;"  onblur=" var temp = $(this).val();
                                                if ($(this).val() == '' || $(this).val() == '0' || isNaN($(this).val())) {
                                                    alert('Required NUMBER and Not Allow 0 or NULL');
                                                    $(this).val(temp)
                                                }"> </td>
                                        <td>
                                            <select name="unitid" id="unitid0" style="width: 100%">
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
                                        <td>                                        
                                            <select name="warehouseid" id="warehouseid<?php echo $result->id ?>" style="width: 100%">
                                                <?php
                                                $warehouse_temo25 = $this->model_warehouse->selectAllByItem($result->itemid);
                                                foreach ($warehouse_temo25 as $rst_whs) {
                                                    if ($rst_whs->id == $result->warehouseid) {
                                                        echo "<option value='" . $rst_whs->id . "' selected>" . $rst_whs->warehousename . "</option>";
                                                    } else {
                                                        echo "<option value='" . $rst_whs->id . "'>" . $rst_whs->warehousename . "</option>";
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </td>
                                        <td><textarea style="width: 100%; height: 40px;" name="reason" id="reason0"><?php echo $result->reason ?></textarea></td>
                                        <td width="5"><img src="images/delete.png" style="cursor: pointer" onclick="mr_deleteitem(this,<?php echo $result->id ?>)"/></td>
                                    </tr>

                                    <?php
                                }
                                ?>                            
                            </tbody>
                        </table><br/>
                        <button onclick="mr_additem()">Add Item</button>
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
                                    <input id="id1" type="hidden" name="idapproval[]" value="<?php echo $mr->supervisorapproval ?>">
                                    <input id="name-apprvove1" type="text" <?php echo ($mr->supervisortimeapproved != '') ? 'readonly' : ''; ?> value="<?php echo $mr->supervisor ?>">
                                    <?php
                                    if ($mr->supervisortimeapproved == "") {
                                        ?>
                                        <button onclick="pr_selectApproval(1)">Select</button>
                                        <button onclick="pr_clearApproval(1)">Clear</button>
                                        <?php
                                    } else {
                                        if ($mr->supervisorstatusapproval == 1) {
                                            echo "<span style='color:blue'>Approved at: " . date('d/m/Y H:i:s', strtotime($mr->supervisortimeapproved)) . "</span>";
                                        } else if ($mr->supervisorstatusapproval == 2) {
                                            echo "<span style='color:#e7a75b'>Pending at: " . date('d/m/Y H:i:s', strtotime($mr->supervisortimeapproved)) . "</span>";
                                        } else if ($mr->supervisorstatusapproval == 3) {
                                            echo "<span style='color:red'>Reject at: " . date('d/m/Y H:i:s', strtotime($mr->supervisortimeapproved)) . "</span>";
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><span class="labelelement">Manager :</span></td>
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
                                    <input id="id2" type="hidden" name="idapproval[]" value="<?php echo $mr->managerapproval ?>">
                                    <input id="name-apprvove2" type="text" <?php echo ($mr->managertimeapproved != '') ? 'readonly' : ''; ?> value="<?php echo $mr->manager ?>">
                                    <?php
                                    if ($mr->managertimeapproved == "") {
                                        ?>
                                        <button onclick="pr_selectApproval(2)">Select</button>
                                        <button onclick="pr_clearApproval(2)">Clear</button>
                                        <?php
                                    } else {
                                        if ($mr->managerstatusapproval == 1) {
                                            echo "<span style='color:blue'>Approved at: " . date('d/m/Y H:i:s', strtotime($mr->managertimeapproved)) . "</span>";
                                        } else if ($mr->managerstatusapproval == 2) {
                                            echo "<span style='color:#e7a75b'>Pending at: " . date('d/m/Y H:i:s', strtotime($mr->managertimeapproved)) . "</span>";
                                        } else if ($mr->managerstatusapproval == 3) {
                                            echo "<span style='color:red'>Reject at: " . date('d/m/Y H:i:s', strtotime($mr->managertimeapproved)) . "</span>";
                                        }
                                        //echo "<span style='color:blue'>Approved at: " . date('d/m/Y H:i:s', strtotime($mr->managertimeapproved)) . "</span>";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <br/>
    <br/>
</center>