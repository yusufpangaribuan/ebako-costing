<html>
    <head>
        <title>&nbsp;</title>        
        <STYLE>
            <!-- 
            BODY,table{ font-family:"Verdana"; font-size:8pt; }
            table{
                border: none;
            }
            table.useborder{
                border-collapse:collapse;
            }
            table.useborder td, th
            {
                border:1px solid black;
            }
            -->
        </STYLE>
    </style>
</head>
<body>
<center><br/><br/>
    <div style="width: 900px;border: 1px solid #000000;">           
        <table width="99%" style="border: none">
            <tr>
                <td style="border: none" width="35%">
                    <b>PT. EBAKO NUSANTARA</b><br/>
                    Jl. Terboyong Industri Barat Dalam II Blok N/3C<br/>
                    Kawasan Industri Terboyong Semarang<br/>
                    Phone: (024) 6593407 Fax. (024) 6591732 	
                </td>
                <td style="border: none;text-align: center;"><h2>SALES ORDER</h2></td>
            </tr>
        </table><br/>
        <table width="100%" border="0">
            <tr valign="top">
                <td width="30%">
                    <table width="100%">
                        <tr>
                            <td align="left" width="40%"><b>SO NUMBER </b><span style="float: right;">:</td>
                            <td width="60%"><?php echo $so->number ?></td>
                        </tr>
                        <tr>
                            <td align="left" width="30%"><b>SO DATE</b><span style="float: right;">:</td>
                            <td width="60%"><?php echo $so->date ?></td>
                        </tr>
                        <tr>
                            <td width="40%" align="left"><b>SALES PERSON</b><span style="float: right;">:</td>
                            <td width="60%"><?php echo $so->salesperson ?></td>
                        </tr>
                        <tr>
                            <td width="40%" align="left"><b>Currency : </b><span style="float: right;">:</td>
                            <td width="60%"><?php echo $so->curr ?></td>
                        </tr>
                    </table>
                </td>
                <td width="40%" valign="top">                    
                    <table width="100%" border="0">                                                
                        <tr>
                            <td width="40%" align="left"><b>CUSTOMER</b><span style="float: right;">:</td>
                            <td width="60%"><?php echo $so->billtoname ?></td>
                        </tr>
                        <tr>
                            <td width="40%" align="left"><b>SHIP TO</b><span style="float: right;">:</td>
                            <td width="60%"><?php echo $so->shiptoname ?></td>
                        </tr>
                        <tr valign="top">
                            <td width="40%" align="left"><b>SHIP. ADDRESS</b><span style="float: right;">:</td>
                            <td width="60%"><?php echo $so->shippingaddress ?></td>
                        </tr>                        
                        <tr valign="top">
                            <td width="40%" align="left"><b>SHIP. SCHEDULE</b><span style="float: right;">:</span></td>
                            <td width="60%">&nbsp;<?php echo $so->shipmentschedule ?></td>
                        </tr>
                    </table>
                </td> 
                <td width="30%">
                    <table width="100%" border="0">                        
                        <tr>
                            <td width="40%" align="left"><b>PO NO</b><span style="float: right;">:</td>
                            <td width="60%"><?php echo $so->ponumber ?></td>
                        </tr>
                        <tr>
                            <td width="40%" align="left"><b>SHIP VIA</b><span style="float: right;">:</td>
                            <td width="60%"><?php echo $so->shipvia ?></td>
                        </tr>
                        <tr>
                            <td width="40%" align="left"><b>TESTING</b><span style="float: right;">:</td>
                            <td width="60%"><?php echo $so->testingname ?></td>
                        </tr>
                        <tr>
                            <td width="40%" align="left"><b>TERM</b><span style="float: right;">:</td>
                            <td width="60%">
                                <?php
                                list($amterm, $awterm, $adterm) = explode('-', $so->allterm);
                                echo!empty($amterm) ? $amterm . " Month " : "";
                                echo!empty($awterm) ? $awterm . " Week " : "";
                                echo!empty($adterm) ? $adterm . " Days " : "";
                                ?>                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>            
            <tr>
                <td colspan="3">
                    <br/>
                    <br/>
                    <table width="100%" class="useborder">
                        <thead>
                            <tr style="background: #cecece">
                                <th width="2%">NO</th>
                                <th width="20%">CODE</th>
                                <th width="38%">DESCRIPTION</th>
                                <th width="10%">QTY</th>
                                <th width="15%">PRICE</th>
                                <th width="15%">AMOUNT</th>
                            </tr>
                        </thead>
                        <tbody id="itemso">
                            <?php
                            $counter = 1;
                            foreach ($soitem as $result) {
                                ?>
                                <tr valign="top">
                                    <td><?php echo $counter++ ?></td>
                                    <td align="center"><?php echo $result->no ?></td>                                    
                                    <td><?php echo $result->modeldescription ?></td>
                                    <td align="center"><?php echo $result->qty ?></td>
                                    <td align="right"><?php echo $result->price ?>&nbsp;</td>
                                    <td align="right"><?php echo $result->amount; ?>&nbsp;</td>
                                </tr>
                                <?php
                            }
                            ?>                            
                        </tbody>                            
                    </table>            
                </td>
            </tr>
            <tr valign="top">
                <td width="40%" colspan="2">
                    <br/><br/>
                    <table width="100%" border="0">
                        <tr valign="top">
                            <td align="left" width="25%"><b>PAYMENT TERM </b><span style="float: right;">:</td>
                            <td width="75%"><?php echo $so->paymentterm ?></td>
                        </tr>
                        <tr valign="top">
                            <td align="left"><b>LOAD ABILITY</b><span style="float: right;">:</td>
                            <td><?php echo $so->loadability ?></td>
                        </tr>
                        <tr valign="top">
                            <td align="left"><b>QUO. VALIDITY</b><span style="float: right;">:</td>
                            <td><?php echo $so->quotationvalidity ?></td>
                        </tr>                        
                    </table>
                </td>
                <td width="60%">&nbsp;</td>
            </tr>
        </table>
        <br/>
        <br/>        
    </div>
</center>
</body>
</html>