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
<center>
    <div style="width: 800px;border: 1px #000000 solid;padding-bottom: 15px;margin-top: 15px;">
        <table width="99%" style="border: none">
            <tr>
                <td style="border: none" width="40%">
                    <?php echo $company->name."<br>". nl2br($company->address); ?>
                </td>
                <td style="border: none;text-align: center;"><h2>STOCK OUT LIST</h2></td>
            </tr>
        </table><br/><br/>
        <table class="tablesorter" width="99%">
            <thead>
                <tr style="background: #cecece">
                    <th width="10">NO</th>
                    <th width="100">Stock out No#</th>
                    <th>Date</th>
                    <th>MR No#</th>
                    <th>Out by</th>
                    <th>Received by</th>                        
                    <th>Department</th>                       
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($stockout)) {
                    $no = 1;
                    foreach ($stockout as $result) {
                        ?>
                        <tr>
                            <td align="right"><?php echo $no++ ?></td>                                    
                            <td align="center"><?php echo $result->number ?></td>
                            <td align="center"><?php echo date('d/m/Y', strtotime($result->date)) ?></td>
                            <td align="center"><?php echo $result->refno ?></td>
                            <td><?php echo $result->outby ?></td>
                            <td align="center"><?php echo $result->receiveby ?></td>
                            <td align="center"><?php echo $result->departmentname ?></td>
                            <td align="right">
                                <?php
                                $stockoutdetail = $this->model_stockoutdetail->selectByStockoutId($result->id);
                                foreach ($stockoutdetail as $result) {
                                    echo "[" . $result->code . "]: " . $result->qty . " " . $result->unitcode . "<br/>";
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
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