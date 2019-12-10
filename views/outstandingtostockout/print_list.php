<html>
    <head>
        <title>&nbsp;</title>        
        <STYLE>
            <!-- 
            body,table{ font-family:"Arial"; font-size:10px; }
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
    <div style="width: 700px">
        <h2>OUTSTANDING STOCKOUT LIST</h2>
        <table width="100%">
            <thead>
                <tr>
                    <th width="2%">No</th>
                    <th width="10%">M.W NO</th>
                    <th width="10%">Date</th>
                    <th width="10%">Request By</th>
                    <th width="10%">Item Code</th>            
                    <th width="28%">Item Description</th>
                    <th width="5%">Qty Request</th>
                    <th width="5%">Outstanding</th>
                    <th width="20%">Remark</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($mritem)) {
                    $no = 1;
                    foreach ($mritem as $result) {
                        ?>
                        <tr>
                            <td align="right">&nbsp;<?php echo $no++ ?></td>
                            <td><?php echo $result->mr_no ?>&nbsp;</td>
                            <td><?php echo $result->mr_date ?>&nbsp;</td>
                            <td><?php echo $result->employee_name_requested ?>&nbsp;</td>
                            <td><?php echo $result->item_code ?>&nbsp;</td>
                            <td><?php echo $result->item_description ?>&nbsp;</td>
                            <td align="right"><?php echo $result->qty ?>&nbsp;</td>
                            <td align="right"><?php echo $result->ots ?>&nbsp;</td>
                            <td><p><?php echo $result->reason ?>&nbsp;</p></td>
                        </tr>
                        <?php
                    }
                } else {
                    
                }
                ?>
            </tbody>
        </table>
        <span style="float: left">Print on <?php echo date('d/m/Y H:i:s') ?></span>
    </div>
</html>