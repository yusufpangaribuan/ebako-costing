<div   style='width: 1000px; margin: 100 auto; position: relative;'>
    <table width="100%" class="tablesorter">
        <tr>
			<td width="15%"><b>FINISH ON BODY/ FRAME</b></td>
        	<td colspan="2">
        		<input type="text" name="finish_on_body_frame" value="<?php echo $model->finish_on_body_frame?>" size="50">
        	</td>
        </tr>
        <tr style="background-color: #f7f7f7;">
			<td width="15%"><b>FINISH ON METAL / HARDWARE</b></td>
        	<td colspan="2">
        		<input type="text" name="finish_on_metal_hardware" value="<?php echo $model->finish_on_metal_hardware?>" size="50">
        	</td>
        </tr>
        <tr>
            <td width="15%"><b>SPECIAL REQUIREMENT</b></td>
            <td>
                <?php
                
                $strarray = str_replace(array("{", "}"), "", $model->special_requirement);
                $arr_special_requirement = explode(',', $strarray);
                $counter = 0;
                foreach ($special_requirement as $result) {
                    if ( in_array($result->id, $arr_special_requirement )) {
                        echo "<input type='checkbox' value='" . $result->id . "' name='special_requirement[]' checked>&nbsp;&nbsp;<span style='font-size:11px;vertical-align:middle;'>" . $result->name . "</span>&nbsp;&nbsp;";
                    } else {
                        echo "<input type='checkbox' value='" . $result->id . "' name='special_requirement[]'>&nbsp;&nbsp;<span style='font-size:11px;vertical-align:middle;'>" . $result->name . "</span>&nbsp;&nbsp;";
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
                <a href="javascript:void(0)" onclick="model_add_other_special_requirement(<?php echo $modelid . ",11" ?>)"><b>Others [add]</b></a>
                <?php
                if (!empty($special_requirement_other)) {
                    echo "<br/><br/><table class='child' width='100%'>";
                    foreach ($special_requirement_other as $result) {
                        echo "<tr>";
                        echo "<td width='60%'>" . $result->description . "</td>";
                        echo "<td align='center'>";
                        echo "<a href='javascript:void(0)' onclick='model_edit_other_special_requirement(" . $result->id . "," . $result->typeid . ")'>Edit</a> |";
                        echo "<a href='javascript:void(0)' onclick='model_delete_other_special_requirement(" . $result->id . "," . $modelid . ")'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                ?>
            </td>
        </tr>
        
        <tr style="background-color: #f7f7f7;">
            <td><b>PACKING TYPE</b></td>
            <td>
                <?php
                $strarray = str_replace(array("{", "}"), "", $model->packing_type);
                $arr_packing_type = explode(',', $strarray);
                $counter = 0;
                foreach ($packing_type as $result) {
                    if (in_array($result->id, $arr_packing_type)) {
                        echo "<input type='checkbox' value='" . $result->id . "' name='packing_type[]' checked>&nbsp;&nbsp;<span style='font-size:11px;vertical-align:middle;'>" . $result->name . "</span>&nbsp;&nbsp;";
                    } else {
                        echo "<input type='checkbox' value='" . $result->id . "' name='packing_type[]'>&nbsp;&nbsp;<span style='font-size:11px;vertical-align:middle;'>" . $result->name . "</span>&nbsp;&nbsp;";
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
                <a href="javascript:void(0)" onclick="model_add_other_special_requirement(<?php echo $modelid . ",12" ?>)"><b>Others [add]</b></a>
                <?php
                if (!empty($packing_type_other)) {
                    echo "<br/><br/><table class='child' width='100%'>";
                    foreach ($packing_type_other as $result) {
                        echo "<tr>";
                        echo "<td width='60%'>" . $result->description . "</td>";
                        echo "<td align='center'>";
                        echo "<a href='javascript:void(0)' onclick='model_edit_other_special_requirement(" . $result->id . "," . $result->typeid . ")'>Edit</a> |";
                        echo "<a href='javascript:void(0)' onclick='model_delete_other_special_requirement(" . $result->id . "," . $modelid . ")'>Delete</a>";
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
        	<button type="button" class="btn btn btn-success" onclick="model_save_special_requirement(<?php echo $modelid ?>)"><i class="fa fa-save"></i> Save</button>
        	<button data-dismiss="modal" type="button" class="btn btn-danger">Cancel</button>
        </center>
    </div>
</div>