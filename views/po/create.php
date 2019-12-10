<?php
foreach ($po as $po) {
    ?>
    <table width="100%" border="0" class="tablesorter">
        <thead>
            <tr>
                <th width="15%">Number</th>                
                <th width="15%">Dates</th>
                <th width="10%">Payment term</th>
                <th width="10%">Delivery term</th>
                <th width="10%">Discount</th>
                <th width="15%">Grand total</th>
                <th width="10%">Remark</th>

            </tr>
        </thead>
        <tbody>
            <tr valign="top" height="20">
                <td>
                    <input type="hidden" name="id[]" value="<?php echo $po->id ?>" style="width: 100%"/>
                    <input type="text" value="<?php echo $po->ponumber ?>" style="width: 100%"/>
                </td>                                
                <td><input type="text" size="10" value="<?php echo $po->dates ?>" style="width: 100%;text-align: center;"/></td>
                <td><input type="text" size="10" value="" style="width: 100%;text-align: center;" name="payterm[]"/></td>
                <td>
                    <input type="text" size="10" id="deliverterm<?php echo $po->id ?>" readonly="" style="width: 100%;text-align: center;" name="deliverterm[]"/>
                    <script type="text/javascript" >
                        $(function () {
                            $("#deliverterm<?php echo $po->id ?>").datepicker({
                                dateFormat: "yy-mm-dd"
                            }).focus(function () {
                                $("#deliverterm<?php echo $po->id ?>").datepicker("show");
                            });
                        });
                    </script>
                </td>
                <td><input type="text" size="10" value="<?php echo (double) $po->discount; ?>" style="width: 100%;text-align: right;"/></td>
                <td><input type="text" size="10" value="<?php echo $po->grandtotal; ?>" style="width: 100%;text-align: right;"/></td>
                <td rowspan="2">
                    <textarea cols="20" rows="5" style="height: 76px;"><?php echo $po->remark ?></textarea>
                </td>    
            </tr>
            <tr valign="top" height="60">
                <td width="30%">                
                    <textarea style="width: 100%;height: 100%;"><?php echo $this->model_vendor->getNameById($po->vendorid); ?></textarea>
                </td>
                <td colspan="5" width="70%">                
                    <textarea style="width: 100%;height: 100%;" name="sumof[]"><?php echo $this->component->convert_number_to_words($po->grandtotal); ?></textarea>
                </td>
            </tr>
        </tbody>
    </table>
    <br/>
    <?php
}
?>
<button onclick="po_savenew()">Save</button>

