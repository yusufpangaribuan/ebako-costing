<html>
    <head>
        <title>&nbsp;</title>
    </head>
    <body>
    <center>
        <STYLE>
            <!-- 
            BODY,DIV,TABLE,THEAD,TBODY,TFOOT,TR,TH,TD,P { font-family:"Verdana"; font-size:x-small;color: black; }
            -->
        </STYLE>
        <div style="border: 1px #000000 solid;width: 900px;padding: 2px;">
            <TABLE FRAME=VOID CELLSPACING=0 COLS=10 RULES=NONE BORDER=1 width="100%">
                <TBODY>
                    <TR>
                        <TD STYLE="border-bottom: 1px solid #000000;" COLSPAN=10 WIDTH=857 HEIGHT=73 ALIGN=LEFT VALIGN=TOP>
                            <?php
                            echo $company->name . "<br/>" . nl2br($company->address);
                            ?>
                    </TR>
                    <TR>
                        <TD COLSPAN=10 HEIGHT=17 ALIGN=LEFT>&nbsp;</TD>
                    </TR>
                    <TR>
                        <TD COLSPAN=2 HEIGHT=19 ALIGN=LEFT><B>TO</B><span style="float: right;font-weight: bold">:</span></TD>
                        <TD  COLSPAN=3 ALIGN=LEFT><B><?php echo $rfq->customer; ?>&nbsp;</B></TD>
                        <TD  COLSPAN=2 ALIGN=RIGHT class="lable"><b>FROM </b><span style="float: right;font-weight: bold">:</span></TD>
                        <TD  COLSPAN=3 ALIGN=LEFT><b>Costing Department</b> </TD>
                    </TR>
                    <TR>
                        <TD  COLSPAN=2 HEIGHT=19 ALIGN=LEFT><B>COMPANY</B><span style="float: right;font-weight: bold">:</span></TD>
                        <TD  COLSPAN=3 ALIGN=LEFT ><?php echo $rfq->customer; ?>&nbsp;</B></TD>
                        <TD  COLSPAN=2 ALIGN=RIGHT ><B>  DATE :  </b></TD>
                        <TD  COLSPAN=3 ALIGN=LEFT ><B>&nbsp;<?php echo date('d/m/Y') ?></B></TD>
                    </TR>
                    <TR>
                        <TD  COLSPAN=2 HEIGHT=19 ALIGN=LEFT><B>FAX NO.</B><span style="float: right;font-weight: bold">:</span></TD>
                        <TD  COLSPAN=3 ALIGN=LEFT ></TD>
                        <TD  COLSPAN=2 ALIGN=RIGHT >  TOTAL PAGES :  </TD>
                        <TD  COLSPAN=3 ALIGN=LEFT SDNUM="1033;0;@">1</TD>
                    </TR>
                    <TR>
                        <TD  COLSPAN=2 HEIGHT=19 ALIGN=LEFT><B>REF</B><span style="float: right;font-weight: bold">:</span></TD>
                        <TD  COLSPAN=3 ALIGN=LEFT ></TD>
                        <TD  COLSPAN=2 ALIGN=LEFT ><BR></TD>
                        <TD  COLSPAN=3 ALIGN=LEFT ><BR></TD>
                    </TR>
                    <TR>
                        <TD  COLSPAN=2 HEIGHT=19 ALIGN=LEFT valign="top"><B>SHIPPING ADDRESS</B><span style="float: right;font-weight: bold">:</span></TD>
                        <TD  COLSPAN=3 ALIGN=LEFT ><?php echo nl2br($rfq->shippingaddress); ?>&nbsp;</TD>
                        <TD  COLSPAN=2 ALIGN=LEFT ><BR></TD>
                        <TD  COLSPAN=3 ALIGN=LEFT ><BR></TD>
                    </TR>
                    <TR>
                        <TD COLSPAN=10 HEIGHT=19 ALIGN=LEFT><BR></TD>
                    </TR>
                    <TR>
                        <TD COLSPAN=10 HEIGHT=20 ALIGN=LEFT><FONT SIZE=3><BR></FONT></TD>
                    </TR>
                    <TR>
                        <TD COLSPAN=10 HEIGHT=41 ALIGN=CENTER VALIGN=MIDDLE><FONT SIZE=6>QUOTATION -No.<?php echo $rfq->quotationnumber ?></FONT></TD>
                    </TR>  

                    <TR>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ROWSPAN=2 HEIGHT=34 ALIGN=CENTER VALIGN=MIDDLE><B>S / No</B></TD>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" COLSPAN=4 ROWSPAN=2 ALIGN=CENTER VALIGN=MIDDLE><B> MODEL / SKETCH </B></TD>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" ROWSPAN=2 ALIGN=CENTER VALIGN=MIDDLE ><B> FINISHES </B></TD>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" ROWSPAN=2 ALIGN=CENTER VALIGN=MIDDLE ><B> UNIT PRICE (US$) </B></TD>
                        <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" COLSPAN=3 ROWSPAN=2 ALIGN=CENTER VALIGN=MIDDLE ><B> REMARKS </B></TD>
                    </TR>
                    <TR>
                    </TR>
                    <?php
                    foreach ($rfqdetail as $result) {
                        ?>
                        <TR>
                            <TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" HEIGHT=80 ALIGN=CENTER VALIGN=MIDDLE><FONT FACE="Times New Roman" SIZE=5><?php echo $result->no; ?></FONT>&nbsp;</TD>
                            <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" COLSPAN=4 ALIGN=CENTER VALIGN=MIDDLE SDNUM="1033;0;@"><img style="max-width: 100px;" src="<?php echo base_url() . "files/" . $result->filename; ?>" />&nbsp;</TD>
                            <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE>&nbsp;</TD>
                            <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE>
                                <FONT FACE="Times New Roman" SIZE=5>
                                <?php
                                $price = $this->model_costing->getPriceByCustomerAndModel($result->modelid, $rfq->customerid);
                                echo number_format($price, 2, ',', '.');
                                ?>
                                </FONT>
                            </TD>
                            <TD STYLE="border-bottom: 1px solid #000000; border-right: 1px solid #000000" ALIGN=CENTER VALIGN=MIDDLE><FONT FACE="Times New Roman"><BR></FONT></TD>
                        </TR>
                    <?php } ?>
                    <tr>
                        <td align="LEFT" height="19" colspan="10">
                            <i> Quoted based on </i>
                        </td>
                    </tr>
                </TBODY>
            </TABLE>
        </div>
        <?php
        if ($st == 0) {
            ?>
            <a href="<?php echo base_url() . "index.php/rfq/quotation/" . $rfq->id . "/true/1" ?>" target="blank"><button>Print</button></a>
            <?php
        } else {
            echo "<script>window.print()</script>";
        }
        ?>
    </center>
</body>
</html>