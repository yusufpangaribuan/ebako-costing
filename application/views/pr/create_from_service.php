<div class="panel" style="width: 700px;padding: 2px;">
    <form id="create_from_service_form" onsubmit="return false;">
        <table width="50%">
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
                    <input type="text" name="date" id="requestdate" readonly="" value="<?php echo date('Y-m-d') ?>" style="text-align: center"/>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="labelelement">Remark : </label></td>
                <td><textarea id="remark" name="remark" style="width: 100%"></textarea></td>
            </tr>
        </table>
        <br/>
        <table width="100%" class="tablesorter2">
            <thead>
                <tr>
                    <th width="4%"><input type="checkbox" id="pr_check_813" onclick="pr_check_uncheck_all(this)" value="zxc"/></th>   
                    <th width="20%">Code</th>                                
                    <th width="38%">Description</th>
                    <th width="10%">MoQ</th>
                    <th width="10%">Qty</th>
                    <th width="10%">Unit</th>
                </tr>
            </thead>
            <tbody id="prtablebody">
                <?php
                foreach ($sr_detail as $result) {
                    ?>
                    <tr valign="top">
                        <td align="center">
                            <input type="checkbox" name="mr_checked[]" value="<?php echo $result->id ?>"/>
                        </td>
                        <td>
                            <input type="hidden" name="itemid[]" id="itemid<?php echo $result->id ?>" value="<?php echo $result->target_itemid ?>"/>
                            <input type="text" name="partnumber[]" id="partnumber<?php echo $result->id ?>" style="width: 100%" readonly="" value="<?php echo $result->target_item_code ?>"><br/>                                        
                        </td>
                        <td><input type="text" style="width: 100%;" name="description[]" id="description<?php echo $result->id ?>" readonly="" value="<?php echo $result->target_item_description ?>"/></td>
                        <td><input type="text" style="width:100%;text-align: center" name="moq[]" id="moq<?php echo $result->id ?>" readonly="" value="<?php echo $result->moq ?>"/></td>
                        <td><input type="text" name="qty[]" id="qty<?php echo $result->id ?>" value="<?php echo $result->ots_qty ?>" size="5" style="text-align: center; width: 100%;" onblur="if ($(this).val() === '' || $(this).val() === '0' || isNaN($(this).val())) {
                                        alert('Required NUMBER and Not Allow 0 or NULL');
                                        $(this).val(1);
                                    }"></td>
                        <td>
                            <select name="unitid[]" id="unitid<?php echo $result->id ?>" style="width: 100%">
                                <option value="<?php echo $result->target_unitid ?>"><?php echo $result->target_unit_code ?></option>
                            </select>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>
</div>
</center>