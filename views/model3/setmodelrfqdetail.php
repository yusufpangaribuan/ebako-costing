<div style="width:350px;">
    <table width="100%" border="0">
        <tr valign="top">
            <td width="40%">
                <table width="100%">                    
                    <tr>
                        <td align="right"><label class="labelelement">Customer Code :</label></td>
                        <td><input id="cust_code_new" type="text" readonly="" value="<?php echo str_replace('%20', ' ', $cust_code); ?>" style="width: 80%"></td>
                    </tr>
                    <tr valign="top">
                        <td align="right"><label class="labelelement">Model :</label></td>
                        <td>
                            <input type="hidden" id="customerid" value="<?php echo $customerid ?>"/>
                            <input id="modelcode0" type="text" readonly="" value="" style="width: 80%">
                            <input type="hidden" id="rfqdetailid" value="<?php echo $rfqdetailid ?>"/>
                            <input type="hidden" id="refmodelid" value="<?php echo $refmodelid ?>"/>
                            <input type="hidden" id="modelid0" value="0"/>                            
                            <img src="images/list.png" class="miniaction" onclick="model_choose('model',0)"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><label class="labelelement">Description :</label></td>
                        <td>
                            <textarea style="width: 90%;height: 30px;" id="modeldescription0"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <br/>
                            <button onclick="model_dosetmodelrfqdetail()" style="font-size: 11px;">Save</button>
       			 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>        
    </table>
</div>
