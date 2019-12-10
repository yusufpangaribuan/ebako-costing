<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">

<HTML>
    <HEAD>

        <META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=windows-1252">
        <TITLE></TITLE>
        <STYLE>
            <!-- 
            BODY,DIV,TABLE,THEAD,TBODY,TFOOT,TR,TH,TD,P { font-family:"Arial"; font-size:x-small }
            table.tableprint{
                border: 1px #000 solid; 
                border-collapse: collapse;
            }
            table.tableprint td{
                border: 1px #000 solid;
                border-collapse: collapse;
            }
            .labeltitle{
                font-family: Verdana;
                font-size: 12px;
                font-weight: bold;
            }
            -->
        </STYLE>

    </HEAD>
    <BODY TEXT="#000000">        
    <center>
        <table cellpadding="0" cellspacinf="0" width="1300" border="0">
            <tr valign="top">
                <td width="30%" style="border: 1px #000 solid;height: 200px; max-width: 250px" align="center" valign="middle">
                    <img src="<?php echo base_url() ?>files/<?php echo $model->filename ?>" style="max-height: 200px; max-width: 250px;"/>
                </td>
                <td width="70%">                    
                    <table width="100%" border="0">
                        <tr valign="top">
                            <td width="50%">
                                <table width="100%">
                                    <tr>
                                        <td width="30%"><span class="labeltitle">BOM NO</span></td>
                                        <td width="2%"><span class="labeltitle">:</span></td>
                                        <td width="68%">&nbsp;<span class="labeltitle">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td><span class="labeltitle">CODE</span></td>
                                        <td><span class="labeltitle">:</span></td>
                                        <td>&nbsp;<span class="labeltitle"><?php echo $model->no ?></td>
                                    </tr>
                                    <tr>
                                        <td><span class="labeltitle">DESCRIPTION</span></td>
                                        <td><span class="labeltitle">:</span></td>
                                        <td>&nbsp;<span class="labeltitle"><?php echo $model->description ?></td>
                                    </tr>
                                    <tr>
                                        <td><span class="labeltitle">O.A DIM</td>
                                        <td><span class="labeltitle">:</td>
                                        <td>&nbsp;
                                            <span class="labeltitle">W :</span>
                                            <span class="labeltitle"><?php echo $model->dw ?></span>&nbsp;&nbsp;&nbsp;
                                            <span class="labeltitle">D :</span>
                                            <span class="labeltitle"><?php echo $model->dd ?></span>&nbsp;&nbsp;&nbsp;
                                            <span class="labeltitle">H :</span>&nbsp;&nbsp;&nbsp;
                                            <span class="labeltitle"><?php echo $model->dht ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="44%"><span class="labeltitle">JO</span></td>
                                        <td width="2%"><span class="labeltitle">:</span></td>
                                        <td width="44%">&nbsp;<span class="labeltitle">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="44%"><span class="labeltitle">QTY</span></td>
                                        <td width="2%"><span class="labeltitle">:</span></td>
                                        <td width="44%">&nbsp;<span class="labeltitle">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="50%">
                                <span style="font-size: 18pt;font-weight: bold;">PT EBAKO NUSANTARA</span><br/>
                                <span style="font-size: 18pt;font-weight: bold;">CUTTING LIST</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td width="100%" colspan="2">
                    <TABLE  CELLSPACING=0 COLS=0 RULES=NONE BORDER=0 class="tableprint">        
                        <TBODY>
                            <TR>                               
                                <TD class="bom" ROWSPAN=3 WIDTH=5 HEIGHT=62 ALIGN=CENTER><B>NO</B></TD>
                                <TD class="bom" ROWSPAN=3 WIDTH=5 ALIGN=CENTER><B>QTY.</B></TD>
                                <TD class="bom" ROWSPAN=3 WIDTH=150 ALIGN=CENTER><B>COMPONENT</B></TD>
                                <TD class="bom" COLSPAN=5 WIDTH=500 ALIGN=CENTER VALIGN=MIDDLE><B>MATERIAL</B></TD>
                                <TD class="bom" COLSPAN=4 ROWSPAN=2 WIDTH=343 ALIGN=CENTER><B>PROCESS</B></TD>
                                <TD class="bom" COLSPAN=3 ROWSPAN=2 WIDTH=257 ALIGN=CENTER><B>FINAL SIZE</B></TD>
                                <TD class="bom" COLSPAN=3 ROWSPAN=2 WIDTH=257 ALIGN=CENTER><B>ROUGH SIZE</B></TD>
                                <TD class="bom" COLSPAN=7 WIDTH=685 ALIGN=CENTER><B>volume (m3)</B></TD>
                                <TD class="bom" COLSPAN=8 WIDTH=685 ALIGN=CENTER><B>SQ.m</B></TD>
                            </TR>
                            <TR>
                                <TD class="bom" ROWSPAN=2 WIDTH="70" ALIGN=CENTER><B>WOOD</B></TD>
                                <TD class="bom" COLSPAN=4 ALIGN=CENTER VALIGN=MIDDLE><B>VENEER</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>MH/MD/</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>25</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>30</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>40</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>50</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>60</B></TD>
                                <TD class="bom" ROWSPAN=2 ALIGN=CENTER><B>AG</B></TD>
                                <TD class="bom" COLSPAN=2 ALIGN=CENTER><B>PLWD</B></TD>
                                <TD class="bom" COLSPAN=2 ALIGN=CENTER><B>PRTCLE</B></TD>
                                <TD class="bom" COLSPAN=2 ALIGN=CENTER><B>MDF</B></TD>
                                <TD class="bom" COLSPAN=2 ALIGN=CENTER><B>VENR</B></TD>
                            </TR>
                            <TR>
                                <TD class="bom" ALIGN=CENTER VALIGN=MIDDLE><B>TYPE</B></TD>
                                <TD class="bom" ALIGN=CENTER VALIGN=MIDDLE width="2"><B>S1S</B></TD>
                                <TD class="bom" ALIGN=CENTER VALIGN=MIDDLE width="2"><B>DGB</B></TD>
                                <TD class="bom" ALIGN=CENTER VALIGN=MIDDLE width="2"><B>S2S</B></TD>
                                <TD class="bom" ALIGN=CENTER width="2"><B>Turn</B></TD>
                                <TD class="bom" ALIGN=CENTER ><B>Lam</B></TD>
                                <TD class="bom" ALIGN=CENTER width="2"><B>Carv</B></TD>
                                <TD class="bom" ALIGN=CENTER width="2"><B>Mall</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>T</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>W</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>L</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>T</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>W</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>L</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>EURO/OAK</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>25</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>32</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>38</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>50</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>60</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>THICK</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>(M2)</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>THICK</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>(M2)</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>THICK</B></TD>
                                <TD class="bom" ALIGN=CENTER><B> (M2)</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>A</B></TD>
                                <TD class="bom" ALIGN=CENTER><B>DGB</B></TD>
                            </TR>
                            <?php
                            //print_r($bom);
                            $arr_total_volume = array();
                            $arr_mdf = array(3 => 0, 6 => 0, 9 => 0, 12 => 0, 15 => 0, 18 => 0, 24 => 0);
                            $arr_prtcl = array(3 => 0, 6 => 0, 9 => 0, 12 => 0, 15 => 0, 18 => 0, 24 => 0);
                            $arr_plwed = array(3 => 0, 6 => 0, 9 => 0, 12 => 0, 15 => 0, 18 => 0, 24 => 0);
                            foreach ($wood as $rst) {
                                $arr_total_volume[$rst->woodname] = array(25 => 0, 30 => 0, 40 => 0, 50 => 0, 60 => 0, 70 => 0, "ag" => 0);
                            }
                            $no = 1;
                            $totalqty = 0;
                            foreach ($bom as $bom) {
                                $v25 = 0;
                                $v30 = 0;
                                $v40 = 0;
                                $v50 = 0;
                                $v60 = 0;
                                if (strpos($bom->lam, "+") !== false) {
                                    $arrlamp = explode("+", $bom->lam);
                                    for ($i = 0; $i < count($arrlamp); $i++) {
                                        $volume = ($bom->qty * $arrlamp[$i] * $bom->rw * $bom->rl) / 1000000000;
                                        if ($arrlamp[$i] > 10 && $arrlamp[$i] < 30) {
                                            $v25 += $volume;
                                        }
                                        if ($arrlamp[$i] >= 30 && $arrlamp[$i] < 40) {
                                            $v30 += $volume;
                                        }
                                        if ($arrlamp[$i] >= 40 && $arrlamp[$i] < 50) {
                                            $v40 += $volume;
                                        }
                                        if ($arrlamp[$i] >= 50 && $arrlamp[$i] < 60) {
                                            $v50 += $volume;
                                        }
                                        if ($arrlamp[$i] >= 60) {
                                            $v60 += $volume;
                                        }
                                    }
                                } else {
                                    $suffix = 1;
                                    $divide = 1;
                                    if ($bom->mhmd != "") {
                                        list($suf, $div) = explode("=", $bom->mhmd);
                                        $suf = (int) $suf;
                                        $div = (int) $div;
                                        $suffix = ($suf == 0 ? 1 : $suf);
                                        $divide = ($div == 0 ? 1 : $div);
                                    }
                                    $volume = ((($bom->qty * $bom->rt * $bom->rw * $bom->rl) / 1000000000) * $suffix) / $divide;
                                    if ($bom->rt > 10 && $bom->rt < 30) {
                                        $v25 += $volume;
                                    }
                                    if ($bom->rt >= 30 && $bom->rt < 40) {
                                        $v30 += $volume;
                                    }
                                    if ($bom->rt >= 40 && $bom->rt < 50) {
                                        $v40 += $volume;
                                    }
                                    if ($bom->rt >= 50 && $bom->rt < 60) {
                                        $v50 += $volume;
                                    }
                                    if ($bom->rt >= 60) {
                                        $v60 += $volume;
                                    }
                                }
                                ?>
                                <TR>                                
                                    <TD class="bom" ALIGN=CENTER><?php echo $no++ ?></TD>
                                    <TD class="bom" ALIGN=CENTER><?php echo $bom->qty; ?></TD>
                                    <TD class="bom" ALIGN=LEFT><?php echo $bom->description ?></TD>
                                    <TD class="bom" ALIGN=CENTER><?php echo $bom->woodname ?></TD>
                                    <TD class="bom" ALIGN=CENTER><?php echo $bom->ven_type ?></TD>
                                    <TD class="bom" ALIGN=CENTER><?php echo $bom->ven_s1s ?></TD>
                                    <TD class="bom" ALIGN=CENTER><?php echo $bom->ven_dgb ?></TD>
                                    <TD class="bom" ALIGN=CENTER><?php echo $bom->ven_s2s ?></TD>
                                    <TD class="bom" ALIGN=CENTER><?php echo $bom->turn ?></TD>
                                    <TD class="bom" ALIGN=CENTER><?php echo $bom->lam ?></TD>
                                    <TD class="bom" ALIGN=CENTER><?php echo $bom->carv ?></TD>
                                    <TD class="bom" ALIGN=CENTER><?php echo $bom->mall ?></TD>
                                    <TD class="bom" ALIGN=CENTER><?php echo $bom->ft ?></TD>
                                    <TD class="bom" ALIGN=CENTER><?php echo $bom->fw ?></TD>
                                    <TD class="bom" ALIGN=CENTER><?php echo $bom->fl ?></TD>
                                    <TD class="bom" ALIGN=CENTER><?php echo $bom->rt ?></TD>
                                    <TD class="bom" ALIGN=CENTER><?php echo $bom->rw ?></TD>
                                    <TD class="bom" ALIGN=CENTER><?php echo $bom->rl ?></TD>
                                    <TD class="bom" ALIGN=CENTER><?php echo $bom->mhmd ?></TD>
                                    <TD class="bom" ALIGN=CENTER>
                                        <?php
                                        if ($bom->woodid != 1 && $v25 != 0) {
                                            echo number_format($v25, 4, '.', '');
                                            $arr_total_volume[$bom->woodname][25] = $arr_total_volume[$bom->woodname][25] + $v25;
                                        }
                                        ?>
                                    </TD>

                                    <TD class="bom" ALIGN=CENTER>
                                        <?php
                                        if ($bom->woodid != 1 && $v30 != 0) {
                                            echo number_format($v30, 4, '.', '');
                                            $arr_total_volume[$bom->woodname][30] = $arr_total_volume[$bom->woodname][30] + $v30;
                                        }
                                        ?>
                                    </TD>
                                    <TD class="bom" ALIGN=CENTER>
                                        <?php
                                        if ($bom->woodid != 1 && $v40 != 0) {
                                            echo number_format($v40, 4, '.', '');
                                            $arr_total_volume[$bom->woodname][40] = $arr_total_volume[$bom->woodname][40] + $v40;
                                        }
                                        ?>
                                    </TD>
                                    <TD class="bom" ALIGN=CENTER>
                                        <?php
                                        if ($bom->woodid != 1 && $v50 != 0) {
                                            echo number_format($v50, 4, '.', '');
                                            $arr_total_volume[$bom->woodname][50] = $arr_total_volume[$bom->woodname][50] + $v50;
                                        }
                                        ?>
                                    </TD>
                                    <TD class="bom" ALIGN=CENTER>
                                        <?php
                                        if ($bom->woodid != 1 && $v60 != 0) {
                                            echo number_format($v60, 4, '.', '');
                                            $arr_total_volume[$bom->woodname][60] = $arr_total_volume[$bom->woodname][60] + $v60;
                                        }
                                        ?>
                                    </TD>
                                    <TD class="bom" ALIGN=CENTER>
                                        <?php
                                        if ($bom->woodid == 1) {
                                            $volume = ((($bom->qty * $bom->rt * $bom->rw * $bom->rl) / 1000000000) * $suffix) / $divide;
                                            echo number_format($volume, 4, '.', '');
                                            $arr_total_volume[$bom->woodname]["ag"] = $arr_total_volume[$bom->woodname]["ag"] + $volume;
                                        }
                                        ?>
                                    </TD>
                                    <TD class="bom" ALIGN=CENTER>
                                        <?php
                                        $plwdm2 = "";
                                        if ($bom->componentcategoryid == 2) {
                                            $plwdm2 = ($bom->qty * $bom->rw * $bom->rl) / 1000000;
                                            echo $bom->rt;
                                            $arr_prtcl[$bom->rt] += $plwdm2;
                                        }
                                        ?>
                                    </TD>
                                    <TD class="bom" ALIGN=CENTER><?php echo ($plwdm2 != "") ? number_format($plwdm2, 4, '.', '') : ""; ?></TD>
                                    <TD class="bom" ALIGN=CENTER></TD>
                                    <TD class="bom" ALIGN=CENTER></TD>
                                    <TD class="bom" ALIGN=CENTER>
                                        <?php
                                        $mdf = "";
                                        if ($bom->componentcategoryid == 4) {
                                            $mdf = ($bom->qty * $bom->rw * $bom->rl) / 1000000;
                                            $arr_mdf[$bom->rt] += $arr_mdf[$bom->rt] + $mdf;
                                            echo $bom->rt;
                                        }
                                        ?>
                                    </TD>
                                    <TD class="bom" ALIGN=CENTER><?php echo ($mdf != "") ? number_format($mdf, 4, '.', '') : ""; ?></TD>
                                    <TD class="bom" ALIGN=CENTER>
                                        <?php
                                        if ($bom->sq_ven_a == 't') {
                                            echo number_format((($bom->qty * $bom->rw * $bom->rl) / 1000000), 4, '.', '');
                                        }
                                        ?>
                                    </TD>
                                    <TD class="bom" ALIGN=CENTER>
                                        <?php
                                        if ($bom->sq_ven_dgb == 't') {
                                            echo number_format((($bom->qty * $bom->rw * $bom->rl) / 1000000), 4, '.', '');
                                        }
                                        ?>
                                    </TD>                
                                </TR>
                                <?php
                                $totalqty = $totalqty + $bom->qty;
                            }
                            ?>
                            <TR>                                
                                <TD class="bom" ALIGN=CENTER></TD>
                                <TD class="bom" ALIGN=CENTER><?php echo $totalqty; ?></TD>
                                <TD class="bom" ALIGN=CENTER></TD>
                                <TD class="bom" ALIGN=CENTER></TD>
                                <TD class="bom" ALIGN=CENTER></TD>
                                <TD class="bom" ALIGN=CENTER></TD>
                                <TD class="bom" ALIGN=CENTER></TD>
                                <TD class="bom" ALIGN=CENTER></TD>
                                <TD class="bom" ALIGN=CENTER></TD>
                                <TD class="bom" ALIGN=CENTER></TD>
                                <TD class="bom" ALIGN=CENTER></TD>
                                <TD class="bom" ALIGN=CENTER></TD>
                                <TD class="bom" ALIGN=CENTER></TD>
                                <TD class="bom" ALIGN=CENTER></TD>                          
                                <TD class="bom" ALIGN=CENTER></TD>
                                <TD class="bom" ALIGN=CENTER></TD>
                                <TD class="bom" ALIGN=CENTER></TD>
                                <TD class="bom" ALIGN=CENTER colspan="8">&nbsp;</TD>
                                <TD class="bom" ALIGN=CENTER colspan="8"></TD>                
                            </TR>        
                    </TABLE>
                    <br/>
                    <div style="float: right;">
                        <table width="700" border="0">
                            <tr valign="top">
                                <TD width="300" ALIGN=CENTER>
                                    <b>BREAKDOWN (SOLID WOOD)</b>
                                    <br/>
                                    <table width="100%" class="tableprint">
                                        <tr>
                                            <TD class="bom" ALIGN=CENTER><B>MH/MD/</B></TD>
                                            <TD class="bom" ALIGN=CENTER><B>25</B></TD>
                                            <TD class="bom" ALIGN=CENTER><B>30</B></TD>
                                            <TD class="bom" ALIGN=CENTER><B>40</B></TD>
                                            <TD class="bom" ALIGN=CENTER><B>50</B></TD>
                                            <TD class="bom" ALIGN=CENTER><B>60</B></TD>                     
                                            <TD class="bom" ALIGN=CENTER valign="middle"><B>AG</B></TD>
                                        </tr>                    
                                        <?php
                                        $total_25 = 0;
                                        $total_30 = 0;
                                        $total_40 = 0;
                                        $total_50 = 0;
                                        $total_60 = 0;
                                        $total_70 = 0;
                                        $total_ag = 0;
                                        foreach ($wood as $rst) {
                                            ?>
                                            <tr>
                                                <TD class="bom" ALIGN=CENTER><B><?php echo $rst->woodname ?></B></TD>
                                                <TD class="bom" ALIGN=CENTER>                                
                                                    <?php
                                                    if ($arr_total_volume[$rst->woodname][25] != 0) {
                                                        $vt_25 = number_format($arr_total_volume[$rst->woodname][25], 4, '.', '');
                                                        echo $vt_25;
                                                        $total_25 += $vt_25;
                                                    }
                                                    ?>                                
                                                </TD>
                                                <TD class="bom" ALIGN=CENTER>                                
                                                    <?php
                                                    if ($arr_total_volume[$rst->woodname][30] != 0) {
                                                        $vt_30 = number_format($arr_total_volume[$rst->woodname][30], 4, '.', '');
                                                        echo $vt_30;
                                                        $total_30 += $vt_30;
                                                    }
                                                    ?>                                
                                                </TD>
                                                <TD class="bom" ALIGN=CENTER>                                
                                                    <?php
                                                    if ($arr_total_volume[$rst->woodname][40] != 0) {
                                                        $vt_40 = number_format($arr_total_volume[$rst->woodname][40], 4, '.', '');
                                                        echo $vt_40;
                                                        $total_40 += $vt_40;
                                                    }
                                                    ?>                                
                                                </TD>
                                                <TD class="bom" ALIGN=CENTER>                                
                                                    <?php
                                                    if ($arr_total_volume[$rst->woodname][50] != 0) {
                                                        $vt_50 = number_format($arr_total_volume[$rst->woodname][50], 4, '.', '');
                                                        echo $vt_50;
                                                        $total_50 += $vt_50;
                                                    }
                                                    ?>                                
                                                </TD>
                                                <TD class="bom" ALIGN=CENTER>                                
                                                    <?php
                                                    if ($arr_total_volume[$rst->woodname][60] != 0) {
                                                        $vt_60 = number_format($arr_total_volume[$rst->woodname][60], 4, '.', '');
                                                        echo $vt_60;
                                                        $total_60 += $vt_60;
                                                    }
                                                    ?>                                
                                                </TD>
                                                <TD class="bom" ALIGN=CENTER>                                
                                                    <?php
                                                    if ($arr_total_volume[$rst->woodname]["ag"] != 0) {
                                                        $vt_ag = number_format($arr_total_volume[$rst->woodname]["ag"], 4, '.', '');
                                                        echo $vt_ag;
                                                        $total_ag += $vt_ag;
                                                    }
                                                    ?>                                
                                                </TD>
                                            </tr>
                                            <?php
                                        }

                                        $total_25_n_yield = 0;
                                        $total_30_n_yield = 0;
                                        $total_40_n_yield = 0;
                                        $total_50_n_yield = 0;
                                        $total_60_n_yield = 0;
                                        $total_70_n_yield = 0;
                                        $total_ag_n_yield = 0;
                                        ?>
                                        <tr>
                                            <TD class="bom" ALIGN=CENTER><B>TOTAL</B></TD>
                                            <TD class="bom" ALIGN=CENTER>&nbsp;<?php echo ($total_25 != 0) ? $total_25 : ""; ?>&nbsp;</TD>
                                            <TD class="bom" ALIGN=CENTER>&nbsp;<?php echo ($total_30 != 0) ? $total_30 : ""; ?>&nbsp;</TD>
                                            <TD class="bom" ALIGN=CENTER>&nbsp;<?php echo ($total_40 != 0) ? $total_40 : ""; ?>&nbsp;</TD>
                                            <TD class="bom" ALIGN=CENTER>&nbsp;<?php echo ($total_50 != 0) ? $total_50 : ""; ?>&nbsp;</TD>
                                            <TD class="bom" ALIGN=CENTER>&nbsp;<?php echo ($total_60 != 0) ? $total_60 : ""; ?>&nbsp;</TD>
                                            <TD class="bom" ALIGN=CENTER>&nbsp;<?php echo ($total_ag != 0) ? $total_ag : ""; ?>&nbsp;</TD>
                                        </tr>                    
                                        <tr>
                                            <TD class="bom" ALIGN=CENTER><B>YIELD</B></TD>
                                            <TD class="bom" ALIGN=CENTER>
                                                <?php
                                                if ($model->yield != 0 && $model->yield != "" && $total_25 != 0) {
                                                    echo number_format(($total_25 / ($model->yield / 100)), 4, '.', '');
                                                    $total_25_n_yield = $total_25 + ($total_25 / ($model->yield / 100));
                                                }
                                                ?>
                                            </TD>
                                            <TD class="bom" ALIGN=CENTER>
                                                <?php
                                                if ($model->yield != 0 && $model->yield != "" && $total_30 != 0) {
                                                    echo number_format(($total_30 / ($model->yield / 100)), 4, '.', '');
                                                    $total_30_n_yield = $total_30 + ($total_30 / ($model->yield / 100));
                                                }
                                                ?>
                                            </TD>
                                            <TD class="bom" ALIGN=CENTER>
                                                <?php
                                                if ($model->yield != 0 && $model->yield != "" && $total_40 != 0) {
                                                    echo number_format(($total_40 / ($model->yield / 100)), 4, '.', '');
                                                    $total_40_n_yield = $total_40 + ($total_40 / ($model->yield / 100));
                                                }
                                                ?>
                                            </TD>
                                            <TD class="bom" ALIGN=CENTER>
                                                <?php
                                                if ($model->yield != 0 && $model->yield != "" && $total_50 != 0) {
                                                    echo number_format(($total_50 / ($model->yield / 100)), 4, '.', '');
                                                    $total_50_n_yield = $total_50 + ($total_50 / ($model->yield / 100));
                                                }
                                                ?>
                                            </TD>
                                            <TD class="bom" ALIGN=CENTER>
                                                <?php
                                                if ($model->yield != 0 && $model->yield != "" && $total_60 != 0) {
                                                    echo number_format(($total_60 / ($model->yield / 100)), 4, '.', '');
                                                    $total_60_n_yield = $total_60 + ($total_60 / ($model->yield / 100));
                                                }
                                                ?>
                                            </TD>
                                            <TD class="bom" ALIGN=CENTER>
                                                <?php
                                                if ($model->yield != 0 && $model->yield != "" && $total_ag != 0) {
                                                    echo number_format(($total_ag / ($model->yield / 100)), 4, '.', '');
                                                    $total_ag_n_yield = $total_ag + ($total_ag / ($model->yield / 100));
                                                }
                                                ?>
                                            </TD>
                                        </tr>            
                                        <tr>
                                            <TD class="bom" ALIGN=CENTER><B>TOTAL + YIELD</B></TD>
                                            <TD class="bom" ALIGN=CENTER>&nbsp;<?php echo ($total_25_n_yield != 0) ? number_format($total_25_n_yield, 4, '.', '') : ""; ?>&nbsp;</TD>
                                            <TD class="bom" ALIGN=CENTER>&nbsp;<?php echo ($total_30_n_yield != 0) ? number_format($total_30_n_yield, 4, '.', '') : ""; ?>&nbsp;</TD>
                                            <TD class="bom" ALIGN=CENTER>&nbsp;<?php echo ($total_40_n_yield != 0) ? number_format($total_40_n_yield, 4, '.', '') : ""; ?>&nbsp;</TD>
                                            <TD class="bom" ALIGN=CENTER>&nbsp;<?php echo ($total_50_n_yield != 0) ? number_format($total_50_n_yield, 4, '.', '') : ""; ?>&nbsp;</TD>
                                            <TD class="bom" ALIGN=CENTER>&nbsp;<?php echo ($total_60_n_yield != 0) ? number_format($total_60_n_yield, 4, '.', '') : ""; ?>&nbsp;</TD>                                            
                                            <TD class="bom" ALIGN=CENTER>&nbsp;<?php echo ($total_ag_n_yield != 0) ? number_format($total_ag_n_yield, 4, '.', '') : ""; ?>&nbsp;</TD>
                                        </tr>
                                        <tr>
                                            <TD class="bom" ALIGN=CENTER><B> ALL TOTAL</B></TD>
                                            <TD class="bom" ALIGN=CENTER colspan="6">
                                                <?php
                                                $alltotal = $total_25_n_yield + $total_30_n_yield + $total_40_n_yield + $total_50_n_yield + $total_60_n_yield + $total_ag_n_yield;
                                                echo $alltotal;
                                                ?>
                                            </TD>                        
                                        </tr>
                                    </table>
                                </TD>
                                <TD width="315" ALIGN=CENTER>
                                    <b>BREAKDOWN (BOARD)</b>
                                    <table width="100%" class="tableprint">
                                        <tr>
                                            <TD class="bom" ALIGN=CENTER><B>MTRL</B></TD>
                                            <TD class="bom" ALIGN=CENTER><B>3</B></TD>
                                            <TD class="bom" ALIGN=CENTER><B>6</B></TD>
                                            <TD class="bom" ALIGN=CENTER><B>9</B></TD>
                                            <TD class="bom" ALIGN=CENTER><B>12</B></TD>
                                            <TD class="bom" ALIGN=CENTER><B>15</B></TD>
                                            <TD class="bom" ALIGN=CENTER><B>18</B></TD>                        
                                            <TD class="bom" ALIGN=CENTER><B>24</B></TD>
                                        </tr>
                                        <tr>
                                            <TD class="bom" ALIGN=LEFT>MDF</TD>
                                            <TD class="bom" ALIGN=CENTER><?php echo ($arr_mdf[3] != 0) ? number_format($arr_mdf[3], 4, '.', '') : ""; ?></TD>
                                            <TD class="bom" ALIGN=CENTER><?php echo ($arr_mdf[6] != 0) ? number_format($arr_mdf[6], 4, '.', '') : ""; ?></TD>
                                            <TD class="bom" ALIGN=CENTER><?php echo ($arr_mdf[9] != 0) ? number_format($arr_mdf[9], 4, '.', '') : ""; ?></TD>
                                            <TD class="bom" ALIGN=CENTER><?php echo ($arr_mdf[12] != 0) ? number_format($arr_mdf[12], 4, '.', '') : ""; ?></TD>
                                            <TD class="bom" ALIGN=CENTER><?php echo ($arr_mdf[15] != 0) ? number_format($arr_mdf[15], 4, '.', '') : ""; ?></TD>
                                            <TD class="bom" ALIGN=CENTER><?php echo ($arr_mdf[18] != 0) ? number_format($arr_mdf[18], 4, '.', '') : ""; ?></TD>
                                            <TD class="bom" ALIGN=CENTER><?php echo ($arr_mdf[24] != 0) ? number_format($arr_mdf[24], 4, '.', '') : ""; ?></TD>
                                        </tr>
                                        <tr>
                                            <TD class="bom" ALIGN=LEFT>PLWD</TD>
                                            <TD class="bom" ALIGN=CENTER><?php echo ($arr_prtcl[3] != 0) ? number_format($arr_prtcl[3], 4, '.', '') : ""; ?></TD>
                                            <TD class="bom" ALIGN=CENTER><?php echo ($arr_prtcl[6] != 0) ? number_format($arr_prtcl[6], 4, '.', '') : ""; ?></TD>
                                            <TD class="bom" ALIGN=CENTER><?php echo ($arr_prtcl[9] != 0) ? number_format($arr_prtcl[9], 4, '.', '') : ""; ?></TD>
                                            <TD class="bom" ALIGN=CENTER><?php echo ($arr_prtcl[12] != 0) ? number_format($arr_prtcl[12], 4, '.', '') : ""; ?></TD>
                                            <TD class="bom" ALIGN=CENTER><?php echo ($arr_prtcl[15] != 0) ? number_format($arr_prtcl[15], 4, '.', '') : ""; ?></TD>
                                            <TD class="bom" ALIGN=CENTER><?php echo ($arr_prtcl[18] != 0) ? number_format($arr_prtcl[18], 4, '.', '') : ""; ?></TD>
                                            <TD class="bom" ALIGN=CENTER><?php echo ($arr_prtcl[24] != 0) ? number_format($arr_prtcl[24], 4, '.', '') : ""; ?></TD>
                                        </tr>
                                        <tr>
                                            <TD class="bom" ALIGN=LEFT>PRTCL</TD>
                                            <TD class="bom" ALIGN=CENTER></TD>
                                            <TD class="bom" ALIGN=CENTER></TD>
                                            <TD class="bom" ALIGN=CENTER></TD>
                                            <TD class="bom" ALIGN=CENTER></TD>
                                            <TD class="bom" ALIGN=CENTER></TD>
                                            <TD class="bom" ALIGN=CENTER></TD>
                                            <TD class="bom" ALIGN=CENTER></TD>
                                        </tr>
                                    </table>
                                </TD>                
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>

    </center>
    <!-- ************************************************************************** -->
</BODY>

</HTML>
