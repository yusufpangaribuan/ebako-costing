<html>
    <head>
        <style>
            @page { 
                size: A4;
                size: portrait;
                margin: 20px;
            }
            body { margin: 5px; font-family:"Courier";}
            table{ font-size:14px; }
        </style>
    </head>
    <body>
        <?php if ($status == 'view') { ?>
            <div style="width: 900px;">
            <?php } ?>
            <table width="100%" border="0">
                <tr>
                    <td style="border-bottom: 1px #000000 double;">
                        <?php
                        echo $company->name . "<br/>" . nl2br($company->address);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td align='center'>
                        <br/>
                        <span style="font-size: 18px;font-weight: bold;">FORM PERMOHONAN PENGADAAN BARANG</span>
                        <br/><br/>
                    </td>
                </tr>
                <TR>
                    <td>
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="70%" valign="top">
                                    <table width="100%" border="0">
                                        <tr>
                                            <td width="18%"><B>Tanggal</B></td>
                                            <td width="25%"><B>: <?php echo date('d/m/Y', strtotime($mr->date)) ?></B></td>
                                            <td width="2%">&nbsp;</td>
                                            <td width="25%" style="padding-right: 2px;text-align: right;"><B>Barang harus diterima Tgl</B></td>
                                            <td width="30%"><B>: <?php echo (empty($mr->must_receive_date)) ? "" : date('d/m/Y', strtotime($mr->must_receive_date)) ?></B></td>
                                        </tr>
                                        <tr>
                                            <td><B>Pemohon</B></td>
                                            <td><B>: <?php echo $mr->employee_request_by ?></B></td>
                                            <td>&nbsp;</td>
                                            <td align="right" valign="top"><B>Keperluan</B></td>
                                            <td rowspan="2" valign="top"><B>: </B><?php echo $mr->reason_requirement ?></td>
                                        </tr>
                                        <tr>
                                            <td><B>Dept.</td>
                                            <td><B>: <?php echo $mr->departmentname ?></B></td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="30%" valign="top">
                                    <table width="100%" style="border-collapse: collapse;">
                                        <tr>
                                            <td colspan="2" align="center" style="border: 1px #000000 solid;line-height: 20px;"><b>Diisi oleh Stock Keeper</b></td>
                                        </tr>
                                        <tr>
                                            <td width="40%" style="border: 1px #000000 solid;line-height: 20px;"><b>&nbsp;Slip /MW No.</b></td>
                                            <td width="60%" style="border: 1px #000000 solid;line-height: 20px;"><b>&nbsp;<?php echo $mr->number ?></b></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table><br/>
                        <table width="100%" style="border-collapse: collapse;" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <td STYLE="width: 3%; border-top: 1px solid #000000;border-bottom:1px solid #000000; border-left: 1px solid #000000;line-height: 15px;" ALIGN=CENTER><B>NO</B></td>
                                    <td STYLE="width: 12%; border-top: 1px solid #000000;border-bottom:1px solid #000000;  border-left: 1px solid #000000;line-height: 15px;" ALIGN=CENTER><B>KODE BARANG</B></td>
                                    <td STYLE="width: 30%; border-top: 1px solid #000000;border-bottom:1px solid #000000;  border-left: 1px solid #000000;line-height: 15px;" ALIGN=CENTER><B>DESKRIPSI</B></td>
                                    <td STYLE="width: 7%; border-top: 1px solid #000000;border-bottom:1px solid #000000;  border-left: 1px solid #000000;line-height: 15px;" ALIGN=CENTER><B>SATUAN</B></td>
                                    <td STYLE="width: 10%; border-top: 1px solid #000000;border-bottom:1px solid #000000;  border-left: 1px solid #000000;line-height: 15px;" ALIGN=CENTER><B>JUMLAH</B></td>
                                    <td STYLE="width: 38%; border-top: 1px solid #000000;border-bottom:1px solid #000000;  border-left: 1px solid #000000; border-right: 1px solid #000000;line-height: 15px;" ALIGN=CENTER><B>KETERANGN</B></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $count_row = 10;
                                foreach ($mrdetail as $result) {
                                    ?>
                                    <tr>
                                        <TD valign="top" style="border-width:0px 1px 0px 1px;border-color: #000000;border-style: solid;padding: 2px;text-align: right;"><?php echo $no++ ?></TD>
                                        <TD valign="top" style="border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;"><?php echo $result->item_code ?></TD>
                                        <TD valign="top" style="border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;"><?php echo $result->item_description ?></TD>
                                        <TD valign="top" style="border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;" ALIGN=CENTER><?php echo $result->unit_code ?></TD>
                                        <TD valign="top" style="border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;" ALIGN=CENTER><?php echo $result->qty ?></TD>
                                        <TD valign="top" style="border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;"><?php echo $result->remark ?></TD>
                                    </tr>
                                    <?php
                                    $count_row--;
                                }
                                if ($count_row > 0) {
                                    for ($i = $count_row; $i > 0; $i--) {
                                        ?>
                                        <tr>
                                            <td style='border-width:0px 1px 0px 1px;border-color: #000000;border-style: solid;padding: 2px;' valign='top' align="center">&nbsp;</td>  
                                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' valign='top'>&nbsp;</td>
                                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' valign='top'>&nbsp;</td>
                                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' valign='top' align="center">&nbsp;</td>                            
                                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' align="center">&nbsp;</td>
                                            <td style='border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;' align="center">&nbsp;</td>
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
                                    <td style='border-width:0px 1px 1px 0px;border-color: #000000;border-style: solid;padding: 2px;' align="center">&nbsp;</td>
                                    <td style='border-width:0px 1px 1px 0px;border-color: #000000;border-style: solid;padding: 2px;'>&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <br/>
                        <table width="50%" align="right" style="border-collapse: collapse">
                            <tr>
                                <td style="border:1px #000000 solid;text-align: center;width: 33%;"><B>Pemohon</B></td>
                                <td style="border:1px #000000 solid;text-align: center;width: 34%;"><B>Approval 1</B></td>
                                <td style="border:1px #000000 solid;text-align: center;width: 33%;"><B>Approval 2</B></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000;vertical-align: bottom;height: 80px" ALIGN=CENTER>
                                    <span style="color:#032550;font-weight:bold;font-size:10px"><?php echo strtoupper($mr->employee_request_by) ?></span>
                                </td>
                                <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000;vertical-align: bottom;" ALIGN=CENTER>
                                    <?php
                                    if ($mr->supervisorstatusapproval == 1) {
                                        $img = "/images/signapprove.png";
                                        $myfile = "./signature/" . $mr->supervisorapproval . ".png";
                                        if (file_exists($myfile)) {
                                            $img = "/signature/" . $mr->supervisorapproval . ".png";
                                        }
                                        if ($status == 'prints') {
                                            echo "<img src='" . $_SERVER["DOCUMENT_ROOT"] . $img . "' style='padding:5px;max-height:30px;max-width:90px;'><br/><span style='font-size:9px;color:green;'>at: " . date('d/m/y h:i', strtotime($mr->supervisortimeapproved)) . "</span><br/>";
                                        } else {
                                            echo "<img src='" . base_url() . $img . "' style='padding:5px;max-height:30px;max-width:90px;'><br/><span style='font-size:9px;color:green;'>at: " . date('d/m/y h:i', strtotime($mr->supervisortimeapproved)) . "</span><br/>";
                                        }
                                    } else if ($mr->supervisorstatusapproval == 2) {
                                        if ($status == 'prints') {
                                            echo "<img src='" . $_SERVER["DOCUMENT_ROOT"] . "/images/signpending.png' style='padding:5px;'><br/><span style='font-size:9px;color:green;'>at: " . date('d/m/y h:i', strtotime($mr->supervisortimeapproved)) . "</span><br/>";
                                        } else {
                                            echo "<img src='" . base_url() . "images/signpending.png' style='padding:5px;'><br/><span style='font-size:9px;color:#ff9900;'>at: " . date('d/m/y h:i', strtotime($mr->supervisortimeapproved)) . "</span><br/>";
                                        }
                                    } else if ($mr->supervisorstatusapproval == 3) {
                                        if ($status == 'prints') {
                                            echo "<img src='" . $_SERVER["DOCUMENT_ROOT"] . "/images/signreject.png' style='padding:5px;'><br/><span style='font-size:9px;color:green;'>at: " . date('d/m/y h:i', strtotime($mr->supervisortimeapproved)) . "</span><br/>";
                                        } else {
                                            echo "<img src='" . base_url() . "images/signreject.png' style='padding:5px;'><br/><span style='font-size:9px;color:red;'>at: " . date('d/m/y h:i', strtotime($mr->supervisortimeapproved)) . "</span><br/>";
                                        }
                                    }
                                    echo '<span style="color:#032550;font-weight:bold;font-size:10px">' . strtoupper($this->model_employee->getNameById($mr->supervisorapproval)) . '</span>';
                                    ?>
                                </td>
                                <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;vertical-align: bottom;" ALIGN=CENTER>
                                    <?php
                                    if ($mr->managerstatusapproval == 1) {
                                        $img = "/images/signapprove.png";
                                        $myfile = "./signature/" . $mr->managerapproval . ".png";
                                        if (file_exists($myfile)) {
                                            $img = "/signature/" . $mr->managerapproval . ".png";
                                        }
//                                        echo base_url().$img;
                                        if ($status == 'prints') {
                                            echo "<img src='" . $_SERVER["DOCUMENT_ROOT"] . $img . "' style='padding:5px;max-height:30px;max-width:90px;'><br/><span style='font-size:9px;color:green;'>at: " . date('d/m/y h:i', strtotime($mr->supervisortimeapproved)) . "</span><br/>";
                                        } else {
                                            echo "<img src='" . base_url() . $img . "' style='padding:5px;max-height:30px;max-width:90px;'><br/><span style='font-size:9px;color:green;'>at: " . date('d/m/y h:i', strtotime($mr->managertimeapproved)) . "</span><br/>";
                                        }
                                    } else if ($mr->managerstatusapproval == 2) {
                                        if ($status == 'prints') {
                                            echo "<img src='" . $_SERVER["DOCUMENT_ROOT"] . "/images/signpending.png' style='padding:5px;'><br/><span style='font-size:9px;color:green;'>at: " . date('d/m/y h:i', strtotime($mr->supervisortimeapproved)) . "</span><br/>";
                                        } else {
                                            echo "<img src='" . base_url() . "images/signpending.png' style='padding:5px;'><br/><span style='font-size:9px;color:#ff9900;'>at: " . date('d/m/y h:i', strtotime($mr->managertimeapproved)) . "</span><br/>";
                                        }
                                    } else if ($mr->managerstatusapproval == 3) {
                                        if ($status == 'prints') {
                                            echo "<img src='" . $_SERVER["DOCUMENT_ROOT"] . "/images/signreject.png' style='padding:5px;'><br/><span style='font-size:9px;color:green;'>at: " . date('d/m/y h:i', strtotime($mr->supervisortimeapproved)) . "</span><br/>";
                                        } else {
                                            echo "<img src='" . base_url() . "images/signreject.png' style='padding:5px;'><br/><span style='font-size:9px;color:red;'>at: " . date('d/m/y h:i', strtotime($mr->managertimeapproved)) . "</span><br/>";
                                        }
                                    }
                                    echo '<span style="color:#032550;font-weight:bold;font-size:10px">' . strtoupper($this->model_employee->getNameById($mr->managerapproval)) . '</span>';
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <?php if ($status == 'view') { ?>
            </div>
            <br/><br/>
        <!--<center><a href="<?php echo base_url() ?>index.php/mr/prints/<?php echo $mr->id ?>/prints" target="_blank"><button>Print</button></a></center>-->
        <?php } else { ?>
            <script>
                //                window.print();
                //                setTimeout(function () {
                //                    window.close();
                //                }, 1);
            </script>
        <?php } ?>
        <!-- ************************************************************************** -->
    </body>
</html>
