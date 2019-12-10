<div style="width:400px;">
    <table width="99%" cellpadding="1" cellspacing="1">
        <tr valign="top">
            <td width="40%">
                <table> 
                    <tr valign="top">
                        <td align="right"><label class="labelelement">Cust. Code :</label></td>
                        <td><input type="text" id="modelcustcode0" value="" size="15"/></td>
                    </tr>
                    <tr valign="top">
                        <td align="right"><label class="labelelement">Qty :</label></td>
                        <td>
                            <input type="hidden" id="rfqid" value="<?php echo $rfqid ?>"/>
                            <input type="text" id="qty" value="0" size="5" onblur="if($(this).val()=='' || isNaN($(this).val())){alert('Required NUMBER and Not Allow 0 or NULL');$(this).val(0)}" style="text-align: center"/>
                        </td>
                    </tr>
                </table>
            </td>            
        </tr>
        <tr valign="top">
            <td>                
                <div class="panel">                    
                    <h4>Description</h4>
                </div>                
                <textarea style="width: 99.5%; height: 200px;" id="description"></textarea>
            </td>        
        </tr>
        <tr>
            <td>
                <button onclick="rfq_savefornewmodel()" style="font-size: 12px;font-family: Calibri;">Save</button>
                <button onclick="$('#dialog2').dialog('close')" style="font-size: 12px;font-family: Calibri;">Cancel</button>
            </td>
        </tr>
    </table>
</div>