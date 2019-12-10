<div style="width:400px;height: 420px">
    <table width="99%" border="0">
        <tr valign="top">
            <td width="100%">
                <table width="100%">
                    <tr valign="top">
                        <td><label class="labelelement">Code</label></td>
                        <td><input type="text" id="code0" value="<?php echo $rfqdetail->no; ?>"  readonly="" size="15" ></td>
                    </tr>
                    <tr valign="top">
                        <td><label class="labelelement">Cust. Code</label></td>
                        <td><input type="text" id="custcode0" value="<?php echo $rfqdetail->custcode; ?>" size="15" style="text-transform: uppercase"/></td>
                    </tr>
                    <tr valign="top">
                        <td><label class="labelelement">Model</label></td>
                        <td>
                            <input type="hidden" id="rfqdetailid" value="<?php echo $rfqdetail->id ?>"/>
                            <input type="hidden" id="rfqid" value="<?php echo $rfqdetail->rfqid ?>"/>
                            <input type="hidden" id="modelid0" value="<?php echo $rfqdetail->modelid ?>"/>
                            <textarea style="width: 90%;height: 30px" id="modeldescription0"><?php echo $rfqdetail->modeldescription ?></textarea>
                            <img src="images/list.png" class="miniaction" onclick="model_choose('model',0)"/>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td><label class="labelelement">Qty</label></td>
                        <td><input type="text" id="qty" value="<?php echo $rfqdetail->qty ?>" size="5" onblur="if($(this).val()=='' || isNaN($(this).val())){alert('Required NUMBER and Not Allow 0 or NULL');$(this).val(0)}" style="text-align: center"/></td>
                    </tr>
                </table>
            </td>            
        </tr>
        <tr valign="top">
            <td>                
                <div class="panel">                    
                    <h4>Description</h4>
                </div>                
                <textarea style="width: 100%; height: 250px;" id="customizedescription"><?php echo $rfqdetail->description ?></textarea><br/><br/>
                <button onclick="rfq_updatecustomizemodel()">Save</button>
                <button onclick="$('#dialog2').dialog('close')">Cancel</button>
            </td>                
        </tr>
    </table>
</div>