<form id='pr_item_input_88' onsubmit="return false;">
    <table class="tablesorter " id="tbl_ots_item_mr_create_pr" width="100%">
        <thead>
            <tr>
                <th width="2%" align='center'>&nbsp;</th>
                <th width="5%">Item Code</th>
                <th width="20%">Item Description</th>
                <th width="5%">Request</th>
                <th width="10%">Ots</th>
                <th width="10%">Unit</th>
                <th width="8%">MR NO</th>
                <th width="5%">Date</th>                        
                <th width="10%">Request By</th>
                <th width="12%">Approval 1</th>
                <th width="13%">Approval 2</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($item as $result) {
                ?>
                <tr id='row-<?php echo $result->id ?>'>
                    <td align="center"><input type="checkbox" name="mritem_checked_ii[]" value="<?php echo $result->id ?>"/></td>
                    <td id='itempartnumber'>
                        <?php echo $result->item_code ?></td>
                    <td id='itemdescription'><?php echo $result->item_description ?></td>
                    <td align="center">
                        <input type="hidden" id='itemid_i<?php echo $result->id ?>' value="<?php echo $result->itemid ?>"/>
                        <?php echo $result->qty ?>
                    </td>
                    <td align="center">
                        <input type="text" name="qty[]" 
                               id="qty_i<?php echo $result->id ?>" 
                               value="<?php echo $result->ots_qty ?>" 
                               size="5" 
                               style="text-align: center; width: 100%;" 
                               onblur="
                                           if ($(this).val() === '' || $(this).val() === '0' || isNaN($(this).val())) {
                                               alert('Required NUMBER and Not Allow 0 or NULL');
                                               $(this).val(1);
                                           }
                               "
                               >
                    </td>
                    <td>
                        <select name="unitid[]" id="i_unitid<?php echo $result->id ?>" style="width: 100%">
                            <option value="<?php echo $result->unitid ?>"><?php echo $result->unit_code ?></option>
                            <?php
//                                            $unit = $this->model_unit->selectAllUnitByItemId($result->itemid);
//                                            foreach ($unit as $unit) {
//                                                if ($unit->id == $result->unitid) {
//                                                    echo "<option value='" . $unit->id . "' selected>" . $unit->codes . "</option>";
//                                                } else {
//                                                    echo "<option value='" . $unit->id . "'>" . $unit->codes . "</option>";
//                                                }
//                                            }
                            ?>                                            
                        </select>
                    </td>
                    <td align="center"><?php echo $result->mr_number ?></td>
                    <td><?php echo $result->date_f ?></td>                        
                    <td><?php echo $result->employee_request_by ?></td>
                    <td><?php echo $result->approval1_name ?></td>
                    <td><?php echo $result->approval2_name ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</form>
<center>
    <div style="margin-bottom: 5px;margin-top: 5px;">
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
        &nbsp;&nbsp;
        Total Page
        <input type="text" size="2" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
        Total Rows
        <input type="text" size="2" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
    </div>
</center>