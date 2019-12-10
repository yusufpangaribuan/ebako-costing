<!-Refer to view costing->
<div style="width: 100%;">
    <div>
        <span onclick="costing_build(<?php echo $id ?>, 1)" class="miniaction"><img src="images/refresh.png"/>&nbsp;Refresh</span>
        <a href="<?php echo base_url() . "index.php/costing/prints/" . $id . "/print/0" ?>" target="blank"><img src="images/print.png">&nbsp;Print</a>&nbsp;
        <?php
        if ($costing->locked == 'f' && $this->session->userdata('department') == 9) {
            if (in_array('change_detail', $accessmenu)) {
                ?>
                <span onclick="costing_load_all_material(<?php echo $id . "," . $costing->modelid ?>, 2)" class = "miniaction" ><img src="images/load-material.png"/>&nbsp;Load All Material</span>&nbsp;
                <a href="javascript:void(0)" onclick="costing_copyfrom(<?php echo $id ?>)"><img src="images/copy.png"/>&nbsp;Copy From Existing Costing</a>&nbsp;
                <span onclick="costing_build(<?php echo $id ?>, 2)" class = "miniaction" ><img src="images/load-material.png"/>&nbsp;$&nbsp;Load Price</span>&nbsp;
                <span onclick="costing_lock(<?php echo $id ?>)" class = "miniaction"  style = "float: right;margin-right: 50px;"><img src = "images/lock.png"/>&nbsp;Lock</span>
                <?php
            }
        } else {
            ?>
            <span onclick="costing_unlock(<?php echo $id ?>)" class = "miniaction"  style = "float: right;margin-right: 50px;"><img src = "images/unlock.png"/>&nbsp;UnLock</span>
            <?php
        }
        ?>
    </div>
    <br/>
    <script type="text/javascript">
        /* make the table scrollable with a fixed header */
        $(function () {
            $('#tbl_costing_qzx').scrollableFixedHeaderTable('102%', '300',null,null,null,'tbl_costing_qzx');
        });
    </script>
    <table class="tablesorter2 scrollableFixedHeaderTable" id="tbl_costing_qzx" width="100%">
        <thead>
            <tr>
                <th width="10%">Code</th>
                <th width="15%">Description</th>
                <th width="5%">UoM</th>
                <th width="4%">Qty BOM</th>
                <th width="5%">Yield</th>
                <th width="4%">Allowance</th>
                <th width="4%">Reg'D QTY</th>
                <th width="8%">U. Price (RP)</th>
                <th width="8%">U. Price(US$)</th>
                <th width="8%">Amount (US$)</th>
                <th width="2%">%</th>        
                <th width="10%">Action</th>
                <th width="10%">Move</th>
                <th width="1%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $valid = 1;
            $directmaterialtotal = 0;
            foreach ($costingcategory as $costingcategory) {
                $costingdetail = $this->model_costing->selectCostingByHeaderidAndCategoryId($id, $costingcategory->id);
                ?>
                <tr>                    
                    <td bgcolor="#e9efe8" style="border: none"><b><?php echo $costingcategory->name ?></b>&nbsp;&nbsp;</td>
                    <td colspan="12" bgcolor="#e9efe8" style="font-size: 11px;">  
                        <?php
                        if ($costing->locked == 'f' && $this->session->userdata('department') == 9) {
                            if (in_array('change_detail', $accessmenu)) {
                                echo "<img src='images/bomadd.png' class='miniaction' onclick='costing_adddetail(" . $id . "," . $costingcategory->id . ")'/>&nbsp;Add";
                                if (in_array($costingcategory->id, array(1, 2, 3, 4, 5, 7))) {
                                    echo "&nbsp;&nbsp;&nbsp;<a href='javascript:void(0)' onclick='costing_loadfrommaterial(" . $id . "," . $costingcategory->id . "," . $costing->modelid . ")'> <img src='images/load-material.png' class='miniaction'/>&nbsp;Load Material</a>";
                                }
                                echo "&nbsp;&nbsp;&nbsp;<a href='javascript:void(0)' onclick='costing_copypartfrom(" . $id . "," . $costingcategory->id . ")'><img src='images/copy.png'/>&nbsp;Copy From Existing Costing</a>&nbsp;";
                            }
                        }
                        ?>
                    </td>        
                </tr>
                <?php
                $subtotal = 0;
                $total_in_usd = 0;
                $msg_curr = "";
                foreach ($costingdetail as $result) {
                    $bgcolor = '';
                    $msg_curr = "";
                    $price_rp = $result->unitpricerp;
                    $unitpriceusd = number_format(($result->unitpricerp / $costing->ratevalue), 2, '.', ',');
                    if ($result->unitpriceusd != 0) {
                        $unitpriceusd = $result->unitpriceusd;
                    }
                    $newpriceusd = $unitpriceusd;
                    if ($flag == 2 && $result->itemid != 0) {
                        $newprice = $this->model_item->getPrice($result->itemid);
                        if (!empty($newprice)) {
                            if ($newprice->curr == 'IDR') {
                                $newpriceusd = number_format(($newprice->price / $costing->ratevalue), 2, '.', ',');
                                $price_rp = $newprice->price;
                            } else if ($newprice->curr == 'USD') {
                                $newpriceusd = $newprice->price;
                                $price_rp = 0;
                            } else {
                                if ($newprice->curr == "") {
                                    $msg_curr = "<br/><span style='color:#ff0000;font-size:11px;'><i>No currency or price for this item</i></span>";
                                    $rate_value = 0;
                                } else {
                                    $rate_value = $this->model_rate->getRateValue($newprice->curr, 'USD');
                                    if ($rate_value == 0) {
                                        $msg_curr = "<br/><span style='color:#ff0000;font-size:11px;'><i>No rate from<i> " . $newprice->curr . "<i> to </i> USD</span>";
                                    }
                                }
                                $price_rp = 0;
                                $newpriceusd = $newprice->price * $rate_value;
                                $valid = 0;
                            }
                        }
                        if ($newpriceusd != $unitpriceusd) {
                            $bgcolor = "bgcolor='#ffdddd'";
                            $unitpriceusd = $newpriceusd;
                        }
                    }
                    //echo $price_usd . "#" . $result->unitpriceusd . "<br/>";                    
                    $unitpriceusd = number_format((double) $unitpriceusd, 2, '.', ',');
                    $total_in_usd = number_format(($unitpriceusd * $result->req_qty), 3, '.', ',');
                    ?>
                    <tr <?php echo $bgcolor ?>>
                        <td>
                            <?php
                            echo $result->materialcode;
                            echo $msg_curr;
                            ?>
                        </td>
                        <td><?php echo $result->materialdescription; ?></td>
                        <td align="center"><?php echo $result->uom; ?></td>
                        <td align="right"><?php echo ($result->qty == 0) ? "" : $result->qty; ?></td>
                        <td align="center"><?php echo ($result->yield == 0) ? "" : number_format($result->yield, 2, '.', ''); ?></td>
                        <td align="center"><?php echo ($result->allowance == 0) ? "" : $result->allowance; ?></td>
                        <td align="center"><?php echo ($result->req_qty == 0) ? "" : $result->req_qty; ?></td>
                        <td align="right"><?php echo number_format($price_rp, 0, '.', ','); ?></td>
                        <td align="center"><?php echo $unitpriceusd; ?></td>            
                        <td align="right"><?php echo $total_in_usd; ?></td>
                        <td>&nbsp;</td>
                        <td align="center">
                            <?php
                            if ($costing->locked == 'f' && $this->session->userdata('department') == 9) {
                                if (in_array('change_detail', $accessmenu)) {
                                    ?>
                                    <a href="javascript:void(0)" onclick="costing_editdetail(<?php echo $result->id . "," . $id . "," . $costingcategory->id ?>)">Edit</a> | <a href="javascript:void(0)" onclick="costing_deletedetail(<?php echo $result->id . "," . $id ?>)">Delete</a>
                                    <?php
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($costing->locked == 'f' && $this->session->userdata('department') == 9) {
                                if (in_array('change_detail', $accessmenu)) {
                                    ?>
                                    <select style="width: 100%;font-size: 9px;height: 15px;" onchange="costing_move(this,<?php echo $result->id . "," . $id ?>)">                            
                                        <option value="0"></option>
                                        <?php
                                        foreach ($costingcategoryall as $rasultcategory) {
                                            echo "<option value='" . $rasultcategory->id . "'>" . $rasultcategory->name . "</option>";
                                        }
                                        ?>
                                    </select>  
                                    <?php
                                }
                            }
                            ?>
                        </td>
                        <td style='color:red;cursor:pointer;'>
                            <?php
                            if ($result->itemid == 0) {
                                echo "<span title='No Reference Item'>?</span>";
                            }
                            ?>
                        </td>
                    </tr>       
                    <?php
                    $subtotal = $subtotal + $total_in_usd;
                }
                $directmaterialtotal += $subtotal;
                ?>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="right"><b>Sub Total</b></td>
                    <td align="right" bgcolor="#66cc99"><?php echo number_format(($subtotal), 3, '.', ',') ?></td>            
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>       
                <?php
            }
            ?>
            <tr style="background: #999999;">
                <td align="right" colspan="9"><b>Direct Material Total</b></td>            
                <td align="right"><?php echo number_format(($directmaterialtotal), 3, '.', ',') ?></td>            
                <td>&nbsp;</td>        
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="13" style="border: none;">&nbsp;</td>
            </tr>    
            <?php
            $sum_not_direct = array();
            foreach ($costingcategorynotdirect as $costingcategory) {
                $costingdetail = $this->model_costing->selectCostingByHeaderidAndCategoryId($id, $costingcategory->id);
                ?>
                <tr>
                    <td bgcolor="#e9efe8" style="font-size: 11px;"><b><?php echo $costingcategory->name ?></td>
                    <td colspan="12" bgcolor="#e9efe8">
                        <?php
                        if ($costing->locked == 'f' && $this->session->userdata('department') == 9) {
                            if (in_array('change_detail', $accessmenu)) {
                                echo "<img src='images/bomadd.png' class='miniaction' onclick='costing_adddetail(" . $id . "," . $costingcategory->id . ")'/>&nbsp;Add";
                                if ($costingcategory->id == 9) {
                                    echo "<span style='cursor:pointer;' onclick=costing_loaddirectlabour(" . $id . "," . $costingcategory->id . ")><img src='images/load-material.png' class='miniaction'/> Load Default</span>";
                                }
                                echo "&nbsp;&nbsp;&nbsp;<a href='javascript:void(0)' onclick='costing_copypartfrom(" . $id . "," . $costingcategory->id . ")'><img src='images/copy.png'/>&nbsp;Copy From Existing Costing</a>&nbsp;";
                            }
                        }
                        ?>
                    </td>
                </tr>
                <?php
                $subtotal = 0;
                $total_in_usd = 0;
                $msg_curr = "";
                foreach ($costingdetail as $result) {
                    $bgcolor = '';
                    $msg_curr = "";
                    $price_rp = $result->unitpricerp;
                    $unitpriceusd = number_format(($result->unitpricerp / $costing->ratevalue), 2, '.', ',');
                    if ($result->unitpriceusd != 0) {
                        $unitpriceusd = $result->unitpriceusd;
                    }
                    $newpriceusd = $unitpriceusd;
                    if ($flag == 2 && $result->itemid != 0) {
                        if ($result->categoryid == 9) {
                            $newprice = $this->model_directlabour->getPrice($result->itemid);
                        } else {
                            $newprice = $this->model_item->getPrice($result->itemid);
                        }
                        if ($newprice->curr == 'IDR') {
                            $newpriceusd = number_format(($newprice->price / $costing->ratevalue), 2, '.', ',');
                            $price_rp = $newprice->price;
                        } else if ($newprice->curr == 'USD') {
                            $newpriceusd = $newprice->price;
                            $price_rp = 0;
                        } else {
                            if ($newprice->curr == "") {
                                $msg_curr = "<br/><span style='color:#ff0000;font-size:11px;'><i>No currency or price for this item</i></span>";
                                $rate_value = 0;
                            } else {
                                $rate_value = $this->model_rate->getRateValue($newprice->curr, 'USD');
                                if ($rate_value == 0) {
                                    $msg_curr = "<br/><span style='color:#ff0000;font-size:11px;'><i>No rate from<i> " . $newprice->curr . "<i> to </i> USD</span>";
                                }
                            }
                            $price_rp = 0;
                            $newpriceusd = $newprice->price * $rate_value;
                            $valid = 0;
                        }
                        if ($newpriceusd != $unitpriceusd) {
                            $bgcolor = "bgcolor='#ffdddd'";
                            $unitpriceusd = $newpriceusd;
                        }
                    }

                    $unitpriceusd = number_format((double) $unitpriceusd, 2, '.', ',');
                    $total_in_usd = number_format(($unitpriceusd * $result->req_qty), 3, '.', ',');
                    ?>
                    <tr <?php echo $bgcolor ?>>
                        <td>
                            <?php
                            echo $result->materialcode;
                            echo $msg_curr;
                            ?>
                        </td>
                        <td><?php echo $result->materialdescription; ?></td>
                        <td align="center"><?php echo $result->uom; ?></td>
                        <td align="right"><?php echo ($result->qty == 0) ? "" : $result->qty; ?></td>
                        <td align="center"><?php echo ($result->yield == 0) ? "" : number_format($result->yield, 2, '.', ''); ?></td>
                        <td align="center"><?php echo ($result->allowance == 0) ? "" : $result->allowance; ?></td>
                        <td align="center"><?php echo ($result->req_qty == 0) ? "" : $result->req_qty; ?></td>
                        <td align="right"><?php echo number_format($price_rp, 0, '.', ','); ?></td>
                        <td align="center"><?php echo $unitpriceusd; ?></td>            
                        <td align="right"><?php echo $total_in_usd; ?></td>
                        <td>&nbsp;</td>
                        <td align="center">
                            <?php
                            if ($costing->locked == 'f' && $this->session->userdata('department') == 9) {
                                if (in_array('change_detail', $accessmenu)) {
                                    ?>
                                    <a href = "javascript:void(0)" onclick = "costing_editdetail(<?php echo $result->id . ", " . $id . ", " . $costingcategory->id ?>)">Edit</a> | <a href = "javascript:void(0)" onclick = "costing_deletedetail(<?php echo $result->id . ", " . $id ?>)">Delete</a>
                                    <?php
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($costing->locked == 'f' && $this->session->userdata('department') == 9) {
                                if (in_array('change_detail', $accessmenu)) {
                                    ?>
                                    <select style="width: 100%" onchange="costing_move(this,<?php echo $result->id . "," . $id ?>)">                            
                                        <option value="0"></option>
                                        <?php
                                        foreach ($costingcategoryall as $rasultcategory) {
                                            echo "<option value='" . $rasultcategory->id . "'>" . $rasultcategory->name . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <?php
                                }
                            }
                            ?>
                        </td>
                        <td style='color:red;cursor:pointer;'>
                            <?php
                            if ($result->itemid == 0) {
                                echo "<span title='No Reference Item'>?</span>";
                            }
                            ?>
                        </td>
                    </tr>       
                    <?php
                    $subtotal = $subtotal + $total_in_usd;
                }
                $sum_not_direct[$costingcategory->id] = $subtotal;
                ?>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="right"><b>Sub Total</b></td>
                    <td align="right" bgcolor="#66cc99"><?php echo number_format(($subtotal), 3, '.', ',') ?></td>            
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>       
                <tr>
                    <td colspan="12" style="border: none;">&nbsp;</td>
                </tr>    
                <?php
            }
            //$directmaterialtotal = Direct Material
            //$notdirectmaterialtotal = Direct Labou
            $sell_profit = (100 - ($costing->fixed_cost + $costing->variable_cost + $costing->profit_percentage)) / 100;
            if ($costing->updated_price == 'f') {
                $directlabour = $costing->direct_labour;
                $factory_cost_and_profit = $costing->sellprice;
                $pick_list_hardware = $costing->pick_list_hardware;
                $sub_contractor = $costing->sub_contractor;
                $fixed_cost = $costing->fixed_cost_value;
                $variable_cost = $costing->variable_cost_value;
                $port_origin_cost = $costing->port_origin_cost_value;
                $subtotal_ = $costing->sub_total;
                $fob_price = $costing->fob_price;
            } else {
                $directlabour = $sum_not_direct[9];
                $factory_cost_and_profit = round((($directmaterialtotal + $directlabour) / $sell_profit), 2);
                $pick_list_hardware = $sum_not_direct[8];
                $sub_contractor = $sum_not_direct[10];
                $fixed_cost = round(($factory_cost_and_profit * $costing->fixed_cost) / 100, 2);
                $variable_cost = round(($factory_cost_and_profit * $costing->variable_cost) / 100, 2);
                $port_origin_cost = ($factory_cost_and_profit * $costing->port_origin_cost) / 100;
                $subtotal_ = $pick_list_hardware + $sub_contractor + $port_origin_cost;
                $fob_price = $subtotal_ + $factory_cost_and_profit;
            }
            ?>
        </tbody>
    </table><br/>
    <table width="100%" class="tablesorter">
        <body>
        <tr style="border-top: 1px dotted black;">
            <td widtd="14%" style="border-right-color: white;"><b>Summary</b></td>
            <td widtd="15%" style="border-right-color: white;">Direct material<span style="float: right">$</span></td>
            <td widtd="5%"  style="border-right-color: white;text-align: right;">
                <input type="text" id="directmaterial" readonly="" value="<?php echo number_format($directmaterialtotal, 2, '.', ','); ?>" style="text-align: right;border: none;"/>                    
            </td>
            <td widtd="9%"  style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="4%" style="border-right-color: white;">&nbsp;</td>                    
            <td widtd="10%" style="border-right-color: white;" colspan="2">Pick List Hardware<span style="float: right">$</span></td>
            <td widtd="8%" style="border-right-color: white;text-align: right;">
                <input type="text" id="pick_list_hardware" readonly="" value="<?php echo number_format($pick_list_hardware, 2, '.', ','); ?>" style="text-align: right;border: none;"/>                    
            </td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>            
        </tr>
        <tr style="border-top: 1px dotted black;">
            <td widtd="14%" style="border-right-color: white;"></td>
            <td widtd="15%" style="border-right-color: white;">Direct Labour <span style="float: right">$</span></td>
            <td widtd="5%" style="border-right-color: white;text-align: right;">
                <input type="text" id="directlabour"  readonly="" value="<?php echo number_format($directlabour, 2, '.', ','); ?>" style="text-align: right;border: none;"/>                    
            </td>
            <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;" colspan="2">Sub Contractor<span style="float: right">$</span></td>
            <td widtd="10%" style="border-right-color: white;text-align: right;">
                <input type="text" id="sub_contractor"  readonly="" value="<?php echo number_format($sub_contractor, 2, '.', ','); ?>" style="text-align: right;border: none;"/>                    
            </td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>  
            <td widtd="1%" style="border-right-color: white;">&nbsp;</td>    
            <td widtd="1%" style="border-right-color: white;">&nbsp;</td>  
        </tr>
        <tr style="border-top: 1px dotted black;">
            <td widtd="14%" align="right" style="border-right-color: white;">
                <input type="text" id="fixed_cost_percent" readonly="" value="<?php echo $costing->fixed_cost ?>" size="2" style="text-align: right;border: none;font-weight: bold;"/>
            </td>
            <td widtd="15%" style="border-right-color: white;">Fixed Cost (<?php echo $costing->fixed_cost ?>%)<span style="float: right">$</span></td>
            <td widtd="5%"  style="border-right-color: white;;text-align: right;">
                <input type="hidden" id="temp_fixed_cost_value" value="<?php echo $fixed_cost; ?>" style="text-align: right;border: none;"/>                    
                <input type="text" id="fixed_cost_value"  readonly="" value="<?php echo $fixed_cost; ?>" style="text-align: right;border: none;"/>                    
            </td>
            <td widtd="9%"  style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;" colspan="2">Port origin cost (<?php echo $costing->port_origin_cost ?>%)<span style="float: right">$</span></td>
            <td widtd="10%" style="border-right-color: white;text-align: right;">
                <input type="hidden" id="temp_port_origin_cost" value="<?php echo round($port_origin_cost, 2); ?>" style="text-align: right;border: none;"/>
                <input type="text" id="port_origin_cost"  readonly="" value="<?php echo round($port_origin_cost, 2); ?>" style="text-align: right;border: none;"/>
            </td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>   
            <td widtd="1%" style="border-right-color: white;">&nbsp;</td>    
            <td widtd="1%" style="border-right-color: white;">&nbsp;</td>            
        </tr>
        <tr style="border-top: 1px dotted black;">
            <td widtd="14%" align="right" style="border-right-color: white;">
                <input type="text" id="variable_cost_percent"  readonly="" value="<?php echo $costing->variable_cost ?>" size="2" style="text-align: right;border: none;font-weight: bold;"/>                    
            </td>
            <td widtd="15%" style="border-right-color: white;">Variable Cost (<?php echo $costing->variable_cost ?>%)<span style="float: right">$</span></td>
            <td widtd="5%"  style="border-right-color: white;text-align: right">
                <input type="hidden" id="temp_variable_cost_value" value="<?php echo $variable_cost; ?>" style="text-align: right;border: none;"/>                    
                <input type="text" id="variable_cost_value"  readonly="" value="<?php echo $variable_cost; ?>" style="text-align: right;border: none;"/>                    
            </td>
            <td widtd="9%"  style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;" colspan="2"><b>Sub Total</b><span style="float: right">$</span></td>                    
            <td widtd="10%" style="border-right-color: white;text-align: right">
                <input type="hidden" id="temp_sub_total" value="<?php echo round($subtotal_, 2); ?>" style="text-align: right;border: none;"/>
                <input type="text" id="sub_total"  readonly="" value="<?php echo round($subtotal_, 2); ?>" style="text-align: right;border: none;"/>
            </td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>      
            <td widtd="1%" style="border-right-color: white;">&nbsp;</td>    
            <td widtd="1%" style="border-right-color: white;">&nbsp;</td>         
        </tr>
        <tr style="border-top: 1px dotted black;">
            <td widtd="14%" align="right" style="border-right-color: white;">&nbsp;</td>
            <td widtd="15%" style="border-right-color: white;">Factory Cost + Profit<span style="float: right">$</span></td>
            <td widtd="5%"  style="border-right-color: white;text-align: right">
                <input type="hidden" id="sellprice" value="<?php echo $costing->sellprice ?>" />
                <input type="hidden" id="temp_newsellprice" value="<?php echo round($factory_cost_and_profit, 2); ?>" style="text-align: right;border: none;" readonly="true"/>                    
                <input type="text" id="newsellprice"  readonly="" value="<?php echo round($factory_cost_and_profit, 2); ?>" style="text-align: right;border: none;" readonly="true"/>                    
            </td>
            <td widtd="9%"  style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="8%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="8%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>     
            <td widtd="1%" style="border-right-color: white;">&nbsp;</td>    
            <td widtd="1%" style="border-right-color: white;">&nbsp;</td>          
        </tr>
        <tr style="border-top: 1px dotted black;">
            <td widtd="14%" align="right" style="border-right-color: white;">&nbsp;</td>
            <td widtd="15%" style="border-right-color: white;">Profit Percentage</td>
            <td widtd="5%"  style="border-right-color: white;text-align: right;font-weight: bold">
                <input type="hidden" id="temp_profit_percentage" value="<?php echo $costing->profit_percentage ?>" size="6" style="text-align: right;border: none;font-weight: bold;" readonly="true"/>
                <input type="text" id="profit_percentage"  readonly="" value="<?php echo $costing->profit_percentage ?>" size="6" style="text-align: right;border: none;font-weight: bold;" readonly="true"/>
            </td>
            <td widtd="9%"  style="border-right-color: white;text-align: right;">
                <input type="hidden" id="temp_sell_percentage" value="<?php echo $sell_profit; ?>" size="6" style="text-align: right;border: none;" readonly="true"/>                    
                <input type="text" id="sell_percentage"  readonly="" value="<?php echo $sell_profit; ?>" size="6" style="text-align: right;border: none;" readonly="true"/>                    
            </td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="8%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="8%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>      
            <td widtd="1%" style="border-right-color: white;">&nbsp;</td>    
            <td widtd="1%" style="border-right-color: white;">&nbsp;</td>         
        </tr>
        <tr style="border-top: 1px dotted black;">
            <td widtd="14%" align="right" style="border-right-color: white;">&nbsp;</td>
            <td widtd="15%" style="border-right-color: white;"></td>
            <td widtd="5%"  style="border-right-color: white;">&nbsp;</td>
            <td widtd="9%"  style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;" colspan="2">
                <b>FOB PRICE</b><span style="float: right">$</span>
            </td>
            <td widtd="10%" style="border-right-color: white;text-align: right;font-weight: bold;">                    
                <input type="hidden" name="lastfobprice" id="lastfobprice" value="<?php echo $costing->fob_price ?>" />
                <input type="hidden" name="temp_fobprice" id="temp_fobprice" value="<?php echo round($fob_price, 2); ?>" style="text-align: right;border: none;"/>
                <input type="text" name="fobprice" id="fobprice"  readonly="" value="<?php echo round($fob_price, 2); ?>" style="text-align: right;border: none;"/>
            </td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>     
            <td widtd="1%" style="border-right-color: white;">&nbsp;</td>    
            <td widtd="1%" style="border-right-color: white;">&nbsp;</td>          
        </tr>
        <tr style="border-top: 1px dotted black;">
            <td widtd="14%" align="right" style="border-right-color: white;">&nbsp;</td>
            <td widtd="15%" style="border-right-color: white;"></td>
            <td widtd="5%"  style="border-right-color: white;">&nbsp;</td>
            <td widtd="9%"  style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;color: red" colspan="2"><b>PREVIOUS PRICE(20%)</b><span style="float: right">$</span></td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>     
            <td widtd="1%" style="border-right-color: white;">&nbsp;</td>    
            <td widtd="1%" style="border-right-color: white;">&nbsp;</td>          
        </tr>
        </tbody>
    </table>

    <br/>    
    <?php
    if ($this->session->userdata('department') == 9) {
        if (in_array('change_detail', $accessmenu)) {
            if ($flag == 2) {
                echo "<button onclick='costing_updatematerialprice(" . $id . "," . $valid . ")' style='font-size: 11px;'>Update Material Price</button>";
            } else {
                if ($costing->locked == 'f') {
                    if ($costing->isreviewed == 'f') {
                        echo "<button onclick='costing_savefobprice(" . $id . ")' style='font-size: 11px;'>Save</button>";
                    } else {
                        echo "<button onclick='costing_savefobprice(" . $id . ")' style='font-size: 11px;display:none;' id='costingsave'>Save</button>";
                        echo "<button onclick='costing_review()' style='font-size: 11px;' id='review'>Review</button>";
                        echo "<button onclick='costing_ok()' style='font-size: 11px;display:none;' id='ok'>OK</button>";
                        echo "<button onclick='costing_cancel()' style='font-size: 11px;display:none;' id='cancel'>Cancel</button>";
                        echo "<button onclick='costing_review_fixed_profit_percentage()' id='review_fixed_profit_percentage' style='font-size: 11px;display:none;'>Fixed Profit Percentage</button>";
                        echo "<button onclick='costing_review_fixed_sell_price()' id='review_fixed_sell_price' style='font-size: 11px;display:none;'>Fixed Sell Price</button>";
                    }
                }
            }
        }
    }
    ?>    
    <br/>
    <br/>
</div>