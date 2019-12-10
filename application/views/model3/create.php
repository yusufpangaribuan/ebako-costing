<center>
    <table>
        <tr valign="top">
            <td>
                <div style="width: 550px;">
                    <table align="center" border="0" align="center" width="99%">
                        <tr valign="top">
                            <td align="right" width="25%"><span class="labelelement">Code :</span></td>
                            <td><input type="text" id="modelno" name="modelno" style="width: 90%"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Customer Code :</span></td>
                            <td><input type="text" id="custcode" name="custcode"  style="width: 90%"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Type :</span></td>
                            <td>
                                <select id="modeltypeid" name="modeltypeid" style="width: 30%">
                                    <option value="0"></option>
                                    <?php
                                    foreach ($modeltype as $modeltype) {
                                        echo "<option value='" . $modeltype->id . "'>" . $modeltype->name . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Description :</span></td>
                            <td><input type="text" id="description" name="description"  style="width: 90%"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Dimension :</span></td>
                            <td>
                                W : <input type="text" id="w" name="w" size="4" style="text-align: center;"/> MM&nbsp;&nbsp;
                                D : <input type="text" id="d" name="d" size="4" style="text-align: center;"/> MM&nbsp;&nbsp;
                                HT : <input type="text" id="ht" name="ht" size="4" style="text-align: center;"/> MM&nbsp;&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Carton Box :</span></td>
                            <td>
                                W : <input type="text" id="cw" name="cw" size="4" style="text-align: center;"/> MM&nbsp;&nbsp;
                                D : <input type="text" id="cd" name="cd" size="4" style="text-align: center;"/> MM&nbsp;&nbsp;
                                HT : <input type="text" id="ch" name="ch" size="4" style="text-align: center;"/> MM&nbsp;&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Color Finish :</span></td>
                            <td>
                                <input type="hidden" id="yield" value="0" name="yield" size="6" style="text-align: center;"/>
                                <input type="text" id="color" name="color" size="10"/>
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
                                foreach ($finishoverview as $result) {
                                    echo "<input type='checkbox' value='" . $result->id . "' name='finishoverview[]'>&nbsp;&nbsp;<span style='font-size:11px;vertical-align:middle;'>" . $result->name . "</span>&nbsp;&nbsp;";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Construction Overview :</span></td>
                            <td colspan="2">
                                <?php
                                foreach ($constructionoverview as $result) {
                                    echo "<input type='checkbox' value='" . $result->id . "' name='constructionoverview[]'>&nbsp;&nbsp;<span style='font-size:11px;vertical-align:middle;'>" . $result->name . "</span>&nbsp;&nbsp;";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" height="30"><span class="labelelement">Image :</span></td>
                            <td colspan="2">
                                <input type="file" id="fileupload" name="fileupload" />
                                <span class="labelelement"></span>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td style="vertical-align: middle" align="right"><span class="labelelement">Prepared By :</span></td>
                            <td colspan="2">
                                <!--<input type="text" id="preparedby" name="preparedby" value=""  style="width: 90%"/>-->
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

                                <input id="name-apprvove1" readonly="true" name="preparedby" type="text" value="">
                                <button onclick="pr_selectApproval(1)">Select</button>
                                <button onclick="pr_clearApproval(1)">Clear</button>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td style="vertical-align: middle" align="right"><span class="labelelement">Checked By :</span></td>
                            <td colspan="2">
                                <!--<input type="text" id="checkedby" name="checkedby" value=""  style="width: 90%"/>-->
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

                                <input id="name-apprvove2" readonly="true" name="checkedby" type="text" value="">
                                <button onclick="pr_selectApproval(2)">Select</button>
                                <button onclick="pr_clearApproval(2)">Clear</button>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td style="vertical-align: middle" align="right"><span class="labelelement">Approved By :</span></td>
                            <td colspan="2">
                                <!--<input type="text" id="approvedby" name="approvedby" value=""  style="width: 90%"/>-->
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

                                <input id="name-apprvove3" readonly="true" name="approvedby" type="text" value="">
                                <button onclick="pr_selectApproval(3)">Select</button>
                                <button onclick="pr_clearApproval(3)">Clear</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
            <td>
                <div style="width: 200px;height: 280px;overflow: scroll">
                    <h4>Last Model Number</h4>
                    <table width="100%" class="tablesorter" style="margin-top: 5px;">
                        <thead>
                            <tr>
                                <th width="30%">Type</th>
                                <th width="70%">Last Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($last_number as $result) {
                                ?>
                                <tr>
                                    <td><?php echo $result->name ?></td>
                                    <td><?php echo $result->last_model_code ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <center>

