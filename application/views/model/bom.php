<STYLE>
    BODY,DIV,TABLE,THEAD,TBODY,TFOOT,TR,TH,P { font-family:"Arial"; font-size:x-small }
    table.bom
    {
        border-collapse:collapse;
    }
    table.bom, td.bom
    {
        border: 1px #009999 solid;
        color: #000;
    }
    .nostyle{
        border: none;
        width: 100%;
        text-align: center;
        font-weight: normal;
        background: #ffffff;
        font-size: 12px;
    }
    .nostyle2{
        margin: 1px;
        width: 90%;
        text-align: center;
        font-weight: bold;
        background: #ffffff;
    }

</STYLE>
<div style="display: inline-block;margin-bottom: 2px">
    <a href="javascript:void(0)" onclick="model_bomrefresh(<?php echo $modelid ?>)"><img src="images/refresh.png"/>&nbsp;Refresh&nbsp;&nbsp;</a>
    <?php
    if ($this->session->userdata('department') == 4) {
        if (in_array('add_component_to_cutting_list', $accessmenu)) {
            echo "<a href='javascript:void(0)' onclick = 'model_bomadditem($modelid)'><img src = 'images/bomadd.png' class = 'miniaction'/>&nbsp;Add&nbsp;&nbsp;</a>";
        }if (in_array('edit_component_cutting_list', $accessmenu)) {
            echo "<a href='javascript:void(0)' onclick = 'model_bomedititem($modelid)'><img src = 'images/bomedit.png'/>&nbsp;Edit&nbsp;&nbsp;</a>";
        }if (in_array('delete_component_from_cutting_list', $accessmenu)) {
            echo "<a href='javascript:void(0)' onclick = 'model_bomdeleteitem($modelid)'><img src = 'images/bomdelete.png' class = 'miniaction'/>&nbsp;Delete&nbsp;&nbsp;</a>";
        }if (in_array('print_cutting_list', $accessmenu)) {
            echo "<a href='javascript:void(0)' onclick = 'model_printcuttinglist($modelid)'><img src = 'images/print-quo.png'/>&nbsp;Print&nbsp;&nbsp;</a>";
            echo "<input type = 'checkbox' id = 'printyield'/> Check to print Yield";
        }
    }
    ?>
</div>
<br/>
<input type="hidden" id="bomitemid" value="0" />
<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_model_bom_qzx').scrollableFixedHeaderTable('102%', '330', null, null, 3, 'tbl_model_bom_qzx');
    });
</script>
<TABLE CELLSPACING=0 COLS=0 BORDER=0 width="100%" class="tablesorter2 scrollableFixedHeaderTable" id="tbl_model_bom_qzx">        
    <THEAD>
        <TR>
            <TH class="bom" ROWSPAN=3 ALIGN=CENTER></TH>
            <TH class="bom" ROWSPAN=3 ALIGN=CENTER><B>NO</B></TH>
            <TH class="bom" ROWSPAN=3 ALIGN=CENTER><B>QTY.</B></TH>
            <TH class="bom" ROWSPAN=3 ALIGN=CENTER><B>COMPONENT</B></TH>
            <TH class="bom" COLSPAN=5 ALIGN=CENTER VALIGN=MIDDLE><B>MATERIAL</B></TH>
            <TH class="bom" COLSPAN=4 ROWSPAN=2 ALIGN=CENTER><B>PROCESS</B></TH>
            <TH class="bom" COLSPAN=3 ROWSPAN=2 ALIGN=CENTER><B>FINAL SIZE</B></TH>
            <TH class="bom" COLSPAN=3 ROWSPAN=2 ALIGN=CENTER><B>ROUGH SIZE</B></TH>
            <TH class="bom" COLSPAN=7 ALIGN=CENTER><B>volume (m3)</B></TH>
            <TH class="bom" COLSPAN=8 ALIGN=CENTER><B>SQ.m</B></TH>
        </TR>
        <TR>
            <TH class="bom" ROWSPAN=2 ALIGN=CENTER><B>WOOD</B></TH>
            <TH class="bom" COLSPAN=4 ALIGN=CENTER VALIGN=MIDDLE><B>VENEER</B></TH>
            <TH class="bom" ALIGN=CENTER><B>MH/MD/</B></TH>
            <TH class="bom" ALIGN=CENTER><B>25</B></TH>
            <TH class="bom" ALIGN=CENTER><B>30</B></TH>
            <TH class="bom" ALIGN=CENTER><B>40</B></TH>
            <TH class="bom" ALIGN=CENTER><B>50</B></TH>
            <TH class="bom" ALIGN=CENTER><B>60</B></TH>
            <TH class="bom" ROWSPAN=2 ALIGN=CENTER><B>AG</B></TH>
            <TH class="bom" COLSPAN=2 ALIGN=CENTER><B>PLWD</B></TH>
            <TH class="bom" COLSPAN=2 ALIGN=CENTER><B>PRTCLE</B></TH>
            <TH class="bom" COLSPAN=2 ALIGN=CENTER><B>MDF</B></TH>
            <TH class="bom" COLSPAN=2 ALIGN=CENTER><B>VENR</B></TH>
        </TR>
        <TR>
            <TH class="bom" ALIGN=CENTER VALIGN=MIDDLE><B>TYPE</B></TH>
            <TH class="bom" ALIGN=CENTER VALIGN=MIDDLE><B>S1S</B></TH>
            <TH class="bom" ALIGN=CENTER VALIGN=MIDDLE><B>DGB</B></TH>
            <TH class="bom" ALIGN=CENTER VALIGN=MIDDLE><B>S2S</B></TH>
            <TH class="bom" ALIGN=CENTER><B>Turn</B></TH>
            <TH class="bom" ALIGN=CENTER><B>Lam</B></TH>
            <TH class="bom" ALIGN=CENTER><B>Carv</B></TH>
            <TH class="bom" ALIGN=CENTER><B>Mall</B></TH>
            <TH class="bom" ALIGN=CENTER><B>T</B></TH>
            <TH class="bom" ALIGN=CENTER><B>W</B></TH>
            <TH class="bom" ALIGN=CENTER><B>L</B></TH>
            <TH class="bom" ALIGN=CENTER><B>T</B></TH>
            <TH class="bom" ALIGN=CENTER><B>W</B></TH>
            <TH class="bom" ALIGN=CENTER><B>L</B></TH>
            <TH class="bom" ALIGN=CENTER><B>EURO/OAK</B></TH>
            <TH class="bom" ALIGN=CENTER><B>25</B></TH>
            <TH class="bom" ALIGN=CENTER><B>32</B></TH>
            <TH class="bom" ALIGN=CENTER><B>38</B></TH>
            <TH class="bom" ALIGN=CENTER><B>50</B></TH>
            <TH class="bom" ALIGN=CENTER><B>60</B></TH>
            <TH class="bom" ALIGN=CENTER><B>THICK</B></TH>
            <TH class="bom" ALIGN=CENTER><B>(M2)</B></TH>
            <TH class="bom" ALIGN=CENTER><B>THICK</B></TH>
            <TH class="bom" ALIGN=CENTER><B>(M2)</B></TH>
            <TH class="bom" ALIGN=CENTER><B>THICK</B></TH>
            <TH class="bom" ALIGN=CENTER><B> (M3)</B></TH>
            <TH class="bom" ALIGN=CENTER><B>A</B></TH>
            <TH class="bom" ALIGN=CENTER><B>DGB</B></TH>
        </TR>
    </thead>
</tbody>
<?php
//print_r($bom);
$arr_total_volume = array();
$arr_mdf = array(3 => 0, 6 => 0, 9 => 0, 12 => 0, 15 => 0, 18 => 0, 22 => 0, 24 => 0, 30 => 0);
$arr_prtcl = array(3 => 0, 6 => 0, 9 => 0, 12 => 0, 15 => 0, 18 => 0, 22 => 0, 24 => 0, 30 => 0);
$arr_plwed = array(3 => 0, 6 => 0, 9 => 0, 12 => 0, 15 => 0, 18 => 0, 22 => 0, 24 => 0, 30 => 0);
$arr_item = array();
$arr_venitemid = array();
$arr_venname = array();

foreach ($allitem as $rst) {
    $arr_item[$rst->id] = 0;
}

foreach ($venneritemid as $rst) {
    $arr_venitemid[$rst->itemid] = 0;
    $arr_venname[$rst->itemid] = $rst->itemname;
}

foreach ($wood as $rst) {
    $arr_total_volume[$rst->id] = array(25 => 0, 30 => 0, 40 => 0, 50 => 0, 60 => 0, 70 => 0, "ag" => 0);
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
            if (strpos($bom->mhmd, '=')) {
                list($suf, $div) = explode("=", $bom->mhmd);
                $suf = (int) $suf;
                $div = (int) $div;
                $suffix = ($suf == 0 ? 1 : $suf);
                $divide = ($div == 0 ? 1 : $div);
            }
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
    if ($bom->ven_itemid != 0) {
        $arr_venitemid[$bom->ven_itemid] = $arr_venitemid[$bom->ven_itemid] + (($bom->qty * $bom->rw * $bom->rl) / 1000000);
    }
    if ($no % 2 == 0)
        echo "<tr bgcolor=#CCCCCC>";
    else
        echo "<tr>";
    ?>
    <TD width="50" class="bom" ALIGN="CENTER"><input type="checkbox" name="bomitem[]" id="bomitemid<?php echo $bom->id ?>" onclick="model_bomitemchoose(<?php echo $bom->id ?>)"/></TD>
    <TD width="50" class="bom" ALIGN=CENTER><?php echo $no++ ?></TD>
    <TD width="50" class="bom" ALIGN=CENTER><?php echo $bom->qty; ?></TD>
    <TD width="100" class="bom" ALIGN=LEFT><?php echo $bom->description ?></TD>
    <TD width="150" class="bom"><?php echo $bom->woodname ?></TD>
    <TD width="50" class="bom"><?php echo $bom->ven_type ?></TD>
    <TD width="50" class="bom" ALIGN=CENTER><?php echo $bom->ven_s1s ?></TD>
    <TD width="50" class="bom" ALIGN=CENTER><?php echo $bom->ven_dgb ?></TD>
    <TD width="50" class="bom" ALIGN=CENTER><?php echo $bom->ven_s2s ?></TD>
    <TD width="50" class="bom" ALIGN=CENTER><?php echo $bom->turn ?></TD>
    <TD width="50" class="bom" ALIGN=CENTER><?php echo $bom->lam ?></TD>
    <TD width="50" class="bom" ALIGN=CENTER><?php echo $bom->carv ?></TD>
    <TD width="50" class="bom" ALIGN=CENTER><?php echo $bom->mall ?></TD>
    <TD width="50" class="bom" ALIGN=CENTER><?php echo $bom->ft ?></TD>
    <TD width="50" class="bom" ALIGN=CENTER><?php echo $bom->fw ?></TD>
    <TD width="50" class="bom" ALIGN=CENTER><?php echo $bom->fl ?></TD>
    <TD width="50" class="bom" ALIGN=CENTER><?php echo $bom->rt ?></TD>
    <TD width="50" class="bom" ALIGN=CENTER><?php echo $bom->rw ?></TD>
    <TD width="50" class="bom" ALIGN=CENTER><?php echo $bom->rl ?></TD>
    <TD width="50" class="bom" ALIGN=CENTER><?php echo $bom->mhmd ?></TD>
    <TD width="50" class="bom" ALIGN=CENTER>
        <?php
        //echo $bom->groupsid;
        if ($bom->woodid != 58 && $bom->groupsid == 3 && $v25 != 0) {
            echo number_format($v25, 4, '.', '');
            $arr_total_volume[$bom->woodid][25] = $arr_total_volume[$bom->woodid][25] + $v25;
            $arr_item[$bom->woodid] += $v25;
        }
        ?>
        &nbsp;
    </TD>
    <TD width="50" class="bom" ALIGN=CENTER>
        <?php
        if ($bom->woodid != 58 && $bom->groupsid == 3 && $v30 != 0) {
            echo number_format($v30, 4, '.', '');
            $arr_total_volume[$bom->woodid][30] = $arr_total_volume[$bom->woodid][30] + $v30;
            $arr_item[$bom->woodid] += $v30;
        }
        ?>&nbsp;
    </TD>
    <TD width="50" class="bom" ALIGN=CENTER>
        <?php
        if ($bom->woodid != 58 && $bom->groupsid == 3 && $v40 != 0) {
            echo number_format($v40, 4, '.', '');
            $arr_total_volume[$bom->woodid][40] = $arr_total_volume[$bom->woodid][40] + $v40;
            $arr_item[$bom->woodid] += $v40;
        }
        ?>&nbsp;
    </TD>
    <TD width="50" class="bom" ALIGN=CENTER>                    
        <?php
        if ($bom->woodid != 58 && $bom->groupsid == 3 && $v50 != 0) {
            echo number_format($v50, 4, '.', '');
            $arr_total_volume[$bom->woodid][50] = $arr_total_volume[$bom->woodid][50] + $v50;
            $arr_item[$bom->woodid] += $v50;
        }
        ?>&nbsp;
    </TD>
    <TD width="50" class="bom" ALIGN=CENTER>
        <?php
        if ($bom->woodid != 58 && $bom->groupsid == 3 && $v60 != 0) {
            echo number_format($v60, 4, '.', '');
            $arr_total_volume[$bom->woodid][60] = $arr_total_volume[$bom->woodid][60] + $v60;
            $arr_item[$bom->woodid] += $v60;
        }
        ?>&nbsp;
    </TD>
    <TD width="50" class="bom" ALIGN=CENTER>
        <?php
        if ($bom->woodid == 58 && $bom->groupsid == 3) {
            $volume = ((($bom->qty * $bom->rt * $bom->rw * $bom->rl) / 1000000000) * $suffix) / $divide;
            echo number_format($volume, 4, '.', '');
            $arr_total_volume[$bom->woodid]["ag"] = $arr_total_volume[$bom->woodid]["ag"] + $volume;
            $arr_item[$bom->woodid] += $volume;
        }
        ?>&nbsp;
    </TD>
    <TD width="50" class="bom" ALIGN=CENTER>
        <?php
        $plwdm2 = "";
        if ($bom->groupsid == 4) {
            $plwdm2 = ($bom->qty * $bom->rw * $bom->rl) / 1000000;
            echo $bom->rt;
            $arr_plwed[$bom->rt] += $plwdm2;
            $arr_item[$bom->woodid] += $plwdm2;
        }
        ?>&nbsp;
    </TD>
    <TD width="50" class="bom" ALIGN=CENTER><?php echo ($plwdm2 != "") ? number_format($plwdm2, 4, '.', '') : ""; ?></TD>
    <TD width="50" class="bom" ALIGN=CENTER>
        <?php
        $prtcl = "";
        if ($bom->groupsid == 5) {
            $prtcl = ($bom->qty * $bom->rw * $bom->rl) / 1000000;
            echo $bom->rt;
            $arr_plwed[$bom->rt] += $prtcl;
            $arr_item[$bom->woodid] = $prtcl;
        }
        ?>&nbsp;
    </TD>
    <TD width="50" class="bom" ALIGN=CENTER><?php echo ($prtcl != "") ? number_format($prtcl, 4, '.', '') : ""; ?></TD>
    <TD width="50" class="bom" ALIGN=CENTER>
        <?php
        $mdf = "";
        if ($bom->groupsid == 6 || $bom->ven_itemid != 0) {
            $mdf = ($bom->qty * $bom->rw * $bom->rl) / 1000000;
            if (strtolower($bom->ven_s2s) == 'x') {
//                $mdf = $mdf * 2;
            }
            if ($bom->groupsid == 6) {
                $arr_mdf[$bom->rt] += $mdf;
                echo $bom->rt;
                $arr_item[$bom->woodid] = $mdf;
            }
        }
        ?>&nbsp;
    </TD>
    <TD width="50" class="bom" ALIGN=CENTER>
        <?php echo ($mdf != "" && $bom->groupsid == 6) ? number_format($mdf, 4, '.', '') : ""; ?>&nbsp;
    </TD>
    <TD width="50" class="bom" ALIGN=CENTER>
        <?php
        if ($bom->sq_ven_a == 't') {
            if ($bom->sq_ven_dgb != 't') {
                if ($bom->groupsid == 6) {
                    echo number_format($mdf * 2, 4, '.', '');
                } else {
                    echo number_format($mdf, 4, '.', '');
                }
            } else {
                echo number_format($mdf, 4, '.', '');
            }
        }
        ?>&nbsp;
    </TD>
    <TD width="50" class="bom" ALIGN=CENTER>
        <?php
        if ($bom->sq_ven_dgb == 't') {
            if ($bom->sq_ven_a != 't') {
                if ($bom->groupsid == 6) {
                    echo number_format($mdf * 2, 4, '.', '');
                } else {
                    echo number_format($mdf, 4, '.', '');
                }
            } else {
                echo number_format($mdf, 4, '.', '');
            }
            //echo number_format((($bom->qty * $bom->rw * $bom->rl) / 1000000), 4, '.', '');
        }
        ?>&nbsp;
    </TD>                
    </TR>
    <?php
    $totalqty = $totalqty + $bom->qty;
}
?>
<TR>
    <TD class="bom" ALIGN=CENTER colspan="34">&nbsp;</TD>
</TR>

<TR>
    <TD class="bom" ALIGN=CENTER></TD>
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
</tbody>
</TABLE>
<div style="float: right;;width: 90%">
    <table width="100%" border="0">
        <tr valign="top">
            <TD width="40%" ALIGN=CENTER>
                <strong>BREAKDOWN (SOLID WOOD)</strong>
                <br/>
                <table width="100%" class="bom">
                    <tr>
                        <TD class="bom" ALIGN=CENTER width='200'>&nbsp;</TD>
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
                    $total_ag = 0;

                    foreach ($wood as $rst) {
                        ?>
                        <tr>
                            <TD class="bom"><B><?php echo $rst->woodname ?></B></TD>
                            <TD class="bom" ALIGN=CENTER>                                
                                <?php
                                if ($arr_total_volume[$rst->id][25] != 0) {
                                    $vt_25 = number_format($arr_total_volume[$rst->id][25], 4, '.', '');
                                    echo $vt_25;
                                    $total_25 += $vt_25;
                                }
                                ?>                                
                            </TD>
                            <TD class="bom" ALIGN=CENTER>                                
                                <?php
                                if ($arr_total_volume[$rst->id][30] != 0) {
                                    $vt_30 = number_format($arr_total_volume[$rst->id][30], 4, '.', '');
                                    echo $vt_30;
                                    $total_30 += $vt_30;
                                }
                                ?>                                
                            </TD>
                            <TD class="bom" ALIGN=CENTER>                                
                                <?php
                                if ($arr_total_volume[$rst->id][40] != 0) {
                                    $vt_40 = number_format($arr_total_volume[$rst->id][40], 4, '.', '');
                                    echo $vt_40;
                                    $total_40 += $vt_40;
                                }
                                ?>                                
                            </TD>
                            <TD class="bom" ALIGN=CENTER>                                
                                <?php
                                if ($arr_total_volume[$rst->id][50] != 0) {
                                    $vt_50 = number_format($arr_total_volume[$rst->id][50], 4, '.', '');
                                    echo $vt_50;
                                    $total_50 += $vt_50;
                                }
                                ?>                                
                            </TD>
                            <TD class="bom" ALIGN=CENTER>                                
                                <?php
                                if ($arr_total_volume[$rst->id][60] != 0) {
                                    $vt_60 = number_format($arr_total_volume[$rst->id][60], 4, '.', '');
                                    echo $vt_60;
                                    $total_60 += $vt_60;
                                }
                                ?>                                
                            </TD>
                            <TD class="bom" ALIGN=CENTER>                                
                                <?php
                                if ($arr_total_volume[$rst->id]["ag"] != 0) {
                                    $vt_ag = number_format($arr_total_volume[$rst->id]["ag"], 4, '.', '');
                                    echo $vt_ag;
                                    $total_ag += $vt_ag;
                                }
                                ?>                                
                            </TD>
                        </tr>
                        <?php
                    }
                    $this->model_model->deleteAllMaterial($modelid);
                    foreach ($arr_item as $key => $value) {
                        $this->model_model->insertMaterial($modelid, $key, number_format($value, 4, '.', ''));
                    }
                    foreach ($arr_venitemid as $key => $value) {
                        $this->model_model->insertMaterial($modelid, $key, number_format($value, 4, '.', ''));
                    }
                    ?>                    
                    <tr>
                        <TD class="bom"><B>TOTAL</B></TD>
                        <TD class="bom" ALIGN=CENTER colspan="6">
                            <?php
                            $alltotal = $total_25 + $total_30 + $total_40 + $total_50 + $total_60 + $total_ag;
                            echo $alltotal;
                            ?>
                        </TD>                        
                    </tr>
                </table>
            </TD>
            <td align="center" width="20%">
                <b>BREAKDOWN (VENEER)</b>
                <table width="100%" class="bom">
                    <tr>
                        <td class="bom" width='50%' align="center"><b>TYPE</b></td>
                        <td class="bom" width='50%'  align="center"><b>M2</b></td>
                    </tr>
                    <?php
                    $total_veneer_breakdown = 0;
                    foreach ($arr_venitemid as $key => $value) {
                        $total_veneer_breakdown += $value;
                        ?>
                        <tr>
                            <td class="bom"><?php echo $arr_venname[$key]; ?></td>
                            <td class="bom" align="center"><?php echo number_format($value, 4, '.', ''); ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td class="bom" align="center"><b>Total</b></td>
                        <td class="bom" align="center"><?php echo number_format($total_veneer_breakdown, 4, '.', ''); ?></td>
                    </tr>
                </table>
            </td>
            <TD width="40%" ALIGN=CENTER>
                <b>BREAKDOWN (BOARD)</b>
                <table width="100%" class="bom">
                    <tr>
                        <TD class="bom" ALIGN=CENTER><B>MTRL</B></TD>
                        <TD class="bom" ALIGN=CENTER width='10%'><B>3</B></TD>
                        <TD class="bom" ALIGN=CENTER width='10%'><B>6</B></TD>
                        <TD class="bom" ALIGN=CENTER width='10%'><B>9</B></TD>
                        <TD class="bom" ALIGN=CENTER width='10%'><B>12</B></TD>
                        <TD class="bom" ALIGN=CENTER width='10%'><B>15</B></TD>
                        <TD class="bom" ALIGN=CENTER width='10%'><B>18</B></TD>                        
                        <TD class="bom" ALIGN=CENTER width='10%'><B>22</B></TD>                        
                        <TD class="bom" ALIGN=CENTER width='10%'><B>24</B></TD>                                              
                        <TD class="bom" ALIGN=CENTER width='10%'><B>30</B></TD>
                    </tr>
                    <tr>
                        <TD class="bom" ALIGN=LEFT>MDF</TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_mdf[3] != 0) ? number_format($arr_mdf[3], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_mdf[6] != 0) ? number_format($arr_mdf[6], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_mdf[9] != 0) ? number_format($arr_mdf[9], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_mdf[12] != 0) ? number_format($arr_mdf[12], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_mdf[15] != 0) ? number_format($arr_mdf[15], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_mdf[18] != 0) ? number_format($arr_mdf[18], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_mdf[24] != 0) ? number_format($arr_mdf[22], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_mdf[24] != 0) ? number_format($arr_mdf[24], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_mdf[30] != 0) ? number_format($arr_mdf[30], 4, '.', '') : ""; ?></TD>
                    </tr>
                    <tr>
                        <TD class="bom" ALIGN=LEFT>PRTCL</TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_prtcl[3] != 0) ? number_format($arr_prtcl[3], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_prtcl[6] != 0) ? number_format($arr_prtcl[6], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_prtcl[9] != 0) ? number_format($arr_prtcl[9], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_prtcl[12] != 0) ? number_format($arr_prtcl[12], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_prtcl[15] != 0) ? number_format($arr_prtcl[15], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_prtcl[18] != 0) ? number_format($arr_prtcl[18], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_prtcl[24] != 0) ? number_format($arr_prtcl[22], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_prtcl[24] != 0) ? number_format($arr_prtcl[24], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_prtcl[30] != 0) ? number_format($arr_prtcl[30], 4, '.', '') : ""; ?></TD>
                    </tr>
                    <tr>
                        <TD class="bom" ALIGN=LEFT>PLWD</TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_plwed[3] != 0) ? number_format($arr_plwed[3], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_plwed[6] != 0) ? number_format($arr_plwed[6], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_plwed[9] != 0) ? number_format($arr_plwed[9], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_plwed[12] != 0) ? number_format($arr_plwed[12], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_plwed[15] != 0) ? number_format($arr_plwed[15], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_plwed[18] != 0) ? number_format($arr_plwed[18], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_plwed[24] != 0) ? number_format($arr_plwed[22], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_plwed[24] != 0) ? number_format($arr_plwed[24], 4, '.', '') : ""; ?></TD>
                        <TD class="bom" ALIGN=CENTER><?php echo ($arr_plwed[30] != 0) ? number_format($arr_plwed[30], 4, '.', '') : ""; ?></TD>
                    </tr>
                </table>
            </TD>                
        </tr>
    </table>
</div>

