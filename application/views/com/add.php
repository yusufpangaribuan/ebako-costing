<center>
    <div class="panel" style="width: 800px;margin-right: 10px;">
        <form id="com_form_input" onsubmit="return false">
            <table align="center" width="100%" border="0">
                <tr>
                    <td width="20%"><label class="labelelement">Date</label></td>
                    <td widh="1%"><label class="labelelement">:</label></td>
                    <td width="79%">
                        <input type="text" name="date" id="com_date" required="true" readonly="" value="<?php echo date('Y-m-d') ?>" size="12"/>
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
                                echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label class="labelelement">AWB NO</label></td>
                    <td><label class="labelelement">:</label></td>
                    <td><input type="text" name="awb" style="width: 20%"></td>
                </tr>
                <tr>
                    <td><label class="labelelement">Via</label></td>
                    <td><label class="labelelement">:</label></td>
                    <td><input type="text" name="via" style="width: 20%"></td>
                </tr>
                <tr>
                    <td><label class="labelelement">Delivered By</label></td>
                    <td><label class="labelelement">:</label></td>
                    <td><input type="text" name="sent_by" style="width: 30%"></td>
                </tr>
                <tr>
                    <td><label class="labelelement">Acknowledge By</label></td>
                    <td><label class="labelelement">:</label></td>
                    <td><input type="text" name="acknowledge_by" style="width: 30%"></td>
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
                                    <td><textarea style="width: 100%; height: 25px;" name="reason[]" id="reason0"></textarea></td>
                                    <td width="5"><img src="images/delete.png" style="cursor: pointer" onclick="pr_deleteitem(this)"/></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" onclick="com_additem()" style="margin-top: 3px;">Add Item</button>
                    </td>        
                </tr>
            </table>
        </form>
    </div>

</center>