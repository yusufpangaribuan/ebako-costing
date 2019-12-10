<table width="350" border="0">
    <tr>
        <td width="20%" align="right"><label class="labelelement">Level 1 :</label></td>
        <td width="80%">            
            <input id="id1" type="hidden" value="<?php echo $approval->level1?>" name="idapproval[]">
            <input id="name-apprvove1" type="text" value="<?php echo $approval->level1name?>" readonly="">
            <button style="font-size: 11px;" onclick="pr_selectApproval(1)">Select</button>
            <button style="font-size: 11px;" onclick="pr_clearApproval(1)">Clear</button>
        </td>
    </tr>
    <tr>
        <td width="20%" align="right"><label class="labelelement">Level 2 :</label> </td>
        <td width="80%">
            <input id="id2" type="hidden" value="<?php echo $approval->level2?>" name="idapproval[]">
            <input id="name-apprvove2" type="text" value="<?php echo $approval->level2name?>" readonly="">
            <button style="font-size: 11px;" onclick="pr_selectApproval(2)">Select</button>
            <button style="font-size: 11px;" onclick="pr_clearApproval(2)">Clear</button>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><button style="font-size: 11px;" onclick="po_saveconfigpoapproval()">Save</button></td>
    </tr>
</table>