<br/>
<center>
    <div class="panel" style="width: 70%">
        <h4>Create Stock Out</h4>
        <table align="center" width="100%" border="0">            
            <tr>
            <input type="hidden" name="id" id="id" value="<?php echo $stockout->id ?>" />
            <input type="hidden" name="mrid" id="mrid" value="<?php echo $stockout->mrid ?>" />
            <input type="hidden" name="flagstockout" id="flagstockout" value="1" />
            <td colspan="5" align="center">&nbsp;</td>
            </tr>    
            <tr>
                <td width="15%"><span class="labelelement">Stock Out No.</span></td>
                <td width="15%"><input type="text" name="number" id="number" value="<?php echo $stockout->number ?>" size="11" style="text-align: center;" readonly=""/></td>
                <td width="40%">&nbsp;</td>
                <td width="15%"><span class="labelelement">#REF NO.</span></td>
                <td width="15%"><input type="text" name="refno" id="refno" value="<?php echo $stockout->refno ?>" /></td>
            </tr>
            <tr>
                <td><span class="labelelement"><span class="labelelement">Date</span></span></td>
                <td>
                    <script type="text/javascript" >
                        $(function () {
                            $("#date").datepicker({
                                dateFormat: "yy-mm-dd"
                            }).focus(function () {
                                $("#date").datepicker("show");
                            });
                        });
                    </script>
                    <input type="text" name="date" id="date" value="<?php echo $stockout->date ?>" size="10" style="text-align: center"/>
                </td>
                <td>&nbsp;</td>
                <td width="15%"><span class="labelelement">OUT BY</span></td>
                <td width="15%"><input type="text" name="outby" id="outby" value="<?php echo $stockout->outby ?>"/> </td>
            </tr>            
            <tr>
                <td><span class="labelelement">Department</span></td>
                <td>
                    <select id="departmentid" name="departmentid">
                        <option value="0">--Department--</option>
                        <?php
                        foreach ($department as $result) {
                            if ($stockout->departmentid == $result->id) {
                                echo "<option value='" . $result->id . "' selected>" . $result->code . "</option>";
                            } else {
                                echo "<option value='" . $result->id . "'>" . $result->code . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
                <td>&nbsp;</td>
                <td width="15%"><span class="labelelement">RECEIVE BY</span></td>
                <td width="15%"><input type="text" name="receiveby" id="receiveby" value="<?php echo $stockout->receiveby ?>"/> </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Division :</span></td>
                <td>
                    <select id="dept_divisionid" name="dept_divisionid" style="width: 150px">
                        <option value="0">----</option>
                        <?php
                        foreach ($devision as $result) {
                            if ($result->id == $stockout->dept_divisionid) {
                                echo "<option value='" . $result->id . "' selected>" . $result->name . "</option>";
                            } else {
                                echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
                <td>&nbsp;</td>
                <td width="15%" align="right">&nbsp;</span></td>
                <td width="15%">&nbsp;</td>
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
                            <?php
                            foreach ($stockoutdetail as $result) {
                                $allunit = $this->model_item->selectAllUnit($result->itemid);
                                ?>
                                <tr valign="top">
                                    <td>
                                        <input type="hidden" name="stockoutdetailid[]" id="stockoutdetailid<?php echo $result->id ?>" value="<?php echo $result->id ?>"/>
                                        <input type="hidden" name="mrdetailid[]" value="<?php echo $result->mrdetailid ?>"/>
                                        <input type="hidden" name="itemid[]" id="itemid<?php echo $result->id ?>" value="<?php echo $result->itemid ?>"/>
                                        <input type="text" name="partnumber[]" id="partnumber<?php echo $result->id ?>" style="width: 80%" value="<?php echo $result->code ?>">
    <!--                                        <img src="images/list.png" onclick="item_listSearch(<?php echo $result->id ?>)" class="miniaction">-->
                                        <input type="hidden" name="name[]" id="name0" style="width: 100%"/>
                                    </td>
                                    <td><textarea style="width: 100%; height: 70px;" name="desciption[]" id="description<?php echo $result->id ?>" readonly="true"><?php echo $result->descriptions ?></textarea></td>
                                    <td id="tempstock0">
                                        <?php
                                        $dt = $this->model_item->selectAllUnit($result->itemid);
                                        echo "<table width=100%>";
                                        foreach ($dt as $result3) {
                                            echo "<tr>";
                                            echo "<td width='70%' style='border:none;'><input type=text style='width:100%;text-align:right;' value='" . $result3->stock . "' readonly id='stock" . $result->itemid . "" . $result3->unitfrom . "'/></td><td width='30%' style='border:none;font-size:14px;' align='left'><b>" . $result3->codes . "</td>";
                                            echo "</tr>";
                                        }
                                        echo "</table>";
                                        ?>
                                    </td>
                                    <td>
                                        <input type="text" name="qty[]" id="qty<?php echo $result->id ?>" value="<?php echo $result->qty ?>" size="5" style="text-align: center; width: 100%;" onblur="stockout_checkstock(<?php echo $flag ?>)">
                                        <input type="hidden" name="stock[]" id="stock<?php echo $result->id ?>" value="<?php echo $this->model_item->getStockByUnit($result->itemid, $result->unitid) ?>" size="5" style="text-align: center; width: 100%;">
                                    </td>
                                    <td>
                                        <select name="unitid[]" id="unitid<?php echo $result->id ?>" style="width: 100%" onchange="stockout_checkstock(<?php echo $result->id ?>)" disabled="true">
                                            <?php
                                            foreach ($allunit as $result2) {
                                                if ($result2->unitfrom == $result->unitid) {
                                                    echo "<option value='" . $result2->unitfrom . "' selected>" . $result2->codes . "</option>";
                                                } else {
                                                    echo "<option value='" . $result2->unitfrom . "'>" . $result2->codes . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>                                
                                    <td width="5"><img src="images/delete.png" style="cursor: pointer" onclick="stockout_deleteitem2(this,<?php echo $result->id ?>)"/></td>                                        
                                </tr>
                                <?php
                            }
                            ?>
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
                    <button onclick="stockout_update()">update</button>&nbsp;
                    <button onclick="stockout_edit(<?php echo $stockout->id . "," . $stockout->mrid ?>)">reset</button>&nbsp;
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