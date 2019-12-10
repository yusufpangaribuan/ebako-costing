<div style="width: 800px;padding: 5px" class="panel2">
    <form id="servicerequest_edit_form" onsubmit="return false;">
        <table width="100%" border="0">
            <tr>
                <td width="15%"><strong>SR NO</strong></td>
                <td width="1%"><strong>:</strong></td>
                <td width="84%">
                    <input type="hidden" name="id" value="<?php echo $servicerequest->id ?>" />
                    <input type="text" name="srno" value="<?php echo $servicerequest->number ?>" required=""/>
                </td>
            </tr>
            <tr>
                <td><strong>Date</strong></td>
                <td><strong>:</strong></td>
                <td>
                    <script type="text/javascript" >
                        $(function () {
                            $("#sr_date").datepicker({
                                dateFormat: "yy-mm-dd"
                            }).focus(function () {
                                $("#sr_date").datepicker("show");
                            });
                        });
                    </script>
                    <input type="text" name="date" id="sr_date" readonly="" value="<?php echo $servicerequest->date ?>"/>
                </td>
            </tr>
            <tr>
                <td><strong>End user</strong></td>
                <td><strong>:</strong></td>
                <td>
                    <select name="enduser" style="width: 200px" required="true">
                        <option></option>
                        <?php
                        foreach ($subdepartment as $result) {
                            if ($result->id == $servicerequest->enduser) {
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
                <td><strong>Must Receive At</strong></td>
                <td><strong>:</strong></td>
                <td>
                    <script type="text/javascript" >
                        $(function () {
                            $("#mat_req_must_receive_date").datepicker({
                                dateFormat: "yy-mm-dd"
                            }).focus(function () {
                                $("#mat_req_must_receive_date").datepicker("show");
                            });
                        });
                    </script>
                    <input type="text" name="must_receive_date" id="mat_req_must_receive_date" readonly="" value="<?php echo $servicerequest->must_receive_date ?>"/>
                </td>
            </tr>
            <tr>
                <td><strong>Reason requirement</strong></td>
                <td><strong>:</strong></td>
                <td><textarea id="remark" name="reason_requirement" style="width: 400px;height: 40px"><?php echo $servicerequest->reason_requirement ?></textarea></td>                
            </tr>
        </table>
        <br/>
        <table width="100%" class="tablesorter2">
            <thead>
                <tr>
                    <th width="25%">Item Source</th>                                
                    <th width="25%">Item Target</th>
                    <th width="20%">Service Description</th>
                    <th width="5%">Qty</th>
                    <th width="15%">Action</th>
                </tr>
            </thead>
            <tbody id="servicerequesttablebody">
                <?php $sr->reload_item($servicerequest->id); ?>
            </tbody>
        </table>
        <button onclick="servicerequest_additem(<?php echo $servicerequest->id ?>)"  type="button" style="margin-top: 3px;">Add Item</button>
        <br/>
        <table>
            <tr>
                <td colspan="2" align="center"><strong>Approval</strong></td>
            </tr>
            <tr>
                <td align="right"><strong>Approval 1 :</strong></td>
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
                    <input id="id1" type="hidden" name="approval1" required="true" value="<?php echo (empty($servicerequest->approval1) ? "" : $servicerequest->approval1) ?>">
                    <input id="name-apprvove1" name="name_approval1" type="text" value="<?php echo (empty($servicerequest->approval1) ? "" : $servicerequest->name_approval1) ?>">
                    <button onclick="pr_selectApproval(1)" type="button">Select</button>
                    <button onclick="pr_clearApproval(1)" type="button">Clear</button>
                </td>
            </tr>
            <tr>
                <td align="right"><strong>Approval 2 :</strong></td>
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
                    <input id="id2" type="hidden" name="approval2" required="true" value="<?php echo (empty($servicerequest->approval2) ? "" : $servicerequest->approval2) ?>">
                    <input id="name-apprvove2" name="name_approval2" type="text" value="<?php echo (empty($servicerequest->approval2) ? "" : $servicerequest->name_approval2) ?>">
                    <button onclick="pr_selectApproval(2)" type="button">Select</button>
                    <button onclick="pr_clearApproval(2)" type="button">Clear</button>
                </td>
            </tr>
        </table>
    </form>
</div>
<script>
// just for the demos, avoids form submit
    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });
    $("#servicerequest_edit_form").validate({
        ignore: 'hidden',
        rules: {
            enduser: {
                required: true
            }
        }
    });
</script>