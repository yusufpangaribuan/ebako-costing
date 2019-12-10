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
    <h3>Outstanding to create PR</h3>
    <table width="100%">
        <thead>
            <tr>
                <th width="2%">No</th>
                <th width="5%">Item Code</th>
                <th width="20%">Item Description</th>
                <th width="5%">Request</th>
                <th width="5%">Ots</th>
                <th width="5%">Unit</th>
                <th width="8%">MR NO</th>
                <th width="5%">Date</th>                        
                <th width="10%">Request By</th>                        
                <th width="10%">Department</th>
<!--                <th width="15%">Approval</th>-->
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($otscreatepr as $result) {
                ?>
                <tr>
                    <td align="right"><?php echo $no++; ?></td>
                    <td><?php echo $result->item_code ?></td>
                    <td><?php echo $result->item_description ?></td>
                    <td align="center"><?php echo $result->qty ?></td>
                    <td align="center"><?php echo $result->ots_qty ?></td>
                    <td align="center"><?php echo $result->unit_code ?></td>
                    <td align="center"><?php echo $result->mr_number ?></td>
                    <td><?php echo $result->date_f ?></td>                        
                    <td><?php echo $result->employee_request_by ?></td>                        
                    <td><?php echo $result->departmentname ?></td>                
<!--                    <td><?php echo "App 1:" . $result->approval1_name . "App 2: <br/>" . $result->approval2_name ?></td>-->
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>