<h4>Stock Card</h4>
<div style="margin: 4px;width: 100%">
    <table width="100%">
        <tr>
            <td width="30%" valign="top">
                <fieldset style="border: 1px #C0E2D4 solid;">
                    <legend style="font-weight: bold">Stock Card</legend>
                    <form id="stock_card_form" onsubmit="return false" method="POST">
                        <table width="500">
                            <tr>
                                <td width="25%"><strong>Start Date</strong></td>
                                <td width="75%">
                                    <input type="text" id="sc_dt1" size="10" name="start_date"/>
                                    <script type="text/javascript" >
                                        $(function () {
                                            $("#sc_dt1").datepicker({
                                                dateFormat: "yy-mm-dd",
                                                changeMonth: true,
                                                changeYear: true,
                                                showButtonPanel: true
                                            }).focus(function () {
                                                $("#sc_dt1").datepicker("show");
                                            });
                                            $("#sc_dt2").datepicker({
                                                dateFormat: "yy-mm-dd",
                                                changeMonth: true,
                                                changeYear: true,
                                                showButtonPanel: true
                                            }).focus(function () {
                                                $("#sc_dt2").datepicker("show");
                                            });
                                        });
                                    </script>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Stop Date</strong></td>
                                <td><input type="text" id="sc_dt2" size="10" name="end_date"/></td>
                            </tr>
                            <tr>
                                <td><strong>Warehouse</strong></td>
                                <td>
                                    <select name="warehouseid" required="true" style="width: 50%">
                                        <?php
                                        foreach ($warehouse as $result) {
                                            echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Group</strong></td>
                                <td>
                                    <select name="groupid" style="width: 50%" onchange="stc_group_change(this)">
                                        <option></option>
                                        <option value="-1">All</option>
                                        <?php
                                        foreach ($itemgroup as $result) {
                                            echo "<option value='" . $result->id . "'>" . $result->codes . "->" . $result->names . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <script>
                                        function stc_group_change(el) {
                                            var val = $(el).val();
                                            if (val !== "") {
                                                $('#itemid0').val("");
                                                $('#partnumber0').val("");
                                                $('#description0').val("");
                                            }
                                        }
                                    </script>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Item Code</strong></td>
                                <td>
                                    <input id="itemid0" type="hidden" name="itemid" required="true">
                                    <input id="partnumber0" class="ui-autocomplete-input" type="text" style="width: 80%" name="item_code" autocomplete="off">
                                    <span class="ui-helper-hidden-accessible" role="status" aria-live="polite"></span>
                                    <button type="button" onclick="item_listSearch(0)">..</button>
                                    <script>
                                        $(function () {
                                            $("#partnumber0").autocomplete({
                                                source: url + 'item/search_autocomplete',
                                                minLength: 2,
                                                select: function (event, ui) {
                                                    $("#partnumber0").val(ui.item.label);
                                                    $("#itemid0").val(ui.item.id);
                                                    $("#description0").val(ui.item.desc);
                                                    $('#unitid0').empty();
                                                    $('#unitid0').append(ui.item.all_unit);
                                                    $.get(url + 'item/getwarehouse/' + ui.item.id, function (content) {
                                                        $('#warehouseid0').empty();
                                                        $('#warehouseid0').append(content);
                                                    });
                                                    $('#stock0').load(url + 'item/gettotalstock/' + ui.item.id);
                                                }
                                            }).data("autocomplete")._renderItem = function (ul, item) {
                                                return $("<li>")
                                                        .data("item.autocomplete", item)
                                                        .append("<a>" + item.label + "<br>" + item.desc + "</a>")
                                                        .appendTo(ul);
                                            };
                                        });
                                    </script>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Item Description</strong></td>
                                <td>
                                    <input type="text" id="description0" name="item_description" style="width: 80%"/>
                                    <button type="button" onclick="item_listSearch(0)">..</button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Type</strong></td>
                                <td>
                                    <select name="type" style="width: 100px">
                                        <option value="1">Detail</option>
                                        <option value="2">Summarize</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <br/>
                                    <button type="button" onclick="stockcard_generate('view')">View</button>
                                    <button type="button" onclick="stockcard_generate('print')">Print</button>
                                    <button type="button" onclick="stockcard_generate('excel')">Export Xls</button>
                                    <br/><br/>
                                </td>
                            </tr>
                        </table>
                    </form>
                </fieldset>
            </td>
            <td width="70%" valign="top">
                <div id="stock_card_data" style="width: 99%;max-height: 500px;overflow: scroll">
                    <?php //$stockcard->search() ?>
                </div>
            </td>
        </tr>
    </table>
</div>
<script>
    // just for the demos, avoids form submit
    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });
    $("#stock_card_form").validate({
        rules: {
            start_date: {
                required: true
            },
            end_date: {
                required: true
            },
            groupid: {
                required: function (element) {
                    //console.log($("#itemid0").val());
                    return $("#itemid0").val() === "";
                }
            }
        }
    });


    function stockcard_generate(flag) {
//    alert(flag);
        if ($('#stock_card_form').valid()) {
            var data = $('#stock_card_form').serializeArray();
            data.push({name: "flag", value: flag});
            if (flag === 'view') {
                $("#stock_card_data").html("<center><img style='padding-top:50px;' src='images/loading1.gif'/></center>");
                $("#stock_card_data").load(url + 'stockcard/generate/' + flag, data);
//                $.post(url + 'stockcard/generate/' + flag, data, function (content) {
//                    $("#stock_card_data").empty();
//                    $("#stock_card_data").append(content);
//                });
            } else if (flag === 'print' || flag === 'excel') {
                var data = $('#stock_card_form').serializeObject();
                open_target('POST', url + 'stockcard/generate/' + flag, data, '_blank');
            }
        }
    }
</script>