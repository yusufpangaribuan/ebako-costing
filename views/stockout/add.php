<br/>
<center>
    <div class="panel" style="width: 70%">
        <h4>Create Stock Out</h4>
        <table align="center" width="100%" border="0">            
            <tr>
                <input type="hidden" name="mrid" id="mrid" value="0" />
                <input type="hidden" name="flagstockout" id="flagstockout" value="1" />
                <td colspan="5" align="center">&nbsp;</td>
            </tr>    
            <tr>
                <td width="20%"><span class="labelelement">Stock Out No.</span></td>
                <td width="20%"><input type="text" name="number" id="number" value="<?php echo $this->model_stockout->getNextNumber()?>" size="11" style="text-align: center;" readonly=""/></td>
                <td width="30%">&nbsp;</td>
                <td width="15%"><span class="labelelement">#REF NO.</span></td>
                <td width="15%"><input type="text" name="refno" id="refno" value="" /></td>
            </tr>
            <tr>
                <td><span class="labelelement"><span class="labelelement">Date</span></span></td>
                <td>
                    <script type="text/javascript" >
                        $(function() {
                            $("#date").datepicker({
                                dateFormat: "yy-mm-dd"
                            }).focus(function() {
                                $("#date").datepicker("show");
                            });
                        });
                    </script>
                    <input type="text" name="date" id="date" value="<?php echo date('Y-m-d') ?>" size="10" style="text-align: center" readonly="true"/>
                </td>
                <td>&nbsp;</td>
                <td><span class="labelelement">OUT BY</span></td>
                <td><input type="text" name="outby" id="outby" /> </td>
            </tr>            
            <tr>
                <td><span class="labelelement">Department</span></td>
                <td>
                    <select id="departmentid" name="departmentid">
                        <option value="0">--Department--</option>
                        <?php
                        foreach ($department as $result) {                            
                                echo "<option value='" . $result->id . "'>" . $result->code . "</option>";                            
                        }
                        ?>
                    </select>
                </td>
                <td>&nbsp;</td>
                <td><span class="labelelement">RECEIVE BY</span></td>
                <td><input type="text" name="receiveby" id="receiveby" /> </td>
            </tr>  
            <tr valign="top">
                <td><span class="labelelement">SO NUMBER</span></td>
                <td>
                    <input type="hidden" id="soid" value="0"/>
                    <input type="text" id="sonumber" readonly="true" style="text-align: center" size="20"/>&nbsp;
                    <img src="images/list.png" class="miniaction" onclick="so_viewonproduction()"/>
                </td>                
                <td>&nbsp;</td>
                <td></td>
                <td></td>
            </tr>
            <tr valign="top">
                <td colspan="5">
                    <br/>
                    <table width="100%" class="tablesorter">
                        <thead>
                            <tr>
                                <th width="20%">code</th>                                
                                <th width="40%">Description</th>
                                <th width="20%">Stock</th>
                                <th width="10%">Qty</th>
                                <th width="10%">Unit</th>                                                                    
                            </tr>
                        </thead>
                        <tbody id="stockouttablebody">
                            <tr valign="top">
                                <td>
                                    <input type="hidden" name="itemid[]" id="itemid0"/>
                                    <input type="text" name="partnumber[]" id="partnumber0" style="width: 80%">
                                    <img src="images/list.png" onclick="item_listSearch(0)" class="miniaction">
                                    <input type="hidden" name="name[]" id="name0" style="width: 100%"/>
                                </td>
                                <td><textarea style="width: 100%; height: 70px;" name="desciption[]" id="description0" readonly="true"></textarea></td>
                                <td id="tempstock0"></td>
                                <td><input type="text" name="qty[]" id="qty0" value="0" size="5" style="text-align: center; width: 100%;" onblur="stockout_checkstock(0)"></td>                                
                                <td>
                                    <select name="unitid[]" id="unitid0" style="width: 100%" onchange="stockout_checkstock(0)">
                                        <option value="0">--Unit--</option>
                                    </select>
                                </td>                                
                                <td width="5"><img src="images/delete.png" style="cursor: pointer" onclick="pr_deleteitem(this)"/></td>
                            </tr>
                        </tbody>
                    </table>
                    <button onclick="stockout_additem()">Add Item</button>
                </td>        
            </tr>
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>                     
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5" align="center">
                    <br/>
                    <button onclick="stockout_save()">Save</button>&nbsp;
                    <button onclick="stockout_notmrchoose()">reset</button>&nbsp;
                    <button onclick="stockout_view()">Cancel</button>&nbsp;
                    <br/><br/>
                </td>
            </tr>
        </table>
    </div>

    <br/>
    <br/>
    <br/>
</center>