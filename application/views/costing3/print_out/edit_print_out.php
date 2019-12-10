<!DOCTYPE html>
<html lang="en">
<head>
<title>Ebako Costing</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

<?php $base_url = base_url();?>

<link href="<?php echo $base_url ?>assets/vendors/bootstrap300/bootstrap.css" rel="stylesheet">
<script src="<?php echo $base_url ?>assets/vendors/jquery/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo $base_url ?>assets/vendors/bootstrap300/bootstrap.js"></script>

<script type="text/javascript">var url = '<?php echo base_url() ?>';</script>
<script type="text/javascript">var active_costingid = '<?php echo $id ?>';</script>
<script src="<?php echo $base_url ?>assets/vendors/vuejs/vue.js"></script>
<script src="<?php echo $base_url ?>assets/vendors/vuejs/axios.js"></script>
<script src="<?php echo $base_url ?>assets/js/components/directmaterial.js"></script>
<script src="<?php echo $base_url ?>assets/js/components/costingdirectmaterial.js"></script>
<script src="<?php echo $base_url ?>assets/js/components/undirectmaterial.js"></script>
<script src="<?php echo $base_url ?>assets/js/components/costingundirectmaterial.js"></script>

<script src="<?php echo $base_url ?>assets/vendors/jquery/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo $base_url ?>assets/js/Client.js"></script>
    
<style type="text/css">
	div#top_bar_notification{position:fixed;text-align:center;width:100%;top:5px;z-index:9999;margin-left:auto;margin-right:auto;display:center}div#top_bar_notification #message{background-color:#D2D2D2;z-index:9999;width:300px;margin:auto;font-size:12px;text-align:center;vertical-align:middle;padding:2px;border:1px solid #FFF;border-radius:2px;-webkit-border-radius:2px;-webkit-box-shadow:0 2px 4px rgba(0,0,0,.2);box-shadow:0 2px 4px rgba(0,0,0,.2)}div#top_bar_notification #message.message-proggress{background-color:#f9edbe;border:1px solid #f0c36d}div#top_bar_notification #message.message-error{background-color:#ffc4c4;border:1px solid #f0c36d}div#top_bar_notification #message.message-info,div#top_bar_notification #message.message-warning{background-color:#f9edbe;border:1px solid #f0c36d}.error-message{font-size:12px}div#top_bar_notification #message.message-success{background-color:#B5F3C9;border:1px solid #17B54A} .m-row:hover { background-color: #cce9ff; border: 1px solid #bedcf3;}
</style>    
</head>
    <body onblur="">
    <div id="top_bar_notification" style="display: none;"></div>
	<center style="padding-top: 10px;padding-bottom: 30px;">
        <table id="app_costing" width="900" celpadding="0" cellspacing="0" style="border-collapse: collapse;border:1px solid black;font-size: 9px;font-family:Verdana,Georgia,Serif;">
        	<thead>
                <tr>
                    <th align="left" style="border:1px solid black;">
	                    <input type="hidden" v-model="costingid" value="<?php echo $id;?>">
	                    Customer
                    </th>
                    <th colspan="3" style="border:1px solid black;">{{costing.customername}}</th>
                    <th colspan="4" rowspan="3" style="height: 120px;border:1px solid black;">
                        <img :src="'<?php echo base_url() . "files/"?>' + costing.filename" style="max-width: 150px;max-height: 150px;"/>
                    </th>                    
                    <th style="border:1px solid black;">Date</th>
                    <th style="border:1px solid black;">Cust. Code</th>
                    <th style="border:1px solid black;">{{costing.custcode}}</th>
                </tr>
                <tr>
                    <th align="left">Dimension (mm)</th>
                    <th style="border:1px solid black;">{{costing.dw}}</th>
                    <th style="border:1px solid black;">{{costing.dd}}</th>
                    <th style="border:1px solid black;">{{costing.dht}}</th>                    
                    <th rowspan="2"><?php echo date('d/m/Y', strtotime($costing->date)) ?></th>
                    <th style="border:1px solid black;">Ebako Code</th>
                    <th style="border:1px solid black;">{{costing.code}}</th>
                </tr>
                <tr>
                    <th style="border:1px solid black;" align="left">Description</th>
                    <th style="border:1px solid black;" colspan="3"> {{costing.description}} </th>                    
                    <th style="border:1px solid black;">Rate</th>
                    <th style="border:1px solid black;">{{costing.ratevalue}}</th>

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
            
			<tbody is="costingdirectmaterial" @calculate_total_costingdirectmaterial="calculate_total_costingdirectmaterial" v-for="(directmaterial, index) in costingdirectmaterial" :key="index + '_direct_material'" :name="index + '_direct_material'" v-bind:directmaterial_row="directmaterial"> </tbody>
			
			<tr style="background: #999999;page-break-after:always">
                <td align="right" colspan="9" style="border:1px solid black;"><b>Direct Material Total</b></td>            
                <td align="right" style="border:1px solid black;">{{ summary.total_costingdirectmaterial_in_usd || '0' }}</td>                    
                <td style="border:1px solid black;">&nbsp;</td>        
            </tr>
            <tr>
                <td colspan="10" style="border: none;">&nbsp;</td>
            </tr> 
            
            
			<tbody is="costingundirectmaterial" @calculate_total_costingundirectmaterial="calculate_total_costingundirectmaterial" v-for="(undirectmaterial, index) in costingundirectmaterial" :key="index + '_undirect_material'" :name="index + '_undirect_material'" v-bind:undirectmaterial_row="undirectmaterial"> </tbody>
            
			<!-- summary -->
			<tr>
                <td colspan="12"style="border:1px solid black;">&nbsp;</td>
            </tr>    
            <tr style="border-top: 1px solid black;">
                <td widtd="14%" style="border-right-color: white;"><b>Summary</b></td>
                <td widtd="15%" style="border-right-color: white;">Direct material<span style="float: right">$</span></td>
                <td widtd="5%"  style="border-right-color: white;text-align: right;">{{summary.total_costingdirectmaterial_in_usd | float3decimalPoint}}</td>
                <td widtd="9%"  style="border-right-color: white;">&nbsp;</td>
                <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="4%" style="border-right-color: white;">&nbsp;</td>                    
                <td widtd="10%" style="border-right-color: white;" colspan="2">Pick List Hardware<span style="float: right">$</span></td>
                <td widtd="8%" style="border-right-color: white;text-align: right;">{{get_summary_total_costingundirectmaterial_in_usd_cat_8 | float3decimalPoint}}</td>
                <td widtd="10%" style="border: 1px solid black;">markup
                	<input style="width: 30px" type="text" v-model="summary.variable_mark_up_cat_8" v-on:change="onChange_variable_mark_up_cat_8" :key="'variable_mark_up_cat_8'">
                </td>
            </tr>
            <tr style="border-top: 1px solid black;">
                <td widtd="14%" style="border-right-color: white;"></td>
                <td widtd="15%" style="border-right-color: white;">Direct labour<span style="float: right">$</span></td>
                <td widtd="5%" style="border-right-color: white;text-align: right;">{{summary.total_costingundirectmaterial_in_usd.cat_9 | float3decimalPoint}}</td>
                <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="10%" style="border-right-color: white;" colspan="2">Sub Contractor<span style="float: right">$</span></td>
                <td widtd="10%" style="border-right-color: white;text-align: right;">{{summary.total_costingundirectmaterial_in_usd.cat_10 | float3decimalPoint}}</td>
                <td widtd="10%" style="border: 1px solid black;">&nbsp;</td>         
            </tr>
            <tr style="border-top: 1px solid black;">
                <td widtd="14%" align="right" style="border-right-color: white;"><b>{{costing.fixed_cost}}</b></td>
                <td widtd="15%" style="border-right-color: white;">Fixed Cost ({{costing.fixed_cost}}%)<span style="float: right">$</span></td>
                <td widtd="5%"  style="border-right-color: white;;text-align: right;">{{summary.fix_cost | float3decimalPoint}}</td>
                <td widtd="9%"  style="border-right-color: white;">&nbsp;</td>
                <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="10%" style="border-right-color: white;" colspan="2">Port origin cost ({{costing.port_origin_cost}}%)<span style="float: right">$</span></td>
                <td widtd="10%" style="border-right-color: white;text-align: right;">{{summary.port_origin_cost | float3decimalPoint}}</td>
                <td widtd="10%" style="border: 1px solid black;">&nbsp;</td>            
            </tr>
            <tr style="border-top: 1px solid black;">
                <td widtd="14%" align="right" style="border-right-color: white;"><b>{{costing.variable_cost}}</b></td>
                <td widtd="15%" style="border-right-color: white;">Variable Cost ( {{costing.variable_cost}}%)<span style="float: right">$</span></td>
                <td widtd="5%"  style="border-right-color: white;text-align: right">{{summary.variable_cost | float3decimalPoint}}</td>
                <td widtd="9%"  style="border-right-color: white;">&nbsp;</td>
                <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="10%" style="border-right-color: white;" colspan="2"><b>Sub Total</b><span style="float: right">$</span></td>                    
                <td widtd="10%" style="border-right-color: white;text-align: right">{{summary.subtotal_cat_8_10 }}</td>
                <td widtd="10%" style="border: 1px solid black;">&nbsp;</td>
            </tr>
            <tr style="border-top: 1px solid black;">
                <td widtd="14%" align="right" style="border-right-color: white;">&nbsp;</td>
                <td widtd="15%" style="border-right-color: white;">Factory Cost + Profit<span style="float: right">$</span></td>
                <td widtd="5%"  style="border-right-color: white;text-align: right">{{summary.factory_cost_and_profit | float3decimalPoint}}</td>
                <td widtd="9%"  style="border-right-color: white;">&nbsp;</td>
                <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="8%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="8%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="10%" style="border: 1px solid black;">&nbsp;</td>
            </tr>
            <tr style="border-top: 1px solid black;">
                <td widtd="14%" align="right" style="border-right-color: white;">&nbsp;</td>
                <td widtd="15%" style="border-right-color: white;">Profit Percentage</td>
                <td widtd="5%"  style="border-right-color: white;text-align: right;font-weight: bold">{{costing.profit_percentage}}</td>
                <td widtd="9%"  style="border-right-color: white;text-align: right;">{{summary.noname | float3decimalPoint}}</td>
                <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="8%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="8%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="10%" style="border: 1px solid black;">&nbsp;</td>
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
                <td widtd="10%" style="border-right-color: white;text-align: right;font-weight: bold;">{{summary.fob_price | float3decimalPoint}}</td>
                <td widtd="10%" style="border: 1px solid black;">&nbsp;</td>
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
                <td style="border-right: 1px solid black;">&nbsp;</td>
            </tr>
            
            <tr style="border-top: 0px;">
            	<td colspan="11" style="border-right: 1px solid #000;">
            		<center>
						<br/>
				        <br/>
				        <a style="padding-right: 20px;">
				        	<button style="font-size: 14px;font-weight: none;background-color: #2aff00;border: 2px solid #e1e1e4;" v-on:click="saveCostingSummary">Save Summary</button>
				        </a>
				        
				        <a href="<?php echo $base_url . "/costing/prints/" . $id . "/print/0" ?>" target="blank">
				        	<button style="font-size: 14px;font-weight: none;background-color: #e9efe8;border: 2px solid #e1e1e4;">Print</button>
				        </a>
				        <br/>
				        <br/>            		
			        <center>
            	</td>
            </tr>
			
        </table>      
            
    </center>
    
    <script src="<?php echo $base_url ?>assets/js/edit_print_out.js"></script>
    
</body>
</html>