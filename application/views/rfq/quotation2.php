<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<html>
    <head>
        <title>&nbsp;</title>
    </head>
    <body>
    <center>
        <STYLE>
            <!-- 
            BODY,DIV,TABLE,THEAD,TBODY,TFOOT,TR,TH,TD,P { font-family:"Arial"; font-size:11px;color: #000000; }
            -->
        </STYLE>
        <div style="border: 1px #000000 solid;width: 900px;padding: 2px;">
            <TABLE FRAME=VOID CELLSPACING=0 COLS=14 RULES=NONE BORDER=1 WIDTH="100%">	
                <COLGROUP><COL WIDTH=40><COL WIDTH=91><COL WIDTH=155><COL WIDTH=156><COL WIDTH=43><COL WIDTH=43><COL WIDTH=43><COL WIDTH=95><COL WIDTH=129><COL WIDTH=117><COL WIDTH=43><COL WIDTH=133><COL WIDTH=103><COL WIDTH=154></COLGROUP>
                <TBODY>
                    <TR>
                        <TD COLSPAN=15 WIDTH=1343 HEIGHT=20 ALIGN=CENTER STYLE="border-bottom: 1px solid #000000">
                            <?php
                            echo $company->name."<br/>".nl2br($company->address);
                            ?>
                        </TD>
                    </TR>
                    <TR>
                        <TD HEIGHT=17 ALIGN=LEFT><BR></TD>
                        <TD ALIGN=LEFT><BR></TD>
                        <TD ALIGN=LEFT><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=LEFT><BR></TD>
                        <TD ALIGN=LEFT><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                    </TR>
                    <TR>
                        <TD COLSPAN=15 HEIGHT=17 ALIGN=CENTER style="font-size:15px "><B><U>QUOTATION NO. <?php echo $rfq->quotationnumber ?></U></B></TD>
                    </TR>
                    <TR>
                        <TD HEIGHT=17 ALIGN=LEFT><BR></TD>
                        <TD ALIGN=LEFT><BR></TD>
                        <TD ALIGN=LEFT><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=LEFT><BR></TD>
                        <TD ALIGN=LEFT><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                    </TR>
                    <TR>
                        <TD COLSPAN=2 HEIGHT=17 ALIGN=LEFT><span class="labelelement">Customer</span></TD>
                        <TD ALIGN=LEFT colspan="3">: &nbsp;<?php echo $rfq->customer; ?>&nbsp;</TD>                
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=RIGHT colspan="2" valign="TOP">Shipping Address : </TD>                        
                        <TD ALIGN=LEFT colspan="3" rowspan="2" valign="TOP"><?php echo $rfq->shippingaddress?></TD>                        
                    </TR>
                    <TR>
                        <TD COLSPAN=2 HEIGHT=17 ALIGN=LEFT><span class="labelelement">Project</span></TD>
                        <TD ALIGN=LEFT>:</TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>                        
                    </TR>
                    <TR>
                        <TD COLSPAN=2 HEIGHT=17 ALIGN=LEFT><span class="labelelement">Date</span></TD>
                        <TD ALIGN=LEFT colspan="2">:&nbsp;<?php echo date('d/m/Y') ?></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=LEFT><BR></TD>
                        <TD ALIGN=LEFT><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                    </TR>
                    <TR>
                        <TD HEIGHT=17 ALIGN=LEFT><BR></TD>
                        <TD ALIGN=LEFT><BR></TD>
                        <TD ALIGN=LEFT><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=LEFT><BR></TD>
                        <TD ALIGN=LEFT><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                    </TR>

                    <TR>
                        <TD colspan="14">
                            <TABLE FRAME=VOID CELLSPACING=0 COLS=15 RULES=NONE BORDER=0>
                                <COLGROUP><COL WIDTH=40><COL WIDTH=91><COL WIDTH=86><COL WIDTH=86><COL WIDTH=107><COL WIDTH=44><COL WIDTH=48><COL WIDTH=45><COL WIDTH=105><COL WIDTH=86><COL WIDTH=104><COL WIDTH=86><COL WIDTH=154><COL WIDTH=86><COL WIDTH=86></COLGROUP>
                                <TBODY>
                                    <TR>
                                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ROWSPAN=2 WIDTH=40 HEIGHT=35 ALIGN=CENTER VALIGN=MIDDLE><B>S/No.</B></TD>
                                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" ROWSPAN=2 WIDTH=91 ALIGN=CENTER VALIGN=MIDDLE><B>Item Code</B></TD>
                                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" ROWSPAN=2 WIDTH=86 ALIGN=CENTER VALIGN=MIDDLE><B>Photo</B></TD>
                                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" ROWSPAN=2 WIDTH=86 ALIGN=CENTER VALIGN=MIDDLE><B>Ebako Ref</B></TD>
                                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" ROWSPAN=2 WIDTH=107 ALIGN=CENTER VALIGN=MIDDLE><B>Description</B></TD>
                                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" COLSPAN=3 WIDTH=137 ALIGN=CENTER VALIGN=MIDDLE><B>Dimensions (cm)</B></TD>
                                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" ROWSPAN=2 WIDTH=105 ALIGN=CENTER VALIGN=MIDDLE><B>Material</B></TD>
                                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" ROWSPAN=2 WIDTH=86 ALIGN=CENTER VALIGN=MIDDLE><B>Finishing</B></TD>
                                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" ROWSPAN=2 WIDTH=104 ALIGN=CENTER VALIGN=MIDDLE><B>Yardage <BR>(Yard Per Unit)</B></TD>
                                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" ROWSPAN=2 WIDTH=86 ALIGN=CENTER VALIGN=MIDDLE><B>Qty</B></TD>
                                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" ROWSPAN=2 WIDTH=154 ALIGN=CENTER VALIGN=MIDDLE><B> Price Per Unit <BR>(USD, FOB Semarang) </B></TD>
                                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" ROWSPAN=2 WIDTH=86 ALIGN=CENTER VALIGN=MIDDLE><B> Total Price </B></TD>
                                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" ROWSPAN=2 WIDTH=86 ALIGN=CENTER VALIGN=MIDDLE><B>Remarks</B></TD>
                                    </TR>
                                    <TR>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE><B>W</B></TD>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE><B>D</B></TD>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE><B>H</B></TD>
                                    </TR>
                                    <?php
                                    $no = 1;
                                    $total = 0;
                                    $totalqty = 0;
                                    $totalprice = 0;
                                    
                                    foreach ($rfqdetail as $result) {
                                        ?>
                                        <TR>
                                            <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" HEIGHT=42 ALIGN=CENTER VALIGN=MIDDLE><?php echo $no++ ?></TD>
                                            <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE><?php echo $result->no; ?>&nbsp;</TD>
                                            <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE><img style="max-width: 50px;" src="<?php echo base_url() . "files/" . $result->filename; ?>" /></TD>
                                            <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                                            <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT VALIGN=MIDDLE><?php echo $result->modeldescription; ?>&nbsp;</TD>
                                            <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE><?php echo $result->dw; ?>&nbsp;</TD>
                                            <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE><?php echo $result->dd; ?>&nbsp;</TD>
                                            <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE><?php echo $result->dht; ?>&nbsp;</TD>
                                            <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                                            <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT VALIGN=TOP>&nbsp;</TD>
                                            <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                                            <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE><?php echo $result->qty; ?>&nbsp;</TD>
                                            <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=RIGHT VALIGN=right>
                                                <?php 
                                                    $price = $this->model_costing->getPriceByCustomerAndModel($result->modelid,$rfq->customerid);
                                                    echo number_format($price,2,',', '.');
                                                    $totalqty += $result->qty;
                                                        ?>
                                                &nbsp;
                                            </TD>
                                            <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=RIGHT VALIGN=MIDDLE SDVAL="0">
                                                <?php
                                                echo number_format(($price * $result->qty),2,',', '.');                                                
                                                $totalprice += ($price * $result->qty);
                                                ?>
                                                &nbsp;</TD>
                                            <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE>&nbsp;</TD>
                                        </TR>
                                        <?php
                                    }
                                    ?>
                                    <TR>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE></TD>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE></TD>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE></TD>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE></TD>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT VALIGN=MIDDLE></TD>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE></TD>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE></TD>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE></TD>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE></TD>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT VALIGN=TOP></TD>
                                        <TD ALIGN=CENTER VALIGN=MIDDLE>TOTAL</TD>
                                        <TD STYLE="border-bottom: 1px solid #000000;" ALIGN=CENTER VALIGN=MIDDLE><?php echo $totalqty ?></TD>                                
                                        <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=RIGHT VALIGN=MIDDLE SDVAL="0"></TD>
                                        <TD STYLE="border-bottom: 1px solid #000000;" ALIGN=RIGHT VALIGN=RIGHT><?php echo number_format($totalprice,2,',', '.'); ?>&nbsp;</TD>
                                        <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE></TD>
                                    </tr>
                                </TBODY>
                            </TABLE>
                        </TD>
                    </TR>            
                    <TR>
                        <TD HEIGHT=13 ALIGN=LEFT><BR></TD>
                        <TD ALIGN=LEFT><BR></TD>
                        <TD ALIGN=LEFT><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=LEFT><BR></TD>
                        <TD ALIGN=LEFT><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                    </TR>
                    <TR>
                        <TD ALIGN=LEFT VALIGN=MIDDLE colspan="2"><span class="labelelement">Payment Terms</span></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE colspan="3"><span class="labelelement">: <?php echo $rfq->paymentterm ?></span></TD>                
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                    </TR>
<!--                    <TR>
                        <TD ALIGN=LEFT VALIGN=MIDDLE colspan="2"><span class="labelelement">Lead time</span></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE colspan="3"><span class="labelelement">: </span></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                    </TR>-->
                    <TR>
                        <TD ALIGN=LEFT VALIGN=MIDDLE colspan="2"><span class="labelelement">Currency</span></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE colspan="3"><span class="labelelement">: USD</span></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                    </TR>
<!--                    <TR>
                        <TD ALIGN=LEFT VALIGN=MIDDLE colspan="2"><span class="labelelement">Load ability</span></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE colspan="3"><span class="labelelement">: </span></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><BR></TD>
                        <TD ALIGN=CENTER VALIGN=MIDDLE><BR></TD>
                    </TR>-->
                    <TR>
                        <TD ALIGN=LEFT VALIGN=MIDDLE colspan="2"><span class="labelelement">Quotation Validity</span></TD>
                        <TD ALIGN=LEFT VALIGN=MIDDLE><span class="labelelement">: <?php echo ($rfq->quotationvalidity == "") ? "" : date('d/m/Y',  strtotime($rfq->quotationvalidity))?></span></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                        <TD ALIGN=LEFT><BR></TD>
                        <TD ALIGN=LEFT><BR></TD>
                        <TD ALIGN=CENTER><BR></TD>
                    </TR>
                </TBODY>
            </TABLE>
        </div>
        <?php
        if ($st == 0) {
            ?>
            <a href="<?php echo base_url() . "index.php/rfq/quotation/" . $rfq->id . "/false/1" ?>" target="blank"><button>Print</button></a>
            <?php
        } else {
            echo "<script>window.print()</script>";
        }
        ?>
    </center>

</body>
</html>
<!-- ************************************************************************** -->

