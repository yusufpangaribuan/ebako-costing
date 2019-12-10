<html>
    <head>
        <title>&nbsp;</title>    
        <?php
        if ($st == 1) {
            ?>
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
            <?php
        }
        ?>        
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
        <table width="100%" border="0" style="border: none">
            <tr>
                <td width="50%" style="border: none">
                    <table width="100%" style="border: none">
                        <tr>
                            <td width="30%" style="border: none"><b>SO NUMBER</b></td>
                            <td width="70%" style="border: none"><b>: <?php echo $so->number ?></b></td>
                        </tr>
                        <tr>
                            <td width="30%" style="border: none"><b>DATE</b></td>
                            <td width="70%" style="border: none"><b>: <?php echo $so->date ?></b></td>
                        </tr>
                        <tr>
                            <td width="30%" style="border: none"><b>CUSTOMER</b></td>
                            <td width="70%" style="border: none"><b>: <span style="margin-left:1px;"><?php echo $so->billtoname ?></span></b></td>
                        </tr>
                    </table>
                </td>                                
                <td width="50%" valign="top" style="border: none">
                    &nbsp;
                </td>
            </tr>
        </table><br/>
        <TABLE style="border-collapse: collapse;" width="100%">
            <TR>
                <TD ALIGN=CENTER BGCOLOR="#CCCCCC" style="border:1px solid black;padding: 2px;font-size: 9px;"><B><FONT FACE="Tahoma">NO</FONT></B></TD>
                <TD ALIGN=LEFT BGCOLOR="#CCCCCC" style="border:1px solid black;padding: 2px;font-size: 9px;"><B><FONT FACE="Tahoma">CODE</FONT></B></TD>
                <TD ALIGN=LEFT BGCOLOR="#CCCCCC" style="border:1px solid black;padding: 2px;font-size: 9px;"><B><FONT FACE="Tahoma">DESCRIPTION</FONT></B></TD>
                <TD ALIGN=CENTER BGCOLOR="#CCCCCC" style="border:1px solid black;padding: 2px;font-size: 9px;"><B><FONT FACE="Tahoma">UNIT</FONT></B></TD>
                <TD ALIGN=CENTER BGCOLOR="#CCCCCC" style="border:1px solid black;padding: 2px;font-size: 9px;"><B><FONT FACE="Tahoma">REQUIREMENT</FONT></B></TD>
                <TD ALIGN=CENTER BGCOLOR="#CCCCCC" style="border:1px solid black;padding: 2px;font-size: 9px;"><B><FONT FACE="Tahoma">AVAILABLE STOCK</FONT></B></TD>
                <TD ALIGN=CENTER BGCOLOR="#CCCCCC" style="border:1px solid black;padding: 2px;font-size: 9px;"><B><FONT FACE="Tahoma">ON PURCHASE</FONT></B></TD>
                <TD ALIGN=CENTER BGCOLOR="#CCCCCC" style="border:1px solid black;padding: 2px;font-size: 9px;"><B><FONT FACE="Tahoma">ALLOCATED</FONT></B></TD>
                <TD ALIGN=CENTER BGCOLOR="#CCCCCC" style="border:1px solid black;padding: 2px;font-size: 9px;"><B><FONT FACE="Tahoma">NEED TO PURCHASE</FONT></B></TD>            
            </TR>
            <?php
            $no = 1;
            foreach ($somaterial as $item) {
                ?>
                <TR>
                    <TD ALIGN = RIGHT style="border:1px solid black;padding: 2px;font-size: 9px;"><?php echo $no++; ?></TD>
                    <TD ALIGN = LEFT style="border:1px solid black;padding: 2px;font-size: 9px;"><?php echo $item->itemcode; ?></TD>
                    <TD ALIGN = LEFT style="border:1px solid black;padding: 2px;font-size: 9px;"><?php echo nl2br($item->description); ?></TD>
                    <TD ALIGN = CENTER style="border:1px solid black;padding: 2px;font-size: 9px;">&nbsp;<?php echo $item->unitcode; ?></TD>
                    <TD ALIGN = CENTER style="border:1px solid black;padding: 2px;font-size: 9px;"><?php echo $item->qty ?></TD>
                    <TD ALIGN = CENTER style="border:1px solid black;padding: 2px;font-size: 9px;"><?php echo $item->stockavailable ?></TD>
                    <TD ALIGN = CENTER style="border:1px solid black;padding: 2px;font-size: 9px;"><?php echo $item->qtyoncpurchase ?></TD>
                    <TD ALIGN = CENTER style="border:1px solid black;padding: 2px;font-size: 9px;"><?php echo $item->qtyalocatedtootherso ?></TD>
                    <TD ALIGN = CENTER style="border:1px solid black;padding: 2px;font-size: 9px;"><?php echo $item->qtytopurchase ?></TD>                
                </TR>
                <?php
            }
            ?>
            </TBODY>
        </TABLE>
        <span style="float: left;font-size: 9px;"><i>Print on <?php echo date('d/m/Y H:i:s') ?></i></span>
    </div>
    <br/>
    <?php
    if ($st == 0) {
        echo "<a href='" . base_url() . "index.php/so/viewmrp/" . $so->id . "/1' target='blank'><button style='font-size:11px;'>Print</button>";
    } else {
        echo "<script>window.print()</script>";
    }
    ?>
</center>
</body>
</html>
