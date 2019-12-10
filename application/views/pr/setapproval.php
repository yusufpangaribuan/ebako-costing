<div style="width: 400px">
    <form id="pr_set_approval_form" onsubmit="return false;">
        <table width="100%">    
            <tr>
                <td><span class="labelelement">Buyer</span></td>
                <td>
                    <input type="hidden" id="id1" name="idapproval[]" value="<?php echo $this->session->userdata('id') ?>"/>
                    <input type="text" id="name-apprvove1" style="width: 200px" readonly="" value="<?php echo $this->model_employee->getNameById($this->session->userdata('id')); ?>"/>
                    <!--<button onclick="pr_selectApproval(1)" style="font-size: 10px;">Select</button>-->
                    <!--            <button onclick="pr_clearApproval(1)">clear</button>-->
                </td>
            </tr>
            <tr>
                <td><span class="labelelement">Checked</span></td>
                <td>
                    <input type="hidden" id="id2" name="idapproval[]" value="<?php echo $defaultapproval->checked ?>"/>
                    <input type="text" id="name-apprvove2" style="width: 200px" readonly="" value="<?php echo $this->model_employee->getNameById($defaultapproval->checked); ?>"/>
                    <button onclick="pr_selectApproval(2)" type="button" style="font-size: 10px;">Select</button>
                    <button onclick="pr_clearApproval(2)" type="button" style="font-size: 10px;">Clear</button>
                </td>
            </tr>
            <tr>
                <td><span class="labelelement">Acknowledge</span></td>
                <td>
                    <input type="hidden" id="id3"  name="idapproval[]" value="<?php echo $defaultapproval->acknowledge ?>"/>
                    <input type="text" id="name-apprvove3" style="width: 200px" readonly="" value="<?php echo $this->model_employee->getNameById($defaultapproval->acknowledge); ?>"/>
                    <button onclick="pr_selectApproval(3)" type="button" style="font-size: 10px;">Select</button>
                    <button onclick="pr_clearApproval(3)" type="button" style="font-size: 10px;">Clear</button>
                </td>
            </tr>
            <tr>
                <td><span class="labelelement">Approved</span></td>
                <td>
                    <input type="hidden" id="id4"  name="idapproval[]" value="<?php echo $defaultapproval->approved ?>"/>
                    <input type="text" id="name-apprvove4" style="width: 200px" readonly="" value="<?php echo $this->model_employee->getNameById($defaultapproval->approved); ?>"/>
                    <button onclick="pr_selectApproval(4)" type="button" style="font-size: 10px;">Select</button>
                    <button onclick="pr_clearApproval(4)" type="button" style="font-size: 10px;">Clear</button>
                </td>
            </tr>
        </table>
    </form>
</div>