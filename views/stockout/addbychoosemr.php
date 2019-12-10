<div style="width: 700px;margin-right: 10px;">
    <form id="stokout_by_mr_choose_amazon" onsubmit="return false">
        <table align="center" width="100%" border="0">            
            <tr>
                <td colspan="5" align="center">
                    <input type="hidden" name="mrid" id="mrid" value="<?php echo $mrid ?>" />
                    <input type="hidden" name="soid" id="soid" value="<?php echo $mr->soid ?>" />
                </td>
            </tr>    
            <tr>
                <td width="20%" align="right"><span class="labelelement">Stock Out No :</span></td>
                <td width="20%"><input type="text" name="number" id="number" value="<?php echo $this->model_stockout->getNextNumber() ?>" size="28" readonly=""/></td>
                <td width="20%">&nbsp;</td>
                <td width="20%" align="right"><span class="labelelement">MR No :</span></td>
                <td width="20%"><input type="text" name="refno" id="refno" value="<?php echo $mr->number ?>" /></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement"><span class="labelelement">Date :</span></span></td>
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
                    <input type="text" name="date" id="date" value="<?php echo date('Y-m-d') ?>" readonly="" size="10" style="text-align: center"/>
                </td>
                <td>&nbsp;</td>
                <td width="15%"  align="right"><span class="labelelement">Out by :</span></td>
                <td width="15%"><input type="text" name="outby" id="outby" value="<?php echo $this->model_employee->getNameById($this->session->userdata('id')) ?>"/> </td>
            </tr>            
            <tr>
                <td align="right"><span class="labelelement">Department :</span></td>
                <td>
                    <select id="departmentid" name="departmentid" disabled="true" style="width: 150px">
                        <option value="0">--Department--</option>
                        <?php
                        foreach ($department as $result) {
                            if ($result->id == $mr->departmentid) {
                                echo "<option value='" . $result->id . "' selected>" . $result->code . "</option>";
                            } else {
                                echo "<option value='" . $result->id . "'>" . $result->code . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
                <td>&nbsp;</td>
                <td width="15%" align="right"><span class="labelelement">Request By :</span></td>
                <td width="15%">
                    <input type="hidden" name="receivebyid" id="receivebyid" value="<?php echo $mr->requestby ?>" />
                    <input type="text" name="receiveby" id="receiveby" value="<?php echo $this->model_employee->getNameById($mr->requestby) ?>" readonly=""/>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Division :</span></td>
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
                <td>&nbsp;</td>
                <td width="15%" align="right">&nbsp;</span></td>
                <td width="15%">&nbsp;</td>
            </tr>
            <tr valign="top">
                <td colspan="5">
                    <br/>
                    <table width="100%" class="tablesorter2">
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
                            foreach ($mrdetail as $result) {
                                if ($result->ots > 0) {
                                    ?>
                                    <tr valign="top">
                                        <td>                                        
                                            <input type="hidden" name="mrdetailid" value="<?php echo $result->id ?>"/>
                                            <input type="hidden" name="itemid" value="<?php echo $result->itemid ?>"/>
                                            <input type="text" name="partnumber" style="width: 100%" value="<?php echo $result->code ?>" readonly="">
                                            <input type="hidden" name="name" style="width: 100%"/>
                                        </td>
                                        <td><textarea style="width: 100%; height: 20px;" name="desciption[]" id="description0" readonly="true" readonly><?php echo $result->descriptions ?></textarea></td>                                
                                        <td><input type="text" name="qty" value="<?php echo $result->qty ?>" readonly="true" size="5" style="text-align: center; width: 100%;"> </td>
                                        <td>
                                            <input type="text" name="ots" id="ots<?php echo $result->id ?>" readonly="" value="<?php echo ($result->ots - $result->qtyunreceived) ?>" size="5" style="text-align: center; width: 100%;">
                                            <input type="hidden" name="stock" id="stock<?php echo $result->id ?>" value="<?php echo $this->model_item->item_get_stock_by_unit_and_warehouse($result->itemid, $result->unitid, $result->warehouseid) ?>" size="5" style="text-align: center; width: 100%;">
                                        </td>
                                        <td><input type="text" name="out" id="out<?php echo $result->id ?>" value="0" onblur="stockout_isavailable(<?php echo $result->id ?>)" size="5" style="text-align: center; width: 100%;"> </td>
                                        <td>
                                            <select name="unitid" style="width: 100%" disabled="true">
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
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </td>        
            </tr>
        </table>
    </form>
</div>