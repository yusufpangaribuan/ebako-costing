<div style="width: 400px;">
    <table width="100%">
        <tr>
            <td align="right" width="25%"><label class="labelelement">PO Number :</label></td>
            <td width="75%">
                <input type="hidden" id="poitemid" value="<?php echo $poitemid->id ?>" />
                <input type="hidden" id="itemid" value="<?php echo $poitemid->itemid ?>" />
                <input type="text" value="<?php echo $poitemid->ponumber ?>" style="width: 100%" readonly=""/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement">Item Code :</label></td>
            <td><input type="text" value="<?php echo $poitemid->itempartnumber ?>" style="width: 100%" readonly=""/></td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement">Item Description :</label></td>
            <td><textarea readonly="" style="width: 100%;height: 40px;"><?php echo $poitemid->itemdescription ?></textarea></td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement">Unit :</label></td>
            <td><input type="text" value="<?php echo $poitemid->unitcode ?>" size="5" readonly="" style="text-align: center;width: 100px;"/></td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement">Request Qty :</label></td>
            <td><input type="text" id="req_qty" value="<?php echo $poitemid->qty ?>" size="5" readonly="" style="text-align: center;width: 100px"/></td>
        </tr>      
        <tr>
            <td align="right"><label class="labelelement">Date:</label></td>
            <td>
                <script type="text/javascript" >
                    $(function() {
                        $("#date").datepicker({
                            dateFormat: "yy-mm-dd"
                        }).focus(function() {
                            $("#date").datepicker("show");
                        });
                    });
                </script>
                <input type="text" id="date" value="" size="10" style="text-align: center;width: 100px;"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement">Outstanding :</label></td>
            <td><input type="text" id="req_qty" value="<?php echo $poitemid->outstanding ?>" size="5" readonly="" style="text-align: center;width: 100px;"/></td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement">Stock In :</label></td>
            <td><input type="text" id="qty" value="0" size="5"style="text-align: center;width: 100px;" onblur="if($(this).val()=='' || isNaN($(this).val())){alert('Required NUMBER and Not Allow NULL');$(this).val(0)}"/></td>
        </tr>               
<!--        <tr>
            <td></td>
            <td><br/>
                <button style="font-size: 11px" onclick="itemquality_doset()">Save</button>
                <button style="font-size: 11px" onclick="$('#dialog').dialog('close')">Cancel</button>
            </td>
        </tr>-->
    </table>
</div>