<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_mat_receive_xyz').scrollableFixedHeaderTable('100%', '500', null, null, null, 'tbl_mat_receive_xyz');
    });
</script>
<table class="tablesorter2 scrollableFixedHeaderTable" id="tbl_mat_receive_xyz" width="100%">
    <thead>
        <tr>
            <th width="2%">No</th>
            <th>Stock out NO</th>
            <th width="120">Stock out DATE</th>
            <th width="120">Stock out From</th>
            <th>Stock out By</th>
            <th>MW NO</th>
            <th>MW Date</th>
            <th>Request By</th>
            <th width="150">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($materialreceive)) {
            $no = $offset;
            foreach ($materialreceive as $result) {
                $materialreceiveitem = $this->model_stockoutdetail->selectByStockoutId($result->id);
                $bgcolor = "";
                if (empty($result->receivetime)) {
                    $bgcolor = "bgcolor='#ffe8e8'";
                }
                ?>
                <tr>
                    <td align="right"><?php echo ++$no ?>&nbsp;</td>
                    <td align="center"><?php echo $result->number ?>&nbsp;</td>
                    <td align="center"><?php echo date('d/m/Y', strtotime($result->date)) ?>&nbsp;</td>
                    <td align="center"><?php echo $result->warehouse_stock_out ?>&nbsp;</td>
                    <td><?php echo $result->outby ?>&nbsp;</td>
                    <td><?php echo $result->mr_number ?>&nbsp;</td>
                    <td><?php echo $result->mr_date_format ?>&nbsp;</td>
                    <td><?php echo $result->mr_employee_request_name . " / " . $result->requestby ?>&nbsp;</td>

                    <td valign="top">                        
                        <a href="<?php echo base_url('index.php/stockout/prints/' . $result->id . '/1') ?>" target="_blank"><img class='miniaction' src='images/print.png'>&nbsp;Print&nbsp;</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right" <?php echo $bgcolor ?>>
                        <?php
//                        print_r($result);

                        if (empty($result->receivetime)) {
                            if (($result->requestby == $this->session->userdata("id"))) {
                                ?>
                                <button type="button" onclick="stockout_receive2(<?php echo $result->id ?>)">Receive</button>
                                <?php
                            }
                        } else {
                            echo "Receive at: <br/> " . date('d/m/y h:i', strtotime($result->receivetime));
                        }
                        ?>
                    </td>
                    <td colspan="7">
                        <table class="child" width="70%" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th width="15%">Item Code</th>
                                    <th width="55%">Item Description</th>
                                    <th width="10%">UoM</th>
                                    <th width="10%">Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
//                                print_r($materialreceiveitem);
                                foreach ($materialreceiveitem as $result2) {
                                    ?>
                                    <tr>
                                        <td><?php echo $result2->code ?></td>
                                        <td><?php echo $result2->descriptions ?></td>
                                        <td align="center"><?php echo $result2->unitcode ?></td>
                                        <td align="center"><?php echo $result2->qty ?></td>
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
        <img src="images/first.png" onclick="materialreceive_search(<?php echo $first ?>)" class="miniaction"/>
        <img src="images/prev.png" onclick="materialreceive_search(<?php echo $prev ?>)" class="miniaction"/>
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
        <img src="images/next.png" onclick="materialreceive_search(<?php echo $next ?>)" class="miniaction"/>
        <img src="images/last.png" onclick="materialreceive_search(<?php echo $last ?>)" class="miniaction"/>
        &nbsp;&nbsp;
        Total Page
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
        Total Rows
        <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
    </div>
</center>