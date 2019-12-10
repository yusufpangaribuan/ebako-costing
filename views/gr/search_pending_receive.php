<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_s_pending_gr_zxcs').scrollableFixedHeaderTable('100%', '230');
    });
</script>
<table class="tablesorter2 scrollableFixedHeaderTable" width="100%" id='tbl_s_pending_gr_zxcs'>
    <thead>
        <tr>
            <th width="1%">No</th>                        
            <!--<th width="8%">PO No.</th>-->
            <!--<th width="6%">Date</th>-->                                                
            <th width="29%">Vendor</th>
            <th width="60%">Item Detail</th>
            <th width="10%">Action</th>                        
        </tr>            
    </thead>
    <tbody>
        <?php
        if (!empty($po)) {
            $no = 1;
//            print_r($po);
            foreach ($po as $result) {
                ?>
                <tr valign="top">
                    <td align="right"><?php echo $no++ ?></td>
                    <!--<td align="center"><?php //echo $result->ponumber     ?></td>-->
                    <!--<td align="center"><?php //echo date('d/m/Y', strtotime($result->dates));     ?></td>-->
                    <td><?php echo $result->vendorname ?></td>
                    <td>
                        <table class="child" width="100%" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th width="10%">PO</th>
                                    <th width="10%">PO Date</th>
                                    <th width="15%">Item Code</th>
                                    <th width="40%">Item Description</th>
                                    <th width="10%">Order Qty</th>
                                    <th width="10%">Outstanding</th>
                                    <th width="5%">UoM</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //$poitem = $this->model_po->selectOutstandingItemByPoId($result->poid);
                                $poitem = $this->model_po->selectOutstandingItemByVendorId($result->vendorid);
                                foreach ($poitem as $result_item) {
                                    ?>
                                    <tr>
                                        <td class="po_child"><?php echo $result_item->ponumber; ?></td>
                                        <td><?php echo $result_item->po_date; ?></td>
                                        <td><?php echo $result_item->itempartnumber; ?></td>
                                        <td><?php echo $result_item->itemdescription; ?></td>
                                        <td align="right"><?php echo $result_item->qty; ?></td>
                                        <td align="right"><?php echo $result_item->outstanding; ?></td>
                                        <td><?php echo $result_item->unitcode; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </td>   
                    <td>
                        <?php
                        if (in_array('allow_receive_item', $accessmenu)) {
                            //echo "<button onclick='gr_getpoitem(" . $result->poid . ")'>Receive</button>";
                            echo "<button onclick='gr_getpoitembyvendor(" . $result->vendorid . ")'>Receive</button>";
                        }
                        ?>
                        &nbsp;
                    </td>     
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="5">No PO Pending..</td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>