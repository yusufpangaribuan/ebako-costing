<div   style='width: 1000px; margin: 100 auto; position: relative;'>
    <table width="100%" class="tablesorter">
        <tr>
            <td width="15%"><b>Expose</b></td>
            <td>
                <?php
                $strarray = str_replace(array("{", "}"), "", $model->expose);
                $arrexpose = explode(',', $strarray);
                $counter = 0;
                foreach ($expose as $result) {
                    if (in_array($result->id, $arrexpose)) {
                        echo "<input type='checkbox' value='" . $result->id . "' name='expose[]' checked>&nbsp;&nbsp;<span style='font-size:11px;vertical-align:middle;'>" . $result->description . "</span>&nbsp;&nbsp;";
                    } else {
                        echo "<input type='checkbox' value='" . $result->id . "' name='expose[]'>&nbsp;&nbsp;<span style='font-size:11px;vertical-align:middle;'>" . $result->description . "</span>&nbsp;&nbsp;";
                    }
                    $counter++;
                    if ($counter == 4) {
                        echo "<br/><br/>";
                        $counter = 0;
                    }
                }
                ?>
            </td>
            <td width="30%" style="border-left: 1px solid #000;">
                <a href="javascript:void(0)" onclick="model_add_other_material_overview(<?php echo $modelid . ",1" ?>)"><b>Others [add]</b></a>
                <?php
                if (!empty($expose_other)) {
                    echo "<br/><br/><table class='child' width='100%'>";
                    foreach ($expose_other as $result) {
                        echo "<tr>";
                        echo "<td width='60%'>" . $result->description . "</td>";
                        echo "<td align='center'>";
                        echo "<a href='javascript:void(0)' onclick='model_edit_other_material_overview(" . $result->id . "," . $result->typeid . ")'>Edit</a> |";
                        echo "<a href='javascript:void(0)' onclick='model_delete_other_material_overview(" . $result->id . "," . $modelid . ")'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                ?>
            </td>
        </tr>
        <tr style="background-color: #f7f7f7;">
            <td><b>Internal</b></td>
            <td>
                <?php
                $strarray = str_replace(array("{", "}"), "", $model->internal);
                $arrinternal = explode(',', $strarray);
                $counter = 0;
                foreach ($internal as $result) {
                    if (in_array($result->id, $arrinternal)) {
                        echo "<input type='checkbox' value='" . $result->id . "' name='internal[]' checked>&nbsp;&nbsp;<span style='font-size:11px;vertical-align:middle;'>" . $result->description . "</span>&nbsp;&nbsp;";
                    } else {
                        echo "<input type='checkbox' value='" . $result->id . "' name='internal[]'>&nbsp;&nbsp;<span style='font-size:11px;vertical-align:middle;'>" . $result->description . "</span>&nbsp;&nbsp;";
                    }
                    $counter++;
                    if ($counter == 4) {
                        echo "<br/><br/>";
                        $counter = 0;
                    }
                }
                ?>
            </td>
            <td style="border-left: 1px solid #000;">
                <a href="javascript:void(0)" onclick="model_add_other_material_overview(<?php echo $modelid . ",2" ?>)"><b>Others [add]</b></a>
                <?php
                if (!empty($internal_other)) {
                    echo "<br/><br/><table class='child' width='100%'>";
                    foreach ($internal_other as $result) {
                        echo "<tr>";
                        echo "<td width='60%'>" . $result->description . "</td>";
                        echo "<td align='center'>";
                        echo "<a href='javascript:void(0)' onclick='model_edit_other_material_overview(" . $result->id . "," . $result->typeid . ")'>Edit</a> |";
                        echo "<a href='javascript:void(0)' onclick='model_delete_other_material_overview(" . $result->id . "," . $modelid . ")'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td><b>Panels</b></td>
            <td>
                <?php
                $strarray = str_replace(array("{", "}"), "", $model->panel);
                $arrpanel = explode(',', $strarray);
                $counter = 0;
                foreach ($panel as $result) {
                    if (in_array($result->id, $arrpanel)) {
                        echo "<input type='checkbox' value='" . $result->id . "' name='panel[]' checked>&nbsp;&nbsp;<span style='font-size:11px;vertical-align:middle;'>" . $result->description . "</span>&nbsp;&nbsp;";
                    } else {
                        echo "<input type='checkbox' value='" . $result->id . "' name='panel[]'>&nbsp;&nbsp;<span style='font-size:11px;vertical-align:middle;'>" . $result->description . "</span>&nbsp;&nbsp;";
                    }
                    $counter++;
                    if ($counter == 4) {
                        echo "<br/><br/>";
                        $counter = 0;
                    }
                }
                ?>
            </td>
            <td style="border-left: 1px solid #000;">
                <a href="javascript:void(0)" onclick="model_add_other_material_overview(<?php echo $modelid . ",3" ?>)"><b>Others [add]</b></a>
                <?php
                if (!empty($panel_other)) {
                    echo "<br/><br/><table class='child' width='100%'>";
                    foreach ($panel_other as $result) {
                        echo "<tr>";
                        echo "<td width='60%'>" . $result->description . "</td>";
                        echo "<td align='center'>";
                        echo "<a href='javascript:void(0)' onclick='model_edit_other_material_overview(" . $result->id . "," . $result->typeid . ")'>Edit</a> |";
                        echo "<a href='javascript:void(0)' onclick='model_delete_other_material_overview(" . $result->id . "," . $modelid . ")'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                ?>
            </td>
        </tr>
        <tr style="background-color: #f7f7f7;">
            <td><b>Veneer</b></td>
            <td>
                <?php
                $strarray = str_replace(array("{", "}"), "", $model->veneer);
                $arrveneer = explode(',', $strarray);
                $counter = 0;
                foreach ($veneer as $result) {
                    if (in_array($result->id, $arrveneer)) {
                        echo "<input type='checkbox' value='" . $result->id . "' name='veneer[]' checked>&nbsp;&nbsp;<span style='font-size:11px;vertical-align:middle;'>" . $result->description . "</span>&nbsp;&nbsp;";
                    } else {
                        echo "<input type='checkbox' value='" . $result->id . "' name='veneer[]'>&nbsp;&nbsp;<span style='font-size:11px;vertical-align:middle;'>" . $result->description . "</span>&nbsp;&nbsp;";
                    }
                    $counter++;
                    if ($counter == 4) {
                        echo "<br/><br/>";
                        $counter = 0;
                    }
                }
                ?>
            </td>
            <td style="border-left: 1px solid #000;">
                <a href="javascript:void(0)" onclick="model_add_other_material_overview(<?php echo $modelid . ",4" ?>)"><b>Others [add]</b></a>
                <?php
                if (!empty($veneer_other)) {
                    echo "<br/><br/><table class='child' width='100%'>";
                    foreach ($veneer_other as $result) {
                        echo "<tr>";
                        echo "<td width='60%'>" . $result->description . "</td>";
                        echo "<td align='center'>";
                        echo "<a href='javascript:void(0)' onclick='model_edit_other_material_overview(" . $result->id . "," . $result->typeid . ")'>Edit</a> |";
                        echo "<a href='javascript:void(0)' onclick='model_delete_other_material_overview(" . $result->id . "," . $modelid . ")'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td><b>Others</b></td>
            <td>
                <?php
                $strarray = str_replace(array("{", "}"), "", $model->others);
                $arrothers = explode(',', $strarray);
                $counter = 0;
                foreach ($others as $result) {
                    if (in_array($result->id, $arrothers)) {
                        echo "<input type='checkbox' value='" . $result->id . "' name='others[]' checked>&nbsp;&nbsp;<span style='font-size:11px;vertical-align:middle;'>" . $result->description . "</span>&nbsp;&nbsp;";
                    } else {
                        echo "<input type='checkbox' value='" . $result->id . "' name='others[]'>&nbsp;&nbsp;<span style='font-size:11px;vertical-align:middle;'>" . $result->description . "</span>&nbsp;&nbsp;";
                    }
                    $counter++;
                    if ($counter == 4) {
                        echo "<br/><br/>";
                        $counter = 0;
                    }
                }
                ?>
            </td>
            <td style="border-left: 1px solid #000;">
                <a href="javascript:void(0)" onclick="model_add_other_material_overview(<?php echo $modelid . ",5" ?>)"><b>Others [add]</b></a>
                <?php
                if (!empty($others_other)) {
                    echo "<br/><table class='child' width='100%'>";
                    foreach ($others_other as $result) {
                        echo "<tr>";
                        echo "<td width='60%'>" . $result->description . "</td>";
                        echo "<td align='center'>";
                        echo "<a href='javascript:void(0)' onclick='model_edit_other_material_overview(" . $result->id . "," . $result->typeid . ")'>Edit</a> |";
                        echo "<a href='javascript:void(0)' onclick='model_delete_other_material_overview(" . $result->id . "," . $modelid . ")'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                ?>
            </td>
        </tr>
    </table>
    <div style="margin-top: 6px">
        <center>
        	<button type="button" class="btn btn btn-success" onclick="model_save_material_overview(<?php echo $modelid ?>)"><i class="fa fa-save"></i> Save</button>
        	<button data-dismiss="modal" type="button" class="btn btn-danger">Cancel</button>
        </center>
    </div>
</div>