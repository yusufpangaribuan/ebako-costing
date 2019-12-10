<div style="width: 500px;">
    <table align="center" border="0" align="center">            
        <tr>
            <td align="right"><span class="labelelement">Code :</span></td>
            <td>
                <input type="hidden" id="modelid" name="modelid" value="<?php echo $model->id ?>"/>
                <input type="hidden" id="id" name="id" value="<?php echo $model->id ?>"/>
                <input type="text" id="modelno" name="modelno" value="<?php echo $model->no ?>" style="width: 250px;"/>
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Customer Code :</span></td>
            <td>
                <input type="text" id="custcode" name="custcode" value="<?php echo $model->custcode ?>" />
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Type :</span></td>
            <td>
                <select id="modeltypeid_e" name="modeltypeid">
                    <option value="0"></option>
                    <?php
                    foreach ($modeltype as $modeltype) {
                        if ($modeltype->id == $model->modeltypeid) {
                            echo "<option value='" . $modeltype->id . "' selected>" . $modeltype->name . "</option>";
                        } else {
                            echo "<option value='" . $modeltype->id . "'>" . $modeltype->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Description :</span></td>
            <td><input type="text" id="mdl_description_e" name="description" size="40" value="<?php echo $model->description ?>"/></td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Dimension :</span></td>
            <td>
                W : <input type="text" id="w" name="w" size="4" value="<?php echo $model->dw ?>" style="text-align: center;"/> MM&nbsp;&nbsp;
                D : <input type="text" id="d" name="d" size="4" value="<?php echo $model->dd ?>" style="text-align: center;"/> MM&nbsp;&nbsp;
                HT : <input type="text" id="ht" name="ht" size="4" value="<?php echo $model->dht ?>" style="text-align: center;"/> MM&nbsp;&nbsp;
                <input type="hidden" id="sh" name="sh" size="4" value="<?php echo $model->dsh ?>" placeholder="SH" style="text-align: center;"/>
                <input type="hidden" id="ah" name="ah" size="4" value="<?php echo $model->dah ?>" placeholder="AH" style="text-align: center;"/>
            </td>
        </tr>
        <tr>
            <td align="right"><span class="labelelement">Carton Box :</span></td>
            <td>
                W : <input type="text" id="cw" name="cw" size="4" value="<?php echo $model->cw ?>" style="text-align: center;"/> MM&nbsp;&nbsp;
                D : <input type="text" id="cd" name="cd" size="4" value="<?php echo $model->cd ?>" style="text-align: center;"/> MM&nbsp;&nbsp;
                HT : <input type="text" id="ch" name="ch" size="4" value="<?php echo $model->ch ?>" style="text-align: center;"/> MM&nbsp;&nbsp;
            </td>
        </tr>                       
        <tr>
            <td align="right"><span class="labelelement">Color Finish :</span></td>
            <td>
                <input type="hidden" id="yield" name="yield" size="6" style="text-align: center;" value="<?php echo $model->yield ?>"/>
                <input type="text" id="color" name="color" size="10" value="<?php echo $model->color ?>"/>                                        
            </td>
        </tr>            
        <tr>
            <td align="right"><span class="labelelement">Volume (Package) :</span></td>
            <td>
                <input type="text" id="volume_package" name="volume_package" size="7"/>
                <span class="labelelement">M3</span>
            </td>
        </tr>            
        <tr>
            <td align="right"><span class="labelelement">Finish Overview :</span></td>
            <td>
                <?php
                $strarray = str_replace(array("{", "}"), "", $model->finishoverview);
                $arrfinishoverview = explode(',', $strarray);
                foreach ($finishoverview as $result) {
                    if (in_array($result->id, $arrfinishoverview)) {
                        echo "<input type='checkbox' value='" . $result->id . "' checked name='finishoverview[]'>&nbsp;&nbsp;<span style='font-size:11px;vertical-align:middle;'>" . $result->name . "</span>&nbsp;&nbsp;";
                    } else {
                        echo "<input type='checkbox' value='" . $result->id . "' name='finishoverview[]'>&nbsp;&nbsp;<span style='font-size:11px;vertical-align:middle;'>" . $result->name . "</span>&nbsp;&nbsp;";
                    }
                }
                ?>
            </td>
        </tr>

        <tr>
            <td align="right"><span class="labelelement">Construction Overview :</span></td>
            <td>
                <?php
                $strarray = str_replace(array("{", "}"), "", $model->constructionoverview);
                $arrconstructionoverview = explode(',', $strarray);
                foreach ($constructionoverview as $result) {
                    if (in_array($result->id, $arrconstructionoverview)) {
                        echo "<input type='checkbox' value='" . $result->id . "' checked name='constructionoverview[]'>&nbsp;&nbsp;<span style='font-size:11px;vertical-align:middle;'>" . $result->name . "</span>&nbsp;&nbsp;";
                    } else {
                        echo "<input type='checkbox' value='" . $result->id . "' name='constructionoverview[]'>&nbsp;&nbsp;<span style='font-size:11px;vertical-align:middle;'>" . $result->name . "</span>&nbsp;&nbsp;";
                    }
                }
                ?>
            </td>
        </tr>
        <tr valign="top">
            <td style="vertical-align: middle" align="right"><span class="labelelement">Image :</span></td>
            <td>
                <input type="file" id="fileupload" name="fileupload" />
                <input type="hidden" id="filename" name="filename" value="<?php echo $model->filename ?>" />
            </td>
        </tr>
        <tr valign="top">
            <td style="vertical-align: middle" align="right"><span class="labelelement">Prepared By :</span></td>
            <td>                    
                <!--<input type="text" id="preparedby" name="preparedby" value="<?php echo $model->preparedby ?>" style="width: 250px"/>-->
                <script>
                    $(function () {
                        $("#name-apprvove1").autocomplete({
                            source: url + 'employee/search_autocomplete',
                            minLength: 2,
                            select: function (event, ui) {
                                $("#name-apprvove1").val(ui.item.label);
                                $("#id1").val(ui.item.id);

                            }
                        }).data("autocomplete")._renderItem = function (ul, item) {
                            return $("<li>")
                                    .data("item.autocomplete", item)
                                    .append("<a>" + item.label + "<br>" + item.desc + "</a>")
                                    .appendTo(ul);
                        };
                    });
                </script>

                <input id="name-apprvove1" name="preparedby" type="text" value="<?php echo $model->preparedby ?>" readonly="true">
                <button onclick="pr_selectApproval(1)">Select</button>
                <button onclick="pr_clearApproval(1)">Clear</button>
            </td>
        </tr>
        <tr valign="top">
            <td style="vertical-align: middle" align="right"><span class="labelelement">Checked By :</span></td>
            <td>                    
                <!--<input type="text" id="checkedby" name="checkedby" value="<?php echo $model->checkedby ?>" style="width: 250px"/>-->
                <script>
                    $(function () {
                        $("#name-apprvove2").autocomplete({
                            source: url + 'employee/search_autocomplete',
                            minLength: 2,
                            select: function (event, ui) {
                                $("#name-apprvove2").val(ui.item.label);
                                $("#id1").val(ui.item.id);

                            }
                        }).data("autocomplete")._renderItem = function (ul, item) {
                            return $("<li>")
                                    .data("item.autocomplete", item)
                                    .append("<a>" + item.label + "<br>" + item.desc + "</a>")
                                    .appendTo(ul);
                        };
                    });
                </script>

                <input id="name-apprvove2" name="checkedby" type="text" value="<?php echo $model->checkedby ?>" readonly="true">
                <button onclick="pr_selectApproval(2)">Select</button>
                <button onclick="pr_clearApproval(2)">Clear</button>
            </td>
        </tr>
        <tr valign="top">
            <td style="vertical-align: middle" align="right"><span class="labelelement">Approved By :</span></td>
            <td>                    
                <!--<input type="text" id="approvedby" name="approvedby" value="<?php echo $model->approvedby ?>" style="width: 250px"/>-->
                <script>
                    $(function () {
                        $("#name-apprvove3").autocomplete({
                            source: url + 'employee/search_autocomplete',
                            minLength: 2,
                            select: function (event, ui) {
                                $("#name-apprvove3").val(ui.item.label);
                                $("#id1").val(ui.item.id);

                            }
                        }).data("autocomplete")._renderItem = function (ul, item) {
                            return $("<li>")
                                    .data("item.autocomplete", item)
                                    .append("<a>" + item.label + "<br>" + item.desc + "</a>")
                                    .appendTo(ul);
                        };
                    });
                </script>

                <input id="name-apprvove3" name="approvedby" type="text" value="<?php echo $model->approvedby ?>" readonly="true">
                <button onclick="pr_selectApproval(3)">Select</button>
                <button onclick="pr_clearApproval(3)">Clear</button>
       			 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </td>
        </tr>
        <tr><td colspan="2">&nbsp;</td></tr>
<!--        <tr>
            <td colspan="2" align="center">
                <button onclick="model_update()">Update</button>
                <button onclick="$('#dialog_temp').dialog('close');
                        model_view()">Cancel</button>
                <button onclick="model_edit()">Reset</button>
            </td></tr>-->
    </table>
</div>
