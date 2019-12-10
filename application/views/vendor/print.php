<html>
    <head>
        <title>&nbsp;</title>        
        <STYLE>
            <!-- 
            BODY,table{ font-family:"Arial"; font-size:8pt; }
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
    <?php // print_r($vendor)?>
<center>
    <div style="width: 1000px">
        <table width="99%" style="border: none">
            <tr>
                <td style="border: none" width="35%"><?php echo "<b>".$companyaddress->name."</b><br/>".$companyaddress->address ?></td>
                <td style="border: none;text-align: center;"><h2>Vendor LIST</h2></td>
            </tr>
        </table><br/>
        <table class="tablesorter" width="99%">
            <thead>
                <tr>
                    <th width="1%">NO</th>            
                    <th width="9%">NAME</th>
                    <th width="10%">ADDRESS</th>
                    <th width="10%">CONTACT</th>
                    <th width="10%">PHONE</th>
                    <th width="10%">FAX</th>
                    <th width="10%">EMAIL</th>
                    <th width="10%">SERVICE</th>
                    <th width="10%">NUMBER</th>
                    <th width="10%">TAX</th>
                    <th width="10%">CURRENCY</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number = 1;
                foreach ($vendor as $result) {
                    ?>
                    <tr>
                        <td align="right"><?php echo $number++ ?></td>
                        <td><?php echo $result->name ?></td>
                        <td><?php echo $result->address1 ?></td>                                            
                        <td><?php echo $result->contact ?></td>
                        <td><?php echo $result->phone ?></td>
                        <td><?php echo $result->fax ?></td>
                        <td><?php echo $result->email ?></td>
                        <td><?php echo $result->service ?></td>
                        <td align="center"><?php echo $result->vendornumber ?></td>
                        <td><?php echo $result->taxnumber ?></td>
                        <td align="center">
                            <?php
                            echo $result->curr;
                            echo $result->curr2 != '' ? "<br/>" . $result->curr2 : '';
                            echo $result->curr3 != '' ? "<br/>" . $result->curr3 : '';
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <span style="float: left">Print on <?php echo date('d/m/Y H:i:s') ?></span>
    </div>
    <script>window.print()</script>
</center>
</body>
</html>