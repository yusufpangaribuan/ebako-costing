<table>
    <tr>
        <td><span class="labelelement">Creator</span></td>
        <td>
            <input type="hidden" id="id1" name="idapproval[]" value="<?php echo $this->session->userdata('id') ?>"/>
            <input type="text" id="name-apprvove1" readonly="" value="<?php echo $this->model_employee->getNameById($this->session->userdata('id')); ?>"/>
            <button onclick="pr_selectApproval(1)" style="font-size: 11px;">Select</button>
            <!--            <button onclick="pr_clearApproval(1)">clear</button>-->
        </td>
    </tr>
    <tr>
        <td><span class="labelelement">Checked</span></td>
        <td>
            <input type="hidden" id="id2" name="idapproval[]" value="<?php echo empty($defaultapproval->checked) ? "" : $defaultapproval->checked ?>"/>
            <input type="text" id="name-apprvove2" readonly="" value="<?php echo empty($defaultapproval->checked) ? "" : $this->model_employee->getNameById($defaultapproval->checked); ?>"/>
            <button onclick="pr_selectApproval(2)" style="font-size: 11px;">Select</button>
            <button onclick="pr_clearApproval(2)" style="font-size: 11px;">Clear</button>
        </td>
    </tr>
    <tr>
        <td><span class="labelelement">Acknowledge</span></td>
        <td>
            <input type="hidden" id="id3"  name="idapproval[]" value="<?php echo empty($defaultapproval->acknowledge) ? "" : $defaultapproval->acknowledge ?>"/>
            <input type="text" id="name-apprvove3" readonly="" value="<?php echo empty($defaultapproval->acknowledge) ? "" : $this->model_employee->getNameById($defaultapproval->acknowledge); ?>"/>
            <button onclick="pr_selectApproval(3)" style="font-size: 11px;">Select</button>
            <button onclick="pr_clearApproval(3)" style="font-size: 11px;">Clear</button>
        </td>
    </tr>
    <tr>
        <td><span class="labelelement">Approved</span></td>
        <td>
            <input type="hidden" id="id4"  name="idapproval[]" value="<?php echo empty($defaultapproval->approved) ? "" : $defaultapproval->approved ?>"/>
            <input type="text" id="name-apprvove4" readonly="" value="<?php echo empty($defaultapproval->approved) ? "" : $this->model_employee->getNameById($defaultapproval->approved); ?>"/>
            <button onclick="pr_selectApproval(4)" style="font-size: 11px;">Select</button>
            <button onclick="pr_clearApproval(4)" style="font-size: 11px;">Clear</button>
        </td>
    </tr>    
    <tr>
        <td>&nbsp;</td>
        <td>
            <button style="font-size: 11px;" onclick="servicerequest_saveapproval(<?php echo $servicerequestid ?>)">Save</button>
            <button style="font-size: 11px;" onclick="servicerequest_set_approval(<?php echo $servicerequestid ?>)">Reset</button>
        </td>
    </tr>
</table>