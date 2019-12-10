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
        <table width="100%" style="border: none">
            <tr>
                <td style="border: none" width="35%">
                    <?php
                    echo $company->name . "<br/>";
                    echo nl2br($company->address);
                    ?>
                </td>
                <td style="border: none;text-align: center;font-size: 24px;font-weight: bold;">Material Receive</td>
            </tr>
        </table><br/>
        <table width="100%" style="border: none">
            <tr>
                <td width="15%" style="border: none"><B>Request Date</B></td>
                <td width="20%" style="border: none"><B>: </B><?php echo date('d/m/Y', strtotime($mr->date)) ?></td>
                <td width="10%" style="border: none">&nbsp;</td>
                <td width="25%" align="right" style="border: none"><B>Must Receive At</B></td>
                <td width="30%" style="border: none"><B>: </B><?php echo (empty($mr->datemustreceive)) ? "" : date('d/m/Y', strtotime($mr->datemustreceive)) ?></B></td>
            </tr>
            <tr>
                <td style="border: none"><B>Request By</B></td>
                <td style="border: none"><B>: </B><?php echo $this->model_employee->getNameById($mr->requestby) ?></td>
                <td style="border: none">&nbsp;</td>
                <td align="right" style="border: none"><B>Used For </B></td>
                <td style="border: none"><B>: </B><?php echo $mr->reasonrequirement ?></td>
            </tr>
            <tr>
                <td style="border: none"><B>Department.</td>
                <td style="border: none"><B>: </B><?php echo $mr->departmentname ?></td>
                <td style="border: none">&nbsp;</td>
                <td style="border: none">&nbsp;</td>
                <td style="border: none">&nbsp;</td>
            </tr>
        </table><br/>
        <TABLE style="border-collapse: collapse;" width="100%">
            <TR>
                <TD ALIGN=RIGHT width="10" BGCOLOR="#CCCCCC" style="border:1px solid black;padding: 2px;font-size: 9px;"><B><FONT FACE="Tahoma">No</FONT></B></TD>
                <TD ALIGN=CENTER width="150" BGCOLOR="#CCCCCC" style="border:1px solid black;padding: 2px;font-size: 9px;"><B><FONT FACE="Tahoma">Stock out No#</FONT></B></TD>
                <TD ALIGN=CENTER width="100" BGCOLOR="#CCCCCC" style="border:1px solid black;padding: 2px;font-size: 9px;"><B><FONT FACE="Tahoma">Date</FONT></B></TD>
                <TD ALIGN=CENTER width="100" BGCOLOR="#CCCCCC" style="border:1px solid black;padding: 2px;font-size: 9px;"><B><FONT FACE="Tahoma">Item Code</FONT></B></TD>
                <TD ALIGN=CENTER BGCOLOR="#CCCCCC" style="border:1px solid black;padding: 2px;font-size: 9px;"><B><FONT FACE="Tahoma">Item Description</FONT></B></TD>
                <TD ALIGN=CENTER width="60" BGCOLOR="#CCCCCC" style="border:1px solid black;padding: 2px;font-size: 9px;"><B><FONT FACE="Tahoma">Unit</FONT></B></TD>
                <TD ALIGN=CENTER width="60" BGCOLOR="#CCCCCC" style="border:1px solid black;padding: 2px;font-size: 9px;"><B><FONT FACE="Tahoma">Qty</FONT></B></TD>
            </TR>
            <?php
            $no = 1;
            foreach ($mrdetail as $result) {
                ?>
                <TR>
                    <TD ALIGN = RIGHT style="border:1px solid black;padding: 2px;font-size: 9px;"><?php echo $no++; ?></TD>
                    <TD ALIGN = CENTER style="border:1px solid black;padding: 2px;font-size: 9px;"><?php echo $result->stockoutnumber; ?></TD>
                    <TD ALIGN = CENTER style="border:1px solid black;padding: 2px;font-size: 9px;"><?php echo $result->receivedate; ?></TD>
                    <TD ALIGN = CENTER style="border:1px solid black;padding: 2px;font-size: 9px;">&nbsp;<?php echo $result->itemcode; ?></TD>
                    <TD style="border:1px solid black;padding: 2px;font-size: 9px;"><?php echo nl2br($result->itemdescription) ?></TD>
                    <TD ALIGN = CENTER style="border:1px solid black;padding: 2px;font-size: 9px;"><?php echo $result->unitcode ?></TD>
                    <TD ALIGN = CENTER style="border:1px solid black;padding: 2px;font-size: 9px;"><?php echo $result->qty; ?></TD>
                </TR>
                <?php
            }
            ?>
            </TBODY>
        </TABLE>
        <span style="float: left;font-size: 9px;margin-top: 5px;"><i>Print on <?php echo date('d/m/Y H:i:s') ?></i></span>
    </div>
    <br/>
    <script>window.print()</script>
</center>
</body>
</html>
