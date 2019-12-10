
<table>
    <tr valign="top">
        <td width="50"><span class="labelelement">finishing</span></td>
        <td>
            <input type="hidden" name="modelid" id="modelid" value="<?php echo $modelid?>" size="30"/>
            <input type="hidden" id="finishingid" name="finishingid"/>
            <input type="text" readonly="true" id="name"/>&nbsp;<img src="images/list.png" class="miniaction" onclick="finishing_list()"/><br/><br/>
            <textarea style="width: 200px;" readonly="true" id="finishingdescription"></textarea>            
        </td>
    </tr>    
    <tr>
        <td>&nbsp;</td>
        <td><button onclick="model_savefinishing()">Save</button></td>
       			 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </tr>
</table>
