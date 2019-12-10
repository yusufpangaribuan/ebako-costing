<div style="width: 400px;">
    <form id="returnproduction_add_form" onsubmit="return false;">
        <table align="center" width="100%" border="0">
            <tr>
                <td width="20%"><strong>Date</strong></td>
                <td widh="1%"><strong>:</strong></td>
                <td width="79%">
                    <input type="text" name="date" required="true" value="<?php echo date('Y-m-d') ?>" size="12"/>
                    <script type="text/javascript" >
                        $(function () {
                            $("#returnproduction_add_form input[name='date']").datepicker({
                                dateFormat: "yy-mm-dd"
                            }).focus(function () {
                                $("#returnproduction_add_form input[name='date']").datepicker("show");
                            });
                        });</script>
                </td>
            </tr>     
            <tr valign="top">
                <td><strong>Item Code</strong></td>
                <td><strong>:</strong></td>
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
                    </script><br/>
                    <input type="text" id="description0" name="item_description" readonly="" style="width: 80%"/>
                </td>
            </tr>   
            <tr>
                <td><strong>UoM</strong></td>
                <td><strong>:</strong></td>
                <td>
                    <select name="unitid" id="unitid0" style="width: 150px" required="true">
                        <option></option>
                    </select>
                </td>
            </tr> 
            <tr>
                <td><strong>Qty</strong></td>
                <td><strong>:</strong></td>
                <td><input type="text" name="qty" required="true" style="width: 75px"/></td>
            </tr> 
            <tr>
                <td><strong>Remark</strong></td>
                <td><strong>:</strong></td>
                <td><textarea name="remark" style="width: 100%;height: 40px"></textarea></td>
            </tr>   
        </table>
    </form>
</div>

<script>
// just for the demos, avoids form submit
    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });
    $("#returnproduction_add_form").validate({
        ignore: "input[type='text']:hidden",
        rules: {
            date: {
                required: true
            },
            qty: {
                required: true,
                number: true
            },
            remark: {
                required: true
            }
        }
    });
</script>