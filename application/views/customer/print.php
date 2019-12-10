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
<center>
    <div style="width: 1000px">
        <table width="99%" style="border: none">
            <tr>
                <td style="border: none" width="35%"><?php echo $companyaddress ?></td>
                <td style="border: none;text-align: center;"><h2>CUSTOMER LIST</h2></td>
            </tr>
        </table><br/>
        <table  width="99%%">
            <thead>
                <tr>
                    <th>NO</th>            
                    <th>NAME</th>
                    <th>ADDRESS</th>            
                    <th>CITY</th>
                    <th>STATE</th>
                    <th>ZIP CODE</th>
                    <th>COUNTRY</th>
                    <th>CONTACT</th>
                    <th>SERVICE</th>
                    <th>PHONE</th>
                    <th>FAX</th>
                    <th>EMAIL</th>
                    <th>SERVICE</th>
                    <th>NUMBER</th>
                    <th>CURRENCY</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number = 1;
                foreach ($customer as $result) {
                    ?>
                    <tr>
                        <td align="right"><?php echo $number++ ?></td>
                        <td><?php echo $result->name ?></td>
                        <td><?php echo nl2br($result->address1) ?></td>
                        <td><?php echo $result->city ?></td>
                        <td><?php echo $result->state ?></td>
                        <td><?php echo $result->zipcode ?></td>
                        <td><?php echo $result->country ?></td>
                        <td><?php echo $result->contact ?></td>
                        <td><?php echo $result->service ?></td>
                        <td><?php echo $result->phone ?></td>
                        <td><?php echo $result->fax ?></td>
                        <td><?php echo $result->email ?></td>
                        <td><?php echo $result->service ?></td>
                        <td><?php echo $result->customernumber ?></td>
                        <td><?php echo $result->curr . "<br/>" . $result->curr2 . "<br/>" . $result->curr3; ?></td>                
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
