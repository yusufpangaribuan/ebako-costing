<!DOCTYPE html>
<html lang="en">
<head>
<title>Ebako Costing</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

<?php $base_url = base_url();?>

<script type="text/javascript">var url = '<?php echo base_url() ?>';</script>

<link href="<?php echo $base_url ?>assets/vendors/bootstrap300/bootstrap.css" rel="stylesheet">
<link href="<?php echo $base_url ?>assets/vendors/select2/select2.css" rel="stylesheet">
<link href="<?php echo $base_url ?>assets/vendors/select2/select2-bootstrap.css" rel="stylesheet">
<link href="<?php echo $base_url ?>assets/vendors/bootstrap3-editable/bootstrap-editable.css" rel="stylesheet">

<script src="<?php echo $base_url ?>assets/vendors/jquery/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo $base_url ?>assets/vendors/jquery/js/jquery.mockjax.js"></script>

<script src="<?php echo $base_url ?>assets/vendors/select2/select2.js"></script>
<script src="<?php echo $base_url ?>assets/vendors/momentjs/moment.min.js"></script>
<script src="<?php echo $base_url ?>assets/vendors/bootstrap300/bootstrap.js"></script>
<script src="<?php echo $base_url ?>assets/vendors/bootstrap3-editable/bootstrap-editable.js"></script>

<script src="<?php echo $base_url ?>assets/js/edit_print_out.js"></script>
<script>
	$.fn.editable.defaults.mode = 'popup';
</script>
</head>
    <body>
    <center>
        <table width="900"  celpadding="0" cellspacing="0" style="border-collapse: collapse;border:1px solid black;font-size: 9px;font-family:Verdana,Georgia,Serif;">
            <thead>
                <tr>
                    <th align="left" style="border:1px solid black;">Customer</th>
                    <th colspan="3" style="border:1px solid black;"><?php echo $costing->customername ?></th>
                    <th colspan="4" rowspan="3" style="height: 120px;border:1px solid black;">
                        <img src="<?php echo base_url() . "files/" . $costing->filename; ?>" style="max-width: 150px;max-height: 150px;"/>
                    </th>                    
                    <th style="border:1px solid black;">Date</th>
                    <th style="border:1px solid black;">Cust. Code</th>
                    <th style="border:1px solid black;"><?php echo $costing->custcode ?></th>
                </tr>
                <tr>
                    <th align="left">Dimension (mm)</th>
                    <th style="border:1px solid black;"><?php echo $costing->dw ?></th>
                    <th style="border:1px solid black;"><?php echo $costing->dd ?></th>
                    <th style="border:1px solid black;"><?php echo $costing->dht ?></th>                    
                    <th rowspan="2"><?php echo date('d/m/Y', strtotime($costing->date)) ?></th>
                    <th style="border:1px solid black;">Ebako Code</th>
                    <th style="border:1px solid black;"><?php echo $costing->code ?></th>
                </tr>
                <tr>
                    <th style="border:1px solid black;" align="left">Description</th>
                    <th style="border:1px solid black;" colspan="3">
                        <?php echo $costing->description ?>
                    </th>                    
                    <th style="border:1px solid black;">Rate</th>
                    <th style="border:1px solid black;">&nbsp;</th>

                </tr>
                <tr>
                    <th width="14%" style="border:1px solid black;">Material Code</th>
                    <th width="15%" style="border:1px solid black;">Material Description</th>
                    <th width="5%" style="border:1px solid black;">UOM</th>
                    <th width="9%" style="border:1px solid black;background-color:#bbffb0;">QTY<br/>based on BOM</th>
                    <th width="10%" style="border:1px solid black;">Yield</th>
                    <th width="9%" style="border:1px solid black;">Allowance</th>
                    <th width="4%" style="border:1px solid black;">REQ'D<br/>QTY</th>
                    <th width="8%" style="border:1px solid black;">UNIT PRICE<br/>(RP)</th>
                    <th width="8%" style="border:1px solid black;">UNIT PRICE<br/>(US$)</th>
                    <th width="10%" style="border:1px solid black;">TOTAL<br/>AMOUNT(US$)</th>
                    <th width="10%" style="border:1px solid black;">%</th>            
                </tr>
            </thead>
            <tbody>
                <?php
                $directmaterialtotal = 0;
                $subtotal = 0;
                foreach ($costingcategory as $costingcategory) {
                    $costingdetail = $this->model_costing->selectCostingByHeaderidAndCategoryId($id, $costingcategory->id);
                    ?>
                    <tr>
                        <td colspan="11" bgcolor="#e9efe8" style="font-size: 11px;border:1px solid black;">&nbsp;<b><?php echo $costingcategory->name ?></b></td>        
                    </tr>
                    <?php
                    $subtotal = 0;
                    $total_in_usd = 0;
                    foreach ($costingdetail as $result) {
                        ?>
                        <tr>
                            <td style="border:1px solid black;"><?php echo $result->materialcode; ?></td>
                            <td style="border:1px solid black;"><?php echo $result->materialdescription; ?></td>
                            <td align="center" style="border:1px solid black;"><?php echo $result->uom; ?></td>
                            <td align="right" style="border:1px solid black;background-color:#bbffb0;">
                            	<a id="<?php echo $result->id; ?>" href="#" class="qty-uom" class="editable editable-click" 
                            		data-type="text" 
                            		data-pk="<?php echo $result->id; ?>"
                            		data-categoryid="<?php echo $result->categoryid; ?>"
                            		data-costingid="<?php echo $result->costingid; ?>"
                            		data-title="QTY based of BOM">
	                            	<?php echo ($result->qty == 0) ? "" : $result->qty; ?>
                            	</a>
                            </td>
                            <td align="center" style="border:1px solid black;"><?php echo ($result->yield == 0) ? "" : number_format($result->yield, 2, '.', ''); ?></td>
                            <td align="center" style="border:1px solid black;"><?php echo ($result->allowance == 0) ? "" : $result->allowance; ?></td>
                            <td align="center" style="border:1px solid black;"><?php echo ($result->req_qty == 0) ? "" : $result->req_qty; ?></td>
                            <td align="right" style="border:1px solid black;"><?php echo number_format($result->unitpricerp, 0, '.', ','); ?></td>
                            <td align="center" style="border:1px solid black;">
                                <?php
                                $unitpriceusd = number_format(($result->unitpricerp / $costing->ratevalue), 2, '.', '');
                                if ($result->unitpriceusd != 0) {
                                    $unitpriceusd = $result->unitpriceusd;
                                }
                                echo $unitpriceusd;
                                ?>
                            </td>            
                            <td align="right" style="border:1px solid black;">
                                <?php
                                $total_in_usd = number_format(($unitpriceusd * $result->req_qty), 3, '.', ',');
                                echo $total_in_usd;
                                ?>
                            </td>
                            <td style="border:1px solid black;">&nbsp;</td>
                        </tr>       
                        <?php
                        $subtotal = $subtotal + $total_in_usd;
                    }
                    $directmaterialtotal += $subtotal;
                    ?>
                    <tr>
                        <td style="border:1px solid black;">&nbsp;</td>
                        <td style="border:1px solid black;">&nbsp;</td>
                        <td style="border:1px solid black;">&nbsp;</td>
                        <td style="border:1px solid black;">&nbsp;</td>
                        <td style="border:1px solid black;">&nbsp;</td>
                        <td style="border:1px solid black;">&nbsp;</td>
                        <td style="border:1px solid black;">&nbsp;</td>
                        <td style="border:1px solid black;">&nbsp;</td>
                        <td align="right" style="border:1px solid black;"><b>Sub Total</b></td>
                        <td align="right" bgcolor="#dfdfe1" style="border:1px solid black;"><?php echo number_format(($subtotal), 3, '.', ',') ?></td>            
                        <td>&nbsp;</td>        
                    </tr>       
                    <?php
                }
                ?>           
            <tr style="background: #999999;page-break-after:always">
                <td align="right" colspan="9" style="border:1px solid black;"><b>Direct Material Total</b></td>            
                <td align="right" style="border:1px solid black;"><?php echo number_format(($directmaterialtotal), 3, '.', ',') ?></td>                    
                <td style="border:1px solid black;">&nbsp;</td>        
            </tr>
            <tr>
                <td colspan="10" style="border: none;">&nbsp;</td>
            </tr>    
            <?php
            $sum_not_direct = array();
            foreach ($costingcategorynotdirect as $costingcategory) {
                $costingdetail = $this->model_costing->selectCostingByHeaderidAndCategoryId($id, $costingcategory->id);
                ?>
                <tr>
                    <td colspan="11" bgcolor="#e9efe8" style="font-size: 11px;border:1px solid black;">&nbsp;<b><?php echo $costingcategory->name ?></b></td>        
                </tr>
                <?php
                $subtotal = 0;
                $total_in_usd = 0;
                foreach ($costingdetail as $result) {
                    ?>
                    <tr>
                        <td style="border:1px solid black;"><?php echo $result->materialcode; ?></td>
                        <td style="border:1px solid black;"><?php echo $result->materialdescription; ?></td>
                        <td style="border:1px solid black;" align="center"><?php echo $result->uom; ?></td>
                        <td style="border:1px solid black;" align="right"><?php echo ($result->qty == 0) ? "" : $result->qty; ?></td>
                        <td style="border:1px solid black;" align="center"><?php echo ($result->yield == 0) ? "" : number_format($result->yield, 2, '.', ''); ?></td>
                        <td style="border:1px solid black;" align="center"><?php echo ($result->allowance == 0) ? "" : $result->allowance; ?></td>
                        <td style="border:1px solid black;" align="center"><?php echo ($result->req_qty == 0) ? "" : $result->req_qty; ?></td>
                        <td style="border:1px solid black;" align="right"><?php echo number_format($result->unitpricerp, 0, '.', ','); ?></td>
                        <td style="border:1px solid black;" align="center">
                            <?php
                            $unitpriceusd = number_format(($result->unitpricerp / $costing->ratevalue), 2, '.', '');
                            if ($result->unitpriceusd != 0) {
                                $unitpriceusd = $result->unitpriceusd;
                            }
                            echo $unitpriceusd;
                            ?>
                        </td>            
                        <td style="border:1px solid black;" align="right">
                            <?php
                            $total_in_usd = number_format(($unitpriceusd * $result->req_qty), 3, '.', ',');
                            echo $total_in_usd;
                            ?>
                        </td>
                        <td style="border:1px solid black;">&nbsp;</td>
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
                    <td align="right" bgcolor="#dfdfe1" style="border:1px solid black;"><?php echo number_format(($subtotal), 3, '.', ',') ?></td>            
                    <td>&nbsp;</td>        
                </tr>                           
                <?php
            }
            $noname = (100 - ($costing->fixed_cost + $costing->variable_cost + $costing->profit_percentage)) / 100;
            $factory_cost_and_profit = round((($directmaterialtotal + $sum_not_direct[9]) / $noname), 2);
            ?>
            <tr>
                <td colspan="12"style="border:1px solid black;">&nbsp;</td>
            </tr>    
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
                <td widtd="14%" align="right" style="border-right-color: white;"><b><?php echo $costing->fixed_cost ?></b></td>
                <td widtd="15%" style="border-right-color: white;">Fixed Cost (<?php echo $costing->fixed_cost ?>%)<span style="float: right">$</span></td>
                <td widtd="5%"  style="border-right-color: white;;text-align: right;"><?php echo round(($factory_cost_and_profit * $costing->fixed_cost) / 100, 2) ?></td>
                <td widtd="9%"  style="border-right-color: white;">&nbsp;</td>
                <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="10%" style="border-right-color: white;" colspan="2">Port origin cost (<?php echo $costing->port_origin_cost ?>%)<span style="float: right">$</span></td>
                <td widtd="10%" style="border-right-color: white;text-align: right;">
                    <?php
                    $port_origin_cost = ($factory_cost_and_profit * $costing->port_origin_cost) / 100;
                    echo round($port_origin_cost, 2)
                    ?>
                </td>
                <td widtd="10%">&nbsp;</td>            
            </tr>
            <tr style="border-top: 1px solid black;">
                <td widtd="14%" align="right" style="border-right-color: white;"><b><?php echo $costing->variable_cost ?></b></td>
                <td widtd="15%" style="border-right-color: white;">Variable Cost (<?php echo $costing->variable_cost ?>%)<span style="float: right">$</span></td>
                <td widtd="5%"  style="border-right-color: white;text-align: right"><?php echo round(($factory_cost_and_profit * $costing->variable_cost) / 100, 2) ?></td>
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
                <td widtd="5%"  style="border-right-color: white;text-align: right">
                    <?php
                    echo round($factory_cost_and_profit, 2);
                    ?>
                </td>
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
                <td widtd="5%"  style="border-right-color: white;text-align: right;font-weight: bold"><?php echo $costing->profit_percentage ?></td>
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
                <td widtd="10%" style="border-right-color: white;text-align: right;font-weight: bold;"><?php
                    $fob_price = $subtotal_ + $factory_cost_and_profit;
                    echo round($fob_price, 2);
                    ?></td>
                <td widtd="10%">&nbsp;</td>            
            </tr>
            <tr style="border-top: 1px solid black;">
                <td widtd="14%" align="right">&nbsp;</td>
                <td widtd="15%"></td>
                <td widtd="5%">&nbsp;</td>
                <td widtd="9%" >&nbsp;</td>
                <td widtd="10%">&nbsp;</td>
                <td widtd="9%">&nbsp;</td>
                <td widtd="4%">&nbsp;</td>
                <td widtd="10%" style="color: red" colspan="2"><b>PREVIOUS PRICE(20%)</b><span style="float: right">$</span></td>
                <td widtd="10%">&nbsp;</td>
                <td widtd="10%">&nbsp;</td>            
            </tr>
            </tbody>
        </table>      
        <br/>
        <br/>
            <a href="<?php echo $base_url . "/costing/prints/" . $id . "/print/0" ?>" target="blank"><button style="font-size: 9px;font-weight: none;">Print</button></a><br/><br/>
    </center>
</body>
</html>