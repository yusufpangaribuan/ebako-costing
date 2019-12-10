<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<HTML>
    <HEAD>
        <TITLE>&nbsp;</TITLE>
        <?php
        if ($st == 1) {
            ?>
            <STYLE>
                <!--
                *{
                    margin: 1px;
                    padding: 1px;
                }
                BODY,DIV,TABLE,THEAD,TBODY,TFOOT,TR,TH,TD,P { font-family:"Arial"; font-size:12px }
                -->
            </STYLE>
            <?php
        }
        ?>
    </HEAD>
    <BODY TEXT="#000000">
    <center>
        <TABLE border=0 cellpadding="0" cellspacing="0" width="720">
            <COLGROUP>
                <COL WIDTH=10>
                <COL WIDTH=10>
                <COL WIDTH=5>
                <COL WIDTH=65>
                <COL WIDTH=53>
                <COL WIDTH=20>
                <COL WIDTH=80>
                <COL WIDTH=100>
                <COL WIDTH=70>
                <COL WIDTH=16>
                <COL WIDTH=77>
                <COL WIDTH=23>
                <COL WIDTH=40>
                <COL WIDTH=13>
                <COL WIDTH=13>
                <COL WIDTH=69>
                <COL WIDTH=86>
                <COL WIDTH=65>
                <COL WIDTH=22>
                <COL WIDTH=10>
            </COLGROUP>
            <TBODY>                
                <TR>
                    <TD STYLE="border-left: 1px solid #000000;border-top: 1px solid #000000" ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-bottom: 1px solid #000000;border-top: 1px solid #000000" COLSPAN=18 ROWSPAN=4 ALIGN=LEFT>
                        <?php echo $company->name . "<br/>" . nl2br($company->address); ?>
                    </TD>
                    <TD STYLE="border-right: 1px solid #000000;border-top: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=25 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=50 ALIGN=LEFT><BR></TD>
                    <TD COLSPAN=18 ALIGN=CENTER VALIGN=MIDDLE><B><u><FONT SIZE=5 face="Lucida Sans">PURCHASE ORDER</FONT></u><BR><FONT SIZE=2>ORDER PEMBELIAN</FONT></B></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=31 ALIGN=LEFT VALIGN=TOP><B><BR></B></TD>
                    <TD COLSPAN=4 ALIGN=LEFT VALIGN=TOP><B>TO<BR><i>Kepada</i></B></TD>
                    <TD ALIGN=LEFT VALIGN=TOP><B>:</B></TD>
                    <TD COLSPAN=3 ALIGN=LEFT VALIGN=TOP><B><?php echo $po->vendorname ?></B></TD>
                    <TD COLSPAN=4 ALIGN=LEFT VALIGN=TOP><B>Order No.<BR><i>No. Order</i></B></TD>
                    <TD ALIGN=CENTER VALIGN=TOP><B>:</B></TD>
                    <TD COLSPAN=5 ALIGN=LEFT VALIGN=TOP><B><?php echo $po->ponumber ?></B></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT VALIGN=TOP><B><BR></B></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=33 ALIGN=LEFT VALIGN=TOP><B><BR></B></TD>
                    <TD COLSPAN=4 ALIGN=LEFT VALIGN=TOP><B>Address<BR><i>Alamat</i></B></TD>
                    <TD ALIGN=LEFT VALIGN=TOP><B>:</B></TD>
                    <TD COLSPAN=3 ALIGN=LEFT VALIGN=TOP><B><?php echo nl2br($po->address1) ?></B></TD>
                    <TD COLSPAN=4 ALIGN=LEFT VALIGN=TOP><B>Order Date<BR><i>Tanggal Order</i></B></TD>
                    <TD ALIGN=CENTER VALIGN=TOP><B>:</B></TD>
                    <TD COLSPAN=5 ALIGN=LEFT VALIGN=TOP><B><?php echo date('d/m/Y', strtotime($po->dates)) ?></B></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT VALIGN=TOP><B><BR></B></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=33 ALIGN=LEFT VALIGN=TOP><B><BR></B></TD>
                    <TD COLSPAN=4 ALIGN=LEFT VALIGN=TOP><B>Phone No.<BR><i>No. Telephone</i></B></TD>
                    <TD ALIGN=LEFT VALIGN=TOP><B>:</B></TD>
                    <TD COLSPAN=3 ALIGN=LEFT VALIGN=TOP><B><?php echo nl2br($po->phone) ?></B></TD>
                    <TD COLSPAN=4 ALIGN=LEFT VALIGN=TOP><B>Delivery Date<BR><i>Tgl. Pengiriman</i></B></TD>
                    <TD ALIGN=CENTER VALIGN=TOP><B>:</B></TD>
                    <TD COLSPAN=5 ALIGN=LEFT VALIGN=TOP><B><?php echo ((!empty($po->deliveryterm) && preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $po->deliveryterm)) ? date('d/m/Y', strtotime($po->deliveryterm)) : $po->deliveryterm); ?></B></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT VALIGN=TOP><B>&nbsp;</B></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" ALIGN=LEFT VALIGN=TOP><B><BR></B></TD>
                    <TD COLSPAN=8 ALIGN=LEFT VALIGN=TOP>Please send us the following items: <BR>Mohon dikirim barang-barang seperti tersebut dibawah ini:<BR></TD>
                    <TD COLSPAN=4 ALIGN=LEFT VALIGN=TOP><B>Terms Of Payment<BR><i>Pembayaran</i></B></TD>
                    <TD ALIGN=CENTER VALIGN=TOP><B>:</B></TD>
                    <TD COLSPAN=5 ALIGN=LEFT VALIGN=TOP><B><?php echo ((!empty($po->payterm) && preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $po->payterm)) ? date('d/m/Y', strtotime($po->payterm)) : $po->payterm); ?></B></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT VALIGN=TOP><B><BR></B></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=13 ALIGN=LEFT><BR></TD>
                    <TD COLSPAN=18 ALIGN=LEFT VALIGN=TOP><BR></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <tr>
                    <td colspan="20" STYLE="border-left: 1px solid #000000;border-right: 1px solid #000000">
                        <table width="99%"  border=0 cellpadding="0" cellspacing="0" align="center">
                            <TR>                                
                                <TD STYLE="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: 1px solid #000000;" ALIGN=CENTER VALIGN=MIDDLE width="5%"><B>NO.<BR><i>No.</i></B></TD>
                                <TD STYLE="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: 1px solid #000000;" ALIGN=CENTER VALIGN=MIDDLE width="10%"><B>NO. PP<BR><i>No. PP</i></B></TD>
                                <TD STYLE="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: 1px solid #000000;" ALIGN=CENTER VALIGN=MIDDLE width="10%"><B>Code<BR><i>Kode</i></B></TD>
                                <TD STYLE="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: 1px solid #000000;" ALIGN=CENTER VALIGN=MIDDLE width="35%"><B>Nama Barang</B></TD>
                                <TD STYLE="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: 1px solid #000000;" ALIGN=CENTER VALIGN=MIDDLE width="10%"><B>Qty</B></TD>
                                <TD STYLE="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: 1px solid #000000;" ALIGN=CENTER VALIGN=MIDDLE width="12%"><B>U/Price</B></TD>
                                <TD STYLE="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: 1px solid #000000; border-right: 1px solid #000000"  width="18%" ALIGN=CENTER VALIGN=TOP><B>Amount<BR>Harga Total</B></TD>                                
                            </TR>
                            <?php
                            $qtytotal = 0;
                            $row = 6;
                            if (!empty($poitem)) {
                                $counter = 1;
                                foreach ($poitem as $pritem) {
                                    ?>
                                    <TR valign="top">                                        
                                        <TD STYLE="border-left: 1px solid #000000;padding: 2px;" ALIGN=CENTER><?php echo $counter++; ?></TD>
                                        <TD STYLE="border-left: 1px solid #000000;padding: 2px;" ALIGN=LEFT><?php echo $pritem->mat_req_number . $pritem->sr_number ?>&nbsp;</TD>
                                        <TD STYLE="border-left: 1px solid #000000;padding: 2px;" ALIGN=CENTER><?php echo $pritem->itempartnumber; ?>&nbsp;</TD>
                                        <TD STYLE="border-left: 1px solid #000000;padding: 2px;" ALIGN=LEFT><?php echo $pritem->itemdescription; ?>&nbsp;</TD>
                                        <TD STYLE="border-left: 1px solid #000000;padding: 2px;" ALIGN=right>
                                            <?php
                                            echo $pritem->qty . " / " . $pritem->unitcode;
                                            $qtytotal += $pritem->qty;
                                            ?>&nbsp;
                                        </TD>
                                        <TD STYLE="border-left: 1px solid #000000;padding: 2px;" ALIGN=RIGHT>
                                            <?php
                                            if (in_array('hide_price', $accessmenu)) {
                                                echo '-';
                                            } else {
                                                echo number_format($pritem->price, 2, '.', ',');
                                            }
                                            ?>
                                            &nbsp;
                                        </TD>                                  
                                        <TD STYLE="border-left: 1px solid #000000;border-right: 1px solid #000000;padding: 2px;" ALIGN=RIGHT>
                                            <?php
                                            if (in_array('hide_price', $accessmenu)) {
                                                echo '-';
                                            } else {
                                                echo number_format($pritem->total, 2, '.', ',');
                                            }
                                            ?>&nbsp;
                                        </TD>
                                    </TR>
                                    <?php
                                    $row--;
                                }
                            }

                            if ($row > 0) {
                                for ($i = 0; $i < $row; $i++) {
                                    ?>
                                    <TR>                                        
                                        <TD STYLE="border-left: 1px solid #000000;" ALIGN=CENTER>&nbsp;</TD>
                                        <TD STYLE="border-left: 1px solid #000000;" ALIGN=LEFT><BR></TD>
                                        <TD STYLE="border-left: 1px solid #000000;padding-left: 3px" ALIGN=CENTER>&nbsp;</TD>
                                        <TD STYLE="border-left: 1px solid #000000;padding-left: 3px" ALIGN=LEFT>&nbsp;</TD>
                                        <TD STYLE="border-left: 1px solid #000000;" ALIGN=right>&nbsp;</TD>
                                        <TD STYLE="border-left: 1px solid #000000;" ALIGN=RIGHT>&nbsp;</TD>                                  
                                        <TD STYLE="border-left: 1px solid #000000;border-right: 1px solid #000000" ALIGN=RIGHT>&nbsp;</TD>
                                    </TR>
                                    <?php
                                }
                            }
                            ?>
                            <TR>                                        
                                <TD STYLE="border-bottom: 1px solid #000000;border-left: 1px solid #000000;" ALIGN=CENTER>&nbsp;</TD>
                                <TD STYLE="border-bottom: 1px solid #000000;border-left: 1px solid #000000;" ALIGN=LEFT><BR></TD>
                                <TD STYLE="border-bottom: 1px solid #000000;border-left: 1px solid #000000;padding-left: 3px" ALIGN=CENTER>&nbsp;</TD>
                                <TD STYLE="border-bottom: 1px solid #000000;border-left: 1px solid #000000;padding-left: 3px" ALIGN=LEFT>&nbsp;</TD>
                                <TD STYLE="border-bottom: 1px solid #000000;border-left: 1px solid #000000;" ALIGN=right>&nbsp;</TD>
                                <TD STYLE="border-bottom: 1px solid #000000;border-left: 1px solid #000000;" ALIGN=RIGHT>&nbsp;</TD>                                  
                                <TD STYLE="border-bottom: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000" ALIGN=RIGHT>&nbsp;</TD>
                            </TR>
                        </table>
                    </td>
                </tr>       
                <TR>
                    <TD STYLE="border-left: 1px solid #000000;border-right: 1px solid #000000" colspan="20" HEIGHT=10 ALIGN=LEFT><BR></TD>                    
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=20 ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD COLSPAN=4 ALIGN=RIGHT><B>Disc&nbsp;&nbsp;&nbsp;
                            <?php
                            if (in_array('hide_price', $accessmenu)) {
                                echo '-';
                            } else {
                                echo $po->discount_percentage;
                            }
                            ?> % :
                        </B>
                    </TD>
                    <TD COLSPAN=3 ALIGN=RIGHT>
                        <?php
                        if (in_array('hide_price', $accessmenu)) {
                            echo '-';
                        } else {
                            echo number_format($po->discount, 2, '.', ',');
                        }
                        ?>&nbsp;&nbsp;</TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT>&nbsp;</TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD COLSPAN=4 ALIGN=RIGHT><B>Sub Total : </B></TD>
                    <TD COLSPAN=3 ALIGN=RIGHT><?php
                        if (in_array('hide_price', $accessmenu)) {
                            echo '-';
                        } else {
                            echo number_format($po->grandtotal, 2, '.', ',');
                        }
                        ?>&nbsp;&nbsp;</TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>                

                <TR>
                    <TD STYLE="border-left: 1px solid #000000" ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD COLSPAN=4 ALIGN=RIGHT><B>PPn&nbsp;&nbsp;&nbsp;<?php
                            if (in_array('hide_price', $accessmenu)) {
                                echo '-';
                            } else {
                                echo $po->ppn_percentage;
                            }
                            ?> % : </B></TD>
                    <TD COLSPAN=3 ALIGN=RIGHT><?php
                        if (in_array('hide_price', $accessmenu)) {
                            echo '-';
                        } else {
                            echo number_format($po->ppn, 2, '.', ',');
                        }
                        ?>&nbsp;&nbsp;</TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" COLSPAN=6 ALIGN=LEFT VALIGN=MIDDLE><B>&nbsp;&nbsp;GRAND TOTAL</B></TD>
                    <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE SDVAL="6" SDNUM="1033;">
                        &nbsp;
                    </TD>
                    <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000" COLSPAN=2 ALIGN=CENTER VALIGN=MIDDLE SDVAL="6" SDNUM="1033;">&nbsp;</TD>
                    <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000" COLSPAN=2 ALIGN=CENTER VALIGN=MIDDLE SDVAL="6" SDNUM="1033;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php echo $qtytotal; ?>
                    </TD>
                    <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" COLSPAN=7 ALIGN=RIGHT VALIGN=MIDDLE SDVAL="1000" SDNUM="1033;">
                        <?php
                        if (in_array('hide_price', $accessmenu)) {
                            echo '-';
                        } else {
                            echo number_format($po->all_total_price, 2, '.', ',');
                        }
                        ?>
                        &nbsp;&nbsp;</TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=10 ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <?php
                $approval = $this->model_approval->selectApprovalPr($po->prid);
                ?>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" COLSPAN=6 ROWSPAN=6 ALIGN=CENTER VALIGN=TOP><B>Order By<BR>Dipesan Oleh<BR><BR><BR><BR><BR><?php echo strtoupper($approval[0]->name) ?><BR></B></TD>
                    <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000" COLSPAN=4 ROWSPAN=6 ALIGN=LEFT>&nbsp;</TD>
                    <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" COLSPAN=8 ROWSPAN=6 ALIGN=CENTER VALIGN=TOP><B>Accepted &amp; Agreed By<BR>Diterima &amp; disetujui oleh<BR><BR><BR><BR><BR>(&hellip;..................................................)</B></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
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
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=32 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" COLSPAN=7 ROWSPAN=7 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" COLSPAN=3 ALIGN=CENTER VALIGN=TOP><FONT SIZE=1>Aknowledge<BR>Diketahui</FONT></TD>
                    <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" COLSPAN=5 ALIGN=CENTER VALIGN=TOP><FONT SIZE=1>Checked<BR>Diperiksa</FONT></TD>
                    <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" COLSPAN=3 ALIGN=CENTER VALIGN=TOP><FONT SIZE=1>Approved<BR>Disetujui</FONT></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000;" COLSPAN=3 ROWSPAN=6 ALIGN=CENTER><b><i>Aknowledge at </i>: <br/><br/><?php echo date('d/m/Y h:i', strtotime($approval[2]->timeapprove)); ?><br><br/><br/><?php echo strtoupper($approval[2]->name) ?></b></TD>
                    <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000;" COLSPAN=5 ROWSPAN=6 ALIGN=CENTER><b><i>Checked at </i>: <br/><br/><?php echo date('d/m/Y h:i', strtotime($approval[1]->timeapprove)); ?><br><br/><br/><?php echo strtoupper($approval[1]->name) ?></b></TD>
                    <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" COLSPAN=3 ROWSPAN=6 ALIGN=CENTER><b><i>Approved at </i>: <br/><br/><?php echo date('d/m/Y h:i', strtotime($approval[3]->timeapprove)); ?><br><br/><br/><?php echo strtoupper($approval[3]->name) ?></b></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-bottom: 1px solid #000000" COLSPAN=6 ALIGN=LEFT><FONT SIZE=1>Original for supplier</FONT></TD>
                    <TD STYLE="border-bottom: 1px solid #000000" COLSPAN=4 ALIGN=LEFT><FONT SIZE=1>Copy for purchasing (1)</FONT></TD>
                    <TD STYLE="border-bottom: 1px solid #000000" COLSPAN=8 ALIGN=RIGHT><FONT SIZE=1>copy for accounting (2 &amp; 3)</FONT></TD>
                    <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
            </TBODY>
        </TABLE>
        <?php if ($st == 0) { ?>
            <a href="<?php echo base_url() ?>index.php/po/printpo/<?php echo $po->id ?>/1" target="blank"><button>print</button></a>
        <?php } else { ?>
            <script>window.print()</script>
        <?php } ?>
    </center>
    <!-- ************************************************************************** -->
</BODY>
</HTML>
