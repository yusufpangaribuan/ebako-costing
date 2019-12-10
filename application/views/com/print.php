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
                table{ font-size:9pt; }
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
                    <td style="border: none;text-align: center;"><span style="font-size: 18px;"><b>C.O.M RECEIVING FORM</b></span></td>
                </tr>
            </table>
            <br/>
            <table width="99%" border="0" style="border: none">
                <tr valign="top">
                    <td width="50%" style="border: none;">
                        <table width="100%" style="border:none;">
                            <tr>
                                <td style="border: none;" width='30%'><strong>COM NO</strong></td>
                                <td style="border: none;" width='1%'><strong>:</strong></td>
                                <td style="border: none;" width='69%'><?php echo $com->com_no ?></td>
                            </tr>
                            <tr>
                                <td style="border: none;"><strong>Date</strong></td>
                                <td style="border: none;"><strong>:</strong></td>
                                <td style="border: none;"><?php echo (empty($com->date)) ? "" : date('d/m/Y', strtotime($com->date)) ?></td>
                            </tr>
                        </table>
                    </td>
                    <td width="50%" style="border: none;">
                        <table width="100%" style="border:none;">
                            <tr>
                                <td style="border: none;" width='40%'><strong>SUPPLIER</strong></td>
                                <td style="border: none;" width='1%'><strong>:</strong></td>
                                <td style="border: none;" width='59%'><?php echo $com->customer_name ?></td>
                            </tr>
                            <tr>
                                <td style="border: none;font-weight: bold;"><strong>AWB </strong></td>
                                <td style="border: none;"><strong>:</strong></td>
                                <td style="border: none;"><?php echo $com->awb ?></td>
                            </tr>
                            <tr>
                                <td style="border: none;font-weight: bold;"><strong>VIA </strong></td>
                                <td style="border: none;"><strong>:</strong></td>
                                <td style="border: none;"><?php echo $com->via ?></td>
                            </tr>
                        </table>                    
                    </td>            
                </tr>
            </table>
            <table border='0' width='99%' cellpadding='0' cellspacing='0'>
                <thead>
                    <tr>
                        <th style='padding: 5px;border-width:1px 1px 1px 1px;border-color: #000000;border-style: solid;' width="2%">No</th>
                        <th style='padding: 5px;border-width:1px 1px 1px 0px;border-color: #000000;border-style: solid;' width="15%">Item Code</th>
                        <th style='padding: 5px;border-width:1px 1px 1px 0px;border-color: #000000;border-style: solid;' width="30%">Item Description</th> 
                        <th style='padding: 5px;border-width:1px 1px 1px 0px;border-color: #000000;border-style: solid;' width="10%">UoM</th>
                        <th style='padding: 5px;border-width:1px 1px 1px 0px;border-color: #000000;border-style: solid;' width="10%">Qty</th>
                        <th style='padding: 5px;border-width:1px 1px 1px 0px;border-color: #000000;border-style: solid;' width="23%">Remark</th>
                    </tr>
                </thead>
                <?php
                $count_row = 10;
                if (!empty($comitem)) {
                    $counter = 1;

                    foreach ($comitem as $result) {
                        ?>
                        <tr valign="top">
                            <td style='border-width:0px 1px 0px 1px;border-color: #000000;border-style: solid;padding: 2px;' valign='top' align="center"><?php echo $counter++; ?></td>  
                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' valign='top'><?php echo $result->item_code; ?></td>
                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' valign='top'><?php echo $result->item_description; ?></td>
                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' valign='top' align="center"><?php echo $result->unit_code; ?></td>
                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' valign='top' align='center'><?php echo $result->qty; ?></td>
                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;'><?php echo $result->remark; ?></td>
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
                    <td style='border-width:0px 1px 1px 0px;border-color: #000000;border-style: solid;padding: 2px;'>&nbsp;</td>
                </tr>
            </table><br/>
            <table width="100%" border="0">
                <tr>
                    <td width="30%" align="center" style="border-bottom: 1px #000000 solid;">
                        Sent By
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <?php echo $com->sent_by ?>
                    </td>
                    <td>&nbsp;</td>
                    <td width="30%" align="center" style="border-bottom: 1px #000000 solid;">
                        Received By
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <?php echo $com->name_receive_by ?>
                    </td>
                    <td>&nbsp;</td>
                    <td width="30%" align="center" style="border-bottom: 1px #000000 solid;">
                        Acknowledge By
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <?php echo $com->acknowledge_by ?>
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
            <a href="<?php echo base_url('index.php/com/prints/' . $com->id . '/1') ?>" target="blank"><button>print</button></a>
            <?php
        }
        ?>
</body>
</html>