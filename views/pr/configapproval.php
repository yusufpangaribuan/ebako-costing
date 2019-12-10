<div style="width: 450px">
    <table width="100%" border="0">
        <tr>
            <td width="20%" align="right"><label class="labelelement">Checked :</label></td>
            <td width="80%">            
                <input id="id1" type="hidden" value="<?php echo $defaultapproval->checked; ?>" name="idapproval[]">
                <input id="name-apprvove1" type="text" value="<?php echo $this->model_employee->getNameById($defaultapproval->checked); ?>" readonly="">
                <button style="font-size: 11px;" onclick="pr_selectApproval(1)">Select</button>
                <button style="font-size: 11px;" onclick="pr_clearApproval(1)">Clear</button>
            </td>
        </tr>
        <tr>
            <td width="20%" align="right"><label class="labelelement">Acknowledge :</label> </td>
            <td width="80%">
                <input id="id2" type="hidden" value="<?php echo $defaultapproval->acknowledge; ?>" name="idapproval[]">
                <input id="name-apprvove2" type="text" value="<?php echo $this->model_employee->getNameById($defaultapproval->acknowledge); ?>" readonly="">
                <button style="font-size: 11px;" onclick="pr_selectApproval(2)">Select</button>
                <button style="font-size: 11px;" onclick="pr_clearApproval(2)">Clear</button>
            </td>
        </tr>    
        <tr>
            <td width="20%" align="right"><label class="labelelement">Approved :</label></td>
            <td width="80%">
                <input id="id3" type="hidden" value="<?php echo $defaultapproval->approved; ?>" name="idapproval[]">
                <input id="name-apprvove3" type="text" value="<?php echo $this->model_employee->getNameById($defaultapproval->approved); ?>" readonly="">
                <button style="font-size: 11px;" onclick="pr_selectApproval(3)">Select</button>
                <button style="font-size: 11px;" onclick="pr_clearApproval(3)">Clear</button>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><button style="font-size: 11px;font-weight: bold;" onclick="pr_saveconfigapproval()">Save</button></td>
        </tr>
    </table>
</div>