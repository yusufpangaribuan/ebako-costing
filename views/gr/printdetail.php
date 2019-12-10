<html>
    <head>
        <title>&nbsp;</title>        
        <?php
        if ($st == 1) {
            ?>
            <STYLE>
                <!--
                @page { margin: 0px; }
                body { margin: 5px; }
                table{ font-family:"Arial"; font-size:11pt; }
                -->
            </STYLE>
            <?php
        }
        ?>

    </style>
</head>
<body>
    <?php
    if ($st == 1) {
        ?>
        <div style="width: 100%;border: 0px solid #000000;min-height: 300px;">
            <?php
        } else {
            ?>
            <div style="width: 700px;border: 0px solid #000000;min-height: 300px;">
                <?php
            }
            ?>
            <table width="99%" style="border: none">
                <tr>
                    <td style="border: none">
                        <?php
                        echo $company->name . "<br/><span style='font-size:8pt'>" . nl2br($company->address) . "</span>";
                        ?>                    
                    </td>
                </tr>
                <tr>
                    <td style="border: none;text-align: center;"><span style="font-size: 18px;"><b>GOODS RECEIVE</b></span></td>
                </tr>
            </table>
            <br/>
            <table width="99%" border="0" style="border: none">
                <tr valign="top">
                    <td width="50%" style="border: none;">
                        <table width="100%" style="border:none;">
                            <tr>
                                <td style="border: none;" width='30%'><strong>GR NO</strong></td>
                                <td style="border: none;" width='1%'><strong>:</strong></td>
                                <td style="border: none;" width='69%'><?php echo $gr->number ?></td>
                            </tr>
                            <tr>
                                <td style="border: none;font-weight: bold;"><strong>PO NO </strong></td>
                                <td style="border: none;"><strong>:</strong></td>
                                <td style="border: none;"><?php echo $gr->ponumber ?></td>
                            </tr>
                            <tr>
                                <td style="border: none;"><strong>Receive date</strong></td>
                                <td style="border: none;"><strong>:</strong></td>
                                <td style="border: none;"><?php echo (empty($gr->receivedate)) ? "" : date('d/m/Y', strtotime($gr->receivedate)) ?></td>
                            </tr>
                            <tr>
                                <td style="border: none;"><strong>Letter Number</strong></td>
                                <td style="border: none;"><strong>:</strong></td>
                                <td style="border: none;"><?php echo $gr->letternumber ?></td>
                            </tr>
                        </table>
                    </td>
                    <td width="50%" style="border: none;">
                        <table width="100%" style="border:none;">
                            <tr>
                                <td style="border: none;font-weight: bold;"><strong>D.O DATE </strong></td>
                                <td style="border: none;"><strong>:</strong></td>
                                <td style="border: none;"><?php echo (empty($gr->do_date)) ? "" : date('d/m/Y', strtotime($gr->do_date)) ?></td>
                            </tr>
                            <tr>
                                <td style="border: none;" width='40%'><strong>SUPPLIER</strong></td>
                                <td style="border: none;" width='1%'><strong>:</strong></td>
                                <td style="border: none;" width='59%'><?php echo $gr->vendorname ?></td>
                            </tr>
                            <tr>
                                <td style="border: none;font-weight: bold;"><strong>PREPARED BY </strong></td>
                                <td style="border: none;"><strong>:</strong></td>
                                <td style="border: none;"><?php echo $gr->name_created_by ?></td>
                            </tr>
                        </table>                    
                    </td>            
                </tr>
            </table>
            <table border='0' width='99%' cellpadding='0' cellspacing='0'>
                <thead>
                    <tr>
                        <th style='padding: 5px;border-width:1px 1px 1px 1px;border-color: #000000;border-style: solid;' width="2%">No</th>
                        <th style='padding: 5px;border-width:1px 1px 1px 0px;border-color: #000000;border-style: solid;' width="12%">Code</th>
                        <th style='padding: 5px;border-width:1px 1px 1px 0px;border-color: #000000;border-style: solid;' width="20%">Item Description</th> 
                        <th style='padding: 5px;border-width:1px 1px 1px 0px;border-color: #000000;border-style: solid;' width="8%">Unit</th>
                        <th style='padding: 5px;border-width:1px 1px 1px 0px;border-color: #000000;border-style: solid;' width="8%">Qty. Request</th>
                        <th style='padding: 5px;border-width:1px 1px 1px 0px;border-color: #000000;border-style: solid;' width="8%">Ots</th>
                        <th style='padding: 5px;border-width:1px 1px 1px 0px;border-color: #000000;border-style: solid;' width="8%">Qty. Receive</th>            
                        <th style='padding: 5px;border-width:1px 1px 1px 0px;border-color: #000000;border-style: solid;' width="8%">Qty. Reject</th>
                        <th style='padding: 5px;border-width:1px 1px 1px 0px;border-color: #000000;border-style: solid;'>Notes</th>
                    </tr>
                </thead>
                <?php
                $count_row = 10;
                if (!empty($gritem)) {
                    $counter = 1;

                    foreach ($gritem as $result) {
                        ?>
                        <tr valign="top">
                            <td style='border-width:0px 1px 0px 1px;border-color: #000000;border-style: solid;padding: 2px;' valign='top' align="center"><?php echo $counter++; ?></td>  
                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' valign='top'><?php echo $result->itemcode; ?></td>
                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' valign='top'><?php echo $result->itemdescription; ?></td>
                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' valign='top' align="center"><?php echo $result->unitcode; ?></td>
                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' valign='top' align='center'><?php echo $result->qty; ?></td>
                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' valign='top' align='center'><?php echo $result->outstanding; ?></td>
                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' align="center"><?php echo $result->qty ?></td>
                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' align="center"><?php echo $result->rejectqty ?></td>
                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;'><?php echo $result->note; ?></td>
                        </tr>
                        <?php
                        $count_row--;
                    }
                }
                if ($count_row > 0) {
                    for ($i = $count_row; $i > 0; $i--) {
                        ?>
                        <tr>
                            <td style='border-width:0px 1px 0px 1px;border-color: #000000;border-style: solid;padding: 2px;' valign='top' align="center">&nbsp;</td>  
                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' valign='top'>&nbsp;</td>
                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' valign='top'>&nbsp;</td>
                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' valign='top' align="center">&nbsp;</td>
                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' valign='top' align='center'>&nbsp;</td>
                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' valign='top' align='center'>&nbsp;</td>
                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' align="center">&nbsp;</td>
                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' align="center">&nbsp;</td>
                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;'>&nbsp;</td>
                        </tr>
                        <?php
                    }
                }
                ?>    
                <tr>
                    <td style='border-width:0px 1px 1px 1px;border-color: #000000;border-style: solid;padding: 2px;' valign='top' align="center">&nbsp;</td>  
                    <td style='border-width:0px 1px 1px 0px;border-color: #000000;border-style: solid;padding: 2px;' valign='top'>&nbsp;</td>
                    <td style='border-width:0px 1px 1px 0px;border-color: #000000;border-style: solid;padding: 2px;' valign='top'>&nbsp;</td>
                    <td style='border-width:0px 1px 1px 0px;border-color: #000000;border-style: solid;padding: 2px;' valign='top' align="center">&nbsp;</td>
                    <td style='border-width:0px 1px 1px 0px;border-color: #000000;border-style: solid;padding: 2px;' valign='top' align='center'>&nbsp;</td>
                    <td style='border-width:0px 1px 1px 0px;border-color: #000000;border-style: solid;padding: 2px;' valign='top' align='center'>&nbsp;</td>
                    <td style='border-width:0px 1px 1px 0px;border-color: #000000;border-style: solid;padding: 2px;' align="center">&nbsp;</td>
                    <td style='border-width:0px 1px 1px 0px;border-color: #000000;border-style: solid;padding: 2px;' align="center">&nbsp;</td>
                    <td style='border-width:0px 1px 1px 0px;border-color: #000000;border-style: solid;padding: 2px;'>&nbsp;</td>
                </tr>
            </table>
            <br/>     
            <table width="100%">
                <tr>
                    <td width="30%" align="center">
                        Pengirim
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        (................................)
                    </td>
                    <td width="40%" align="center">
                        Diterima Oleh
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <?php echo $gr->name_receive_by; ?>
                        <hr style="width: 60%"/>
                    </td>
                    <td width="30%" align="center">
                        Mengetahui
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        (................................)
                    </td>
                </tr>
            </table><br/>
            <span style="font-size: 9px;float: left" >Print on <?php echo date('d/m/Y H:i:s') ?></span>
        </div>

        <?php
        if ($st == 1) {
            //echo "<script>window.print()</script>";
        } else {
            ?><br/>
                                    <!--<a href="<?php echo base_url() . "index.php/gr/printdetail/" . $gr->id . "/1" ?>" target="blank"><button>print</button></a>-->
            <?php
        }
        ?>
</body>
</html>