<div style="width: 400px">
    <form id="pr_edit_approval_form" onsubmit="return false">
        <table width="100%">
            <tr>
                <td align="right" width="25%"><span class="labelelement">Prepared By :</span></td>
                <td width="75%">
                    <input type="hidden" name="id[]" value="<?php echo $approval[0]->id ?>"/>
                    <input type="hidden" id="id1" name="idapproval[]" value="<?php echo (empty($approval)) ? "" : $approval[0]->employeeid ?>"/>
                    <input type="text" id="name-apprvove1" name="name-approval1"  class="required" style="width: 200px"  readonly="" value="<?php echo (empty($approval)) ? "" : $this->model_employee->getNameById($approval[0]->employeeid); ?>"/>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Checked :</span></td>
                <td>
                    <input type="hidden" name="id[]" value="<?php echo $approval[1]->id ?>"/>
                    <input type="hidden" id="id2" name="idapproval[]" value="<?php echo (empty($approval)) ? "" : $approval[1]->employeeid ?>"/>
                    <input type="text" id="name-apprvove2" class="required" style="width: 200px"  readonly="" value="<?php echo (empty($approval)) ? "" : $this->model_employee->getNameById($approval[1]->employeeid); ?>"/>
                    <?php
                    if ((empty($approval)) || $approval[1]->status == 0) {
                        ?>
                        <button onclick="pr_selectApproval(2)" type="button" style="font-size: 10px;">Select</button>
                        <button onclick="pr_clearApproval(2)" type="button" style="font-size: 10px;">Clear</button>
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
                    <input type="text" id="name-apprvove3" class="required" style="width: 200px" readonly="" value="<?php echo (empty($approval)) ? "" : $this->model_employee->getNameById($approval[2]->employeeid); ?>"/>
                    <?php
                    if ((empty($approval)) || $approval[2]->status == 0) {
                        ?>
                        <button onclick="pr_selectApproval(3)" type="button" style="font-size: 10px;">Select</button>
                        <button onclick="pr_clearApproval(3)" type="button" style="font-size: 10px;">Clear</button>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Approved :</span></td>
                <td>
                    <input type="hidden" name="id[]" value="<?php echo $approval[3]->id ?>" class="required"/>
                    <input type="hidden" id="id4"  name="idapproval[]" value="<?php echo (empty($approval)) ? "" : $approval[3]->employeeid ?>"/>
                    <input type="text" id="name-apprvove4" class="required" style="width: 200px"  readonly="" value="<?php echo (empty($approval)) ? "" : $this->model_employee->getNameById($approval[3]->employeeid); ?>"/>
                    <?php
                    if ((empty($approval)) || $approval[3]->status == 0) {
                        ?>
                        <button onclick="pr_selectApproval(4)" type="button" style="font-size: 10px;">Select</button>
                        <button onclick="pr_clearApproval(4)" type="button" style="font-size: 10px;">Clear</button>
                        <?php
                    }
                    ?>
                </td>
            </tr>
        </table>
    </form>
</div>