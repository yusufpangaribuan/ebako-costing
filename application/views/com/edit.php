<center>
    <div class="panel" style="width: 800px;margin-right: 10px;">
        <form id="com_form_input" onsubmit="return false">
            <table align="center" width="100%" border="0">
                <tr>
                    <td width="20%"><label class="labelelement">Date</label></td>
                    <td widh="1%"><label class="labelelement">:</label></td>
                    <td width="79%">
                        <input type="text" name="date" id="com_date" readonly="" value="<?php echo $com->date ?>" size="12"/>
                        <script type="text/javascript" >
                            $(function () {
                                $("#com_date").datepicker({
                                    dateFormat: "yy-mm-dd"
                                }).focus(function () {
                                    $("#com_date").datepicker("show");
                                });
                            });
                        </script>
                    </td>
                </tr>
                <tr>
                    <td><label class="labelelement">Customer</label></td>
                    <td><label class="labelelement">:</label></td>
                    <td>
                        <select name="customerid" style="width: 200px;">
                            <option value="0">--Customer--</option>
                            <?php
                            foreach ($customer as $result) {
                                if ($result->id == $com->customerid) {
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
                    <td><label class="labelelement">AWB NO</label></td>
                    <td><label class="labelelement">:</label></td>
                    <td><input type="text" name="awb" style="width: 20%" value="<?php echo $com->awb?>"></td>
                </tr>
                <tr>
                    <td><label class="labelelement">Via</label></td>
                    <td><label class="labelelement">:</label></td>
                    <td><input type="text" name="via" style="width: 20%" value="<?php echo $com->via?>"></td>
                </tr>
                <tr>
                    <td><label class="labelelement">Delivered By</label></td>
                    <td><label class="labelelement">:</label></td>
                    <td><input type="text" name="sent_by" style="width: 30%" value="<?php echo $com->sent_by?>"></td>
                </tr>
                <tr>
                    <td><label class="labelelement">Acknowledge By</label></td>
                    <td><label class="labelelement">:</label></td>
                    <td><input type="text" name="acknowledge_by" style="width: 30%" value="<?php echo $com->acknowledge_by?>"></td>
                </tr>
                <tr valign="top">
                    <td>
                        <br/>
                        <span class="title">Item List</span>                    
                    </td>        
                </tr>    
                <tr>
                    <td colspan="3">
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
                            <tbody id="com_tablebody">
                                <?php
                                foreach ($comitem as $result) {
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
                                        <td><textarea style="width: 100%; height: 25px;" name="reason[]" id="reason<?php echo $result->id ?>"><?php echo $result->remark ?></textarea></td>
                                        <td width="5"><img src="images/delete.png" style="cursor: pointer" onclick="com_deleteitem(this,<?php echo $result->id ?>)"/></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <button type="button" onclick="com_additem2()" style="margin-top: 3px;">Add Item</button>
                    </td>        
                </tr>
            </table>
        </form>
    </div>
</center>