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
    <div style="min-width: 800px;border: 1px #000000 solid;padding-bottom: 15px;margin-top: 15px;">
        <table width="99%" style="border: none">
            <tr>
                <td style="border: none" width="40%">
                    <?php echo $company->name . "<br>" . nl2br($company->address); ?>
                </td>
                <td style="border: none;text-align: center;"><h2>STOCK OUT REPORT</h2></td>
            </tr>
        </table><br/><br/>
        <table class="tablesorter" width="99%">
            <thead>
                <tr style="background: #cecece">
                    <th>NO</th>
                    <th>Date</th>
                    <th>STO NO</th>
                    <th>MW NO</th>
                    <th>Request By</th>
                    <th>Department</th>                                     
                    <th>Sub. Dept</th>               
                    <th>Item Code</th>
                    <th>Item Description</th>        
                    <th>Qty</th>        
                    <th>Unit</th>
                    <th>Out By /Issued By</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($stockout)) {
                    $no = 1;
                    foreach ($stockout as $result) {
                        ?>
                        <tr valign="top">
                            <td width="2%" align="right"><?php echo $no++ ?></td>
                            <td width="8%" align="center"><?php echo date('d/m/Y', strtotime($result->date)) ?></td>
                            <td width="8%"><?php echo $result->number ?></td>
                            <td width="10%"><?php echo $result->refno ?></td>     
                            <td width="13%"><?php echo $result->name_request."/".$result->requestby ?></td>
                            <td width="13%"><?php echo $result->departmentname ?></td>                         
                            <td width="10%"><?php echo $result->sub_department ?></td>                            
                            <td width="10%"><?php echo $result->item_code ?></td>
                            <td width="20%"><?php echo $result->item_description ?></td>
                            <td width="10%" align="right" style="padding-right: 5px;"><?php echo $result->qty ?></td>
                            <td width="5%"><?php echo $result->unit_code ?></td>
                            <td width="5%"><?php echo $result->outby ?></td>
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
    <script>window.print()</script>
    </body>
    </html>
<?php } ?>