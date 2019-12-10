<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">

<HTML>
    <HEAD>

        <META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=windows-1252">
        <TITLE></TITLE>
        <META NAME="GENERATOR" CONTENT="OpenOffice.org 3.4.1  (Win32)">
        <META NAME="CREATED" CONTENT="20131108;15172443">
        <META NAME="CHANGED" CONTENT="20131108;17020105">
        <STYLE>
            <!-- 
            BODY,DIV,TABLE,THEAD,TBODY,TFOOT,TR,TH,TD,P { font-family:"Arial"; font-size:8pt; }
            -->
        </STYLE>

    </HEAD>
    <BODY TEXT="#000000">
    <center>
        <TABLE FRAME=VOID CELLSPACING=0 COLS=9 RULES=NONE BORDER=0>
            <COLGROUP><COL WIDTH=10><COL WIDTH=36><COL WIDTH=122><COL WIDTH=250><COL WIDTH=126><COL WIDTH=126><COL WIDTH=105><COL WIDTH=89><COL WIDTH=10></COLGROUP>
            <TBODY>
                <TR>
                    <TD STYLE="border-top: 1px solid #000000; border-left: 1px solid #000000" WIDTH=10 HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-top: 1px solid #000000" COLSPAN=7 ROWSPAN=3 WIDTH=852 ALIGN=LEFT VALIGN=TOP>
                        <?php
                        echo $company->name . "<br/>";
                        echo nl2br($company->address);
                        ?>
                    </TD>
                    <TD STYLE="border-top: 1px solid #000000; border-right: 1px solid #000000" WIDTH=10 ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=40 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=16 ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=25 ALIGN=LEFT VALIGN=MIDDLE><BR></TD>
                    <TD COLSPAN=7 ALIGN=CENTER VALIGN=MIDDLE><B><FONT SIZE=3>FORM PERMOHONAN SERVIS BARANG</FONT></B></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT VALIGN=MIDDLE><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=34 ALIGN=LEFT><BR></TD>
                    <TD COLSPAN=5 ROWSPAN=3 ALIGN=LEFT valign="top">
                        <table width="100%" border="0">
                            <tr>
                                <td width="15%"><B>Tanggal</B></td>
                                <td width="20%"><B>: <?php echo date('d/m/Y', strtotime($sr->date)) ?></B></td>
                                <td width="10%">&nbsp;</td>
                                <td width="25%" align="right"><B>Barang harus diterima Tgl</B></td>
                                <td width="30%"><B>: <?php echo (empty($sr->must_receive_date)) ? "" : date('d/m/Y', strtotime($sr->must_receive_date)) ?></B></td>
                            </tr>
                            <tr valign='top'>
                                <td><B>Pemohon</B></td>
                                <td><B>: <?php echo $sr->employee_request_by ?></B></td>
                                <td>&nbsp;</td>
                                <td align="right"><B>Keperluan</B></td>
                                <td><B>: </B><?php echo $sr->reason_requirement ?></td>
                            </tr>
                            <tr>
                                <td><B>Dept.</td>
                                <td><B>: <?php echo $sr->department ?></B></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </TD>
                    <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" COLSPAN=2 ALIGN=CENTER VALIGN=MIDDLE><B>Diisi oleh Stock Keeper</B></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000" ALIGN=LEFT><B>&nbsp;No Register</B></TD>
                    <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=center><B> <?php echo $sr->number ?></B></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=20 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000" ALIGN=LEFT><B>&nbsp;Tgl. Register</B></TD>
                    <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=center><B> <?php echo date('d/m/Y', strtotime($sr->date)) ?></B></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD COLSPAN=2 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD colspan="9" align="center" STYLE="border-left: 1px solid #000000;border-right: 1px solid #000000;">
                        <table  width="98%" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                            <thead>
                                <tr BGCOLOR="#d8d8d8">
                                    <th width="30%" style="border: 1px solid #000000;">Item Source</th>                                
                                    <th width="30%" style="border: 1px solid #000000;">Item Target</th>
                                    <th width="25%" style="border: 1px solid #000000;">Service Description</th>
                                    <th width="5%" style="border: 1px solid #000000;">Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($srdetail as $result_detail) {
                                    ?>
                                    <tr>
                                        <td style="border: 1px solid #000000;padding: 5px">
                                            <?php echo "<b>(" . $result_detail->source_item_code . " / " . $result_detail->source_unit_code . ") </b>" . nl2br($result_detail->source_item_description); ?><br/>
                                        </td>
                                        <td style="border: 1px solid #000000;padding: 5px">
                                            <?php echo "<b>(" . $result_detail->target_item_code . " / " . $result_detail->target_unit_code . ") </b>" . nl2br($result_detail->target_item_description); ?><br/>                                            
                                        </td>
                                        <td style="border: 1px solid #000000;padding: 5px"><?php echo nl2br($result_detail->remark); ?></td>
                                        <td style="border: 1px solid #000000;padding: 5px" align="center"><?php echo $result_detail->qty; ?></td>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>

                        <br/>
                    </TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=24 ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000;border-top: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE><B>Pemohon</B></TD>
                    <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000;border-top: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE><B>Approval 1</B></TD>
                    <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;border-top: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE><B>Approval 2</B></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=74 ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000;vertical-align: bottom;" ALIGN=CENTER><span style="color:#032550;font-weight:bold;font-size:10px"><?php echo strtoupper($sr->employee_request_by) ?></SPAN></TD>
                    <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000;vertical-align: bottom;" ALIGN=CENTER>
                        <?php
//                    print_r($mr);
                        if ($sr->approval1_status == 1) {
                            $myfile = "./signature/" . $sr->approval1 . ".png";
                            if (file_exists($myfile)) {
                                echo "<img src='" . base_url() . "/signature/" . $sr->approval1 . ".png' style='padding:5px;'><br/><span style='font-size:9px;color:green;'>at: " . date('d/m/y h:i', strtotime($sr->approval1_time)) . "</span><br/>";
                            } else {
                                echo "<img src='" . base_url() . "images/signapprove.png' style='padding:5px;'><br/><span style='font-size:9px;color:green;'>at: " . date('d/m/y h:i', strtotime($sr->approval1_time)) . "</span><br/>";
                            }
                        } else if ($sr->approval1_status == 2) {
                            echo "<img src='" . base_url() . "images/signpending.png' style='padding:5px;'><br/><span style='font-size:9px;color:#ff9900;'>at: " . date('d/m/y h:i', strtotime($sr->approval1_time)) . "</span><br/>";
                        } else if ($sr->approval1_status == 3) {
                            echo "<img src='" . base_url() . "images/signreject.png' style='padding:5px;'><br/><span style='font-size:9px;color:red;'>at: " . date('d/m/y h:i', strtotime($sr->approval1_time)) . "</span><br/>";
                        }
                        echo '<span style="color:#032550;font-weight:bold;font-size:10px">' . strtoupper($sr->name_approval1) . '</span>';
                        ?>
                    </TD>
                    <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;vertical-align: bottom;" ALIGN=CENTER>
                        <?php
                        if ($sr->approval2_status == 1) {
                            $myfile = "./signature/" . $sr->approval2 . ".png";
                            if (file_exists($myfile)) {
                                echo "<img src='" . base_url() . "/signature/" . $sr->approval2 . ".png' style='padding:5px;max-width:80px;max-height:80px;'><br/><span style='font-size:9px;color:green;'>at: " . date('d/m/y h:i', strtotime($sr->approval2_time)) . "</span><br/>";
                            } else {
                                echo "<img src='" . base_url() . "images/signapprove.png' style='padding:5px;'><br/><span style='font-size:9px;color:green;'>at: " . date('d/m/y h:i', strtotime($sr->approval2_time)) . "</span><br/>";
                            }
                        } else if ($sr->approval2_status == 2) {
                            echo "<img src='" . base_url() . "images/signpending.png' style='padding:5px;'><br/><span style='font-size:9px;color:#ff9900;'>at: " . date('d/m/y h:i', strtotime($sr->approval2_time)) . "</span><br/>";
                        } else if ($sr->approval2_status == 3) {
                            echo "<img src='" . base_url() . "images/signreject.png' style='padding:5px;'><br/><span style='font-size:9px;color:red;'>at: " . date('d/m/y h:i', strtotime($sr->approval2_time)) . "</span><br/>";
                        }
                        echo '<span style="color:#032550;font-weight:bold;font-size:10px">' . strtoupper($sr->name_approval2) . '</span>';
                        ?>
                    </TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-bottom: 1px solid #000000" ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-bottom: 1px solid #000000" ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-bottom: 1px solid #000000" ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-bottom: 1px solid #000000" ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-bottom: 1px solid #000000" ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-bottom: 1px solid #000000" ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-bottom: 1px solid #000000" ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
            </TBODY>
        </TABLE>
        <br/>
        <?php if ($status == 'view') { ?>
                            <!--<a href="<?php echo base_url() ?>index.php/materialrequisition/prints/<?php echo $sr->id ?>/prints" target="blank"><button>Print</button></a>-->
        <?php } else { ?>
            <script>
                window.print();
                window.close();
            </script>
        <?php } ?>

    </center>
    <!-- ************************************************************************** -->
</BODY>

</HTML>
