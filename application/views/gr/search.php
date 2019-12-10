<script type="text/javascript">
    /* make the table scrollable with a fixed header */
<?php if ($this->session->userdata('department') == 10) { ?>
        $(function () {
            $('#tbl_s_gr_zxcs').scrollableFixedHeaderTable('100%', '300');
        });
    <?php
} else {
    ?>
        $(function () {
            $('#tbl_s_gr_zxcs').scrollableFixedHeaderTable('100%', '500');
        });
    <?php
}
?>
</script>

<table class="tablesorter2 scrollableFixedHeaderTable" width="100%" id='tbl_s_gr_zxcs'>
    <thead>
        <tr>
            <th width="2%">No</th>                        
            <th width="8%">GR</th>
            <th width="5%">Date</th>
            <th width="5%">Receive Date</th>
            <th width="5%">DO Date</th>
            <th width="14%">Supplier</th>
            <th width="10%">DO Number</th>
            <th width="13%">Received By</th>
            <th width="10%">Input Time</th>
            <th width="12%">Action</th>
        </tr>            
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($gr as $gr) {
            $gritem = $this->model_gritem->selectByGrId($gr->id);
            $bgcolor = "";
            if ($gr->ambigues_date_grpo > 0) {
                $bgcolor = 'bgcolor="#ed4444"';
            }
            $bgcolor_printed = "";
            if ($gr->printed != 0) {
                $bgcolor_printed = "bgcolor='#80dcaf'";
            }
            ?>
            <tr>
                <td align="right" <?php echo $bgcolor ?>><?php echo $no++ ?></td>
                <td align="center" <?php echo $bgcolor ?>><a href="javascript:void(0)" style="text-decoration: none" onclick="gr_viewdetail(<?php echo $gr->id ?>)"><?php echo $gr->grnumber ?></a></td>
                <td align="center"><?php echo date('d/m/Y', strtotime($gr->grdate)) ?></td>
                <td align="center"><?php echo date('d/m/Y', strtotime($gr->receivedate)) ?></td>                
                <td align="center"><?php echo (!empty($gr->do_date)) ? date('d/m/Y', strtotime($gr->do_date)) : ""; ?></td>
                <td><?php echo $gr->vendorname ?></td>
                <td><?php echo $gr->letternumber ?></td>
                <td><?php echo $gr->receivedby . "-" . $gr->name_received ?></td>
                <td align='center'><?php echo date('d/m/Y H:i',  strtotime($gr->in_time)); ?></td>
                <td <?php echo $bgcolor_printed; ?> id="gr_s_td_action<?php echo $gr->id ?>">
                    <?php
                    if ($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') != "") {
                        if (in_array('edit', $accessmenu) && $gr->receivedby == $this->session->userdata("id")) {
                            echo "<a href='javascript:void(0)' onclick='gr_edit(" . $gr->id . ")'><img src='images/edit.png' class=miniaction/> Edit</a> ";
                        }if (in_array('delete', $accessmenu) && $gr->receivedby == $this->session->userdata("id")) {
                            echo "<a href='javascript:void(0)' onclick='gr_delete(" . $gr->id . ")'><img src='images/delete.png' class='miniaction'/> Delete</a>";
                        }
                    }
                    echo "<a target='_blank' href='" . base_url() . "index.php/gr/printdetail/" . $gr->id . "/3' onclick=\"$(this).parent().attr('bgcolor', '#80dcaf')\"><img src='images/print.png' class='miniaction'/> Print </a>";
                    ?>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td align="right"><strong>Detail Item</strong></td> 
                <td colspan="8">
                    <table class="child" width="80%" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="10%">P.O</th>
                                <th width="10%">P.O Date</th>
                                <th width="10%">MR</th>
                                <th width="10%">Item Code</th>
                                <th width="30%">Item Description</th>
                                <th width="5%">Unit</th>
                                <th width="10%">Recv</th>
                                <th width="15%">Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
//                            print_r($gritem);
                            foreach ($gritem as $result2) {
                                ?>
                                <tr>
                                    <td><?php echo $result2->ponumber ?></td>
                                    <td align="center"><?php echo date('d/m/Y', strtotime($result2->po_date)); ?></td>
                                    <td><?php echo $result2->mat_req_number ?></td>
                                    <td><?php echo $result2->itempartnumber ?></td>
                                    <td><?php echo $result2->itemdescription ?></td>
                                    <td align="center"><?php echo $result2->unitcode ?></td>
                                    <td align="center"><?php echo $result2->qty ?></td>
                                    <td align="center">
                                        <?php
                                        echo $result2->note;
                                        if ($result2->rejectqty != 0) {
                                            echo '-Reject : ' . $result2->rejectqty;
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
        ?>
    </tbody>
</table>
<center>
    <div style="margin-bottom: 5px;margin-top: 5px;">
        <img src="images/first.png" onclick="gr_search(<?php echo $first ?>)" class="miniaction"/>
        <img src="images/prev.png" onclick="gr_search(<?php echo $prev ?>)" class="miniaction"/>
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
        <img src="images/next.png" onclick="gr_search(<?php echo $next ?>)" class="miniaction"/>
        <img src="images/last.png" onclick="gr_search(<?php echo $last ?>)" class="miniaction"/>
        &nbsp;&nbsp;
        Total Page
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
        Total Rows
        <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
    </div>
</center>