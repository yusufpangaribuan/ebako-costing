<div style="width: 900px;">
    <form id="stockopname_edit_form" onsubmit="return false;">
        <table width="100%">
            <tr>
                <td>
                    <table width="50%">
                        <tr>
                            <td align="right"><span class="labelelement">Transaction No : </span></td>
                            <td><strong><?php echo $stockopname->stockopname_no ?></strong></td>
                        </tr>
                        <tr valign="top">
                            <td align="right" width="25%"><span class="labelelement">Date :</span></td>
                            <td width="75%">
                                <input type="text" name="date" required="true" readonly="" value="<?php echo $stockopname->date ?>" style="width: 100px"/>
                                <script type="text/javascript" >
                                    $(function () {
                                        $('#stockopname_add_form input[name="date"]').datepicker({
                                            dateFormat: "yy-mm-dd"
                                        }).focus(function () {
                                            $('#stockopname_add_form input[name="date"]').datepicker("show");
                                        });
                                    });
                                </script>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td align="right"><span class="labelelement">Description :</span></td>
                            <td><input type="text" name="description" style="width: 100%;" value="<?php echo $stockopname->description ?>" required="true"/></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="100%" class="tablesorter2">
                        <thead>
                            <tr>
                                <th width="10%">Item Code</td>
                                <th width="30%">Item Description</td>
                                <th width="5%">UoM</td>
                                <th width="10%">Stock</td>
                                <th width="10%">Real Stock</td>
                                <th width="10%">Difference</td>
                                <th width="5%">Action</td>
                            </tr>
                        </thead>
                        <tbody id="stockopname_item_list">
                            <?php
                            $counter = 1;
                            foreach ($detail as $result) {
                                ?>
                                <tr>
                                    <td>
                                        <input type="hidden" name="sop_detail8_id[]" value="<?php echo $result->id ?>"/>
                                        <?php echo $result->item_code ?>
                                    </td>
                                    <td><?php echo $result->item_description ?></td>
                                    <td><?php echo $result->unit_code ?></td>
                                    <td><input type="text" style="width: 100%;text-align: right;" id="sopd_stock<?php echo $result->id ?>" readonly="" value="<?php echo $result->stock ?>"></td>
                                    <td><input type="text" style="width: 100%;text-align: right;" name="sopd_real_stock[]" id="sopd_real_stock<?php echo $result->id ?>" value="<?php echo $result->real_stock ?>" onkeyup="stockopname_calc_diff(<?php echo $result->id ?>)"></td>
                                    <td><input type="text" style="width: 100%;text-align: right;" name="sopd_diff_stock[]"  id="sopd_diff_stock<?php echo $result->id ?>" readonly="" value="<?php echo $result->difference?>"></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="stockopname_detail_delete(<?php echo $result->id ?>, this)"><img src="images/delete.png">Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table><br/>
                    <button type="button" onclick="stockopname_add_item(<?php echo $stockopnameid ?>)">Add Item</button>
                </td>
            </tr>
    </form>
</div>
