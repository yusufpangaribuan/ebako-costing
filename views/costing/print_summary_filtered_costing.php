<html>
    <head>
        <title>&nbsp;</title>        
    </head>
    <body style="margin-top: 30px">
    <center>
        <table width="90%"celpadding="0" cellspacing="0" 
        		style="border-collapse: collapse;border:1px solid black;font-size: 12px;font-family:Verdana,Georgia,Serif;">
            <thead>
                <tr style="background-color: #e9efe8">
                    <th width="2%" style="border:1px solid black;"><b>No.</b></th>
                    
                    <th width="14%" style="border:1px solid black;">Image</th>
                    <th width="14%" style="border:1px solid black;">Model Code</th>
                    <th width="14%" style="border:1px solid black;">Cust. Code</th>
                    <th width="15%" style="border:1px solid black;">Description</th>
                    
                    <th width="5%" style="border:1px solid black;">Finish Overview</th>
                    <th width="5%" style="border:1px solid black;">Construction Overview</th>
                    
                    <th width="5%" style="border:1px solid black;">W</th>
                    <th width="5%" style="border:1px solid black;">D</th>
                    <th width="5%" style="border:1px solid black;">H</th>
                    <th width="5%" style="border:1px solid black;">NW</th>
                    <th width="5%" style="border:1px solid black;">GW</th>
                    
                    <th width="9%" style="border:1px solid black;">Customer</th>
                    <th width="4%" style="border:1px solid black;">Date</th>
                    
                    <th width="4%" style="border:1px solid black;">Rate</th>
                    
                    <?php if( $this->session->userdata('department') != 8 /*selain PRCH*/ ){?>
                    <th width="8%" style="border:1px solid black;">Prof(%)</th>
                    <th width="8%" style="border:1px solid black;">FOB Price</th>
                    <?php }?>
                    
                    <th width="10%" style="border:1px solid black;">Status</th>
                </tr>
            </thead>
            <tbody>
			
				<?php
	        $no = 1;
	        
	        foreach ($costing as $result) {
	            $time1 = strtotime($result->date);
	            $nextexpired = strtotime('+1 year', $time1);
	            $time2 = strtotime(date('Y-m-d'));
	            $msg = "";
	            $bgcolor = "";
	            if (($nextexpired - $time2) < 2592000 || ($time2 > $nextexpired )) {
	                if (($time2 >= $nextexpired)) {
	                    $msg = "<br/><span style='color:red;font-size:11px;'><i>Need To Review<br/>Costing Expired </i></span>";
	                } else {
	                    $days = (($nextexpired - $time2) / 86400);
	                    $msg = "<br/><span style='color:red;font-size:11px;'><i>Need To Review<br/>Will be expired in $days days</i></span>";
	                }
	                $bgcolor = "bgcolor='#ffe1e4'";
	            }
	            if ($result->fob_price == '') {
	                $bgcolor = "bgcolor='#ffffd7'";
	                $msg = "";
	            }if ($result->needmodify == 't') {
	                $bgcolor = "bgcolor='#ffffd7'";
	                $msg = "<br/><span style='color:red;font-size:11px;'><i>Need to modify because some items have been changed by the R & D</i></span>";
	            }
	            ?>
	            <tr valign="top">
	                <td align="right" style="border:1px solid #000;"><?php echo $no++; ?></td>
	                <td align="center" style="border:1px solid #000;">
			            <img src="<?php echo base_url() . ( "files/". @$result->filename )?>" class="miniaction" onclick="model_imageview('<?php echo @$result->filename; ?>')" style="max-width: 40px;max-height: 40px;width: 40px;height: 40px;">
                    </td>
                    
	                <td style="border:1px solid #000;">
	                    <?php
	                    echo $result->code;
	                    echo $msg;
	                    ?>
	                </td>
	                <td style="border:1px solid #000;"><strong><?php echo $result->custcode ?></strong></td>
	                <td style="border:1px solid #000;"><?php echo $result->description ?></td>
	                
	                <td style="border:1px solid #000;">
                        <?php
                        	$strarray = str_replace(array("{", "}"), "", $result->finishoverview);
                            $arrfinishoverview = explode(',', $strarray);
                            $arrconstructionoverview = explode(',', $strarray);
                            foreach ($finishoverview as $fo) {
                            	if (in_array($fo->id, $arrfinishoverview)) {
                                	echo $fo->name . "<br/>";
                                }
                            }
                    	?>
                    </td>
                    <td style="border:1px solid #000;">
                    	<?php
                        	$strarray = str_replace(array("{", "}"), "", $result->constructionoverview);
                        	$arrconstructionoverview = explode(',', $strarray);
                            foreach ($constructionoverview as $co) {
                            	if (in_array($co->id, $arrconstructionoverview)) {
                                	echo $co->name . "<br/>";
                                }
                             }
                         ?>
                    </td>
	                
	                <td style="border:1px solid #000;"><?php echo @$result->dw; ?></td>
	                <td style="border:1px solid #000;"><?php echo @$result->dd; ?></td>
	                <td style="border:1px solid #000;"><?php echo @$result->dht; ?></td>
	                <td style="border:1px solid #000;"><?php echo @$result->nw; ?></td>
	                <td style="border:1px solid #000;"><?php echo @$result->gw; ?></td>
	                
	                <td style="border:1px solid #000;"><?php echo $result->customername ?></td>
	                <td style="border:1px solid #000;" align="center"><?php echo (!empty($result->date)) ? date('d/m/Y', strtotime($result->date)) : ''; ?></td>
	                
	                <td style="border:1px solid #000;" align="right"><?php echo $result->ratevalue ?></td>
	                
	                <?php if( $this->session->userdata('department') != 8 /*selain PRCH*/ ){?>
	                <td style="border:1px solid #000;" align="center"><?php echo $result->profit_percentage ?></td>
	                <td style="border:1px solid #000;" align="right"><?php echo $result->fob_price ?></td>
	                <?php }?>
	                
	                <td style="border:1px solid #000;" align="center">
	                    <?php
	                    if ($result->locked == 't') {
	                        if ($result->approve != 'f') {
	                            echo "Approved";
	                        }
	                    }
	                    ?>
	                </td>
	                

	            </tr>
	            <?php
	        }
	        ?>
			</tbody>
		</table>	

    </center>
</body>
</html>