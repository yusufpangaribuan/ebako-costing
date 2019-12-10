<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<HTML>
    <HEAD>
        <TITLE>&nbsp;</TITLE>
        <STYLE>
            <!--
            *{
                margin: 1px;
                padding: 1px;
            }
            BODY,DIV,TABLE,THEAD,TBODY,TFOOT,TR,TH,TD,P { font-family:"Arial"; font-size:12px }
            -->
        </STYLE>
    </HEAD>
    <BODY>
        <div style="width: 780px">
            <TABLE border=0 cellpadding="0" cellspacing="0" width="100%">                
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
                        <TD COLSPAN=5 ALIGN=LEFT VALIGN=TOP><B><?php echo $po->deliveryterm ?></B></TD>
                        <TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT VALIGN=TOP><B>&nbsp;</B></TD>
                    </TR>
                    <TR>
                        <TD STYLE="border-left: 1px solid #000000" ALIGN=LEFT VALIGN=TOP><B><BR></B></TD>
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
                                $row = 5;
                                if (!empty($poitem)) {
                                    $counter = 1;
                                    foreach ($poitem as $pritem) {
                                        ?>
                                        <TR valign="top">                                        
                                            <TD STYLE="border-left: 1px solid #000000;padding: 2px;" ALIGN=CENTER><?php echo $counter++; ?></TD>
                                            <TD STYLE="border-left: 1px solid #000000;padding: 2px;" ALIGN=LEFT><BR></TD>
                                            <TD STYLE="border-left: 1px solid #000000;padding: 2px;" ALIGN=CENTER><?php echo $pritem->itempartnumber; ?>&nbsp;</TD>
                                            <TD STYLE="border-left: 1px solid #000000;padding: 2px;" ALIGN=LEFT><?php echo $pritem->itemdescription; ?>&nbsp;</TD>
                                            <TD STYLE="border-left: 1px solid #000000;padding: 2px;" ALIGN=right>
                                                <?php
                                                echo $pritem->qty . " / " . $pritem->unitcode;
                                                $qtytotal += $pritem->qty;
                                                ?>&nbsp;
                                            </TD>
                                            <TD STYLE="border-left: 1px solid #000000;padding: 2px;" ALIGN=RIGHT><?php echo number_format($pritem->price, 0, '.', ','); ?>&nbsp;</TD>                                  
                                            <TD STYLE="border-left: 1px solid #000000;border-right: 1px solid #000000;padding: 2px;" ALIGN=RIGHT>
                                                <?php
                                                echo number_format($pritem->total, 0, '.', ',');
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
                        <TD COLSPAN=4 ALIGN=RIGHT><B>Disc&nbsp;&nbsp;&nbsp;<?php echo $po->discount_percentage ?> % :</B></TD>
                        <TD COLSPAN=3 ALIGN=RIGHT><?php echo number_format($po->discount, 0, '.', ','); ?>&nbsp;&nbsp;</TD>
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
                        <TD COLSPAN=3 ALIGN=RIGHT><?php echo number_format($po->grandtotal, 0, '.', ','); ?>&nbsp;&nbsp;</TD>
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
                        <TD COLSPAN=4 ALIGN=RIGHT><B>PPn&nbsp;&nbsp;&nbsp;<?php echo $po->ppn_percentage ?> % : </B></TD>
                        <TD COLSPAN=3 ALIGN=RIGHT><?php echo number_format($po->ppn, 0, '.', ',') ?>&nbsp;&nbsp;</TD>
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
                            <?php echo number_format($po->all_total_price, 0, '.', ',') ?>
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
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" COLSPAN=6 ROWSPAN=6 ALIGN=CENTER VALIGN=TOP><B>Order By<BR>Dipesan Oleh<BR>
                                <?php
                                $myfile = "./signature/" . $approval[0]->employeeid . ".png";
                                //echo $myfile;
                                if (file_exists($myfile)) {
                                    echo "<img src='" . base_url() . "/signature/" . $approval[0]->employeeid . ".png' style='max-height:50px;max-width:90px;'/><br/>";
                                } else {
                                    ?>
                                    <b><i>Aknowledge at </i>: <br/><br/><br/>

                                    </b>
                                    <?php
                                }

                                echo strtoupper($approval[0]->name);
                                ?>
                                <BR></B></TD>
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
                        <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000;" COLSPAN=3 ROWSPAN=6 ALIGN=CENTER><b>
                                <?php
//print_r($approval[2]);
                                $myfile = "./signature/" . $approval[2]->employeeid . ".png";
//echo $myfile;
                                if (file_exists($myfile)) {
                                    echo "<img src='" . base_url() . "/signature/" . $approval[2]->employeeid . ".png' style='max-height:90px;max-width:90px;'/><br/>";
                                } else {
                                    ?>
                                    <b><i>Aknowledge at </i>: <br/><br/><br/>

                                    </b>
                                    <?php
                                }
                                echo "<span style='font-size:9px'>" . date('d/m/Y h:i', strtotime($approval[2]->timeapprove)) . "</span><br/>";
                                echo strtoupper($approval[2]->name);
//echo date('d/m/Y h:i', strtotime($approval[3]->timeapprove)); 
                                ?>

                        </TD>
                        <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000;" COLSPAN=5 ROWSPAN=6 ALIGN=CENTER><b>
                                <?php
//print_r($approval);
                                $myfile = "./signature/" . $approval[1]->employeeid . ".png";
//echo $myfile;
                                if (file_exists($myfile)) {
                                    echo "<img src='" . base_url() . "/signature/" . $approval[1]->employeeid . ".png' style='max-height:100px;max-width:100px;'/><br/>";
                                } else {
                                    ?>
                                    <b><i>Checked at </i>: <br/><br/><br/>

                                    </b>
                                    <?php
                                }
                                echo "<span style='font-size:9px'>" . date('d/m/Y h:i', strtotime($approval[1]->timeapprove)) . "</span><br/>";
                                echo strtoupper($approval[1]->name);
//echo date('d/m/Y h:i', strtotime($approval[3]->timeapprove)); 
                                ?>
                                <!--<br><br/><br/>--><br/>
                        </TD>
                        <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" COLSPAN=3 ROWSPAN=6 ALIGN=CENTER><b>
                                <?php
//print_r($approval);
                                $myfile = "./signature/" . $approval[3]->employeeid . ".png";
//echo $myfile;
                                if (file_exists($myfile)) {
                                    echo "<img src='" . base_url() . "/signature/" . $approval[3]->employeeid . ".png' style='max-height:100px;max-width:100px;'/><br/>";
                                    echo "<span style='font-size:9px'>" . date('d/m/Y h:i', strtotime($approval[3]->timeapprove)) . "</span><br/>";
                                } else {
                                    ?>
                                    <b><i>Approved at </i>: <br/>

                                    </b>
                                    <?php
                                }
                                echo strtoupper($approval[3]->name);
//echo date('d/m/Y h:i', strtotime($approval[3]->timeapprove)); 
                                ?>
                                <!--<br><br/><br/>--><br/>

                        </TD>
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
        </DIV>
        <?php if ($st == 0) { ?>
            <a href="<?php echo base_url() ?>index.php/po/printpo/<?php echo $po->id ?>/1" target="blank"><button>print</button></a>
        <?php } else { ?>
            <script>window.print()</script>
        <?php } ?>
        <!-- ************************************************************************** -->
    </BODY>
</HTML>
