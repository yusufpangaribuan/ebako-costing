<div style="width: 400px;">
    <?php
    //echo $this->session->userdata('optiongroup');
    ?>
    <form id="returnproduction_receive_form" onsubmit="return false;">
        <table align="center" width="100%" border="0">
            <tr>
                <td><strong>Receive Type</strong></td>
                <td><strong>:</strong></td>
                <td>
                    <strong>
                        <?php
                        if ($type == 1) {
                            echo 'Increase Stock';
                        } else {
                            echo 'Goods Reject';
                        }
                        ?>              
                    </strong>
                </td>
            <input type="hidden" name="returnproductionid" value="<?php echo $returnproduction->id ?>"/>
            <input type="hidden" name="type" value="<?php echo $type ?>"/>
            </tr>
            <tr>
                <td width="20%"><strong>Date Receive</strong></td>
                <td widh="1%"><strong>:</strong></td>
                <td width="79%">
                    <input type="text" name="date" required="true" value="<?php echo date('Y-m-d'); ?>" size="12" readonly=""/>
                    <script type="text/javascript" >
                        $(function () {
                            $("#returnproduction_receive_form input[name='date']").datepicker({
                                dateFormat: "yy-mm-dd"
                            }).focus(function () {
                                $("#returnproduction_receive_form input[name='date']").datepicker("show");
                            });
                        });</script>
                    <?php
                    if ($this->session->userdata('optiongroup') != 0 && $type == 1) {
                        ?>
                        <input type="hidden" name="warehouseid" value="<?php echo $this->session->userdata('optiongroup') ?>"/>
                        <?php
                    }
                    ?>
                </td>
            </tr>     
            <tr valign="top">
                <td><strong>Item Code</strong></td>
                <td><strong>:</strong></td>
                <td>
                    <input id="itemid0" type="hidden" name="itemid" required="true" value="<?php echo $returnproduction->itemid ?>">
                    <input id="partnumber0" class="ui-autocomplete-input" value="<?php echo $returnproduction->item_code ?>" readonly="" type="text" style="width: 80%" name="item_code">
                    <br/>
                    <input type="text" id="description0" name="item_description" value="<?php echo $returnproduction->item_description ?>" readonly="" style="width: 80%"/>
                </td>
            </tr>   
            <tr>
                <td><strong>UoM</strong></td>
                <td><strong>:</strong></td>
                <td>
                    <select name="unitid" id="unitid0" style="width: 150px" readonly="true" >
                        <option value="<?php echo $returnproduction->unitid ?>"><?php echo $returnproduction->unit_code ?></option>
                    </select>
                </td>
            </tr> 
            <tr>
                <td><strong>Qty</strong></td>
                <td><strong>:</strong></td>
                <td>
                    <input type="hidden" name="qty" required="true" style="width: 75px"value="<?php echo $returnproduction->ots_qty ?>"/>
                    <input type="text" name="receive_qty" required="true" style="width: 75px"value="<?php echo $returnproduction->ots_qty ?>"/>
                </td>
            </tr> 
            <?php
            if ($this->session->userdata('optiongroup') == 0 && $type == 1) {
                $warehouse = $this->model_item->selectWarehouseItem($returnproduction->itemid);
                ?>
                <tr>
                    <td><strong>Store To</strong></td>
                    <td><strong>:</strong></td>
                    <td>
                        <select name="warehouseid" required="true" style="width: 100px">
                            <option></option>
                            <?php
                            foreach ($warehouse as $result) {
                                echo "<option value='" . $result->warehouseid . "'>" . $result->warehouse_name . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr> 
                <?php
            }
            ?>
            <tr>
                <td><strong>Remark</strong></td>
                <td><strong>:</strong></td>
                <td><textarea name="remark" style="width: 80%;height: 40px;"></textarea></td>
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
    $("#returnproduction_receive_form").validate({
        rules: {
            receive_qty: {
                required: true,
                number: true
            },
            warehouseid: {
                required: true
            }
        }
    });
</script>