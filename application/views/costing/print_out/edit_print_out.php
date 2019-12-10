<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Ebako Costing</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <?php $base_url = base_url(); ?>

        <link href="<?php echo $base_url ?>assets/vendors/bootstrap300/bootstrap.css" rel="stylesheet">
        <link href="<?php echo $base_url ?>assets/vendors/select22/select2.min.css" rel="stylesheet">

        <script src="<?php echo $base_url ?>assets/vendors/jquery/js/jquery-1.9.1.min.js"></script>
        <script src="<?php echo $base_url ?>assets/vendors/bootstrap300/bootstrap.js"></script>


        <script type="text/javascript">var url = '<?php echo base_url() ?>';</script>
        <script type="text/javascript">var active_costingid = '<?php echo $id ?>';</script>
        <script src="<?php echo $base_url ?>assets/vendors/vuejs/vue.js"></script>
        <script src="<?php echo $base_url ?>assets/vendors/vuejs/axios.js"></script>

        <script src="<?php echo $base_url ?>assets/js/components/directmaterial.js"></script>
        <script src="<?php echo $base_url ?>assets/js/components/costingdirectmaterial.js"></script>
        <script src="<?php echo $base_url ?>assets/js/components/costingdirectmaterial_newmaterial.js"></script>

        <script src="<?php echo $base_url ?>assets/js/components/undirectmaterial.js"></script>
        <script src="<?php echo $base_url ?>assets/js/components/costingundirectmaterial.js"></script>
        <script src="<?php echo $base_url ?>assets/js/components/costingundirectmaterial_newmaterial.js"></script>
        <script src="<?php echo $base_url ?>assets/js/components/costingundirectmaterial_newmaterial_directlabour.js"></script>
        <script src="<?php echo $base_url ?>assets/js/components/costingundirectmaterial_newmaterial_picklist.js"></script>


        <script src="<?php echo $base_url ?>assets/vendors/select22/select2.min2.js"></script>
        <script src="<?php echo $base_url ?>assets/js/components/select2.js"></script>
        <script src="<?php echo $base_url ?>assets/js/components/select2remotedata.js"></script>
        <script src="<?php echo $base_url ?>assets/js/Client.js"></script>

        <style type="text/css">
            body{
                zoom: 1.2; 
                -moz-transform: scale(1.2); 
                -moz-transform-origin: 0 0;
            }
            div#top_bar_notification{position:fixed;text-align:center;width:100%;left: 0; right: 0;top:5px;z-index:9999;margin-left:auto;margin-right:auto;display:center}div#top_bar_notification #message{background-color:#D2D2D2;z-index:9999;width:300px;margin:auto;font-size:12px;text-align:center;vertical-align:middle;padding:2px;border:1px solid #FFF;border-radius:2px;-webkit-border-radius:2px;-webkit-box-shadow:0 2px 4px rgba(0,0,0,.2);box-shadow:0 2px 4px rgba(0,0,0,.2)}div#top_bar_notification #message.message-proggress{background-color:#f9edbe;border:1px solid #f0c36d}div#top_bar_notification #message.message-error{background-color:#ffc4c4;border:1px solid #f0c36d}div#top_bar_notification #message.message-info,div#top_bar_notification #message.message-warning{background-color:#f9edbe;border:1px solid #f0c36d}.error-message{font-size:12px}div#top_bar_notification #message.message-success{background-color:#B5F3C9;border:1px solid #17B54A} .m-row:hover { background-color: #cce9ff; border: 1px solid #bedcf3;}.input-editable{background-color:#f1ffee;border:1px solid #5b9252}
            .button-add-costing-detail{
                padding: 1px;
                line-height: 1.1;
                border-radius: 1px;
                font-size: 10px;
                margin-left: 3px;
                background-color: #bbffb0;
                border: 1px solid #45b333;
                margin-top: 0px;
                vertical-align: bottom;
            }
            .button-new-costing-detail {
                padding: 1px;
                line-height: 1.1;
                border-radius: 1px;
                font-size: 10px;
                margin-left: 3px;
                margin-bottom: 5px;
                background-color: #3b5bca;
                border: 1px solid #45b333;
                margin-top: 0px;
                vertical-align: bottom;
                color: #fff;
            }
            .button-cancel-costing-detail {
                background-color: #ec4f4f;
                border: 1px solid #45b333;
                color: #fff;
            }
            .select2-container {
                font-size: 9px;
                max-width: 250px;
            }
            .button-delete-costing-detail {
                padding: 1px;
                line-height: 1.1;
                border-radius: 1px;
                font-size: 8px;
                margin-left: 2px;
                background-color: #ec4f4f;
                border: 1px solid #45b333;
                vertical-align: middle;
                color: #fff;
            }
            .button-move-costing-detail {
                padding: 1px;
                line-height: 1.1;
                border-radius: 1px;
                font-size: 8px;
                margin-left: 2px;
                background-color: #3b5bca;
                border: 1px solid #45b333;
                vertical-align: middle;
                color: #fff;
            }
        </style>    
    </head>
    <body>
        <div id="top_bar_notification" style="display: block;"></div>
    <center>



        <script type="text/javascript">
            $("#hang_header").fadeOut();

            $(document).scroll(function () {
                var y = $(this).scrollTop();
                if (y > 40) {
                    $("#hang_header").fadeIn();
                } else {
                    $("#hang_header").fadeOut();
                }
            });
        </script>

        <table id="app_costing" width="900" celpadding="0" cellspacing="0" style="margin-bottom: 30px;border-collapse: collapse;border:0px solid black;font-size: 9px;font-family:Verdana,Georgia,Serif;">
            <thead>
                <tr>
                    <td colspan="7">
                        <table id="hang_header" width="900" celpadding="0" cellspacing="0" style="border-collapse: collapse;border:1px solid black;font-size: 9px;font-family:Verdana,Georgia,Serif;position: fixed;margin: auto; left: 0;right: 0;padding-top: 0px;background-color: #fff;">
                            <thead>
                                <tr>
                                    <th align="left" style="border:1px solid black;">
                                        <input type="hidden" v-model="costingid" value="<?php echo $id; ?>">
                                        Customer
                                    </th>
                                    <th colspan="3" style="border:1px solid black;">{{costing.customername}}</th>
                                    <th colspan="4" rowspan="3" style="height: 120px;border:1px solid black;">
                                        <img :src="'<?php echo base_url() . "files/" ?>' + costing.filename" style="max-width: 150px;max-height: 150px;"/>
                                    </th>                    
                                    <th style="border:1px solid black;">Date</th>
                                    <th style="border:1px solid black;">Cust. Code</th>
                                    <th style="border:1px solid black;">{{costing.custcode}}</th>
                                </tr>
                                <tr>
                                    <th style="border:1px solid black;"align="left">Dimension (mm)</th>
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
                                    <th style="border:1px solid black;background-color:#bbffb0;">Rate</th>
                                    <th style="border:1px solid black;">
                                        <input style="width: 35px;background-color: #cdffc2;border: 1px solid #5b9252;" type="text" 
                                               v-if="! is_costing_locked" 
                                               v-model="costing.ratevalue" 
                                               v-on:change="onChange_costing_ratevalue" 
                                               :key="'ratevalue'"
                                               >
                                        <label v-if="is_costing_locked">{{costing.ratevalue}}</label>

                                    </th>

                                </tr>
                                <tr>
                                    <th width="14%" style="border:1px solid black;">Material Code</th>
                                    <th width="15%" style="border:1px solid black;">Material Description</th>
                                    <th width="5%" style="border:1px solid black;">UOM</th>
                                    <th width="9%" style="border:1px solid black;background-color:#bbffb0;">QTY<br/>based on BOM</th>
                                    <th width="10%" style="border:1px solid black;background-color:#bbffb0;">Yield</th>
                                    <th width="9%" style="border:1px solid black;background-color:#bbffb0;">Allowance</th>
                                    <th width="4%" style="border:1px solid black;">REQ'D<br/>QTY</th>
                                    <th width="8%" style="border:1px solid black;">UNIT PRICE<br/>(RP)</th>
                                    <th width="8%" style="border:1px solid black;">UNIT PRICE<br/>(US$)</th>
                                    <th width="10%" style="border:1px solid black;">TOTAL<br/>AMOUNT(US$)</th>
                                    <th width="10%" style="border:1px solid black;"></th>            
                                </tr>
                            </thead>
                        </table>
                    </td>
                </tr>
                <tr>
                    <th align="left" style="border:1px solid black;">
                        <input type="hidden" v-model="costingid" value="<?php echo $id; ?>">
                        Customer
                    </th>
                    <th colspan="3" style="border:1px solid black;">{{costing.customername}}</th>
                    <th colspan="4" rowspan="3" style="height: 120px;border:1px solid black;">
                        <img :src="'<?php echo base_url() . "files/" ?>' + costing.filename" style="max-width: 150px;max-height: 150px;"/>
                    </th>                    
                    <th style="border:1px solid black;">Date</th>
                    <th style="border:1px solid black;">Cust. Code</th>
                    <th style="border:1px solid black;">{{costing.custcode}}</th>
                </tr>
                <tr>
                    <th style="border:1px solid black;"align="left">Dimension (mm)</th>
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
                    <th style="border:1px solid black;background-color:#bbffb0;">Rate</th>
                    <th style="border:1px solid black;">
                        <input style="width: 35px;background-color: #cdffc2;border: 1px solid #5b9252;" type="text" 
                               v-if="! is_costing_locked" 
                               v-model="costing.ratevalue" 
                               v-on:change="onChange_costing_ratevalue" 
                               :key="'ratevalue'"
                               >
                        <label v-if="is_costing_locked">{{costing.ratevalue}}</label>

                    </th>

                </tr>
                <tr>
                    <th width="14%" style="border:1px solid black;">Material Code</th>
                    <th width="15%" style="border:1px solid black;">Material Description</th>
                    <th width="5%" style="border:1px solid black;">UOM</th>
                    <th width="9%" style="border:1px solid black;background-color:#bbffb0;">QTY<br/>based on BOM</th>
                    <th width="10%" style="border:1px solid black;background-color:#bbffb0;">Yield</th>
                    <th width="9%" style="border:1px solid black;background-color:#bbffb0;">Allowance</th>
                    <th width="4%" style="border:1px solid black;">REQ'D<br/>QTY</th>
                    <th width="8%" style="border:1px solid black;">UNIT PRICE<br/>(RP)</th>
                    <th width="8%" style="border:1px solid black;">UNIT PRICE<br/>(US$)</th>
                    <th width="10%" style="border:1px solid black;">TOTAL<br/>AMOUNT(US$)</th>
                    <th width="10%" style="border:1px solid black;">%</th>            
                </tr>
            </thead>

            <tbody is="costingdirectmaterial" 
                   @calculate_total_costingdirectmaterial="calculate_total_costingdirectmaterial" 
                   v-for="(directmaterial, index) in costingdirectmaterial" 
                   :key="index + '_direct_material'" 
                   :name="index + '_direct_material'" 
                   v-bind:index_costingdirectmaterial="index" 
                   v-bind:directmaterial_row="directmaterial"
                   > </tbody>

            <tr style="background: #999999;page-break-after:always">
                <td align="right" colspan="9" style="border:1px solid black;"><b>Direct Material Total</b></td>            
                <td align="right" style="border:1px solid black;">{{ summary.total_costingdirectmaterial_in_usd || '0' }}</td>                    
                <td style="border:1px solid black;">&nbsp;</td>        
            </tr>
            <tr>
                <td colspan="10" style="border: none;">&nbsp;</td>
            </tr> 


            <tbody is="costingundirectmaterial" 
                   @calculate_total_costingundirectmaterial="calculate_total_costingundirectmaterial" 
                   v-for="(undirectmaterial, index) in costingundirectmaterial" 
                   :key="index + '_undirect_material'" 
                   :name="index + '_undirect_material'" 
                   v-bind:index_costingundirectmaterial="index" 
                   v-bind:undirectmaterial_row="undirectmaterial"
                   > </tbody>

            <!-- summary -->
            <tr>
                <td colspan="12"style="border:1px solid black;">&nbsp;</td>
            </tr>    
            <tr style="border-top: 1px solid black;">
                <td widtd="14%" style="border-left:1px solid #000;border-right-color: white;"><b>Summary</b></td>
                <td widtd="15%" style="border-right-color: white;">Direct material<span style="float: right">$</span></td>
                <td widtd="5%"  style="border-right-color: white;text-align: right;">{{summary.total_costingdirectmaterial_in_usd | float3decimalPoint}}</td>
                <td widtd="9%"  style="border-right-color: white;">&nbsp;</td>
                <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="4%" style="border-right-color: white;">&nbsp;</td>                    
                <td widtd="10%" style="border-right-color: white;" colspan="2">Pick List Hardware<span style="float: right">$</span></td>
                <td widtd="8%" style="border-right-color: white;text-align: right;">{{get_summary_total_costingundirectmaterial_in_usd_cat_8 | float3decimalPoint}}</td>
                <td widtd="10%" style="border: 1px solid black;">markup
                    <input style="width: 25px;background-color: #cdffc2;border: 1px solid #5b9252;" type="text" 
                           v-if="! is_costing_locked" 
                           v-model="summary.variable_mark_up_cat_8" 
                           v-on:change="onChange_variable_mark_up_cat_8" 
                           :key="'variable_mark_up_cat_8'"
                           >
                    <label v-if="is_costing_locked">{{summary.variable_mark_up_cat_8}}</label>
                </td>
            </tr>
            <tr style="border-top: 1px solid black;">
                <td widtd="14%" style="border-left:1px solid #000;border-right-color: white;"></td>
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
                <td widtd="14%" align="right" style="border-left:1px solid #000;border-right-color: white;">
                    <input style="width: 35px;background-color: #cdffc2;border: 1px solid #5b9252;text-align: right;" type="text" 
                           v-if="! is_costing_locked && access_fob_price_and_profit" 
                           v-model="costing.fixed_cost" 
                           v-on:change="onChange_costing_fixed_cost" 
                           :key="'fixed_cost'"
                           >
                    <label v-if="is_costing_locked && access_fob_price_and_profit"><b>{{costing.fixed_cost}}</b></label>
                </td>
                <td widtd="15%" style="border-right-color: white;">
                    <span v-if="access_fob_price_and_profit">
                        Fixed Cost ({{costing.fixed_cost}}%)<span style="float: right">$</span>
                        <span>
                            </td>
                            <td widtd="5%"  style="border-right-color: white;;text-align: right;">
                                <span v-if="access_fob_price_and_profit">
                                    {{summary.fixed_cost_value | float3decimalPoint}}
                                </span>
                            </td>
                            <td widtd="9%"  style="border-right-color: white;">&nbsp;</td>
                            <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
                            <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
                            <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
                            <td widtd="10%" style="border-right-color: white;" colspan="2">Port origin cost ({{costing.port_origin_cost}}%)<span style="float: right">$</span></td>
                            <td widtd="10%" style="border-right-color: white;text-align: right;">{{summary.port_origin_cost | float3decimalPoint}}</td>
                            <td widtd="10%" style="border: 1px solid black;">&nbsp;</td>            
                            </tr>
                            <tr style="border-top: 1px solid black;">
                                <td widtd="14%" align="right" style="border-left:1px solid #000;border-right-color: white;">
                                    <input style="width: 35px;background-color: #cdffc2;border: 1px solid #5b9252;text-align: right;" type="text" 
                                           v-if="! is_costing_locked && access_fob_price_and_profit" 
                                           v-model="costing.variable_cost" 
                                           v-on:change="onChange_costing_variable_cost" 
                                           :key="'variable_cost'"
                                           >
                                    <label v-if="is_costing_locked && access_fob_price_and_profit"><b>{{costing.variable_cost}}</b></label>
                                </td>
                                <td widtd="15%" style="border-right-color: white;">
                                    <span v-if="access_fob_price_and_profit">
                                        Variable Cost ( {{costing.variable_cost}}%)<span style="float: right">$</span>
                                    </span>
                                </td>
                                <td widtd="5%"  style="border-right-color: white;text-align: right">
                                    <span v-if="access_fob_price_and_profit">
                                        {{summary.variable_cost_value | float3decimalPoint}}</td>
                        </span>
                        <td widtd="9%"  style="border-right-color: white;">&nbsp;</td>
                        <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
                        <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
                        <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
                        <td widtd="10%" style="border-right-color: white;" colspan="2"><b>Sub Total</b><span style="float: right">$</span></td>                    
                        <td widtd="10%" style="border-right-color: white;text-align: right">{{summary.subtotal_cat_8_10 }}</td>
                        <td widtd="10%" style="border: 1px solid black;">&nbsp;</td>
            </tr>
            <tr style="border-top: 1px solid black;">
                <td widtd="14%" align="right" style="border-left:1px solid #000;border-right-color: white;">&nbsp;</td>
                <td widtd="15%" style="border-right-color: white;">
                    <span v-if="access_fob_price_and_profit">
                        Factory Cost + Profit<span style="float: right">$</span>
                    </span>
                </td>
                <td widtd="5%"  style="border-right-color: white;text-align: right">
                    <span v-if="access_fob_price_and_profit">
                        {{summary.factory_cost_and_profit | float3decimalPoint}}
                    </span>
                </td>
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
                <td widtd="14%" align="right" style="border-left:1px solid #000;border-right-color: white;">&nbsp;</td>
                <td widtd="15%" style="border-right-color: white;">
                    <span v-if="access_fob_price_and_profit">
                        Profit Percentage(%)
                    </span>
                </td>
                <td widtd="5%"  style="border-right-color: white;text-align: right;font-weight: bold">
                    <input style="width: 35px;background-color: #cdffc2;border: 1px solid #5b9252;text-align: right;" type="text" 
                           v-if="! is_costing_locked && access_fob_price_and_profit" 
                           v-model="costing.profit_percentage" 
                           v-on:change="onChange_costing_profit_percentage" 
                           :key="'profit_percentage'"
                           >
                    <label v-if="is_costing_locked && access_fob_price_and_profit">{{costing.profit_percentage}}</label>
                </td>
                <td widtd="9%"  style="border-right-color: white;text-align: right;">
                    <span v-if="access_fob_price_and_profit">
                        {{summary.noname | float3decimalPoint}}
                    </span>
                </td>
                <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="8%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="8%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="10%" style="border: 1px solid black;">&nbsp;</td>
            </tr>
            <tr style="border-top: 1px solid black;">
                <td widtd="14%" align="right" style="border-left:1px solid #000;border-right-color: white;">&nbsp;</td>
                <td widtd="15%" style="border-right-color: white;"></td>
                <td widtd="5%"  style="border-right-color: white;">&nbsp;</td>
                <td widtd="9%"  style="border-right-color: white;">&nbsp;</td>
                <td widtd="10%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="9%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="4%" style="border-right-color: white;">&nbsp;</td>
                <td widtd="10%" style="border-right-color: white;" colspan="2">
                    <span v-if="access_fob_price_and_profit"><b>FOB PRICE</b><span style="float: right">$</span></span>
                </td>
                <td widtd="10%" style="border-right-color: white;text-align: right;font-weight: bold;">
                    <span v-if="access_fob_price_and_profit">{{summary.fob_price | float3decimalPoint}}</span>
                </td>
                <td widtd="10%" style="border: 1px solid black;">&nbsp;</td>
            </tr>
            <tr style="border-top: 1px solid black;">
                <td widtd="14%" style="border-left:1px solid #000;" align="right">&nbsp;</td>
                <td widtd="15%"></td>
                <td widtd="5%">&nbsp;</td>
                <td widtd="9%" >&nbsp;</td>
                <td widtd="10%">&nbsp;</td>
                <td widtd="9%">&nbsp;</td>
                <td widtd="4%">&nbsp;</td>
                <td widtd="10%" style="color: red" colspan="2"></td>
                <td widtd="10%">&nbsp;</td>
                <td style="border-right: 1px solid black;">&nbsp;</td>
            </tr>

            <tr style="border-top: 0px;">
                <td colspan="11" style="border-left:1px solid #000;border-right: 1px solid #000;">
            <center>
                <br/>
                <br/>

                <a v-if="! is_costing_locked" v-on:click="loadAllMaterialFromBOM()">
                    <button style="font-size: 14px;font-weight: none;background-color: #e9efe8;border: 2px solid #e1e1e4;">Load All Material from BOM</button>
                </a>

                <a v-if="! is_costing_locked" v-on:click="loadAllMaterialFromDefaultMaterial()">
                    <button style="font-size: 14px;font-weight: none;background-color: #e9efe8;border: 2px solid #e1e1e4;">Load All Material from Default</button>
                </a>

                <a v-if="! is_costing_locked" v-on:click="loadPrice()">
                    <button style="font-size: 14px;font-weight: none;background-color: #e9efe8;border: 2px solid #e1e1e4;">Load Price</button>
                </a>

                <a v-if="! is_costing_locked" style="padding-right: 20px;padding-left: 20px;">
                    <button style="font-size: 14px;font-weight: none;background-color: #2aff00;border: 2px solid #e1e1e4;" v-on:click="saveCostingSummary">Save Summary</button>
                </a>

                <a style="padding-right: 20px;" href="<?php echo $base_url . "costing/prints/" . $id . "/print/0" ?>" target="_blank">
                    <button style="font-size: 14px;font-weight: none;background-color: #e9efe8;border: 2px solid #e1e1e4;">Print</button>
                </a>

                <a v-if="! is_costing_locked" v-on:click="lockCosting()">
                    <button style="font-size: 14px;font-weight: none;background-color: #e9efe8;border: 2px solid #e1e1e4;">Lock</button>
                </a>

                <a v-if="is_costing_locked" v-on:click="unlockCosting()">
                    <button style="font-size: 14px;font-weight: none;background-color: #e9efe8;border: 2px solid #e1e1e4;">UnLock</button>
                </a>

                <br/>
                <br/>            		
                <center>
                    </td>
                    </tr>

                    <tr>
                        <td colspan="11" style="padding-top:50px; border-left:1px solid #000;border-right: 1px solid #000;">
                            <p style="text-decoration: underline; font-style: italic; color: #c10000;font-size: 10px;">
                                Note: Currency format [US-English]: <b style="font-size: 11px;">XXX , XXX , XXX . 000</b>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="border-left:1px solid #000;background-color: #ffeb3b;text-align: center;"> Yellow Row </td>
                        <td colspan="10" style="border-right: 1px solid #000;"> 
                            <p style="font-style: italic; color: #c10000;font-size: 10px;">
                                <b style="font-size: 11px;"> => Row Manually Add/Updated (Price/Qty/Yield/Allowance)</b> 
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="11" style="border:1px solid #000;border-top: 0"><p></p></td>
                    </tr>	
                    </table>      

                </center>

                <script src="<?php echo $base_url ?>assets/js/edit_print_out.js"></script>

                </body>
                </html>