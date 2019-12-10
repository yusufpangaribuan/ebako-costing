<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_s_stock_out_qzx').scrollableFixedHeaderTable('100%', '500');
    });
</script>
<table class="tablesorter2 scrollableFixedHeaderTable" width="100%" id="tbl_s_stock_out_qzx">
    <thead>
        <tr><th width="10">No</th>
            <th width="100">Stock out No.</th>
            <th>Date</th>
            <th>Reference</th>
            <th>Out by</th>
            <th>Received by</th>                        
            <th>Department</th>
            <th>Input Time</th>
            <th width="150">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($stockout)) {
            $no = $offset;
            foreach ($stockout as $result) {
                $stockoutdetail = $this->model_stockoutdetail->selectByStockoutId($result->id);
                $bgcolor = "";
                if ($result->received == 'f') {
                    $bgcolor = "bgcolor='#ffdfef'";
                }
                ?>
                <tr <?php echo $bgcolor ?>>
                    <td align="right"><?php echo $no++ ?></td>                                    
                    <td align="center"><a href="javascript:void(0)" style="text-decoration: none;" onclick="stockout_viewdetail(<?php echo $result->id ?>)"><?php echo $result->number ?></a></td>
                    <td align="center"><?php echo date('d/m/Y', strtotime($result->date)) ?></td>
                    <td align="center"><?php echo $result->refno ?></td>
                    <td><?php echo $result->outby ?></td>
                    <td><?php echo $result->receiveby ?></td>
                    <td><?php echo $result->departmentname ?></td>
                    <td align='center'><?php echo date('d/m/Y H:i',  strtotime($result->in_time)); ?></td>
                    <td>
                        <a href="<?php echo base_url() . "index.php/stockout/prints/" . $result->id . "/1" ?>" target="blank"><img src="images/print.png" class="miniaction"/> Print </a>
                        <?php
                        if ($this->session->userdata('department') == 10 && $result->received == 'f') {
                            if ($this->model_user->haspermission($this->session->userdata('id'), 'stockout', 'edit')) {
                                ?>
                                <a href="javascript:void(0)" onclick="stockout_edit(<?php echo $result->id . "," . $result->mrid ?>)"><img src="images/edit.png" class="miniaction"/> Edit </a>
                                <?php
                            }
                            if ($this->model_user->haspermission($this->session->userdata('id'), 'stockout', 'delete')) {
                                ?>
                                <a href="javascript:void(0)" onclick="stockout_delete(<?php echo $result->id ?>)"><img src="images/delete.png" class="miniaction"/> Delete </a>
                                <?php
                            }
                        }
                        ?>
                    </td>
                </tr>          
                <tr>
                    <td colspan="2" align="right">Detail Item</td>
                    <td colspan="7">
                        <table class="child" width="700" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th width="20%">Item Code</th>
                                    <th width="60%">Item Description</th>
                                    <th width="10%">Unit</th>
                                    <th width="10%">Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($stockoutdetail as $result2) {
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
        }
        ?>
    </tbody>
</table>
<div style="margin-bottom: 5px;margin-top: 5px;">
    <input type="hidden" id="offset" value="<?php echo $offset ?>"/>
    <img src="images/first.png" onclick="stockout_search(<?php echo $first ?>)" class="miniaction"/>
    <img src="images/prev.png" onclick="stockout_search(<?php echo $prev ?>)" class="miniaction"/>
    <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
    <img src="images/next.png" onclick="stockout_search(<?php echo $next ?>)" class="miniaction"/>
    <img src="images/last.png" onclick="stockout_search(<?php echo $last ?>)" class="miniaction"/>
    &nbsp;&nbsp;
    Total Page
    <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
    Total Rows
    <input type="text" size="5" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
</div>