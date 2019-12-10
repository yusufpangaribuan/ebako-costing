<html>
    <head>
        <title>&nbsp;</title>        
    </head>
    <body>
    <center>
        <table width="900"  celpadding="0" cellspacing="0" style="border-collapse: collapse;border:1px solid black;font-size: 9px;font-family:Verdana,Georgia,Serif;">
            <thead>
                <tr>
                    <th align="left" style="border:1px solid black;padding-left: 10px;">Customer</th>
                    <th colspan="3" style="border:1px solid black;"><?php echo $costing->customername ?></th>
                    <th colspan="4" rowspan="3" style="height: 120px;border:1px solid black;">
                        <img src="<?php echo base_url() . "files/" . $costing->filename; ?>" style="max-width: 150px;max-height: 150px;"/>
                    </th>                    
                    <th style="border:1px solid black;">Date</th>
                    <th style="border:1px solid black;">Cust. Code</th>
                    <th style="border:1px solid black;"><?php echo $costing->custcode ?></th>
                </tr>
                <tr>
                    <th align="left" style="padding-left: 10px;">Dimension (mm)</th>
                    <th style="border:1px solid black;"><?php echo $costing->dw ?></th>
                    <th style="border:1px solid black;"><?php echo $costing->dd ?></th>
                    <th style="border:1px solid black;"><?php echo $costing->dht ?></th>                    
                    <th rowspan="2"><?php echo date('d/m/Y', strtotime($costing->date)) ?></th>
                    <th style="border:1px solid black;">Ebako Code</th>
                    <th style="border:1px solid black;"><?php echo $costing->code ?></th>
                </tr>
                <tr>
                    <th style="border:1px solid black;padding-left: 10px;" align="left">Description</th>
                    <th style="border:1px solid black;" colspan="3">
                        <?php echo $costing->description ?>
                    </th>                    
                    <th style="border:1px solid black;">Rate</th>
                    <th style="border:1px solid black;"><?php echo number_format( @$costing->ratevalue , 0, '.', ','); ?></th>

                </tr>
                <tr>
                    <th width="14%" style="border:1px solid black;">Material Code</th>
                    <th width="15%" style="border:1px solid black;">Material Description</th>
                    <th width="5%" style="border:1px solid black;">UOM</th>
                    <th width="9%" style="border:1px solid black;">QTY<br/>based on BOM</th>
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
                    	
                    	if( @$result->qty <= 0 || @$result->qty == '' )
                			continue;
                    	
                    	$req_qty = $result->req_qty;
                    	if( (empty($result->yield) || $result->yield <= 0 )  ){
                    		
	                    	if( $result->allowance < 0 ){
	                    		$req_qty = 0;
	                    	}
                    	} 
                    	
                        ?>
                        <tr>
                            <td style="border:1px solid black;padding-left:15px;"><?php echo $result->materialcode; ?></td>
                            <td style="border:1px solid black;"><?php echo $result->materialdescription; ?></td>
                            <td align="center" style="border:1px solid black;"><?php echo $result->uom; ?></td>
                            <td align="right" style="border:1px solid black;"><?php echo ($result->qty == 0) ? "" : number_format($result->qty, 3, '.', ''); ?></td>
                            <td align="center" style="border:1px solid black;"><?php echo ($result->yield == 0) ? "" : number_format($result->yield, 3, '.', ''); ?></td>
                            <td align="center" style="border:1px solid black;"><?php echo $result->allowance; ?></td>
                            <td align="center" style="border:1px solid black;"><?php echo ($req_qty == 0) ? "" : number_format($req_qty, 3, '.', ''); ?></td>
                            
                            <?php
                                $unitpricerp = number_format($result->unitpricerp, 3, '.', '');
                                if ($result->unitpriceusd != 0) {
                                    $unitpricerp = number_format(($result->unitpriceusd * $costing->ratevalue), 3, '.', '');
                                }
                            ?>
                            
                            <td align="right" style="border:1px solid black;"><?php echo $unitpricerp; ?></td>
                            <td align="center" style="border:1px solid black;">
                                <?php
                                $unitpriceusd = number_format(($result->unitpricerp / $costing->ratevalue), 3, '.', '');
                                if ($result->unitpriceusd != 0) {
                                    $unitpriceusd = $result->unitpriceusd;
                                }
                                echo $unitpriceusd;
                                ?>
                            </td>            
                            <td align="right" style="border:1px solid black;">
                                <?php
                                $total_in_usd = number_format(($unitpriceusd * $req_qty), 3, '.', ',');
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
                        <td colspan="9" align="right" style="border:1px solid black;"><b>Sub Total</b></td>
                        <td align="right" bgcolor="#dfdfe1" style="border:1px solid black;"><?php echo number_format(($subtotal), 3, '.', ',') ?></td>            
                        <td style="border: 1px solid black;">&nbsp;</td>          
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
            
            $ratevalue = $costing->ratevalue;
            
            foreach ($costingcategorynotdirect as $costingcategory) {
                $costingdetail = $this->model_costing->selectCostingByHeaderidAndCategoryId($id, $costingcategory->id);
                
                $subtotal = 0;
                $total_in_usd = 0;
                
                if( $costingcategory->id == 8 ){
                	$ratevalue = $costing->picklist_ratevalue;
                }else{
                	$ratevalue = $costing->ratevalue;
                }
                
                ?>
                <tr>
                    <td colspan="11" bgcolor="#e9efe8" style="font-size: 11px;border:1px solid black;">
                    	&nbsp;<b><?php echo $costingcategory->name ?></b>
                    	<?php if( $costingcategory->id == 8 ){
                    		echo " ( Rate = " . $ratevalue . " )";
                    	}?>
                    </td>        
                </tr>
                <?php
                
                foreach ($costingdetail as $result) {
                	
                	if( @$result->qty <= 0 || @$result->qty == '' )
                		continue;
                	
                	$req_qty = $result->req_qty;
                	
                	if( (empty($result->yield) || $result->yield <= 0 )  ){
                		
                		if( $result->allowance < 0 ){
                			$req_qty = 0;
                		}
                			
                		//if( (empty($result->allowance) )  ){
	                    //		$req_qty = 0;
	                    //}
	                    
                	}
                	
                    ?>
                    <tr>
                        <td style="border:1px solid black;padding-left:15px;"><?php echo $result->materialcode; ?></td>
                        <td style="border:1px solid black;"><?php echo $result->materialdescription; ?></td>
                        <td style="border:1px solid black;" align="center"><?php echo $result->uom; ?></td>
                        <td style="border:1px solid black;" align="right"><?php echo ($result->qty == 0) ? "" : number_format($result->qty, 3, '.', ''); ?></td>
                        <td style="border:1px solid black;" align="center"><?php echo ($result->yield == 0) ? "" : number_format($result->yield, 3, '.', ''); ?></td>
                        <td style="border:1px solid black;" align="center"><?php echo $result->allowance; ?></td>
                        <td style="border:1px solid black;" align="center"><?php echo ($req_qty == 0) ? "" : number_format($req_qty, 3, '.', ''); ?></td>
                        
                        <?php
                        		$unitpricerp = number_format($result->unitpricerp, 3, '.', '');
                                if ($result->unitpriceusd != 0) {
                                    $unitpricerp = number_format(($result->unitpriceusd * $ratevalue), 3, '.', '');
                                }
                        ?>
                        
                        <td style="border:1px solid black;" align="right"><?php echo $unitpricerp; ?></td>
                        <td style="border:1px solid black;" align="center">
                            <?php
                            $unitpriceusd = number_format(($result->unitpricerp / $ratevalue), 3, '.', '');
                            if ($result->unitpriceusd != 0) {
                                $unitpriceusd = $result->unitpriceusd;
                            }
                            echo $unitpriceusd;
                            ?>
                        </td>            
                        <td style="border:1px solid black;" align="right">
                            <?php
                            $total_in_usd = number_format(($unitpriceusd * $req_qty), 3, '.', ',');
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
                    <td colspan="9" align="right" style="border:1px solid black;"><b>Sub Total</b></td>
                    <td align="right" bgcolor="#dfdfe1" style="border:1px solid black;"><?php echo number_format(($subtotal), 3, '.', ',') ?></td>            
                    <td style="border:1px solid black;">&nbsp;</td>
                </tr>  
                <?php
            }
            $noname = round( (100 - ($costing->fixed_cost + $costing->variable_cost + $costing->profit_percentage)) / 100 , 3);
            $factory_cost_and_profit = round( ( ( $directmaterialtotal + $sum_not_direct[9]) / $noname), 3);
            
            ?>
            <tr>
                <td colspan="11"style="border:1px solid black;">&nbsp;</td>
            </tr>    
            </tbody>
        </table>      
        <br/>
        <br/>

    </center>
</body>
</html>