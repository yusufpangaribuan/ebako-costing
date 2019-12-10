<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<HTML>
    <HEAD>
        <TITLE>&nbsp;</TITLE>
        <STYLE>
            <!-- 
            BODY,DIV,TABLE,THEAD,TBODY,TFOOT,TR,TH,TD,P { font-family:"Arial"; font-size:8pt }
            -->
        </STYLE>
    </HEAD>
    <BODY TEXT="#000000">
    <center>
        <TABLE border=0 cellpadding="0" cellspacing="0">
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
                    <TD COLSPAN=5 ALIGN=LEFT VALIGN=TOP><B><?php echo $po->deliveryterm != "" ? date('d/m/Y', strtotime($po->deliveryterm)) : ''; ?></B></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT VALIGN=TOP><B>&nbsp;</B></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=41 ALIGN=LEFT VALIGN=TOP><B><BR></B></TD>
                    <TD COLSPAN=8 ALIGN=LEFT VALIGN=TOP>Please send us the following items: <BR>Mohon dikirim barang-barang seperti tersebut dibawah ini:<BR></TD>
                    <TD COLSPAN=4 ALIGN=LEFT VALIGN=TOP><B>Terms Of Payment<BR><i>Pembayaran</i></B></TD>
                    <TD ALIGN=CENTER VALIGN=TOP><B>:</B></TD>
                    <TD COLSPAN=5 ALIGN=LEFT VALIGN=TOP><B><?php echo $po->payterm ?></B></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT VALIGN=TOP><B><BR></B></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=13 ALIGN=LEFT><BR></TD>
                    <TD COLSPAN=18 ALIGN=LEFT VALIGN=TOP><BR></TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <tr>
                    <td colspan="20" STYLE="border-left: 1px solid #000000;border-right: 1px solid #000000" align="center">
                        <table width="99%"  border=0 cellpadding="0" cellspacing="0" align="center">
                            <TR>                                
                                <TD STYLE="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: 1px solid #000000;" ALIGN=CENTER VALIGN=MIDDLE><B>NO.<BR><i>No.</i></B></TD>
                                <TD STYLE="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: 1px solid #000000;" ALIGN=CENTER VALIGN=MIDDLE><B>NO. PP<BR><i>No. PP</i></B></TD>
                                <TD STYLE="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: 1px solid #000000;" ALIGN=CENTER VALIGN=MIDDLE><B>Code<BR><i>Kode</i></B></TD>
                                <TD STYLE="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: 1px solid #000000;" ALIGN=CENTER VALIGN=MIDDLE><B>Nama Barang</B></TD>
                                <TD STYLE="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: 1px solid #000000;" ALIGN=CENTER VALIGN=MIDDLE width="50"><B>Qty</B></TD>
                                <TD STYLE="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: 1px solid #000000;" ALIGN=CENTER VALIGN=MIDDLE width="80"><B>U/Price</B></TD>
                                <TD STYLE="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: 1px solid #000000;" ALIGN=CENTER VALIGN=MIDDLE width="80"><B>Total</B></TD>
                                <TD STYLE="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: 1px solid #000000;" ALIGN=CENTER VALIGN=MIDDLE width="80"><B>Matras Price</B></TD>                                
                                <TD STYLE="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: 1px solid #000000;" ALIGN=CENTER VALIGN=MIDDLE width="80"><B>PPNBM</B></TD>
                                <TD STYLE="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: 1px solid #000000;" ALIGN=CENTER VALIGN=MIDDLE width="80"><B>Discount A</B></TD>
                                <TD STYLE="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: 1px solid #000000; border-right: 1px solid #000000"  width="100" ALIGN=CENTER VALIGN=TOP><B>Amount<BR>Harga Total</B></TD>                                
                            </TR>
                            <?php
                            $total = 0;
                            $qtytotal = 0;
                            $total_discount = 0;
                            $total_ppn = 0;
                            $total_price_item = 0;
                            $amount = 0;
                            if (!empty($poitem)) {
                                $counter = 1;

                                foreach ($poitem as $pritem) {
                                    ?>
                                    <TR>                                        
                                        <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000;" ALIGN=CENTER><?php echo $counter++; ?></TD>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000;" ALIGN=LEFT><BR></TD>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000;padding-left: 3px" ALIGN=CENTER><?php echo $pritem->itempartnumber; ?>&nbsp;</TD>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000;padding-left: 3px" ALIGN=LEFT><?php echo $pritem->itemdescription; ?>&nbsp;</TD>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000;" ALIGN=right>
                                            <?php
                                            echo $pritem->qty . " / " . $pritem->unitcode;
                                            $qtytotal += $pritem->qty;
                                            $total_discount += $pritem->discount;
                                            $total_ppn += $pritem->ppn;
                                            ?>&nbsp;
                                        </TD>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000;" ALIGN=RIGHT><?php echo number_format($pritem->price, 0, '.', ','); ?>&nbsp;</TD>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000;" ALIGN=RIGHT><?php echo number_format(($pritem->price * $pritem->qty), 0, '.', ','); ?>&nbsp;</TD>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000;" ALIGN=RIGHT><?php echo number_format($pritem->matras_price, 0, '.', ','); ?>&nbsp;</TD>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000;" ALIGN=RIGHT><?php echo number_format($pritem->ppn, 0, '.', ','); ?>&nbsp;</TD>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000;" ALIGN=RIGHT><?php echo number_format($pritem->discount, 0, '.', ','); ?>&nbsp;</TD>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000;border-right: 1px solid #000000" ALIGN=RIGHT>
                                            <?php
                                            $total_price_item = $pritem->price * $pritem->qty;
                                            $amount = ($total_price_item + $pritem->matras_price + $pritem->ppn) - $pritem->discount;
                                            $total += $amount;
                                            echo number_format($amount, 0, '.', ',');
                                            ?>&nbsp;
                                        </TD>
                                    </TR>
                                    <?php
                                }
                            }
                            ?>
                        </table>
                    </td>
                </tr>

                <TR>
                    <TD STYLE="border-left: 1px solid #000000;border-right: 1px solid #000000" colspan="20" HEIGHT=10 ALIGN=LEFT><BR></TD>                    
                </TR>

                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>                 
                    <TD ALIGN=RIGHT colspan="3"><B>Discount B: </B><BR></TD>
                    <TD ALIGN=RIGHT ><?php echo number_format($po->discount, 0, '.', ','); ?>&nbsp;&nbsp;</TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD COLSPAN=4 ALIGN=RIGHT><B>Total Discount A: </B></TD>
                    <TD COLSPAN=3 ALIGN=RIGHT><?php echo number_format($total_discount, 0, '.', ','); ?>&nbsp;&nbsp;</TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT>&nbsp;</TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>                  
                    <TD ALIGN=RIGHT colspan="3"><B>Tracking Cost: </B><BR></TD>
                    <TD ALIGN=RIGHT ><?php echo number_format($po->tracking_cost, 0, '.', ',') ?>&nbsp;&nbsp;</TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD COLSPAN=4 ALIGN=RIGHT><B>Sub Total : </B></TD>
                    <TD COLSPAN=3 ALIGN=RIGHT><?php echo number_format($total, 0, '.', ',') ?>&nbsp;&nbsp;</TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>                   
                    <TD ALIGN=RIGHT colspan="3"><B>PPN: </B><BR></TD>
                    <TD ALIGN=RIGHT ><?php echo number_format($po->ppn, 0, '.', ',') ?>&nbsp;&nbsp;</TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD COLSPAN=4 ALIGN=RIGHT><B>PNBP : </B></TD>
                    <TD COLSPAN=3 ALIGN=RIGHT><?php echo number_format($po->pnbm, 0, '.', ',') ?>&nbsp;&nbsp;</TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>                                      
                    <TD ALIGN=RIGHT colspan="3"><B>PPH: </B><BR></TD>
                    <TD ALIGN=RIGHT ><?php echo number_format($po->pph, 0, '.', ',') ?>&nbsp;&nbsp;</TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD COLSPAN=4 ALIGN=RIGHT><B>Physical Check : </B></TD>
                    <TD COLSPAN=3 ALIGN=RIGHT><?php echo number_format($po->physical_check, 0, '.', ',') ?>&nbsp;&nbsp;</TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>                                      
                    <TD ALIGN=RIGHT colspan="3"><B>Insurance: </B><BR></TD>
                    <TD ALIGN=RIGHT ><?php echo number_format($po->insurance, 0, '.', ',') ?>&nbsp;&nbsp;</TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD COLSPAN=4 ALIGN=RIGHT><B>Clearance : </B></TD>
                    <TD COLSPAN=3 ALIGN=RIGHT><?php echo number_format($po->clearance, 0, '.', ',') ?>&nbsp;&nbsp;</TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>                                      
                    <TD ALIGN=RIGHT colspan="3"><B>ID System: </B><BR></TD>
                    <TD ALIGN=RIGHT ><?php echo number_format($po->id_system, 0, '.', ',') ?>&nbsp;&nbsp;</TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD ALIGN=LEFT><BR></TD>
                    <TD COLSPAN=4 ALIGN=RIGHT><B>All Total Price: </B></TD>
                    <TD COLSPAN=3 ALIGN=RIGHT><?php echo number_format($po->all_total_price, 0, '.', ',') ?>&nbsp;&nbsp;</TD>
                    <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
                </TR>                
                <TR>
                    <TD STYLE="border-left: 1px solid #000000" ALIGN=LEFT><BR></TD>
                    <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" COLSPAN=6 ALIGN=LEFT VALIGN=MIDDLE><B>&nbsp;&nbsp;GRAND TOTAL</B></TD>
                    <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE SDVAL="6" SDNUM="1033;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $qtytotal; ?></TD>
                    <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000" COLSPAN=2 ALIGN=CENTER VALIGN=MIDDLE SDVAL="6" SDNUM="1033;">&nbsp;</TD>
                    <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000" COLSPAN=2 ALIGN=CENTER VALIGN=MIDDLE SDVAL="6" SDNUM="1033;">&nbsp;</TD>
                    <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" COLSPAN=7 ALIGN=RIGHT VALIGN=MIDDLE SDVAL="1000" SDNUM="1033;">
                        <?php echo number_format($po->grandtotal, 0, '.', ',') ?>
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
                    <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" COLSPAN=6 ROWSPAN=6 ALIGN=CENTER VALIGN=TOP><B><FONT SIZE=1>Order By<BR>Dipesan Oleh<BR><BR><BR><BR><BR><?php echo strtoupper($approval[0]->name) ?><BR></FONT></B></TD>
                    <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000" COLSPAN=4 ROWSPAN=6 ALIGN=LEFT>&nbsp;</TD>
                    <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" COLSPAN=8 ROWSPAN=6 ALIGN=CENTER VALIGN=TOP><B><FONT SIZE=1>Accepted &amp; Agreed By<BR>Diterima &amp; disetujui oleh<BR><BR><BR><BR><BR>(&hellip;..................................................)</FONT></B></TD>
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
                    <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000;" COLSPAN=3 ROWSPAN=6 ALIGN=CENTER><BR><br><br><br><br><?php echo strtoupper($approval[2]->name) ?></TD>
                    <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000;" COLSPAN=5 ROWSPAN=6 ALIGN=CENTER><BR><br><br><br><br><?php echo strtoupper($approval[1]->name) ?></TD>
                    <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" COLSPAN=3 ROWSPAN=6 ALIGN=CENTER><BR><br><br><br><br><?php echo strtoupper($approval[3]->name) ?></TD>
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
            <a href="<?php echo base_url() ?>index.php/po/view_detail/<?php echo $po->id ?>/1" target="_blank"><button>print</button></a>
        <?php } else { ?>
            <script>window.print()</script>
        <?php } ?>
    </center>
    <!-- ************************************************************************** -->
</BODY>
</HTML>
