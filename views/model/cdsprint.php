<!DOCTYPE html PUBLIC "-//W3C//Dtd html 3.2//EN">

<html>
    <head>
        <META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=windows-1252">
        <title></title>
        <style>
            <!-- 
            body,DIV,table,Thead,tbody,TFOOT,tr,TH,td,P { font-family:"Arial"; font-size:11PX; }
            -->
        </style>

    </head>
    <body>
    <center>
        <table cellspacing=0 cols=10 border=0>
            <colgroup>
                <col width=160>
                <col width=76>
                <col width=102>
                <col width=102>
                <col width=120>
                <col width=50>
                <col width=80>
                <col width=250>
            </colgroup>
            <tbody>
                <tr>
                    <td colspan=10 ><B><FONT FACE="Calibri" SIZE=3 color="#000000">PT. EBAKO NUSANTARA</B></td>
                </tr>
                <tr>
                    <td colspan="10" height=18 ><I>R&D Department</I></td>
                </tr>
                <tr>
                    <td colspan=10 height=32 align=center bgcolor="#D9D9D9" ><B><FONT FACE="Franklin Gothic Medium Cond" SIZE=5 color="#000000">COMPREHENSIVE DATA SPECIFICATION SHEET (CDSS)</B></td>
                </tr>
                <tr>
                    <td colspan=10 height=18 >&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"><B>MODEL #</B></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" colspan=5 ><B>&nbsp;<?php echo $model->no; ?></B></td>
                    <td style="border-right: 1px solid #000000" rowspan=17 align=center >&nbsp;</td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" colspan=3 rowspan=17 align=center valign=middle ><img src="<?php echo base_url() . 'files/' . $model->filename ?>" style="max-width: 350px;max-heigth:350px;" /></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"><B>CUSTOMER CODE #</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=5 ><B>&nbsp;<?php echo $model->custcode; ?></B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"><B>DESCRIPTION</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=5 ><B>&nbsp;<?php echo $model->description; ?></B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"><B>CUSTOMER</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;" colspan=5 align=center ><B>&nbsp;</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" rowspan=2 align=left valign=middle ><B>OA SIZE</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;" colspan="2" rowspan=2 align=center ><B>&nbsp;</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align=center valign=middle ><I>width (mm)</I></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;" align=center valign=middle ><I>Depth (mm)</I></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><I>height (mm)</I></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000;border-right: 1px solid #000000" align=center><B>&nbsp;<?php echo $model->dw; ?></B></td>
                    <td style="border-bottom: 1px solid #000000;border-right: 1px solid #000000" align=center><B>&nbsp;<?php echo $model->dd; ?></B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><B>&nbsp;<?php echo $model->dht; ?></B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align=left valign=middle ><B>CARTON BOX</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="2" align=center><B>&nbsp;</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><B>&nbsp;<?php echo $model->cw; ?></B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><B>&nbsp;<?php echo $model->cd; ?></B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><B>&nbsp;<?php echo $model->ch; ?></B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align=left valign=middle ><B>GW</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;" colspan=5 align=left ><B>&nbsp;<?php echo @$model->gw; ?></B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align=left valign=middle ><B>NW</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;" colspan=5 align=left ><B>&nbsp;<?php echo @$model->nw; ?></B></td>
                </tr>
                <tr>
                    <td colspan="6" height=18 align=left valign=middle ><B>&nbsp;</B></td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=6 align=center valign=middle bgcolor="#D9D9D9" ><B>Material Overview</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align=left valign=middle ><B>Solid</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align=center valign=middle ><B>
                            &nbsp;
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>expose</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;padding:3px;" colspan=3 align=left valign=TOP width="200">
                        <?php
                        $strarray = str_replace(array("{", "}"), "", $model->expose);
                        $arrexpose = explode(',', $strarray);
                        $counter = 0;
                        foreach ($expose as $result) {
                            if (in_array($result->id, $arrexpose)) {
                                echo "<span style='border:1px #000 solid;width:12px;height:10px;'>&nbsp;&nbsp;V&nbsp;&nbsp;</span>&nbsp;" . $result->description . "&nbsp;&nbsp;";
                            } else {
                                echo "<span style='border:1px #000 solid;width:12px;height:10px;'>&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;" . $result->description . "&nbsp;&nbsp;";
                            }
                            $counter++;
                            if ($counter == 3) {
                                echo "<br/><br/>";
                                $counter = 0;
                            }
                        }
                        ?>
                    </td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;padding:3px;" valign="top" colspan="2">
                        <b>Others</b><br/>
                        <?php
                        if (!empty($expose_other)) {
                            echo "<table width='100%' cellpadding=0 cellsapcing=0>";
                            foreach ($expose_other as $result) {
                                echo "<tr>";
                                echo "<td width='100%'>- " . $result->description . "</td>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>internal</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;padding:3px;" colspan=3 valign=middle >
                        <?php
                        $strarray = str_replace(array("{", "}"), "", $model->internal);
                        $arrinternal = explode(',', $strarray);
                        $counter = 0;
                        foreach ($internal as $result) {
                            if (in_array($result->id, $arrinternal)) {
                                echo "<span style='border:1px #000 solid;width:12px;height:10px;'>&nbsp;&nbsp;V&nbsp;&nbsp;</span>&nbsp;" . $result->description . "&nbsp;&nbsp;";
                            } else {
                                echo "<span style='border:1px #000 solid;width:12px;height:10px;'>&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;" . $result->description . "&nbsp;&nbsp;";
                            }
                            $counter++;
                            if ($counter == 3) {
                                echo "<br/><br/>";
                                $counter = 0;
                            }
                        }
                        ?>
                    </td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;padding:3px;" valign="top" colspan="2">
                        <b>Others</b><br/>
                        <?php
                        if (!empty($internal_other)) {
                            echo "<table width='100%' cellpadding=0 cellsapcing=0>";
                            foreach ($internal_other as $result) {
                                echo "<tr>";
                                echo "<td width='100%'>- " . $result->description . "</td>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align=left valign=middle ><B>Panel</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;padding:3px;" colspan=3 valign=middle >
                        <?php
                        $strarray = str_replace(array("{", "}"), "", $model->panel);
                        $arrpanel = explode(',', $strarray);
                        $counter = 0;
                        foreach ($panel as $result) {
                            if (in_array($result->id, $arrpanel)) {
                                echo "<span style='border:1px #000 solid;width:12px;height:10px;'>&nbsp;&nbsp;V&nbsp;&nbsp;</span>&nbsp;" . $result->description . "&nbsp;&nbsp;";
                            } else {
                                echo "<span style='border:1px #000 solid;width:12px;height:10px;'>&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;" . $result->description . "&nbsp;&nbsp;";
                            }
                            $counter++;
                            if ($counter == 3) {
                                echo "<br/><br/>";
                                $counter = 0;
                            }
                        }
                        ?>
                    </td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;padding:3px;" valign="top" colspan="2">
                        <b>Others</b><br/>
                        <?php
                        if (!empty($panel_other)) {
                            echo "<table width='100%' cellpadding=0 cellsapcing=0>";
                            foreach ($panel_other as $result) {
                                echo "<tr>";
                                echo "<td width='100%'>- " . $result->description . "</td>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" valign=middle ><B>Veneer</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;padding:2px;" colspan=3 align=left valign=TOP>
                        <?php
                        $strarray = str_replace(array("{", "}"), "", $model->veneer);
                        $arrveneer = explode(',', $strarray);
                        $counter = 0;
                        foreach ($material_veneer as $result) {
                            if (in_array($result->id, $arrveneer)) {
                                echo "<span style='border:1px #000 solid;width:12px;height:10px;'>&nbsp;&nbsp;V&nbsp;&nbsp;</span>&nbsp;" . $result->description . "&nbsp;&nbsp;";
                            } else {
                                echo "<span style='border:1px #000 solid;width:12px;height:10px;'>&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;" . $result->description . "&nbsp;&nbsp;";
                            }
                            $counter++;
                            if ($counter == 3) {
                                echo "<br/><br/>";
                                $counter = 0;
                            }
                        }
                        ?>
                    </td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;padding:2px;" valign="top" colspan="2">
                        <b>Others</b><br/>
                        <?php
                        if (!empty($panel_other)) {
                            echo "<table width='100%' cellpadding=0 cellsapcing=0>";
                            foreach ($panel_other as $result) {
                                echo "<tr>";
                                echo "<td width='100%'>- " . $result->description . "</td>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align=left valign=middle ><B>Others</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;padding:3px;" colspan=3>
                        <?php
                        $strarray = str_replace(array("{", "}"), "", $model->others);
                        $arrothers = explode(',', $strarray);
                        $counter = 0;
                        foreach ($others as $result) {
                            if (in_array($result->id, $arrothers)) {
                                echo "<span style='border:1px #000 solid;width:12px;height:10px;'>&nbsp;&nbsp;V&nbsp;&nbsp;</span>&nbsp;" . $result->description . "&nbsp;&nbsp;";
                            } else {
                                echo "<span style='border:1px #000 solid;width:12px;height:10px;'>&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;" . $result->description . "&nbsp;&nbsp;";
                            }
                            $counter++;
                            if ($counter == 3) {
                                echo "<br/><br/>";
                                $counter = 0;
                            }
                        }
                        ?>
                    </td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;padding:3px;" valign="top" colspan="2">
                        <b>Others</b><br/>
                        <?php
                        if (!empty($others_other)) {
                            echo "<table width='100%' cellpadding=0 cellsapcing=0>";
                            foreach ($others_other as $result) {
                                echo "<tr>";
                                echo "<td width='100%'>- " . $result->description . "</td>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan=10 height=5 align=center >&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=6 align=center valign=middle bgcolor="#D9D9D9" ><B>Finish Overview</B></td>
                    <td rowspan=1 align=center valign=middle ></td>
                    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align=center bgcolor="#D9D9D9" ><B>Construction Overview</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; padding: 5px;border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=6 height=18 align=center >
                        <?php
                        $strarray = str_replace(array("{", "}"), "", $model->finishoverview);
                        $arrfinishoverview = explode(',', $strarray);
                        foreach ($finishoverview as $result) {
                            $check_1 = '';
                            if (in_array($result->id, $arrfinishoverview)) {
                                $check_1 = 'V';
                            }
                            echo "<span style='border:1px #000 solid;width:12px;height:10px;'>&nbsp;&nbsp;$check_1&nbsp;&nbsp;</span>";
                            echo "&nbsp;&nbsp;&nbsp;" . $result->name . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        }
                        ?>

                    </td>
                    <td rowspan=1 align=center valign=middle ></td>
                    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000; padding:5px;  padding-bottom: 5px;border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align=center >
                        <?php
                        $strarray = str_replace(array("{", "}"), "", $model->constructionoverview);
                        $arrconstructionoverview = explode(',', $strarray);
                        foreach ($constructionoverview as $result) {
                            $check_2 = '';
                            if (in_array($result->id, $arrconstructionoverview)) {
                                $check_2 = 'V';
                            }
                            echo "<span style='border:1px #000 solid;width:12px;height:10px;'>&nbsp;&nbsp;$check_2&nbsp;&nbsp;</span>";
                            echo "&nbsp;&nbsp;" . $result->name . "&nbsp;&nbsp;&nbsp;";
                        }
                        ?>
                        <br/>
                    </td>
                </tr>                            
                <tr>
                    <td style="border-bottom: 1px solid #000000;" colspan=10>&nbsp;</td>
                </tr>
                
                
                
                
                <tr>
                	<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align=center bgcolor="#D9D9D9" ><B>FINISH ON BODY / FRAME</B></td>
                	<td style="padding-left:10px; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=left colspan="8"><?php echo @$model->finish_on_body_frame ?>&nbsp;</td>
                </tr>
                <tr>
                	<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align=center bgcolor="#D9D9D9" ><B>FINISH ON METAL / HARDWARE</B></td>
                	<td style="padding-left:10px;border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=left colspan="8"><?php echo @$model->finish_on_metal_hardware ?>&nbsp;</td>
                </tr>
                	
                <tr>
                	<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 rowspan="3" align=center bgcolor="#D9D9D9" ><B>SPECIAL REQUIREMENT</B></td>
                
                    <td style="padding:5px;padding-left:10px; border-bottom: 1px solid #000000;" colspan="3" rowspan="3">
                    	<?php
	                        $strarray = str_replace(array("{", "}"), "", $model->special_requirement);
	                        $arr_special_requirement = explode(',', $strarray);
	                        $counter = 0;
	                        foreach ($special_requirement as $result) {
	                            if (in_array( $result->id, $arr_special_requirement )) {
	                                echo "<span style='border:1px #000 solid;width:12px;height:10px;'>&nbsp;&nbsp;V&nbsp;&nbsp;</span>&nbsp;" . $result->name . "&nbsp;&nbsp;";
	                            } else {
	                                echo "<span style='border:1px #000 solid;width:12px;height:10px;'>&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;" . $result->name . "&nbsp;&nbsp;";
	                            }
	                            $counter++;
	                            if ($counter == 2) {
	                                echo "<br/><br/>";
	                                $counter = 0;
	                            }
	                        }
                        ?>
                    </td>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align: center;" colspan="1" rowspan="1"><b>Others</b></td>
                    
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000;" align=center bgcolor="#D9D9D9" colspan=4><B>PACKING TYPE</B></td>
                </tr>
                
                <tr>
                    <td style="border-bottom: 1px solid #000000;vertical-align: top;border-left: 1px solid #000000;border-right: 1px solid #000000;" colspan=1 rowspan="2">
                    	<?php
	                        if (!empty($special_requirement_other)) {
	                            echo "<table width='100%' cellpadding=0 cellsapcing=0>";
	                            foreach ($special_requirement_other as $result) {
	                                echo "<tr>";
	                                echo "<td width='100%'>- " . $result->description . "</td>";
	                                echo "</td>";
	                                echo "</tr>";
	                            }
	                            echo "</table>";
	                        }
                        ?>
                    </td>
                    
                    <td style="border-bottom: 1px solid #000000; padding:5px;" colspan="2" rowspan="2">
                    	<?php
	                        $strarray = str_replace(array("{", "}"), "", $model->packing_type);
	                        $arr_packing_type = explode(',', $strarray);
	                        $counter = 0;
	                        foreach ($packing_type as $result) {
	                            if (in_array( $result->id, $arr_packing_type )) {
	                                echo "<span style='border:1px #000 solid;width:12px;height:10px;'>&nbsp;&nbsp;V&nbsp;&nbsp;</span>&nbsp;" . $result->name . "&nbsp;&nbsp;";
	                            } else {
	                                echo "<span style='border:1px #000 solid;width:12px;height:10px;'>&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;" . $result->name . "&nbsp;&nbsp;";
	                            }
	                            $counter++;
	                            if ($counter == 1) {
	                                echo "<br/><br/>";
	                                $counter = 0;
	                            }
	                        }
                        ?>
                    </td>
                    
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align: center;height: 15px;" colspan="1"><b>Others</b></td>
                </tr>
                
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;vertical-align:top;padding-left: 5px;" colspan="1" rowspan="1">
                    	<?php
	                        if (!empty($packing_type_other)) {
	                            echo "<table width='100%' cellpadding=0 cellsapcing=0>";
	                            foreach ($packing_type_other as $result) {
	                                echo "<tr>";
	                                echo "<td width='100%'>- " . $result->description . "</td>";
	                                echo "</td>";
	                                echo "</tr>";
	                            }
	                            echo "</table>";
	                        }
                        ?>
                    </td>
                </tr>
                
                
                
                <tr>
                    <td style="border-bottom: 1px solid #000000" colspan=10 height=18 align=center >&nbsp;</td>
                </tr>
                
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=10 align=center bgcolor="#D9D9D9" ><B>Decorative Hardware</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align=center ><B>Description</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><B>Code#</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><B>Qty</B></td>
                    
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><B>Unit</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align=center ><B>Location</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align=center ><B>Supplier</B></td>
                </tr>
                <?php
                foreach ($decorativehardware as $result) {
                    ?>
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"><?php echo $result->description ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo $result->partnumber ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo $result->qty ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo $result->unitcode ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align=center ><?php echo $result->location ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3><?php echo $result->supplier ?>&nbsp;</td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align=center ><B>&nbsp;</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><B>&nbsp;</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><B>&nbsp;</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><B>&nbsp;</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align=center ><B>&nbsp;</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align=center ><B>&nbsp;</B></td>
                </tr>

                <tr>
                    <td style="border-bottom: 1px solid #000000" colspan=10 height=18 align=center >&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=10 align=center bgcolor="#D9D9D9" ><B>Functional Hardware</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"  align=center ><B>Description</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><B>Code#</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><B>Qty</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><B>Unit</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align=center ><B>Location</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align=center ><B>Supplier</B></td>
                </tr>
                <?php
                foreach ($functionalhardware as $result) {
                    ?>
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo $result->description ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo $result->partnumber ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo $result->qty ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo $result->unitcode ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align=center ><?php echo $result->location ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3><?php echo $result->supplier ?>&nbsp;</td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align=center ><B>&nbsp;</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><B>&nbsp;</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><B>&nbsp;</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><B>&nbsp;</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align=center ><B>&nbsp;</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align=center ><B>&nbsp;</B></td>
                </tr>
                <tr>
                    <td colspan=8 height=18 align=center >&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000" colspan=10 height=18 align=center bgcolor="#000000" ><B><FONT FACE="Calibri" color="#FFFFFF">Material Specification</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=10 align=center bgcolor="#D9D9D9" ><B>Solid Wood</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align=center valign=middle ><B>Species</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align=center valign=middle ><B>Code#</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align=center valign=middle ><B>QTY (cbm)</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 rowspan=2 align=center valign=middle ><B>Location</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2 rowspan=2 align=center valign=middle ><B>Specifications</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>Yield (%)</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>Cutting List</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>Requirement</B></td>
                </tr>
                <?php
                foreach ($solidwood as $result) {
                    ?>
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo $result->descriptions ?></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo $result->partnumber ?></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo round($result->yield, 3) ?> %</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo round($result->cuttinglist_qty,3) ?></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo round($result->qty, 3) ?></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 >&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2 >&nbsp;</td>
                    </tr>
                    <?php
                }
                ?>                
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align=center >&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2>&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000" colspan=10 height=18 align=center >&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=10 align=center bgcolor="#D9D9D9" ><B>MDF / Plywood</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align=center valign=middle ><B>Species</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align=center valign=middle ><B>Code#</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align=center valign=middle ><B>QTY (sqm)</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 rowspan=2 align=center valign=middle ><B>Location</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2 rowspan=2 align=center valign=middle ><B>Specifications</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>Yield (%)</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>Cutting List</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>Requirement</B></td>
                </tr>
                <?php
                foreach ($mdf_plywd_prtcl as $result) {
                    ?>
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo $result->partnumber ?></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo $result->partnumber ?></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo round($result->yield, 3) ?> %</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo round($result->cuttinglist_qty, 3) ?></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo round($result->qty, 3) ?></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 >&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2 >&nbsp;</td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td style=" border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style=" border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style=" border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style=" border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style=" border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style=" border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align=center >&nbsp;</td>
                    <td style=" border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2>&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000" colspan=10 height=18 align=center >&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=10 align=center bgcolor="#D9D9D9" ><B>Veneers</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align=center valign=middle ><B>Species</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align=center valign=middle ><B>Code#</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align=center valign=middle ><B>QTY (cbm)</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 rowspan=2 align=center valign=middle ><B>Location</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2 rowspan=2 align=center valign=middle ><B>Specifications</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>Yield (%)</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>Cutting List</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>Requirement</B></td>
                </tr>
                <?php
                foreach ($veneer as $result) {
                    ?>
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo $result->descriptions ?></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo $result->partnumber ?></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo round($result->yield, 3) ?> %</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo round($result->cuttinglist_qty, 3) ?></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo round($result->qty, 3) ?></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 >&nbsp;<?php echo @$result->location ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2 >&nbsp;<?php echo @$result->specifications ?>&nbsp;</td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;" colspan=3 align=center >&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2>&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000;" colspan=10 align=center >&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=10 align=center bgcolor="#D9D9D9" ><B>Glass / Mirror</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 height=36 align=center valign=middle ><B>Type</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align=center valign=middle ><B>Code#</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align=center valign=middle ><B>Dimension (mm)</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=1 rowspan=2 align=center valign=middle ><B>QTY/Unit</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=1 rowspan=2 align=center valign=middle ><B>CBM</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=1 rowspan=2 align=center valign=middle ><B>Location</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2 rowspan=2 align=center valign=middle ><B>Specifications</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>Thickness</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>Length</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>width</B></td>
                </tr>
                <?php
                foreach ($glass as $result) {
                    ?>
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"><?php echo $result->descriptions ?></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><?php echo $result->partnumber ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><?php echo round($result->thickness, 3) ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><?php echo round($result->length, 3) ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><?php echo round($result->width, 3) ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center colspan="1"><?php echo round($result->qty,3) . " / " . $result->codes ?>&nbsp;</td>
                        
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center>
                            <?php
                            $vol = ($result->thickness * $result->length * $result->width * $result->qty) / 1000000000;
                            echo round( number_format($vol,4,'.',''), 3) ;
                            ?>
                        </td>
                        
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=left colspan="1">&nbsp;<?php echo $result->location ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=left colspan="2">&nbsp;<?php echo $result->specifications ?>&nbsp;</td>
                    </tr>
                    <?php
                }
                ?>                            
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height=18 >&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000" colspan=10 height=18 align=center >&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=10 height=18 align=center bgcolor="#D9D9D9" ><B>Marble / Stones</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 height=36 align=center valign=middle ><B>Type</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align=center valign=middle ><B>Code#</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align=center valign=middle ><B>Dimension (mm)</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align=center valign=middle ><B>QTY/Unit</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align=center valign=middle ><B>CBM</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=1 rowspan=2 align=center valign=middle ><B>Location</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2 rowspan=2 align=center valign=middle ><B>Specifications</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>Thickness</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>Length</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>width</B></td>
                </tr>
                <?php
                foreach ($marble as $result) {
                    ?>
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height=18 ><?php echo $result->type ?></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><?php echo $result->partnumber ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><?php echo round($result->thickness, 3) ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><?php echo round($result->length, 3) ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><?php echo round($result->width, 3) ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><?php echo round($result->qty, 3) . " / " . $result->codes ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center>
                            <?php
                            $vol = ($result->thickness * $result->length * $result->width * $result->qty) / 1000000000;
                            echo round( number_format($vol,4,'.',''), 3) ;
                            ?>
                            &nbsp;
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=left colspan=1><?php echo $result->location ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=left colspan=2>&nbsp;<?php echo $result->specifications ?>&nbsp;</td>
                    </tr>
                    <?php
                }
                ?>                            
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height=18 >&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000" colspan=10 height=18 align=center >&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=10 height=18 align=center bgcolor="#D9D9D9" ><B>Frame / Inlay</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 height=36 align=center valign=middle ><B>Type</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align=center valign=middle ><B>Code#</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align=center valign=middle ><B>Dimension (mm)</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align=center valign=middle ><B>QTY/Unit</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align=center valign=middle ><B>CBM</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="1" rowspan=2 align=center valign=middle ><B>Location</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="1" rowspan=2 align=center valign=middle ><B>Specifications</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>Thickness</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>Length</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>width</B></td>
                </tr>
                <?php
                foreach ($latherinlay as $result) {
                    ?>
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"><?php echo $result->descriptions ?></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo $result->partnumber ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo round($result->thickness, 3) ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo round($result->length, 3) ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo round($result->width, 3) ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center ><?php echo round($result->qty, 3) . " / " . $result->codes ?>&nbsp;</td>                        
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center >
                            <?php
                            $vol = ($result->thickness * $result->length * $result->width * $result->qty) / 1000000000;
                            echo round(number_format($vol,4,'.',''), 3);
                            ?>
                            &nbsp;
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=left colspan="1"><?php echo $result->location ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=left colspan="2">&nbsp;<?php echo $result->specifications ?>&nbsp;</td>
                    </tr>
                    <?php
                }
                ?>                            
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height=18 >&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000" colspan=10 height=18 align=center >&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=10 height=18 align=center bgcolor="#D9D9D9" ><B>Upholstery Material</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 height=36 align=center valign=middle ><B>Type</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align=center valign=middle ><B>Code#</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align=center valign=middle ><B>Dimension (mm)</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align=center valign=middle ><B>QTY/Unit</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align=center valign=middle ><B>SQM</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="1" rowspan=2 align=center valign=middle ><B>Location</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="2" rowspan=2 align=center valign=middle ><B>Specifications</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>Thickness</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>Length</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>width</B></td>
                </tr>
                <?php
                foreach ($upholstery as $result) {
                    ?>
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"><?php echo $result->description ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><?php echo $result->partnumber ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><?php echo round($result->thickness, 3) ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><?php echo round($result->length, 3) ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><?php echo round($result->width, 3) ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><?php echo round($result->qty, 3) ." / ".$result->unitcode ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><?php echo $result->location ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"><?php echo $result->specifications ?>&nbsp;</td>
                    </tr>
                    <?php
                }
                ?>                            
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height=18 >&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000" colspan=10 height=18 align=center >&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=10 height=18 align=center bgcolor="#D9D9D9" ><B>Packing Material</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 height=36 align=center valign=middle ><B>Type</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align=center valign=middle ><B>Code#</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align=center valign=middle ><B>Dimension (mm)</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align=center valign=middle ><B>QTY/Unit</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align=center valign=middle ><B>CBM</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="1" rowspan=2 align=center valign=middle ><B>Location</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="2" rowspan=2 align=center valign=middle ><B>Specifications</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>Thickness</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>Length</B></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center valign=middle ><B>width</B></td>
                </tr>
                <?php
                foreach ($packingmaterial as $result) {
                    ?>
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"><?php echo $result->description ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><?php echo $result->partnumber ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><?php echo round($result->depth, 3) ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><?php echo round($result->height, 3) ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><?php echo round($result->width, 3) ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center><?php echo round($result->qty, 3) . " / " . $result->unitcode ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center>
                            <?php
                            $vol = ($result->depth * $result->height * $result->width * $result->qty) / 1000000000;
                            echo round( number_format($vol,4,'.',''), 3) ;
                            ?>
                            &nbsp;
                        </td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=left colspan="1"><?php echo $result->location ?>&nbsp;</td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=left colspan="2"><?php echo @$result->specifications ?>&nbsp;</td>
                    </tr>
                    <?php
                }
                ?>                            
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height=18 >&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="10" height=18 >&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=10 height=18 align=center bgcolor="#D9D9D9" ><B>Construction and Veneer Layout Details</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=10 height=132 align=center >
                        <?php
                        $i = 0;
                        foreach ($layout as $result_2) {
                            ?>
                            <img src="<?php echo base_url() . 'files/' . $result_2->filename ?>" style="max-width: 120px;max-height: 120px"/>
                            <?php
                            $i++;
                            if ($i == 5) {
                                echo "<br/>";
                                $i = 1;
                            }
                        }
                        ?>    
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td style=" border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=10 height=18 align=center bgcolor="#D9D9D9" ><B>Additional Notes</B></td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=10 height=105 valign="TOP">
                        <p style="padding: 10px">
                        <?php echo $additionalnotes ?>
                        &nbsp;
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=10 height=18 align=center bgcolor="#D9D9D9" ><B>Review Notes and Product History</B></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan="2" align=center><b>Date</b></td>                    
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center colspan="3"><b>Reviewed By</b></td>
                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center colspan="5"><b>Notes</b></td>                    
                </tr>
                <?php
                foreach ($reviewnotes as $result) {
                    ?>
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan="2" align=center><?php echo $result->date ?></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align=center colspan="3"><?php echo $result->reviewedby ?></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="5"><?php echo $result->notes ?></td>
                    </tr>
                    <?php
                }
                ?>

                <tr>
                    <td colspan="10" height=18 >&nbsp;</td>
                </tr>
                <tr>
                    <td colspan=2 height=18 align=center >Prepared by</td>
                    <td >&nbsp;</td>
                    <td colspan=3 align=center >Checked by</td>
                    <td >&nbsp;</td>
                    <td colspan="3" align=center >Approved by</td>
                </tr>
                <tr>
                    <td colspan=2 align=center height="50">&nbsp;</td>
                    <td >&nbsp;</td>
                    <td colspan=3 align=center >&nbsp;</td>
                    <td >&nbsp;</td>
                    <td >&nbsp;</td>
                    <td >&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000" colspan=2 align=center >&nbsp;<?php echo @$model->preparedby ?></td>
                    <td >&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000" colspan=3 align=center >&nbsp;<?php echo @$model->checkedby_name ?></td>                    
                    <td >&nbsp;</td>
                    <td style="border-bottom: 1px solid #000000" colspan=3 align=center >&nbsp;<?php echo @$model->approvedby_name ?></td>
                </tr>
                <tr>
                    <td colspan=2 height=18 align=center >&nbsp;</td>
                    <td >&nbsp;</td>
                    <td colspan=3 align=center >&nbsp;</td>
                    <td >&nbsp;</td>
                    <td >&nbsp;</td>
                    <td >&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="10" colspan="10" height=18 >&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="10" colspan="10" height=18 >Distribution :</td>
                </tr>
                <tr>
                    <td colspan="10" height=18 >1. PPC</td>
                </tr>
                <tr>
                    <td colspan="10" height=18 >2. Costing</td>
                </tr>
                <tr>
                    <td colspan="10"  height=18 >3. Accounting</td>
                </tr>
                <tr>
                    <td colspan="10" height=18 >4. File</td>
                </tr>
            </tbody>
        </table>
    </center>
    <!-- ************************************************************************** -->
</body>

</html>
