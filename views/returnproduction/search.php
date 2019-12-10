<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_returnproduction').scrollableFixedHeaderTable('102%', '550', null, null, null, 'tbl_returnproduction');
    });
</script>
<table class="tablesorter2 scrollableFixedHeaderTable" id="tbl_returnproduction" width="100%">
    <thead>
        <tr>
            <th width="1%">No</th>
            <th width="9%">RTM NO</th>
            <th width="5%">Date</th>            
            <th width="12%">Returned By</th>
            <th width="12%">Item Code</th>
            <th width="20%">Item Description</th>
            <th width="5%">UoM</th>
            <th width="5%">Qty</th>
            <th width="15%">Remark</th>
            <th width="20%">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($returnproduction)) {
            $no = $offset;
            foreach ($returnproduction as $result) {
                ?>
                <tr>
                    <td width="1%" align="right"><?php echo ++$no ?>&nbsp;</td>
                    <td width="9%" align="center"><?php echo $result->returnproduction_no ?>&nbsp;</td>
                    <td width="5%" align="center"><?php echo date('d/m/Y', strtotime($result->date)) ?>&nbsp;</td>
                    <td width="12%"><?php echo $result->name_return_by . "<br/>" . $result->department_name ?>&nbsp;</td>
                    <td width="12%"><?php echo $result->item_code ?>&nbsp;</td>
                    <td width="20%"><?php echo $result->item_description ?>&nbsp;</td>
                    <td width="5%" align="center"><?php echo $result->unit_code ?>&nbsp;</td>
                    <td width="5%">
                        <?php
                        echo $result->qty;
                        if ($this->session->userdata('department') == 10) {
                            echo "<br/><b>Ots: " . $result->ots_qty . "</b>";
                        }
                        ?>
                        &nbsp;
                    </td>
                    <td width="15%"><?php echo $result->remark ?>&nbsp;</td>
                    <td width="20%" valign="top">
                        <?php
                        if (in_array('edit', $accessmenu) && $this->session->userdata('id') == $result->user_inserted) {
                            echo "<a href='javascript:returnproduction_edit($result->id)' style='display:inline-block;padding-right:4px;padding-bottom:2px'><img class='miniaction' src='images/edit.png'>&nbsp;Edit&nbsp;</a>";
                        }
                        if (in_array('delete', $accessmenu) && $this->session->userdata('id') == $result->user_inserted) {
                            echo "<a href='javascript:returnproduction_delete($result->id)' style='display:inline-block;padding-right:4px;padding-bottom:2px'><img class='miniaction' src='images/delete.png'>&nbsp;Delete&nbsp;</a>";
                        }
                        ?>
                        <a href="<?php echo base_url('index.php/returnproduction/prints/' . $result->id . '/1') ?>" target="_blank"  style='display:inline-block;padding-right:4px;padding-bottom:2px;'><img class='miniaction' src='images/print.png'>&nbsp;Print&nbsp;</a>
                        <?php
                        if ($this->session->userdata('department') == 10 && in_array('receive', $accessmenu) && ($result->ots_qty > 0)) {
                            ?>
                            <fieldset style="width: 150px">
                                <legend>Receive Action</legend>
                                <button onclick="returnproduction_recive(<?php echo $result->id ?>, 1)" style="margin-top: 2px;margin-bottom: 2px;width: 120px;text-align: left">Increase Stock</button><br/>
                                <button onclick="returnproduction_recive(<?php echo $result->id ?>, 2)" style="margin-top: 2px;margin-bottom: 2px;width: 120px;text-align: left">Goods Reject</button>
                            </fieldset>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <?php
                if ($this->session->userdata('department') == 10) {
                    $receive = $this->model_returnproduction->select_all_receive_by_return_id($result->id);
                    if (!empty($receive)) {
                        ?>
                        <tr>
                            <td colspan="2" align="right"><strong>Detail Receive</strong>&nbsp;</td>
                            <td colspan="8">
                                <table width="60%" class="child">
                                    <thead>
                                        <tr>
                                            <th width="2%">No</th>
                                            <th width="10%">Receive Date</th>
                                            <th width="18%">Received By</th>
                                            <th width="10%">Qty</th>
                                            <th width="15%">Type</th>
                                            <th width="15%">Store To</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($receive as $result2) {
                                            ?>
                                            <tr>
                                                <td align="right"><?php echo $no++ ?></td>
                                                <td align="center"><?php echo date('d/m/Y', strtotime($result2->date)) ?></td>
                                                <td><?php echo $result2->receive_by . "/" . $result2->name_receive_by; ?></td>
                                                <td align="center"><?php echo $result2->qty; ?></td>
                                                <td><?php echo $result2->type_description; ?></td>
                                                <td><?php echo $result2->warehouse_name; ?></td>
                                                <td>
                                                    <?php
                                                    if ($this->session->userdata('id') == $result2->receive_by) {
                                                        ?>
                                                        <a href="javascript:returnproduction_receive_delete(<?php echo $result2->id ?>)" style="display: inline-block"><img src="images/delete.png">Delete</a>
                                                        <?php
                                                    }
                                                    ?>

                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <?php
                    }
                }
            }
        } else {
            ?>
            <tr>
                <td colspan="10">No Data....</td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<center>
    <div style="margin-bottom: 5px;margin-top: 5px;">
        <input type="hidden" id="offset" value="<?php echo $offset ?>" />
        <img src="images/first.png" onclick="returnproduction_search(<?php echo $first ?>)" class="miniaction"/>
        <img src="images/prev.png" onclick="returnproduction_search(<?php echo $prev ?>)" class="miniaction"/>
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
        <img src="images/next.png" onclick="returnproduction_search(<?php echo $next ?>)" class="miniaction"/>
        <img src="images/last.png" onclick="returnproduction_search(<?php echo $last ?>)" class="miniaction"/>
        &nbsp;&nbsp;
        Total Page
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
        Total Rows
        <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
    </div>
</center>