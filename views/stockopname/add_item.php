<div style="width: 700px;">
    <div style="width: 50%">
        <form id="stockopname_form_search_item" onsubmit="return false">
            <table width="100%" border="0">
                <tr>
                    <td width="30%"><strong>Item Group</strong></td>
                    <td width="70%">
                        <select name="groupid" style="width: 70%;" onchange="stockopname_find_item()">
                            <option value="0">--Show All--</option>
                            <?php
                            foreach ($group as $result) {
                                echo "<option value='" . $result->id . "'>[" . $result->codes . "] " . $result->names . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="30%"><strong>Item Code</strong></td>
                    <td width="70%"><input type="text" name="item_code" style="width: 90%" onkeyup="if (event.keyCode === 13) {
                                stockopname_find_item()
                            }"/></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br/>
                        <button onclick="stockopname_find_item()" type="button">Search</button>
                        <br/><br/>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <div style="overflow-y: scroll;height: 400px">
        <form id="sl_sop_dd" onsubmit="false">
            <table class="tablesorter2" width="99%">
                <thead>
                    <tr>
                        <th width="2%"><input type="checkbox" id="ug_chck_1"/></th>
                        <th width="10%">Group</th>
                        <th width="18%">Item Code</th>
                        <th width="60%">Item Description</th>
                        <th width="10%">Unit</th>
                    </tr>
                </thead>
                <tbody id="stock_opname_listsearch">

                </tbody>
            </table>
        </form>
    </div>
</div>
<script>
    $("#ug_chck_1").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
        //$('#sl_sop_dd input:checkbox').click();
    });
</script>
