<table>
    <tr>
        <td align="right"><span class="labelelement">Creator:</span></td>
        <td>
            <input type="hidden" name="id[]" value="<?php echo $approval[0]->id ?>"/>
            <input type="hidden" id="id1" name="idapproval[]" value="<?php echo (empty($approval)) ? "" : $approval[0]->employeeid ?>"/>
            <input type="text" id="name-apprvove1" readonly="" value="<?php echo (empty($approval)) ? "" : $this->model_employee->getNameById($approval[0]->employeeid); ?>"/>
            <?php
            if ((empty($approval)) || $approval[0]->status == 0) {
                ?>
                <button onclick="pr_selectApproval(1)" style="font-size: 10px;">Select</button>
                <button onclick="pr_clearApproval(1)" style="font-size: 10px;">Clear</button>
                <?php
            }
            ?>

        </td>
    </tr>
    <tr>
        <td align="right"><span class="labelelement">Checked :</span></td>
        <td>
            <input type="hidden" name="id[]" value="<?php echo $approval[1]->id ?>"/>
            <input type="hidden" id="id2" name="idapproval[]" value="<?php echo (empty($approval)) ? "" : $approval[1]->employeeid ?>"/>
            <input type="text" id="name-apprvove2" readonly="" value="<?php echo (empty($approval)) ? "" : $this->model_employee->getNameById($approval[1]->employeeid); ?>"/>
            <?php
            if ((empty($approval)) || $approval[1]->status == 0) {
                ?>
                <button onclick="pr_selectApproval(2)" style="font-size: 10px;">Select</button>
                <button onclick="pr_clearApproval(2)" style="font-size: 10px;">Clear</button>
                <?php
            }
            ?>
        </td>
    </tr>
    <tr>
        <td align="right"><span class="labelelement">Acknowledge :</span></td>
        <td>
            <input type="hidden" name="id[]" value="<?php echo $approval[2]->id ?>"/>
            <input type="hidden" id="id3"  name="idapproval[]" value="<?php echo (empty($approval)) ? "" : $approval[2]->employeeid ?>"/>
            <input type="text" id="name-apprvove3" readonly="" value="<?php echo (empty($approval)) ? "" : $this->model_employee->getNameById($approval[2]->employeeid); ?>"/>
            <?php
            if ((empty($approval)) || $approval[2]->status == 0) {
                ?>
                <button onclick="pr_selectApproval(3)" style="font-size: 10px;">Select</button>
                <button onclick="pr_clearApproval(3)" style="font-size: 10px;">clear</button>
                <?php
            }
            ?>
        </td>
    </tr>
    <tr>
        <td align="right"><span class="labelelement">Approved :</span></td>
        <td>
            <input type="hidden" name="id[]" value="<?php echo $approval[3]->id ?>"/>
            <input type="hidden" id="id4"  name="idapproval[]" value="<?php echo (empty($approval)) ? "" : $approval[3]->employeeid ?>"/>
            <input type="text" id="name-apprvove4" readonly="" value="<?php echo (empty($approval)) ? "" : $this->model_employee->getNameById($approval[3]->employeeid); ?>"/>
            <?php
            if ((empty($approval)) || $approval[3]->status == 0) {
                ?>
                <button onclick="pr_selectApproval(4)" style="font-size: 10px;">select</button>
                <button onclick="pr_clearApproval(4)" style="font-size: 10px;">clear</button>
                <?php
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <button onclick="servicerequest_updateapproval(<?php echo $servicerequestid ?>)" style="font-size: 10px;">Update</button>
            <button onclick="servicerequest_edit_approval(<?php echo $servicerequestid ?>)" style="font-size: 10px;">Reset</button>            
        </td>
    </tr>
</table>