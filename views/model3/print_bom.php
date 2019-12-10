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
    <div style="width: 900px">
        <table width="99%" style="border: none">
            <tr>
                <td style="border: none" width="35%">
                    <?php
                    echo $company->name . "<br/>";
                    echo nl2br($company->address);
                    ?>
                </td>
                <td style="border: none;text-align: center;font-size: 24px;font-weight: bold;">BILL OF MATERIAL</td>
            </tr>
        </table><br/>

        <TABLE style="border-collapse: collapse;" width="100%">
            <TR>
                <TD ALIGN=CENTER BGCOLOR="#CCCCCC" style="border:1px solid black;padding: 2px;font-size: 9px;"><B><FONT FACE="Tahoma">NO</FONT></B></TD>
                <TD ALIGN=LEFT BGCOLOR="#CCCCCC" style="border:1px solid black;padding: 2px;font-size: 9px;"><B><FONT FACE="Tahoma">CODE</FONT></B></TD>
                <TD ALIGN=LEFT BGCOLOR="#CCCCCC" style="border:1px solid black;padding: 2px;font-size: 9px;"><B><FONT FACE="Tahoma">DESCRIPTION</FONT></B></TD>
                <TD ALIGN=CENTER BGCOLOR="#CCCCCC" style="border:1px solid black;padding: 2px;font-size: 9px;"><B><FONT FACE="Tahoma">UNIT</FONT></B></TD>
                <TD ALIGN=CENTER BGCOLOR="#CCCCCC" style="border:1px solid black;padding: 2px;font-size: 9px;"><B><FONT FACE="Tahoma">QTY</FONT></B></TD>                
            </TR>
            <?php
            $no = 1;
            foreach ($model_bom as $result) {
                ?>
                <TR>
                    <TD ALIGN = RIGHT style="border:1px solid black;padding: 2px;font-size: 9px;"><?php echo $no++; ?></TD>
                    <TD ALIGN = LEFT style="border:1px solid black;padding: 2px;font-size: 9px;"><?php echo $result->itemcode; ?></TD>
                    <TD ALIGN = LEFT style="border:1px solid black;padding: 2px;font-size: 9px;"><?php echo nl2br($result->description); ?></TD>
                    <TD ALIGN = CENTER style="border:1px solid black;padding: 2px;font-size: 9px;">&nbsp;<?php echo $result->unitcode; ?></TD>
                    <TD ALIGN = CENTER style="border:1px solid black;padding: 2px;font-size: 9px;"><?php echo $result->qty ?></TD>                    
                </TR>
                <?php
            }
            ?>
            </TBODY>
        </TABLE>
        <span style="float: left;font-size: 9px;"><i>Print on <?php echo date('d/m/Y H:i:s') ?></i></span>
    </div>
    <br/>
    <script>window.print()</script>
</center>
</body>
</html>
