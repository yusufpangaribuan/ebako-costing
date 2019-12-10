<div style="width:400px;height: 400px">
    <table width="100%" cellpadding="1" cellspacing="1">
        <tr valign="top">
            <td width="40%">
                <table>
                    <tr valign="top">
                        <td><label class="labelelement">Cust. Code</label></td>
                        <td><input type="text" id="custcode0" value="<?php echo $rfqdetail->custcode?>" size="15" style="text-transform: uppercase;"/></td>
                    </tr>
                    <tr valign="top">
                        <td><label class="labelelement">Qty</label></td>
                        <td>
                            <input type="hidden" id="rfqdetailid" value="<?php echo $rfqdetail->id ?>"/>
                            <input type="hidden" id="rfqid" value="<?php echo $rfqdetail->rfqid ?>"/>
                            <input type="text" id="qty" value="<?php echo $rfqdetail->qty ?>" size="5" onblur="if($(this).val()=='' || isNaN($(this).val())){alert('Required NUMBER and Not Allow 0 or NULL');$(this).val(0)}" style="text-align: center"/>
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
                <textarea style="width: 100%; height: 300px;" id="description"><?php echo $rfqdetail->description ?></textarea>
            </td>        
        </tr>
        <tr>
            <td>
                <br/>
                <button onclick="rfq_updatefornewmodel()">Save</button>
                <button onclick="$('#dialog2').dialog('close')">Cancel</button>
            </td>
        </tr>
    </table>
</div>