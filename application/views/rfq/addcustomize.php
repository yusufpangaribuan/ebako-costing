<div style="width:400px;">
    <table width="100%" border="0">
        <tr valign="top">
            <td width="100%">
                <table width="100%">
                    <tr valign="top">
                        <td align="right"><label class="labelelement">Code :</label></td>
                        <td><input type="text" id="modelcode0" value="" size="15" readonly=""/></td>
                    </tr>
                    <tr valign="top">
                        <td align="right"><label class="labelelement">Cust. Code :</label></td>
                        <td><input type="text" id="modelcustcode0" value="" size="15"/></td>
                    </tr>
                    <tr valign="top">
                        <td align="right"><label class="labelelement">Model :</label></td>
                        <td>
                            <input type="hidden" id="rfqid" value="<?php echo $rfqid ?>"/>
                            <input type="hidden" id="modelid0" value="0"/>
                            <textarea style="width: 90%;height: 30px" id="modeldescription0"></textarea>
                            <img src="images/list.png" class="miniaction" onclick="model_choose('model',0)"/>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td align="right"><label class="labelelement">Qty :</label></td>
                        <td><input type="text" id="qty" value="0" size="5" onblur="if($(this).val()=='' || isNaN($(this).val())){alert('Required NUMBER and Not Allow 0 or NULL');$(this).val(0)}" style="text-align: center"/></td>
                    </tr>
                </table>
            </td>            
        </tr>
        <tr valign="top">
            <td>                
                <div class="panel">                    
                    <h4>Description</h4>
                </div>                
                <textarea style="width: 100%; height: 200px;" id="customizedescription"></textarea><br/><br/>
                <button onclick="rfq_savecustomizemodel()" style="font-size: 12px;font-family: Calibri;">Save</button>
                <button onclick="$('#dialog2').dialog('close')" style="font-size: 12px;font-family: Calibri;">Cancel</button>
            </td>                
        </tr>
    </table>
</div>