<br/>
<center>
    <div class="panel" style="width: 70%">
        <h4>Edit Stock Out</h4>
        <table align="center" width="100%" border="0">            
            <tr>            
                <td colspan="5" align="center">
                    <input type="hidden" name="id" id="id" value="<?php echo $id ?>" />
                    <input type="hidden" name="mrid" id="mrid" value="<?php echo $mrid ?>" />
                    &nbsp;
                </td>
            </tr>    
            <tr>
                <td width="15%" align="right"><span class="labelelement">Stock Out No :</span></td>
                <td width="15%"><input type="text" name="number" id="number" value="<?php echo $stockout->number ?>" size="11" style="text-align: center;" readonly=""/></td>
                <td width="40%">&nbsp;</td>
                <td width="15%" align="right"><span class="labelelement">MR.NO :</span></td>
                <td width="15%"><input type="text" name="refno" id="refno" value="<?php echo $stockout->refno ?>" /></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Date :</span></td>
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
                <td width="15%" align="right"><span class="labelelement">Out By :</span></td>
                <td width="15%"><input type="text" name="outby" id="outby" value="<?php echo $stockout->outby ?>"/> </td>
            </tr>            
            <tr>
                <td align="right"><span class="labelelement">Department :</span></td>
                <td>
                    <select id="departmentid" name="departmentid" disabled="true">
                        <option value="0">--Department--</option>
                        <?php
                        foreach ($department as $result) {
                            if ($result->id == $stockout->departmentid) {
                                echo "<option value='" . $result->id . "' selected>" . $result->code . "</option>";
                            } else {
                                echo "<option value='" . $result->id . "'>" . $result->code . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
                <td>&nbsp;</td>
                <td width="15%" align="right"><span class="labelelement">Receive By :</span></td>
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
                                <th width="20%">Code</th>                                
                                <th width="40%">Description</th>                        
                                <th width="10%">Qty</th>
                                <th width="10%">Outstanding</th>
                                <th width="10%">Out</th>
                                <th width="10%">Unit</th>                                                                    
                            </tr>
                        </thead>
                        <tbody id="stockouttablebody">
                            <?php
                            foreach ($stockoutdetail as $result) {
                                ?>
                                <tr valign="top">
                                    <td>
                                        <input type="hidden" name="stockoutdetailid[]" value="<?php echo $result->id ?>"/>
                                        <input type="hidden" name="mrdetailid[]" value="<?php echo $result->mrdetailid ?>"/>
                                        <input type="hidden" name="itemid[]" value="<?php echo $result->itemid ?>"/>
                                        <input type="text" name="partnumber[]" style="width: 100%" value="<?php echo $result->code ?>" readonly="">
                                        <input type="hidden" name="name[]" style="width: 100%"/>
                                    </td>
                                    <td><textarea style="width: 100%; height: 70px;" name="desciption[]" id="description0" readonly="true" readonly><?php echo $result->descriptions ?></textarea></td>                                
                                    <td><input type="text" name="mrdetailqty[]" value="<?php echo $result->mrdetailqty ?>" readonly="true" size="5" style="text-align: center; width: 100%;"> </td>
                                    <td>
                                        <input type="text" name="ots[]" id="ots<?php echo $result->id ?>" value="<?php echo $result->ots ?>" readonly="" value="0" size="5" style="text-align: center; width: 100%;"> 
                                        <input type="hidden" name="stock[]" id="stock<?php echo $result->id ?>" value="<?php echo $this->model_item->getStockByUnit($result->itemid, $result->unitid) ?>" size="5" style="text-align: center; width: 100%;">
                                    </td>
                                    <td>
                                        <input type="text" name="out[]" id="out<?php echo $result->id ?>" value="<?php echo $result->qty ?>" onblur="stockout_isavailable(<?php echo $result->id ?>)" size="5" style="text-align: center; width: 100%;" onblur="stockout_isavailable(<?php echo $result->id ?>);"> </td>
                                    <td>
                                        <select name="unitid[]" style="width: 100%" disabled="true">
                                            <?php
                                            $unit = $this->model_item->selectAllUnit($result->itemid);
                                            foreach ($unit as $unit) {
                                                if ($unit->unitfrom == $result->unitid) {
                                                    echo "<option value='" . $unit->unitfrom . "' selected>" . $unit->codes . "</option>";
                                                } else {
                                                    echo "<option value='" . $unit->unitfrom . "'>" . $unit->codes . "</option>";
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
                </td>        
            </tr>
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>                        
            <tr>
                <td colspan="5" align="center">
                    <br/>
                    <button onclick="stockout_update()">Update</button>&nbsp;
                    <button onclick="stockout_edit(<?php echo $id . "," . $mrid ?>)">Reset</button>&nbsp;
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