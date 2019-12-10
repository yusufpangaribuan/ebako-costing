<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_s_item_qzx').scrollableFixedHeaderTable('102%', '550', null, null, null, 'tbl_s_item_qzx');
    });
</script>
<table class="tablesorter2 scrollableFixedHeaderTable" id="tbl_s_item_qzx" width="100%">
    <thead>
        <tr>
            <th width="1%">No</th>
            <th width="8%">Code</th>                        
            <th>Description</th>
            <th width="6%">Group</th>            
            <th width="5%">Class</th>
            <th width="5%">Rack</th>                            
            <th width="2%">MOQ</th>
            <th width="4%">LT</th>
            <th width="5%">Etd</th>
            <th width="3%">Yld %</th>
            <th width="3%">Qlty Check</th>
            <th width="3%">DoI</th>
            <?php
            if (in_array('view_price', $accessmenu)) {
                echo "<th width='10%'>Price</th>";
                echo "<th width='10%'>Cost Price</th>";
            }
            if (in_array('view_stock', $accessmenu)) {
                echo "<th width='15%'>Stock</th>";
            }
            ?>
            <th width='115'>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($item)) {
            foreach ($item as $result) {
                ?>
                <tr valign="top">                                
                    <td align="right"><?php echo $number++ ?></td>
                    <td><?php echo $result->partnumber ?></td>
                    <td>
                        <?php
                        echo nl2br(stripslashes($result->descriptions));
                        ?>
                    </td>
                    <td><?php echo $result->groupname ?></td>                                        
                    <td align="center"><?php echo ($result->isstock == 't' ? "STOCK" : "NON STOCK") ?></td>
                    <td align="center"><?php echo $result->rack ?></td>
                    <td align="center"><?php echo $result->moq ?></td>
                    <td align="center"><?php echo $result->lt ?></td>
                    <td align="center"><?php echo ($result->expdate != '') ? date('d/m/Y', strtotime($result->expdate)) : '' ?></td>
                    <td align="center"><?php echo $result->yield ?></td>
                    <td align="center">
                        <?php
                        if ($result->qccheck == 't') {
                            echo "Y";
                        } else {
                            echo "N";
                        }
                        ?>

                    </td>
                    <td align="center"><?php echo $result->doi ?></td>
                    <?php
                    if (in_array('view_price', $accessmenu)) {
                        ?>
                        <td align="right">
                            <?php
                            echo number_format($result->price, 2, '.', '') . " " . $result->curr;
                            if (in_array('set_price', $accessmenu)) {
                                echo "<br/><a href='javascript:void(0)' onclick='item_setprice(" . $result->id . ")' style='float:left'> *Update Price</a>";
                            }
                            echo "<br/><a href='javascript:void(0)' onclick='item_pricehistory($result->id)' style='float:left'> *View History</a>";
                            ?>
                        </td>
                        <td align="right">
                            <?php
                            echo number_format($result->costing_price, 2, '.', '') . " " . $result->curr_costing_price;
                            if (in_array('set_price', $accessmenu)) {
                                echo "<br/><a href='javascript:void(0)' onclick='item_set_costing_price(" . $result->id . ")' style='float:left'> *Update Price</a>";
                            }
                            echo "<br/><a href='javascript:void(0)' onclick='item_pricehistory_costing_price($result->id)' style='float:left'> *View History</a>";
                            ?>
                        </td>
                        <?php
                    }
                    $allunit = $this->model_item->selectAllUnit2($result->id);
                    if (in_array('view_stock', $accessmenu)) {
                        ?>
                        <td align="right">

                            <table width="100%" cellspacing="0" cellpadding="0" class="child">
                                <thead>
                                    <tr>
                                        <?php
                                        $colspan = 1;
                                        echo "<th width='50'>Unit</th>";
                                        $whs = $this->model_warehouse->selectAllByItem($result->id);
                                        foreach ($whs as $rstwhs) {
                                            echo "<th>" . $rstwhs->warehousename . "</th>";
                                            $colspan++;
                                        }

                                        if (($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') == 0) ||
                                                $this->session->userdata('department') != 10) {
                                            echo "<th>TTL</th>";
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $lastunit = 0;
                                    $tempstock = 0;
                                    $tempallstock = 0;
                                    if (!empty($allunit)) {
                                        $tempallstock = 0;
                                        foreach ($allunit as $allunit) {
                                            if ($lastunit == 0) {
                                                $lastunit = $allunit->unitfrom;
                                            }
                                            echo "<tr>"; //print_r($allunit);
                                            echo "<td align=center>" . $allunit->codes . "</td>";
                                            $whs = $this->model_warehouse->selectAllByItem($result->id);
                                            $tempstock = 0;
                                            if (empty($whs)) {
                                                echo "<td align=right>0&nbsp;</td>";
                                            } else {
                                                foreach ($whs as $rstwhs) {
                                                    $stock = $this->model_stock->getStockByItemAndUnitAndWarehouse($result->id, $allunit->unitfrom, $rstwhs->id);
                                                    echo "<td align=right>" . $stock->stock . "&nbsp;</td>";
                                                    $tempstock += $stock->stock;
                                                }
                                                $tempallstock = ($tempallstock + $tempstock) * $stock->conversionvalue;
                                                if (($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') == 0) ||
                                                        $this->session->userdata('department') != 10) {
                                                    echo "<td align=right>" . $tempstock . "&nbsp;</td>";
                                                }
                                            }
                                            echo "</tr>";
                                        }
                                    }
                                    ?>                                         
                                    <tr>
                                        <td align=center>TTL (<?php echo (!empty($allunit) ? $allunit->codes : "") ?>)</td>
                                        <td align="right" colspan="<?php echo $colspan + 1 ?>"><?php echo $tempallstock ?>&nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>       
                        </td>     
                        <?php
                    }
                    ?>                      
                    <td>
                        <?php
                        if (in_array('edit', $accessmenu)) {
                            echo "<a href='javascript:void(0)' onclick='item_edit($result->id)'><img src='images/edit.png'/>Edit</a>&nbsp;&nbsp;&nbsp;";
                        }
                        if (in_array('delete', $accessmenu)) {
                            echo "<a href='javascript:void(0)' onclick='item_delete($result->id)'><img src = 'images/delete.png'/>Delete</a><br/>";
                        }
                        if (in_array('add_unit', $accessmenu)) {
                            echo "<a href='javascript:void(0)' onclick='item_addunit(" . $result->id . "," . $lastunit . ")'><img src='images/title.gif'/>Add Unit</a><br/>";
                        }
                        if (in_array('add_unit', $accessmenu)) {
                            echo "<a href='javascript:void(0)' onclick='item_editunit(" . $result->id . ")'><img src='images/title.gif'/>Edit Unit</a><br/>";
                        }
                        if (in_array('delete_unit', $accessmenu)) {
                            echo "<a href='javascript:void(0)' onclick='item_deleteunit(" . $result->id . "," . $lastunit . ")'><img src='images/title.gif'/>Del Unit</a><br/>";
                        }
                        if (in_array('set_warehouse', $accessmenu)) {
                            echo "<a href='javascript:void(0)' onclick='item_setwarehouse(" . $result->id . ")'><img src='images/title.gif'/>Config Warehouse</a><br/>";
                        }
                        if ($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') != 0) {
//                            if (in_array('change_stock', $accessmenu)) {
//                                echo "<a href='javascript:void(0)' onclick='item_setfirststock(" . $result->id . ")' style='text-decoration: none;'><img src='images/title.gif'/>Edit Stock</a><br/>";
//                            }
//                            if (in_array('transfer_stock', $accessmenu)) {
//                                $transfered = $this->model_item->selectTransferedFrom($result->id, $this->session->userdata('optiongroup'), 'false');
//                                if (empty($transfered)) {
//                                    echo "<a href='javascript:void(0)' onclick='item_transferstock(" . $result->id . ")' style='text-decoration: none;'><img src='images/title.gif'/>Transfer Stock</a>";
//                                } else {
//                                    echo "<a href='javascript:void(0)' style='color:#c66300' onclick='item_viewtransfered(" . $result->id . ")'><img src='images/warning.png'>Transfer Item Not Rrevice yet</a>";
//                                }
//                                $transferedneedreceive = $this->model_item->selectTransferedTo($result->id, $this->session->userdata('optiongroup'), 'false');
//                                if (!empty($transferedneedreceive)) {
//                                    echo "<br/><a href='javascript:void(0)' onclick='item_torecive(" . $result->id . ")' style='color:#009b9b'><img src='images/new.png'>New transfer Item</a>";
//                                }
//                            }
                        }
                        if ($result->images != "") {
                            echo "<a href=javascript:void(0) onclick=item_viewimage('" . $result->images . "')> <img src = 'images/attachment.png' class = 'miniaction'/>Image</a>";
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
<center>
    <div style="margin-bottom: 5px;margin-top: 5px;">
        <input type="hidden" id="offset" value="<?php echo $offset ?>" />
        <img src="images/first.png" onclick="item_search(<?php echo $first ?>)" class="miniaction"/>
        <img src="images/prev.png" onclick="item_search(<?php echo $prev ?>)" class="miniaction"/>
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
        <img src="images/next.png" onclick="item_search(<?php echo $next ?>)" class="miniaction"/>
        <img src="images/last.png" onclick="item_search(<?php echo $last ?>)" class="miniaction"/>
        &nbsp;&nbsp;
        Total Page
        <input type="text" size="5" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
        Total Rows
        <input type="text" size="5" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
    </div>
</center>
