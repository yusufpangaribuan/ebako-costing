<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_com').scrollableFixedHeaderTable('102%', '550', null, null, null, 'tbl_com');
    });
</script>
<table class="tablesorter2 scrollableFixedHeaderTable" id="tbl_com" width="100%">
    <thead>
        <tr>
            <th width="2%">No</th>
            <th width="10%">COM NO</th>
            <th>Date</th>            
            <th>Customer</th>
            <th>AWB NO</th>
            <th>Via</th>
            <th>Delivered By</th>
            <th>Received By</th>
            <th>Acknowledge By</th>
            <th width="150">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($com)) {
            $no = $offset;
            foreach ($com as $result) {
                $comitem = $this->model_com->select_item_by_com_id($result->id);
                ?>
                <tr>
                    <td align="right"><?php echo ++$no ?>&nbsp;</td>
                    <td align="center"><?php echo $result->com_no ?>&nbsp;</td>
                    <td><?php echo date('d/m/Y', strtotime($result->date)) ?>&nbsp;</td>
                    <td><?php echo $result->customer_name ?>&nbsp;</td>
                    <td><?php echo $result->awb ?>&nbsp;</td>
                    <td><?php echo $result->via ?>&nbsp;</td>
                    <td><?php echo $result->sent_by ?>&nbsp;</td>
                    <td><?php echo $result->receive_by ?>&nbsp;</td>
                    <td><?php echo $result->acknowledge_by ?>&nbsp;</td>
                    <td valign="top">
                        <?php
                        if (in_array('edit', $accessmenu) && $this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') != 0) {
                            echo "<a href='javascript:com_edit($result->id)'><img class='miniaction' src='images/edit.png'>&nbsp;Edit&nbsp;</a>";
                        }
                        if (in_array('edit', $accessmenu) && $this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') != 0) {
                            echo "<a href='javascript:com_delete($result->id)'><img class='miniaction' src='images/delete.png'>&nbsp;Delete&nbsp;</a>";
                        }
                        ?>
                        <a href="<?php echo base_url('index.php/com/prints/' . $result->id . '/1') ?>" target="_blank"><img class='miniaction' src='images/print.png'>&nbsp;Print&nbsp;</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                    <td colspan="7">
                        <table class="child" width="70%" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th width="15%">Item Code</th>
                                    <th width="30%">Item Description</th>
                                    <th width="10%">UoM</th>
                                    <th width="10%">Recv</th>
                                    <th width="25%">Remark</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
//                            print_r($gritem);
                                foreach ($comitem as $result2) {
                                    ?>
                                    <tr>
                                        <td><?php echo $result2->item_code ?></td>
                                        <td><?php echo $result2->item_description ?></td>
                                        <td align="center"><?php echo $result2->unit_code ?></td>
                                        <td align="center"><?php echo $result2->qty ?></td>
                                        <td><?php echo $result2->remark ?></td>
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
        <img src="images/first.png" onclick="com_search(<?php echo $first ?>)" class="miniaction"/>
        <img src="images/prev.png" onclick="com_search(<?php echo $prev ?>)" class="miniaction"/>
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
        <img src="images/next.png" onclick="com_search(<?php echo $next ?>)" class="miniaction"/>
        <img src="images/last.png" onclick="com_search(<?php echo $last ?>)" class="miniaction"/>
        &nbsp;&nbsp;
        Total Page
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
        Total Rows
        <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
    </div>
</center>