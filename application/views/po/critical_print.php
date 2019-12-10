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
    <h3>P.O Critical Outstanding Receive</h3>
    <table width="100%">
        <thead>
            <tr>
                <th width="2%">No</th>
                <th width="8%">PO NO</th>
                <th width="5%">PO Date</th>                        
                <th width="10%">Vendor</th>                        
                <th width="10%">Delivery Term</th>
                <th width="5%">Item Code</th>
                <th width="20%">Item Description</th>
                <th width="5%">Request</th>
                <th width="5%">Ots</th>
                <th width="5%">Unit</th>
<!--                <th width="15%">Approval</th>-->
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($po_critical as $result) {
                ?>
                <tr>
                    <td align="right"><?php echo $no++; ?></td>
                    <td align="center"><?php echo $result->po_number ?></td>
                    <td><?php echo $result->po_date ?></td>                        
                    <td><?php echo $result->vendor_name ?></td>                        
                    <td><?php echo ($result->delivery_date_valid == 't') ? date('d/m/Y', strtotime($result->deliveryterm)) : $result->deliveryterm ?></td>
                    <td><?php echo $result->item_code ?></td>
                    <td><?php echo $result->item_description ?></td>
                    <td align="center"><?php echo $result->qty ?></td>
                    <td align="center"><?php echo $result->outstanding ?></td>
                    <td align="center"><?php echo $result->unit_code ?></td>

                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>