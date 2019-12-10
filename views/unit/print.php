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
    <div style="width: 700px">
        <table width="99%" style="border: none">
            <tr>
                <td style="border: none" width="35%"><?php echo $companyaddress ?></td>
                <td style="border: none;text-align: center;"><h2>UNIT LIST</h2></td>
            </tr>
        </table><br/>
        <table class="tablesorter" width="100%">
            <thead>
                <tr>
                    <th width="10">NO</th>
                    <th>CODE</th>
                    <th>NAME</th>            
                    <th>REMARK</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number = 1;
                foreach ($unit as $result) {
                    ?>
                    <tr>
                        <td>&nbsp;<?php echo $number++ ?></td>
                        <td>&nbsp;<?php echo $result->codes ?></td>
                        <td>&nbsp;<?php echo $result->names ?></td>
                        <td>&nbsp;<?php echo $result->remark ?></td>                        
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