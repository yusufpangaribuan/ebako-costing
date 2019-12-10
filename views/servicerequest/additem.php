<div style="width: 500px;">   
    <form id="sr_add_item_form" onsubmit="return false;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="30%" style="border-bottom: #009B78 1px solid;border-right: #009B78 1px solid;"><span class="labelelement">Item Source Description</span></td>
                <td width="70%" style="border-bottom: #009B78 1px solid;padding: 5px;">
                    <input type="hidden" name="servicerequestid" id="servicerequestid" value="<?php echo $servicerequestid ?>"/>
                    <strong>Item Code : </strong><br/>
                    <input id="itemid0" type="hidden" name="source_itemid" required="true">
                    <input id="partnumber0" name="partnumber0" class="ui-autocomplete-input" type="text" style="width: 80%" autocomplete="off" class="required">
                    <span class="ui-helper-hidden-accessible" role="status" aria-live="polite"></span>
                    <button type="button" onclick="item_listSearch(0)">..</button><br/>                
                    <strong>Unit :</strong><br/>
                    <select name="source_unitid" id="unitid0" required="true" style="width: 100px;height: 16px;">
                        <option></option>
                    </select>
                    <script>
                        $(function () {
                            $("#partnumber0").autocomplete({
                                source: url + 'item/search_autocomplete',
                                minLength: 2,
                                select: function (event, ui) {
                                    $("#partnumber0").val(ui.item.label + '-' + ui.item.desc);
                                    $("#itemid0").val(ui.item.id);
                                    $('#unitid0').empty();
                                    $('#unitid0').append(ui.item.all_unit);
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
                <td style="border-bottom: #009B78 1px solid;border-right: #009B78 1px solid;"><span class="labelelement">Item Target Description</span></td>
                <td style="border-bottom: #009B78 1px solid;padding: 5px;">
                    <strong>Item Code : </strong><br/>
                    <input id="itemid1" type="hidden" name="target_itemid" required="true">
                    <input id="partnumber1" name="partnumber1" class="ui-autocomplete-input" type="text" style="width: 80%" autocomplete="off">
                    <span class="ui-helper-hidden-accessible" role="status" aria-live="polite"></span>
                    <button type="button" onclick="item_listSearch(1)">..</button>
                    <strong>Unit : </strong><br/>
                    <select name="target_unitid" id="unitid1" style="width: 100px;height: 16px;" required="true">
                        <option></option>
                    </select>
                    <script>
                        $(function () {
                            $("#partnumber1").autocomplete({
                                source: url + 'item/search_autocomplete',
                                minLength: 2,
                                select: function (event, ui) {
                                    $("#partnumber1").val(ui.item.label + '-' + ui.item.desc);
                                    $("#itemid1").val(ui.item.id);
                                    $('#unitid1').empty();
                                    $('#unitid1').append(ui.item.all_unit);
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
                <td style="border-bottom: #009B78 1px solid;border-right: #009B78 1px solid;"><span class="labelelement">Qty</span></td>
                <td style="border-bottom: #009B78 1px solid;padding: 5px;"><input type="text" name="qty" id="qty" required="true" class="required" style="text-align: center"/></td>
            </tr>
            <tr>
                <td style="border-bottom: #009B78 1px solid;border-right: #009B78 1px solid;"><span class="labelelement">Service Description</span></td>
                <td style="border-bottom: #009B78 1px solid;padding: 5px;"><textarea type="text" name="remark" style="width: 100%;height: 40px"></textarea></td>
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
    $("#sr_add_item_form").validate({
        ignore: 'hidden',
        rules: {
            qty: {
                required: true,
                number: true
            },
            source_itemid: {
                required: true
            }
        }
    });
</script>