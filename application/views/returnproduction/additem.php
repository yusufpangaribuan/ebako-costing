<tr valign="top">
    <td>
        <script>
            $(function () {
                $("#partnumber<?php echo $flag ?>").autocomplete({
                    source: url + 'item/search_autocomplete',
                    minLength: 2,
                    select: function (event, ui) {
                        $("#partnumber<?php echo $flag ?>").val(ui.item.label);
                        $("#itemid<?php echo $flag ?>").val(ui.item.id);
                        $("#description<?php echo $flag ?>").val(ui.item.desc);
                        $('#unitid<?php echo $flag ?>').empty();
                        $('#unitid<?php echo $flag ?>').append(ui.item.all_unit);
                    }
                }).data("autocomplete")._renderItem = function (ul, item) {
                    return $("<li>")
                            .data("item.autocomplete", item)
                            .append("<a>" + item.label + "<br>" + item.desc + "</a>")
                            .appendTo(ul);
                };
            });
        </script>
        <input type="text" name="partnumber[]" id="partnumber<?php echo $flag ?>" style="width: 85%">                                     
        <img src="images/list.png" onclick="item_listSearch(<?php echo $flag ?>)" class="miniaction"/>
        <input type="hidden" name="mrdetailid[<?php echo $flag ?>]" id="mrdetailid<?php echo $flag ?>" value="0"/>
        <input type="hidden" name="itemid[<?php echo $flag ?>]" id="itemid<?php echo $flag ?>" class="required"/>
    </td>
    <td><textarea style="width: 100%; height: 25px;" name="desciption[]" id="description<?php echo $flag ?>" readonly="true"></textarea></td>                                
    <td><input type="text" name="qty[<?php echo $flag ?>]" id="qty<?php echo $flag ?>" value="1" size="5" style="text-align: center; width: 100%;"onblur="if ($(this).val() == '' || $(this).val() == '0' || isNaN($(this).val())) {
                alert('Required NUMBER and Not Allow 0 or NULL');
                $(this).val(1);
            }"> </td>
    <td>
        <select name="unitid[<?php echo $flag ?>]" id="unitid<?php echo $flag ?>" class="required" style="width: 100%">
            <option value=""></option>
        </select>        
    </td>    
    <td>
        <select name="type[<?php echo $flag ?>]" id="type<?php echo $flag ?>" class="required" style="width: 100%">
            <option value=""></option>
            <option value="1">Increase Stock</option>
            <option value="2">Reject</option>
        </select>                                    
    </td>
    <td><textarea style="width: 100%; height: 25px;" name="reason[<?php echo $flag ?>]" id="reason<?php echo $flag ?>"></textarea></td>
    <td width="5"><img src="images/delete.png" style="cursor: pointer" onclick="pr_deleteitem(this)"/></td>
</tr>