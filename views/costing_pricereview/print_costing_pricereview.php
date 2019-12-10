<html>
    <head>
        <title>Price List</title>      
        
        <script type="text/javascript">var url = '<?php echo base_url() ?>';</script>
        
        <script src="<?php echo base_url() ?>assets/vendors/jquery/js/jquery-1.9.1.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/Client.js"></script>
        <script src="<?php echo base_url() ?>js/costing_pricereview.js"></script>
    
		<style type="text/css">
			body{ zoom: 1.2;  -moz-transform: scale(1.2);  -moz-transform-origin: 0 0; }
			div#top_bar_notification{position:fixed;text-align:center;width:100%;left: 0; right: 0;top:5px;z-index:9999;margin-left:auto;margin-right:auto;display:center}div#top_bar_notification #message{background-color:#D2D2D2;z-index:9999;width:300px;margin:auto;font-size:12px;text-align:center;vertical-align:middle;padding:2px;border:1px solid #FFF;border-radius:2px;-webkit-border-radius:2px;-webkit-box-shadow:0 2px 4px rgba(0,0,0,.2);box-shadow:0 2px 4px rgba(0,0,0,.2)}div#top_bar_notification #message.message-proggress{background-color:#f9edbe;border:1px solid #f0c36d}div#top_bar_notification #message.message-error{background-color:#ffc4c4;border:1px solid #f0c36d}div#top_bar_notification #message.message-info,div#top_bar_notification #message.message-warning{background-color:#f9edbe;border:1px solid #f0c36d}.error-message{font-size:12px}div#top_bar_notification #message.message-success{background-color:#B5F3C9;border:1px solid #17B54A} .m-row:hover { background-color: #cce9ff; border: 1px solid #bedcf3;}.input-editable{background-color:#f1ffee;border:1px solid #5b9252}
		</style>
          
    </head>
    <body style="margin-top: 30px">
    	<div id="top_bar_notification" style="display: none;"></div>
    <center>
    	<div style="width: 90%;text-align: left;padding-bottom: 40px;">
        	<h2 onclick="show_hide_header()" style="cursor: pointer;">PRICE LIST</h2>
        </div>
        <div id="header_pice_list" style="width: 90%;text-align: left;padding-bottom: 40px;">
        	<table style="float: left;padding-right: 100px;">
        		<?php if( @$price_review_base_on == "rate" ){?>
	        		<tr>
	        			<td>Range Rate</td>
	        			<td> : </td>
	        			<td> <?php echo @$start_ratevalue;?> - <?php echo @$end_ratevalue;?> </td>
	        		</tr>
	        		<tr>
	        			<td>Profit</td>
	        			<td> : </td>
	        			<td> <b><?php echo @$profit_percentage;?></b> %</td>
	        		</tr>
        		<?php } else {?>
	        		<tr>
	        			<td>Range Profit (%)</td>
	        			<td> : </td>
	        			<td> <?php echo @$start_profit;?> - <?php echo @$end_profit;?> </td>
	        		</tr>
	        		<tr>
	        			<td>Rate</td>
	        			<td> : </td>
	        			<td> <b><?php echo @$ratevalue;?></b></td>
	        		</tr>
        		<?php }?>
        		
        		<tr>
        			<td>Fixed Cost</td>
        			<td> : </td>
        			<td> <b><?php echo @$fixed_cost;?></b> %</td>
        		</tr>
        		<tr>
        			<td>Picklist Mark-Up</td>
        			<td> : </td>
        			<td> <b><?php echo @$picklist_mark_up;?></b> </td>
        		</tr>
        	</table>
        	<table style="">
        		<tr>
        			<td colspan="3" style="height: 20px;"></td>
        		</tr>
        		<tr>
        			<td>Variable Cost </td>
        			<td> : </td>
        			<td> <b><?php echo @$variable_cost;?></b> %</td>
        		</tr>
        		<tr>
        			<td>Port Origin Cost </td>
        			<td> : </td>
        			<td> <b><?php echo @$port_origin_cost;?></b> %</td>
        		</tr>
        		<tr>
        			<td>Picklist Rate</td>
        			<td> : </td>
        			<td> <b><?php echo @$picklist_ratevalue;?></b></td>
        		</tr>
        	</table>
        </div>
        
        
        <table width="90%"celpadding="0" cellspacing="0" 
        		style="border-collapse: collapse;border:1px solid black;font-size: 12px;font-family:Verdana,Georgia,Serif;">
            <?php 
				$ranges_length = sizeof($ranges);
			?>
            <thead>
                <tr style="background-color: #dfdfe1;">
                    <th rowspan="2" width="2%" style="border:1px solid black;"><b>No.</b></th>
                    
                    <th rowspan="2" width="14%" style="border:1px solid black;">Model Code</th>
                    <th rowspan="2" width="14%" style="border:1px solid black;">Cust. Code</th>
                    
                    <th rowspan="2" width="9%" style="border:1px solid black;">Customer</th>
                    <th rowspan="2" width="80" style="border:1px solid black;">Image</th>
                    <th rowspan="2" width="20" style="border:1px solid black;">Target Price</th>
                    <th colspan="<?php echo $ranges_length?>" width="" style="border:1px solid black;height: 25px;">
                    	<b><?php echo @$price_review_base_on == "rate"? "Rate" : "Profit (%)" ;?></b>
                    </th>
                </tr>
                <tr>
		        	<?php 
		        		foreach ($ranges as $range){
		        			echo '<th style="border:1px solid black;height:30px;background-color: #caffbe;">' . $range . '</th>';
		        		}
		        	?>
		        </tr>
            </thead>
            <tbody>
				<?php
			        $no = 1;
			        foreach ($costing as $result) {
			            ?>
			            <tr valign="top" style="background-color: <?php echo $no % 2 == 0 ? "#fbfbfb" : "#fff" ?>;">
			                <td style="border:1px solid #000;padding: 5px;" align="right"><?php echo $no++; ?></td>
			                <td style="border:1px solid #000;padding: 5px;"> 
			                	<?php echo '<a href="' . base_url() . 'costing/prints/' . $result->id . '/print/0" target="_blank" style="color: #5255f2;text-decoration: none;">'. $result->code .'</a>'; ?> 
			                </td>
			                <td style="border:1px solid #000;padding: 5px;"><?php echo $result->custcode ?></td>
			                <td style="border:1px solid #000;padding: 5px;"><?php echo $result->customername ?></td>
			                
			                 <td style="border:1px solid #000;" align="center">
					            <img src=" <?php echo base_url()?>/files/<?php echo @$result->filename; ?>" class="miniaction" 
					            	onclick="model_imageview('<?php echo @$result->filename; ?>')" 
					            	style="max-width: 60px;width: 60px;">
		                    </td>
			                
			                <td style="border:1px solid #000;padding: 5px;text-align: right;padding-right: 3px;width: 20px;">
			                	<input style="border: 1px #d0d2cf solid;" type="text" value="<?php echo @$target_price > 0 ? @$target_price : "" ?>" size="8">
			                </td>
			                
			                <?php 
			                	$ratevalue_tmp = 0;
			                	$profit_percentage_tmp = 0;
			                	
				        		foreach ($ranges as $range){
				        			if( @$price_review_base_on == "rate" ){
				        				$ratevalue_tmp = $range;
				        				$profit_percentage_tmp = @$profit_percentage;
				        			}else{
				        				$ratevalue_tmp = @$ratevalue;
				        				$profit_percentage_tmp = $range;
				        			}
				        			
				        	?>
				        			
				        			<td style="border:1px solid #000;text-align:center;padding-top: 10px;padding-bottom: 10px;" class="td_<?php echo $result->id;?>" 
				        				id="td_<?php echo $result->id;?>_rate_<?php echo @$ratevalue_tmp;?>_profit_<?php echo @$profit_percentage_tmp;?>">
						        				<a href="javascript:void(0)" style="text-decoration: none;"
						        					onclick="print_preview_cost_sheet(<?php echo "'" . $result->id . "', '" . @$ratevalue_tmp . "', '". @$profit_percentage_tmp . "', '" . @$fixed_cost . "', '" . @$variable_cost . "', '" . @$port_origin_cost . "', '" . @$picklist_mark_up . "', '" . @$picklist_ratevalue . "'" ?>)">
							        				<?php echo $costing_details[ $result->id ][ $range ]?> 
						        				</a> 
						        				<br/>
						        				<br/>
					        					<input type="radio" name="selected_price_<?php echo $result->id;?>" value="<?php echo $no;?>" style="width: 16px;height: 16px;" 
					        					onclick="set_as_fixed_cost_sheet(<?php echo "'" . $result->id . "', '" . @$ratevalue_tmp . "', '". @$profit_percentage_tmp . "', '" . @$fixed_cost . "', '" . @$variable_cost . "', '" . @$port_origin_cost . "', '" . @$picklist_mark_up . "', '" . @$picklist_ratevalue . "', '" . $costing_details[ $result->id ][ $range ] . "'" ?>)"
					        					title="Select Price As Fixed Cost Sheet"
					        					>
				        				</div>
				        			</td>
				        			
				        	<?php 	}
				        	?>
			                
			            </tr>
			            <?php
			        }
		        ?>
			</tbody>
		</table>	

    </center>
    
    <br/>
    <br/>
    
    <script type="text/javascript">
    
	    function print_preview_cost_sheet(id, ratevalue, profit_percentage, fixed_cost, variable_cost, port_origin_cost, picklist_mark_up, picklist_ratevalue){
		    var url = "<?php echo base_url()?>";
	        var full_url = url + "costing_pricereview/print_preview_cost_sheet?id=" + id 
	        		  + "&ratevalue=" + ratevalue
	        		  + "&profit_percentage=" + profit_percentage 
	        		  + "&fixed_cost=" + fixed_cost 
	        		  + "&variable_cost=" + variable_cost 
	        		  + "&port_origin_cost=" + port_origin_cost
	        		  + "&picklist_mark_up=" + picklist_mark_up
	        		  + "&picklist_ratevalue=" + picklist_ratevalue;
	        
	        var win = window.open( full_url, '_blank');
	        win.focus();
	        
	    }

	    function show_hide_header(){
		        var e = document.getElementById("header_pice_list");
		        if ( e.style.display == 'block' ){
		            e.style.display = 'none';
		        } else{
		            e.style.display = 'block';
		        }
		}
    </script>
</body>
</html>