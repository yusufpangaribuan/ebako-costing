<?php
if ($st == 2) {
    ?>
    <html>
        <head>
            <title>&nbsp;</title>        
            <STYLE>
                <!-- 
                BODY,table{ font-family:"Arial"; font-size:10px; }
                table
                {
                    border-collapse:collapse;
                }
                table, td, th
                {
                    border:1px solid black;
                    padding: 2px;
                }
                -->
            </STYLE>
        </style>
    </head>
    <body>
        <?php
    }
    ?>
<center>
    <div style="padding-bottom: 15px;margin-top: 15px;overflow-x: show">
        <table width="99%" style="border: none">
            <tr>
                <td style="border: none" width="40%">
                    <?php echo $company->name . "<br>" . nl2br($company->address); ?>
                </td>
                <td style="border: none;text-align: center;"><h2>PURCHASE ORDER REPORT</h2></td>
            </tr>
        </table><br/><br/>
        <table class="tablesorter" width="99%">
            <thead>
                <tr style="background: #cecece">
                    <th>No</th>
                    <th>PO NO</th>
                    <th>PO DATE</th>
                    <th>SUPPLIER</th>
                    <th>ITEM CODE</th>
                    <th>ITEM NAME</th>
                    <th>MR NO</th>
                    <th>MR DATE</th>
                    <th>DEPARTMENT REQUEST</th>            
                    <th>UoM</th>
                    <th>QTY ORDER</th>
                    <th>QTY RECEIVE</th>        
                    <th>QTY BALANCE</th>
                    <th>DELIVERY DATE</th>
                    <th>CURRENCY</th>
                    <th>PURCHASE PRICE</th>
                    <th>TOTAL</th>
                    <th>TOTAL (IDR)</th>
                    <th>RATE ID</th>
                    <th>STATUS</th>
                    <th>REMARK</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_id_idr = 0;
                if (!empty($po)) {
                    $no = 1;
                    foreach ($po as $result) {
                        ?>
                        <tr valign="top">
                            <td align="right"><?php echo $no++ ?></td>
                            <td><?php echo $result->po_no ?></td>
                            <td><?php echo date('d/m/Y', strtotime($result->po_date)) ?></td>
                            <td><?php echo $result->vendor_name ?></td> 
                            <td><?php echo $result->itempartnumber ?></td>
                            <td><?php echo $result->itemdescription ?></td>
                            <td><?php echo $result->mr_no ?></td>
                            <td><?php echo ($result->mr_date == "" ? "" : date('d/m/Y', strtotime($result->mr_date))) ?></td>
                            <td><?php echo $result->department_request ?></td>                            
                            <td align="center"><?php echo $result->unit_code ?></td>
                            <td align="right"><?php echo $result->qty ?></td>
                            <td align="right"><?php echo $result->qtyreceive ?></td>
                            <td align="right"><?php echo $result->outstanding ?></td>
                            <td><?php echo $result->date_receive ?></td>
                            <td align="right"><?php echo number_format($result->price, 2) ?></td>
                            <td align="center"><?php echo $result->currency ?></td>
                            <td align="right"><?php echo number_format($result->total, 2) ?></td>
                            <td align="right">
                                <?php
                                echo number_format($result->total_in_idr, 2);
                                $total_id_idr += $result->total_in_idr;
                                ?>
                            </td>
                            <td><?php echo $result->rate_id ?></td>
                            <td><?php echo $result->status_desc ?></td>                                                   
                            <td><?php echo $result->remark ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
                <tr>
                    <td colspan="17" align="center"><b>TOTAL</b></td>
                    <td><b><?php echo number_format($total_id_idr, 2) ?></b></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <table width="99%" style="border: none">
            <tr>
                <td style="border: none" width="40%"><br/>
                    <span style="float: left">Print on <?php echo date('d/m/Y H:i:s') ?></span>
                </td>
            </tr>
        </table>

    </div>
</center>
<?php
if ($st == 2) {
    ?>
        <!--    <script>window.print()</script>-->
    </body>
    </html>
<?php } ?>