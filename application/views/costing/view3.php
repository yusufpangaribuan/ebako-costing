<div>
    <a href="<?php echo base_url() . "index.php/costing/prints/" . $id . "/" . $soid . "/" . $modelid . "/print/0" ?>" target="blank"><button style="font-size: 9px;font-weight: none;">Print</button></a>
    <button onclick="costing_copyfrom(<?php echo $id . "," . $soid . "," . $modelid ?>)" style="font-size: 9px;font-weight: none;">Copy From Existing Costing</button>&nbsp;
    <button onclick="costing_loadfromcuttinglist(<?php echo $id . "," . $soid . "," . $modelid ?>)" style="font-size: 9px;font-weight: none;">Load From Cutting List</button>&nbsp;
    <button onclick="costing_editheader(<?php echo $id ?>)" style="font-size: 9px;font-weight: none;">Edit Header</button>&nbsp;
    <span style="font-weight: bold;">RATE : </span> <input type="text" style="text-align: right" value="<?php echo $header->rate ?>" readonly="" id="current_rate"/>
    <button onclick="costing_savefobprice(<?php echo $id ?>)">SAVE</button>
</div>
<br/>
<table class="tablesorter2" width="100%">
    <thead>
        <tr>
            <th width="14%">Material Code</th>
            <th width="15%">Material Description</th>
            <th width="5%">UOM</th>
            <th width="4%">QTY<br/>based on BOM</th>
            <th width="5%">Yield</th>
            <th width="4%">Allowance</th>
            <th width="4%">REQ'D<br/>QTY</th>
            <th width="8%">UNIT PRICE<br/>(RP)</th>
            <th width="8%">UNIT PRICE<br/>(US$)</th>
            <th width="10%">TOTAL<br/>AMOUNT(US$)</th>
            <th width="10%">%</th>        
            <th width="8%">ACTION</th>
            <th width="7%">MOVE TO</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $directmaterialtotal = 0;
        foreach ($costingcategory as $costingcategory) {
            $costing = $this->model_costing->selectCostingByHeaderidAndCategoryId($id, $costingcategory->id);
            ?>
            <tr>
                <td colspan="13" bgcolor="#e9efe8" style="font-size: 11px;"><img src="images/bomadd.png" class="miniaction" onclick="costing_add(<?php echo $id . "," . $costingcategory->id . "," . $soid . "," . $modelid ?>)"/>&nbsp;<b><?php echo $costingcategory->name ?></b></td>        
            </tr>
            <?php
            $subtotal = 0;
            $total_in_usd = 0;
            foreach ($costing as $result) {
                ?>
                <tr>
                    <td><?php echo $result->materialcode; ?></td>
                    <td><?php echo $result->materialdescription; ?></td>
                    <td align="center"><?php echo $result->uom; ?></td>
                    <td align="right"><?php echo ($result->qty == 0) ? "" : $result->qty; ?></td>
                    <td align="center"><?php echo ($result->yield == 0) ? "" : number_format($result->yield, 2, '.', ''); ?></td>
                    <td align="center"><?php echo ($result->allowance == 0) ? "" : $result->allowance; ?></td>
                    <td align="center"><?php echo ($result->req_qty == 0) ? "" : $result->req_qty; ?></td>
                    <td align="right"><?php echo number_format($result->unitpricerp, 0, '.', ','); ?></td>
                    <td align="center">
                        <?php
                        $unitpriceusd = ($result->unitpricerp / $header->rate);
                        if ($result->unitpriceusd != 0) {
                            $unitpriceusd = $result->unitpriceusd;
                        }
                        echo number_format($unitpriceusd, 2, '.', ',');
                        ?>
                    </td>            
                    <td align="right">
                        <?php
                        $total_in_usd = round(($unitpriceusd * $result->req_qty), 3);
                        echo $total_in_usd;
                        ?>
                    </td>
                    <td>&nbsp;</td>
                    <td align="center">
                        <a href="javascript:void(0)" onclick="costing_edit(<?php echo $result->id . "," . $id . "," . $costingcategory->id . "," . $soid . "," . $modelid ?>)">Edit</a> | <a href="javascript:void(0)" onclick="costing_delete(<?php echo $result->id . "," . $id . "," . $soid . "," . $modelid ?>)">Delete</a>
                    </td>
                    <td>
                        <select style="width: 100%" onchange="costing_move(this,<?php echo $result->id . "," . $id . "," . $soid . "," . $modelid ?>)">                            
                            <option value="0"></option>
                            <?php
                            foreach ($costingcategoryall as $rasultcategory) {
                                echo "<option value='" . $rasultcategory->id . "'>" . $rasultcategory->name . "</option>";
                            }
                            ?>
                        </select>
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
            </tr>       
            <?php
        }
        ?>
        <tr style="background: #999999;">
            <td align="right" colspan="9"><b>Direct Material Total</b></td>            
            <td align="right"><?php echo number_format(($directmaterialtotal), 3, '.', ',') ?></td>            
            <td>&nbsp;</td>        
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="12" style="border: none;">&nbsp;</td>
        </tr>    
        <?php
        $sum_not_direct = array();
        foreach ($costingcategorynotdirect as $costingcategory) {
            $costing = $this->model_costing->selectCostingByHeaderidAndCategoryId($id, $costingcategory->id);
            ?>
            <tr>
                <td colspan="13" bgcolor="#e9efe8" style="font-size: 11px;"><img src="images/bomadd.png" class="miniaction" onclick="costing_add(<?php echo $id . "," . $costingcategory->id . "," . $soid . "," . $modelid ?>)"/>&nbsp;<b><?php echo $costingcategory->name ?></b></td>        
            </tr>
            <?php
            $subtotal = 0;
            $total_in_usd = 0;
            foreach ($costing as $result) {
                ?>
                <tr>
                    <td><?php echo $result->materialcode; ?></td>
                    <td><?php echo $result->materialdescription; ?></td>
                    <td align="center"><?php echo $result->uom; ?></td>
                    <td align="right"><?php echo ($result->qty == 0) ? "" : $result->qty; ?></td>
                    <td align="center"><?php echo ($result->yield == 0) ? "" : number_format($result->yield, 2, '.', ''); ?></td>
                    <td align="center"><?php echo ($result->allowance == 0) ? "" : $result->allowance; ?></td>
                    <td align="center"><?php echo ($result->req_qty == 0) ? "" : $result->req_qty; ?></td>
                    <td align="right"><?php echo number_format($result->unitpricerp, 0, '.', ','); ?></td>
                    <td align="center">
                        <?php
                        $unitpriceusd = number_format(($result->unitpricerp / $header->rate), 2, '.', '');
                        if ($result->unitpriceusd != 0) {
                            $unitpriceusd = $result->unitpriceusd;
                        }
                        echo $unitpriceusd;
                        ?>
                    </td>            
                    <td align="right">
                        <?php
                        $total_in_usd = number_format(($unitpriceusd * $result->req_qty), 3, '.', ',');
                        echo $total_in_usd;
                        ?>
                    </td>
                    <td>&nbsp;</td>
                    <td align="center">
                        <a href="javascript:void(0)" onclick="costing_edit(<?php echo $result->id . "," . $id . "," . $costingcategory->id . "," . $soid . "," . $modelid ?>)">Edit</a> | <a href="javascript:void(0)" onclick="costing_delete(<?php echo $result->id . "," . $id . "," . $soid . "," . $modelid ?>)">Delete</a>
                    </td>
                    <td>
                        <select style="width: 100%" onchange="costing_move(this,<?php echo $result->id . "," . $id . "," . $soid . "," . $modelid ?>)">                            
                            <option value="0"></option>
                            <?php
                            foreach ($costingcategoryall as $rasultcategory) {
                                echo "<option value='" . $rasultcategory->id . "'>" . $rasultcategory->name . "</option>";
                            }
                            ?>
                        </select>
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
            </tr>       
            <tr>
                <td colspan="12" style="border: none;">&nbsp;</td>
            </tr>    
            <?php
        }
        $noname = (100 - ($header->fixed_cost + $header->variable_cost + $header->profit_percentage)) / 100;
        $factory_cost_and_profit = round((($directmaterialtotal + $sum_not_direct[9]) / $noname), 2);
        ?>
        <tr style="border-top: 1px solid black;">
            <td widtd="14%" style="border-right-color: white;"><b>Summary</b></td>
            <td widtd="15%" style="border-right-color: white;">Direct material<span style="float: right">$</span></td>
            <td widtd="5%"  style="border-right-color: white;text-align: right;"><?php echo number_format($directmaterialtotal, 2, '.', ','); ?></td>
            <td widtd="9%"  style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="4%" style="border-right-color: white;">&nbsp;</td>                    
            <td widtd="10%" style="border-right-color: white;" colspan="2">Pick List Hardware<span style="float: right">$</span></td>
            <td widtd="8%" style="border-right-color: white;text-align: right;"><?php echo number_format($sum_not_direct[8], 2, '.', ','); ?></td>
            <td widtd="10%">&nbsp;</td>            
        </tr>
        <tr style="border-top: 1px solid black;">
            <td widtd="14%" style="border-right-color: white;"></td>
            <td widtd="15%" style="border-right-color: white;">Direct labour<span style="float: right">$</span></td>
            <td widtd="5%" style="border-right-color: white;text-align: right;"><?php echo number_format($sum_not_direct[9], 2, '.', ','); ?></td>
            <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;" colspan="2">Sub Contractor<span style="float: right">$</span></td>
            <td widtd="10%" style="border-right-color: white;text-align: right;"><?php echo number_format($sum_not_direct[10], 2, '.', ','); ?></td>
            <td widtd="10%">&nbsp;</td>            
        </tr>
        <tr style="border-top: 1px solid black;">
            <td widtd="14%" align="right" style="border-right-color: white;"><b><?php echo $header->fixed_cost ?></b></td>
            <td widtd="15%" style="border-right-color: white;">Fixed Cost (<?php echo $header->fixed_cost ?>%)<span style="float: right">$</span></td>
            <td widtd="5%"  style="border-right-color: white;;text-align: right;"><?php echo round(($factory_cost_and_profit * $header->fixed_cost) / 100, 2) ?></td>
            <td widtd="9%"  style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;" colspan="2">Port origin cost (<?php echo $header->port_origin_cost ?>%)<span style="float: right">$</span></td>
            <td widtd="10%" style="border-right-color: white;text-align: right;">
                <?php
                $port_origin_cost = ($factory_cost_and_profit * $header->port_origin_cost) / 100;
                echo round($port_origin_cost, 2)
                ?>
            </td>
            <td widtd="10%">&nbsp;</td>            
        </tr>
        <tr style="border-top: 1px solid black;">
            <td widtd="14%" align="right" style="border-right-color: white;"><b><?php echo $header->variable_cost ?></b></td>
            <td widtd="15%" style="border-right-color: white;">Variable Cost (<?php echo $header->variable_cost ?>%)<span style="float: right">$</span></td>
            <td widtd="5%"  style="border-right-color: white;text-align: right"><?php echo round(($factory_cost_and_profit * $header->variable_cost) / 100, 2) ?></td>
            <td widtd="9%"  style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;" colspan="2"><b>Sub Total</b><span style="float: right">$</span></td>                    
            <td widtd="10%" style="border-right-color: white;text-align: right"><?php
                $subtotal_ = $sum_not_direct[8] + $sum_not_direct[10] + $port_origin_cost;
                echo round($subtotal_, 2);
                ?></td>
            <td widtd="10%">&nbsp;</td>            
        </tr>
        <tr style="border-top: 1px solid black;">
            <td widtd="14%" align="right" style="border-right-color: white;">&nbsp;</td>
            <td widtd="15%" style="border-right-color: white;">Factory Cost + Profit<span style="float: right">$</span></td>
            <td widtd="5%"  style="border-right-color: white;text-align: right"><?php
                echo round($factory_cost_and_profit, 2);
                ?></td>
            <td widtd="9%"  style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="8%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="8%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%">&nbsp;</td>            
        </tr>
        <tr style="border-top: 1px solid black;">
            <td widtd="14%" align="right" style="border-right-color: white;">&nbsp;</td>
            <td widtd="15%" style="border-right-color: white;">Profit Percentage</td>
            <td widtd="5%"  style="border-right-color: white;text-align: right;font-weight: bold"><?php echo $header->profit_percentage ?></td>
            <td widtd="9%"  style="border-right-color: white;text-align: right;"><?php echo $noname; ?></td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="8%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="8%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%">&nbsp;</td>            
        </tr>
        <tr style="border-top: 1px solid black;">
            <td widtd="14%" align="right" style="border-right-color: white;">&nbsp;</td>
            <td widtd="15%" style="border-right-color: white;"></td>
            <td widtd="5%"  style="border-right-color: white;">&nbsp;</td>
            <td widtd="9%"  style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;" colspan="2"><b>FOB PRICE</b><span style="float: right">$</span></td>
            <td widtd="10%" style="border-right-color: white;text-align: right;font-weight: bold;">
                <?php
                $fob_price = $subtotal_ + $factory_cost_and_profit;
                
                $this->model_costing->savefobprice($id, round($fob_price, 2));
                ?>
                <input type="text" name="fobprice" id="fobprice" value="<?php echo round($fob_price, 2); ?>" style="text-align: right;border: none;" readonly="true"/>
            </td>
            <td widtd="10%">&nbsp;</td>            
        </tr>
        <tr style="border-top: 1px solid black;">
            <td widtd="14%" align="right" style="border-right-color: white;">&nbsp;</td>
            <td widtd="15%" style="border-right-color: white;"></td>
            <td widtd="5%"  style="border-right-color: white;">&nbsp;</td>
            <td widtd="9%"  style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%" style="border-right-color: white;color: red" colspan="2"><b>PREVIOUS PRICE(20%)</b><span style="float: right">$</span></td>
            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
            <td widtd="10%">&nbsp;</td>            
        </tr>
    </tbody>
</table>
<br/>
<center><button onclick="costing_savefobprice(<?php echo $id ?>)">SAVE</button></center>
<br/>
<br/>
