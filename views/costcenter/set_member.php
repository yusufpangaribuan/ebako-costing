<div style="width: 300px;">
    <form id="costcenter_set_member_form" class="table_form">
        <table width="100%">
            <tr valign="top">
                <td align="right" width="30%"><span class="labelelement">Cost Center :</span></td>
                <td width="70%">
                    <input type="hidden" name="id" value="<?php echo $id ?>" />
                    <select name="member" style="width: 100%" required="true">
                        <option></option>
                        <?php
                        foreach ($costcenter as $result) {
                            echo "<option value=" . $result->id . ">" . $result->code . "-" . $result->description . "</option>";
                        }
                        ?>  
                    </select>
                </td>
            </tr>
        </table>
    </form>
</div>