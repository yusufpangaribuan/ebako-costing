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
                color: #000000;
            }
            -->
        </STYLE>
    </style>
</head>
<body>
<center>
    <div style="width: 800px;border: 1px solid #000000;">
        <table width="99%" style="border: none">
            <tr>
                <td style="border: none" width="35%">
                    <?php
                    echo $company->name . "<br/>" . nl2br($company->address);
                    ?>
                </td>
                <td style="border: none;text-align: center;"><h2>GOOD RECEIVE REPORT</h2></td>
            </tr>
        </table><br/>
        <table width="99%">
            <thead>
                <tr>
                    <th width="10">NO</th>                        
                    <th>NUMBER</th>
                    <th>DATE</th>
                    <th>PO</th>
                    <th>PO DATE</th>
                    <th>SUPPLIER</th>
                    <th>LETTER NUMBER</th>
                    <th>RECEIVED BY</th>
                    <th>DETAIL</th>
                </tr>            
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($gr as $gr) {
                    ?>
                    <tr>
                        <td align="right"><?php echo $no++ ?></td>
                        <td align="center"><?php echo $gr->grnumber ?></td>
                        <td align="center"><?php echo date('d/m/Y', strtotime($gr->grdate)) ?></td>                            
                        <td align="center"><?php echo $gr->ponumber ?></td>
                        <td align="center"><?php echo date('d/m/Y', strtotime($gr->podate)) ?></td>
                        <td><?php echo $gr->vendorname ?></td>
                        <td><?php echo $gr->letternumber ?></td>
                        <td><?php echo $gr->receivedby ?></td>
                        <td>
                            <?php
                            $gritem = $this->model_gritem->selectByGrId($gr->id);
                            foreach ($gritem as $result) {
                                echo "<b>" . $result->itemcode . "</b>";
                                echo " (Rec : " . $result->qty . ",Rej : " . $result->rejectqty . ")<br>";
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <br/>
        <br/>
        <span style="float: left">Print on <?php echo date('d/m/Y H:i:s') ?></span>
        <script>window.print()</script>
    </div>
</center>
</body>
</html>