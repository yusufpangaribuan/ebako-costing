<?php
if ($st == 2) {
    ?>
    <html>
        <head>
            <title>&nbsp;</title>        
            <STYLE>
                <!-- 
                BODY,table{ font-family:"Verdana"; font-size:8pt; }
                table
                {
                    border-collapse:collapse;
                }
                table, td, th
                {
                    border:1px solid black;
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
                <td style="border: none;text-align: center;"><h2>GOODS RECEIVE REPORT</h2></td>
            </tr>
        </table><br/><br/>
        <table class="tablesorter" width="99%">
            <thead>
                <tr style="background: #cecece">
                    <th>No</th>
                    <th>Date</th>
                    <th>GR</th>
                    <th>PO</th>
                    <th>PR</th>
                    <th>MR/SR</th>
                    <th>Supplier/Vendor</th>
                    <th>Item Code</th>
                    <th>Item Description</th>        
                    <th>Qty</th>        
                    <th>Unit</th> 
                    <th>Receive By</th>
                    <th>Remark</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($gr)) {
                    $no = 1;
                    foreach ($gr as $result) {
                        ?>
                        <tr valign="top">
                            <td align="right"><?php echo $no++ ?></td>
                            <td align="center"><?php echo date('d/m/Y', strtotime($result->gr_date)) ?></td>
                            <td><?php echo $result->gr_number ?></td>
                            <td><?php echo $result->po_number ?></td> 
                            <td><?php echo $result->pr_number ?></td> 
                            <td><?php echo $result->mr_number."".$result->sr_number ?></td>
                            <td><?php echo $result->vendor_name ?></td>                          
                            <td><?php echo $result->item_code ?></td>
                            <td><?php echo $result->item_description ?></td>
                            <td align="right" style="padding-right: 5px;"><?php echo $result->qty ?></td>
                            <td><?php echo $result->unit_code ?></td>
                            <td><?php echo $result->name_receive_by ?></td>
                            <td><?php echo $result->mr_detail_remark ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
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
    <script>window.print();</script>
    </body>
    </html>
<?php } ?>